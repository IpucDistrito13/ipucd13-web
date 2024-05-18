<div class="row">


    <div class="col-sm-4">
        <!-- text input -->
        <div class="form-group">
            <label>Nombre *</label>
            <input type="text" class="form-control" id="nombre" name="nombre"
                value="{{ old('nombre', $categoria->nombre ?? '') }}" onkeyup="updateSlug()">
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-4">
        <!-- text input -->
        <div class="form-group">
            <label>Slug *</label>
            <input type="text" class="form-control" id="slug" name="slug"
                value="{{ old('slug', $categoria->slug ?? '') }}">
            @error('slug')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-4">
        <!-- select input -->
        <div class="form-group">
            <label for="comite">Comité *</label>
            <select class="form-control" id="comite" name="comite" @readonly(true)>
                <option value="{{ $comite->id }}">{{ $comite->nombre }}</option>
            </select>
            @error('comite')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label>Descripción</label>
            <textarea class="form-control" rows="2" placeholder="" id="descripcion" 
            name="descripcion">{{ old('descripcion', $categoria->descripcion ?? '') }}</textarea>
            @error('descripcion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>    

</div>
