<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>自己紹介編集</title>
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

    <div class="mt-20 text-center text-black text-3xl font-normal font-['Roboto']">自己紹介を編集する</div>

    <!-- フォーム -->
    <div class="flex flex-col items-center justify-center mx-auto mt-20 gap-12 max-2-screen-lg">
        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- 自己紹介文 -->
            <div class="h-[145px] flex-col justify-start items-start gap-[3px] flex">
                <div class="self-stretch h-[122px] flex-col justify-start items-start gap-[7px] flex">
                    <div class="justify-start items-center gap-2.5 inline-flex">
                        <div class="text-gray-500 text-xs font-normal font-['Roboto'] leading-3 tracking-tight">自己紹介文</div>
                    </div>
                    <div class="self-stretch h-[95px] flex-col justify-start items-center flex">
                        <!-- テキストエリアに自己紹介を表示 -->
                        <textarea name="introduction" id="introduction" rows="5" class="self-stretch text-black text-opacity-90 text-lg font-normal font-['Roboto'] leading-[19px] tracking-tight">{{ old('introduction', $user->introduction) }}</textarea>
                    </div>
                    <div class="w-[480px] h-px pt-px justify-center items-center inline-flex">
                        <div class="w-[480px] border-b border-gray-700"></div>
                    </div>
                </div>
                <div class="justify-start items-center gap-2.5 inline-flex">
                    <div class="mt-2 text-gray-500 text-xs font-normal font-['Roboto'] leading-3 tracking-tight">50文字以上、200文字以下で入力してください</div>
                </div>
                <!-- バリデーションメッセージ -->
                @error('introduction')
                    <div class="h-5 flex-col justify-start items-center gap-2.5 flex">
                        <div class="text-red-600 font-normal text-xs font-['Roboto'] leading-tight tracking-wide">{{ $message }}</div>
                    </div>
                @enderror
            </div>

            <!-- アバター画像 -->
            <div class="mt-8 h-12 flex-col justify-start items-start gap-2.5 flex">
                <div class="self-stretch h-12 flex-col justify-start items-start gap-[3px] flex">
                    <div class="pr-[278px] mt-5 flex-col justify-center items-start gap-1 flex">
                        <div class="self-stretch justify-start items-center gap-2.5 inline-flex">
                            <div class="text-black text-opacity-50 text-xs font-normal font-['Roboto'] leading-3 tracking-tight">アバター画像</div>
                        </div>
                        <div class="self-stretch px-6 py-2 bg-black bg-opacity-10 rounded justify-center items-center inline-flex cursor-pointer hover:bg-gray-300 relative">
                            <!-- ファイル選択ボタン -->
                            <input type="file" name="avatar" id="avatar" class="absolute top-0 left-0 w-full h-full opacity-0 cursor-pointer" onchange="updateFileName(this)" />
                            <label for="avatar" class="cursor-pointer text-black text-opacity-75 text-sm font-normal font-['Roboto'] hover:bg-gray-200">画像ファイルを添付する</label>
                        </div>
                    </div>
                    <!-- ファイル名表示 -->
                    <div class="file-name-container">
                        @if ($user->avatar)
                            <span class="text-black text-opacity-75 text-sm font-normal font-['Roboto']">{{ basename($user->avatar) }}</span>
                        @endif
                    </div>
                    <!-- バリデーションメッセージ -->
                    @error('avatar')
                        <div class="text-red-600 text-xs font-normal font-['Roboto'] leading-tight tracking-wide">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <script>
                // ファイル選択時にファイル名を表示する関数
                function updateFileName(input) {
                    const fileNameContainer = input.closest('.mt-4').querySelector('.file-name-container').querySelector('span');
                    const fileNamePlaceholder = document.getElementById('fileNamePlaceholder');

                    if (input.files.length > 0) {
                        fileNameContainer.textContent = input.files[0].name;
                    } else {
                        fileNameContainer.textContent = 'ファイルが選択されていません';
                    }
                }
            </script>

            <!-- 確定ボタン -->
            <div class="mt-24 ml-24 bg-custom-blue rounded justify-center items-center inline-flex cursor-pointer hover:bg-cyan-900">
                <button type="submit" class="px-20 py-4 text-white text-lg font-normal font-['Roboto']">自己紹介を確定する</button>
            </div>
        </form>
    </div>
    <!-- footer -->
    <div class="w-full h-[40px] px-10 mt-20 bg-custom-blue flex justify-center items-center">
        <div class="text-white text-lg font-normal font-['Roboto']">portfolio site</div>
    </div>
</body>
</html>