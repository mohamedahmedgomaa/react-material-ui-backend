<?php

namespace App\Http\Modules\ExampleCommands\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Base\Models\BaseModel;

class ExampleCommand extends BaseModel
{
    use HasFactory;

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
