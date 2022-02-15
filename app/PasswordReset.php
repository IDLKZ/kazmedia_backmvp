<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $email
 * @property string $token
 * @property string $created_at
 */
class PasswordReset extends Model
{
    /**
     * @var array
     */
    public $timestamps = false;
    protected $fillable = ['email', 'token', 'created_at'];

}
