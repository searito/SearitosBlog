<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Categoria;
use App\Tag;

class AsideComposer
{
    public function compose(View $view){
        $categories = Categoria::orderBy('name', 'ASC')->get();
        $tags = Tag::orderBy('name', 'ASC')->get();

        $view->with('categories', $categories)
            ->with('tags', $tags);
    }
}