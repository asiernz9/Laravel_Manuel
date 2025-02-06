
<x-layouts.layout>
    <div class="flex flex-row justify-center items-center min-h-full bg-gray-300">
        <div class="bg-white p-3 rounded-2xl">

            <form action="{{route("alumnos.store")}}" method="post">
                @csrf
            <div>
                <x-input-label for="nombre" value="Nombre" />
                <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre"   />
            </div>
              <div>
                <x-input-label for="email" value="Email" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"   />
            </div>
              <div>
                <x-input-label for="edad" value="Edad" />
                <x-text-input id="edad" class="block mt-1 w-full" type="number" name="edad"   />
            </div>
            <div class="flex flex-row justify-between p-3">
                <button class="btn btn-warning" type="submit">Guardar</button>
                <button class="btn btn-warning" type="submit">Cancelar</button>

            </div>
            </form>


        </div>
    </div>
</x-layouts.layout>
