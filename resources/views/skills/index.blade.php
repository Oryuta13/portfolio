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
    <div class="w-full h-[120px] px-10 bg-custom-blue flex justify-between items-center">
        <div class="text-white text-3xl font-bold font-['Roboto']">My Portfolio</div>
        <form action="{{ route('user.logout') }}" method="POST">
            @csrf
            <button type="submit" class="px-10 py-4 bg-white rounded flex justify-center items-center text-black text-lg font-normal font-['Roboto'] hover:bg-gray-200">ログアウト</button>
        </form>
    </div>

    <!-- ドロップダウンボタン -->
    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-black bg-white hover:bg-gray-100 font-bold text-sm px-4 py-2 text-center inline-flex items-center shadow rounded mx-60 mt-10" type="button">
    {{ $selectedMonth ? $selectedMonth : $currentMonth }} <svg class="w-2 h-2 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
    </svg>
    </button>

    <!-- ドロップダウンメニュー -->
    <div style="position: relative;">
        <div id="dropdown" class="z-10 hidden mx-60 bg-white divide-y divide-gray-200 shadow-md rounded" style="position: absolute; width: fit-content;">
            <ul class="py-2 text-sm text-black" aria-labelledby="dropdownDefaultButton">
            @foreach ($months as $month)
            <li>
                <a href="{{ route('skills.index', ['month' => $month]) }}" class="block pl-4 pr-8 py-2 hover:bg-gray-100">{{ $month }}</a>
            </li>
            @endforeach
            </ul>
        </div>
    </div>

    <!-- バックエンド -->
    <div class="skill-section mx-60 mt-10 w-200 border border-gray-400 p-6 rounded">
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-bold mb-6 border-b-2 border-gray-500 pb-2" style="width: 240px;">バックエンド</h2>
            <button onclick="location.href='{{ route('skills.create', ['category' => 1, 'month' => $selectedMonth]) }}'" class="mb-4 bg-custom-blue text-white px-10 py-4 rounded hover:bg-cyan-900 cursor-pointer">項目を追加する</button>
        </div>
        <div class="border border-gray-100 rounded shadow">
            <div class="border-b border-gray-300 p-4 flex justify-between items-center">
                <span class="ml-4 w-1/4">項目名</span>
                <span class="flex-grow">学習時間</span>
            </div>
            <div class="overflow-auto max-h-[201px]">
                @if(isset($groupedLearningData[1]))
                    @foreach($groupedLearningData[1] as $data)
                        <div class="skill-item flex items-center border-b border-gray-300 p-4">
                            <span class="ml-4 w-1/4">{{ $data->contents }}</span>
                            <form action="{{ route('skills.update', $data->id) }}" method="POST" class="flex-grow">
                                @csrf
                                @method('PUT')
                                <div class="flex items-center space-x-44">
                                    <input type="number" name="study_time" class="w-50 border border-gray-400 rounded px-2 py-1" min="0" step="1" value="{{ $data->study_time }}">
                                    <button class="px-4 py-1 border border-custom-blue text-custom-blue rounded hover:bg-gray-200 cursor-pointer">学習時間を保存する</button>
                                </div>
                            </form>
                            <form action="{{ route('skills.destroy', $data->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="px-4 py-1 bg-custom-red text-white rounded hover:bg-red-600 cursor-pointer">削除する</button>
                            </form>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>


    <!-- フロントエンド -->
    <div class="skill-section mx-60 mt-10 w-200 border border-gray-400 p-6 rounded">
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-bold mb-6 border-b-2 border-gray-500 pb-2" style="width: 240px;">フロントエンド</h2>
            <button onclick="location.href='{{ route('skills.create', ['category' => 2, 'month' => $selectedMonth]) }}'" class="mb-4 bg-custom-blue text-white px-10 py-4 rounded hover:bg-cyan-900 cursor-pointer">項目を追加する</button>
        </div>
        <div class="border border-gray-100 rounded shadow">
            <div class="border-b border-gray-300 p-4 flex justify-between items-center">
                <span class="ml-4 w-1/4">項目名</span>
                <span class="flex-grow">学習時間</span>
            </div>
            <div class="overflow-auto max-h-[201px]">
                @if(isset($groupedLearningData[2]))
                    @foreach($groupedLearningData[2] as $data)
                        <div class="skill-item flex items-center border-b border-gray-300 p-4">
                            <span class="ml-4 w-1/4">{{ $data->contents }}</span>
                            <form action="{{ route('skills.update', $data->id) }}" method="POST" class="flex-grow">
                                @csrf
                                @method('PUT')
                                <div class="flex items-center space-x-44">
                                    <input type="number" name="study_time" class="w-50 border border-gray-400 rounded px-2 py-1" min="0" step="1" value="{{ $data->study_time }}">
                                    <button class="px-4 py-1 border border-custom-blue text-custom-blue rounded hover:bg-gray-200 cursor-pointer">学習時間を保存する</button>
                                </div>
                            </form>
                            <form action="{{ route('skills.destroy', $data->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="px-4 py-1 bg-custom-red text-white rounded hover:bg-red-600 cursor-pointer">削除する</button>
                            </form>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <!-- インフラ -->
    <div class="skill-section mx-60 mt-10 w-200 border border-gray-400 p-6 rounded">
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-bold mb-6 border-b-2 border-gray-500 pb-2" style="width: 240px;">インフラ</h2>
            <button onclick="location.href='{{ route('skills.create', ['category' => 3, 'month' => $selectedMonth]) }}'" class="mb-4 bg-custom-blue text-white px-10 py-4 rounded hover:bg-cyan-900 cursor-pointer">項目を追加する</button>
        </div>
        <div class="border border-gray-100 rounded shadow">
            <div class="border-b border-gray-300 p-4 flex justify-between items-center">
                <span class="ml-4 w-1/4">項目名</span>
                <span class="flex-grow">学習時間</span>
            </div>
            <div class="overflow-auto max-h-[201px]">
                @if(isset($groupedLearningData[3]))
                    @foreach($groupedLearningData[3] as $data)
                        <div class="skill-item flex items-center border-b border-gray-300 p-4">
                            <span class="ml-4 w-1/4">{{ $data->contents }}</span>
                            <form action="{{ route('skills.update', $data->id) }}" method="POST" class="flex-grow">
                                @csrf
                                @method('PUT')
                                <div class="flex items-center space-x-44">
                                    <input type="number" name="study_time" class="w-50 border border-gray-400 rounded px-2 py-1" min="0" step="1" value="{{ $data->study_time }}">
                                    <button class="px-4 py-1 border border-custom-blue text-custom-blue rounded hover:bg-gray-200 cursor-pointer">学習時間を保存する</button>
                                </div>
                            </form>
                            <form action="{{ route('skills.destroy', $data->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="px-4 py-1 bg-custom-red text-white rounded hover:bg-red-600 cursor-pointer">削除する</button>
                            </form>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    @if(session('successMessage'))
        <!-- モーダルの背景 -->
        <div id="modalBackground" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" onclick="closeModal()"></div>
        <!-- モーダルコンテンツ -->
        <div class="bg-white shadow p-5 w-full max-w-md mx-auto absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <div class="text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ session('successMessage') }}
                </h3>
                <div class="mt-8 mb-4">
                    <button id="okBtn" onclick="window.location='{{ route('skills.index', ['month' => session('redirectMonth', $currentMonth)]) }}'" class="px-10 py-4 bg-custom-blue hover:bg-custom-blue text-white text-sm font-normal rounded-md shadow-sm focus:outline-none">
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

    <!-- footer -->
    <div class="w-full h-[40px] px-10 mt-20 bg-custom-blue flex justify-center items-center">
        @auth
            <div class="text-white text-lg font-normal font-['Roboto']">{{ Auth::user()->name }}</div>
        @else
            <div class="text-white text-lg font-normal font-['Roboto']">portfolio site</div>
        @endauth
    </div>

    <!-- ドロップダウンボタンがクリックされた時、表示/非表示を切り替える -->
    <script>
      const dropdownButton = document.getElementById('dropdownDefaultButton');
        const dropdownMenu = document.getElementById('dropdown');

        dropdownButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.skill-section').forEach(section => {
                // 各セクション内の項目数を確認
                if (section.querySelectorAll('.skill-item').length > 3) {
                    section.querySelector('.overflow-auto').classList.add('scrollable');
                } else {
                    section.querySelector('.overflow-auto').classList.remove('scrollable');
                }
            });
        });
    </script>
</body>
</html>