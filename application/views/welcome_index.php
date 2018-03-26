<!DOCTYPE html>
<html>
<head>
    <title>网站主页</title>
    <meta charset="utf-8">
    <base href="<?php echo site_url();?>">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <style type="text/css">
        header{
            height: 50px;
            background: #014da3;
            line-height: 50px;
            text-align: center;
            font-size: 20px;
            -webkit-border-radius: 0 0 15px 15px;
            -moz-border-radius: 0 0 15px 15px;
            border-radius: 0 0 15px 15px;
        }
        header h3{
            color: #ccc;
            height: 50px;
            line-height: 50px;
            float: left;
            /*display: block;*/
            margin:0 300px;
            width: 200px;
            font-style:oblique;
        }
        header a{
            font-size: 12px;
            padding: 6px 10px;
            background: #fdd100;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
            color: #961c04;
            font-weight: bold;
        }
        header a:hover{
            opacity: 0.9;
        }
        #title{
            margin-top:10px;
            height: 60px;
        }
        #title h4{
            display:inline;
            font-size: 18px;
            color: #0053a1;
            font-style:oblique;
            line-height: 60px;
        }
        #title span{
            color:#6fabe6;
            font-style:oblique;
            line-height: 60px;
        }
        #left-title{
            float: left;
            height: 60px;
            width: 60%;
            text-align: center;
        }
        #title-img{
            text-align: right;
            float: left;
            padding-left:80px;
        }
        #container{
            /*width: 840px;*/
            margin-left:20px;
            position: relative;
            /*overflow: hidden;*/
        }
        #prev,#next{
            position: absolute;
            top:50%;
            font-size: 20px;
            padding:0 20px;
            color: #fff;
            cursor: pointer;
        }
        #prev:hover,#next:hover{
            color: #ccc;
        }
        #prev{
            left:0;
        }
        #next{
            right:0;
        }
        #left-img{
            /*clear: both;*/
            border: 3px solid #e3f0fa;
        }
        #left-img img{
            width: 100%;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
        }
        #left-logo{
            float: left;
            position: relative;
            clear: both;
            width: 840px;
        }
        #login-box{
            float: left;
            /*background: #ccc;*/
            width: 300px;
            text-align: center;
            border: 1px solid #cdcad3;
            margin:50px 0 0 40px;
            padding-bottom:50px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            position: relative;
        }
        #login-box ul{
            height: 40px;
            margin-bottom:30px;
        }
        #login-box li{
            background: #cbd5eb;
            float: left;
            width: 50%;
            height: 40px;
            background: #fff;
            color: #446495;
            cursor: pointer;
            text-align: center;
            line-height: 40px;
            font-size: 14px;
        }
        #login-box p{
            margin:0 auto 14px;
            width: 85%;
        }
        #login-box button{
            width: 60%;
            margin:0 auto;
        }
        #login-box .tab-selected{
            background: #ccc;
        }
        .modal-body input{
            width:180px;
            height:30px;
            margin-top:10px;
        }
        .modal-body{
            text-align: center;
        }
        #admin-login{
            position: absolute;
            right:10px;
            bottom: 10px;
        }
        #error-msg{
            position: absolute;
            bottom: 5px;
            text-align: center;
            color: red;
            width: 100%;
        }




    </style>
</head>
<body>
<div id="app">
    <header>
        <h3>求职、招聘信息网</h3>
        <span><a href="enterprise/regist">企业注册</a></span>
        <span><a href="javascript:;" @click="enterpriseLogin">企业登陆</a></span>
    </header>
    <div id="title">
        <div id="left-title">
            <h4>好工作，</h4><span>从一份简历开始！</span>
        </div>
        <div id="title-img">
            <img src="images/lc.jpg" alt="">
        </div>
    </div>
    <div id="container">
        <div id="left-logo">
            <div id="left-img">
                <img id="carousel-img" src="images/loop1.png" >
            </div>
            <!--<div id="img-btn">-->
            <!--<span id="prev" @click="prevImg"><</span>-->
            <!--<span id="next" @click="nextImg">></span>-->
            <!--</div>-->
        </div>
        <div id="login-box">
            <ul>
                <li id="reg-tab" @click="showUserLogin" v-bind:class="{'tab-selected':isShow}">新用户注册</li>
                <li id="login-tab" @click="showUserRegist" v-bind:class="{'tab-selected':!isShow}">老用户登录</li>
            </ul>
            <div id="regist-box" v-show="!isShow">
                <p>
                    <input type="text" class="form-control" placeholder="帐号" v-model='newUserName'>
                </p>
                <p>
                    <input type="password" class="form-control" placeholder="密码" v-model='newPassWord'>
                </p>
                <p>
                    <input type="password" class="form-control" placeholder="确认密码" v-model='newrePassWord'>
                </p><br>
                <button  class="btn btn-warning" @click='registUser'>立即注册</button>
            </div>
            <div id="log-box" v-show="isShow">
                <p>
                    <input type="text" class="form-control" placeholder="帐号" v-model='userName'>
                </p>
                <p>
                    <input type="password" class="form-control" placeholder="密码" v-model='passWord'>
                </p>

                <button  class="btn btn-warning" @click='userLogin'>登录</button>
            </div>
            <div id="error-msg" v-text='errorMsg'>
    
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">企业登陆</h4>
                </div>
                <div class="modal-body">
                    <label>企业帐号：
                        <input type="text" class="form-control" placeholder="帐号" v-model='e_name'>
                    </label><br>
                    <label>登录密码：
                        <input type="password" class="form-control" placeholder="密码" v-model='e_pwd'>
                    </label>
                    <p style="color: red" v-text='en_errMsg'></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" @click='en_login'>登录</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="adminModal" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">管理员登陆</h4>
                </div>
                <div class="modal-body">
                    <label>管理员帐号：
                        <input type="text" class="form-control" placeholder="帐号" v-model='admin_name'>
                    </label><br>
                    <label>登录密码：
                        <input type="password" class="form-control" placeholder="密码" v-model='admin_pwd'>
                    </label>
                    <p v-text='adminErrMsg' style='color: red'></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" @click='adminLogin'>登录</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div id="admin-login">
        <a href="javascript:;" @click="adminLoginShow">管理员登录</a>
    </div>
</div>

<script src="js/jquery-1.12.4.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/vue.js"></script>
<script>
    var vm = new Vue({
        el:'#app',
        data:{
            isShow:false,
            imgNum:2,
            newUserName:'',
            newPassWord:'',
            newrePassWord:'',
            errorMsg:'',
            userName:'',
            passWord:'',
            e_name:'',
            e_pwd:'',
            en_errMsg:'',
            admin_name:'',
            admin_pwd:'',
            adminErrMsg:''
        },
        methods:{
            changeShow:function(){
                this.isShow = !this.isShow;
            },
            enterpriseLogin:function(){
                $('#myModal').modal('toggle');
            },
            adminLoginShow:function(){
                $('#adminModal').modal('show');
            },
            registUser:function(){
                var username = this.newUserName,
                    pwd = this.newPassWord,
                    repwd = this.newrePassWord,
                    _this = this;
                this.errorMsg = '';
                if(pwd != repwd ){
                    this.errorMsg ='两次密码不一致！';
                }else if( username == ''){
                    this.errorMsg ='用户名不能为空！';
                }else if( pwd == ''){
                    this.errorMsg ='密码不能为空！';
                }else{
                    $.post('User/regist',{username:username,pwd:pwd},function(data){
                        if(data == 'exist'){
                            _this.errorMsg ='当前帐号已存在！';
                        }else if(data == 'success'){
                            location.href='User/edit_resume';
                        }else{
                            alert('失败,请重试！');
                        }
                    },'text');
                }
            },
            userLogin:function(){
                var _this = this;
                $.post('User/check_user',{username:this.userName,pwd:this.passWord},function(data){
                    if(data == 'success'){
                        location.href='User/index';
                    }else{
                        _this.errorMsg ='输入错误，请重试';
                    }
                },'text');
            },
            en_login:function(){
                var _this = this;
                $.post('enterprise/check_en',{
                    e_name:this.e_name,
                    e_pwd:this.e_pwd
                },function(data){
                    if(data == 'fail'){
                        _this.en_errMsg = '帐号或密码错误，请重试';
                    }else if(data == 'success'){
                        location.href='Enterprise/index';
                    }
                },'text');

            },
            adminLogin:function(){
                var name = this.admin_name,
                    pwd = this.admin_pwd,
                    _this = this;
                this.adminErrMsg = '';
                if(name ==''){
                    this.adminErrMsg='帐号不能为空';
                }else if(pwd == ''){
                    this.adminErrMsg='密码不能为空';
                }else{
                    $.post('Admin/check_admin',{
                        name:name,
                        pwd:pwd
                    },function(data){
                        if(data == 'fail'){
                            _this.adminErrMsg = '帐号或密码错误！';
                        }else if(data == 'success'){
                            location.href='Admin/index';
                        }
                    },'text');
                }
            },
            showUserLogin:function(){
                this.isShow=false;
                this.errorMsg ='';
            },
            showUserRegist:function(){
                this.isShow=true;
                this.errorMsg ='';
            }
        }
    })
    $(function(){
        var imgNum = 2,firstImg=1;
        var timer = setInterval(function(){
            firstImg++;
            if(firstImg > imgNum){
                firstImg=1;
            }
            $('#carousel-img')[0].src = 'images/loop'+firstImg+'.png';
        },5000)
    })
</script>
</body>
</html>