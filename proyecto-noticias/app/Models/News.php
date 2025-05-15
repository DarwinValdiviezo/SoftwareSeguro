<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    /**
     * Las columnas que se pueden asignar masivamente.
     *
     * @var array<int,string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'content',
    ];

    /**
     * Cada noticia pertenece a un usuario (quien la creó).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
