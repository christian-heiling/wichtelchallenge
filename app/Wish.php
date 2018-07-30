<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;

class Wish extends Model
{
    const STATE_OPEN = 'open';
    const STATE_IN_PROGRESS = 'in-progress';
    const STATE_UNPUBLISHED = 'unpublished';
    const STATE_SUCCESS = 'success';
    const STATE_FAILED = 'failed';

    protected $dates = ['created_at', 'updated_at', 'due_date', 'published_at'];

    public $additional_attributes = ['badges_html'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setPerPage(60);
    }

    protected static function boot()
    {
        parent::boot();

        if (Auth::user()) {
            if (Auth::user()->role->name == 'institution') {
                static::addGlobalScope('institution', function (Builder $builder) {
                    $builder->where('created_from_user_id', '=', Auth::user()->id);
                });
            }

            if (Auth::user()->role->name == 'imp') {
                static::addGlobalScope('imp', function (Builder $builder) {
                    // where the user is related
                    $wish_ids = Present::where('from_user_id', '=', Auth::user()->id)->pluck('wish_id');
                    $builder->whereIn('id', $wish_ids);

                    // where the state is correct
                    $builder->orWhereIn('state', [self::STATE_OPEN]);
                });
            }
        }
    }

    public function presents() {
        return $this->hasMany('App\Present')
            ->orderByRaw('FIELD(presents.state, ' . implode(',', array_map(function($state) { return '"' . $state . '"'; }, Present::getAvailableStates()) ) . ')');
    }

    public function location() {
        return $this->belongsTo('App\Location');
    }

    public function fromUser() {
        return $this->belongsTo('App\User');
    }

    public function instition() {
        return $this->belongsTo('App\Institution');
    }

    public static function getAvailableStates() {
        return [
            self::STATE_UNPUBLISHED,
            self::STATE_OPEN,
            self::STATE_IN_PROGRESS,
            self::STATE_SUCCESS,
            self::STATE_FAILED
        ];
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeOpen($query)
    {
        return $query
            ->whereRaw('wishes.due_date > NOW()')
            ->whereRaw('wishes.published_at > NOW()')
            ->whereRaw('(SELECT COUNT(presents.amount) FROM presents WHERE presents.wish_id = wishes.id GROUP BY presents.wish_id) < wishes.amount')
            ->whereRaw('wishes.is_open = true')
            ;
    }

    public static function scopeUnpublished($query)
    {
        return $query
            ->whereRaw('wishes.published_at < NOW()')
            ->whereRaw('(SELECT COUNT(presents.amount) FROM presents WHERE presents.wish_id = wishes.id GROUP BY presents.wish_id) < wishes.amount')
            ->whereRaw('wishes.is_open = true')
            ;
    }

    public static function scopePublished($query)
    {
        return $query->whereRaw('wishes.published_at < NOW()');
    }

    public function getPresentsAmount(array $present_states) {

        sort($present_states);

        $key = implode('_', $present_states);

        if (array_key_exists($key, $this->present_amount)) {
            return $this->present_amount[$key];
        }

        $result = $query = DB::table('presents')
            ->select(DB::raw('sum(amount) as sum_amount'))
            ->where('wish_id', $this->id)
            ->whereIn('state', $present_states)
            ->groupBy('wish_id')->first();

        if (empty($result)) {
            $return = 0;
        } else {
            $return = $result->sum_amount;
        }

        $this->present_amount[$key] = $return;

        return $return;
    }

    public function getImpsAmount(array $present_states) {

        sort($present_states);
        $key = implode('_', $present_states);

        if (array_key_exists($key, $this->imp_amount)) {
            return $this->imp_amount[$key];
        }

        $result = $query = DB::table('presents')
            ->select(DB::raw('count(from_user_id) as sum_amount'))
            ->where('wish_id', $this->id)
            ->whereIn('state', $present_states)
            ->groupBy('wish_id')
            ->first();

        if (empty($result)) {
            $return = 0;
        } else {
            $return = $result->sum_amount;
        }

        $this->imp_amount[$key] = $return;

        return $return;
    }

    private function getMessageImpsAmountDelivery() {
        if ($this->getImpsAmount(array(Present::STATE_DELIVERY)) == 0) {
            return 'kein Wichtel liefert aus';
        } elseif ($this->getImpsAmount(array(Present::STATE_DELIVERY)) == 1) {
            return 'ein Wichtel liefert aus';
        } else {
            return $this->getImpsAmount(array(Present::STATE_DELIVERY)) . ' Wichteln liefern aus';
        }

    }

    private function getMessagePresentDone() {
        if ($this->getPresentsAmount(array(Present::STATE_DONE)) == 0){
            return 'kein Geschenk erledigt';
        } else {
            return $this->getPresentsAmount(array(Present::STATE_DONE)) . ' von ' . $this->amount . ' Geschenken erledigt';
        }
    }

    private function getMessagePublishedAt() {
        return 'Veröffentlichung ' . $this->published_at->diffForHumans();
    }

    private function getMessageLastDeliveryDate() {
        return 'letzter Abgabetermin ' . $this->due_date->diffForHumans();
    }

    private function getMessageXofYopen() {
        return ($this->amount - ($this->getPresentsAmount(array(Present::STATE_DELIVERY, Present::STATE_DONE)))) . ' von ' . $this->amount;
    }

    private function getMessageId() {
        return '#WWC-' . $this->id;
    }

    public function getMessageState() {
        return self::getStateName($this->state);
    }

    public function getOpenWishAmountOptions() {
        $openPresents = $this->amount - $this->getPresentsAmount( [\App\Present::STATE_DELIVERY, \App\Present::STATE_DONE] );

        $options = array();
        for($i = 1; $i <= $openPresents; $i++) {
            $options[$i] = $i;
        }

        return $options;
    }

    public static function getStateName($state)
    {
        switch ($state) {
            case self::STATE_OPEN:
                return 'Offen';
                break;
            case self::STATE_IN_PROGRESS:
                return 'in Bearbeitung';
                break;
            case self::STATE_UNPUBLISHED:
                return 'Unveröffentlicht';
                break;
            case self::STATE_SUCCESS:
                return 'Erfolg';
                break;
            case self::STATE_FAILED:
                return 'Gescheitert';
                break;
        }
    }

    public function getBadgesHtmlAttribute() {
        return $this->getBadgesHtml();
    }

    public function getBadgesHtml() {
        $return = [];

        switch ($this->state) {
            case self::STATE_OPEN:
                $return[] = $this->getMessageId();
                $return[] = $this->getMessageState() . ': ' . $this->getMessageXofYopen();
                $return[] = $this->getMessageLastDeliveryDate();
                $return[] = $this->getMessageImpsAmountDelivery();
                $return[] = $this->getMessagePresentDone();
                break;
            case self::STATE_IN_PROGRESS:
                $return[] = $this->getMessageId();
                $return[] = $this->getMessageState();
                $return[] = $this->getMessageImpsAmountDelivery();
                $return[] = $this->getMessagePresentDone();
                break;
            case self::STATE_UNPUBLISHED:
                $return[] = $this->getMessageId();
                $return[] = $this->getMessageState();
                $return[] = $this->getMessageLastDeliveryDate();
                $return[] = $this->getMessagePublishedAt();
                break;
            case self::STATE_SUCCESS:
                $return[] = $this->getMessageId();
                $return[] = $this->getMessageState();
                break;
            case self::STATE_FAILED:
                $return[] = $this->getMessageId();
                $return[] = $this->getMessageState();
                $return[] = $this->getMessageLastDeliveryDate();
                $return[] = $this->getMessagePresentDone();
                break;
        }

        foreach($return as $key => $value) {
            $return[$key] = '<span class="badge">' . $value . '</span>';
        }

        return implode(' ', $return);
    }

    public static function getColorClassesByState($state) {
        return 'text-wish-' . $state . ' bg-wish-' . $state;
    }

    public function getCardColorClasses() {
        return self::getColorClassesByState($this->state);
    }

    public function toHtml() {
        return $this->id;
    }

    public function updateState() {
        $state = DB::select('SELECT calculate_wish_state(:id) AS calculated_state', ['id' => $this->id]);
        $new_state = $state[0]->calculated_state;

        $temp = $this->getEventDispatcher();
        $this->unsetEventDispatcher();

        $this->state = $new_state;
        $this->save();

        $this->setEventDispatcher($temp);
    }

    public function getStateIcon() {
        $extra = '';

        switch ($this->state) {
            case self::STATE_OPEN:
                $class = 'voyager-wand';
                break;
            case self::STATE_IN_PROGRESS:
                $class = 'voyager-refresh';
                break;
            case self::STATE_UNPUBLISHED:
                $class = 'voyager-pause';
                break;
            case self::STATE_SUCCESS:
                $class = 'voyager-smile';
                break;
            case self::STATE_FAILED:
                $class = 'voyager-frown';
                break;
        }

        return '<div class="panel-wish-teaser"><i class="' . $class . ' big-icon"></i>' . self::getStateName($this->state) . '</div>';
    }

    public function isPublished() {
        if (empty($this->published_at)) {
            return false;
        }

        return $this->published_at->lessThan(Carbon::now());
    }
}
