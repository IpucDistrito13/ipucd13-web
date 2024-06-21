<div class="row">
    <div class="col-sm-4">
        <!-- text input -->
        <div class="form-group">
            <label>Slug *</label>
            <input type="text" class="form-control" id="slug" name="slug" readonly
                value="{{ old('slug', $carpeta->slug ?? '') }}">
            @error('slug')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-5">
        <!-- text input -->
        <div class="form-group">
            <label>Nombre *</label>
            <input type="text" class="form-control" id="nombre" name="nombre"
                value="{{ old('nombre', $carpeta->nombre ?? '') }}" onkeyup="updateSlug()">
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-3">
        <!-- select input -->
        <div class="form-group">
            <label>Visibilidad *</label>
            <select class="form-control" id="visibilidad" name="visibilidad">
                <option value="publico" {{ old('visibilidad', $carpeta->visibilidad ?? '') == 'publico' ? 'selected' : '' }}>Público</option>
                <option value="privado" {{ old('visibilidad', $carpeta->visibilidad ?? '') == 'privado' ? 'selected' : '' }}>Privado</option>
            </select>
            @error('visibilidad')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label>Descripción</label>
            <textarea class="form-control" rows="2" placeholder="" id="descripcion" 
            name="descripcion">{{ old('descripcion', $carpeta->descripcion ?? '') }}</textarea>
            @error('descripcion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>    

</div>
