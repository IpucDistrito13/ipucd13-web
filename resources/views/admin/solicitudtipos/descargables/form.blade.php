<div class="row">
    <div class="col-sm-6">
        <!-- text input -->
        <div class="form-group">
            <label>Nombre *</label>
            <input type="text" class="form-control" id="nombre" name="nombre"
                value="{{ old('nombre', $solicitud_descargable->nombre ?? '') }}" onkeyup="updateSlug()">
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
                value="{{ old('slug', $solicitud_descargable->slug ?? '') }}">
            @error('slug')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label>Descripción</label>
            <textarea class="form-control" rows="2" placeholder="" id="descripcion" name="descripcion">{{ old('descripcion', $solicitud_descargable->descripcion ?? '') }}</textarea>
            @error('descripcion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label>Subir archivo *</label>
            <input type="file" class="form-control-file" name="url" id="url">
            @error('url')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    

    <div class="col-sm-2">
        <!-- select -->
        <div class="form-group">
            <label>Estado *</label>
            <select class="form-control" id="estado" name="estado">
                <option value="Activo" {{ old('estado', $solicitud_tipo->estado ?? '') === 'Activo' ? 'selected' : '' }}>Activo</option>
                <option value="Inactivo" {{ old('estado', $solicitud_tipo->estado ?? '') === 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
    </div>
    

</div>
