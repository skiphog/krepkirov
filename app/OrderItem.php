<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\OrderItem
 *
 * @property int $id
 * @property int $order_id
 * @property string $id_1c
 * @property string $name
 * @property float $price
 * @property string $unit
 * @property float $quantity
 * @property float $sum
 * @property-read \App\Order $order
 * @method static \Illuminate\Database\Query\Builder|\App\OrderItem where1cId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderItem whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderItem whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderItem whereOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderItem wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderItem whereQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderItem whereSum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderItem whereUnit($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Query\Builder|\App\OrderItem whereId1c($value)
 */
class OrderItem extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
