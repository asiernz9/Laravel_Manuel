<header class="md:h-10v bg-header flex flex-col md:flex-row   justify-between items-center p-3">
    <img class="w-1/3 md:w-1/12 max-h-full p-1" src="{{asset ("images/logo.png")}}" alt="logo">
    <h1 class=" hidden md:block
    text-gray-700 text-7xl">Gestión de instituto</h1>
    <div>
        @auth
            {{auth()->user()->name}}
            <form action="{{route("logout")}}" method="post">
                @csrf
                <button type="submit" class="btn btn-glass">Logout</button>
            </form>
        @endauth
        @guest
                <a class="btn btn-glass" href="login">Loginn</a>
                <a class="btn btn-glass" href="register">Register</a>


        @endguest
    </div>
</header>
