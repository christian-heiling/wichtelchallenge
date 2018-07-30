<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class Message extends Model
{
    protected static function boot()
    {
        parent::boot();

        if (Auth::user()) {
            if (Auth::user()->role->name == 'institution') {
                static::addGlobalScope('institution', function (Builder $builder) {
                    $wish_ids = Wish::where('created_from_user_id', '=', Auth::user()->id)->pluck('id');
                    $present_ids = Present::whereIn('wish_id', $wish_ids)->pluck('id');

                    $builder->whereIn('present_id', $present_ids);
                });
            }

            if (Auth::user()->role->name == 'imp') {
                static::addGlobalScope('imp', function (Builder $builder) {
                    $present_ids = Present::where('from_user_id', '=', Auth::user()->id)->pluck('id');
                    $builder->whereIn('present_id', $present_ids);
                });
            }
        }
    }

    public function fromUser() {
        return $this->belongsTo('App\User');
    }

    public function wish() {
        return $this->belongsTo('App\Wish');
    }

    public function toHtml() {
        return '<p>' . $this->fromUser->toHtml(false) . ' ' . $this->created_at->diffForHumans() . ':<br><em>"' . $this->content . '"</p>';
    }
}
