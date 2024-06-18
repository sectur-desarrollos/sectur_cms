{{-- @if ($item['submenu'] == [])
    <option value="{{$item['id']}}" {{ old('parent') == $item['id'] ? 'selected' : '' }}>{{$item['name']}}</option>
@else
    <option value="{{$item['id']}}" {{ old('parent') == $item['id'] ? 'selected' : '' }}>{{$item['name']}}</option>
    @foreach ($item['submenu'] as $submenu)
        @if ($submenu['submenu'] == [])
            <option value="{{$submenu['id']}}" {{ old('parent') == $submenu['id'] ? 'selected' : '' }}>&nbsp;&nbsp;&nbsp;&nbsp;-{{$submenu['name']}}</option>
        @else
            @include('shared.menu-test', ['item' => $submenu])
        @endif
    @endforeach
@endif --}}

@if ($item['submenu'] == [])
{{-- Este es para una opción del link con enlace externo--}}
{{-- <li><a class="nav-link" href="https://{{ $item['enlace'] }}" >{{ $item['name'] }}</a></li> --}}
{{-- Esta es para una opción del link con una página interna --}}
{{-- <li><a class="nav-link" href="{{ route('pagina', $item['nombre_pagina']) }}" >{{ $item['name'] }}</a></li> --}}
{{-- Opción del menú donde se compare si es link ó si es enlace --}}
<li><a class="nav-link" @if($item['enlace']) href="https://{{ $item['enlace'] }}" @elseif($item['nombre_pagina']) href="{{ route('pagina', $item['nombre_pagina']) }}" @else href="#" @endif target="{{$item['target']}}">{{ $item['name'] }}</a></li>
@else
<li class="nav-item {{-- dropdown --}}">

    <a class="nav-link {{-- dropdown-toggle --}}" @if($item['enlace']) href="https://{{ $item['enlace'] }}" @elseif($item['nombre_pagina']) href="{{ route('pagina', $item['nombre_pagina']) }}" @else href="#" @endif {{-- data-bs-toggle="dropdown" --}} target="{{$item['target']}}">{{ $item['name'] }} <span class="caret"></span></a>

    {{-- <ul class="dropdown-menu">
        @foreach ($item['submenu'] as $submenu)
            @if ($submenu['submenu'] == [])
                <li>
                    <a class="dropdown-item" @if($submenu['enlace']) href="https://{{ $submenu['enlace'] }}" @elseif($submenu['nombre_pagina']) href="{{ route('pagina', $submenu['nombre_pagina']) }}" @else href="#" @endif target="{{$submenu['target']}}">{{ $submenu['name'] }} <span class="caret"></span></a>
                </li>
            @else
                @include('shared.navbar', [ 'item' => $submenu ])
            @endif
        @endforeach
    </ul> --}}
</li>
@endif
{{-- @if (Route::has('login'))
    @auth
        <li><a href="{{ route('dashboard') }}" class="nav-link" >Inicio</a></li>
    @else
        <li><a href="{{ route('login') }}" class="nav-link" >Iniciar Sesión</a></li>
    @endauth
@endif --}}