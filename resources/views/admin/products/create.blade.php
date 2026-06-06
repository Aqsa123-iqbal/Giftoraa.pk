@extends('layouts.admin')

@section('admin_content')
<div class="container-fluid px-0" style="max-width: 700px;">
    <div class="card card-custom p-4 bg-white">
        <h3 class="fw-bold text-dark mb-2">Create New Product 🎁</h3>
        
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Product Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Category</label>
                <select name="category" class="form-select" required>
                    <option value="Bouquets">Bouquets</option>
                    <option value="Perfumes">Perfumes</option>
                    <option value="Gift Hampers">Gift Hampers</option>
                    <option value="Accessories">Accessories</option>
                    <option value="Teddy Bear">Teddy Bear</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Recipient (Select Multiple)</label><br>
                @foreach(['partner', 'friend', 'sister', 'mother', 'brother'] as $r)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="recipient[]" value="{{ $r }}">
                        <label class="form-check-label text-capitalize">{{ $r }}</label>
                    </div>
                @endforeach
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Occasion (Select Multiple)</label><br>
                @foreach(['birthday', 'anniversary', 'graduation'] as $o)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="occasion[]" value="{{ $o }}">
                        <label class="form-check-label text-capitalize">{{ $o }}</label>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-secondary">Price (Rs.)</label>
                    <input type="number" name="price" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-secondary">Stock</label>
                    <input type="number" name="stock" class="form-control" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Description</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold text-secondary">Image</label>
                <input type="file" name="image" class="form-control" required>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success px-4">Save & Publish ✨</button>
            </div>
        </form>
    </div>
</div>
@endsection