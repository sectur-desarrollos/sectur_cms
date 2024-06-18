@if ($item['submenu'] == [])
    <option value="{{$item['id']}}" @if ($menuData->parent === $item['id'] || old('parent') === $item['id']) selected @endif>{{$item['name']}}</option>
@else
    <option value="{{$item['id']}}" @if ($menuData->parent === $item['id'] || old('parent') === $item['id']) selected @endif>{{$item['name']}}</option>
    @foreach ($item['submenu'] as $submenu)
        @if ($submenu['submenu'] == [])
            <option value="{{$submenu['id']}}" @if ($menuData->parent === $submenu['id'] || old('parent') === $item['id']) selected @endif>&nbsp;&nbsp;&nbsp;&nbsp;-{{$submenu['name']}}</option>
        @else
            @include('shared.menu-test', ['item' => $submenu])
        @endif
    @endforeach
@endif