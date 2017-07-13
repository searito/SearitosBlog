<?php

namespace App\Http\Controllers;

use Activity; //    MOSTRAR USUARIOS EN LINEA KIM/ACTIVITY
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Khill\Lavacharts\Lavacharts;  //    GRAFICOS
use App\Categoria;
use Illuminate\Http\Request;
use App\Article;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\User;
use Laracasts\Flash\Flash;
use Validator;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        Carbon::setLocale('es');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::usersByMinutes(10)->get();

        $articles = Article::all();
        $last5 = Article::orderBy('id', 'DESC')->paginate(10);
        $tags = Tag::all();
        $categories = Categoria::all();
        $articles->each(function ($articles) {
            $articles->category;
            $articles->user;
        });

        $lava = new Lavacharts;
        $publications = $lava->DataTable();

        $begining = Carbon::now()->startOfMonth();
        $begining = $begining->format('Y-m-d');

        $today = Carbon::now();
        $today = $today->format('Y-m-d');

        $publications->addDateColumn('Día Del Mes')
            ->addNumberColumn('Número De Comentarios');

        /*  SELECT id, title, COUNT(DATE(created_at)) AS 'PUBLICACIONES_DIARIAS', created_at FROM articles GROUP BY DATE(created_at)    */

        $query = DB::table('articles')
            ->select(DB::raw('COUNT(DATE(created_at)) as publicationsNumber, DATE(created_at) as Fecha'))
            //->whereBetween('created_at', array($begining, $today))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get();

        //dd($query);

        foreach ($query as $datos) {
            $publications->addRow([$datos->Fecha, $datos->publicationsNumber]);

        }

        $lava->AreaChart('Publications', $publications, [
            'title' => 'Publicaciones Diarias',
            'legend' => [
                'position' => 'out'
            ]
        ]);


        return view('admin.home.home')
            ->with('articles', $articles)
            ->with('categories', $categories)
            ->with('tags', $tags)
            ->with('lastfive', $last5)
            ->with('activities', $activities)
            ->with('lava', $lava);
    }


    public function profile(){
        $user = User::find(Auth::user()->id);

        $memberSince = Auth::user()->created_at;
        $memberSince = $memberSince->format('d-m-Y');

        $publications = DB::table('articles')
            //->select('title', 'created_at')
            ->select(DB::raw('id, title, content, DATE(created_at) as fecha'))
            ->where('user_id', '=', Auth::user()->id)
            ->orderBy('id', 'DESC')
            ->get();

        //dd($publications);

        return view('admin.home.profile')
            ->with('user', $user)
            ->with('publications', $publications)
            ->with('memberSince', $memberSince);

    }


    public function updateInfo(Request $request, $id){
        if ($request->isMethod('POST')){
            $reglas = [
                'name'  =>  'required|min:5|max:120|regex:/^[a-záéíóúäëïöüñÁÉÍÓÚÑ\s]+$/i',
                'email' =>  'required|max:50|min:5',
                'nick'  =>  'required|min:3|max:30',
                'image' =>  'image|max:1024*1024*1',
            ];

            $mensajes = [
                'name.required'  =>  'El Campo Nombre Es Obligatorio',
                'name.min'       =>  'El Mínimo De Caracteres Permitidos Es De 5',
                'name.max'       =>  'El Número De Caracteres Excede Al Permitido',
                'name.regex'     =>  'El Nombre Únicamente Debe Contener Letras',

                'email.required' =>  'El Campo Email Es Obligatorio',
                'email.max'      =>  'Este Correo Es Demasiado Largo',
                'email.min'      =>  'El Correo Es Demasiado Corto',
                'email.email'    =>  'El Formato Del Correo Es Incorrecto',

                'nick.required'  =>  'El Nickname Es Requerido',
                'nick.min'       =>  'Nickname Demasiado Corto',
                'nick.max'       =>  'Número De Caracteres Excedidos',

                'image.image'    =>  'El Formato De La Imagen No Es Permitido',
                'image.max'      =>  'Imagen Demasiado Grande',
            ];

            $validator = Validator::make($request->all(), $reglas, $mensajes);

            if ($validator->fails()){
                flash('El Formulario Presenta Errores', 'danger')->important();

                return redirect()->route('admin.profile')->withErrors($validator);
            }else{
                if (Input::hasFile('image')){
                    $imgname = str_random(30).'-'.$request->file('image')->getClientOriginalName();

                    $cadena = $imgname;
                    $cadena = preg_replace('[\s+]', '-', $cadena); //QUITA LOS ESPACIOS EN BLANCO EN EL NOMBRE DEL ARCHIVO

                    $request->file('image')->move('img/avatars', $cadena);

                    $user = User::find($id);
                    $user->fill($request->all());
                    $user->save();

                    $user->where('id', '=', $user->id)
                        ->update(['imgprofile' => 'img/avatars/'.$cadena]);

                    flash('Los Datos De '. $user->name .' Se Han Actualizado.', 'info')->important();
                    return redirect()->route('admin.profile');
                }else{
                    $user = User::find($id);
                    $user->fill($request->all());
                    $user->save();

                    flash('Los Datos De '. $user->name .' Se Han Actualizado.', 'info')->important();
                    return redirect()->route('admin.profile');
                }
            }
        }
    }


    public function changePass(Request $request){
        if ($request->isMethod('POST')){
            $reglas = [
                'oldpass'   => 'required|min:8|max:20',
                'password'  => 'required|min:8|max:20|confirmed',
            ];

            $mensajes = [
                'oldpass.required'   =>  'El Campo Es Obligatorio',
                'oldpass.min'        =>  'La Contraseña Debe Tener 8 Caracteres Como Mínimo',
                'oldpass.max'        =>  'Contraseña Demasiado Larga',

                'password.required'  =>  'El Campo Es Obligatorio',
                'password.min'       =>  'La Contraseña Debe Tener 8 Caracteres Como Mínimo',
                'password.max'       =>  'Contraseña Demasiado Larga',
                'password.confirmed' =>  'Las Contraseñas No Coinciden',
            ];

            $validator = Validator::make($request->all(), $reglas, $mensajes);

            if ($validator->fails()){
                flash('El Formulario Presenta Errores', 'danger')->important();
                return redirect()->route('admin.profile')->withErrors($validator);
            }else{
                if (Hash::check($request->oldpass, Auth::user()->password)){

                   $user = User::find(Auth::user()->id);
                   $user->where('id', '=', $user->id)
                       ->update(['password' => bcrypt($request->password)]);

                    flash('Contraseña De '. Auth::user()->name. ' Ha Sido Actualizada.', 'info')->important();
                    return redirect()->route('admin.profile');
                }else{
                    flash('Ha Ocurrido Un Error Al Cambiar La Contraseña De '. Auth::user()->name, 'danger')->important();
                    return redirect()->route('admin.profile');
                }
            }
        }
    }
}
