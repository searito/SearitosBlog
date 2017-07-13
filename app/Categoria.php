<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = "categorias";
    protected $fillable = ['name'];

    public function articles(){
        return $this->hasMany('App\Article', 'category_id', 'id');
    }

    public function scopeSearch($query, $name){
        return $query->where('name', 'LIKE', "%$name%");
    }
}
