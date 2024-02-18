<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>項目一覧</title>
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

    <!-- ドロップダウンボタン -->
    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-black bg-gray-100 hover:bg-gray-200 font-bold text-sm px-2.5 py-2 text-center inline-flex items-center shadow mx-20 mt-10" type="button">今月 <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
    </svg>
    </button>

    <!-- ドロップダウンメニュー -->
    <div id="dropdown" class="z-10 hidden mx-20 bg-gray-100 divide-y divide-gray-200 shadow" style="width: fit-content;">
        <ul class="py-2 text-sm text-black" aria-labelledby="dropdownDefaultButton">
          <li>
            <a href="#" class="block px-2.5 py-2 hover:bg-gray-200">今月</a>
          </li>
          <li>
            <a href="#" class="block px-2.5 py-2 hover:bg-gray-200">先月</a>
          </li>
          <li>
            <a href="#" class="block px-2.5 py-2 hover:bg-gray-200">先々月</a>
          </li>
        </ul>
    </div>

    <!-- バックエンド -->
    <div class="mx-20 mt-10 w-200 border border-gray-400 p-6 rounded">
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-bold mb-6 border-b border-gray-500 pb-2" style="width: 30%;">バックエンド</h2>
            <button class="mb-4 bg-cyan-800 text-white px-4 py-2 rounded hover:bg-cyan-900 cursor-pointer">項目を追加する</button>
        </div>
        <div class="border border-gray-400 rounded shadow">
            <div class="mb-4 border-b border-gray-400 p-4 flex justify-between items-center">
                <span>項目名</span>
                <span class="absolute left-1/3">学習時間</span>
            </div>
            <div class="mb-4 border-b border-gray-400 flex items-center">
              <span class="px-4 pb-4">Ruby</span>
              <input type="number" class="mb-4 absolute left-1/3 w-28 border border-gray-400 rounded px-2 py-1" min="0" step="1">
              <button class="mb-4 absolute right-1/3 px-4 py-1 border border-cyan-800 text-cyan-800 rounded hover:bg-gray-100 cursor-pointer mr-2">保存する</button>
              <button class="mb-4 ml-auto mr-4 px-4 py-1 bg-red-500 text-white rounded hover:bg-red-600 cursor-pointer">削除する</button>
            </div>
            <div class="mb-4 border-b border-gray-400 flex items-center">
              <span class="px-4 pb-4">Java</span>
              <input type="number" class="mb-4 absolute left-1/3 w-28 border border-gray-400 rounded px-2 py-1" min="0" step="1">
              <button class="mb-4 absolute right-1/3 px-4 py-1 border border-cyan-800 text-cyan-800 rounded hover:bg-gray-100 cursor-pointer mr-2">保存する</button>
              <button class="mb-4 ml-auto mr-4 px-4 py-1 bg-red-500 text-white rounded hover:bg-red-600 cursor-pointer">削除する</button>
            </div>
            <div class="flex items-center">
              <span class="px-4 pb-4">PHP</span>
              <input type="number" class="mb-4 absolute left-1/3 w-28 border border-gray-400 rounded px-2 py-1" min="0" step="1">
              <button class="mb-4 absolute right-1/3 px-4 py-1 border border-cyan-800 text-cyan-800 rounded hover:bg-gray-100 cursor-pointer mr-2">保存する</button>
              <button class="mb-4 ml-auto mr-4 px-4 py-1 bg-red-500 text-white rounded hover:bg-red-600 cursor-pointer">削除する</button>
            </div>
        </div>
    </div>

    <!-- フロントエンド -->
    <div class="mx-20 mt-10 w-200 border border-gray-400 p-6 rounded">
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-bold mb-6 border-b border-gray-500 pb-2" style="width: 30%;">フロントエンド</h2>
            <button class="mb-4 bg-cyan-800 text-white px-4 py-2 rounded hover:bg-cyan-900 cursor-pointer">項目を追加する</button>
        </div>
        <div class="border border-gray-400 rounded shadow">
            <div class="mb-4 border-b border-gray-400 p-4 flex justify-between items-center">
                <span>項目名</span>
                <span class="absolute left-1/3">学習時間</span>
            </div>
            <div class="mb-4 border-b border-gray-400 flex items-center">
              <span class="px-4 pb-4">HTML</span>
              <input type="number" class="mb-4 absolute left-1/3 w-28 border border-gray-400 rounded px-2 py-1" min="0" step="1">
              <button class="mb-4 absolute right-1/3 px-4 py-1 border border-cyan-800 text-cyan-800 rounded hover:bg-gray-100 cursor-pointer mr-2">保存する</button>
              <button class="mb-4 ml-auto mr-4 px-4 py-1 bg-red-500 text-white rounded hover:bg-red-600 cursor-pointer">削除する</button>
            </div>
            <div class="flex items-center">
              <span class="px-4 pb-4">CSS</span>
              <input type="number" class="mb-4 absolute left-1/3 w-28 border border-gray-400 rounded px-2 py-1" min="0" step="1">
              <button class="mb-4 absolute right-1/3 px-4 py-1 border border-cyan-800 text-cyan-800 rounded hover:bg-gray-100 cursor-pointer mr-2">保存する</button>
              <button class="mb-4 ml-auto mr-4 px-4 py-1 bg-red-500 text-white rounded hover:bg-red-600 cursor-pointer">削除する</button>
            </div>
        </div>
    </div>

    <!-- インフラ -->
    <div class="mx-20 mt-10 w-200 border border-gray-400 p-6 rounded">
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-bold mb-6 border-b border-gray-500 pb-2" style="width: 30%;">インフラ</h2>
            <button class="mb-4 bg-cyan-800 text-white px-4 py-2 rounded hover:bg-cyan-900 cursor-pointer">項目を追加する</button>
        </div>
        <div class="border border-gray-400 rounded shadow">
            <div class="mb-4 border-b border-gray-400 p-4 flex justify-between items-center">
                <span>項目名</span>
                <span class="absolute left-1/3">学習時間</span>
            </div>
            <div class="mb-4 border-b border-gray-400 flex items-center">
              <span class="px-4 pb-4">AWS</span>
              <input type="number" class="mb-4 absolute left-1/3 w-28 border border-gray-400 rounded px-2 py-1" min="0" step="1">
              <button class="mb-4 absolute right-1/3 px-4 py-1 border border-cyan-800 text-cyan-800 rounded hover:bg-gray-100 cursor-pointer mr-2">保存する</button>
              <button class="mb-4 ml-auto mr-4 px-4 py-1 bg-red-500 text-white rounded hover:bg-red-600 cursor-pointer">削除する</button>
            </div>
            <div class="mb-4 border-b border-gray-400 flex items-center">
              <span class="px-4 pb-4">GCP</span>
              <input type="number" class="mb-4 absolute left-1/3 w-28 border border-gray-400 rounded px-2 py-1" min="0" step="1">
              <button class="mb-4 absolute right-1/3 px-4 py-1 border border-cyan-800 text-cyan-800 rounded hover:bg-gray-100 cursor-pointer mr-2">保存する</button>
              <button class="mb-4 ml-auto mr-4 px-4 py-1 bg-red-500 text-white rounded hover:bg-red-600 cursor-pointer">削除する</button>
            </div>
            <div class="flex items-center">
              <span class="px-4 pb-4">Heroku</span>
              <input type="number" class="mb-4 absolute left-1/3 w-28 border border-gray-400 rounded px-2 py-1" min="0" step="1">
              <button class="mb-4 absolute right-1/3 px-4 py-1 border border-cyan-800 text-cyan-800 rounded hover:bg-gray-100 cursor-pointer mr-2">保存する</button>
              <button class="mb-4 ml-auto mr-4 px-4 py-1 bg-red-500 text-white rounded hover:bg-red-600 cursor-pointer">削除する</button>
            </div>
        </div>
    </div>

    <!-- footer -->
    <div class="w-full h-10 px-10 mt-12 bg-cyan-800 flex justify-center items-center">
        <div class="text-white text-lg font-normal font-['Roboto']">portfolio site</div>
    </div>

    <!-- ドロップダウンボタンがクリックされた時、表示/非表示を切り替える -->
    <script>
      const dropdownButton = document.getElementById('dropdownDefaultButton');
        const dropdownMenu = document.getElementById('dropdown');

        dropdownButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>