@extends('admin.layout')
@section('title', $product ? 'Edit Product' : 'Add Product')
@section('page-title', $product ? 'Edit Product' : 'Add Product')

@section('content')

<div style="max-width:760px">
    <div style="margin-bottom:20px">
        <a href="/admin/products" class="btn btn-ghost btn-sm"><i class="fas fa-arrow-left"></i> Back to Products</a>
    </div>

    @if($errors->any())
    <div class="alert alert-error">
        <i class="fas fa-exclamation-circle"></i>
        <div>@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
    </div>
    @endif

    <form action="{{ $product ? '/admin/products/'.$product->id.'/update' : '/admin/products/store' }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-section">
            <div class="form-section-head">Basic Information</div>
            <div class="form-section-body">
                <div class="form-group">
                    <label class="form-label">Product Name <span class="req">*</span></label>
                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'error' : '' }}"
                           placeholder="e.g. Nike Air Max 270" value="{{ old('name', $product->name ?? '') }}" required>
                    @error('name')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Description <span class="req">*</span></label>
                    <textarea name="description" class="form-control {{ $errors->has('description') ? 'error' : '' }}"
                              placeholder="Describe the shoe..." required>{{ old('description', $product->description ?? '') }}</textarea>
                    @error('description')<span class="field-error">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>

        <div class="form-section">
            <div class="form-section-head">Pricing & Inventory</div>
            <div class="form-section-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Price (USD) <span class="req">*</span></label>
                        <input type="number" name="price" class="form-control {{ $errors->has('price') ? 'error' : '' }}"
                               placeholder="0.00" step="0.01" min="0" value="{{ old('price', $product->price ?? '') }}" required>
                        @error('price')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Quantity <span class="req">*</span></label>
                        <input type="number" name="qty" class="form-control {{ $errors->has('qty') ? 'error' : '' }}"
                               placeholder="0" min="0" value="{{ old('qty', $product->qty ?? '') }}" required>
                        @error('qty')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Category <span class="req">*</span></label>
                    <select name="cat_id" class="form-control {{ $errors->has('cat_id') ? 'error' : '' }}" required>
                        <option value="">Select a category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('cat_id', $product->cat_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('cat_id')<span class="field-error">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>

        <div class="form-section">
            <div class="form-section-head">Product Photo</div>
            <div class="form-section-body">
                @if($product && $product->img)
                <div style="margin-bottom:12px;display:flex;align-items:center;gap:12px">
                    <img src="{{ asset('storage/'.$product->img) }}" style="width:64px;height:64px;object-fit:cover;border-radius:var(--radius);border:1px solid var(--border2)" alt="">
                    <span style="font-size:.8rem;color:var(--muted)">Current photo â€” upload a new one to replace it</span>
                </div>
                @endif
                <div class="upload-zone" id="uploadZone">
                    <input type="file" name="photo" accept="image/*" onchange="previewImg(event)">
                    <div class="upload-icon"><i class="fas fa-cloud-arrow-up"></i></div>
                    <div class="upload-text">Click or drag to upload</div>
                    <div class="upload-hint">PNG, JPG, WEBP â€” max 5MB</div>
                    <img id="previewImg" class="preview-img" src="" alt="Preview">
                </div>
            </div>
        </div>

        <div class="form-section">
            <div class="form-footer">
                <a href="/admin/products" class="btn btn-ghost"><i class="fas fa-arrow-left"></i> Cancel</a>
                <button type="submit" class="btn btn-gold">
                    <i class="fas fa-{{ $product ? 'floppy-disk' : 'plus' }}"></i>
                    {{ $product ? 'Save Changes' : 'Add Product' }}
                </button>
            </div>
        </div>
    </form>
</div>

@endsection

@section('scripts')
<script>
function previewImg(e) {
    const img = document.getElementById('previewImg');
    img.src = URL.createObjectURL(e.target.files[0]);
    img.style.display = 'block';
    document.getElementById('uploadZone').style.borderColor = 'var(--gold)';
}
</script>
@endsection

