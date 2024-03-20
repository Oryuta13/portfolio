<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            <div class="w-[320px] bg-gray-300 h-[320px] rounded-full overflow-hidden flex items-center justify-center">
                @if(Auth::check())
                    <img src="{{ Auth::user()->avatar }}" alt="User Avatar" class="object-cover w-full h-full rounded-full">
                @endif
            </div>
            <!-- ユーザー名 -->
            <div class="mt-5 ml-28 text-black text-opacity-75 font-bold font-['Roboto']">
                {{ \Illuminate\Support\Facades\Auth::user()->name }}
            </div>
        </div>
        <!-- 自己紹介 -->
        <div class="ml-20 flex flex-col items-start">
            <div class="text-black text-opacity-75 text-4xl font-bold font-['Roboto']">自己紹介</div>
            <div class="mt-2 w-80 h-1 bg-black"></div>
            <div class="mt-5 text-black text-opacity-75 font-normal font-['Roboto'] min-h-[10rem]">
                @if(Auth::check())
                    {{ Auth::user()->introduction }}
                @else
                    ここに自己紹介テキストが入ります。ここに自己紹介テキストが入ります。ここに自己紹介テキストが入ります。ここに自己紹介テキストが入ります。
                @endif
            </div>
            <div class="mt-4">
                <a href="{{ route('profile.edit') }}" class="w-[180px] h-[40px] px-6 py-3 bg-cyan-800 rounded text-white text-sm font-normal font-['Roboto'] hover:bg-cyan-900">
                    自己紹介を編集する
                </a>
            </div>
        </div>
    </div>

    <!-- 学習チャート -->
    <div class="mt-20 flex flex-col items-center justify-center mx-60">
        <div class="text-black text-opacity-75 text-4xl font-bold font-['Roboto']">学習チャート</div>
        <div class="mt-2 w-80 h-1 bg-black"></div>
        <div class="mt-10">
            <!-- 編集ボタン -->
            <a href="{{ route('skills.index') }}" class="mt-20 w-[180px] h-[40px] px-6 py-3 bg-cyan-800 rounded text-white text-sm font-normal font-['Roboto'] hover:bg-cyan-900">
                編集する
            </a>
    </div>
    </div>

    <!-- チャート -->
    <div class="flex justify-center mt-10">
        <canvas id="skillChart"></canvas>
    </div>



    <!-- footer -->
    <div class="w-full h-10 px-10 mt-10 bg-cyan-800 flex justify-center items-center">
        <div class="text-white text-lg font-normal font-['Roboto']">portfolio site</div>
    </div>

    <!-- チャート -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categoryNames = @json($categoryNames);
            const data = @json($data);

            // 学習データの最大値を見つける
            let maxValue = 100; // デフォルトの最大値は100
            Object.values(data).forEach(categoryData => {
                categoryData.forEach(value => {
                    const numericValue = Number(value); // 数値型に変換
                    // もし直近３ヶ月の学習時間の合計で100を超える月があればその月を最大値とする
                    if (numericValue > maxValue) {
                        maxValue = numericValue;
                    }
                });
            });
            console.log(maxValue);

            const datasets = Object.keys(data).map((categoryId, index) => ({
                label: categoryNames[categoryId],
                data: data[categoryId],
                backgroundColor: getColor(index), // 色を取得する関数
            }));

            const ctx = document.getElementById('skillChart').getContext('2d');
            const skillChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['先々月', '先月', '今月'],
                    datasets: datasets
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: maxValue,
                        }
                    }
                }
            });
        });

        function getColor(index) {
            // カテゴリーごとに色を指定
            const colors = [
                'rgba(255, 105, 180, 0.8)',
                'rgba(255, 165, 0, 0.8)',
                'rgba(189, 183, 107, 0.8)',
            ];
            return colors[index % colors.length];
        }
    </script>
</body>
</html>