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

                    @if ($errors->any())
                        <div class="bg-red-500 text-white p-3 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contacts.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mt-3">Name</label>
                            <input type="text" id="name" name="name" required value="{{ old('name') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                        </div>

                        <div>
                            <label for="country_code" class="block text-sm font-medium text-gray-700 mt-3">Country Code</label>
                            <input type="text" minlength="1" maxlength="4" required id="country_code" name="country_code" value="{{ old('country_code') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                        </div>

                        <div>
                            <label for="phone_no" class="block text-sm font-medium text-gray-700 mt-3">Phone Number</label>
                            <input type="text" minlength="10" maxlength="10" required id="phone_no" name="phone_no" value="{{ old('phone_no') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 float-end mt-3">
                                Save Contact
                            </button>

                            <a href="{{ route('contacts.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mb-4 float-end mt-3">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
