<header class="md:h-10v bg-header flex flex-row  md:flex-row px-3  justify-between items-center p-3">
    <img class="w-1/3 md:w-1/12 max-h-full p-1" src="{{asset ("images/logo.png")}}" alt="logo">
    <h1 class=" hidden md:block
    text-gray-700 text-7xl">{{__("Gestión de instituto")}}</h1>
    <div class="hidden md:flex flex-row text-white space-x-2">
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
        <x-layouts.lang />
    </div>
    <!-- Diseño para móvil-->
    <div class="block md:hidden">
        <input type="checkbox" name="" id="menu-togger" class="peer hidden">
        <label for="menu-togger">
            &#9778
        </label>
        <div class="hidden absolute right-0 bg-gray-200 rounded-sm flex flex-col  space-y-2 p-3 m-3 peer-checked:flex ">
        @auth
            {{auth()->user()->name}}
            <form action="{{route("logout")}}" method="post">
                @csrf
                <button type="submit" class="btn btn-glass">Logout</button>
            </form>
        @endauth
        @guest
                <a class="btn btn-glass" href="login">Login</a>
                <a class="btn btn-glass" href="register">Register</a>


        @endguest
        </div>
    </div>

</header>
