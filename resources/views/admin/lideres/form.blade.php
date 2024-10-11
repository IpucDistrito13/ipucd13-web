<div class="row">


    <div class="col-sm-4">
        <!-- select input -->
        <div class="form-group">
            <label>Usuario *</label>
            <select id="usuario" name="usuario" class="form-control">
                <option value="" selected disabled>Selecciona</option>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}"
                        {{ old('usuario') == $usuario->id || (isset($lider) && $lider->usuario_id == $usuario->id) ? 'selected' : '' }}>
                        {{ $usuario->nombre }} {{ $usuario->apellidos }} - {{ $usuario->celular }} - {{ $usuario->congregacion->nombre }}
                    </option>
                @endforeach
            </select>
            @error('usuario')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-4">
        <!-- select input -->
        <div class="form-group">
            <label>Comité *</label>
            <select id="comite" name="comite" class="form-control">
                <option value="" selected disabled>Selecciona</option>
                @foreach ($comites as $comite)
                    <option value="{{ $comite->id }}"
                        {{ old('comite') == $comite->id || (isset($lider) && $lider->comite_id == $comite->id) ? 'selected' : '' }}>
                        {{ $comite->nombre }}
                    </option>
                @endforeach
            </select>
            @error('comite')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-4">
        <!-- select input -->
        <div class="form-group">
            <label>Tipo líder *</label>
            <select id="tipo" name="tipo" class="form-control">
                <option value="" selected disabled>Selecciona</option>
                @foreach ($tipos as $tipo)
                    <option value="{{ $tipo->id }}"
                        {{  old('tipo') == $tipo->id || isset($lider) && $lider->lidertipo_id == $tipo->id ? 'selected' : '' }}>
                        {{ $tipo->nombre }}
                    </option>
                @endforeach
            </select>
            @error('tipo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

   

</div>