<div class="row">

    <div class="col-sm-6">
        <!-- select input -->
        <div class="form-group">
            <label>Municipio *</label>
            <select id="municipio" name="municipio" class="form-control">
                <option value="" selected disabled>Selecciona</option>
                @foreach ($municipios as $municipio)
                    <option value="{{ $municipio->id }}"
                        {{ isset($congregacion) && $congregacion->municipio_id == $municipio->id ? 'selected' : '' }}>
                        {{ $municipio->nombre .' - '. $municipio->departamento->nombre }}
                    </option>
                @endforeach
            </select>
            @error('municipio')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-3">
        <!-- text input -->
        <div class="form-group">
            <label>Longitud</label>
            <input type="text" class="form-control" id="longitud" name="longitud" placeholder="Opcional"
                value="{{ old('longitud', $congregacion->longitud ?? '') }}">
            @error('longitud')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-3">
        <!-- text input -->
        <div class="form-group">
            <label>Latitud </label>
            <input type="text" class="form-control" id="latitud" name="latitud" placeholder="Opcional"
                value="{{ old('latitud', $congregacion->latitud ?? '') }}">
            @error('latitud')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label>Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion"
                value="{{ old('direccion', $congregacion->direccion ?? '') }}"> @error('direccion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

</div>