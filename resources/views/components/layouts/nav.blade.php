<nav class="md:h-10v bg-nav
 flex flex-col  max-w-full md:flex-row justify-start px-3 space-x-2  ">
    <button class=" my-2 btn btn-sm btn-primary">About</button>
    <button class=" my-2  btn btn-sm btn-warning">Contact</button>
    @auth
    <button class="btn btn-sm btn-primary">News</button>
    <button class="btn btn-sm btn-warning">Work with us</button>
    @endauth
</nav>
