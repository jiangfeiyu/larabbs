<?php
/**
 * Copyright (C) 2018 Baidu, Inc. All Rights Reserved.
 */

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class User extends Authenticatable
{
    use Notifiable {
        notify as protected laravelNotify;
    }

    public function notify($instance)
    {
        if ($this->id == Auth::id()) {
            return;
        }
        $this->increment('notification_count');
        $this->laravelNotify($instance);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }

    public function isAuthorOf($model)
    {
        return $this->id == $model->user_id;
    }
}
