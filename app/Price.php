<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Price
 *
 * @property int $id
 * @property string $name
 * @property string $file
 * @property string $url
 * @property int $size
 * @property \Carbon\Carbon $m_date
 * @method static \Illuminate\Database\Query\Builder|\App\Price whereFile($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Price whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Price whereMDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Price whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Price whereSize($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Price whereUrl($value)
 * @mixin \Eloquent
 * @property string $description
 * @method static \Illuminate\Database\Query\Builder|\App\Price whereDescription($value)
 */
class Price extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    protected $dates = ['m_date'];


    public function getSizeAttribute($value)
    {
        return round($value / 1024 / 1024, 2);
    }
}
