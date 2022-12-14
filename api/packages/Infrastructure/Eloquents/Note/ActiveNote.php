<?php

namespace Packages\Infrastructure\Eloquents\Note;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveNote extends Model
{
    use HasFactory;

    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = null;

    protected $primaryKey = 'note_id';
    protected $fillable = [
        'body',
        'title',
        'user_id',
        'note_id',
    ];
}
