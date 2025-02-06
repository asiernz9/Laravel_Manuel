<x-layouts.layout>
    @if (session("mensaje"))
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
            <span>{{session("mensaje")}}</span>
        </div>
    @endif


    <div class="p-2 flex flex-row justify-start items-center space-x-2">
        <a href="{{route("alumnos.create")}}" class="btn btn-sm btn-primary">Crear Alumno</a>
        <a href="{{route("home")}}" class="btn btn-sm btn-primary">Volver</a>
    </div>
    <div class="max-h-full overflow-x-auto">
        <table class="table table-xs table-pin-rows table-pin-cols">
            <thead>
            <tr>
            @foreach($campos as $campo)
                <th>{{$campo}}</th>
            @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($filas as $fila)
                <tr>
                    @foreach($campos as $campo)
                        <td>{{$fila->$campo}}</td>
                    @endforeach

                </tr>

            @endforeach

            </tbody>
        </table>
    </div>

</x-layouts.layout>
