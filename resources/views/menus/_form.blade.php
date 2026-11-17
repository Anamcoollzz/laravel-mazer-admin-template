<div class="row g-3">
    <div class="col-md-6">
        <label for="type" class="form-label">{{ __('Type') }} <span class="text-danger">*</span></label>
        <select id="type" name="type" class="form-select @error('type') is-invalid @enderror" required>
            <option value="item" @selected(old('type', $menu->type) === 'item')>{{ __('item (Sidebar / Submenu Item)') }}</option>
            <option value="title" @selected(old('type', $menu->type) === 'title')>{{ __('title (Sidebar Section Title)') }}</option>
        </select>
        @error('type')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="parent_id" class="form-label">{{ __('Parent Menu') }}</label>
        <select id="parent_id" name="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
            <option value="">{{ __('-- Root (Top Level) --') }}</option>
            @foreach ($parentOptions as $parentOption)
                <option value="{{ $parentOption->id }}" @selected((string) old('parent_id', $menu->parent_id) === (string) $parentOption->id)>
                    {{ $parentOption->parent ? $parentOption->parent->title . ' › ' : '' }}{{ $parentOption->title }}
                </option>
            @endforeach
        </select>
        @error('parent_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="title" class="form-label">{{ __('Title') }} <span class="text-danger">*</span></label>
        <input
            type="text"
            id="title"
            name="title"
            value="{{ old('title', $menu->title) }}"
            class="form-control @error('title') is-invalid @enderror"
            placeholder="{{ __('Contoh: Dashboard') }}"
            required
        >
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="icon" class="form-label">{{ __('Icon Class') }}</label>
        <input
            type="text"
            id="icon"
            name="icon"
            value="{{ old('icon', $menu->icon) }}"
            class="form-control @error('icon') is-invalid @enderror"
            placeholder="{{ __('Contoh: bi bi-grid-fill') }}"
        >
        @error('icon')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label for="route_name" class="form-label">{{ __('Route Name') }}</label>
        <input
            type="text"
            id="route_name"
            name="route_name"
            value="{{ old('route_name', $menu->route_name) }}"
            class="form-control @error('route_name') is-invalid @enderror"
            placeholder="{{ __('Contoh: mazer.index.html') }}"
        >
        @error('route_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label for="url" class="form-label">{{ __('URL (Fallback / External)') }}</label>
        <input
            type="text"
            id="url"
            name="url"
            value="{{ old('url', $menu->url) }}"
            class="form-control @error('url') is-invalid @enderror"
            placeholder="{{ __('Contoh: # atau https://...') }}"
        >
        @error('url')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label for="route_pattern" class="form-label">{{ __('Active Route Pattern') }}</label>
        <input
            type="text"
            id="route_pattern"
            name="route_pattern"
            value="{{ old('route_pattern', $menu->route_pattern) }}"
            class="form-control @error('route_pattern') is-invalid @enderror"
            placeholder="{{ __('Contoh: mazer.component-*.html') }}"
        >
        @error('route_pattern')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label for="permission_name" class="form-label">{{ __('Permission (Opsional)') }}</label>
        <select id="permission_name" name="permission_name" class="form-select @error('permission_name') is-invalid @enderror">
            <option value="">{{ __('-- Public (Tanpa Permission) --') }}</option>
            @foreach ($permissions as $permission)
                <option value="{{ $permission }}" @selected(old('permission_name', $menu->permission_name) === $permission)>
                    {{ $permission }}
                </option>
            @endforeach
        </select>
        @error('permission_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label for="order" class="form-label">{{ __('Order') }} <span class="text-danger">*</span></label>
        <input
            type="number"
            id="order"
            name="order"
            min="0"
            value="{{ old('order', $menu->order ?? 0) }}"
            class="form-control @error('order') is-invalid @enderror"
            required
        >
        @error('order')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4 d-flex align-items-end">
        <div class="form-check form-switch mb-2">
            <input
                class="form-check-input"
                type="checkbox"
                id="is_active"
                name="is_active"
                value="1"
                @checked(old('is_active', $menu->is_active ?? true))
            >
            <label class="form-check-label" for="is_active">{{ __('Active') }}</label>
        </div>
    </div>
</div>
