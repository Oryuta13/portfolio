<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>ログイン</title>
</head>
<body>
    <!-- ヘッダー -->
    <div class="w-full h-20 px-10 bg-cyan-800 flex justify-center items-center">
        <div class="text-white text-2xl md:text-4xl font-bold font-['Roboto']">My Portfolio</div>
    </div>
    <!-- エラーメッセージ -->
    @if (session('loginError'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative text-center">
            {{ session('loginError') }}
        </div>
    @endif
    <div class="mt-40 text-center text-black text-opacity-75 text-4xl font-normal font-['Roboto'] leading-[48.02px]">ログイン</div>

    <!-- フォーム -->
    <form action="" method="post" class="mx-auto max-w-screen-lg space-y-6" novalidate>
        @csrf
        <div class="w-96 mx-auto py-4">
            <label for="email" class="block text-sm font-medium text-gray-700">メールアドレス</label>
            <input type="email" name="email" id="email" class="mt-1 border-b-2 border-gray-500 focus:outline-none focus:border-gray-500 w-full">
        </div>
        <div class="w-96 mx-auto py-4">
            <label for="password" class="block text-sm font-medium text-gray-700">パスワード</label>
            <input type="password" name="password" id="password" class="mt-1 border-b-2 border-gray-500 focus:outline-none focus:border-gray-500 w-full">
        </div>
        <!-- ボタン -->
        <div class="flex justify-center items-center">
            <button type="submit" class="py-2 px-20 rounded-md bg-cyan-800 hover:bg-cyan-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-900 text-white">ログインする</button>
        </div>
    </form>
    <form action="/register" method="get" class="mt-12">
        @csrf
        <div class="flex justify-center items-center">
            <button type="submit" class="py-2 px-20 rounded-md bg-cyan-800 hover:bg-cyan-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-900 text-white">新規登録する</button>
        </div>
    </form>
    <!-- フッター -->
    <div class="w-full h-10 px-10 mt-20 bg-cyan-800 flex justify-center items-center">
        <div class="text-white text-lg font-normal font-['Roboto']">portfolio site</div>
    </div>
</body>
</html>