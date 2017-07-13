<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use  Laracasts\Flash\Flash;
use Validator;

class TagsController extends Controller
{
    public function index(Request $request){
        $tag = Tag::search($request->name)->orderBy('id', 'ASC')->paginate(10);
        return view('admin.tags.index')->with('tags', $tag);
    }


    public  function create(){
        return view('admin.tags.create');
    }


    public function store(Request $request){
        if ($request->isMethod('POST')){
            $reglas = ['name' => 'required|max:120|unique:tags,name'];

            $mensaje = [
                'name.required' => 'Este Campo Es Obligatorio',
                'name.max' => 'Número De Caracteres Excedidos',
                'name.unique' => 'Este Tag Ya Ha Sido Creado',
            ];

            $validator = Validator::make($request->all(), $reglas, $mensaje);

            if ($validator->fails()){
                flash('El Formulario Pesentó Errores...', 'danger')->important();

                return redirect()->route('tags.create')->withErrors($validator);
            }else{
                $tag = new Tag($request->all());
                $tag->save();

                flash('El Tag '.$tag->name.' Ha Sido Almacenado Exitosamente', 'info')->important();
                return redirect()->route('tags.index');
            }
        }
    }


    public function edit($id){
        $tag = Tag::find($id);
        return view('admin.tags.edit')->with('tag', $tag);
    }


    public function update(Request $request, $id){
        $tag = Tag::find($id);
        $tag->fill($request->all());
        $tag->save();

        flash('Se Ha Modificado El Tag '.$tag->name.' Exitosamente...', 'info')->important();
        return redirect()->route('tags.index');
    }


    public function destroy($id){
        $tag = Tag::find($id);
        $tag->delete();

        flash('El Tag '.$tag->name.' Ha Sido Eliminado...', 'info')->important();
        return redirect()->route('tags.index');
    }
}
