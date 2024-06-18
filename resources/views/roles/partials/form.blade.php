<div class="mb-3">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', null, ['class' => 'form-control' ]) !!}
    @error('name')
    <small class="text-danger">{{$message}}</small>
    @enderror
</div>
<div class="mb-3">
    <h4 class="h5">Lista de permisos</h4>
    @foreach ($permissions as $permission)
        <div>
            <label for="">
                {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'mr-1']) !!}
                {{$permission->description}}
            </label>
        </div>
    @endforeach
</div>
<div class="mb-3">
    <div>
        {{-- @foreach ($paginas as $pagina) --}}
            {{-- {!! Form::select('paginas[]', $paginas, null, ['class' => 'form-select']) !!} --}}
            {{-- {!! Form::select('paginas[]', $paginas, null, ['class' => 'form-control', 'id' => 'pagina-search', 'multiple' => 'multiple']) !!} --}}
            {{-- <select class="js-example-basic-multiple" name="states[]" multiple="multiple">
                <option value="AL">Alabama</option>
                <option value="WY">Wyoming</option>
            </select> --}}
            {{Form::label('paginas', 'Paginas que puede acceder')}}
            <br>
            {{-- {{ Form::select('paginas[]', $paginas, null, ['id' => 'paginas', 'multiple' => 'multiple', 'class' => 'form-select']) }} --}}
            {!! Form::select('paginas[]', $paginas, null, ['id' => 'paginas', 'multiple' => 'multiple', 'class' => 'form-select']) !!}
        {{-- @endforeach --}} 
    </div>
</div>