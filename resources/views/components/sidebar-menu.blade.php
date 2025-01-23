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
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-800 dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('dashboard') }}">
                        <div class="hidden xl:flex justify-start p-6 items-center space-x-3">
                            <svg width="34" height="34" viewBox="0 0 34 34" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M1 17H0H1ZM7 17H6H7ZM17 27V28V27ZM27 17H28H27ZM17 0C12.4913 0 8.1673 1.79107 4.97918 4.97918L6.3934 6.3934C9.20644 3.58035 13.0218 2 17 2V0ZM4.97918 4.97918C1.79107 8.1673 0 12.4913 0 17H2C2 13.0218 3.58035 9.20644 6.3934 6.3934L4.97918 4.97918ZM0 17C0 21.5087 1.79107 25.8327 4.97918 29.0208L6.3934 27.6066C3.58035 24.7936 2 20.9782 2 17H0ZM4.97918 29.0208C8.1673 32.2089 12.4913 34 17 34V32C13.0218 32 9.20644 30.4196 6.3934 27.6066L4.97918 29.0208ZM17 34C21.5087 34 25.8327 32.2089 29.0208 29.0208L27.6066 27.6066C24.7936 30.4196 20.9782 32 17 32V34ZM29.0208 29.0208C32.2089 25.8327 34 21.5087 34 17H32C32 20.9782 30.4196 24.7936 27.6066 27.6066L29.0208 29.0208ZM34 17C34 12.4913 32.2089 8.1673 29.0208 4.97918L27.6066 6.3934C30.4196 9.20644 32 13.0218 32 17H34ZM29.0208 4.97918C25.8327 1.79107 21.5087 0 17 0V2C20.9782 2 24.7936 3.58035 27.6066 6.3934L29.0208 4.97918ZM17 6C14.0826 6 11.2847 7.15893 9.22183 9.22183L10.636 10.636C12.3239 8.94821 14.6131 8 17 8V6ZM9.22183 9.22183C7.15893 11.2847 6 14.0826 6 17H8C8 14.6131 8.94821 12.3239 10.636 10.636L9.22183 9.22183ZM6 17C6 19.9174 7.15893 22.7153 9.22183 24.7782L10.636 23.364C8.94821 21.6761 8 19.3869 8 17H6ZM9.22183 24.7782C11.2847 26.8411 14.0826 28 17 28V26C14.6131 26 12.3239 25.0518 10.636 23.364L9.22183 24.7782ZM17 28C19.9174 28 22.7153 26.8411 24.7782 24.7782L23.364 23.364C21.6761 25.0518 19.3869 26 17 26V28ZM24.7782 24.7782C26.8411 22.7153 28 19.9174 28 17H26C26 19.3869 25.0518 21.6761 23.364 23.364L24.7782 24.7782ZM28 17C28 14.0826 26.8411 11.2847 24.7782 9.22183L23.364 10.636C25.0518 12.3239 26 14.6131 26 17H28ZM24.7782 9.22183C22.7153 7.15893 19.9174 6 17 6V8C19.3869 8 21.6761 8.94821 23.364 10.636L24.7782 9.22183ZM10.3753 8.21913C6.86634 11.0263 4.86605 14.4281 4.50411 18.4095C4.14549 22.3543 5.40799 26.7295 8.13176 31.4961L9.86824 30.5039C7.25868 25.9371 6.18785 21.9791 6.49589 18.5905C6.80061 15.2386 8.46699 12.307 11.6247 9.78087L10.3753 8.21913ZM23.6247 25.7809C27.1294 22.9771 29.1332 19.6127 29.4958 15.6632C29.8549 11.7516 28.5904 7.41119 25.8682 2.64741L24.1318 3.63969C26.7429 8.20923 27.8117 12.1304 27.5042 15.4803C27.2001 18.7924 25.5372 21.6896 22.3753 24.2191L23.6247 25.7809Z"
                                    fill="white" />
                            </svg>
                            <p class="text-2xl leading-6 text-white">E-FACTURA</p>
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

                            {{-- <a href="#"
                                class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full md:w-52">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="#dc2626" fill-rule="evenodd"
                                        d="M8 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1h2a2 2 0 0 1 2 2v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2zm6 1h-4v2H9a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2h-1zm-6 8a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H9a1 1 0 0 1-1-1m1 3a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2z"
                                        clip-rule="evenodd" />
                                </svg>
                                <p class="text-base leading-4 ">Docentes</p>
                            </a>

                            <a href="#"
                                class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2 w-full md:w-52">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="#dc2626" fill-rule="evenodd"
                                        d="M7 2a2 2 0 0 0-2 2v1a1 1 0 0 0 0 2v1a1 1 0 0 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zm3 8a3 3 0 1 1 6 0a3 3 0 0 1-6 0m-1 7a3 3 0 0 1 3-3h2a3 3 0 0 1 3 3a1 1 0 0 1-1 1h-6a1 1 0 0 1-1-1"
                                        clip-rule="evenodd" />
                                </svg>
                                <p class="text-base leading-4  ">Estudiantes</p>
                            </a> --}}

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
                                    <path fill="none" stroke="#dc2626" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2"
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

                            {{-- <a href="#"
                                class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full md:w-52">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <g fill="#dc2626" fill-rule="evenodd" clip-rule="evenodd">
                                        <path
                                            d="M6 5a2 2 0 0 1 2-2h4.157a2 2 0 0 1 1.656.879L15.249 6H19a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2v-5a3 3 0 0 0-3-3h-3.22l-1.14-1.682A3 3 0 0 0 9.157 6H6z" />
                                        <path
                                            d="M3 9a2 2 0 0 1 2-2h4.157a2 2 0 0 1 1.656.879L12.249 10H3zm0 3v7a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2v-7z" />
                                    </g>
                                </svg>
                                <p class="text-base leading-4  ">Elecciones</p>
                            </a>

                            <a href="#"
                                class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2 w-full md:w-52">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="#dc2626" fill-rule="evenodd"
                                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12m11-4.243a1 1 0 1 0-2 0V11H7.757a1 1 0 1 0 0 2H11v3.243a1 1 0 1 0 2 0V13h3.243a1 1 0 1 0 0-2H13z"
                                        clip-rule="evenodd" />
                                </svg>
                                <p class="text-base leading-4">Postulación</p>

                            </a> --}}

                        </div>
                    </div>
                </li>
            </ul>
            <ul class="space-y-2 font-medium">
                {{-- Perfil y Cerrar Sesión --}}
                <div class="p-4 flex items-center justify-between bg-gray-800 shadow-md">
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
</script>
