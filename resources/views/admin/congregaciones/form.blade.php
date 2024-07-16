<div class="row">

    <div class="col-sm-4">
        <!-- select input -->
        <div class="form-group">
            <label>Municipio *</label>
            <select id="municipio" name="municipio" class="form-control">
                <option value="" selected disabled>Selecciona</option>
                @foreach ($municipios as $municipio)
                    <option value="{{ $municipio->id }}"
                        {{ isset($congregacion) && $congregacion->municipio_id == $municipio->id ? 'selected' : '' }}>
                        {{ $municipio->nombre . ' - ' . $municipio->departamento->nombre }}
                    </option>
                @endforeach
            </select>
            @error('municipio')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <label>Nombre congregación * </label>
            <input type="text" class="form-control" id="nombre" name="nombre"
                placeholder="IPUC CENTRAL"
                value="{{ old('nombre', $congregacion->nombre ?? '') }}"> @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-5">
        <div class="form-group">
            <label>Dirección congregación * </label>
            <input type="text" class="form-control" id="direccion" name="direccion"
                placeholder="Cl. 10 #12 - 40, Barrio Llano"
                value="{{ old('direccion', $congregacion->direccion ?? '') }}"> @error('direccion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-2">
        <!-- text input -->
        <div class="form-group">
            <label>Latitud *</label>
            <input type="text" class="form-control" id="latitud" name="latitud" placeholder="Opcional"
                value="{{ old('latitud', $congregacion->latitud ?? '') }}">
            @error('latitud')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-2">
        <!-- text input 7°53'07"N 72°30'41"W -->
        <div class="form-group">
            <label>Longitud *</label>
            <input type="text" class="form-control" id="longitud" name="longitud" placeholder="Opcional"
                value="{{ old('longitud', $congregacion->longitud ?? '') }}">
            @error('longitud')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <label>Ubicación Google Maps * </label>
            <input type="text" class="form-control" id="googlemaps" name="googlemaps"
                placeholder="https://www.google.com/maps/place/####"
                value="{{ old('googlemaps', $congregacion->googlemaps ?? '') }}"> @error('googlemaps')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    





    <div class="col-sm-4">
        <div class="form-group">
            <label>Url facebook </label>
            <input type="text" class="form-control" id="urlfacebook" name="urlfacebook"
                placeholder="https://www.facebook.com/profile.php?id=100064279976082"
                value="{{ old('urlfacebook', $congregacion->urlfacebook ?? '') }}"> @error('urlfacebook')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>



</div>
