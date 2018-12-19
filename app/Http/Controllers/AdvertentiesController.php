<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class AdvertentiesController extends Controller
{
    public function index() {
        $advertenties = \App\Advertentie::all();

        // load the view and pass the advertenties
        return \View::make('advertenties.index')
          ->with('advertenties', $advertenties);

        }

        public function create() {
            return \View::make('advertenties.create');  
        }

        public function store() {
            // store new user
            $advertenties = new \App\Advertentie;
            $advertenties->datum                = Input::get('created_at');
            $advertenties->img                  = Input::get('image');
            $advertenties->titel                = Input::get('titel');
            $advertenties->omschrijving         = Input::get('omschrijving');
            $advertenties->naamVerkoper         = Input::get('NaamVerkoper');
            $advertenties->vraagprijs           = Input::get('vraagprijs');
            $advertenties->categorie            = Input::get('category');
            $advertenties->save();
    
            // redirect
            return \Redirect::to('advertenties');
        }
    }
    
