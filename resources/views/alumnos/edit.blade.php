
<x-layouts.layout>
    <div class="flex flex-row justify-center items-center min-h-full bg-gray-300">
        <div class="bg-white p-3 rounded-2xl">

            <form action="{{route("alumnos.store")}}" method="post">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                    <div>
                        <x-input-label for="nombre" value="Nombre" />
                        <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" value="{{$alumno->nombre}}"   />
                    </div>
                      <div>
                        <x-input-label for="email" value="Email" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{$alumno->email}}"   />
                    </div>
                      <div>
                        <x-input-label for="edad" value="Edad" />
                        <x-text-input id="edad" class="block mt-1 w-full" type="number" name="edad" value="{{$alumno->edad}}"  />
                    </div>
                    <div class="flex flex-row justify-between p-3">
                        <button class="btn btn-warning" type="submit">Guardar</button>
                        <button class="btn btn-warning" type="submit">Cancelar</button>

                    </div>
                    </div>

                    <div>
                        <div class="overflow-x-auto h-60">
                            <table class="table table-xs table-pin-rows table-pin-cols">
                                <thead>
                                <tr>
                                    <th>Idioma</th>
                                    <th>Nivel</th>
                                    <th>Título</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(config("idiomas") as $idioma)
                                    <tr>
                                        <td>
                                            <input type="checkbox" value="{{$idioma}}" name="idiomas[]" id=""
                                            >
                                                {{$idioma}}
                                        </td>
                                        <td>
                                            <select class="text-sm h-8 rounded-sm" name="nivel[{{$idioma}}]" id="">
                                                <option value="Básico">Básico</option>
                                                <option value="Medio">Medio</option>
                                                <option value="Alto">Alto</option>

                                            </select>

                                        </td>
                                        <td>
                                            <select class="text-sm h-8 rounded-sm" name="titulo[{{$idioma}}]" id="">
                                                <option value="A1">A1</option>
                                                <option value="A2">A2</option>
                                                <option value="C1">C1</option>
                                                <option value="C2">C2</option>
                                                <option value="B1">B1</option>
                                                <option value="B2">B2</option>
                                            </select>

                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>
</x-layouts.layout>
