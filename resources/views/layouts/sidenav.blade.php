<div class="relative min-h-screen flex">
    <!-- MOBILE MENU -->
    <div class="bg-gray-800 text-gray-100 flex justify-between md:hidden bg-nav color-nav">
        <!-- LOGO -->
        <a href="" class="block p-4 text-white font-bold">asd</a>
        <!-- MOBILE MENU BUTTON -->
        <button class="mobile-menu-button p-4 focus:outline-none focus:bg-gray-700">
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>


    <!-- SIDEBAR -->
    <div class="sidebar bg-blue-800 text-blue-100 w-64 space-y-6 py-7 px-1 absolute inset-y-0 left-0 transform -translate-x-full lg:relative lg:translate-x-0 transition duration-200 ease-in-out bg-nav color-nav">
        <!-- LOGO -->
        <a href="#" class="text-white flex items-center space-x-2">
            <img src="" alt="" class="w-8 h-8">
            <span class="text-2x1 font-extrabold"></span>
        </a>
        <!-- NAV -->
        <nav>
            <a href="" class="block py-2.5 px-4 transition duration-200 rounded hover:bg-blue-700 hover:text-white">Home</a>
            <a href="" class="block py-2.5 px-4 transition duration-200 rounded hover:bg-blue-700 hover:text-white">About</a>
            <a href="" class="block py-2.5 px-4 transition duration-200 rounded hover:bg-blue-700 hover:text-white">Features</a>
            <a href="" class="block py-2.5 px-4 transition duration-200 rounded hover:bg-blue-700 hover:text-white">Pricing</a>
        </nav>
    </div>
    <!-- CONTENT -->
    <div></div>
</div>
<script>
    const btn = document.querySelector('.mobile-menu-button');
    const sidebar = document.querySelector('.sidebar');

    btn.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full')
    })
</script>