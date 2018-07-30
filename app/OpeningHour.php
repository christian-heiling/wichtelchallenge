<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class OpeningHour extends Model
{
    protected static function boot()
    {
        parent::boot();

        if (Auth::user()) {
            if (Auth::user()->role->name == 'institution') {
                static::addGlobalScope('institution', function (Builder $builder) {
                    $location_ids = Location::where('institution_id', '=', Auth::user()->institution_id)->pluck('id');
                    $builder->whereIn('location_id', $location_ids);
                });
            }
        }
    }

    public function location() {
        return $this->belongsTo('App\Location');
    }

    public function getFromAttribute($value) {
        return substr($value, 0, 5);
    }

    public function getToAttribute($value) {
        return substr($value, 0, 5);
    }

    public function toHtml() {
        echo self::getNameOfWeekday($this->weekday) . ': ' . $this->from . ' - ' . $this->to;
    }

    public static function getNameOfWeekday($weekday) {
        switch ($weekday) {
            case 0: return 'Mo';
            case 1: return 'Di';
            case 2: return 'Mi';
            case 3: return 'Do';
            case 4: return 'Fr';
            case 5: return 'Sa';
            case 6: return 'So';
        }

        return '';
    }
}
