<?php

namespace Packages\Infrastructure\Eloquents\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = null;

    protected $primaryKey = 'user_id';
    protected $fillable = [
        'email',
        'password',
    ];
}
