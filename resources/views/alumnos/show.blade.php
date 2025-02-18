<x-layouts.layout>
    <div class="flex flex-row justify-center items-center min-h-full bg-gray-300">
        <div class="bg-white p-3 rounded-2xl">

            <div class="grid grid-cols-2 gap-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="nombre" value="Nombre"/>
                        <span class="block mt-1 w-full">{{$alumno->nombre}}</span>
                    </div>
                    <div>
                        <x-input-label for="email" value="Email"/>
                        <span class="block mt-1 w-full">{{$alumno->email}}
                    </div>
                    <div>
                        <x-input-label for="edad" value="Edad"/>
                        <span class="block mt-1 w-full">{{$alumno->edad}}
                    </div>

                </div> {{--end div datos alumno--}}
                <div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{__("Idioma")}}</th>
                            <th>{{__("Nivel")}}</th>
                            <th>{{__("Título")}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($alumno->idiomas as $idioma)
                            <tr class="hover:bg-gray-200">
                                <td>{{$idioma->idioma}}</td>
                                <td>{{$idioma->nivel}}</td>
                                <td>{{$idioma->titulo}}</td>
                            </tr>

                        @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
            <div class="flex flex-row justify-between p-3">
                <button class="btn btn-warning" type="submit">Guardar</button>
                <button class="btn btn-warning" type="submit">Cancelar</button>

            </div>

        </div>
    </div>
</x-layouts.layout>
