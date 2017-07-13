<?php

namespace App\Http\Controllers;

use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\Article;
use Carbon\Carbon;
use App\Categoria;
use App\Tag;
use App\Image;
use Illuminate\Support\Facades\DB;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Validator;
use App\User;
use Illuminate\Support\Facades\Input;
use Laracasts\Flash\Flash;


class FrontController extends Controller
{
    public function __construct()
    {
        Carbon::setLocale('es');
    }

    public function index(Request $request)
    {
        /*$articles = Article::orderBy('id', 'DESC')
            ->paginate(4);*/

        $articles = Article::search($request->title)->orderBy('id', 'DESC')->paginate(4);

        $articles->each(function ($articles) {
            $articles->category;
            $articles->images;
        });

        return view('front.index')
            ->with('articles', $articles);
    }


    public function searchCategory($name)
    {
        $category = Categoria::Search($name)->first();
        $articles = $category->articles()->paginate(4);

        $articles->each(function ($articles) {
            $articles->category;
            $articles->image;
        });

        return view('front.index')
            ->with('articles', $articles);
    }


    public function searchTag($tag)
    {
        $tag = Tag::Search($tag)->first();
        $articles = $tag->articles()->paginate(4);

        $articles->each(function ($articles) {
            $articles->category;
            $articles->image;
        });

        return view('front.index')
            ->with('articles', $articles);
    }


    public function viewContent($id){
        $content = DB::table('articles')
            ->join('users', 'articles.user_id', '=', 'users.id')
            ->join('images', 'articles.id', '=', 'images.article_id')
            ->select('articles.title', 'articles.content', 'users.nick', 'images.name')
            ->where('articles.id', '=', $id)
            ->get();

        return view('front.content')
            ->with('content', $content);
    }


    public function viewArticle($slug){
        $article = Article::findBySlugOrFail($slug);
        $article->category;
        $article->user;
        $article->tags;
        $article->images;

        return view('front.article')
            ->with('article', $article);
    }


    public function showLogin(){
        return view('auth.login');
    }

    public function registerUser(Request $request){
        if ($request->isMethod('POST')){
            $reglas = [
                'name'     =>  'required|min:5|max:120|regex:/^[a-záéíóúäëïöüñÁÉÍÓÚÑ\s]+$/i',
                'email'    =>  'required|max:50|min:5|unique:users,email|email',
                'password' =>  'required|min:8|max:20|confirmed',
                'nick'     =>  'required|min:3|max:30|unique:users,nick',
            ];

            $mensaje = [
                'name.required'       =>  'El Campo Nombre Es Obligatorio',
                'name.min'            =>  'El Mínimo De Caracteres Permitidos Es De 5',
                'name.max'            =>  'El Número De Caracteres Excede Al Permitido',
                'name.regex'          =>  'El Nombre Únicamente Debe Contener Letras',

                'email.required'      =>  'El Campo Email Es Obligatorio',
                'email.max'           =>  'Este Correo Es Demasiado Largo',
                'email.min'           =>  'El Correo Es Demasiado Corto',
                'email.unique'        =>  'Este Correo Ya Existe',
                'email.email'         =>  'El Formato Del Correo Es Incorrecto',

                'password.required'   =>  'Contraseña Es Obligatoria',
                'password.min'        =>  'La Contraseña Debe Tener Al Menos 8 Caracteres',
                'password.max'        =>  'La Contraseña No Debe Contener Más De 20 Caracteres',
                'password.confirmed'  =>  'Las Contraseñas Ingresadas No Coinciden',

                'nick.required'       =>  'El Nickname Es Requerido',
                'nick.min'            =>  'Nickname Demasiado Corto',
                'nick.max'            =>  'Número De Caracteres Excedidos',
                'nick.unique'         =>  'Este Nickname Ya Está En Uso',
            ];
            
            $validator = Validator::make($request->all(), $reglas, $mensaje);

            if($validator->fails()){
                flash('El Formulario Presenta Errores', 'danger')->important();
                return redirect()->route('front.index')->withErrors($validator);
            }else{
                $user = new User($request->all());
                $user->password = bcrypt($request->password);
                $user->save();

                flash($user->name.' Bienvenid@ A Searitos Blog', 'info')->important();
                return redirect()->route('front.index');
            }
        }
    }

}
