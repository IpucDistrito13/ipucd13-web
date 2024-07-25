<div class="row">


    <div class="col-sm-5">
        <!-- select input -->
        <div class="form-group">
            <label>Usuario *</label>
            <select id="usuario" name="usuario" class="form-control">
                <option value="" selected disabled>Selecciona</option>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}"
                        {{ old('usuario') == $usuario->id || (isset($lider) && $lider->usuario_id == $usuario->id) ? 'selected' : '' }}>
                        {{ $usuario->nombre. ' ' .$usuario->apellidos. ' - ' .$usuario->congregacion->nombre }}
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

    <div class="col-sm-3">
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

    <div class="col-sm-6">
        <div class="form-group">
            <label>Imagen líder (600x755) *</label>
            <input class="form-control-file" type="file" class="custom-file-input" name="file" id="file"
                accept="image/*" onchange="cambiarImagen(event)">
            @error('file')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            @if (isset($lider) && $lider->imagen)
                <img id="imagen" src="{{ Storage::url($lider->imagen->url) }}" alt="" class="img-thumbnail" style="max-width: 100%; height: auto;">
            @else
                <img id="imagen" src="https://i.ibb.co/LxLbXg6/480x640-gris.png" alt="480x600" class="img-thumbnail" style="max-width: 100%; height: auto;">
            @endif
        </div>
    </div>


</div>