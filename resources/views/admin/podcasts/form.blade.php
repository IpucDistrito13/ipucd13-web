<div class="row">

    <div class="col-sm-2">
        <!-- select input -->
        <div class="form-group">
            <label>Comité *</label>
            <select id="comite" name="comite" class="form-control">
                <option value="" selected disabled>Selecciona</option>
                @foreach ($comites as $comite)
                    <option value="{{ $comite->id }}"
                        {{ old('comite') == $comite->id || (isset($serie) && $serie->comite_id == $comite->id) ? 'selected' : '' }}>
                        {{ $comite->nombre }}
                    </option>
                @endforeach
            </select>
            @error('comite')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>


    <div class="col-sm-2">
        <!-- select input -->
        <div class="form-group">
            <label>Categorías *</label>
            <select id="categoria" name="categoria" class="form-control">
                <option value="" selected disabled>Selecciona</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}"
                        {{ old('categoria') == $categoria->id || (isset($serie) && $serie->categoria_id == $categoria->id) ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
            @error('categoria')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-4">
        <!-- text input -->
        <div class="form-group">
            <label>Podcast *</label>
            <input type="text" class="form-control" id="titulo" name="titulo"
                value="{{ old('titulo', $podcast->titulo ?? '') }}" onkeyup="updateSlug()">
            @error('titulo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-4">
        <!-- text input -->
        <div class="form-group">
            <label>Slug *</label>
            <input type="text" class="form-control" id="slug" name="slug" readonly
                value="{{ old('slug', $podcast->slug ?? '') }}">
            @error('slug')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label>Descripción *</label>
            <textarea class="form-control" rows="2" placeholder="" id="descripcion" name="descripcion">{{ old('descripcion', $podcast->descripcion ?? '') }}</textarea>
            <div class="text-muted">Máximo 300 caracteres</div>
            @error('descripcion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label>Contenido *</label>
            <textarea class="form-control" rows="3" placeholder="" id="contenido" name="contenido">{{ old('contenido', $podcast->contenido ?? '') }}</textarea>
            <div class="text-muted">Máximo 1.000 caracteres</div>
            @error('contenido')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- 
     <div class="col-sm-3">
        <!-- select -->
        <div class="form-group">
            <label>Estado</label>
            <select class="form-control" id="estado" name="estado">
                <option value="" {{ (old('estado', $podcast->estado ?? '') === '') ? 'selected' : '' }} disabled>Seleccionar</option>
                <option value="Borrador" {{ old('estado', $podcast->estado ?? '') === 'Borrador' ? 'selected' : '' }}>Borrador</option>
                <option value="Publicado" {{ old('estado', $podcast->estado ?? '') === 'Publicado' ? 'selected' : '' }}>Publicado</option>
            </select>
        </div>
    </div>
    --}}

    <div class="col-sm-6">
        <div class="form-group">
            <label>Imagen portada (480x640) *</label>
            <input class="form-control-file" type="file" class="custom-file-input" name="file" id="file"
                accept="image/*" onchange="cambiarImagen(event)">
            @error('file')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label>Imagen banner (1920x500) *</label>
            <input class="form-control-file" type="file" class="custom-file-input" name="imagen_banner"
                id="imagen_banner_input" accept="image/*" onchange="cambiarImagenBanner(event)">

            @error('imagen_banner')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            @if (isset($podcast) && $podcast->imagen)
                <img id="imagen" src="{{ Storage::url($podcast->imagen->url) }}" alt=""
                    class="img-thumbnail">
            @else
                <img id="imagen" src="https://i.ibb.co/LxLbXg6/480x640-gris.png" alt="480x600"
                    class="img-thumbnail">
            @endif
        </div>
    </div>

    {{-- IMAGEN APLICACION APPBAR --}}
    <div class="col-sm-6">
        <div class="form-group">
            @if (isset($podcast) && $podcast->imagen_banner)
                <img id="imagen_banner" src="{{ Storage::url($podcast->imagen_banner) }}" alt=""
                    class="img-thumbnail">
            @else
                <img id="imagen_banner" src="https://via.placeholder.com/1920x500" alt="1920x500" class="img-thumbnail">
            @endif
        </div>
    </div>

</div>
