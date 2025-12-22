<?php

namespace App\Http\Controllers;

use App\Models\QuoteRequest;
use Illuminate\Http\Request;

class QuoteRequestController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'industry' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        QuoteRequest::create($validated);

        return redirect()->back()->with('success', 'Your quote request has been submitted successfully!');
    }
}
