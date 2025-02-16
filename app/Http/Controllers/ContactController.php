<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::where('user_id', Auth::id())->paginate(10);
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactRequest $request)
    {
        try {
            Contact::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'country_code' => $request->country_code,
                'phone_no' => $request->phone_no,
            ]);
    
            return redirect()->route('contacts.index')->with('success', 'Contact added successfully.');

        } catch (\Exception $e) {
            return redirect()->route('contacts.index')->with('error', "Something went wrong. Operation Failed");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        try {
            $contact->update([
                'name' => $request->name,
                'country_code' => $request->country_code,
                'phone_no' => $request->phone_no,
            ]);
    
            return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');

        } catch (\Exception $e) {
            return redirect()->route('contacts.index')->with('error', "Something went wrong. Operation Failed");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        if($contact->user_id != Auth::id()) {
            abort(403);
        }
        try {
            $contact->delete();
            return redirect()->route('contacts.index')->with('success', "Contact deleted successfully.");
        } catch (\Exception $e) {
            return redirect()->route('contacts.index')->with('error', "Something went wrong. Operation Failed");
        }
    }
}
