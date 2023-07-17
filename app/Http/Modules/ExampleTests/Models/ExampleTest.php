<?php

namespace App\Http\Modules\ExampleTests\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Base\Models\BaseModel;

class ExampleTest extends BaseModel
{
    use HasFactory;

    protected $table = 'example_tests';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id', 'name', 'email', 'password'];

    public static function getAllowedFilters(): array
    {
        return [
            AllowedFilter::exact('id'),
            AllowedFilter::exact('name'),
            AllowedFilter::exact('email'),
            AllowedFilter::exact('password'),
        ];
    }


    public static function getDefaultSort()
    {
        return '-created_at';
    }

}
