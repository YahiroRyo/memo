<?php

namespace Packages\Infrastructure\Eloquents;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonActiveNote extends Model
{
    use HasFactory;

    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = null;

    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'note_id',
        'body',
        'title',
    ];
}
