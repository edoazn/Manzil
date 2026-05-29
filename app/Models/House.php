<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;

class House extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'thumbnail', 'certificate', 'about', 'price', 'bedroom',
        'bathroom', 'electric', 'land_area', 'building_area', 'category_id', 'city_id',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function photos()
    {
        return $this->hasMany(HousePhoto::class);
    }

    public function interest()
    {
        return $this->hasMany(Interest::class);
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'house_facilities', 'house_id', 'facility_id')
            ->withTimestamps();
    }
    public function mortgateRequest(){

        return $this->hasMany(MortgageRequest::class);
    }
}
