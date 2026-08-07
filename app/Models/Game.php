<?php

namespace App\Models;

use Database\Factories\GameFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    /** @use HasFactory<GameFactory> */
    use HasFactory;

    protected $primaryKey = 'id_game';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'game_name',
        'thumbnail',
        'steam_appid',
    ];

    /**
     * Get the user library records for this game.
     */
    public function myGames(): HasMany
    {
        return $this->hasMany(MyGame::class, 'id_game', 'id_game');
    }

    /**
     * Get the price records for this game.
     */
    public function gamePrices(): HasMany
    {
        return $this->hasMany(GamePrice::class, 'id_game', 'id_game');
    }
}
