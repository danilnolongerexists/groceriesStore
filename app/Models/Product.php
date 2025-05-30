<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Orchid\Attachment\Models\Attachment;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Product extends Model
{

    use HasFactory, AsSource, Attachable, Filterable;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category_id',
        'event_id'
    ];

        /**
     * Name of columns to which http sorting can be applied
     *
     * @var array
     */
    protected $allowedSorts = [
        'title',
        'created_at',
        'updated_at'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
