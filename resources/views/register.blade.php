<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新規登録</title>
</head>
<body>
    <h1>新規登録</h1>
    <form action="" method="post">
        @csrf
        <label for="name">氏名</label>
        <input type="text" name="name" id="name">
        <label for="email">メールアドレス</label>
        <input type="email" name="email" id="email">
        <label for="password">パスワード</label>
        <input type="password" name="password" id="password">
        <button type="submit">登録する</button>
    </form>
</body>
</html>