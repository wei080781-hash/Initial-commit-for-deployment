<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haven 風格寵物店</title>
    <!-- 這裡會引入 Vite 編譯後的 CSS (包含Tailwind) -->
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-stone-50 text-gray-800 font-sans"> 
    <!-- 導覽列列 (Navbar) 這裡可以放共用選單 -->
     <header>
     @yield('header')
    
     </header>
     <main>
      @yield('content')
     </main>
     <footer>
    {{-- 頁尾內容 --}}
    @yield('footer')
     </footer>
</body>
</html>