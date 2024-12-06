<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Afegir Client') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto">
        <h1 class="text-center text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8">Afegir un Client</h1>

        <form method="POST" action="{{ route('client.store') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Nom:</label>
                <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="surname" class="block text-gray-700 font-bold mb-2">Cognom:</label>
                <input type="text" name="surname" id="surname" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="dni" class="block text-gray-700 font-bold mb-2">DNI:</label>
                <input type="text" name="dni" id="dni" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                @error('dni')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="telf" class="block text-gray-700 font-bold mb-2">Telèfon:</label>
                <input type="text" name="telf" id="telf" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
                <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between mt-2">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Afegir Client
                </button>
            </div>
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4 text-center">
                    {{ session('success') }}
                </div>
            @endif
        </form>
    </div>
</x-app-layout>
