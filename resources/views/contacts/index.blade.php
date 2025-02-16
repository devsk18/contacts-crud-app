<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contacts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="bg-green-500 text-white p-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-500 text-white p-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <a href="{{ route('contacts.create') }}" class="bg-green-500 text-white px-4 py-2 rounded mb-4 float-end">Create Contact</a>
                    <a href="{{ route('import.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 float-end me-2">Import Contacts</a>
                    
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 px-4 py-2">Name</th>
                                <th class="border border-gray-300 px-4 py-2">Phone No</th>
                                <th class="border border-gray-300 px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $contact)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $contact->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">{{ '+' . $contact->country_code . ' ' . $contact->phone_no }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">
                                        <div class="flex items-center justify-center gap-4">
                                            <a href="{{ route('contacts.edit', $contact->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
                                            <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-5">
                        {{ $contacts->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
