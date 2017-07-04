<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Cart
 *
 * @property int $id
 * @property string $cookie_id
 * @property int $product_id
 * @property float $qty
 * @property float $weight
 * @property float $total_sum
 * @method static \Illuminate\Database\Query\Builder|\App\Cart whereCookieId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cart whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cart whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cart whereQty($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cart whereTotalSum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cart whereWeight($value)
 * @mixin \Eloquent
 */
class Cart extends Model
{
    protected $guarded = [];

    public $timestamps = false;

}
