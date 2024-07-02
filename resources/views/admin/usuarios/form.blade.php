<div class="row">

    <div class="col-sm-4">
        <!-- select input -->
        <div class="form-group">
            <label>Congregación *</label>
            <select id="congregacion" name="congregacion" class="form-control select2" style="width: 100%;">
                <option value="" selected disabled>Selecciona</option>
                @foreach ($congregaciones as $congregacion)
                    <option value="{{ $congregacion->id }}"
                        {{ old('congregacion') == $congregacion->id || (isset($usuario) && $usuario->congregacion_id == $congregacion->id) ? 'selected' : '' }}>
                        {{  $congregacion->direccion .' - '.  $congregacion->nombre }}
                    </option>
                @endforeach
            </select>

            @error('congregacion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-3">
        <!-- text input -->
        <div class="form-group">
            <label>Nombre *</label>
            <input type="text" class="form-control" id="nombre" name="nombre"
                value="{{ old('nombre', $usuario->nombre ?? '') }}">
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

    </div>

    <div class="col-sm-3">
        <!-- text input -->
        <div class="form-group">
            <label>Apellidos *</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos"
                value="{{ old('apellidos', $usuario->apellidos ?? '') }}">
            @error('apellidos')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

    </div>

    <div class="col-sm-2">
        <!-- text input -->
        <div class="form-group">
            <label>Celular *</label>
            <input type="numeric" class="form-control" id="celular" name="celular"
                value="{{ old('celular', $usuario->celular ?? '') }}">
            @error('celular')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

    </div>

    <div class="col-sm-9">
        <!-- text input -->
        <div class="form-group">
            <label>Correo electrónico *</label>
            <input type="text" class="form-control" id="email" name="email"
                value="{{ old('email', $usuario->email ?? '') }}">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <label for="codigo">Código *</label>
            <input type="text" name="codigo" id="codigo" class="form-control"
                value="{{ old('codigo', $usuario->codigo ?? '') }}">
            @if ($errors->has('codigo'))
                <span class="text-danger">{{ $errors->first('codigo') }}</span>
            @endif
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
            <label for="roles">Roles *</label><br>
            @foreach ($roles as $role)
                <input type="checkbox" name="roles[]" id="role_{{ $role->id }}" value="{{ $role->id }}"
                    @if (in_array($role->id, old('roles', [])) || (isset($usuario) && $usuario->roles->contains($role->id))) checked @endif>
                <label for="role_{{ $role->id }}">{{ $role->name }}</label><br>
            @endforeach
            @if ($errors->has('roles'))
                <span class="text-danger">{{ $errors->first('roles') }}</span>
            @endif
        </div>
    </div>




    <div class="col-sm-12">
        <div class="form-group">
            <label>Imagen perfil </label>
            <input class="form-control-file" type="file" name="file" id="file" accept="image/*"
                onchange="cambiarImagen(event)">
            @error('file')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
            @php
                $imageUrl = isset($usuario) && $usuario->imagen && $usuario->imagen->url
                    ? Storage::url($usuario->imagen->url)
                    : 'https://cdn.icon-icons.com/icons2/3250/PNG/512/person_circle_filled_icon_202012.png';
            @endphp
            <img id="imagen" src="{{ $imageUrl }}" alt="Imagen del usuario" class="img-thumbnail">
        </div>
    </div>
    



</div>
