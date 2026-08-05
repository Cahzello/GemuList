<?php

namespace App\Models;

use Database\Factories\GamePriceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GamePrice extends Model
{
    /** @use HasFactory<GamePriceFactory> */
    use HasFactory;

    protected $table = 'game_prices';

    protected $primaryKey = 'id_gamePrice';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_game',
        'id_store',
        'price',
        'retailPrice',
    ];

    /**
     * Get the game for this price record.
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class, 'id_game', 'id_game');
    }

    /**
     * Get the store for this price record.
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'id_store', 'id_store');
    }
}
