<?php

namespace App\Models;

use Database\Factories\MyGameFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MyGame extends Model
{
    /** @use HasFactory<MyGameFactory> */
    use HasFactory;

    protected $table = 'my_games';

    protected $primaryKey = 'id_myGame';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_game',
        'status',
        'score',
        'review',
        'added_date',
    ];

    /**
     * Get the user that owns this library record.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /**
     * Get the game for this library record.
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class, 'id_game', 'id_game');
    }
}
