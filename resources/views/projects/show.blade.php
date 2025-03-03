<x-layouts.layout>
    <div class="flex flex-row justify-center items-center min-h-full bg-gray-300">
        <div class="bg-white p-6 rounded-2xl w-full max-w-2xl">
            <h2 class="text-2xl font-bold mb-4 text-center">Detalles del Proyecto</h2>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <div class="mb-4">
                        <x-input-label value="Título del Proyecto" />
                        <p class="mt-1 w-full p-2 border rounded">{{ $project->title }}</p>
                    </div>
                    
                    <div class="mb-4">
                        <x-input-label value="Horas Previstas" />
                        <p class="mt-1 w-full p-2 border rounded">{{ $project->estimated_hours }}</p>
                    </div>
                    
                    <div class="mb-4">
                        <x-input-label value="Fecha de Inicio" />
                        <p class="mt-1 w-full p-2 border rounded">
                            {{ $project->start_date->format('d/m/Y') }}
                        </p>
                    </div>
                    
                    <div class="flex flex-row justify-between">
                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-warning">Editar</a>
                        <a href="{{ route('projects.index') }}" class="btn btn-warning">Volver</a>
                    </div>
                </div>
                
                <div>
                    <!-- Optional: Add additional project details or a sidebar -->
                    <div class="bg-gray-100 p-4 rounded">
                        <h3 class="font-semibold mb-2">Información Adicional</h3>
                        <p>Puedes agregar más detalles del proyecto aquí.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.layout>