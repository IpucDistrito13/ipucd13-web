<div class="row">


    <div class="col-sm-4">
        <!-- select input -->
        <div class="form-group">
            <label>Name *</label>
            <input type="text" class="form-control" id="name" name="name"
                value="{{ old('name', $permiso->name ?? '') }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-4">
        <!-- select input -->
        <div class="form-group">
            <label>Descripción *</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion"
                value="{{ old('descripcion', $permiso->descripcion ?? '') }}">
            @error('descripcion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-4">
        <!-- select input -->
        <div class="form-group">
            <label>Guard_name *</label>
            <select name="guard_name" id="guard_name" class="form-control">
                <option value="web" {{ old('guard_name', $permiso->guard_name ?? '') == 'web' ? 'selected' : '' }}>Web</option>
                <option value="api" {{ old('guard_name', $permiso->guard_name ?? '') == 'api' ? 'selected' : '' }}>API</option>
            </select>
            @error('guard_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    

</div>