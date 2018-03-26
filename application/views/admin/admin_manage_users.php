<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>查看用户</title>
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
        #search{
            margin:20px auto;
            width: 300px;
        }
        #search .form-control{
            width: 210px;
            float: left;
            margin-right:5px;
        }
        #infor-list{
            width: 750px;
            border: 1px solid #ccc;
            margin:20px auto;
            padding:20px 10px;
            text-align: center;
        }
        #infor-list th{
            text-align: center;
        }
        #infor-list td{
            height: 48px;
            padding-bottom: 0;
        }
        #infor-list .title a{
            display: block;
            overflow: hidden;
            text-overflow:ellipsis;
            white-space: nowrap;
            /*width:500px;*/
        }
        .head-img{
            width:45px;
            /*display: inline-block;*/
            overflow: hidden;
        }
        .head-img img{
            width: 100%;
        }
    </style>
</head>
<body>
<header>
    <h3>求职、招聘信息网</h3>
    <div id="user">
        <span>hi,管理员大大 <a href="Admin/logout">[注销]</a></span>
    </div>
</header>
<div class="sidebar">
    <ul class="sidebar-content">
        <li><a href="Admin/index">Welcome</a></li>
        <li><a href="Admin/manage_user">查看用户</a></li>
        <li><a href="Admin/manage_en">查看企业</a></li>
        <li><a href="Admin/manage_msg">查看招聘</a></li>
        <li><a href="Admin/changepwd">修改密码</a></li>
        <li><a href="Admin/manage_sign">公告管理</a></li>
    </ul>
</div>
<div id="app">
    <div id="search">
        <input type="text" class="form-control" placeholder="输入用户姓名" v-model='userNameStr'>
        <button class="btn btn-primary" @click='searchUser'>搜索用户</button>
    </div>
    <div id="infor-list">
        <table  class="table table-striped">
            <tr>
                <th class="head-img">头像</th>
                <th class="name">用户姓名</th>
                <th class="tel">tel</th>
                <th class="address">地址</th>
                <th class="date">年龄</th>
                <th class="operation">详细</th>
            </tr>
            <tr v-for='obj in showList'>
                <td class="head-img"><img :src="`images/header/${obj.photo?obj.photo:'default_user.png'}`" alt=""></td>
                <td class="name" v-text='obj.true_name'>张三</td>
                <td class="tel" v-text='obj.tel'>1XXXXXXXXXX</td>
                <td class="address">{{obj.prov}}省{{obj.city}}市</td>
                <td class="date" v-text='obj.age'></td>
                <td class="operation"><button @click='showUserModal(obj)'>查看</button></td>
            </tr>
        </table>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="userModal" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">用户信息</h4>
                </div>
                <div class="modal-body" style='text-align: left;'>
                        <ul>
                            <li>头像：<img :src="`images/header/${userObj.photo?userObj.photo:'default_user.png'}`" style='width:40px;'></li>
                            <li>姓名：<span v-text='userObj.true_name'></span></li>
                            <li>年龄：<span v-text='userObj.age'></span></li>
                            <li>电话：<span v-text='userObj.tel'></span></li>
                            <li>邮箱：<span v-text='userObj.email'></span></li>
                            <li>地址：<span >{{userObj.prov}}省{{userObj.city}}市</span></li>
                            <li>个人简介：<span v-text='userObj.introduction'></span></li>
                        </ul>        
                        <h3 style='text-align: center;'>工作经验</h3>
                        <div>
                            <ul>
                            <li v-for='(exp,index) in userExp'>
                                <h4 v-text='index+1'></h4>
                               内容：<span v-text='exp.content'></span><br>
                               开始时间:<span v-text='exp.start_date'></span><br>
                               结束时间:<span v-text='exp.end_date'></span><br>
                            </li>
                        </ul>
                        </div>
                        
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" @click='delUser'>注销用户</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

<script src="js/jquery-1.12.4.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/vue.js"></script>
<script>
    var vm = new Vue({
        el:'#app',
        data:{
            showList:[],
            AllList:[],
            userObj:{},
            userExp:{},
            userNameStr:''
        },
        created:function(){
            var _this = this;
            $.get('Admin/get_user',function(data){
                _this.AllList = data;
                _this.showList = data;
            },'json')
        },
        methods:{
            showUserModal:function(obj){
                $('#userModal').modal('toggle');
                 this.userObj = obj;
                var _this = this;
                $.get('Enterprise/get_exp',{
                    u_id:obj.u_id
                },function(data){
                    _this.userExp = data;
                },'json')
            },
            delUser:function(){
                if(confirm('是否注销用户消除用户所有信息？')){
                    $.post('Admin/del_user',{
                        u_id:this.userObj.u_id
                    },function(data){
                        if(data == 'success'){
                            alert('删除成功');
                            history.go(0);
                        }else if(data == 'fail'){
                            alert('删除失败');
                        }
                    },'text')
                }
            },
            searchUser:function(){
                var userName = this.userNameStr,
                    _this = this;
                    this.showList = [];
                this.AllList.forEach(function(obj,index){
                    if(obj.true_name.indexOf(userName) >= 0){
                        _this.showList.push(obj);
                    }
                })
            }
        }

    })
</script>
</body>
</html>