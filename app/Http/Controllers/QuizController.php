<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Yahan model use kar liya

class QuizController extends Controller
{
    /**
     * Show the Gift Finder form.
     */
    public function index()
    {
        return view('quiz.index');
    }

    /**
     * Process the preferences and return recommended products.
     */
    public function getRecommendations(Request $request)
    {
        // 1. Validation: Request check karein
        $request->validate([
            'recipient' => 'required|string',
            'occasion' => 'required|string',
        ]);

        // 2. Database Search
        // LIKE operator comma-separated values ko dhoondne mein madad karta hai
        $products = Product::where('recipient', 'LIKE', '%' . $request->recipient . '%')
                           ->where('occasion', 'LIKE', '%' . $request->occasion . '%')
                           ->get();

        // 3. Return the results view with products data
        return view('quiz.results', compact('products'));
    }
}