<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Importante
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    // Campos que se pueden completar masivamente
    protected $fillable = [
        'name', 'email', 'password',
    ];

    // Ocultar la contraseña por seguridad
    protected $hidden = [
        'password', 'remember_token',
    ];
}
