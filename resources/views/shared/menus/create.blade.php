@if ($item['submenu'] == [])
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
@endif