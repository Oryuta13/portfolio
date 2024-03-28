<!doctype html>
<html lang="en" class="flex flex-col min-h-screen">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>項目追加</title>
</head>
<body class="flex flex-col min-h-screen">
    <!-- ヘッダー -->
    <div class="w-full h-[120px] px-10 bg-custom-blue flex justify-between items-center">
        <div class="text-white text-3xl font-bold font-['Roboto']">My Portfolio</div>
        <form action="{{ route('user.logout') }}" method="POST">
            @csrf
            <button type="submit" class="px-10 py-4 bg-white rounded flex justify-center items-center text-black text-lg font-normal font-['Roboto'] hover:bg-gray-200">ログアウト</button>
        </form>
    </div>

    <!-- メインコンテンツ -->
    <div class="flex-grow">

    <!-- タイトル -->
    <div class="mt-20 mx-auto text-center text-3xl">{{ $categoryName }}に項目を追加</div>

    <!-- フォーム -->
    <form action="{{ route('skills.store') }}" method="post" class="mx-auto max-w-screen-lg" novalidate>
        @csrf
        <div class="w-96 mx-auto py-4 mt-20">
            <label for="contents" class="block text-sm font-normal text-gray-500">項目名</label>
            <input type="text" name="contents" id="contents" class="mt-1 border-b border-gray-500 focus:outline-none focus:border-gray-500 w-full">
            <!-- バリデーションメッセージ -->
            @if ($errors->has('contents'))
                <p class="text-red-600 text-xs mt-2">{{ $errors->first('contents') }}</p>
            @endif
        </div>
        <div class="w-96 mx-auto mt-8">
            <label for="study_time" class="block text-sm font-normal text-gray-500">学習時間</label>
            <input type="number" name="study_time" id="study_time" class="mt-1 border-b border-gray-500 focus:outline-none focus:border-gray-500 w-full" required min="0">
            <!-- バリデーションメッセージ -->
            @if ($errors->has('study_time'))
                <p class="text-red-600 text-xs mt-2">{{ $errors->first('study_time') }}</p>
            @endif
        </div>
        <div class="w-96 mx-auto mt-2">
            <div class="text-sm font-xs text-gray-500">分単位で入力してください</div>
        </div>
        <!-- 隠しフィールドでカテゴリーIDを送信 -->
        <input type="hidden" name="category_id" value="{{ $category }}">
        <!-- 隠しフィールドで選択された月を送信 -->
        <input type="hidden" name="study_date" value="{{ $selectedMonth }}">

        <!-- ボタン -->
        <div class="text-center mt-20 mb-20">
            <button type="submit" class="bg-custom-blue hover:bg-cyan-900 text-white font-normal py-4 px-20 rounded">追加する</button>
        </div>
    </form>

    @if(session('successMessage'))
        <!-- モーダルの背景 -->
        <div id="modalBackground" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" onclick="closeModal()"></div>
        <!-- モーダルコンテンツ -->
        <div class="bg-white shadow p-5 w-full max-w-md mx-auto absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <div class="text-center">
                <h3 class="text-lg leading-6 font-normal text-gray-900">
                    {{ session('successMessage') }}
                </h3>
                <div class="mt-8 mb-4">
                    <button id="okBtn" onclick="window.location='{{ route('skills.index', ['month' => session('redirectMonth', now()->format('n月'))]) }}'" class="px-10 py-4 bg-custom-blue hover:bg-custom-blue text-white text-sm font-normal rounded-md shadow-sm focus:outline-none">
                        編集ページに戻る
                    </button>
                </div>
            </div>
        </div>
    @endif
    <script>
    if (document.getElementById("successModal")) {
      // モーダル表示のためのコード
      var modal = document.getElementById("successModal");
      modal.style.display = "block";
      }
    </script>
    </div>
    <!-- footer -->
    <div class="w-full h-[40px] px-10 mt-auto bg-custom-blue flex justify-center items-center">
        <div class="text-white text-lg font-normal font-['Roboto']">portfolio site</div>
    </div>
    </body>
</html>