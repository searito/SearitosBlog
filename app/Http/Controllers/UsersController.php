<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Laracasts\Flash\Flash;
use App\Http\Requests\UserRequest;
use Validator;
use Illuminate\Support\Facades\Input;

class UsersController extends Controller
{
    public function create(){
        return view('admin.users.create');
    }


    public  function store(Request $request){

        if ($request->isMethod('POST')){
            $reglas = [
                'name' => 'required|min:5|max:120|regex:/^[a-záéíóúäëïöüñÁÉÍÓÚÑ\s]+$/i',
                'email' => 'required|max:50|min:5|unique:users,email|email',
                'password' => 'required|min:8|max:20',
                'nick' => 'required|min:3|max:30|unique:users,nick',
            ];

            $mensaje = [
                'name.required' => 'El Campo Nombre Es Obligatorio',
                'name.min' => 'El Mínimo De Caracteres Permitidos Es De 5',
                'name.max' => 'El Número De Caracteres Excede Al Permitido',
                'name.regex' => 'El Nombre Únicamente Debe Contener Letras',

                'email.required' => 'El Campo Email Es Obligatorio',
                'email.max' => 'Este Correo Es Demasiado Largo',
                'email.min' => 'El Correo Es Demasiado Corto',
                'email.unique' => 'Este Correo Ya Existe',
                'email.email' => 'El Formato Del Correo Es Incorrecto',

                'password.required' => 'Contraseña Es Obligatoria',
                'password.min' => 'La Contraseña Debe Tener Al Menos 8 Caracteres',
                'password.max' => 'La Contraseña No Debe Contener Más De 20 Caracteres',

                'nick.required' => 'El Nickname Es Requerido',
                'nick.min' => 'Nickname Demasiado Corto',
                'nick.max' => 'Número De Caracteres Excedidos',
                'nick.unique' => 'Este Nickname Ya Está En Uso',
            ];

            $validator = Validator::make($request->all(), $reglas, $mensaje);

            if ($validator->fails()){
                flash('El Formulario Presenta Errores', 'danger')->important();

                return redirect()->route('users.index')->withErrors($validator);
            }else{
                $user = new User($request->all());
                $user->password = bcrypt($request->password);
                $user->save();

                flash('Se Ha Agregado A '.$user->name.' Exitosamente.', 'info')->important();

                return redirect()->route('users.index');
            }
        }

    }


    public function index(Request $request){
        $users = User::search($request->name)->orderBy('type', 'DESC')->paginate(8);

        return view('admin.users.index')->with('users', $users);
    }


    public function destroy($id){
        $user = User::find($id);
        $user->delete();

        flash('Se Eliminado A '.$user->name.' Exitosamente.', 'info')->important();

        return redirect()->route('users.index');
    }


    public function edit($id){
        $user = User::find($id);

        return view('admin.users.edit')->with('users', $user);
    }


    public function update(Request $request, $id){
        /**$user = User::find($id);
        $user = new User;**/

        $reglas = ['image' => 'image|max:1024*1024*1',];

        $mensaje = [
            'image.image' => 'El Formato De La Imagen No Es Permitido',
            'image.max' => 'Imagen Demasiado Grande',
        ];

        $validator = Validator::make($request->all(), $reglas, $mensaje);

        if ($validator->fails()) {
            flash('El Formulario Presenta Errores', 'danger')->important();
            #return redirect()->route(['users.edit', $user->id])->withErrors($validator);
            return redirect()->back()->withErrors($validator);
        } else {
            if (Input::hasFile('image')) {
                $nameimg = str_random(30) . '-' . $request->file('image')->getClientOriginalName();

                $noSpacesName = $nameimg;
                $noSpacesName = preg_replace('[\s+]', '-', $nameimg); //QUITA LOS ESPACIOS EN BLANCO EN EL NOMBRE DEL ARCHIVO

                $request->file('image')->move('img/avatars', $noSpacesName);

                $user = User::find($id);
                $user->fill($request->all());
                $user->save();

                $user->where('id', '=', $user->id)
                    ->update(['imgprofile' => 'img/avatars/'.$noSpacesName]);

                flash('Los Datos De ' . $user->name . ' Se Han Actualizado Exitósamente', 'info')->important();
                return redirect()->route('users.index');
            } else {
                $user = User::find($id);
                $user->fill($request->all());
                $user->save();

                flash('Los Datos De ' . $user->name . ' Se Han Actualizado Exitósamente', 'info')->important();
                return redirect()->route('users.index');
            }
        }
    }
}