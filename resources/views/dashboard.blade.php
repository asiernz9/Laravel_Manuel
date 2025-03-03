<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- First Students Section -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Alumnos</h3>
                            <button @click="window.location.href='{{ route('alumnos.index') }}'" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Entrar
                            </button>
                        </div>
                        <div class="text-sm text-gray-600">
                            Gestiona tu lista de alumnos, añade, edita o elimina registros.
                        </div>
                    </div>
                </div>

                <!-- Second Students Section -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Alumnos</h3>
                            <button @click="window.location.href='{{ route('alumnos.index') }}'" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Entrar
                            </button>
                        </div>
                        <div class="text-sm text-gray-600">
                            Gestiona tu lista de alumnos, añade, edita o elimina registros.
                        </div>
                    </div>
                </div>

                <!-- Projects Section -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Proyectos</h3>
                            <button @click="window.location.href='{{ route('projects.index') }}'" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Entrar
                            </button>
                        </div>
                        <div class="text-sm text-gray-600">
                            Administra tus proyectos, crea, modifica o elimina proyectos existentes.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
