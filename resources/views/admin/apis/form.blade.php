<div class="row">

    <div class="col-sm-9">
        <!-- text input -->
        <div class="form-group">
            <label>API *</label>
            <input type="text" class="form-control" id="apikey" name="apikey" readonly
                value="{{ old('apikey', $key->apikey  ?? '') }}" >
            @error('apikey')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-3">
        <!-- select input -->
        <div class="form-group">
            <label>Tipo *</label>
            <select name="tipo" id="tipo" class="form-control">
                <option value="web" {{ old('tipo', $tipo ?? '') == 'web' ? 'selected' : '' }}>
                    Web
                </option>
                <option value="api" {{ old('tipo', $tipo ?? '') == 'api' ? 'selected' : '' }}>
                    API
                </option>
            </select>
            @error('tipo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label>Descripción</label>
            <textarea class="form-control" rows="5" placeholder="" id="descripcion" name="descripcion">{{ old('descripcion', $descripcion ?? '') }}</textarea>
            @error('descripcion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

</div>
