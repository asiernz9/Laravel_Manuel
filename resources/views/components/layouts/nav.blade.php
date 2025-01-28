<nav class="h-10v bg-nav
 flex flex-row justify-start px-3 space-x-2 items-center ">
    <button class="btn btn-sm btn-primary">About</button>
    <button class="btn btn-sm btn-warning">Contact</button>
    @auth
    <button class="btn btn-sm btn-primary">News</button>
    <button class="btn btn-sm btn-warning">Work with us</button>
    @endauth
</nav>
