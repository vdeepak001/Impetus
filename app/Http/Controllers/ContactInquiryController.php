<?php

namespace App\Http\Controllers;

use App\Models\ContactInquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactInquiryController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'contact_name' => ['required', 'string', 'max:255'],
            'contact_email' => ['required', 'string', 'email', 'max:255'],
            'contact_phone' => ['required', 'string', 'max:25'],
            'contact_ihsid' => ['nullable', 'string', 'max:100'],
            'contact_query_for' => ['required', 'string', 'max:2000'],
        ]);

        ContactInquiry::query()->create([
            'user_id' => auth()->id(),
            'name' => $validated['contact_name'],
            'email' => $validated['contact_email'],
            'phone' => $validated['contact_phone'],
            'ihsid' => $validated['contact_ihsid'] ?: null,
            'query_for' => $validated['contact_query_for'],
        ]);

        return back()->with('success', 'Your query has been submitted successfully.');
    }
}
