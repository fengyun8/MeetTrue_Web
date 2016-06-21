<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>注册</title>
</head>
<body>
    <form method="POST" action="/auth/register">
    {!! csrf_field() !!}

    <div>
        手机号:
        <input type="text" name="phone" value="请输入手机号">
    </div>

    <div>
        获取验证码:
        <input type="text" name="code" value="手机验证码">
    </div>

    <div>
        密码:
        <input type="password" name="password">
    </div>

    <div>
        <button type="submit">注册</button>
    </div>
</form>
</body>
</html>