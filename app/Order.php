<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Order
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property int $quantity
 * @property float $sum
 * @property bool $status
 * @property string $name
 * @property string $email
 * @property string $organization
 * @property string $phone
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereOrganization($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereSum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereUserId($value)
 * @property string $note
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\OrderItem[] $orderItems
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereNote($value)
 * @property int $positions
 * @property float $weight
 * @method static \Illuminate\Database\Query\Builder|\App\Order wherePositions($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereWeight($value)
 */
class Order extends Model
{
    protected $guarded = [];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
