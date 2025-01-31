<x-layouts.layout>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Edad</th>
        </tr>
        @foreach($alumnos as $alumno)
            <tr>
                <td>{{$alumno->nombre}}</td>
                <td>{{$alumno->email}}</td>
                <td>{{$alumno->edad}}</td>
            </tr>

        @endforeach
    </table>

</x-layouts.layout>
