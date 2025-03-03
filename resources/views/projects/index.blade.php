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

    <div class="max-h-full overflow-x-auto">
        <table class="table table-xs table-pin-rows table-pin-cols">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Horas Previstas</th>
                    <th>Fecha de Inicio</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                <tr>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->estimated_hours }}</td>
                    <td>{{ $project->start_date instanceof \Carbon\Carbon ? $project->start_date->format('d/m/Y') : \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') }}</td>
                    <td>
                        <!--edit-->
                        <a href="{{ route('projects.edit', $project) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hover:bg-blue-500 size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                        </a>
                    </td>
                    <td>
                        <!--delete-->
                        <form onsubmit="event.preventDefault()" id="formulario{{$project->id}}" action="{{ route('projects.destroy', $project) }}" method="POST">
                            @method("DELETE")
                            @csrf
                            <button onclick="confirmDelete({{$project->id}})">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 hover:bg-red-400 hover:text-white hover:rounded">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                        </svg>
                            </button>
                        </form>
                    </td>
                    <td><a href="{{ route('projects.show', $project) }}">Ver</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function confirmDelete(id){
            swal({
                title:"borrar ",
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