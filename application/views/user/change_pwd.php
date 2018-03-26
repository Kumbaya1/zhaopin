<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>修改密码</title>
    <base href="<?php echo site_url();?>">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap.css">

    <style>
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
    <form id="form" onsubmit="return false">
        <h3>修改密码</h3>
        <p><span class="detail">*</span><span class="caption">密码：</span><input type="text" class="form-control" v-model='pwd'></p>
        <p><span class="detail">*</span><span class="caption">新密码：</span><input type="text" class="form-control" v-model='newpwd'></p>
        <p><span class="detail">*</span><span class="caption">确认密码：</span><input type="text" class="form-control" v-model='newrepwd'></p>
        <p style="color: red" v-text='errMsg'></p>
        <div id="btn">
            <input type="button" class="btn btn-default" value="重置" @click='resetForm'>
            <button class="btn btn-default" @click='changePwd'>确认</button>
        </div>
    </form>
    <script src="js/jquery-1.12.4.js"></script>
<!--     <script src="js/bootstrap.min.js"></script>-->
    <script src="js/vue.js"></script>
    <script type="text/javascript">
        var vm = new Vue({
            el:'#form',
            data:{
                pwd:'',
                newpwd:'',
                newrepwd:'',
                errMsg:''
            },
            methods:{
                changePwd:function(){
                    var pwd = this.pwd,
                        newpwd = this.newpwd,
                        newrepwd = this.newrepwd,
                        _this = this;
                    this.errMsg = '';
                    if(newpwd == newrepwd && newrepwd != ''){
                        $.post('User/change_pwd_by_id',{pwd:pwd,newpwd:newpwd},function(data){
                            if(data == 'success'){
                                alert('修改密码成功')
                                history.go(0)
                            }else{
                                alert('修改密码失败');
                            }
                        },'text')
                    }else if(newpwd == ''){
                        this.errMsg = '密码不能为空';
                    }else if(newrepwd != newpwd){
                        this.errMsg = '两次密码输入不一致';
                    }
                },
                resetForm:function(){
                     this.pwd ='';
                     this.newpwd ='';
                     this.newrepwd ='';
                     this.errMsg ='';
                }
            }

        })
    </script>
</body>
</html>