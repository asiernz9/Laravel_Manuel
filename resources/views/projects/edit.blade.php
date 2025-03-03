<x-layouts.layout>
    <div class="flex flex-row justify-center items-center min-h-full bg-gray-300">
        <div class="bg-white p-6 rounded-2xl w-full max-w-4xl">
            <h2 class="text-2xl font-bold mb-4 text-center">Editar Proyecto</h2>
            
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

            <form action="{{ route('projects.update', $project) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <div class="mb-4">
                            <x-input-label for="title" value="Título del Proyecto" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" 
                                value="{{ old('title', $project->title) }}" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="estimated_hours" value="Horas Previstas" />
                            <x-text-input id="estimated_hours" class="block mt-1 w-full" type="number" 
                                name="estimated_hours" value="{{ old('estimated_hours', $project->estimated_hours) }}" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="start_date" value="Fecha de Inicio" />
                            <x-text-input id="start_date" class="block mt-1 w-full" type="date" 
                                name="start_date" value="{{ old('start_date', $project->start_date->format('Y-m-d')) }}" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label value="Asignar Estudiantes" />
                            <select name="alumno_ids[]" multiple class="select select-bordered w-full" size="5">
                                @foreach(App\Models\Alumno::all() as $alumno)
                                    <option value="{{ $alumno->id }}" 
                                        {{ $project->alumnos->contains($alumno->id) ? 'selected' : '' }}>
                                        {{ $alumno->nombre }} ({{ $alumno->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex flex-row justify-between">
                            <button type="submit" class="btn btn-warning">Actualizar Proyecto</button>
                            <a href="{{ route('projects.index') }}" class="btn btn-warning">Cancelar</a>
                        </div>
                    </div>

                    <div>
                        <div class="bg-gray-100 p-4 rounded">
                            <h3 class="font-semibold mb-2">Instrucciones</h3>
                            <p>Seleccione los estudiantes que desea asignar al proyecto. 
                               Puede seleccionar múltiples estudiantes manteniendo presionada la tecla Ctrl (Windows) 
                               o Cmd (Mac) mientras hace clic.</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.layout>