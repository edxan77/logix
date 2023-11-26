<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileReset extends Model
{
    const RESET_TYPE_EMAIL = 'email';
    const RESET_TYPE_PASSWORD = 'password';
    const TOKEN_STATUS_VALID = 'valid';
    const TOKEN_STATUS_EXPIRED = 'expired';

    protected $fillable = [
        'user_id',
        'type',
        'email',
        'token',
        'code',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
}
