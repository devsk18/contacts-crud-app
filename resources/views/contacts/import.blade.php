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
                    <div class="bg-white p-6">
                        <h2 class="text-xl font-semibold mb-4">Import Contacts <small>(XML files only)</small></h2>
                        @if ($errors->any())
                            <div class="bg-red-500 text-white p-3 rounded mb-4">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('import.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="xml_file" accept="text/xml" required
                                class="block w-full p-2 border border-gray-300 rounded">

                            <br />
                            <div class="flex gap-4">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 float-end">
                                    Import
                                </button>

                                <a href="{{ route('contacts.index') }}"
                                    class="bg-gray-500 text-white px-4 py-2 rounded mb-4 float-end">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>