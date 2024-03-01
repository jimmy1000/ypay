<?php /*a:1:{s:63:"/www/wwwroot/fttqq.cn/view/index/user/o_auth_account_login.html";i:1655574704;}*/ ?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <title>聚合登录</title>
    <script src="/wwwroot/js/yuancloud.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var url = "<?php echo $url; ?>";
            if (url.length > 0) {
                window.location.href = url + "&t=" + (new Date()).getTime();
            }
        });
    </script>
</head>
<body>
    <div>
        验证成功
    </div>
</body>
</html>
