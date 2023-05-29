<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\AllowedFilter;

class Example extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'image',
    ];


    public static function getAllowedFilters(): array
    {
        return [
            AllowedFilter::exact('business_type'),
            AllowedFilter::exact('plan_type'),
            AllowedFilter::scope('service_type', 'filterServiceTypes'),
            'address',
            AllowedFilter::scope('area_id', 'areaId'),
        ];
    }
}
