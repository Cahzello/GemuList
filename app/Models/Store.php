<?php

namespace App\Models;

use Database\Factories\StoreFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Store extends Model
{
    /** @use HasFactory<StoreFactory> */
    use HasFactory;

    protected $primaryKey = 'id_store';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'store_name',
        'banner',
        'logo',
        'icon',
    ];

    /**
     * Get the price records for this store.
     */
    public function gamePrices(): HasMany
    {
        return $this->hasMany(GamePrice::class, 'id_store', 'id_store');
    }
}
