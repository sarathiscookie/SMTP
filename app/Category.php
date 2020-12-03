<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Set the category name.
     *
     * @param  string  $value
     * @return void
     */
    public function setCategoryNameAttribute($value)
    {
        $this->attributes['category_name'] = strtolower($value);
    }

    /**
    * Get the category name.
    *
    * @param  string  $value
    * @return string
    */
    public function getCategoryNameAttribute($value)
    {
        return ucwords($value);
    }

    /**
    * Get the matching subcategories
    */
    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    /**
    * Get the matching subcategories
    */
    public function products()
    {
        return $this->belongsToMany('App\SubCategory', 'products', 'category_id', 'subcategory_id');
    }
    
}
