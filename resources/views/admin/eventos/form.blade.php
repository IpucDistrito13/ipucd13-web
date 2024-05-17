<div class="row">

    <div class="col-md-12">
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Título"
                value="{{ old('title') }}">
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="start">Fecha Inicio</label>
            <input type="datetime-local" class="form-control" id="start" name="start" placeholder="Fecha inicio"
                value="{{ old('start') }}">
            @error('start')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1">Fecha Final</label>
            <input type="datetime-local" class="form-control" id="end" name="end" placeholder="Fecha final">
            @error('end')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1">Lugar</label>
            <input type="text" class="form-control" id="lugar" name="lugar" placeholder="">
            @error('lugar')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>


</div>
