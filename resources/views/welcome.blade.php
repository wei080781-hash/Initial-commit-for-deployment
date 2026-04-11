@extends('app')
@section('header')
<nav x-data="{ scrolled: false }" 
     @scroll.window="scrolled = window.pageYOffset > 50"
     :class="scrolled ? 'bg-white shadow-sm border-b border-stone-100' : 'bg-transparent'"
     class="fixed top-0 left-0 w-full z-50 transition-all duration-500">
    <div class="w-full mx-auto px-10 h-24 flex items-center justify-start">
        <!-- Logo -->
        <div class="flex-shrink-0 text-3xl font-bold tracking-tighter transition-colors duration-500"
             :class="scrolled ? 'text-orange-400' : 'text-white'">
            Haven Pets
        </div>

        <!-- 導航選單 (靠左對齊並放大字體) -->
        <div class="hidden lg:flex items-center ml-20 space-x-10 text-base font-semibold tracking-widest uppercase transition-colors duration-500"
             :class="scrolled ? 'text-stone-700' : 'text-white'">
            <a href="#" class="hover:text-orange-400 transition">關於 Haven</a>
            <a href="#" class="hover:text-orange-400 transition">好評推薦</a>
            <a href="#" class="hover:text-orange-400 transition">狗狗專區</a>
            <a href="#" class="hover:text-orange-400 transition">貓貓專區</a>
            <a href="#" class="hover:text-orange-400 transition">最新消息</a>
            <a href="#" class="hover:text-orange-400 transition">知識分享</a>
            <a href="#" class="hover:text-orange-400 transition">銷售據點</a>
        </div>

        <!-- 右側功能 (推至最右側) -->
        <div class="flex items-center ml-auto space-x-6 transition-colors duration-500"
             :class="scrolled ? 'text-stone-500' : 'text-white'">
            <button class="hover:text-orange-400 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607z" />
                </svg>
            </button>
            <a href="{{ route('login') }}" class="hover:text-orange-400 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
            </a>
            <a href="#" class="hover:text-orange-400 transition relative">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
                <span class="absolute -top-1 -right-1 bg-orange-400 text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center">0</span>
            </a>
        </div>
    </div>
</nav>
@endsection

@section('content')
<section class="relative h-screen w-full overflow-hidden bg-stone-900" x-data="{active:0,slides: [
    @forelse($carousels as $carousel)
        {title: '{{ $carousel->title }}', description: '{{ $carousel->description }}', image: '{{ asset('storage/' . $carousel->image_path) }}'},
    @empty
        {title:'給毛孩最溫暖的居家呵護', description: 'Natural & Comfort', image: 'https://images.unsplash.com/photo-1516734212186-a967f81ad0d7?auto=format&fit=crop&w=1600&q=80'},
        {title: '如同家人般愛戴', description: 'Family', image: 'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?auto=format&fit=crop&w=1600&q=80'}
    @endforelse
]}" x-init="setInterval(()=> { active = (active + 1) % slides.length}, 5000)">
    
    <!-- 輪播內容 -->
    <div class="relative h-full w-full">
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="active === index" 
                 x-transition:enter="transition opacity duration-1000"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition opacity duration-1000"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 flex items-center justify-center">
                
                <!-- 圖片填滿全螢幕 -->
                <img :src="slide.image" class="absolute inset-0 w-full h-full object-cover">

                <!-- 文字遮罩與暗化層 (確保文字清晰) -->
                <div class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center text-center px-4">
                    <h1 class="text-5xl md:text-8xl font-bold text-white mb-6 drop-shadow-2xl tracking-tighter" 
                        x-text="slide.title"
                        x-transition:enter="transition transform duration-1000 delay-300"
                        x-transition:enter-start="translate-y-12 opacity-0"
                        x-transition:enter-end="translate-y-0 opacity-100">
                    </h1>
                    <p class="text-xl md:text-2xl text-stone-200 tracking-[0.3em] uppercase drop-shadow-lg font-light" 
                       x-text="slide.description"
                       x-transition:enter="transition transform duration-1000 delay-500"
                       x-transition:enter-start="translate-y-8 opacity-0"
                       x-transition:enter-end="translate-y-0 opacity-100">
                    </p>
                    
                    <div class="mt-12" x-transition:enter="transition opacity duration-1000 delay-700" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                        <a href="#featured" class="px-8 py-3 border border-white text-white hover:bg-white hover:text-stone-900 transition-all duration-300 tracking-widest text-sm uppercase">探索更多</a>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- 控制按鈕 -->
    <button @click="active = (active - 1 + slides.length) % slides.length"
        class="absolute top-1/2 left-8 z-30 p-4 rounded-full text-white/50 hover:text-white transition-all duration-300">
        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button @click="active = (active + 1) % slides.length"
        class="absolute top-1/2 right-8 z-30 p-4 rounded-full text-white/50 hover:text-white transition-all duration-300">
        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/></svg>
    </button>

    <!-- 滾動提示指標 -->
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-30 flex flex-col items-center">
        <span class="text-white/40 text-[10px] uppercase tracking-[0.2em] mb-4">Scroll Down</span>
        <div class="w-[1px] h-12 bg-gradient-to-b from-white to-transparent opacity-50"></div>
    </div>
</section>

<!-- 精選商品區塊 -->
<div id="featured" class="min-h-screen bg-white py-32 px-4 sm:px-8">
    <div class="max-w-[1400px] mx-auto">
        <div class="flex flex-col items-center mb-24">
            <h2 class="text-4xl font-bold text-stone-800 tracking-[0.2em] uppercase">首頁精選商品</h2>
            <div class="w-12 h-1 bg-orange-400 mt-4"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-6 md:gap-x-12 gap-y-16 md:gap-y-24 justify-items-center">
            @forelse($products as $product)
            <div class="flex flex-col group cursor-pointer w-full max-w-[400px]">
                <!-- 圖片容器 -->
                <div class="w-full aspect-[3/4] md:aspect-square overflow-hidden bg-[#F9F9F9] relative mb-3">
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[2s] ease-out">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/[0.02] transition-colors duration-700"></div>
                </div>
                
                <!-- 文字資訊：縮小間距並放大字體至 14px 且加粗 -->
                <div class="flex flex-col text-left space-y-1 px-2 md:px-0">
                    <h3 class="text-[14px] md:text-[16px] font-bold text-stone-800 tracking-[0.1em] uppercase transition-colors duration-300 group-hover:text-orange-400">
                        {{ $product->name }}
                    </h3>
                    <p class="text-[14px] md:text-[16px] font-bold text-stone-900 tracking-[0.1em]">
                        NT$ {{ number_format($product->price) }}
                    </p>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-20 text-stone-300 tracking-widest italic">
                COMING SOON
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- 回到頂部按鈕 -->
<div x-data="{ showTop: false }" 
     x-init="window.addEventListener('scroll', () => { showTop = window.pageYOffset > 400 })"
     class="fixed bottom-8 right-8 z-50">
    <button x-show="showTop" 
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-10"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-500"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-10"
            @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
            class="bg-stone-900 hover:bg-orange-400 text-white p-4 rounded-full shadow-2xl transition-all duration-300 group">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 group-hover:-translate-y-1 transition-transform">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
        </svg>
    </button>
</div>
@endsection

@section('footer')
<footer class="bg-stone-900 text-stone-400 py-24 border-t border-stone-800">
    <div class="max-w-[1400px] mx-auto px-8 grid grid-cols-1 md:grid-cols-4 gap-16">
        <div class="space-y-8">
            <h4 class="text-3xl font-bold text-white tracking-tighter">Haven Pets</h4>
            <p class="text-sm leading-relaxed font-light">
                Haven 在英文中意為「避風港」。我們致力於為毛孩打造一個充滿愛與舒適的歸屬地。
            </p>
            <div class="flex space-x-6 text-white/50">
                <a href="#" class="hover:text-orange-400 transition"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg></a>
                <a href="#" class="hover:text-orange-400 transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line></svg></a>
            </div>
        </div>
        <div>
            <h5 class="text-white font-bold mb-8 tracking-widest text-xs uppercase">探索 Haven Pets</h5>
            <ul class="space-y-4 text-sm font-light">
                <li><a href="#" class="hover:text-white transition">關於我們</a></li>
                <li><a href="#" class="hover:text-white transition">所有商品</a></li>
                <li><a href="#" class="hover:text-white transition">最新消息</a></li>
            </ul>
        </div>
        <div>
            <h5 class="text-white font-bold mb-8 tracking-widest text-xs uppercase">顧客服務</h5>
            <ul class="space-y-4 text-sm font-light">
                <li><a href="#" class="hover:text-white transition">常見問題</a></li>
                <li><a href="#" class="hover:text-white transition">運送政策</a></li>
                <li><a href="#" class="hover:text-white transition">隱私權條款</a></li>
            </ul>
        </div>
        <div class="space-y-6">
            <h5 class="text-white font-bold mb-8 tracking-widest text-xs uppercase">聯絡我們</h5>
            <p class="text-sm font-light">台北市信義區寵物路 123 號</p>
            <p class="text-sm font-light text-white">Email: service@havenpets.com</p>
        </div>
    </div>
    <div class="max-w-[1400px] mx-auto px-8 mt-24 pt-8 border-t border-stone-800 text-[10px] flex justify-between items-center text-stone-600 tracking-[0.2em] uppercase">
        <p>© 2026 Haven Pets Co., Ltd.</p>
        <p>Designed for Pets with Love</p>
    </div>
</footer>
@endsection
