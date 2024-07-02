<div class="row">

    <div class="col-sm-3">
        <!-- select input -->
        <div class="form-group">
            <label>Comité *</label>
            <select class="form-control" name="comite" id="comite">
                <option disabled selected>Seleccionar</option>
                @foreach ($comites as $comite)
                    <option value="{{ $comite->id }}"
                        {{ old('comite', isset($publicacion) ? $publicacion->comite_id : '') == $comite->id ? 'selected' : '' }}>
                        {{ $comite->nombre }}
                    </option>
                @endforeach
            </select>
            @error('comite')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="col-sm-3">
        <!-- select input -->
        <div class="form-group">
            <label>Categoria *</label>
            <select class="form-control" name="categoria" id="categoria">
                <option disabled selected>Seleccionar</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}"
                        {{ old('categoria', isset($publicacion) ? $publicacion->categoria_id : '') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
            @error('categoria')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    

    <div class="col-sm-6">
        <!-- text input -->
        <div class="form-group">
            <label>Título *</label>
            <input type="text" class="form-control" id="titulo" name="titulo"
                value="{{ old('titulo', $publicacion->titulo ?? '') }}" onkeyup="updateSlug()">
            @error('titulo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-6">
        <!-- text input -->
        <div class="form-group">
            <label>Slug *</label>
            <input type="text" class="form-control" id="slug" name="slug" readonly
                value="{{ old('slug', $publicacion->slug ?? '') }}">
            @error('slug')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label>Descripción *</label>
            <textarea class="form-control" rows="1" placeholder="" id="descripcion" name="descripcion">{{ old('descripcion', $publicacion->descripcion ?? '') }}</textarea>
            @error('descripcion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label>Contenido *</label>
            <textarea class="form-control" rows="3" placeholder="" id="contenido" name="contenido">{{ old('contenido', $publicacion->contenido ?? '') }}</textarea>
            @error('contenido')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-3">
        <!-- select -->
        <div class="form-group">
            <label>Estado *</label>
            <select class="form-control" id="estado" name="estado">
                <option value="Publicado" {{ old('estado', $publicacion->estado ?? '') === 'Publicado' ? 'selected' : '' }}>Publicado</option>
                <option value="Borrador" {{ old('estado', $publicacion->estado ?? '') === 'Borrador' ? 'selected' : '' }}>Borrador</option>
            </select>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label>Imagen portada (480x640) *</label>
            <input class="form-control-file" type="file" name="file" id="file" accept="image/*"
                onchange="cambiarImagen(event)">
            @error('file')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            @if (isset($publicacion) && $publicacion->imagen)
                <img id="imagen" src="{{ Storage::url($publicacion->imagen->url) }}" alt="" class="img-thumbnail">
            @else
                <img id="imagen"  alt="" class="img-thumbnail">
            @endif
        </div>
    </div>

</div>
