@switch($log->log_name)
    @case('Página')
            @if ($evento == 'created')
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                            Atributos creados
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                            @foreach ($propiedades as $propiedad)
                                <form class="row g-3">
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">ID</label>
                                        <input type="email" class="form-control w-25" id="id" value="{{$propiedad['id']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputPassword4" class="form-label">Titulo</label>
                                        <input type="text" class="form-control" id="titulo" value="{{$propiedad['titulo']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputPassword4" class="form-label">Slug</label>
                                        <input type="text" class="form-control" id="titulo" value="{{$propiedad['slug']}}" readonly>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputAddress" class="form-label">Imagen destacada</label>
                                        <input type="text" class="form-control" id="imagen" value="{{$propiedad['imagen_destacada']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputZip" class="form-label">Estado de la imagen destacada</label>
                                        <input type="text" class="form-control w-25" id="tamaño-imagen" value="{{$propiedad['imagen_principal_estado']}}" readonly>
                                    </div>
                                    <div class="col-12"></div>
                                    <div class="col-md-2">
                                        <label for="inputZip" class="form-label">Tipo de página</label>
                                        <input type="text" class="form-control" id="tipo-página" value="{{$propiedad['tipo_pagina']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">Estado de la página</label>
                                        <input type="text" class="form-control w-25" id="estado" value="{{$propiedad['estado']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">Creación</label>
                                        <input type="text" class="form-control" id="fecha-creado" value="{{$propiedad['created_at']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">Actualizado</label>
                                        <input type="text" class="form-control" id="fecha-actualizado" value="{{$propiedad['updated_at']}}" readonly>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            @if ($evento == 'updated')
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                Atributos actualizados
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body">
                                    <form class="row g-3">
                                        <div class="col-md-6">
                                            <label for="inputEmail4" class="form-label">ID</label>
                                            <input type="email" class="form-control w-25" id="id" value="{{$propiedadesActualizadas['id']}}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputPassword4" class="form-label">Titulo</label>
                                            <input type="text" class="form-control" id="titulo" value="{{$propiedadesActualizadas['titulo']}}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputPassword4" class="form-label">Slug</label>
                                            <input type="text" class="form-control" id="titulo" value="{{$propiedadesActualizadas['slug']}}" readonly>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputAddress" class="form-label">Imagen destacada</label>
                                            <input type="text" class="form-control" id="imagen" value="{{$propiedadesActualizadas['imagen_destacada']}}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputZip" class="form-label">Estado de la imagen destacada</label>
                                            <input type="text" class="form-control w-25" id="tamaño-imagen" value="{{$propiedadesActualizadas['imagen_principal_estado']}}" readonly>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputZip" class="form-label">Contenido</label>
                                            <textarea class="form-control" name="contenido" id="contenido" cols="30" rows="10" readonly>{!!$propiedadesActualizadas['contenido']!!}</textarea>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="inputZip" class="form-label">Tipo de página</label>
                                            <input type="text" class="form-control" id="tipo-página" value="{{$propiedadesActualizadas['tipo_pagina']}}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCity" class="form-label">Estado de la página</label>
                                            <input type="text" class="form-control w-25" id="estado" value="{{$propiedadesActualizadas['estado']}}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCity" class="form-label">Creación</label>
                                            <input type="text" class="form-control" id="fecha-creado" value="{{$propiedadesActualizadas['created_at']}}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCity" class="form-label">Actualizado</label>
                                            <input type="text" class="form-control" id="fecha-actualizado" value="{{$propiedadesActualizadas['updated_at']}}" readonly>
                                        </div>
                                    </form>
                            </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                            Atributos antiguos
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                            <form class="row g-3">
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">ID</label>
                                    <input type="email" class="form-control w-25" id="id" value="{{$propiedadesAntiguas['id']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Titulo</label>
                                    <input type="text" class="form-control" id="titulo" value="{{$propiedadesAntiguas['titulo']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Slug</label>
                                    <input type="text" class="form-control" id="titulo" value="{{$propiedadesAntiguas['slug']}}" readonly>
                                </div>
                                <div class="col-12">
                                    <label for="inputAddress" class="form-label">Imagen destacada</label>
                                    <input type="text" class="form-control" id="imagen" value="{{$propiedadesAntiguas['imagen_destacada']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputZip" class="form-label">Estado de la imagen destacada</label>
                                    <input type="text" class="form-control w-25" id="tamaño-imagen" value="{{$propiedadesAntiguas['imagen_principal_estado']}}" readonly>
                                </div>
                                <div class="col-12">
                                    <label for="inputZip" class="form-label">Contenido</label>
                                    <textarea class="form-control" name="contenido" id="contenido" cols="30" rows="10" readonly>{!!$propiedadesAntiguas['contenido']!!}</textarea>
                                </div>
                                <div class="col-md-2">
                                    <label for="inputZip" class="form-label">Tipo de página</label>
                                    <input type="text" class="form-control" id="tipo-página" value="{{$propiedadesAntiguas['tipo_pagina']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Estado de la página</label>
                                    <input type="text" class="form-control w-25" id="estado" value="{{$propiedadesAntiguas['estado']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Creación</label>
                                    <input type="text" class="form-control" id="fecha-creado" value="{{$propiedadesAntiguas['created_at']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Actualizado</label>
                                    <input type="text" class="form-control" id="fecha-actualizado" value="{{$propiedadesAntiguas['updated_at']}}" readonly>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            @if ($evento == 'deleted')
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                            Atributos creados
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                                <form class="row g-3">
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">ID</label>
                                        <input type="email" class="form-control w-25" id="id" value="{{$propiedadesEliminadas['id']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputPassword4" class="form-label">Titulo</label>
                                        <input type="text" class="form-control" id="titulo" value="{{$propiedadesEliminadas['titulo']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputPassword4" class="form-label">Slug</label>
                                        <input type="text" class="form-control" id="titulo" value="{{$propiedadesEliminadas['slug']}}" readonly>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputAddress" class="form-label">Imagen destacada</label>
                                        <input type="text" class="form-control" id="imagen" value="{{$propiedadesEliminadas['imagen_destacada']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputZip" class="form-label">Estado de la imagen destacada</label>
                                        <input type="text" class="form-control w-25" id="tamaño-imagen" value="{{$propiedadesEliminadas['imagen_principal_estado']}}" readonly>
                                    </div>
                                    <div class="col-12"></div>
                                    <div class="col-md-2">
                                        <label for="inputZip" class="form-label">Tipo de página</label>
                                        <input type="text" class="form-control" id="tipo-página" value="{{$propiedadesEliminadas['tipo_pagina']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">Estado de la página</label>
                                        <input type="text" class="form-control w-25" id="estado" value="{{$propiedadesEliminadas['estado']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">Creación</label>
                                        <input type="text" class="form-control" id="fecha-creado" value="{{$propiedadesEliminadas['created_at']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">Actualizado</label>
                                        <input type="text" class="form-control" id="fecha-actualizado" value="{{$propiedadesEliminadas['updated_at']}}" readonly>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            @endif
        @break
    @case('Archivo')
            @if ($evento == 'created')
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                            Atributos creados
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                            @foreach ($propiedades as $propiedad)
                                <form class="row g-3">
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">ID</label>
                                        <input type="email" class="form-control w-25" id="id" value="{{$propiedad['id']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputPassword4" class="form-label">Titulo</label>
                                        <input type="text" class="form-control" id="titulo" value="{{$propiedad['titulo']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputPassword4" class="form-label">Descripción</label>
                                        <input type="text" class="form-control" id="titulo" value="{{$propiedad['descripcion']}}" readonly>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputAddress" class="form-label">Imagen</label>
                                        <input type="text" class="form-control" id="imagen" value="{{$propiedad['imagen']}}" readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="inputZip" class="form-label">Tamaño</label>
                                        <input type="text" class="form-control" id="tamaño-imagen" value="{{$propiedad['size_imagen']}}" readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="inputZip" class="form-label">Tipo</label>
                                        <input type="text" class="form-control" id="tipo-imagen" value="{{$propiedad['type_imagen']}}" readonly>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputAddress2" class="form-label">Documento</label>
                                        <input type="text" class="form-control" id="documento" value="{{$propiedad['documento']}}" readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="inputZip" class="form-label">Tamaño</label>
                                        <input type="text" class="form-control" id="tamaño-documento" value="{{$propiedad['size_documento']}}" readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="inputZip" class="form-label">Tipo</label>
                                        <input type="text" class="form-control" id="tipo-documento" value="{{$propiedad['type_documento']}}" readonly>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputAddress2" class="form-label">Enlace</label>
                                        <input type="text" class="form-control" id="enlace" value="{{$propiedad['enlace']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">Estado</label>
                                        <input type="text" class="form-control w-25" id="estado" value="{{$propiedad['estado']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">Página que pertenece</label>
                                        <input type="text" class="form-control w-50" id="estado" value="{{$pagina}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">Creación</label>
                                        <input type="text" class="form-control" id="estado" value="{{$propiedad['created_at']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">Actualizado</label>
                                        <input type="text" class="form-control" id="estado" value="{{$propiedad['updated_at']}}" readonly>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            @if ($evento == 'updated')
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                Atributos actualizados
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body">
                                @foreach ($propiedades as $propiedad)
                                    <form class="row g-3">
                                        <div class="col-md-6">
                                            <label for="inputEmail4" class="form-label">ID</label>
                                            <input type="email" class="form-control w-25" id="id" value="{{$propiedad['id']}}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputPassword4" class="form-label">Titulo</label>
                                            <input type="text" class="form-control" id="titulo" value="{{$propiedad['titulo']}}" readonly>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="inputPassword4" class="form-label">Descripción</label>
                                            <input type="text" class="form-control" id="titulo" value="{{$propiedad['descripcion']}}" readonly>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputAddress" class="form-label">Imagen</label>
                                            <input type="text" class="form-control" id="imagen" value="{{$propiedad['imagen']}}" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="inputZip" class="form-label">Tamaño</label>
                                            <input type="text" class="form-control" id="tamaño-imagen" value="{{$propiedad['size_imagen']}}" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="inputZip" class="form-label">Tipo</label>
                                            <input type="text" class="form-control" id="tipo-imagen" value="{{$propiedad['type_imagen']}}" readonly>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputAddress2" class="form-label">Documento</label>
                                            <input type="text" class="form-control" id="documento" value="{{$propiedad['documento']}}" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="inputZip" class="form-label">Tamaño</label>
                                            <input type="text" class="form-control" id="tamaño-documento" value="{{$propiedad['size_documento']}}" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="inputZip" class="form-label">Tipo</label>
                                            <input type="text" class="form-control" id="tipo-documento" value="{{$propiedad['type_documento']}}" readonly>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputAddress2" class="form-label">Enlace</label>
                                            <input type="text" class="form-control" id="enlace" value="{{$propiedad['enlace']}}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCity" class="form-label">Estado</label>
                                            <input type="text" class="form-control w-25" id="estado" value="{{$propiedad['estado']}}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCity" class="form-label">Página que pertenece</label>
                                            <input type="text" class="form-control w-50" id="estado" value="{{$pagina}}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCity" class="form-label">Creación</label>
                                            <input type="text" class="form-control" id="estado" value="{{$propiedad['created_at']}}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCity" class="form-label">Actualizado</label>
                                            <input type="text" class="form-control" id="estado" value="{{$propiedad['updated_at']}}" readonly>
                                        </div>
                                    </form>
                                @endforeach
                            </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                            Atributos antiguos
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                            <form class="row g-3">
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">ID</label>
                                    <input type="email" class="form-control w-25" id="id" value="{{$propiedadesAntiguas['id']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Titulo</label>
                                    <input type="text" class="form-control" id="titulo" value="{{$propiedadesAntiguas['titulo']}}" readonly>
                                </div>
                                <div class="col-md-12">
                                    <label for="inputPassword4" class="form-label">Descripción</label>
                                    <input type="text" class="form-control" id="titulo" value="{{$propiedadesAntiguas['descripcion']}}" readonly>
                                </div>
                                <div class="col-12">
                                    <label for="inputAddress" class="form-label">Imagen</label>
                                    <input type="text" class="form-control" id="imagen" value="{{$propiedadesAntiguas['imagen']}}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="inputZip" class="form-label">Tamaño</label>
                                    <input type="text" class="form-control" id="tamaño-imagen" value="{{$propiedadesAntiguas['size_imagen']}}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="inputZip" class="form-label">Tipo</label>
                                    <input type="text" class="form-control" id="tipo-imagen" value="{{$propiedadesAntiguas['type_imagen']}}" readonly>
                                </div>
                                <div class="col-12">
                                    <label for="inputAddress2" class="form-label">Documento</label>
                                    <input type="text" class="form-control" id="documento" value="{{$propiedadesAntiguas['documento']}}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="inputZip" class="form-label">Tamaño</label>
                                    <input type="text" class="form-control" id="tamaño-documento" value="{{$propiedadesAntiguas['size_documento']}}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="inputZip" class="form-label">Tipo</label>
                                    <input type="text" class="form-control" id="tipo-documento" value="{{$propiedadesAntiguas['type_documento']}}" readonly>
                                </div>
                                <div class="col-12">
                                    <label for="inputAddress2" class="form-label">Enlace</label>
                                    <input type="text" class="form-control" id="enlace" value="{{$propiedadesAntiguas['enlace']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Estado</label>
                                    <input type="text" class="form-control w-25" id="estado" value="{{$propiedadesAntiguas['estado']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Página que pertenece</label>
                                    <input type="text" class="form-control w-50" id="estado" value="{{$pagina}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Creación</label>
                                    <input type="text" class="form-control" id="estado" value="{{$propiedadesAntiguas['created_at']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Actualizado</label>
                                    <input type="text" class="form-control" id="estado" value="{{$propiedadesAntiguas['updated_at']}}" readonly>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            @if ($evento == 'deleted')
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                            Atributos eliminados
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                            <form class="row g-3">
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">ID</label>
                                    <input type="email" class="form-control w-25" id="id" value="{{$propiedadesEliminadas['id']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Titulo</label>
                                    <input type="text" class="form-control" id="titulo" value="{{$propiedadesEliminadas['titulo']}}" readonly>
                                </div>
                                <div class="col-md-12">
                                    <label for="inputPassword4" class="form-label">Descripción</label>
                                    <input type="text" class="form-control" id="titulo" value="{{$propiedadesEliminadas['descripcion']}}" readonly>
                                </div>
                                <div class="col-12">
                                    <label for="inputAddress" class="form-label">Imagen</label>
                                    <input type="text" class="form-control" id="imagen" value="{{$propiedadesEliminadas['imagen']}}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="inputZip" class="form-label">Tamaño</label>
                                    <input type="text" class="form-control" id="tamaño-imagen" value="{{$propiedadesEliminadas['size_imagen']}}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="inputZip" class="form-label">Tipo</label>
                                    <input type="text" class="form-control" id="tipo-imagen" value="{{$propiedadesEliminadas['type_imagen']}}" readonly>
                                </div>
                                <div class="col-12">
                                    <label for="inputAddress2" class="form-label">Documento</label>
                                    <input type="text" class="form-control" id="documento" value="{{$propiedadesEliminadas['documento']}}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="inputZip" class="form-label">Tamaño</label>
                                    <input type="text" class="form-control" id="tamaño-documento" value="{{$propiedadesEliminadas['size_documento']}}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="inputZip" class="form-label">Tipo</label>
                                    <input type="text" class="form-control" id="tipo-documento" value="{{$propiedadesEliminadas['type_documento']}}" readonly>
                                </div>
                                <div class="col-12">
                                    <label for="inputAddress2" class="form-label">Enlace</label>
                                    <input type="text" class="form-control" id="enlace" value="{{$propiedadesEliminadas['enlace']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Estado</label>
                                    <input type="text" class="form-control w-25" id="estado" value="{{$propiedadesEliminadas['estado']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Página que pertenece</label>
                                    <input type="text" class="form-control w-50" id="estado" value="{{$pagina}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Creación</label>
                                    <input type="text" class="form-control" id="estado" value="{{$propiedadesEliminadas['created_at']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Actualizado</label>
                                    <input type="text" class="form-control" id="estado" value="{{$propiedadesEliminadas['updated_at']}}" readonly>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @break
    @case('Menú')
            @if ($evento == 'created')
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                            Atributos creados
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                            @foreach ($propiedades as $propiedad)
                                <form class="row g-3">
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">ID</label>
                                        <input type="email" class="form-control w-25" id="id" value="{{$propiedad['id']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputPassword4" class="form-label">Nombre del menú</label>
                                        <input type="text" class="form-control" id="nombre" value="{{$propiedad['name']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputPassword4" class="form-label">Slug</label>
                                        <input type="text" class="form-control" id="slug" value="{{$propiedad['slug']}}" readonly>
                                    </div>
                                    <div class="col-6">
                                        <label for="inputAddress" class="form-label">Menú padre</label>
                                        <input type="text" class="form-control" id="padre" value="{{$menu}}" readonly>
                                    </div>
                                    <div class="col-6">
                                        <label for="inputZip" class="form-label">Número de ordenamiento</label>
                                        <input type="text" class="form-control w-25" id="ordenamiento" value="{{$propiedad['order']}}" readonly>
                                    </div>
                                    <div class="col-6">
                                        <label for="inputZip" class="form-label">Estado</label>
                                        <input type="text" class="form-control w-25" id="estado" value="{{$propiedad['enabled']}}" readonly>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputCity" class="form-label">Enlace</label>
                                        <input type="text" class="form-control" id="enlace" value="{{$propiedad['enlace']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">Target</label>
                                        <input type="text" class="form-control" id="target" value="{{$propiedad['target']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">Página asignada</label>
                                        <input type="text" class="form-control" id="fecha-actualizado" value="{{$propiedad['nombre_pagina']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">Creación</label>
                                        <input type="text" class="form-control" id="fecha-creación" value="{{$propiedad['created_at']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">Actualizado</label>
                                        <input type="text" class="form-control" id="fecha-actualizado" value="{{$propiedad['updated_at']}}" readonly>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            @if ($evento == 'updated')
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                Atributos actualizados
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body">
                                <form class="row g-3">
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">ID</label>
                                        <input type="email" class="form-control w-25" id="id" value="{{$propiedadesActualizadas['id']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputPassword4" class="form-label">Nombre del menú</label>
                                        <input type="text" class="form-control" id="nombre" value="{{$propiedadesActualizadas['name']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputPassword4" class="form-label">Slug</label>
                                        <input type="text" class="form-control" id="slug" value="{{$propiedadesActualizadas['slug']}}" readonly>
                                    </div>
                                    <div class="col-6">
                                        <label for="inputAddress" class="form-label">Menú padre</label>
                                        <input type="text" class="form-control" id="padre" value="{{$menu}}" readonly>
                                    </div>
                                    <div class="col-6">
                                        <label for="inputZip" class="form-label">Número de ordenamiento</label>
                                        <input type="text" class="form-control w-25" id="ordenamiento" value="{{$propiedadesActualizadas['order']}}" readonly>
                                    </div>
                                    <div class="col-6">
                                        <label for="inputZip" class="form-label">Estado</label>
                                        <input type="text" class="form-control w-25" id="estado" value="{{$propiedadesActualizadas['enabled']}}" readonly>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputCity" class="form-label">Enlace</label>
                                        <input type="text" class="form-control" id="enlace" value="{{$propiedadesActualizadas['enlace']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">Target</label>
                                        <input type="text" class="form-control" id="target" value="{{$propiedadesActualizadas['target']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">Página asignada</label>
                                        <input type="text" class="form-control" id="fecha-actualizado" value="{{$propiedadesActualizadas['nombre_pagina']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">Creación</label>
                                        <input type="text" class="form-control" id="fecha-creación" value="{{$propiedadesActualizadas['created_at']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">Actualizado</label>
                                        <input type="text" class="form-control" id="fecha-actualizado" value="{{$propiedadesActualizadas['updated_at']}}" readonly>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                            Atributos antiguos
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                            <form class="row g-3">
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">ID</label>
                                    <input type="email" class="form-control w-25" id="id" value="{{$propiedadesAntiguas['id']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Nombre del menú</label>
                                    <input type="text" class="form-control" id="nombre" value="{{$propiedadesAntiguas['name']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Slug</label>
                                    <input type="text" class="form-control" id="slug" value="{{$propiedadesAntiguas['slug']}}" readonly>
                                </div>
                                <div class="col-6">
                                    <label for="inputAddress" class="form-label">Menú padre</label>
                                    <input type="text" class="form-control" id="padre" value="{{$menu}}" readonly>
                                </div>
                                <div class="col-6">
                                    <label for="inputZip" class="form-label">Número de ordenamiento</label>
                                    <input type="text" class="form-control w-25" id="ordenamiento" value="{{$propiedadesAntiguas['order']}}" readonly>
                                </div>
                                <div class="col-6">
                                    <label for="inputZip" class="form-label">Estado</label>
                                    <input type="text" class="form-control w-25" id="estado" value="{{$propiedadesAntiguas['enabled']}}" readonly>
                                </div>
                                <div class="col-12">
                                    <label for="inputCity" class="form-label">Enlace</label>
                                    <input type="text" class="form-control" id="enlace" value="{{$propiedadesAntiguas['enlace']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Target</label>
                                    <input type="text" class="form-control" id="target" value="{{$propiedadesAntiguas['target']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Página asignada</label>
                                    <input type="text" class="form-control" id="fecha-actualizado" value="{{$propiedadesAntiguas['nombre_pagina']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Creación</label>
                                    <input type="text" class="form-control" id="fecha-creación" value="{{$propiedadesAntiguas['created_at']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Actualizado</label>
                                    <input type="text" class="form-control" id="fecha-actualizado" value="{{$propiedadesAntiguas['updated_at']}}" readonly>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            @if ($evento == 'deleted')
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                            Atributos eliminados
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                            <form class="row g-3">
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">ID</label>
                                    <input type="email" class="form-control w-25" id="id" value="{{$propiedadesEliminadas['id']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Nombre del menú</label>
                                    <input type="text" class="form-control" id="nombre" value="{{$propiedadesEliminadas['name']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Slug</label>
                                    <input type="text" class="form-control" id="slug" value="{{$propiedadesEliminadas['slug']}}" readonly>
                                </div>
                                <div class="col-6">
                                    <label for="inputAddress" class="form-label">Menú padre</label>
                                    <input type="text" class="form-control" id="padre" value="{{$menu}}" readonly>
                                </div>
                                <div class="col-6">
                                    <label for="inputZip" class="form-label">Número de ordenamiento</label>
                                    <input type="text" class="form-control w-25" id="ordenamiento" value="{{$propiedadesEliminadas['order']}}" readonly>
                                </div>
                                <div class="col-6">
                                    <label for="inputZip" class="form-label">Estado</label>
                                    <input type="text" class="form-control w-25" id="estado" value="{{$propiedadesEliminadas['enabled']}}" readonly>
                                </div>
                                <div class="col-12">
                                    <label for="inputCity" class="form-label">Enlace</label>
                                    <input type="text" class="form-control" id="enlace" value="{{$propiedadesEliminadas['enlace']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Target</label>
                                    <input type="text" class="form-control" id="target" value="{{$propiedadesEliminadas['target']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Página asignada</label>
                                    <input type="text" class="form-control" id="fecha-actualizado" value="{{$propiedadesEliminadas['nombre_pagina']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Creación</label>
                                    <input type="text" class="form-control" id="fecha-creación" value="{{$propiedadesEliminadas['created_at']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Actualizado</label>
                                    <input type="text" class="form-control" id="fecha-actualizado" value="{{$propiedadesEliminadas['updated_at']}}" readonly>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @break
    @case('Footer')
            @if ($evento == 'created')
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                            Atributos creados
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                            @foreach ($propiedades as $propiedad)
                                <form class="row g-3">
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">ID</label>
                                        <input type="email" class="form-control w-25" id="id" value="{{$propiedad['id']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputPassword4" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" value="{{$propiedad['nombre']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputPassword4" class="form-label">Contenido</label>
                                        <input type="text" class="form-control" id="slug" value="{{$propiedad['valor']}}" readonly>
                                    </div>
                                    <div class="col-6">
                                        <label for="inputZip" class="form-label">Tipo</label>
                                        <input type="text" class="form-control w-25" id="ordenamiento" value="{{$propiedad['tipo']}}" readonly>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputZip" class="form-label">Enlace</label>
                                        <input type="text" class="form-control" id="estado" value="{{$propiedad['enlace']}}" readonly>
                                    </div>
                                    <div class="col-6">
                                        <label for="inputCity" class="form-label">Estado</label>
                                        <input type="text" class="form-control w-25" id="enlace" value="{{$propiedad['estado']}}" readonly>
                                    </div>
                                    <div class="col-12"></div>
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">Creación</label>
                                        <input type="text" class="form-control" id="fecha-creación" value="{{$propiedad['created_at']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">Actualizado</label>
                                        <input type="text" class="form-control" id="fecha-actualizado" value="{{$propiedad['updated_at']}}" readonly>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            @if ($evento == 'updated')
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                Atributos actualizados
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body">
                                <form class="row g-3">
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">ID</label>
                                        <input type="email" class="form-control w-25" id="id" value="{{$propiedadesActualizadas['id']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputPassword4" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" value="{{$propiedadesActualizadas['nombre']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputPassword4" class="form-label">Contenido</label>
                                        <input type="text" class="form-control" id="slug" value="{{$propiedadesActualizadas['valor']}}" readonly>
                                    </div>
                                    <div class="col-6">
                                        <label for="inputZip" class="form-label">Tipo</label>
                                        <input type="text" class="form-control w-25" id="ordenamiento" value="{{$propiedadesActualizadas['tipo']}}" readonly>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputZip" class="form-label">Enlace</label>
                                        <input type="text" class="form-control" id="estado" value="{{$propiedadesActualizadas['enlace']}}" readonly>
                                    </div>
                                    <div class="col-6">
                                        <label for="inputCity" class="form-label">Estado</label>
                                        <input type="text" class="form-control w-25" id="enlace" value="{{$propiedadesActualizadas['estado']}}" readonly>
                                    </div>
                                    <div class="col-12"></div>
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">Creación</label>
                                        <input type="text" class="form-control" id="fecha-creación" value="{{$propiedadesActualizadas['created_at']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">Actualizado</label>
                                        <input type="text" class="form-control" id="fecha-actualizado" value="{{$propiedadesActualizadas['updated_at']}}" readonly>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                            Atributos antiguos
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                            <form class="row g-3">
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">ID</label>
                                    <input type="email" class="form-control w-25" id="id" value="{{$propiedadesAntiguas['id']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" value="{{$propiedadesAntiguas['nombre']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Contenido</label>
                                    <input type="text" class="form-control" id="slug" value="{{$propiedadesAntiguas['valor']}}" readonly>
                                </div>
                                <div class="col-6">
                                    <label for="inputZip" class="form-label">Tipo</label>
                                    <input type="text" class="form-control w-25" id="ordenamiento" value="{{$propiedadesAntiguas['tipo']}}" readonly>
                                </div>
                                <div class="col-12">
                                    <label for="inputZip" class="form-label">Enlace</label>
                                    <input type="text" class="form-control" id="estado" value="{{$propiedadesAntiguas['enlace']}}" readonly>
                                </div>
                                <div class="col-6">
                                    <label for="inputCity" class="form-label">Estado</label>
                                    <input type="text" class="form-control w-25" id="enlace" value="{{$propiedadesAntiguas['estado']}}" readonly>
                                </div>
                                <div class="col-12"></div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Creación</label>
                                    <input type="text" class="form-control" id="fecha-creación" value="{{$propiedadesAntiguas['created_at']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Actualizado</label>
                                    <input type="text" class="form-control" id="fecha-actualizado" value="{{$propiedadesAntiguas['updated_at']}}" readonly>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            @if ($evento == 'deleted')
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                            Atributos eliminados
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                            <form class="row g-3">
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">ID</label>
                                    <input type="email" class="form-control w-25" id="id" value="{{$propiedadesEliminadas['id']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" value="{{$propiedadesEliminadas['nombre']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Contenido</label>
                                    <input type="text" class="form-control" id="slug" value="{{$propiedadesEliminadas['valor']}}" readonly>
                                </div>
                                <div class="col-6">
                                    <label for="inputZip" class="form-label">Tipo</label>
                                    <input type="text" class="form-control w-25" id="ordenamiento" value="{{$propiedadesEliminadas['tipo']}}" readonly>
                                </div>
                                <div class="col-12">
                                    <label for="inputZip" class="form-label">Enlace</label>
                                    <input type="text" class="form-control" id="estado" value="{{$propiedadesEliminadas['enlace']}}" readonly>
                                </div>
                                <div class="col-6">
                                    <label for="inputCity" class="form-label">Estado</label>
                                    <input type="text" class="form-control w-25" id="enlace" value="{{$propiedadesEliminadas['estado']}}" readonly>
                                </div>
                                <div class="col-12"></div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Creación</label>
                                    <input type="text" class="form-control" id="fecha-creación" value="{{$propiedadesEliminadas['created_at']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Actualizado</label>
                                    <input type="text" class="form-control" id="fecha-actualizado" value="{{$propiedadesEliminadas['updated_at']}}" readonly>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @break
    @case('Usuario')
            @if ($evento == 'created')
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                            Atributos creados
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                            @foreach ($propiedades as $propiedad)
                                <form class="row g-3">
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">ID</label>
                                        <input type="email" class="form-control w-25" id="id" value="{{$propiedad['id']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputPassword4" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" value="{{$propiedad['name']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputPassword4" class="form-label">Correo electrónico</label>
                                        <input type="text" class="form-control" id="slug" value="{{$propiedad['email']}}" readonly>
                                    </div>
                                    <div class="col-6">
                                        <label for="inputZip" class="form-label">Password</label>
                                        <input type="password" class="form-control w-25" id="ordenamiento" value="{{$propiedad['password']}}" readonly>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputZip" class="form-label">Estado</label>
                                        <input type="text" class="form-control" id="estado" value="{{$propiedad['estado']}}" readonly>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputCity" class="form-label">Páginas asignadas</label>
                                        <br>
                                        <div class="d-inline-flex">
                                            @foreach ($paginas as $pagina)
                                                @foreach ($pagina as $item)
                                                    <input type="text" class="form-control" id="enlace" value="{{$item->titulo}}" readonly>
                                                @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-12"></div>
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">Creación</label>
                                        <input type="text" class="form-control" id="fecha-creación" value="{{$propiedad['created_at']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">Actualizado</label>
                                        <input type="text" class="form-control" id="fecha-actualizado" value="{{$propiedad['updated_at']}}" readonly>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            @if ($evento == 'updated')
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                Atributos actualizados
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body">
                                <form class="row g-3">
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">ID</label>
                                        <input type="email" class="form-control w-25" id="id-actual" value="{{$propiedadesActualizadas['id']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputPassword4" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre-actual" value="{{$propiedadesActualizadas['name']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputPassword4" class="form-label">Correo electrónico</label>
                                        <input type="text" class="form-control" id="correo-actual" value="{{$propiedadesActualizadas['email']}}" readonly>
                                    </div>
                                    <div class="col-6">
                                        <label for="inputZip" class="form-label">Password</label>
                                        <input type="password" class="form-control w-25" id="password-actual" value="{{$propiedadesActualizadas['password']}}" readonly>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputZip" class="form-label">Estado</label>
                                        <input type="text" class="form-control" id="estado-actual" value="{{$propiedadesActualizadas['estado']}}" readonly>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputCity" class="form-label">Páginas asignadas</label>
                                        <br>
                                        <div class="d-inline-flex">
                                            @foreach ($paginas as $key => $pagina)
                                                @foreach ($pagina as $key => $item)
                                                    <input type="text" class="form-control" id="pagina-actual-{{ $item->id }}" value="{{$item->titulo}}" readonly>
                                                @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-12"></div>
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">Creación</label>
                                        <input type="text" class="form-control" id="fecha-creación-actual" value="{{$propiedadesActualizadas['created_at']}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">Actualizado</label>
                                        <input type="text" class="form-control" id="fecha-actualizado-actual" value="{{$propiedadesActualizadas['updated_at']}}" readonly>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                            Atributos antiguos
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                            <form class="row g-3">
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">ID</label>
                                    <input type="email" class="form-control w-25" id="id" value="{{$propiedadesAntiguas['id']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" value="{{$propiedadesAntiguas['name']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Correo electrónico</label>
                                    <input type="text" class="form-control" id="slug" value="{{$propiedadesAntiguas['email']}}" readonly>
                                </div>
                                <div class="col-6">
                                    <label for="inputZip" class="form-label">Password</label>
                                    <input type="password" class="form-control w-25" id="ordenamiento" value="{{$propiedadesAntiguas['password']}}" readonly>
                                </div>
                                <div class="col-12">
                                    <label for="inputZip" class="form-label">Estado</label>
                                    <input type="text" class="form-control" id="estado" value="{{$propiedadesAntiguas['estado']}}" readonly>
                                </div>
                                <div class="col-12">
                                    <label for="inputCity" class="form-label">Páginas asignadas</label>
                                    <br>
                                    <div class="d-inline-flex" id="caja-paginas">
                                        @foreach ($nomPageAntiguas as $key => $pagina)
                                            <input type="hidden" class="form-control pagina-antigua-{{$loop->iteration}}" value="{{$pagina}}" readonly>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-12"></div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Creación</label>
                                    <input type="text" class="form-control" id="fecha-creación" value="{{$propiedadesAntiguas['created_at']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Actualizado</label>
                                    <input type="text" class="form-control" id="fecha-actualizado" value="{{$propiedadesAntiguas['updated_at']}}" readonly>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            @if ($evento == 'deleted')
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                            Atributos eliminados
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                            <form class="row g-3">
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">ID</label>
                                    <input type="email" class="form-control w-25" id="id" value="{{$propiedadesEliminadas['id']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" value="{{$propiedadesEliminadas['name']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Correo electrónico</label>
                                    <input type="text" class="form-control" id="slug" value="{{$propiedadesEliminadas['email']}}" readonly>
                                </div>
                                <div class="col-6">
                                    <label for="inputZip" class="form-label">Password</label>
                                    <input type="password" class="form-control w-25" id="ordenamiento" value="{{$propiedadesEliminadas['password']}}" readonly>
                                </div>
                                <div class="col-12">
                                    <label for="inputZip" class="form-label">Estado</label>
                                    <input type="text" class="form-control" id="estado" value="{{$propiedadesEliminadas['estado']}}" readonly>
                                </div>
                                <div class="col-12">
                                    <label for="inputCity" class="form-label">Páginas asignadas</label>
                                    <br>
                                    <div class="d-inline-flex" id="caja-paginas">
                                        @foreach ($nomPageAntiguas as $key => $pagina)
                                            <input type="hidden" class="form-control pagina-antigua-{{$loop->iteration}}" value="{{$pagina}}" readonly>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-12"></div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Creación</label>
                                    <input type="text" class="form-control" id="fecha-creación" value="{{$propiedadesEliminadas['created_at']}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Actualizado</label>
                                    <input type="text" class="form-control" id="fecha-actualizado" value="{{$propiedadesEliminadas['updated_at']}}" readonly>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @break
    @default
        
@endswitch

{{--
    El script de abajo permite ver la visualización de los atributos antiguos de las paginas de los
    usuarios
--}}

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>

        let contenedorPaginas = [];

        $("#caja-paginas :input").each(function(e){	

            let str = $(this).val();
            contenedorPaginas.push(str.split('[{"titulo":"').pop().split('"}]')[0]);

        });
        console.log(contenedorPaginas);

        for (let i = 0; i < contenedorPaginas.length; i++) {
                $("#caja-paginas")
                .append('<input type="text" class="form-control paginas-antiguas" value="'+contenedorPaginas[i]+'" readonly>');
            }
    </script> --}}