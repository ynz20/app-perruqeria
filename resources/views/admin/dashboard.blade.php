<x-app-layout>
    <x-slot name="header">
        <h3 class="text-white font-bold text-3xl">Vista del Admin</h3>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-4 text-white">Calendari de Reserves</h3>
                    <div class="grid grid-cols-7 gap-4">
                     
                        <div class="col-span-1 text-center font-bold text-white">Diumenge</div>
                        <div class="col-span-1 text-center font-bold text-white">Dilluns</div>
                        <div class="col-span-1 text-center font-bold text-white">Dimarts</div>
                        <div class="col-span-1 text-center font-bold text-white">Dimecres</div>
                        <div class="col-span-1 text-center font-bold text-white">Dijous</div>
                        <div class="col-span-1 text-center font-bold text-white">Divendres</div>
                        <div class="col-span-1 text-center font-bold text-white">Dissabte</div>
                     

                        @foreach($days as $day)
                        <div class="border p-4 bg-white rounded-lg">
                            <div class="font-bold text-center">{{ $day->format('d') }}</div>
                            <div class="text-sm">
                                @foreach($reservas as $reserva)
                                @if(Carbon\Carbon::parse($reserva->reservation_date)->isSameDay($day))
                                <div class="bg-orange-500 text-white p-1 rounded mt-1">
                                    Client: {{ $reserva->client->name ?? 'Client' }}
                                    Servei: {{ $reserva->service->name ?? 'Service' }}
                                    Hora: {{$reserva->reservation_time}}
                                    Treballador: {{$reserva->user->name}}
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form method="GET" action="{{ route('client.add') }}">
                    <x-primary-button type="submit">Crear Client</x-primary-button>
                </form>
            </div>
        </div>
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form method="GET" action="{{ route('service.view') }}">
                    <x-primary-button type="submit">Gestio de Serveis</x-primary-button>
                </form>
            </div>
        </div>
    </div>




    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form method="GET" action="{{ route('reservation.create') }}">
                    <x-primary-button type="submit">Afegir reserva</x-primary-button>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-8">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-4 text-white font-bold">Usuaris amb Rol 'user'</h3>
                    @if($users->isEmpty())
                    <div class="bg-orange-500 text-white text-1xl font-bold p-4 rounded mb-4">
                        No s'han trobat treballadors registrats.
                    </div>
                    @else
                    <table class="min-w-full bg-gray-100 dark:bg-gray-700 shadow-md rounded-lg">
                        <thead class="bg-blue-600 dark:bg-blue-800">
                            <tr>
                                <th class="px-6 py-2 text-left text-white">DNI</th>
                                <th class="px-6 py-2 text-left text-white">Nom</th>
                                <th class="px-6 py-2 text-left text-white">Correu</th>
                                <th class="px-6 py-2 text-left text-white">Rol</th>
                                <th class="px-6 py-2 text-left text-white">Opcions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($users as $user)
                            <tr class="bg-white">
                                <td class="px-6 py-2 border">{{ $user->dni }}</td>
                                <td class="px-6 py-2 border">{{ $user->name }}</td>
                                <td class="px-6 py-2 border">{{ $user->email }}</td>
                                <td class="px-6 py-2 border">{{ $user->role }}</td>
                                <td class="px-6 py-2 border">
                                    <form method="POST" action="{{ route('user.changeRoleToAdmin', $user->id) }}">
                                        @csrf
                                        <x-primary-button type="submit">Cambiar Rol a Admin</x-primary-button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>