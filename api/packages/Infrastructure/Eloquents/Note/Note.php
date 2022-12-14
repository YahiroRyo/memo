<?php

namespace Packages\Infrastructure\Eloquents\Note;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = null;

    protected $keyType = 'string';
    protected $primaryKey = 'note_id';
    protected $fillable = [
    ];
}
