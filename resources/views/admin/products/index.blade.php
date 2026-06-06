@extends('layouts.admin')

@section('admin_content')
<div class="card card-custom p-4 bg-white shadow-sm border-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Products List</h3>
            <p class="text-muted small mb-0">Manage and view all your store items</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary px-4">+ Add Product</a>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">🔍</span>
                <input type="text" id="adminSearchInput" class="form-control bg-light border-start-0" placeholder="Search product by name..." onkeyup="searchAdminProducts()">
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table align-middle table-hover border-top">
            <thead class="table-light text-muted">
                <tr>
                    <th>Product Details</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="adminProductTableBody">
                @forelse($products as $product)
                <tr class="product-row">
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('images/' . $product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 class="rounded-3 me-3" 
                                 style="width: 55px; height: 55px; object-fit: cover; border: 1px solid #e4e6ef;"
                                 onerror="this.src='{{ asset('images/default.png') }}';">
                            <span class="fw-semibold text-dark fs-6 product-name">{{ $product->name }}</span>
                        </div>
                    </td>
                    <td><span class="badge bg-secondary rounded-pill px-3">{{ $product->category }}</span></td>
                    <td class="fw-bold text-dark">Rs. {{ number_format($product->price) }}</td>
                    <td>
                        @if($product->stock > 0)
                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 p-2 px-3 rounded-pill">
                                {{ $product->stock }} In Stock
                            </span>
                        @else
                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 p-2 px-3 rounded-pill">
                                Out of Stock
                            </span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary me-1 px-3">Edit ✏️</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger px-2">Delete 🗑️</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr id="noAdminProductsRow">
                    <td colspan="5" class="text-center text-muted py-5">No products found. Click "+ Add Product" to begin!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
function searchAdminProducts() {
    let input = document.getElementById("adminSearchInput").value.toLowerCase().trim();
    let rows = document.querySelectorAll(".product-row");
    let tableBody = document.getElementById("adminProductTableBody");
    let foundAny = false;

    rows.forEach(row => {
        let nameElement = row.querySelector(".product-name");
        if (nameElement) {
            let nameText = nameElement.innerText.toLowerCase();
            if (nameText.includes(input)) {
                row.style.display = "";
                foundAny = true;
            } else {
                row.style.display = "none";
            }
        }
    });

    let existingMsgRow = document.getElementById("noMatchingAdminProducts");
    if (!foundAny && input !== "") {
        if (!existingMsgRow) {
            let msgRow = document.createElement("tr");
            msgRow.id = "noMatchingAdminProducts";
            msgRow.innerHTML = `<td colspan="5" class="text-center text-muted py-4">No matching products found 😢</td>`;
            tableBody.appendChild(msgRow);
        }
    } else {
        if (existingMsgRow) existingMsgRow.remove();
    }
}
</script>
@endsection