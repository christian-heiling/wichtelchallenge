<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class Institution extends Model
{
    protected $fillable = [
        'name',
        'description',
        'area_of_activity',
        'image_url'
    ];

    protected static function boot()
    {
        parent::boot();

        if (Auth::user()) {
            if (Auth::user()->role->name == 'institution') {
                static::addGlobalScope('institution', function (Builder $builder) {
                    $builder->where('id', '=', Auth::user()->institution_id);
                });
            }
        }
    }

    public function locations() {
        return $this->hasMany('App\Location');
    }

    public static function availableAreaOfActivities() {
        return [
            'Kinder, Jugend, Familie',
            'Alte Menschen',
            'Materielle Grundsicherung',
            'Gesundheit',
            'Straffälligkeit',
            'Beruf und Bildung',
            'Migration und Integration',
            'Gemeinwesenarbeit'
        ];
    }

    public static function availableQuestions() {
        return [
            'Mit welchen Problemen sind deine Klient*innen konfrontiert?',
            'Wie werden deine Klient*innen in deiner Einrichtung unterstützt?',
            'Wie wird Weihnachten in deiner Einrichtung gefeiert?'
        ];
    }

    public static function getOptions() {
        $institutions = Institution::orderBy('name')->get();

        $return = array('' => '');
        foreach ($institutions as $inst) {
            $return[$inst->id] = $inst->name;
        }

        return $return;
    }

    public function toHtml() {
        return $this->name;
    }
}
