<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
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
    public function setProductNameAttribute($value)
    {
        $this->attributes['product_name'] = strtolower($value);
    }

    /**
    * Get the category name.
    *
    * @param  string  $value
    * @return string
    */
    public function getProductNameAttribute($value)
    {
        return ucwords($value);
    }
}
