<div>
    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button"
        class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">
        <div
            class="h-full px-3 py-4 overflow-y-auto bg-gradient-to-r from-indigo-700 to-purple-700 text-white text-center">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('dashboard') }}">
                        <div
                            class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-center py-6 rounded-t-lg">
                            <h1 class="text-4xl font-bold">E-Factura</h1>
                            <p class="text-sm mt-2">Simplificando tu facturación electrónica</p>
                        </div>
                    </a>


                    <div
                        class="mt-6 flex flex-col justify-start items-center  pl-4 w-full border-gray-600 border-b space-y-3 pb-5 ">
                        <a href="{{ route('indexClient') }}"
                            class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full md:w-52">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="none" stroke="#dc2626" stroke-linecap="round" stroke-width="2"
                                    d="M4.5 17H4a1 1 0 0 1-1-1a3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1a3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1a3 3 0 0 1 3-3h3a3 3 0 0 1 3 3a1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0a2.5 2.5 0 0 1 5 0Z" />
                            </svg>
                            <p class="text-base leading-4  ">Clientes</p>
                        </a>
                    </div>

                    {{-- Menu 1 --}}
                    <div class="flex flex-col justify-start items-center   px-6 border-b border-gray-600 w-full  ">
                        <button onclick="showMenu1(true)"
                            class="focus:outline-none focus:text-indigo-400 text-left  text-white flex justify-between items-center w-full py-5 space-x-14  ">
                            <p class="text-sm leading-5  uppercase">PRODUCTOS</p>
                            <svg id="icon1" class="transform" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 15L12 9L6 15" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>

                        <div id="menu1" class="flex justify-start  flex-col w-full md:w-auto items-start pb-1 ">

                            <a href="{{ route('indexCatagory') }}"
                                class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full md:w-52">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="#dc2626" fill-rule="evenodd"
                                        d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm4.996 2a1 1 0 0 0 0 2h.01a1 1 0 1 0 0-2zM11 8a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2zm-4.004 3a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2zM11 11a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2zm-4.004 3a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2zM11 14a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2z"
                                        clip-rule="evenodd" />
                                </svg>
                                <p class="text-base leading-4  ">Categorias</p>
                            </a>


                            <a href="{{ route('indexProduct') }}"
                                class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full md:w-52">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="#dc2626" fill-rule="evenodd"
                                        d="M11 4.717c-2.286-.58-4.16-.756-7.045-.71A1.99 1.99 0 0 0 2 6v11c0 1.133.934 2.022 2.044 2.007c2.759-.038 4.5.16 6.956.791zm2 15.081c2.456-.631 4.198-.829 6.956-.791A2.013 2.013 0 0 0 22 16.999V6a1.99 1.99 0 0 0-1.955-1.993c-2.885-.046-4.76.13-7.045.71z"
                                        clip-rule="evenodd" />
                                </svg>
                                <p class="text-base leading-4 ">Productos</p>
                            </a>
                        </div>
                    </div>

                    {{-- Menu 2 --}}
                    <div class="flex flex-col justify-start items-center   px-6 border-b border-gray-600 w-full  ">
                        <button onclick="showMenu2(true)"
                            class="focus:outline-none focus:text-indigo-400 text-left  text-white flex justify-between items-center w-full py-5 space-x-14  ">
                            <p class="text-sm leading-5  uppercase">FACTURACIÓN</p>
                            <svg id="icon1" class="transform" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 15L12 9L6 15" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>

                        <div id="menu2" class="flex justify-start  flex-col w-full md:w-auto items-start pb-1 ">

                            <a href="{{ route('indexShopping') }}"
                                class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2 w-full md:w-52">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="none" stroke="#dc2626" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="m7.171 12.906l-2.153 6.411l2.672-.89l1.568 2.34l1.825-5.183m5.73-2.678l2.154 6.411l-2.673-.89l-1.568 2.34l-1.825-5.183M9.165 4.3c.58.068 1.153-.17 1.515-.628a1.68 1.68 0 0 1 2.64 0a1.68 1.68 0 0 0 1.515.628a1.68 1.68 0 0 1 1.866 1.866c-.068.58.17 1.154.628 1.516a1.68 1.68 0 0 1 0 2.639a1.68 1.68 0 0 0-.628 1.515a1.68 1.68 0 0 1-1.866 1.866a1.68 1.68 0 0 0-1.516.628a1.68 1.68 0 0 1-2.639 0a1.68 1.68 0 0 0-1.515-.628a1.68 1.68 0 0 1-1.867-1.866a1.68 1.68 0 0 0-.627-1.515a1.68 1.68 0 0 1 0-2.64c.458-.361.696-.935.627-1.515A1.68 1.68 0 0 1 9.165 4.3M14 9a2 2 0 1 1-4 0a2 2 0 0 1 4 0" />
                                </svg>
                                <p class="text-base leading-4">Crear compra</p>
                            </a>

                            <a href="{{ route('indexFacture') }}"
                                class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full md:w-52">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="none" stroke="#dc2626" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v5m-3 0h6M4 11h16M5 15h14a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1" />
                                </svg>
                                <p class="text-base leading-4">Ver Facturas</p>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="space-y-2 font-medium">
                {{-- Perfil y Cerrar Sesión --}}
                <br>
                <div
                    class="p-4 flex items-center justify-between bg-gradient-to-r from-indigo-700 to-purple-700 text-white text-center shadow-md">
                    <a class="flex items-center space-x-2" href="{{ route('profile.show') }}">
                        <div>
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="avatar"
                                class="w-8 h-8 rounded-full" />
                        </div>

                        <div class="flex flex-col items-start">
                            <p class="cursor-pointer text-sm leading-5 text-white">{{ Auth::user()->name }}</p>
                            <p class="cursor-pointer text-xs leading-3 text-gray-300">{{ Auth::user()->email }}</p>
                        </div>
                    </a>

                    <form method="POST" action="{{ route('logout') }}" x-data id="logout-form">
                        @csrf
                        <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" class="cursor-pointer">
                                <path fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M16 12H4m12 0l-4 4m4-4l-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2" />
                            </svg>
                        </button>
                    </form>
                </div>
            </ul>
        </div>
    </aside>
</div>

<script>
    let icon1 = document.getElementById("icon1");
    let menu1 = document.getElementById("menu1");
    let menu2 = document.getElementById("menu2");
    const showMenu1 = (flag) => {
        if (flag) {
            icon1.classList.toggle("rotate-180");
            menu1.classList.toggle("hidden");
        }
    };
    const showMenu2 = (flag) => {
        if (flag) {
            icon1.classList.toggle("rotate-180");
            menu2.classList.toggle("hidden");
        }
    };


    let Main = document.getElementById("Main");
    let open = document.getElementById("open");
    let close = document.getElementById("close");

    const showNav = (flag) => {
        if (flag) {
            Main.classList.toggle("-translate-x-full");
            Main.classList.toggle("translate-x-0");
            open.classList.toggle("hidden");
            close.classList.toggle("hidden");
        }
    };
    document.querySelector('[data-drawer-toggle="logo-sidebar"]').addEventListener('click', function() {
        const sidebar = document.getElementById('logo-sidebar');
        sidebar.classList.toggle('-translate-x-full');
        sidebar.classList.toggle('translate-x-0');
    });
</script>
