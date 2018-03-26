<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>公司首页</title>
    <base href="<?php echo site_url();?>">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap.css">

    <style>
        html,body{
            height: 100%;
            overflow: hidden;
        }
        body{
            position: relative;
        }
        header{
            height: 50px;
            background: #014da3;
            line-height: 50px;
            text-align: center;
            -webkit-border-radius: 0 0 15px 15px;
            -moz-border-radius: 0 0 15px 15px;
            border-radius: 0 0 15px 15px;
            position: relative;
        }
        header h3{
            color: #ccc;
            height: 50px;
            line-height: 50px;
            float: left;
            /*display: block;*/
            margin:0 300px;
            width: 15%;
            font-style:oblique;
            font-size: 20px;
        }
        #sidebar{
            margin:50px 0 0 40px;
            width: 150px;
            border: 2px solid #ccc;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
        }
        #user{
            position: absolute;
            right:30px;
            bottom: 2px;
            height: 40px;
            font-size: 13px;
            color: #fff;
        }
        #user a{
            color: #ccc;
            opacity: 0.8;
        }
        #user a:hover{
            opacity: 1;
        }
        .sidebar{
            background: #f5f5f5;
            width: 160px;
            border:2px solid #e3e3e3;
            border-radius:15px;
            padding-top:10px;
            /*margin-top:40px;*/
            /*margin-left:20px;*/
            position: absolute;
            top:100px;
            left:20px;
            bottom:50px;
        }
        .sidebar-content li{
            color: #82878b;
            margin-bottom:10px;
        }
        .sidebar-content{
            /*height: 400px;*/
        }
        .sidebar-content li a{
            padding:8px 8px 10px;
            text-align: center;
            /*color: #84b7d5;*/
            color: #4aa5db;
            border-bottom: 1px solid #bec2c5;
            display: block;
            width: 80%;
            font-size: 14px;
        }
        .sidebar-content li a:hover{
            color: #84b7d5;
        }
        #container{
            width: 600px;
            /*border: 1px solid red;*/
            margin:50px auto;
        }
        h3{
            text-align: center;
        }
    </style>
</head>
<body>
<header>
    <h3>求职、招聘信息网</h3>
    <div id="user">
        <span>hi,<?php echo $en['en_name'] ;?><a href="Enterprise/en_logout">[注销]</a></span>
    </div>
</header>
<div class="sidebar">
    <ul class="sidebar-content">
        <li><a href="Enterprise/index">Welcome</a></li>
        <li><a href="Enterprise/publishinfor">发布信息</a></li>
        <li><a href="Enterprise/alerts">消息通知</a></li>
        <li><a href="Enterprise/changepwd">修改密码</a></li>
        <li><a href="Enterprise/websitesign">网站公告</a></li>
    </ul>
</div>
<div id="container">
    <h3 >公司信息</h3>
    <ul>
        <li class="list-group-item">公司名称：<?php echo $en['en_name'] ;?></li>
        <li class="list-group-item">公司性质：<?php echo $en['nature'] ;?></li>
        <li class="list-group-item">公司所属行业：<?php echo $en['industry'] ;?></li>
        <li class="list-group-item">公司地址：<?php echo $en['prov'].'省'.$en['city'].'市' ;?></li>
        <li class="list-group-item">联系电话：<?php echo $en['tel'] ;?></li>
        <li class="list-group-item">联系人：<?php echo $en['contacter'].'('.$en['sex'].')' ;?></li>
        <li class="list-group-item">电子邮箱：<?php echo $en['email'] ;?></li>
        <li class="list-group-item">企业介绍：<?php echo $en['introduction'] ;?></li>
    </ul>
</div>
</body>
</html>