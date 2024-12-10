<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Afegir Reserva') }}
        </h2>
    </x-slot>
    <div class="py-12 max-w-4xl mx-auto">
        <h1 class="text-center text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8">Afegir una Reserva</h1>

        <form method="POST" action="{{ route('reservation.store') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <input type="hidden" name="client_id" value="{{ old('client_id') }}">
            <x-selector-component
                label="Seleccionar Client"
                input-id="client-info"
                input-placeholder="Nom i DNI del client seleccionat"
                button-id="select-client"
                modal-name="client-modal"
                list-id="client-list"
                search-id="search-client"
                :items="$clients"
                item-name-key="name"
                item-surname-key="surname"
                item-id-key="dni" />

            <div class="mb-4">
                <label for="reservation-date" class="block text-gray-700 text-sm font-bold mb-2">Seleccioni data</label>
                <input type="date" name="reservation_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <input type="hidden" name="user_id" value="{{ old('user_id') }}">
            <x-selector-component
                label="Seleccionar Treballador"
                input-id="user-info"
                input-placeholder="Nom i DNI del treballador seleccionat"
                button-id="select-worker"
                modal-name="user-modal"
                list-id="user-list"
                search-id="search-user"
                :items="$treballadors"
                item-name-key="name"
                item-surname-key="surname"
                item-id-key="dni" />

            <input type="hidden" name="service_id" value="{{ old('service_id') }}">
            <x-selector-component
                label="Seleccionar Servei"
                input-id="service-info"
                input-placeholder="Servei seleccionat "
                button-id="select-service"
                modal-name="service-modal"
                list-id="service-list"
                search-id="search-service"
                :items="$serveis"
                item-name-key="name"
                item-surname-key="price"
                item-id-key="id" />

            <div class="mb-4">
                <label for="reservation-time" class="block text-gray-700 text-sm font-bold mb-2">Seleccioni Hora</label>
                <input type="time" name="reservation_time" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Afegir Reserva
                </button>
            </div>
        </form>

    </div>
</x-app-layout>