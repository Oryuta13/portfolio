<!doctype html>
<html lang="en" class="flex flex-col min-h-screen">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>新規登録</title>
</head>
<body class="flex flex-col min-h-screen">
    <!-- ヘッダー -->
    <div class="w-full h-[120px] px-10 bg-custom-blue flex justify-between items-center">
        <div class="text-white text-3xl font-bold font-['Roboto']">My Portfolio</div>
        <a href="{{ route('login') }}" class="px-10 py-4 bg-white rounded flex justify-center items-center text-black text-lg font-normal font-['Roboto'] hover:bg-gray-200">ログイン</a>
    </div>

    <!-- メインコンテンツ -->
    <div class="flex-grow">

    <div class="mt-20 text-center text-black text-3xl font-normal font-['Roboto']">新規登録</div>
    <!-- フォーム -->
    <form action="" method="post" class="mx-auto max-w-screen-lg space-y-6 mt-12" novalidate>
        @csrf
        <div class="w-[480px] mx-auto py-2">
            <label for="name" class="block text-sm font-medium text-gray-700">氏名</label>
            <input type="text" name="name" id="name" class="mt-1 border-b border-gray-500 focus:outline-none focus:border-gray-500 w-full">
            @error('name')
            <div class="text-red-500 text-xs mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="w-[480px] mx-auto py-2">
            <label for="email" class="block text-sm font-medium text-gray-700">メールアドレス</label>
            <input type="email" name="email" id="email" class="mt-1 border-b border-gray-500 focus:outline-none focus:border-gray-500 w-full">
            @error('email')
                <div class="text-red-500 text-xs mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="w-[480px] mx-auto py-2">
            <label for="password" class="block text-sm font-medium text-gray-700">パスワード</label>
            <input type="password" name="password" id="password" class="mt-1 border-b border-gray-500 focus:outline-none focus:border-gray-500 w-full">
            @error('password')
                <div class="text-red-500 text-xs mt-2">{{ $message }}</div>
            @enderror
        </div>
        <!-- 登録ボタン -->
        <div class="flex justify-center items-center">
            <button type="submit" class="mt-4 mb-20 py-4 px-20 rounded-md bg-custom-blue hover:bg-cyan-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-900 text-white">登録する</button>
        </div>
    </form>
    </div>
    <!-- フッター -->
    <div class="w-full h-[40px] mt-auto px-10 bg-custom-blue flex justify-center items-center">
        <div class="text-white text-lg font-normal font-['Roboto']">portfolio site</div>
    </div>
</body>
</html>
