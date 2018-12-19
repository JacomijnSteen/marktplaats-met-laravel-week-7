<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index() {
        $categories = \App\Category::all();

        // load the view and pass the advertenties
        return \View::make('categories.index')
          ->with('categories', $categories);

        }

        public function create() {
            return \View::make('categories.create');  
        }

        public function store() {
            // store new user
            $categories = new \App\Category;
            $categories->datum                = Input::get('created_at');
            $categories->name                 = Input::get('name');
            $categories->advertentie_id       = Input::get('advertentie_id');
            $categories->save();
    
            // redirect
            return \Redirect::to('advertenties');
        }
    
    

}
