<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','user_name', 'address', 'contact', 'email', 'engaged_college', 'teaching_faculty', 'teaching_program', 'citizenship', 'teacher_card', 'profile_picture', 'available_balance', 'verification', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function posts(){
        return $this->hasMany('App\Post');
    }
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function likes(){
        return $this->hasMany('App\Like');
    }
}
