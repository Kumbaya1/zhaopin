<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>错误</title>
    <base href="<?php echo site_url();?>">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>


    </style>
</head>
<body>
    <h3>文件上传错误，3s后返回原页面...</h3>
    <script>
        setTimeout(function(){
            location.href = 'User/edit_resume';
        },3000);
    </script>
</body>
</html>