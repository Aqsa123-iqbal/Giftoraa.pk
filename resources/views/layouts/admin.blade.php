<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giftoraa - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --primary-color: #d63384; --dark-sidebar: #1e1e2d; }
        body { background-color: #f4f5f7; font-family: 'Segoe UI', Roboto, sans-serif; }
        .sidebar { height: 100vh; width: 260px; position: fixed; top: 0; left: 0; background-color: var(--dark-sidebar); color: #a2a3b7; z-index: 1000; }
        .sidebar-brand { padding: 24px; font-size: 1.5rem; font-weight: bold; color: white; border-bottom: 1px solid #2b2b40; text-align: center; }
        .sidebar-menu { list-style: none; padding: 20px 0; margin: 0; }
        .sidebar-item a { display: flex; align-items: center; padding: 12px 24px; color: #a2a3b7; text-decoration: none; font-weight: 500; }
        .sidebar-item a:hover, .sidebar-item.active a { color: white; background-color: #1b1b28; border-left: 4px solid var(--primary-color); }
        .main-content { margin-left: 260px; padding: 30px; min-height: 100vh; }
        .top-navbar { background-color: white; padding: 15px 30px; border-bottom: 1px solid #e4e6ef; margin-bottom: 30px; border-radius: 8px; }
        .btn-custom { background-color: var(--primary-color); color: white; border-radius: 8px; font-weight: 600; }
        .btn-custom:hover { background-color: #c2185b; color: white; }
        .card-custom { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-brand">
            <span style="color: var(--primary-color);">Giftoraa</span> Admin
        </div>
        <ul class="sidebar-menu">
            <li class="sidebar-item {{ Request::is('admin/products') ? 'active' : '' }}">
                <a href="{{ route('admin.products.index') }}">📦 Products List</a>
            </li>
            <li class="sidebar-item {{ Request::is('admin/products/create') ? 'active' : '' }}">
                <a href="{{ route('admin.products.create') }}">➕ Add New Product</a>
            </li>
            <hr style="border-color: #2b2b40;">
            <li class="sidebar-item">
                <a href="{{ url('/') }}" target="_blank">🌐 View Website</a>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <div class="top-navbar d-flex justify-content-between align-items-center">
            <h4 class="fw-bold text-dark mb-0">Giftoraa Management Hub</h4>
            <div class="dropdown">
                <span class="fw-bold text-secondary">👋 Admin Mode</span>
            </div>
        </div>
        @yield('admin_content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>