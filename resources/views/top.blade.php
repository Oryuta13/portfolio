<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Top</title>
</head>
<body>
    <!-- ヘッダー -->
    <div class="w-full h-20 px-10 bg-cyan-800 flex justify-between items-center">
        <div class="text-white text-2xl md:text-4xl font-bold font-['Roboto']">My Portfolio</div>
        <form action="{{ route('user.logout') }}" method="POST">
            @csrf
            <button type="submit" class="px-4 py-2 bg-white rounded flex justify-center items-center text-black text-opacity-75 text-sm md:text-lg font-normal font-['Roboto'] hover:bg-gray-200">ログアウト</button>
        </form>
    </div>

    <!-- avatar -->
    <div class="mt-20 flex items-center justify-center mx-60">
        <!-- アイコン画像 -->
        <div class="relative">
            <div class="w-[320px] h-[320px] bg-gray-300 rounded-full overflow-hidden">
                <!-- ここにアイコン画像を表示するコードを追加 -->
                {{-- <img src="{{ asset('path/to/your/avatar.jpg') }}" alt="User Avatar" class="object-cover w-full h-full rounded-full"> --}}
            </div>
            <!-- ユーザー名 -->
            <div class="mt-5 ml-28 text-black text-opacity-75 font-bold font-['Roboto']">
                {{ \Illuminate\Support\Facades\Auth::user()->name }}
            </div>
        </div>
        <!-- 自己紹介 -->
        <div class="ml-20 flex flex-col items-start">
            <div class="text-black text-opacity-75 text-4xl font-bold font-['Roboto']">自己紹介</div>
            <div class="mt-2 w-40 h-1 bg-black"></div>
            <div class="mt-5 text-black text-opacity-75 font-normal font-['Roboto']">
                ここに自己紹介のテキストが入ります。ここに自己紹介のテキストが入ります。ここに自己紹介のテキストが入ります。ここに自己紹介のテキストが入ります。
            </div>
            <div class="mt-4">
                <button class="w-[180px] h-[40px] px-6 py-2 bg-cyan-800 rounded text-white text-sm font-normal font-['Roboto']">
                    自己紹介を編集する
                </button>
            </div>
        </div>
    </div>

    <!-- 学習チャート -->
    <div class="mt-20 flex flex-col items-center justify-center mx-60">
        <div class="text-black text-opacity-75 text-4xl font-bold font-['Roboto']">学習チャート</div>
        <div class="mt-2 w-80 h-1 bg-black"></div>
        <div class="mt-5">
            <!-- 編集ボタン -->
            <button class="mt-20 w-[180px] h-[40px] px-6 py-2 bg-cyan-800 rounded text-white text-sm font-normal font-['Roboto']">
                編集する
            </button>
    </div>
</div>



    <!-- footer -->
    <div class="w-full h-10 px-10 mt-10 bg-cyan-800 flex justify-center items-center">
        <div class="text-white text-lg font-normal font-['Roboto']">portfolio site</div>
    </div>
</body>
</html>