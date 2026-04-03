@extends('admin.layout')

@section('admin_content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-stone-800">首頁精選商品管理</h1>
        <a href="{{ route('admin.products.create') }}" class="bg-orange-400 text-white px-4 py-2 rounded-lg hover:bg-orange-500 transition">
            新增商品
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-stone-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-stone-50 border-b border-stone-100 text-stone-500 text-sm uppercase">
                <tr>
                    <th class="px-6 py-4">商品圖</th>
                    <th class="px-6 py-4">名稱</th>
                    <th class="px-6 py-4">價格</th>
                    <th class="px-6 py-4 text-right">操作</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-100">
                @foreach($products as $product)
                <tr class="hover:bg-stone-50 transition">
                    <td class="px-6 py-4">
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-20 h-20 object-cover rounded-lg">
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-stone-800 font-medium">{{ $product->name }}</div>
                        <div class="text-stone-400 text-sm truncate max-w-xs">{{ $product->description }}</div>
                    </td>
                    <td class="px-6 py-4 font-bold text-orange-400">NT$ {{ number_format($product->price) }}</td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-500 hover:underline">編輯</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('確定要刪除嗎？')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">刪除</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
