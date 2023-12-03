<?php

namespace App\Http\Modules\Posts\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Base\Models\BaseModel;

class Post extends BaseModel
{
    use HasFactory;

    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id', 'title', 'details'];

    public static function getAllowedFilters(): array
    {
        return [
            AllowedFilter::exact('id'),
            AllowedFilter::exact('title'),
            AllowedFilter::exact('details'),
        ];
    }


    public static function getDefaultSort()
    {
        return '-created_at';
    }

}
