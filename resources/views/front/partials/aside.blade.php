<div class="panel-primary">
    <div class="panel-heading">
        <h4 class="text-center">Categorías</h4>
    </div>
</div>

<div class="list-group">
    @foreach($categories as $cat)
        <li class="list-group-item">
            <i class="fa fa-caret-right" aria-hidden="true"></i>

            <a href="{{ route('front.search.category', $cat->name) }}" class="">
                &nbsp; {{ $cat->name }}
            </a>

            <span class="badge">{{ $cat->articles->count() }}</span>
        </li>
    @endforeach
</div>


<div class="panel-primary">
    <div class="panel-heading">
        <h4 class="text-center">Tags</h4>
    </div>
</div>
<div class="panel-body">
    @foreach($tags as $tag)
        <span class="label label-primary text-justify">
            <a href="{{ route('front.search.tag', $tag->name) }}" class="text-white">
                {{ $tag->name }}
            </a>
        </span>

        <span>&nbsp;</span>
    @endforeach
</div>