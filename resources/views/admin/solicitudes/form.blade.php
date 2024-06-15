<div class="row">

    <div class="col-sm-3" hidden>
        <!-- text input -->
        <div class="form-group">
            <label>UUID</label>
            <input type="text" class="form-control" id="uuid" name="uuid" readonly
                value="{{ old('uuid', $uuid) }}">
            @error('uuid')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-3">
        <!-- text input -->
        <div class="form-group">
            <label>Código</label>
            <input type="text" class="form-control" id="codigo" name="codigo" readonly
                value="{{ old('codigo', $usuario->codigo) }}">
            @error('codigo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-3">
        <!-- text input -->
        <label>Nombre</label>
        <div class="form-group">
            <input type="text" class="form-control" id="nombre" name="nombre" readonly
                value="{{ old('nombre', $usuario->nombre) }}">
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-3">
        <!-- text input -->
        <label>Apellidos</label>
        <div class="form-group">
            <input type="text" class="form-control" id="uuid" name="apellidos" readonly
                value="{{ old('apellidos', $usuario->apellidos) }}">
            @error('apellidos')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-3">
        <label>Tipo de solicitud</label>
        <div class="form-group">
            <select name="solicitud" id="solicitud" class="form-control">
                <option value="">Seleccionar</option>
                @foreach ($solicitudTipo as $solicitud)
                    <option value="{{ $solicitud['id'] }}">{{ $solicitud['nombre'] }}</option>
                @endforeach
            </select>
            @error('solicitud')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    

</div>
