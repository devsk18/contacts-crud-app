<?php

namespace App\Http\Controllers;

use App\Jobs\ImportingContactsJob;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleXMLElement;

class ImportController extends Controller
{
    public function index()
    {
        return view('contacts.import');
    }

    public function store(Request $request)
    {
        $request->validate([
            'xml_file' => 'required|mimes:xml',
        ]);

        $filePath = $request->file('xml_file')->path();
        $userId = Auth::id();

        $importedContacts = [];
        
        $xmlContent = file_get_contents($filePath);
        $xml = new SimpleXMLElement($xmlContent);

        $existingPhoneNumbers = Contact::where('user_id', $userId)
                    ->pluck('phone_no')
                    ->toArray();

        foreach ($xml->contact as $contact) {
            $name = (string) $contact->name;
            $phone = (string) $contact->phone;


            if (preg_match('/^\+(\d{1,3})\s*(\d{3})\s*(\d+)$/', $phone, $matches)) {
                $countryCode = $matches[1];
                $phoneNumber = $matches[2] . $matches[3];
            } else {
                continue;
            }

            if (in_array($phoneNumber, $existingPhoneNumbers)) {
                continue;
            }

            $importedContacts[] = [
                'user_id' => $userId,
                'name' => $name,
                'country_code' => $countryCode,
                'phone_no' => $phoneNumber,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Contact::insert($importedContacts);

        // or we can execute it as a job for processing large files 
        return redirect()->route('contacts.index')->with('success', 'Contacts imported successfully');
    }
}
