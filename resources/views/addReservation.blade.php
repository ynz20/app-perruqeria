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

            <!-- Aquest cap amb JavaScript li donarem el valor -->
            <input type="hidden" name="client_id" value="{{ old('client_id') }}">

            <div class="mb-4 flex items-center space-x-4">
                <label for="client-info" class="block text-gray-700 text-sm font-bold mr-2"></label>
                <input type="text" id="client-info" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('client_name') }}" placeholder="Nom i DNI del client seleccionat" disabled>
                <button type="button" id="select-client" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Seleccionar Client
                </button>
            </div>


            <!-- Mes camps de reserva -->

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Afegir Reserva
                </button>
            </div>
        </form>

        <!-- Component modal -->
        <x-modal :name="'client-modal'">
            <div>
                <h3 class="text-xl font-bold">Seleccionar Client</h3>

                <!-- Filtres... -->
                <input type="text" id="search-client" class="w-full border rounded py-2 px-3 mt-4" placeholder="Filtrar...">

                <!-- Llista de clients -->
                <div class="overflow-y-auto max-h-64 border rounded mt-4">
                    <ul id="client-list" class="divide-y divide-gray-300">
                        @foreach ($clients as $client)
                        <li class="client-item py-2 px-4 hover:bg-gray-200">
                            <a href="{{ $client->dni }}" data-name=" {{ $client->name }} {{ $client->surname }}">{{ $client->name }} {{ $client->surname }} - DNI: {{ $client->dni }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="mt-4 flex justify-end">
                    <button type="button" id="close-modal" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Cancelar
                    </button>
                </div>
            </div>
        </x-modal>

    </div>

    <script>
        document.querySelectorAll('.client-item a').forEach(clientLink => {
            clientLink.addEventListener('click', function(event) {
                event.preventDefault();
                const dni = this.getAttribute('href');//Obtenim el DNI...
                const name = this.getAttribute('data-name');
                document.querySelector('input[name="client_id"]').value = dni;
                document.getElementById('client-info').value = `${name} - DNI: ${dni}` //Guardem el client seleccionat
                window.dispatchEvent(new CustomEvent('close-modal', {
                    detail: 'client-modal'
                }));
            });
        });

        document.getElementById('select-client').addEventListener('click', function() {
            // Disparar el evento de abrir el modal
            window.dispatchEvent(new CustomEvent('open-modal', {
                detail: 'client-modal'
            }));
        });

        document.getElementById('close-modal').addEventListener('click', function() {
            // Disparar el evento de cerrar el modal
            window.dispatchEvent(new CustomEvent('close-modal', {
                detail: 'client-modal'
            }));
        });

        document.getElementById('search-client').addEventListener('input', function() {
            const filtreAplicat = this.value.toLowerCase();
            const clients = document.querySelectorAll('.client-item');
            clients.forEach(function(client) {
                const clientName = client.textContent.toLowerCase();
                if (clientName.includes(filtreAplicat)) {
                    client.style.display = 'block';
                } else {
                    client.style.display = 'none';
                }
            });
        });
    </script>
</x-app-layout>