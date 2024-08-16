<div class="row">

    <div class="col-sm-4">
        <!-- text input -->
        <div class="form-group">
            <label>Nombre y apellidos *</label>
            <input type="text" class="form-control" id="nombre" name="nombre"
            placeholder="Escriba nombre y apellidos del bautisado"
                value="{{ old('nombre') }}" >
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-4">
        <!-- text input -->
        <div class="form-group">
            <label>Municipio *</label>
            <input type="text" class="form-control" id="municipio" name="municipio"
            placeholder="Escriba el municipio"
                value="{{ old('municipio') }}">
            @error('municipio')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="start">Fecha *</label>
            <input type="date" class="form-control" id="start" name="start" placeholder="Fecha inicio"
            placeholder="Seleccione la fecha del bautismo"
                value="{{ old('start') }}">
            @error('start')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    

</div>
