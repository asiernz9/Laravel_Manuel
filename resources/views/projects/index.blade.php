<x-layouts.layout>
    @if (session('success'))
        <div role="alert" class="alert alert-success">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 shrink-0 stroke-current"
                fill="none"
                viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="p-2 flex flex-row justify-start items-center space-x-2">
        <a href="{{ route('projects.create') }}" class="btn btn-sm btn-primary">Crear Proyecto</a>
        <a href="{{ route('home') }}" class="btn btn-sm btn-primary">Volver</a>
    </div>

    @if($projects->isEmpty())
        <div class="alert alert-info shadow-lg mt-4">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Aún no has creado ningún proyecto. ¡Comienza creando tu primer proyecto!</span>
            </div>
        </div>
    @else
        <div class="max-h-full overflow-x-auto">
            <table class="table table-xs table-pin-rows table-pin-cols">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Horas Previstas</th>
                        <th>Fecha de Inicio</th>
                        <th>Estudiantes</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                    <tr>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->estimated_hours }}</td>
                        <td>
                            @php
                                $startDate = $project->start_date;
                            @endphp
                            {{ $startDate ? $startDate->format('d/m/Y') : 'N/A' }}
                        </td>
                        <td>
                            @if($project->alumnos()->exists())
                                <div class="tooltip" data-tip="{{ $project->alumnos->pluck('nombre')->implode(', ') }}">
                                    {{ $project->alumnos->count() }} estudiante(s)
                                </div>
                            @else
                                Sin asignar
                            @endif
                        </td>
                        <td class="flex space-x-2">
                            <div class="tooltip" data-tip="Editar Proyecto">
                                <a href="{{ route('projects.edit', $project) }}" class="btn btn-xs btn-warning inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                    Editar
                                </a>
                            </div>
                            <div class="tooltip" data-tip="Ver Detalles del Proyecto">
                                <a href="{{ route('projects.show', $project) }}" class="btn btn-xs btn-info inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    Ver
                                </a>
                            </div>
                            <div class="tooltip" data-tip="Eliminar Proyecto">
                                <form onsubmit="event.preventDefault()" id="formulario{{$project->id}}" action="{{ route('projects.destroy', $project) }}" method="POST">
                                    @method("DELETE")
                                    @csrf
                                    <button onclick="confirmDelete({{$project->id}})" class="btn btn-xs btn-error inline-flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                        </svg>
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <script>
        function confirmDelete(id){
            swal({
                title:"Eliminar Proyecto",
                text:"Esta acción no se puede recuperar",
                icon:"warning",
                buttons:true
            }).
                then((ok)=>{
                    if (ok){
                        document.getElementById("formulario"+id).submit();
                    }
            });
        }
    </script>
</x-layouts.layout>