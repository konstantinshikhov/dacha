<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResets extends Model {
    protected $primaryKey = 'email';
    protected $table = 'password_resets';
}