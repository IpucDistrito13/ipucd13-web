<div class="row">
    <div class="col-sm-12">
        <!-- text input -->
        <div class="form-group">
            <label>Título *</label>
            <input type="text" class="form-control" id="nombre" name="nombre"
                value="{{ old('nombre', $slider->titulo ?? '') }}" onkeyup="updateSlug()">
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>


    <div class="col-sm-12">
        <div class="form-group">
            <label>Imagen banner (1920x500) </label>
            <input class="form-control-file" type="file" name="file"
                id="file" accept="image/*" onchange="cambiarImagenBanner(event)">
            @error('file')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    

    <div class="col-sm-6">
        <div class="form-group">
            @if (isset($slider) && $slider->imagen)
                <img id="imagen" src="{{ Storage::url($slider->imagen->url) }}" alt="" class="img-thumbnail"
                    style="max-width: 100%; height: auto;">
            @else
            <img id="imagen" alt="" src="https://ipucd13.nyc3.cdn.digitaloceanspaces.com/public/No_imagen/imagen_no_found_horizontal.webp" class="img-thumbnail" style="width: 300px; height: auto;">
            @endif
        </div>
    </div>

    

</div>
