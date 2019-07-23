<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

use App\Recipe;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return $categories;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Category::create([
            'category_name' => $request['category_name'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $categoryName
     * @return \Illuminate\Http\Response
     */
    public function showCategoryItems($categoryName)
    {

        $category = Category::where('category_name', $categoryName)->get();

        if(empty($category)){
            return 'Category not fond';
        }else{
            $catName = $category[0]->category_name;

            $recipes = Recipe::where('recpipe_category', $catName)->get();
    
            return $recipes;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
