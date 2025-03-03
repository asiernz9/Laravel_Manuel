<x-layouts.layout>
    <div class="flex flex-row justify-center items-center min-h-full bg-gray-300">
        <div class="bg-white p-3 rounded-2xl">
            <!-- Mostrar errores de validación -->
            @if ($errors->any())
                <div role="alert" class="alert alert-error mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('projects.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <div>
                            <x-input-label for="title" value="Título del Proyecto" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required />
                        </div>
                        <div>
                            <x-input-label for="estimated_hours" value="Horas Previstas" />
                            <x-text-input id="estimated_hours" class="block mt-1 w-full" type="number" name="estimated_hours" :value="old('estimated_hours')" required />
                        </div>
                        <div>
                            <x-input-label for="start_date" value="Fecha de Inicio" />
                            <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="old('start_date')" required />
                        </div>
                        <div class="flex flex-row justify-between p-3">
                            <button class="btn btn-warning" type="submit">Crear Proyecto</button>
                            <a href="{{ route('projects.index') }}" class="btn btn-warning">Cancelar</a>
                        </div>
                    </div>

                    <!-- Optional: Add a table or additional section here if needed -->
                    <div>
                        <!-- You can add additional project-related information here -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.layout>