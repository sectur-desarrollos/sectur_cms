@if ($item['submenu'] == [])
{{-- Este es para una opción del link con enlace externo--}}
{{-- <li><a class="nav-link" href="https://{{ $item['enlace'] }}" >{{ $item['name'] }}</a></li> --}}
{{-- Esta es para una opción del link con una página interna --}}
{{-- <li><a class="nav-link" href="{{ route('pagina', $item['nombre_pagina']) }}" >{{ $item['name'] }}</a></li> --}}
{{-- Opción del menú donde se compare si es link ó si es enlace --}}
<li class="nav-item"><a class="nav-link" id="{{$item['id']}}" @if($item['enlace']) href="https://{{ $item['enlace'] }}" @elseif($item['nombre_pagina']) href="{{ route('pagina', $item['nombre_pagina']) }}" @else href="#" @endif target="{{$item['target']}}">{{ $item['name'] }}</a></li>
@else
<li class="nav-item {{-- dropdown --}}">

    <a class="nav-link {{-- dropdown-toggle --}}" id="{{$item['id']}}" @if($item['enlace']) href="https://{{ $item['enlace'] }}" @elseif($item['nombre_pagina']) href="{{ route('pagina', $item['nombre_pagina']) }}" @else href="#" @endif {{-- data-bs-toggle="dropdown" --}} target="{{$item['target']}}">{{ $item['name'] }} <span class="caret"></span></a>

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

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
<script>
    $(document).ready(function () {
        let menuSelectId;
        let _token = $('meta[name="csrf-token"]').attr('content');
        // $('li.nav-item a').click(function () { 
        $('.nav-item .nav-link').click(function () { 

            menuSelectId = $(this).attr("id");

            $.ajax({
                type: "POST",
                url: "{{route('menuSessionSelectId')}}",
                data: {
                    _token: _token,
                    menuSelectId: menuSelectId,
                },
                // success: function (response) {
                //     console.log(response);
                // }
            });
        });
    });
</script>