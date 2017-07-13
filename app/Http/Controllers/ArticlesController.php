<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Article;
use App\Categoria;
use App\Tag;
use App\Image;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Validator;

class ArticlesController extends Controller
{
    public function index(Request $request){
        $articles = Article::search($request->title)->orderBy('id', 'DESC')->paginate(10);
        $articles->each(function($articles){
            $articles->category;
            $articles->user;
        });

        $categories = Categoria::orderBy('name', 'ASC')->pluck('name', 'id');
        $tags = Tag::orderBy('name', 'ASC')->pluck('name', 'id'); #ASI SE HACE PARA EXTRAER LOS DATOS DE UNA TABLA Y PASARLOS A UN SELECT
        $myTags = $tags = Tag::orderBy('name', 'ASC')->pluck('name', 'id');


        /* -------------------- GENERANDO DATOS PARA USUARIO MEMBER ------------------------------------------------- */

        $userPost = DB::table('articles')
            ->join('categorias', 'categorias.id', '=', 'articles.category_id')
            ->select('articles.*', 'categorias.name')
            ->where('user_id', '=', Auth::user()->id)
            ->orderBy('id', 'DESC')
            ->paginate(10);

        //dd($userPost);

        return view('admin.articles.index')
            ->with('articles', $articles)
            ->with('categories', $categories)
            ->with('tags', $tags)
            ->with('myTags', $myTags)
            ->with('userPost', $userPost);
    }


    public function create(){
        $categories = Categoria::orderBy('name', 'ASC')->pluck('name', 'id');
        $tags = Tag::orderBy('name', 'ASC')->pluck('name', 'id'); #ASI SE HACE PARA EXTRAER LOS DATOS DE UNA TABLA Y PASARLOS A UN SELECT

        return view('admin.articles.create')
            ->with('categories', $categories)
            ->with('tags', $tags);
    }


    public function store(Request $request){
       if ($request->isMethod('POST')) {
           $reglas = [
               'title' => 'required|min:5|max:250|unique:articles,title',
               'content' => 'required|min:305|max:1500',
               'image' => 'required|image',
           ];

           $mensaje = [
               'title.required' => 'Este Campo Es Obligatorio',
               'title.min' => 'Muy Pocos Caracteres',
               'title.max' => 'Número De Caracteres Excedidos',
               'title.unique' => 'Este Título Ya Está En Uso',

               'content.required' => 'El Artículo Debe Tener Contenido',
               'content.min' => 'El Contenido Debe Tener Al Menos 350 Caracteres',
               'content.max' => 'Número De Caracteres Excedidos',

               'image.required' => 'La Imagen Es Requerida',
               'image.image' => 'Debes Insertar Una Imagen'
           ];

           $validator = Validator::make($request->all(), $reglas, $mensaje);

           if ($validator->fails()) {
               flash('El Formulario Presentó Errores...', 'danger')->important();
               return redirect()->route('articles.index')->withErrors($validator);
           } else {

               if ($request->file('image')) {
                   /** MANIPULACION DE IMAGENES **/
                   $file = $request->file('image');
                   $name = 'searitosblog_' . str_random(15) . '.' . $file->getClientOriginalExtension();
                   $path = public_path() . '\img\articles';
                   $file->move($path, $name);
               }

               $article = new Article($request->all());
               $article->user_id = \Auth::user()->id;
               $article->save();

               #UNA VEZ GUARDADO EL ART RELLENAR LA TABLA PIVOTE(article_tag)
               $article->tags()->sync($request->tags); #ESTE taggs() ES EL METODO DECLARADO EN EL MODELO

               $image = new Image();
               $image->name = $name;
               $image->article()->associate($article); #OBTENIENDO EL ID DEL ART CREADO
               $image->save();

               flash('Artículo ' . $article->title . '... Ha Sido Creado Exitosamente...', 'info')->important();
               return redirect()->route('articles.index');
           }
       }
    }


    public function edit($id){
        $article = Article::find($id);
        $article->category;

        $categories = Categoria::orderBy('name', 'ASC')->pluck('name', 'id');
        $tags = Tag::orderBy('name', 'ASC')->pluck('name', 'id');

        $myTags = $article->tags->pluck('id')->ToArray();

        return view('admin.articles.edit')
            ->with('categories', $categories)
            ->with('article', $article)
            ->with('tags', $tags)
            ->with('myTags', $myTags);

    }


    public function update(Request $request, $id){
        $article = Article::find($id);
        $article->fill($request->all());
        $article->save();

        $article->tags()->sync($request->tags);

        flash($article->title.' Ha Sido Actualizado...', 'info')->important();
        return redirect()->route('articles.index');
    }


    public function destroy($id){
        $article = Article::find($id);
        $article->delete();

        flash('Se Ha Borrado El Artículo - '.$article->title.' Correctamente...', 'info')->important();
        return redirect()->route('articles.index');
    }
}
