<?php

declare(strict_types=1);

namespace Laracon\Order\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laracon\Order\Infrastructure\Database\Factories\CartItemFactory;

class CartItem extends Model
{
    use HasFactory;

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return CartItemFactory::new();
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }
}
