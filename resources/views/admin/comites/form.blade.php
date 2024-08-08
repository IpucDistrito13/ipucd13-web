<div class="row">
    <div class="col-sm-6">
        <!-- text input -->
        <div class="form-group">
            <label>Comité *</label>
            <input type="text" class="form-control" id="nombre" name="nombre"
                value="{{ old('nombre', $comite->nombre ?? '') }}" onkeyup="updateSlug()">
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-6">
        <!-- text input -->
        <div class="form-group">
            <label>Slug *</label>
            <input type="text" class="form-control" id="slug" name="slug" readonly
                value="{{ old('slug', $comite->slug ?? '') }}">
            @error('slug')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label>Descripción *</label>
            <textarea class="form-control" rows="5" placeholder="" id="descripcion" name="descripcion">{{ old('descripcion', $comite->descripcion ?? '') }}</textarea>
            <div class="text-muted">Máximo 1.000 caracteres</div>
            @error('descripcion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <label>Imagen portada (480x640) *</label>
            <input class="form-control-file" type="file" class="custom-file-input" name="file" id="file"
                accept="image/*" onchange="cambiarImagen(event)">
            @error('file')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    

    <div class="col-sm-4">
        <div class="form-group">
            <label>Imagen banner (1920x500) *</label>
            <input class="form-control-file" type="file" class="custom-file-input" name="imagen_banner"
                id="imagen_banner_input" accept="image/*" onchange="cambiarImagenBanner(event)">
    
            @error('imagen_banner')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <label>Mini banner (600x144) *</label>
            <input class="form-control-file" type="file" class="custom-file-input" name="banner_little"
                id="banner_little_input" accept="image/*" onchange="cambiarMiniImagenBanner(event)">
    
            @error('imagen_banner')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>


    {{-- IMAGEN PORTADA BANNER --}}
    <div class="col-sm-4">
        <div class="form-group">
            @if (isset($comite) && $comite->imagen)
                <img id="imagen" src="{{ Storage::url($comite->imagen->url) }}" alt="" class="img-thumbnail" style="max-width: 100%; height: auto;">
            @else
                <img id="imagen" src="https://i.ibb.co/LxLbXg6/480x640-gris.png" alt="480x600" class="img-thumbnail" style="max-width: 100%; height: auto;">
            @endif
        </div>
    </div>
    

    {{-- IMAGEN APLICACION APPBAR --}}
    <div class="col-sm-4">
        <div class="form-group">
            @if (isset($comite) && $comite->imagen_banner)
                <img id="imagen_banner" src="{{ Storage::url($comite->imagen_banner) }}" alt="1920x500"
                    class="img-thumbnail">
            @else
                <img id="imagen_banner" src="https://via.placeholder.com/1920x500" alt="1920x500" class="img-thumbnail">
            @endif
        </div>
    </div>

    {{-- IMAGEN APLICACION APPBAR --}}
    <div class="col-sm-4">
        <div class="form-group">
            @if (isset($comite) && $comite->banner_little)
                <img id="banner_little" src="{{ Storage::url($comite->banner_little) }}" alt="600x144"
                    class="img-thumbnail">
            @else
                <img id="banner_little" src="https://via.placeholder.com/600x144" alt="600x144" class="img-thumbnail">
            @endif
        </div>
    </div>

</div>