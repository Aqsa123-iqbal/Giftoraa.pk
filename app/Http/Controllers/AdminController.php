<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class AdminController extends Controller
{
    public function index()
    {
        // 1. Check: Agar admin nahi hai to home page bhej do
        if (!auth()->check() || (int)auth()->user()->is_admin !== 1) {
            return redirect('/');
        }

        // 2. Redirect: Dashboard ke bajaye seedha Products list wale route par bhej dein
        // Make sure aapka route name 'admin.products.index' hi hai
        return redirect()->route('admin.products.index');
    }
}