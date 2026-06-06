@extends('layouts.admin')

@section('admin_content')
<div class="container-fluid px-0" style="max-width: 700px;">
    <div class="card card-custom p-4 bg-white">
        <h3 class="fw-bold text-dark mb-2">Edit Product Details ✏️</h3>
        
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Product Name</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}" style="padding: 10px; border-radius: 8px;" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Category</label>
                <select name="category" class="form-select" style="padding: 10px; border-radius: 8px;" required>
                    <option value="Bouquets" {{ $product->category == 'Bouquets' ? 'selected' : '' }}>Bouquets</option>
                    <option value="Perfumes" {{ $product->category == 'Perfumes' ? 'selected' : '' }}>Perfumes</option>
                    <option value="Gift Hampers" {{ $product->category == 'Gift Hampers' ? 'selected' : '' }}>Gift Hampers</option>
                    <option value="Accessories" {{ $product->category == 'Accessories' ? 'selected' : '' }}>Accessories</option>
                    <option value="Teddy Bear" {{ $product->category == 'Teddy Bear' ? 'selected' : '' }}>Teddy Bear</option>
                </select>
            </div>

            {{-- Multiple Recipient Checkboxes --}}
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Recipient (Select Multiple)</label><br>
                @php $recipients = explode(',', $product->recipient); @endphp
                @foreach(['partner', 'friend', 'sister', 'mother', 'parent'] as $r)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="recipient[]" value="{{ $r }}" {{ in_array($r, $recipients) ? 'checked' : '' }}>
                        <label class="form-check-label text-capitalize">{{ $r }}</label>
                    </div>
                @endforeach
            </div>

            {{-- Multiple Occasion Checkboxes --}}
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Occasion (Select Multiple)</label><br>
                @php $occasions = explode(',', $product->occasion); @endphp
                @foreach(['birthday', 'anniversary'] as $o)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="occasion[]" value="{{ $o }}" {{ in_array($o, $occasions) ? 'checked' : '' }}>
                        <label class="form-check-label text-capitalize">{{ $o }}</label>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-secondary">Price (Rs.)</label>
                    <input type="number" name="price" class="form-control" value="{{ $product->price }}" style="padding: 10px; border-radius: 8px;" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-secondary">Stock</label>
                    <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" style="padding: 10px; border-radius: 8px;" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label fw-semibold">Product Description</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold text-secondary">Change Image (Optional)</label>
                <input type="file" name="image" class="form-control" style="border-radius: 8px;">
            </div>

            <div class="d-flex gap-2 justify-content-end">
                <a href="{{ route('admin.products.index') }}" class="btn btn-light px-4">Cancel</a>
                <button type="submit" class="btn btn-success px-4">Update Changes 🔄</button>
            </div>
        </form>
    </div>
</div>
@endsection