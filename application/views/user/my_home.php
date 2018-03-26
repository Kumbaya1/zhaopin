<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>个人主页</title>
    <base href="<?php echo site_url();?>">
    <link rel="stylesheet" href="css/reset.css">
    <style type="text/css">
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
        header ul{
            float: left;
            padding-left:6%;
            height: 50px;
        }
        header ul li{
            float: left;
            width: 80px;
        }
        header li a{
            color: #fff;
            display: block;
            width: 100%;
            height:100%;
            font-size: 14px;
        }
        header li a:hover{
            color: #014da3;
        }
        header ul li:hover{
            background: #fff;
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
        .wrap{
            width: 1024px;
            /*border: 1px solid red;*/
            margin:50px auto;
        }
        #left-page,#right-page{
            width: 50%;
            float: left;
            border: 2px solid #ccc;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            -webkit-box-shadow: 5px 5px 2px 6px #ccc;
            /*-moz-box-shadow: 5px 5px 5px 10px #ccc;*/
            /*box-shadow: 5px 5px 5px 10px #ccc;*/
            height: 400px;
        }
        #left-page{
            padding:50px;

        }
        #left-page p{
            margin-bottom: 30px;
            font-size: 16px;
            color: #333;
        }
        #my-name{
            font-size: 24px;
            color: #151515;
            padding-right:40px;
        }
        #sex,#age{
            font-size: 16px;
            color: rgb(85, 85, 85);
            padding-right:40px;
        }
        #address{
            padding-top:50px;
        }
        #right-page h3{
            text-align: center;
            padding:10px 0;
            font-size: 22px;
            font-weight: normal;
        }
        #img{
            height:100px;
            width: 100px;
            margin:30px auto;
        }
        #img img{
            width: 100%;
            height: 100%;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
        }
        #introduction p{
            width: 80%;
            margin: 30px auto 0;
            text-indent: 2em;
            font-size: 15px;
        }
    </style>
</head>
<body>
    <header>
        <h3>求职、招聘信息网</h3>
        <ul>
            <li><a href="User/index">首页</a></li>
            <li><a href="User/edit_resume">编辑简历</a></li>
            <li><a href="User/re_infor">招聘信息</a></li>
            <li><a href="User/change_pwd">修改密码</a></li>
        </ul>
        <div id="user">
            <span>hi,<?php echo $user['true_name'];?><a href="User/user_logout">[注销]</a></span>
        </div>
    </header>
    <div class="wrap">
        <div id="left-page">
            <p>
                <span id="my-name"><?php echo $user['true_name']?$user['true_name']:'真实姓名未填';?></span>
                <span id='sex'><?php echo $user['sex']?$user['sex']:'性别未填';?></span>
                <span id="age"><?php echo $user['age']?$user['age']:'年龄未填';?></span>
            </p>
            <p id="address">地址：<?php echo $user['prov']?$user['prov']:'地址未填';?></p>
            <p>手机：<?php echo $user['tel']?$user['tel']:'电话未填';?></p>
            <p>邮箱：<?php echo $user['email']?$user['email']:'邮箱未填';?></p>
        </div>
        <div id="right-page">
            <h3>我的简历</h3>
            <div id="img">
                <img src="images/header/<?php echo $user['photo']?$user['photo']:'default_user.png';?>" alt="">
            </div>
            <div id="introduction">
                <h3>个人简介</h3>
                <p>
                    <?php echo $user['introduction']?$user['introduction']:'个人简介未填写';?>
                </p>
            </div>
        </div>
    </div>
</body>
</html>