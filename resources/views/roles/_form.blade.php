@php
    $assignedPermissions = old('permissions', $role->exists ? $role->permissions->pluck('name')->all() : []);
@endphp

<div class="row g-3">
    <div class="col-md-6">
        <label for="name" class="form-label">Nama Role <span class="text-danger">*</span></label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $role->name) }}"
            class="form-control @error('name') is-invalid @enderror"
            placeholder="Contoh: editor"
            required
        >
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label d-block">Permissions</label>
        <div class="row g-2">
            @forelse ($permissions as $permission)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="form-check">
                        <input
                            class="form-check-input @error('permissions') is-invalid @enderror"
                            type="checkbox"
                            name="permissions[]"
                            value="{{ $permission->name }}"
                            id="permission_{{ $permission->id }}"
                            @checked(in_array($permission->name, $assignedPermissions, true))
                        >
                        <label class="form-check-label" for="permission_{{ $permission->id }}">
                            {{ $permission->name }}
                        </label>
                    </div>
                </div>
            @empty
                <div class="col-12 text-muted">Belum ada permission tersedia.</div>
            @endforelse
        </div>
        @error('permissions')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
        @error('permissions.*')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>
