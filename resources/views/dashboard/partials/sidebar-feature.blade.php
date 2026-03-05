<aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-blue-800 to-blue-950 text-white shadow-xl transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
    <button id="closeSidebar" class="lg:hidden absolute top-4 right-4 text-white hover:text-blue-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <div class="p-4 lg:p-6 border-b border-blue-700">
        <div class="flex items-center gap-3">
            <img src="{{ asset('assets/pln.jpg') }}" alt="Logo PLN" class="w-10 h-10 lg:w-12 lg:h-12 object-contain bg-white rounded-lg p-1">
            <div>
                <h2 class="text-lg lg:text-xl font-bold">UP3 BOGOR</h2>
                <p class="text-blue-300 text-xs">{{ session('role') === 'admin' ? 'Admin Panel' : 'User Panel' }}</p>
            </div>
        </div>
    </div>

    <nav class="p-3 lg:p-4 space-y-2">
        <a href="/dashboard" class="flex items-center gap-3 px-3 lg:px-4 py-2.5 lg:py-3 rounded-lg hover:bg-blue-700 transition duration-200">
             <i class="bi bi-speedometer2 text-lg"></i>
            <span class="font-medium text-sm lg:text-base">Dashboard</span>
        </a>

        @if (session('role') === 'admin')
        <a href="/userulps" class="flex items-center gap-3 px-3 lg:px-4 py-2.5 lg:py-3 rounded-lg hover:bg-blue-700 transition duration-200">
            <i class="bi bi-people-fill text-lg"></i>
            <span class="font-medium text-sm lg:text-base">User ULP</span>
        </a>
        @endif

        <a href="/tims" class="flex items-center gap-3 px-3 lg:px-4 py-2.5 lg:py-3 rounded-lg hover:bg-blue-700 transition duration-200">
            <i class="bi bi-person-badge text-lg"></i>
            <span class="font-medium text-sm lg:text-base">Tim</span>
        </a>

        <a href="/transaksis" class="flex items-center gap-3 px-3 lg:px-4 py-2.5 lg:py-3 rounded-lg hover:bg-blue-700 transition duration-200">
            <i class="bi bi-clipboard-data text-lg"></i>
            <span class="font-medium text-sm lg:text-base">Transaksi</span>
        </a>
    </nav>

    <div class="absolute bottom-0 left-0 right-0 p-3 lg:p-4 border-t border-blue-700 bg-blue-900">
        <div class="flex items-center gap-2 lg:gap-3 px-3 lg:px-4 py-2.5 lg:py-3 rounded-lg">
            <div class="w-8 h-8 lg:w-10 lg:h-10 rounded-full bg-blue-600 flex items-center justify-center font-bold text-base lg:text-lg flex-shrink-0">
                {{ strtoupper(substr(session('username'), 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-semibold text-xs lg:text-sm truncate">{{ session('username') }}</p>
                <p class="text-blue-300 text-xs uppercase">{{ session('role') }}</p>
            </div>
        </div>
    </div>
</aside>

<button id="menuToggle" class="fixed top-4 left-4 z-40 lg:hidden bg-blue-700 text-white p-2 rounded-lg shadow">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
</button>

<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>

<script>
    (function() {
        const menuToggle = document.getElementById('menuToggle');
        const closeSidebar = document.getElementById('closeSidebar');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        if (!menuToggle || !closeSidebar || !sidebar || !overlay) return;

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebarFunc() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        menuToggle.addEventListener('click', openSidebar);
        closeSidebar.addEventListener('click', closeSidebarFunc);
        overlay.addEventListener('click', closeSidebarFunc);

        const sidebarLinks = sidebar.querySelectorAll('a');
        sidebarLinks.forEach((link) => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) {
                    closeSidebarFunc();
                }
            });
        });
    })();
</script>
