<div>
    <div class="mb-4 flex items-center space-x-4">
        <label for="{{ $inputId }}" class="block text-gray-700 text-sm font-bold mr-2"></label>
        <input
            type="text"
            id="{{ $inputId }}"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            placeholder="{{ $inputPlaceholder }}"
            disabled>
        <button
            type="button"
            id="{{ $buttonId }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            {{ $label }}
        </button>
    </div>

    <!-- Component Modal -->
    <x-modal :name="$modalName">
        <div>
            <h3 class="text-xl font-bold">{{ $label }}</h3>

            <input
                type="text"
                id="{{ $searchId }}"
                class="w-full border rounded py-2 px-3 mt-4"
                placeholder="Filtrar...">

            <div class="overflow-y-auto max-h-64 border rounded mt-4">
                <ul id="{{ $listId }}" class="divide-y divide-gray-300">
                    @foreach ($items as $item)
                        <li class="item py-2 px-4 hover:bg-gray-200">
                            <a
                                href="{{ $item[$itemIdKey] }}"
                                data-name="{{ $item[$itemNameKey] }} {{ $item[$itemSurnameKey] }}">
                                {{ $item[$itemNameKey] }} {{ $item[$itemSurnameKey] }} - {{ $item[$itemIdKey] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="mt-4 flex justify-end">
                <button 
                    type="button"
                    id="close-modal-{{ $modalName }}"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Cancelar
                </button>
            </div>
        </div>
    </x-modal>

    <script>
        document.querySelectorAll('#{{ $listId }} .item a').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const id = this.getAttribute('href');
                const name = this.getAttribute('data-name');
                
                document.getElementById('{{ $inputId }}').value = `${name} -  ${id}`;
                const hiddenInputName = '{{ str_replace("-info", "_id", $inputId) }}';
                const hiddenInput = document.querySelector(`input[name="${hiddenInputName}"]`);
                if (hiddenInput) hiddenInput.value = id;

                window.dispatchEvent(new CustomEvent('close-modal', { detail: '{{ $modalName }}' }));
            });
        });


        document.getElementById('{{ $buttonId }}').addEventListener('click', function() {
            window.dispatchEvent(new CustomEvent('open-modal', { detail: '{{ $modalName }}' }));
        });

        document.getElementById('close-modal-{{ $modalName }}').addEventListener('click', function() {
            window.dispatchEvent(new CustomEvent('close-modal', { detail: '{{ $modalName }}' }));
        });

        document.getElementById('{{ $searchId }}').addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            const items = document.querySelectorAll('#{{ $listId }} .item');
            items.forEach(item => {
                const text = item.textContent.toLowerCase();
                item.style.display = text.includes(filter) ? 'block' : 'none';
            });
        });
    </script>
</div>
