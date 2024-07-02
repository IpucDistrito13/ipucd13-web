<div class="row">
    <div class="col-sm-6">
        <!-- text input -->
        <div class="form-group">
            <label>Categoría *</label>
            <input type="text" class="form-control" id="nombre" name="nombre"
                value="{{ old('nombre', $categoria->nombre ?? '') }}" onkeyup="updateSlug()">
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
                value="{{ old('slug', $categoria->slug ?? '') }}">
            @error('slug')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label>Descripción</label>
            <textarea class="form-control" rows="2" placeholder="" id="descripcion" name="descripcion">{{ old('descripcion', $categoria->descripcion ?? '') }}</textarea>
            @error('descripcion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

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
            <label>Imagen banner (1920x500) </label>
            <input class="form-control-file" type="file" class="custom-file-input" name="imagen_banner"
                id="imagen_banner_input" accept="image/*" onchange="cambiarImagenBanner(event)">

            @error('imagen_banner')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            @if (isset($categoria) && $categoria->imagen)
                <img id="imagen" src="{{ Storage::url($categoria->imagen->url) }}" alt="" class="img-thumbnail"
                    style="max-width: 100%; height: auto;">
            @else
                <img id="imagen" src="https://i.ibb.co/LxLbXg6/480x640-gris.png" alt="480x600" class="img-thumbnail"
                    style="max-width: 100%; height: auto;">
            @endif
        </div>
    </div>

    {{-- IMAGEN APLICACION APPBAR --}}
    <div class="col-sm-6">
        <div class="form-group">
            @if (isset($categoria) && $categoria->imagen_banner)
                <img id="imagen_banner" src="{{ Storage::url($categoria->imagen_banner) }}" alt=""
                    class="img-thumbnail">
            @else
                <img id="imagen_banner" src="https://via.placeholder.com/1920x500" alt="1920x500" class="img-thumbnail">
            @endif
        </div>
    </div>

</div>
