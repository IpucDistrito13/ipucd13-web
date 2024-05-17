<div class="row">
    <div class="col-sm-6">
        <!-- text input -->
        <div class="form-group">
            <label>Tipo de galería *</label>
            <input type="text" class="form-control" id="nombre" name="nombre"
                value="{{ old('nombre', $galeria_type->nombre ?? '') }}" onkeyup="updateSlug()">
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-6">
        <!-- text input -->
        <div class="form-group">
            <label>Slug *</label>
            <input type="text" class="form-control" id="slug" name="slug"
                value="{{ old('slug', $galeria_type->slug ?? '') }}">
            @error('slug')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label>Descripción</label>
            <textarea class="form-control" rows="2" placeholder="" id="descripcion" name="descripcion">{{ old('descripcion', $galeria_type->descripcion ?? '') }}</textarea>
            @error('descripcion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label>Imagen portada</label>
            <input class="form-control-file" type="file" name="file" id="file" accept="image/*"
                onchange="cambiarImagen(event)">
            @error('file')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            @if (isset($galeria_type) && $galeria_type->imagen)
                <img id="imagen" src="{{ Storage::url($galeria_type->imagen->url) }}" alt="" class="img-thumbnail">
            @else
                <img id="imagen" src="https://i.ibb.co/YcvYfpx/640x480.png" alt="" class="img-thumbnail">
            @endif
        </div>
    </div>
    

</div>
