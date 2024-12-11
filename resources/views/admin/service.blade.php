<x-app-layout>
    <x-slot name="header">
        <h3 class="text-white font-bold text-3xl">Vista de l'Admin</h3>
        <h3 class="text-white font-bold text-2xl">Gestió de Serveis</h3>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-black overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Mostrar missatge d'error -->
                @if (session('error'))
                <div class="bg-red-500 text-white p-4 rounded mb-4">
                    {{ session('error') }}
                </div>
                @endif

                <h2 class="text-center text-2xl font-bold mb-4 text-white mt-5">Llista de Serveis</h2>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Accions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($services as $service)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $service->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form method="GET" action="{{ route('service.edit', $service->id) }}" class="inline">
                                    <x-primary-button type="submit">Modificar</x-primary-button>
                                </form>
                                <form method="POST" action="{{ route('service.destroy', $service->id) }}" class="inline" onsubmit="return confirm('Estàs segur que vols eliminar aquest servei?');">
                                    @csrf
                                    @method('DELETE')
                                    <x-primary-button type="submit">Eliminar</x-primary-button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form method="GET" action="{{ route('service.add') }}">
                    <x-primary-button type="submit">Crear Servei</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>