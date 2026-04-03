@extends('admin.layout')

@section('admin_content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.products.index') }}" class="text-stone-400 hover:text-orange-400 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-stone-800">新增商品</h1>
    </div>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-stone-100">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-medium text-stone-700 mb-2">商品圖片</label>
                <input type="file" name="image" class="w-full text-stone-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-400 hover:file:bg-orange-100 transition" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-stone-700 mb-2">商品名稱</label>
                <input type="text" name="name" class="w-full px-4 py-3 rounded-lg border border-stone-100 focus:outline-none focus:ring-2 focus:ring-orange-400 transition" placeholder="例如：優質貓糧" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-stone-700 mb-2">價格 (NT$)</label>
                <input type="number" name="price" step="0.01" class="w-full px-4 py-3 rounded-lg border border-stone-100 focus:outline-none focus:ring-2 focus:ring-orange-400 transition" placeholder="例如：500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-stone-700 mb-2">商品描述</label>
                <textarea name="description" rows="4" class="w-full px-4 py-3 rounded-lg border border-stone-100 focus:outline-none focus:ring-2 focus:ring-orange-400 transition" placeholder="輸入商品細節..."></textarea>
            </div>
            <div class="pt-4">
                <button type="submit" class="w-full bg-orange-400 text-white py-3 rounded-lg font-bold hover:bg-orange-500 shadow-md shadow-orange-100 transition">
                    確認新增
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
