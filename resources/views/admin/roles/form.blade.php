<div class="row">
    <div class="col-sm-12">
        <!-- text input -->
        <div class="form-group">
            <label>Nombre *</label>
            <input type="text" class="form-control" id="name" name="name"
                value="{{ old('nombre', $role->name ?? '' ) }}">
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-12">
        <h3>Lista de permisos</h3>
        @foreach ($permisos as $permiso)
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="permiso_{{ $permiso->id }}"
                    name="permissions[]" value="{{ $permiso->id }}"
                    {{ isset($role) && $role->permissions->contains($permiso) ? 'checked' : '' }}>
                <label class="form-check-label" for="permiso_{{ $permiso->id }}">{{ $permiso->name }}</label>
            </div>
        @endforeach
    </div>
    
</div>
