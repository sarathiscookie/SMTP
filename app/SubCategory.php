<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Set the subcategory name.
     *
     * @param  string  $value
     * @return void
     */
    public function setSubCategoryNameAttribute($value)
    {
        $this->attributes['subcategory_name'] = strtolower($value);
    }

    /**
    * Get the subcategory name.
    *
    * @param  string  $value
    * @return string
    */
    public function getSubCategoryNameAttribute($value)
    {
        return ucwords($value);
    }

    /**
    * Get the matching products
    */
    public function products()
    {
        return $this->hasMany('App\Product', 'subcategory_id');
    }
}
