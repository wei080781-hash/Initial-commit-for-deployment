@extends('admin.layout')

@section('admin_content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.carousels.index') }}" class="text-stone-400 hover:text-orange-400 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-stone-800">編輯輪播圖</h1>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-stone-100">
        <form action="{{ route('admin.carousels.update', $carousel) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-stone-700 mb-2">目前圖片</label>
                <img src="{{ asset('storage/' . $carousel->image_path) }}" alt="Current" class="w-48 h-32 object-cover rounded-lg mb-4">
                <label class="block text-sm font-medium text-stone-700 mb-2">更換圖片 (建議尺寸: 1920x600)</label>
                <p class="text-xs text-stone-400 mb-2">上傳寬比例圖片效果最佳，系統會完整顯示整張圖。</p>
                <input type="file" name="image" class="w-full text-stone-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-400 hover:file:bg-orange-100 transition">
            </div>
            <div>
                <label class="block text-sm font-medium text-stone-700 mb-2">標題</label>
                <input type="text" name="title" value="{{ $carousel->title }}" class="w-full px-4 py-3 rounded-lg border border-stone-100 focus:outline-none focus:ring-2 focus:ring-orange-400 transition" placeholder="輸入標題 (選填)">
            </div>
            <div>
                <label class="block text-sm font-medium text-stone-700 mb-2">描述</label>
                <input type="text" name="description" value="{{ $carousel->description }}" class="w-full px-4 py-3 rounded-lg border border-stone-100 focus:outline-none focus:ring-2 focus:ring-orange-400 transition" placeholder="輸入描述 (選填)">
            </div>
            <div>
                <label class="block text-sm font-medium text-stone-700 mb-2">排序</label>
                <input type="number" name="order" value="{{ $carousel->order }}" class="w-full px-4 py-3 rounded-lg border border-stone-100 focus:outline-none focus:ring-2 focus:ring-orange-400 transition">
            </div>
            <div class="pt-4">
                <button type="submit" class="w-full bg-orange-400 text-white py-3 rounded-lg font-bold hover:bg-orange-500 shadow-md shadow-orange-100 transition">
                    儲存更新
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
