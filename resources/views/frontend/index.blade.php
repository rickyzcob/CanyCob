<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>

</head>
  <body
    x-data="{ isOpen: false }"
    class="flex flex-col min-h-screen antialiased overflow-x-hidden bg-neutral-100"
    @keydown.escape.window="isOpen = false"
  >

<header>
<nav class="navbar navbar-expand-lg shadow-md relative z-20 flex bg-sky-700 items-center w-full h-full justify-between px-3">
    <div class="container flex flex-wrap items-center justify-between mx-auto">
        <button @click="isOpen = !isOpen">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white lg:hidden" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <a href="#" class="flex items-center">
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-6 mr-3 sm:h-10" alt="Flowbite Logo" />
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Empresa</span>
        </a>

        <div class="hidden md:flex md:justify-center md:items-center md:mx-auto md:gap-5">

        <div class="flex items-center bg-white text-sky-800 gap-1 p-2 cursor-point">
{{--            <span class="material-icons text-base self-center mb-0">home</span>--}}
                     Dashboard
        </div>

        <div x-data="{ open: false }" @mouseleave="open = false" class="relative">
            <div @mouseover="open = true" class="flex items-center text-white hover:bg-white hover:text-sky-700 gap-1 p-2 cursor-point">
                <span class="material-icons text-base ">assignment_ind</span>
                Gestão de Clientes
            </div>
             <div x-show="open"
                  x-cloak
                  x-transition:enter.duration.500ms
                 x-transition:leave.duration.800ms
                 class="absolute z-40 w-full py-2 rounded-br-lg rounded-bl-lg bg-white shadow-xl">
                 <a href="#"
                     class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-200">
                     Dropdown List 1
                 </a>
                 <a href="#"
                     class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                     Dropdown List 2
                 </a>
                 <a href="#"
                     class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                     Dropdown List 3
                 </a>
                 <a href="#"
                     class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                     Dropdown List 4
                 </a>
             </div>
         </div>


        <div x-data="{ open: false }" @mouseleave="open = false" class="relative">
            <div  @mouseover="open = true" class="flex items-center text-white hover:bg-white hover:text-sky-700 gap-1 p-2">
                <span class="material-icons text-base ">monetization_on</span>
                Gestão de Cobrança</div>
            <div x-show="open"
                 x-cloak
                 x-transition:enter.duration.500ms
                x-transition:leave.duration.800ms
                class="absolute z-40 w-full py-2 rounded-br-lg rounded-bl-lg bg-white shadow-xl">
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-200">
                    Dropdown List 1
                </a>
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                    Dropdown List 2
                </a>
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                    Dropdown List 3
                </a>
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                    Dropdown List 4
                </a>
            </div>
        </div>
        <div x-data="{ open: false }" @mouseleave="open = false" class="relative">
            <div  @mouseover="open = true" class="flex items-center text-white hover:bg-white hover:text-sky-700 gap-1 p-2">
                <span class="material-icons text-base ">source</span>
                Gestão de Projetos</div>
            <div x-show="open"
                x-transition:enter.duration.500ms
                x-transition:leave.duration.800ms
                 x-cloak
                 class="absolute z-40 w-full py-2 rounded-br-lg rounded-bl-lg bg-white shadow-xl">
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-200">
                    Dropdown List 1
                </a>
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                    Dropdown List 2
                </a>
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                    Dropdown List 3
                </a>
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                    Dropdown List 4
                </a>
            </div>
        </div>
      </div>

      <div class="flex justify-center items-center ">
        <div x-data="{ open: false }" @mouseleave="open = false" class="relative">
            <div  @mouseover="open = true" class="flex items-center text-white hover:bg-white hover:text-sky-700 py-1 px-2">
                <span class="material-icons text-2xl ">notifications</span>
                </div>
            <div x-show="open"
                x-transition:enter.duration.500ms
                x-transition:leave.duration.800ms
                 x-cloak
                 class="absolute z-40 w-72 py-2 rounded-br-lg rounded-bl-lg bg-white shadow-xl right-0">
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-200">
                    Dropdown List 1
                </a>
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                    Dropdown List 2
                </a>
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                    Dropdown List 3
                </a>
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                    Dropdown List 4
                </a>
            </div>
        </div>

        <div x-data="{ open: false }" @mouseleave="open = false" class="relative">
            <div  @mouseover="open = true" class="flex items-center text-white hover:bg-white hover:text-sky-700 py-1 px-2">
                <span class="material-icons text-2xl ">account_box</span>
                </div>
            <div x-show="open"
                x-transition:enter.duration.500ms
                x-transition:leave.duration.800ms
                 x-cloak
                 class="absolute z-40 w-72 py-2 rounded-br-lg rounded-bl-lg bg-white shadow-xl right-0">
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-200">
                    Dropdown List 1
                </a>
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                    Dropdown List 2
                </a>
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                    Dropdown List 3
                </a>
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                    Dropdown List 4
                </a>
            </div>
        </div>

        <div x-data="{ open: false }" @mouseleave="open = false" class="relative">
            <div  @mouseover="open = true" class="flex items-center text-white hover:bg-white hover:text-sky-700 py-1 px-2">
                <span class="material-icons text-2xl ">settings_applications</span>
                </div>
            <div x-show="open"
                x-transition:enter.duration.500ms
                x-transition:leave.duration.800ms
                 x-cloak
                 class="absolute z-40 w-72 py-2 rounded-br-lg rounded-bl-lg bg-white shadow-xl right-0">
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-200">
                    Dropdown List 1
                </a>
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                    Dropdown List 2
                </a>
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                    Dropdown List 3
                </a>
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                    Dropdown List 4
                </a>
            </div>
        </div>
    </div>

    </div>


  </nav>


    <div class="h-2 bg-gray-500"></div>
    </header>




<div class= "group fixed bottom-0 right-0 p-2  flex items-end justify-end w-24 h-24 ">
    <!-- main -->
    <div class = "text-white shadow-xl flex items-center justify-center p-3 rounded-full bg-gradient-to-r from-cyan-500 to-blue-500 z-50 absolute  ">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 group-hover:rotate-90 transition  transition-all duration-[0.6s]">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
    </div>
    <!-- sub left -->
    <div class="absolute rounded-full transition-all duration-[0.2s] ease-out scale-y-0 group-hover:scale-y-100 group-hover:-translate-x-16   flex  p-2 hover:p-3 bg-green-300 scale-100 hover:bg-green-400 text-white">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 10.5h.375c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125H21M3.75 18h15A2.25 2.25 0 0021 15.75v-6a2.25 2.25 0 00-2.25-2.25h-15A2.25 2.25 0 001.5 9.75v6A2.25 2.25 0 003.75 18z" />
        </svg>
    </div>
    <!-- sub top -->
    <div class="absolute rounded-full transition-all duration-[0.2s] ease-out scale-x-0 group-hover:scale-x-100 group-hover:-translate-y-16  flex  p-2 hover:p-3 bg-blue-300 hover:bg-blue-400  text-white">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.143 17.082a24.248 24.248 0 003.844.148m-3.844-.148a23.856 23.856 0 01-5.455-1.31 8.964 8.964 0 002.3-5.542m3.155 6.852a3 3 0 005.667 1.97m1.965-2.277L21 21m-4.225-4.225a23.81 23.81 0 003.536-1.003A8.967 8.967 0 0118 9.75V9A6 6 0 006.53 6.53m10.245 10.245L6.53 6.53M3 3l3.53 3.53" />
        </svg>
    </div>
    <!-- sub middle -->
    <div class="absolute rounded-full transition-all duration-[0.2s] ease-out scale-x-0 group-hover:scale-x-100 group-hover:-translate-y-14 group-hover:-translate-x-14   flex  p-2 hover:p-3 bg-yellow-300 hover:bg-yellow-400 text-white">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
        </svg>
    </div>
</div>

<section class="page-title-box">

    <div class="md:container xl justify-center items-center">
        <nav class="py-5">
            <ol class="list-reset flex">
                <li><a href="#" class="text-blue-600 hover:text-blue-700">Home</a></li>
                <li><span class="text-gray-500 mx-2">/</span></li>
                <li class="text-gray-100">Dashboard</li>
            </ol>
        </nav>
        <div class="grid grid-cols-1 md:grid-cols-12 w-full gap-3 relative">
            <div class="md:col-span-3 justify-center ">
                <div class="relative p-5 rounded shadow-lg max-w-sm h-full bg-sky-700">
                    <div class="mini-stat-desc">
                        <h1 class="uppercase font-semibold verti-label text-white">PEDIDOS</h1>
                        <div class="text-white">
                            <h6 class="uppercase font-semibold text-white-50">PEDIDOS</h6>
                            <h3 class="text-3xl font-semibold mb-3 mt-0">1,587</h3>
                            <div class="">
                                <span class="inline-block py-1.5 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-white text-sky-800 rounded text-xs"> +11% </span> <span class="ml-2 text-sm">From previous period</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="md:col-span-3 justify-center">
                <div class="relative p-5 rounded shadow-lg max-w-sm h-full bg-sky-700" >
                    <div class="mini-stat-desc" >
                        <h1 class="uppercase font-semibold verti-label text-white">PEDIDOS</h1>
                        <div class="text-white">
                            <h6 class="uppercase font-semibold text-white-50">PEDIDOS</h6>
                            <h3 class="text-3xl font-semibold mb-3 mt-0">1,587</h3>
                            <div class="">
                                <span class="inline-block py-1.5 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-white text-sky-800 rounded text-xs"> +11% </span> <span class="ml-2 text-sm">From previous period</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="md:col-span-3 justify-center">
                <div class="relative p-5 rounded shadow-lg max-w-sm h-full bg-sky-700 ">
                    <div class="mini-stat-desc" >
                        <h1 class="uppercase font-semibold verti-label text-white">PEDIDOS</h1>
                        <div class="text-white">
                            <h6 class="uppercase font-semibold text-white-50">PEDIDOS</h6>
                            <h3 class="text-3xl font-semibold mb-3 mt-0">1,587</h3>
                            <div class="">
                                <span class="inline-block py-1.5 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-white text-sky-800 rounded text-xs"> +11% </span> <span class="ml-2 text-sm">From previous period</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="md:col-span-3 justify-center">
                <div class="relative p-5 rounded shadow-lg max-w-sm h-full bg-sky-700">
                    <div class="mini-stat-desc" >
                        <h1 class="uppercase font-semibold verti-label text-white">PEDIDOS</h1>
                        <div class="text-white">
                            <h6 class="uppercase font-semibold text-white-50">PEDIDOS</h6>
                            <h3 class="text-3xl font-semibold mb-3 mt-0">1,587</h3>
                            <div class="">
                                <span class="inline-block py-1.5 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-white text-sky-800 rounded text-xs"> +11% </span> <span class="ml-2 text-sm">From previous period</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="md:container xl gap-x-2 mb-5">
    <div class="grid grid-cols-1 md:grid-cols-12 justify-center items-center gap-5">
        <div class="card md:col-span-6 p-5 h-64">
            <div class="flex items-center border-b-2 mb-2 justify-between">
                <h1 class="text-lg text-sky-600 font-semibold ">Notícias</h1>
                <button
                    class="px-2 text-gray-500 hover:text-gray-500 focus:outline-none"
                    @click="isOpen = true"
                    >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                        fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"
                        />
                    </svg>
                </button>
            </div>
            <div class="justify-center items-center">
                <p> Confira aqui nossos ultimos blogs </p>
            </div>
        </div>
        <div class="card md:col-span-6 p-5 h-64">
            <div class="items-start border-b-2 mb-2 justify-between">
                <h1 class="text-lg text-gray-600 font-semibold ">Notícias</h1>
            </div>
            <div class="justify-center items-center">
                <p> Confira aqui nossos ultimos blogs </p>
            </div>
        </div>
        <div class="card md:col-span-12 p-5 h-64">
            <div class="items-start border-b-2 mb-2 justify-between">
                <h1 class="text-lg text-gray-600 font-semibold ">Notícias</h1>
            </div>
            <div class="justify-center items-center">
                <p> Confira aqui nossos ultimos blogs </p>
            </div>
        </div>
        <div class="card md:col-span-6 p-5 h-auto">
            <div class="items-start border-b-2 mb-2 justify-between">
                <h1 class="text-lg text-gray-600 font-semibold ">Últimos pedidos</h1>
            </div>
            <div class="justify-center items-center mb-2">
                <p> Ultimos lançamentos cadastrados em nosso sistema. </p>
            </div>

{{--            <div class="w-full">--}}
                <table id="customers">
                    <thead>
                    <tr>
                        <th>Song</th>
                        <th>Artist</th>
                        <th>Year</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>The Sliding Mr. Bones (Next Stop, Pottersville)</td>
                        <td>Malcolm Lockyer</td>
                        <td>1961</td>
                    </tr>
                    <tr>
                        <td>Witchy Woman</td>
                        <td>The Eagles</td>
                        <td>1972</td>
                    </tr>
                    <tr>
                        <td>Shining Star</td>
                        <td>Earth, Wind, and Fire</td>
                        <td>1975</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="card md:col-span-6 p-5 h-auto">
                <div class="items-start border-b-2 mb-2 justify-between">
                    <h1 class="text-lg text-gray-600 font-semibold ">Últimos pedidos</h1>
                </div>
                <div class="justify-center items-center mb-2">
                    <p> Ultimos lançamentos cadastrados em nosso sistema. </p>
                </div>

    {{--            <div class="w-full">--}}
                    <table id="tables">
                        <thead>
                        <tr>
                            <th>Song</th>
                            <th>Artist</th>
                            <th>Year</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>The Sliding Mr. Bones (Next Stop, Pottersville)</td>
                            <td>Malcolm Lockyer</td>
                            <td>1961</td>
                        </tr>
                        <tr>
                            <td>Witchy Woman</td>
                            <td>The Eagles</td>
                            <td>1972</td>
                        </tr>
                        <tr>
                            <td>Shining Star</td>
                            <td>Earth, Wind, and Fire</td>
                            <td>1975</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

        </div>
    </div>








</section>


    <footer class="text-center lg:text-left bg-gray-100 text-gray-600">
        <div class="flex justify-center items-center lg:justify-between p-6 border-b border-gray-300">
            <div class="mr-12 hidden lg:block">
                <span>Get connected with us on social networks:</span>
            </div>
            <div class="flex justify-center">
                <a href="#!" class="mr-6 text-gray-600">
                    <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-f"
                         class="w-2.5" role="img" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 320 512">
                        <path fill="currentColor"
                              d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z">
                        </path>
                    </svg>
                </a>
                <a href="#!" class="mr-6 text-gray-600">
                    <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitter"
                         class="w-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor"
                              d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z">
                        </path>
                    </svg>
                </a>
                <a href="#!" class="mr-6 text-gray-600">
                    <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google"
                         class="w-3.5" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
                        <path fill="currentColor"
                              d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z">
                        </path>
                    </svg>
                </a>
                <a href="#!" class="mr-6 text-gray-600">
                    <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="instagram"
                         class="w-3.5" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path fill="currentColor"
                              d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z">
                        </path>
                    </svg>
                </a>
                <a href="#!" class="mr-6 text-gray-600">
                    <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="linkedin-in"
                         class="w-3.5" role="img" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 448 512">
                        <path fill="currentColor"
                              d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z">
                        </path>
                    </svg>
                </a>
                <a href="#!" class="text-gray-600">
                    <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="github"
                         class="w-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512">
                        <path fill="currentColor"
                              d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
        <div class="mx-6 py-10 text-center md:text-left">
            <div class="grid grid-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="">
                    <h6 class="
            uppercase
            font-semibold
            mb-4
            flex
            items-center
            justify-center
            md:justify-start
          ">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cubes"
                             class="w-4 mr-3" role="img" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 512 512">
                            <path fill="currentColor"
                                  d="M488.6 250.2L392 214V105.5c0-15-9.3-28.4-23.4-33.7l-100-37.5c-8.1-3.1-17.1-3.1-25.3 0l-100 37.5c-14.1 5.3-23.4 18.7-23.4 33.7V214l-96.6 36.2C9.3 255.5 0 268.9 0 283.9V394c0 13.6 7.7 26.1 19.9 32.2l100 50c10.1 5.1 22.1 5.1 32.2 0l103.9-52 103.9 52c10.1 5.1 22.1 5.1 32.2 0l100-50c12.2-6.1 19.9-18.6 19.9-32.2V283.9c0-15-9.3-28.4-23.4-33.7zM358 214.8l-85 31.9v-68.2l85-37v73.3zM154 104.1l102-38.2 102 38.2v.6l-102 41.4-102-41.4v-.6zm84 291.1l-85 42.5v-79.1l85-38.8v75.4zm0-112l-102 41.4-102-41.4v-.6l102-38.2 102 38.2v.6zm240 112l-85 42.5v-79.1l85-38.8v75.4zm0-112l-102 41.4-102-41.4v-.6l102-38.2 102 38.2v.6z">
                            </path>
                        </svg>
                        Tailwind ELEMENTS
                    </h6>
                    <p>
                        Here you can use rows and columns to organize your footer content. Lorem ipsum dolor
                        sit amet, consectetur adipisicing elit.
                    </p>
                </div>
                <div class="">
                    <h6 class="uppercase font-semibold mb-4 flex justify-center md:justify-start">
                        Products
                    </h6>
                    <p class="mb-4">
                        <a href="#!" class="text-gray-600">Angular</a>
                    </p>
                    <p class="mb-4">
                        <a href="#!" class="text-gray-600">React</a>
                    </p>
                    <p class="mb-4">
                        <a href="#!" class="text-gray-600">Vue</a>
                    </p>
                    <p>
                        <a href="#!" class="text-gray-600">Laravel</a>
                    </p>
                </div>
                <div class="">
                    <h6 class="uppercase font-semibold mb-4 flex justify-center md:justify-start">
                        Useful links
                    </h6>
                    <p class="mb-4">
                        <a href="#!" class="text-gray-600">Pricing</a>
                    </p>
                    <p class="mb-4">
                        <a href="#!" class="text-gray-600">Settings</a>
                    </p>
                    <p class="mb-4">
                        <a href="#!" class="text-gray-600">Orders</a>
                    </p>
                    <p>
                        <a href="#!" class="text-gray-600">Help</a>
                    </p>
                </div>
                <div class="">
                    <h6 class="uppercase font-semibold mb-4 flex justify-center md:justify-start">
                        Contact
                    </h6>
                    <p class="flex items-center justify-center md:justify-start mb-4">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="home"
                             class="w-4 mr-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path fill="currentColor"
                                  d="M280.37 148.26L96 300.11V464a16 16 0 0 0 16 16l112.06-.29a16 16 0 0 0 15.92-16V368a16 16 0 0 1 16-16h64a16 16 0 0 1 16 16v95.64a16 16 0 0 0 16 16.05L464 480a16 16 0 0 0 16-16V300L295.67 148.26a12.19 12.19 0 0 0-15.3 0zM571.6 251.47L488 182.56V44.05a12 12 0 0 0-12-12h-56a12 12 0 0 0-12 12v72.61L318.47 43a48 48 0 0 0-61 0L4.34 251.47a12 12 0 0 0-1.6 16.9l25.5 31A12 12 0 0 0 45.15 301l235.22-193.74a12.19 12.19 0 0 1 15.3 0L530.9 301a12 12 0 0 0 16.9-1.6l25.5-31a12 12 0 0 0-1.7-16.93z">
                            </path>
                        </svg>
                        New York, NY 10012, US
                    </p>
                    <p class="flex items-center justify-center md:justify-start mb-4">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="envelope"
                             class="w-4 mr-4" role="img" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 512 512">
                            <path fill="currentColor"
                                  d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z">
                            </path>
                        </svg>
                        info@example.com
                    </p>
                    <p class="flex items-center justify-center md:justify-start mb-4">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="phone"
                             class="w-4 mr-4" role="img" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 512 512">
                            <path fill="currentColor"
                                  d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z">
                            </path>
                        </svg>
                        + 01 234 567 88
                    </p>
                    <p class="flex items-center justify-center md:justify-start">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="print"
                             class="w-4 mr-4" role="img" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 512 512">
                            <path fill="currentColor"
                                  d="M448 192V77.25c0-8.49-3.37-16.62-9.37-22.63L393.37 9.37c-6-6-14.14-9.37-22.63-9.37H96C78.33 0 64 14.33 64 32v160c-35.35 0-64 28.65-64 64v112c0 8.84 7.16 16 16 16h48v96c0 17.67 14.33 32 32 32h320c17.67 0 32-14.33 32-32v-96h48c8.84 0 16-7.16 16-16V256c0-35.35-28.65-64-64-64zm-64 256H128v-96h256v96zm0-224H128V64h192v48c0 8.84 7.16 16 16 16h48v96zm48 72c-13.25 0-24-10.75-24-24 0-13.26 10.75-24 24-24s24 10.74 24 24c0 13.25-10.75 24-24 24z">
                            </path>
                        </svg>
                        + 01 234 567 89
                    </p>
                </div>
            </div>
        </div>
        <div class="text-center text-white p-6 bg-sky-700">
            <span>© 2022 Copyright:</span>
            <a class="text-white font-semibold" href="#">FrontEnd testes</a>
        </div>
    </footer>


<div x-data="{ isOpen: false }"  class="fixed z-40 left-0 flex items-center justify-start  h-screen">
    <div
        @click="isOpen = true" class = "text-white shadow-xl flex items-center justify-center p-3 z-40 rounded-r-lg bg-sky-700 absolute"
{{--        :class="{ 'transition duration-300 ease-in-out transform sm:duration-500 translate-x-[600px]': isOpen }"--}}
        :class="isOpen ? 'transition duration-300 ease-in-out transform sm:duration-500 translate-x-[600px]' : 'transition duration-300 ease-in-out transform sm:duration-500'"



    >
        <button  class="text-white hover:font-semibold focus:outline-none">
            <span class="material-icons text-2xl ">add_reaction</span>
        </button>
    </div>
    <div
        class="fixed md:w-[600px] md:bg-white z-10 text-gray-500 w-full h-full overflow-y-auto bg-white border-r-8 p-4"
        x-show="isOpen"
        x-cloak

        x-on:click.stop.outside="isOpen = false"
        x-transition:enter="transition duration-300 ease-in-out transform sm:duration-500"
        x-transition:enter-start="-translate-x-full opacity-0"
        x-transition:enter-end="translate-x-0 opacity-100"
        x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
        x-transition:leave-start="translate-x-0 opacity-100"
        x-transition:leave-end="-translate-x-full opacity-0"
    >

        <div class="flex justify-between pt-8">
            <span class="font-bold text-2xl sm:text-3xl">Sidebar</span>
            <button class="p-2 rounded hover:bg-sky-700 hover:text-white" @click="isOpen = false">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>
            </button>
        </div>
        <div>
            <div x-data="{open:false}" class="mx-auto bg-white border-b-2 border-gray-200 gap-4">
                <div @click="open=!open"  class="flex justify-between items-center bg-white ">
                    <p class="py-2">Accordion 1</p>
                </div>
                <div x-show="open" x-cloak  class="mx-4 py-2" x-transition>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dicta repudiandae ut dolores totam nobis molestias!</div>

            </div>
            <div x-data="{open:false}" class="mx-auto bg-white border-b-2 border-gray-200">
                <div @click="open=!open"  class="flex justify-between items-center bg-white">
                    <p class="py-2">Accordion 2</p>
                </div>
                <div x-show="open" x-cloak class="mx-4 py-2" x-transition>

                </div>

            </div>
            <div x-data="{open:false}" class="mx-auto bg-white border-b-2 border-gray-200">
                <div @click="open=!open"  class="flex justify-between items-center bg-white">
                    <p class="py-2">Menu 3</p>
                </div>
                <div x-show="open" x-cloak class="mx-4 py-2" x-transition>

                </div>
            </div>
        </div>
</div>








    </div>
</body>
</html>

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

