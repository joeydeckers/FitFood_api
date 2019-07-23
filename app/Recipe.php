<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'recipe_name', 'recipe_ingredients', 'recipe_calories', 'recipe_protein', 'recipe_carbs', 'recipe_fat', 'recipe_category', 'recipe_description', 'recipe_image', 'recipe_people', 'recipe_image', 'recipe_owner_id'
    ];
}
