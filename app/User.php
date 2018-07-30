<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    public $additional_attributes = ['display'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function institution() {
        return $this->belongsTo('App\Institution');
    }

    public function getDisplayAttribute() {
        return $this->name . ' (' . $this->role->name . ')';
    }

    public function toHtml($withp = true) {
        $role = $this->role->name;

        if ($role === 'admin') {
            $return = $this->name . '&nbsp;(Wiener Wichtel Challenge)';
        }

        if ($role === 'institution') {
            $return = $this->name . '&nbsp;(' . $this->institution->name . ')';
        } else {
            $return = $this->name;
        }

        if ($withp)
            return '<p>' . $return . '</p>';
        else
            return $return;
    }
}
