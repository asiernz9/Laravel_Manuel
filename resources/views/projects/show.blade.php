<x-layouts.layout>
    <div class="container mx-auto px-4 py-8 bg-gray-100 min-h-screen">
        <div class="max-w-6xl mx-auto space-y-6">
            <div class="bg-white shadow-lg rounded-xl p-6">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Detalles del Proyecto</h2>
                
                <div class="grid md:grid-cols-2 gap-6">
                    {{-- Project Details Column --}}
                    <div class="space-y-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Información del Proyecto</h3>
                            
                            <div class="space-y-3">
                                <div>
                                    <x-input-label value="Título del Proyecto" class="text-sm text-gray-600" />
                                    <p class="text-lg font-medium text-gray-900 bg-white p-2 rounded border border-gray-200">
                                        {{ $project->title }}
                                    </p>
                                </div>
                                
                                <div>
                                    <x-input-label value="Horas Previstas" class="text-sm text-gray-600" />
                                    <p class="text-lg font-medium text-gray-900 bg-white p-2 rounded border border-gray-200">
                                        {{ $project->estimated_hours }} horas
                                    </p>
                                </div>
                                
                                <div>
                                    <x-input-label value="Fecha de Inicio" class="text-sm text-gray-600" />
                                    <p class="text-lg font-medium text-gray-900 bg-white p-2 rounded border border-gray-200">
                                        {{ $project->start_date ? $project->start_date->format('d/m/Y') : 'N/A' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Students Column --}}
                    <div class="space-y-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-700">Estudiantes Asignados</h3>
                                <span class="badge badge-primary">
                                    {{ $project->alumnos->count() }} estudiantes
                                </span>
                            </div>

                            @if($project->alumnos->count() > 0)
                                <div class="overflow-x-auto max-h-64 overflow-y-auto">
                                    <table class="w-full bg-white rounded-lg overflow-hidden shadow-sm">
                                        <thead class="bg-gray-100 sticky top-0">
                                            <tr class="text-left text-xs text-gray-600 uppercase tracking-wider">
                                                <th class="p-3">Nombre</th>
                                                <th class="p-3">Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($project->alumnos as $alumno)
                                                <tr class="border-b hover:bg-gray-50 transition">
                                                    <td class="p-3 text-sm text-gray-900">{{ $alumno->nombre }}</td>
                                                    <td class="p-3 text-sm text-gray-600">{{ $alumno->email }}</td>
                                                    <td class="p-3 text-sm text-gray-600">{{ $alumno->carrera ?? 'N/A' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center text-gray-500 bg-white p-4 rounded">
                                    <p>No hay estudiantes asignados a este proyecto.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="mt-6 flex flex-wrap justify-center gap-4">
                    <a href="{{ route('projects.edit', $project) }}" class="btn btn-warning flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                        Editar Proyecto
                    </a>
                    <a href="{{ route('projects.index') }}" class="btn btn-neutral flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                        </svg>
                        Volver a Proyectos
                    </a>
                    <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-error flex items-center" onclick="return confirm('¿Estás seguro de que quieres eliminar este proyecto?')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                            </svg>
                            Eliminar Proyecto
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.layout>
