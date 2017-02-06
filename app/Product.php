<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Product
 *
 * @property int $id
 * @property string $1c_id
 * @property int $category_id
 * @property string $title
 * @property string $body
 * @property string $image
 * @property float $price_1
 * @property float $price_2
 * @property float $price_3
 * @property float $quantity
 * @property float $weight
 * @property string $unit
 * @property bool $sort
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Product where1cId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product wherePrice1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product wherePrice2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product wherePrice3($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereSort($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereUnit($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereWeight($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    protected $guarded = [];

    //
}
