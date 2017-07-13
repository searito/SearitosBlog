<?php

namespace App\Http\Controllers;

#use Dotenv\Validator;
use Illuminate\Http\Request;
use App\Categoria;
use Laracasts\Flash\Flash;
use Validator;

class CategoriesController extends Controller
{
    public function index(Request $request){
        $category = Categoria::search($request->name)->orderBy('id', 'ASC')->paginate(10);
        return view('admin.categories.index')->with('categories', $category);
    }


    public function create(){
        return view('admin.categories.create');
    }


    public function store(Request $request){
        if ($request->isMethod('POST')){
            $reglas = ['name' => 'required|max:120|unique:categorias,name'];

            $mensaje = [
                'name.required' => 'El Campo Es Obligatorio',
                'name.max' => 'Número De Caracteres Excedidos',
                'name.unique' => 'Esta Categoría Ya Existe',
            ];

            $validator = Validator::make($request->all(), $reglas, $mensaje);

            if ($validator->fails()){
                flash('Este Formulario Presenta Errores', 'danger')->important();

                return redirect()->route('categories.create')->withErrors($validator);
            }else{
                $category = new Categoria($request->all());
                $category->save();
                flash('La Categoría '.$category->name.' Ha Sido Agregada Exitosamente.', 'info')->important();
                return redirect()->route('categories.index');
            }
        }
    }


    public function edit($id){
        $category = Categoria::find($id);
        return view('admin.categories.edit')->with('category', $category);
    }


    public function update(Request $request, $id){
        $category = Categoria::find($id);
        $category->fill($request->all());
        $category->save();

        flash('Se Ha Modificado La Categoría '.$category->name.' Ha Sido Modificada Exitosamente.', 'info')->important();
        return redirect()->route('categories.index');
    }


    public function destroy($id){
        $category = Categoria::find($id);
        $category->delete();
        flash('La Categoría '.$category->name.' Ha Sido Eliminada.', 'info')->important();
        return redirect()->route('categories.index');
    }
}
