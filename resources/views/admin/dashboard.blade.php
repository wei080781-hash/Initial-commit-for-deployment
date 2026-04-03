@extends('admin.layout')

@section('admin_content')
<div class="space-y-8">
    <!-- 頁面標題 -->
    <div>
        <h1 class="text-2xl font-bold text-stone-800">後台管理中心</h1>
        <p class="text-stone-500 mt-1">歡迎回來，威利。在這裡您可以輕鬆管理您的寵物店內容。</p>
    </div>

    <!-- 快捷操作 -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('admin.carousels.index') }}" class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 flex items-center hover:border-orange-200 transition">
            <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center text-orange-500 mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-stone-800">管理輪播圖</h3>
                <p class="text-stone-500 text-sm">更換首頁大型看板圖片與文字</p>
            </div>
        </a>

        <a href="{{ route('admin.products.index') }}" class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 flex items-center hover:border-orange-200 transition">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-blue-500 mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-stone-800">精選商品管理</h3>
                <p class="text-stone-500 text-sm">編輯首頁顯示的精選商品圖、名稱與價格</p>
            </div>
        </a>
    </div>
</div>
@endsection
