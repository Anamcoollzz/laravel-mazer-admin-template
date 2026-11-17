<div class="row g-3">
    <div class="col-md-6">
        <label for="sku" class="form-label">SKU <span class="text-danger">*</span></label>
        <input
            type="text"
            id="sku"
            name="sku"
            value="{{ old('sku', $product->sku) }}"
            class="form-control @error('sku') is-invalid @enderror"
            placeholder="Contoh: PRD-0001"
            required
        >
        @error('sku')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="name" class="form-label">Nama Produk <span class="text-danger">*</span></label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $product->name) }}"
            class="form-control @error('name') is-invalid @enderror"
            placeholder="Nama produk"
            required
        >
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label for="category" class="form-label">Kategori</label>
        <input
            type="text"
            id="category"
            name="category"
            value="{{ old('category', $product->category) }}"
            class="form-control @error('category') is-invalid @enderror"
            placeholder="Contoh: Electronics"
        >
        @error('category')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label for="price" class="form-label">Harga <span class="text-danger">*</span></label>
        <input
            type="number"
            id="price"
            name="price"
            step="0.01"
            min="0"
            value="{{ old('price', $product->price) }}"
            class="form-control @error('price') is-invalid @enderror"
            required
        >
        @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label for="stock" class="form-label">Stok <span class="text-danger">*</span></label>
        <input
            type="number"
            id="stock"
            name="stock"
            min="0"
            value="{{ old('stock', $product->stock) }}"
            class="form-control @error('stock') is-invalid @enderror"
            required
        >
        @error('stock')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea
            id="description"
            name="description"
            rows="3"
            class="form-control @error('description') is-invalid @enderror"
            placeholder="Deskripsi produk..."
        >{{ old('description', $product->description) }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <div class="form-check form-switch">
            <input
                class="form-check-input"
                type="checkbox"
                id="is_active"
                name="is_active"
                value="1"
                @checked(old('is_active', $product->is_active ?? true))
            >
            <label class="form-check-label" for="is_active">Active</label>
        </div>
    </div>
</div>
