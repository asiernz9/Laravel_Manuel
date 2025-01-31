<x-layouts.layout>
    @guest
    <div
        class="hero min-h-full"
        style="background-image: url(https://img.daisyui.com/images/stock/photo-1507358522600-9f71e620c44e.webp);">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-neutral-content text-center">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold">Hello there</h1>
                <p class="mb-5">
                    Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem
                    quasi. In deleniti eaque aut repudiandae et a id nisi.
                </p>
                <button class="btn btn-primary">Get Started</button>
            </div>
        </div>
    </div>
    @endguest
    @auth
        <div>
            <div class="card bg-base-100 image-full w-96 shadow-xl m-4 mx-5">
                <figure>
                    <img
                        src="{{asset("images/alumnos.jpeg")}}"
                        alt="Alumnos" />
                </figure>
                <div class="card-body">
                    <h2 class="card-title">Alumnos</h2>
                    <p>Visualizar Alumnos</p>
                    <div class="card-actions justify-end">
                        <button class="btn btn-primary">Buy Now</button>
                    </div>
                </div>
            </div>

    @endauth

</x-layouts.layout>
