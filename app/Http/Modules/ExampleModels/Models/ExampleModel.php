<?php

namespace App\Http\Modules\ExampleModels\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Base\Models\BaseModel;

class ExampleModel extends BaseModel
{
    use HasFactory;

    protected $table = 'example_models';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id', 'name'];

    public static function getAllowedFilters(): array
    {
        return [
            AllowedFilter::exact('id'),
            AllowedFilter::exact('name'),
        ];
    }


    public static function getDefaultSort()
    {
        return '-created_at';
    }

}
