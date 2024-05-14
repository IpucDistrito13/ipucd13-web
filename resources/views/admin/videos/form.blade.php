<div class="row">

    <div class="col-sm-6">
        <!-- text input -->
        <div class="form-group">
            <label>Comité *</label>
            @if (isset($congregacion) && $congregacion->municipio)
                <!-- Mostrar combobox con municipio existente seleccionado y lista de todos los municipios -->
                <select id="comite" class="form-control">
                    <option value="" disabled>Selecciona</option>
                    @foreach ($comites as $comite)
                        <option value="{{ $comite->id }}"
                            {{ $congregacion->comite->id == $comite->id ? 'selected' : '' }}>{{ $comite->nombre }}
                        </option>
                    @endforeach
                </select>
            @else
                <!-- Mostrar combobox para seleccionar un municipio si no hay uno seleccionado previamente -->
                <select id="municipios" class="form-control">
                    <option value="" selected>Selecciona</option>
                    @foreach ($comites as $comite)
                        <option value="{{ $comite->id }}">{{ $comite->nombre }}</option>
                    @endforeach
                </select>
            @endif
            @error('municipio')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-3">
        <!-- text input -->
        <div class="form-group">
            <label>Comité *</label>
            <input type="text" class="form-control" id="comite" name="comite"
                value="{{ old('comite', $video->comite_id ?? '') }}" onkeyup="updateSlug()">
            @error('comite')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-3">
        <!-- text input -->
        <div class="form-group">
            <label>Categoria *</label>
            <input type="text" class="form-control" id="categoria" name="categoria"
                value="{{ old('categoria', $video->categoria_id ?? '') }}">
            @error('categoria')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-3">
        <!-- text input -->
        <div class="form-group">
            <label>Título *</label>
            <input type="text" class="form-control" id="titulo" name="titulo"
                value="{{ old('titulo', $video->titulo ?? '') }}" onkeyup="updateSlug()">
            @error('titulo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-3">
        <!-- text input -->
        <div class="form-group">
            <label>Slug *</label>
            <input type="text" class="form-control" id="slug" name="slug"
                value="{{ old('slug', $video->slug ?? '') }}">
            @error('slug')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label>Descripción</label>
            <textarea class="form-control" rows="1" placeholder="" id="descripcion" name="descripcion">{{ old('descripcion', $video->descripcion ?? '') }}</textarea>
            @error('descripcion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label>Contenido</label>
            <textarea class="form-control" rows="2" placeholder="" id="contenido" name="contenido">{{ old('contenido', $video->contenido ?? '') }}</textarea>
            @error('contenido')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-3">
        <!-- select -->
        <div class="form-group">
            <label>Estado</label>
            <select class="form-control" id="estado" name="estado">
                <option value="" {{ old('estado', $video->estado ?? '') === '' ? 'selected' : '' }} disabled>
                    Seleccionar</option>
                <option value="Borrador" {{ old('estado', $video->estado ?? '') === 'Borrador' ? 'selected' : '' }}>
                    Borrador</option>
                <option value="Publicado" {{ old('estado', $video->estado ?? '') === 'Publicado' ? 'selected' : '' }}>
                    Publicado</option>
            </select>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label>Imagen portada</label>
            <input class="form-control-file" type="file" name="file" id="file"
                enctype="multipart/form-data
                onchange="cambiarImagen(event)">
            @error('file')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            @if (isset($video) && $video->imagen)
                <img id="imagen" src="{{ Storage::url($video->imagen->url) }}" alt="" class="img-thumbnail">
            @else
                <img id="imagen" src="https://i.ibb.co/YcvYfpx/640x480.png" alt="" class="img-thumbnail">
            @endif
        </div>
    </div>


</div>
