<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;


class ImageController extends Controller
{
    public function index(){
        #$images = Image::all()->paginate(5);
        $images = Image::orderBy('id', 'ASC')->paginate(12);
        $images->each(function($images){
            $images->article;
        });

        //http://www.ajaxshake.com/plugin/ES/961/b0926a71/grilla-de-imagenes-arrastrables-draggable-images.html

        return view('admin.images.index')->with('images', $images);
    }
}
