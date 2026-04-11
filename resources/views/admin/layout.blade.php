<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haven 後台管理系統</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-stone-50 font-sans text-stone-800" x-data="{ sidebarOpen: false }">
    
    <!-- 側邊欄 (Sidebar) -->
    <aside :class="sidebarOpen ? 'w-64' : 'w-20'" 
           class="fixed left-0 top-0 h-full bg-stone-800 text-stone-300 transition-all duration-300 z-50 overflow-hidden shadow-xl lg:shadow-none">
        
        <!-- Logo 區域 -->
        <div class="h-16 flex items-center px-6 border-b border-stone-700">
            <span class="text-orange-400 font-bold text-2xl tracking-wider" x-show="sidebarOpen">Haven Pets</span>
            <span class="text-orange-400 font-bold text-2xl mx-auto" x-show="!sidebarOpen">HP</span>
        </div>

        <!-- 導航連結 -->
        <nav class="mt-6 px-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center p-3 rounded-lg hover:bg-stone-700 hover:text-white transition group {{ request()->routeIs('admin.dashboard') ? 'bg-stone-700 text-white' : '' }}">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="ml-4 whitespace-nowrap" x-show="sidebarOpen">後台儀表板</span>
            </a>

            <a href="{{ route('admin.carousels.index') }}" class="flex items-center p-3 rounded-lg hover:bg-stone-700 hover:text-white transition group {{ request()->routeIs('admin.carousels.*') ? 'bg-stone-700 text-white' : '' }}">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="ml-4 whitespace-nowrap" x-show="sidebarOpen">輪播管理</span>
            </a>

            <a href="{{ route('admin.products.index') }}" class="flex items-center p-3 rounded-lg hover:bg-stone-700 hover:text-white transition group {{ request()->routeIs('admin.products.*') ? 'bg-stone-700 text-white' : '' }}">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <span class="ml-4 whitespace-nowrap" x-show="sidebarOpen">商品管理</span>
            </a>
        </nav>
        
        <div class="absolute bottom-0 w-full p-4 border-t border-stone-700">
            <a href="{{ route('index') }}" class="flex items-center p-3 rounded-lg hover:bg-stone-700 hover:text-white transition group">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                <span class="ml-4 whitespace-nowrap" x-show="sidebarOpen">回前台</span>
            </a>
        </div>
    </aside>

    <!-- 主要內容區 (Main Content) -->
    <main :class="sidebarOpen ? 'ml-64' : 'ml-20'" class="transition-all duration-300 min-h-screen">
        <!-- 頂部 Header -->
        <header class="h-16 bg-white border-b border-stone-200 flex items-center justify-between px-8 sticky top-0 z-30">
            <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-stone-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
            </button>
            <div class="hidden lg:block text-stone-500 text-sm">後台管理系統</div>
            
            <div class="flex items-center space-x-4">
                <!-- 只顯示名稱 -->
                <div id="adminUserArea" class="hidden flex items-center space-x-2 relative" x-data="{ open: false }">
                    <span id="userName" class="font-medium text-stone-700"></span>
                    <button @click="open = !open" class="text-stone-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg></button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 border border-stone-100 z-50">
                        <button onclick="logout()" class="block w-full text-left px-4 py-2 text-sm text-stone-700 hover:bg-stone-100">登出</button>
                    </div>
                </div>
                <a id="loginLink" href="{{ route('login') }}" class="text-orange-500 hover:underline">登入</a>
            </div>

            <script>
                async function checkAuth() {
                    const token = localStorage.getItem('auth_token');
                    if (token) {
                        try {
                            const response = await fetch("{{ url('api/user') }}", {
                                headers: { 
                                    'Authorization': `Bearer ${token}`, 
                                    'Accept': 'application/json' 
                                }
                            });
                            if (response.ok) {
                                const user = await response.json();
                                document.getElementById('adminUserArea').classList.remove('hidden');
                                document.getElementById('loginLink').classList.add('hidden');
                                document.getElementById('userName').textContent = user.name;
                                document.getElementById('userAvatar').textContent = user.name.charAt(0).toUpperCase();
                            } else {
                                localStorage.removeItem('auth_token');
                            }
                        } catch (e) {
                            console.error('Auth error', e);
                        }
                    }
                }
                
                function logout() {
                    localStorage.removeItem('auth_token');
                    window.location.href = "{{ route('login') }}";
                }

                checkAuth();
            </script>
        </header>

        <!-- 視圖內容 -->
        <div class="p-4 md:p-8">
            @yield('admin_content')
        </div>
    </main>
</body>
</html>
