<?php

namespace App\Http\Requests;

use Dotenv\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(CategoryRequest $request)
    {
        #return [
            //
        #];

        if ($request->isMethod('POST')){
            $reglas = ['name' => 'required|max:120|unique:categorias',];

            $mensaje = [
                'name.required' => 'Este Campo Es Obligatorio',
                'name.max' => 'El Número Máximo De Caracteres Es De 120',
                'name.unique' => 'Esta Categoría Ya Existe',
            ];

            $validator = Validator::make($request->all(), $reglas, $mensaje);

            if ($validator->fails()){
                flash('El Formulario Presenta Errores De Validación', 'danger')->important();
            }
        }
    }
}
