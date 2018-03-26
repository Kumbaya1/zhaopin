<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>修改密码</title>
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
        #form{
            width: 500px;
            /*height: 500px;*/
            padding:20px 0 60px;
            margin: 130px auto;
            border: 1px solid #ccc;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            text-align: center;
        }
        .caption{
            display: inline-block;
            width: 80px;
            text-align: right;
        }
        .detail{
            color: red;
            padding:0 8px;
        }
        .form-control{
            width: 200px;
            display: inline;
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
    <form id="form" onsubmit="return false">
        <h3>修改密码</h3>
        <p><span class="detail">*</span><span class="caption">密码：</span><input type="password" class="form-control" v-model='pwd'></p>
        <p><span class="detail">*</span><span class="caption">新密码：</span><input type="password" class="form-control" v-model='newpwd'></p>
        <p><span class="detail">*</span><span class="caption">确认密码：</span><input type="password" class="form-control" v-model='renewpwd'></p>
        <div id="btn">
            <input type="button" class="btn btn-default" value="重置" @click='resetInput'>
            <button class="btn btn-default" @click='changePwD'>确认</button>
        </div>
        <p v-text='errMsg' style="color: red"></p>
    </form>
    <script src="js/jquery-1.12.4.js"></script>
    <script src="js/vue.js"></script>
    <script>
        var vm = new Vue({
            el:'#form',
            data:{
                pwd:'',
                newpwd:'',
                renewpwd:'',
                errMsg:''
            },
            methods:{
                changePwD:function(){
                    this.errMsg ='';
                    var _this = this,
                        pwd = this.pwd,
                        newpwd =this.newpwd,
                        renewpwd = this.renewpwd;
                    if(pwd == ''){
                        this.errMsg = '请输入密码!!!';
                    }else if(newpwd == ''){
                        this.errMsg = '请输入新密码!!!';
                    }else if(newpwd != renewpwd){
                        this.errMsg = '两次输入密码不一致!!!';
                    }else{
                        $.post('Enterprise/changepwd_en',{
                            pwd:pwd,
                            newpwd:newpwd
                        },function(data){
                            if(data == 'fail'){
                                _this.errMsg = '原密码输入错误!';
                            }else if(data == 'success'){
                                alert('修改密码成功!')
                                history.go(0);
                            }else if(data == 'none'){
                                _this.errMsg = '不能与之前设置的密码相同!';
                            }
                        },'text')
                    }
                },
                resetInput:function(){
                    this.pwd ='';
                    this.newpwd ='';
                    this.renewpwd ='';
                }
            }
        })

    </script>
</body>
</html>