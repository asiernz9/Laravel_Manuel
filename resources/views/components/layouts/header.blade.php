<header class="h-15v bg-header
flex flex-row justify-between px-3 items-center
">
    <img class="max-h-full p-5" src="{{asset ("images/logo.png")}}" alt="logo">
    <h1 class="text-gray-700 text-7xl">Gestión de instituto</h1>
    <div>
        @auth
            {{auth()->user()->name}}
            <button class="btn btn-glass">Logout</button>
        @endauth
        @guest
            <button class="btn btn-glass">Login</button>
            <button class="btn btn-glass">Register</button>
        @endguest
    </div>
</header>
