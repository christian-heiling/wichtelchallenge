<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class Location extends Model
{
    protected static function boot()
    {
        parent::boot();

        if (Auth::user()) {
            if (Auth::user()->role->name == 'institution') {
                static::addGlobalScope('institution', function (Builder $builder) {
                    $builder->where('institution_id', '=', Auth::user()->institution_id);
                });
            }
        }
    }

    public function institution() {
        return $this->belongsTo('App\Institution');
    }

    public function openingHours() {
        return $this->hasMany('App\OpeningHour')->orderByRaw('opening_hours.weekday, opening_hours.from');
    }

    public function getOpeningHoursHtml() {
        $lastWeekday = null;
        $lines = [];
        $line = '';

        foreach($this->openingHours as $openingHours) {
            // add the line before
            if ($lastWeekday != $openingHours->weekday && !empty($lastWeekday)) {
                $lines[] = $line;
            }

            if($lastWeekday == $openingHours->weekday) {
                $line .= ' und ' . $openingHours->from . ' - ' . $openingHours->to;
            } else {
                $line = $this->getWeekdayName($openingHours->weekday) . ': ' . $openingHours->from . ' - ' . $openingHours->to;
            }

            $lastWeekday = $openingHours->weekday;
        }
        $lines[] = $line;

        return implode('<br>', $lines);
    }

    private function getWeekdayName($weekday) {
        $weekday_names = [
            'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa', 'So'
        ];

        return $weekday_names[$weekday];
    }

    public function toHtml() {
        return '<p>' . $this->name . ', ' . $this->zip . ' ' . $this->city . ' (' . $this->institution->name . ')' . '</p>';
    }

    public function getOpeningHoursAsHtml() {
        $openingHours = OpeningHour::where('location_id', '=', $this->id)->orderBy('weekday')->orderBy('from')->get();

        $return = [];
        foreach($openingHours as $openingHour) {
            if (empty($return[$openingHour->weekday])) {
                $return[$openingHour->weekday] = $this->getWeekdayName($openingHour->weekday). ': ' . $openingHour->from . '-' . $openingHour->to;
            } else {
                $return[$openingHour->weekday] .= ' und ' . $openingHour->from . '-' . $openingHour->to;
            }
        }

        $return = '<p>' . implode('<br>', $return) . '</p>';

        if ($openingHour->open_on_public_holidays) {
            $return .= '<p>An Feiertagen geöffnet.</p>';
        } else {
            $return .= '<p>An Feiertagen geschlossen.</p>';
        }

        return $return;
    }
}
