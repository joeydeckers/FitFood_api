<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Validator;

use App\Recipe;

class RecipesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::all();

        return $recipes;
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
       $rules = [
         'recipe_name' => 'required',
         'recipe_ingredients' => 'required',
         'recipe_calories' => 'required',
         'recipe_protein' => 'required',
         'recipe_carbs' => 'required',
         'recipe_fat' => 'required',
         'recipe_category' => 'required',
         'recipe_description' => 'required',
         'recipe_people' => 'required',
         'recipe_image' => 'required|image|max:400000',
         'recipe_owner_id' => 'required'
       ];

       $validator = Validator::make($request->all(), $rules);

       if($validator->fails()){
           return response()->json($validator->errors());
       }
        

        $filename = $request->file('recipe_image')->getClientOriginalName();
        $extension = File::extension($filename);
        $newName = md5($filename.time());
        $path = $request->file('recipe_image')->move(public_path("/upload"), $newName.".".$extension);
        $imageUrl = "http://127.0.0.1:8000/upload/".$newName.".".$extension;

        return Recipe::create([
            'recipe_name' => $request['recipe_name'],
            'recipe_ingredients' => $request['recipe_ingredients'],
            'recipe_calories' => $request['recipe_calories'],
            'recipe_protein' => $request['recipe_protein'],
            'recipe_carbs' => $request['recipe_carbs'],
            'recipe_fat' => $request['recipe_fat'],
            'recipe_category' => $request['recipe_category'],
            'recipe_description' => $request['recipe_description'],
            'recipe_people' => $request['recipe_people'],
            'recipe_image' => $imageUrl,
            'recipe_owner_id' => $request['recipe_owner_id']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recipe = Recipe::find($id);    

        if(!$recipe){
            return "Oh no!";
        }else{
            return $recipe;
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
    public function update(Request $request)
    {

        // validate schrijven


        $id = $request['id'];
        $recipe_owner_id = $request['recipe_owner_id'];
        $recipe = Recipe::find($id);
        if($recipe['recipe_owner_id'] == $recipe_owner_id){

            if($request->file('recipe_image')){
                $filename = $request->file('recipe_image')->getClientOriginalName();
                $extension = File::extension($filename);
                $newName = md5($filename.time());
                $path = $request->file('recipe_image')->move(public_path("/upload"), $newName.".".$extension);
                $imageUrl = "http://127.0.0.1:8000/upload/".$newName.".".$extension;
            }

            $recipe->update($request->all());
            $recipe->recipe_image = $imageUrl;
            return response()->json([
                'Message' => 'Recipe changed!',
                'Recipe' => $recipe
            ], 200);
        }else{
            return response()->json([
                'message' => "You don't have access to this recipe"
            ], 400);
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id){
        $owner_id = $request['owner_id'];
        $recipe = Recipe::find($id);

        if($recipe['recipe_owner_id'] == $owner_id){
            $recipe->delete();

            return 'Recipe deleted';
        }
        
        return 'Error!';
    }
}
