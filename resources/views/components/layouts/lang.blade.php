
<x-dropdown>
    <x-slot name="trigger" class="text-3xl border-gray-200 p-2">
        <!--El título-->
        {{config('languages')[App::getLocale()]['name']}}
        {{config('languages')[App::getLocale()]['flag']}}
   </x-slot>
    <x-slot name="content">
        <!--El contenido -->
        @foreach(config("languages") as $code=>$lang)


            <div class="text-black text-2xl p-3 m-2">
                <a href="{{route('language',$code)}}" class="hover:bg-gray-200 hover:cursor-pointer" >
                <span>{{$lang['name']}} </span>
                <span>{{$lang['flag']}} </span>
                </a>
            </div>


        @endforeach


    </x-slot>




</x-dropdown>
