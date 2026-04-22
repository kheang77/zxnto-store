@extends('master')
@section('title', 'Add Product â€” ZXNTO')

@section('head')
<style>
    .form-page { max-width: 800px; margin: 48px auto 80px; padding: 0 32px; }
    .breadcrumb { display: flex; align-items: center; gap: 8px; font-size: .75rem; color: var(--muted); margin-bottom: 28px; text-transform: uppercase; letter-spacing: .06em; }
    .breadcrumb a { color: var(--muted); transition: color .2s; }
    .breadcrumb a:hover { color: var(--gold); }
    .breadcrumb i { font-size: .6rem; color: var(--border2); }
    .form-page-title { font-family: var(--font-head); font-size: 2.2rem; font-weight: 800; text-transform: uppercase; letter-spacing: -.01em; margin-bottom: 6px; }
    .form-page-sub { color: var(--muted); font-size: .875rem; margin-bottom: 36px; }

    .form-card { background: var(--bg2); border: 1px solid var(--border); border-radius: var(--radius-lg); overflow: hidden; }
    .form-sec { padding: 28px 32px; border-bottom: 1px solid var(--border); }
    .form-sec:last-child { border-bottom: none; }
    .form-sec-label {
        font-size: .68rem; font-weight: 700; color: var(--gold);
        text-transform: uppercase; letter-spacing: .14em; margin-bottom: 22px;
        display: flex; align-items: center; gap: 10px;
    }
    .form-sec-label::after { content: ''; flex: 1; height: 1px; background: var(--border); }

    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .form-group { display: flex; flex-direction: column; gap: 7px; margin-bottom: 16px; }
    .form-group:last-child { margin-bottom: 0; }
    label { font-size: .8rem; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: .06em; }
    label .req { color: var(--gold); margin-left: 2px; }
    .form-control {
        padding: 11px 14px; background: var(--bg3); border: 1px solid var(--border2);
        border-radius: var(--radius); color: var(--text); font-family: var(--font-body);
        font-size: .9rem; outline: none; transition: border .2s; width: 100%;
    }
    .form-control::placeholder { color: var(--muted); }
    .form-control:focus { border-color: var(--gold); background: var(--surface); }
    .form-control.error { border-color: var(--red); }
    textarea.form-control { resize: vertical; min-height: 110px; }
    .field-error { font-size: .75rem; color: var(--red); }

    .upload-zone {
        border: 1px dashed var(--border2); border-radius: var(--radius);
        padding: 48px 20px; text-align: center; cursor: pointer;
        transition: all .2s; position: relative; background: var(--bg3);
    }
    .upload-zone:hover { border-color: var(--gold); background: rgba(201,168,76,.04); }
    .upload-zone input[type=file] { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }
    .upload-icon { font-size: 2rem; color: var(--muted); margin-bottom: 12px; }
    .upload-title { font-size: .9rem; font-weight: 600; color: var(--text); margin-bottom: 4px; }
    .upload-hint { font-size: .78rem; color: var(--muted); }
    .preview-wrap { margin-top: 16px; display: none; }
    .preview-wrap img { width: 100px; height: 100px; object-fit: cover; border-radius: var(--radius); border: 1px solid var(--border2); }

    .form-footer {
        padding: 24px 32px; background: var(--bg3); border-top: 1px solid var(--border);
        display: flex; align-items: center; justify-content: space-between; gap: 12px;
    }

    @media (max-width: 600px) {
        .form-row { grid-template-columns: 1fr; }
        .form-sec { padding: 20px; }
        .form-footer { flex-direction: column; }
        .form-footer .btn { width: 100%; justify-content: center; }
    }
</style>
@endsection

@section('content')
<div class="form-page">
    <div class="breadcrumb">
        <a href="/">Home</a>
        <i class="fas fa-chevron-right"></i>
        <a href="/product">Shop</a>
        <i class="fas fa-chevron-right"></i>
        <span>Add Product</span>
    </div>
    <div class="form-page-title">Add Product</div>
    <div class="form-page-sub">Add a new shoe to the ZXNTO catalog.</div>

    @if($errors->any())
    <div class="alert alert-error" style="margin-bottom:24px">
        <i class="fas fa-exclamation-circle"></i>
        <div>@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
    </div>
    @endif

    <form action="{{ url('product/save') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-card">
            <div class="form-sec">
                <div class="form-sec-label">Basic Information</div>
                <div class="form-group">
                    <label>Product Name <span class="req">*</span></label>
                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'error' : '' }}" placeholder="e.g. Nike Air Max 270" value="{{ old('name') }}" required>
                    @error('name')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Description <span class="req">*</span></label>
                    <textarea name="description" class="form-control {{ $errors->has('description') ? 'error' : '' }}" placeholder="Describe the shoe â€” material, fit, use case..." required>{{ old('description') }}</textarea>
                    @error('description')<span class="field-error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-sec">
                <div class="form-sec-label">Pricing & Inventory</div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Price (USD) <span class="req">*</span></label>
                        <input type="number" name="price" class="form-control {{ $errors->has('price') ? 'error' : '' }}" placeholder="0.00" step="0.01" min="0" value="{{ old('price') }}" required>
                        @error('price')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Quantity <span class="req">*</span></label>
                        <input type="number" name="qty" class="form-control {{ $errors->has('qty') ? 'error' : '' }}" placeholder="0" min="0" value="{{ old('qty') }}" required>
                        @error('qty')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Category <span class="req">*</span></label>
                    <select name="cat_id" class="form-control {{ $errors->has('cat_id') ? 'error' : '' }}" required>
                        <option value="">Select a category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('cat_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('cat_id')<span class="field-error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-sec">
                <div class="form-sec-label">Product Photo</div>
                <div class="upload-zone" id="uploadZone">
                    <input type="file" name="photo" accept="image/*" onchange="previewImage(event)">
                    <div class="upload-icon"><i class="fas fa-cloud-arrow-up"></i></div>
                    <div class="upload-title">Click or drag to upload</div>
                    <div class="upload-hint">PNG, JPG, WEBP â€” max 5MB</div>
                </div>
                <div class="preview-wrap" id="previewWrap">
                    <img id="previewImg" src="" alt="Preview">
                </div>
            </div>

            <div class="form-footer">
                <a href="/product" class="btn btn-ghost"><i class="fas fa-arrow-left"></i> Back</a>
                <button type="submit" class="btn btn-gold btn-lg"><i class="fas fa-plus"></i> Add Product</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
function previewImage(e) {
    const file = e.target.files[0];
    if (!file) return;
    document.getElementById('previewImg').src = URL.createObjectURL(file);
    document.getElementById('previewWrap').style.display = 'block';
    document.getElementById('uploadZone').style.borderColor = 'var(--gold)';
}
</script>
@endsection

