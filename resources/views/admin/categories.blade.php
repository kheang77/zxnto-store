@extends('admin.layout')
@section('title','Categories')
@section('page-title','Categories')

@section('content')

<div style="display:grid;grid-template-columns:1fr 2fr;gap:20px;align-items:start">

    {{-- Add Category --}}
    <div class="form-section">
        <div class="form-section-head">Add New Category</div>
        <div class="form-section-body">
            <form method="POST" action="/admin/categories/store">
                @csrf
                <div class="form-group">
                    <label class="form-label">Category Name <span class="req">*</span></label>
                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'error' : '' }}"
                           placeholder="e.g. Running Shoes" value="{{ old('name') }}" required>
                    @error('name')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <button type="submit" class="btn btn-gold" style="width:100%;justify-content:center">
                    <i class="fas fa-plus"></i> Add Category
                </button>
            </form>
        </div>
    </div>

    {{-- Category List --}}
    <div class="card">
        <div class="card-head">
            <div class="card-title">All Categories <span style="color:var(--muted);font-size:.8rem;font-weight:400">({{ $categories->total() }})</span></div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Products</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $cat)
                <tr>
                    <td style="color:var(--muted);font-size:.78rem">{{ $cat->id }}</td>
                    <td style="font-weight:600">{{ $cat->name }}</td>
                    <td><span class="badge badge-green">{{ $cat->products_count }}</span></td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <button class="btn btn-ghost btn-sm btn-icon" title="Edit"
                                onclick="openEdit('{{ $cat->id }}','{{ addslashes($cat->name) }}')">
                                <i class="fas fa-pen"></i>
                            </button>
                            <button class="btn btn-red btn-sm btn-icon" title="Delete"
                                onclick="confirmDelete('{{ $cat->id }}','{{ addslashes($cat->name) }}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align:center;padding:40px;color:var(--muted)">No categories yet.</td></tr>
                @endforelse
            </tbody>
        </table>
        @if($categories->hasPages())
        <div style="padding:16px 20px;border-top:1px solid var(--border)">
            <div style="display:flex;align-items:center;justify-content:space-between;font-size:.8rem;color:var(--muted)">
                <span>Showing {{ $categories->firstItem() }}–{{ $categories->lastItem() }} of {{ $categories->total() }}</span>
                <div style="display:flex;gap:4px">
                    @if($categories->onFirstPage())
                        <span style="display:flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:var(--radius);border:1px solid var(--border);color:var(--border2);background:var(--surface)"><i class="fas fa-chevron-left"></i></span>
                    @else
                        <a href="{{ $categories->previousPageUrl() }}" style="display:flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:var(--radius);border:1px solid var(--border2);color:var(--muted);background:var(--surface)"><i class="fas fa-chevron-left"></i></a>
                    @endif
                    @foreach($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                        @if($page == $categories->currentPage())
                            <span style="display:flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:var(--radius);background:var(--gold);color:#0e0e0f;font-weight:700;font-size:.82rem">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" style="display:flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:var(--radius);border:1px solid var(--border2);color:var(--muted);background:var(--surface);font-size:.82rem;font-weight:600">{{ $page }}</a>
                        @endif
                    @endforeach
                    @if($categories->hasMorePages())
                        <a href="{{ $categories->nextPageUrl() }}" style="display:flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:var(--radius);border:1px solid var(--border2);color:var(--muted);background:var(--surface)"><i class="fas fa-chevron-right"></i></a>
                    @else
                        <span style="display:flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:var(--radius);border:1px solid var(--border);color:var(--border2);background:var(--surface)"><i class="fas fa-chevron-right"></i></span>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>

</div>

{{-- Edit Modal --}}
<div class="modal-overlay" id="editModal">
    <div class="modal-box">
        <button class="modal-close" onclick="closeEdit()"><i class="fas fa-times"></i></button>
        <div class="modal-title">Edit Category</div>
        <div class="modal-sub">Update the category name below.</div>
        <form method="POST" id="editForm">
            @csrf
            <div class="form-group">
                <label class="form-label">Category Name</label>
                <input type="text" name="name" id="edit-name" class="form-control" required>
            </div>
            <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:8px">
                <button type="button" class="btn btn-ghost" onclick="closeEdit()">Cancel</button>
                <button type="submit" class="btn btn-gold"><i class="fas fa-floppy-disk"></i> Save</button>
            </div>
        </form>
    </div>
</div>

{{-- Delete Modal --}}
<div class="modal-overlay" id="deleteModal">
    <div class="modal-box">
        <button class="modal-close" onclick="closeDelete()"><i class="fas fa-times"></i></button>
        <div class="modal-title">Delete Category</div>
        <div class="modal-sub">Delete <strong id="del-name"></strong>? Products in this category will become uncategorized.</div>
        <form method="POST" id="deleteForm">
            @csrf
            <div style="display:flex;gap:10px;justify-content:flex-end">
                <button type="button" class="btn btn-ghost" onclick="closeDelete()">Cancel</button>
                <button type="submit" class="btn btn-red"><i class="fas fa-trash"></i> Delete</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
function openEdit(id, name) {
    document.getElementById('edit-name').value = name;
    document.getElementById('editForm').action = '/admin/categories/' + id + '/update';
    document.getElementById('editModal').classList.add('open');
}
function closeEdit() { document.getElementById('editModal').classList.remove('open'); }

function confirmDelete(id, name) {
    document.getElementById('del-name').textContent = name;
    document.getElementById('deleteForm').action = '/admin/categories/' + id + '/delete';
    document.getElementById('deleteModal').classList.add('open');
}
function closeDelete() { document.getElementById('deleteModal').classList.remove('open'); }

document.querySelectorAll('.modal-overlay').forEach(m => {
    m.addEventListener('click', function(e) { if(e.target===this) this.classList.remove('open'); });
});
</script>
@endsection

