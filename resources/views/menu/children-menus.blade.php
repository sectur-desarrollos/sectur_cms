{{-- <li id="{{$children_menu->pagina_id}}">{{$children_menu->name}}</li> --}}
<li id="{{$children_menu->pagina_id}}">
    <a style="text-decoration: none;" @if($children_menu->enlace) href="https://{{ $children_menu->enlace }}" @elseif($children_menu->nombre_pagina) href="{{ route('pagina', $children_menu->nombre_pagina) }}" @else href="#" @endif {{-- data-bs-toggle="dropdown" --}} target="{{$children_menu->target}}">{{$children_menu->name}} <span class="caret"></span></a>    
</li>
@if ($children_menu->menuss)
    <ul>
        @foreach ($children_menu->menuss as $children_menu)
            @include('menu.children-menus', ['children_menu' => $children_menu])
        @endforeach
    </ul>
@endif