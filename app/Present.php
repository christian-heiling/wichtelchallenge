<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class Present extends Model
{
    const STATE_DELIVERY = 'delivery';
    const STATE_REJECTED = 'rejected';
    const STATE_DONE = 'done';

    protected $dates = [ 'due_date' ];

    protected $fillable = [ 'wish_id' ];

    public $additional_attributes = ['display'];

    protected static function boot()
    {
        parent::boot();

        if (Auth::user()) {
              if (Auth::user()->role->name == 'institution') {
                    static::addGlobalScope('institution', function (Builder $builder) {
                    $wish_ids = Wish::where('created_from_user_id', '=', Auth::user()->id)->pluck('id');
                    $builder->whereIn('wish_id', $wish_ids);
                });
            }

            if (Auth::user()->role->name == 'imp') {
                static::addGlobalScope('imp', function (Builder $builder) {
                    $builder->where('from_user_id', '=', Auth::user()->id);
                });
            }
        }
    }

    public function wish() {
        return $this->belongsTo('App\Wish');
    }

    public function fromUser() {
        return $this->belongsTo('App\User');
    }

    public function messages() {
        return $this->hasMany('App\Message')->orderBy('created_at');
    }

    public static function getAvailableStates() {
        return [
            self::STATE_DELIVERY,
            self::STATE_REJECTED,
            self::STATE_DONE
        ];
    }

    public static function getStateName($state)
    {
        switch ($state) {
            case self::STATE_DELIVERY:
                return 'wird geliefert';
                break;
            case self::STATE_REJECTED:
                return 'abgebrochen';
                break;
            case self::STATE_DONE:
                return 'wurde geliefert';
                break;
        }
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

    private function getMessageLastDeliveryDate() {
        return 'letzter Abgabetermin ' . $this->due_date->diffForHumans();
    }


    public function getMessageId() {
        return '#WWC-' . $this->wish_id . '-' . $this->id;
    }

    public function getMessageState() {
        return self::getStateName($this->state);
    }

    public function getDisplayAttribute() {
        $return = [];

        switch ($this->state) {
            case self::STATE_DELIVERY:
                $return[] = $this->getMessageStuff();
                $return[] = $this->getMessageState();
                $return[] = $this->getMessageLastDeliveryDate();
                break;
            case self::STATE_REJECTED:
                $return[] = $this->getMessageStuff();
                $return[] = $this->getMessageState();
                break;
            case self::STATE_DONE:
                $return[] = $this->getMessageStuff();
                $return[] = $this->getMessageState();
                break;
        }

        return implode(' - ', $return);
    }

    public function getMessageStuff() {
        return '#WWC-' . $this->wish->id . '-' . $this->id . ' ' . $this->amount . 'x ' . $this->wish->title . ' von ' . $this->fromUser->name;
    }

    public static function getColorClassesByState($state) {
        return 'text-present-' . $state . ' bg-present-' . $state;
    }

    public function getCardColorClasses() {
        return self::getColorClassesByState($this->state);
    }

    public function toHtml() {
        return $this->id;
    }
}
