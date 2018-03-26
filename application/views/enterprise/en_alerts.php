<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>消息通知</title>
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
            width: 650px;
            border: 1px solid #ccc;
            margin:20px auto;
            padding:20px 10px;
        }
        #infor-list .title a{
            display: block;
            overflow: hidden;
            text-overflow:ellipsis;
            white-space: nowrap;
            width:240px;
        }
        .nums{
            text-align: center;
        }
        .modal-body .dialog-td{
            height: 65px;
            line-height: 65px;
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
<div id="app">
     <div class="sidebar">
        <ul class="sidebar-content">
            <li><a href="Enterprise/index">Welcome</a></li>
            <li><a href="Enterprise/publishinfor">发布信息</a></li>
            <li><a href="Enterprise/alerts">消息通知</a></li>
            <li><a href="Enterprise/changepwd">修改密码</a></li>
            <li><a href="Enterprise/websitesign">网站公告</a></li>
        </ul>
    </div>
    <div id="search">
        <input type="text" class="form-control" v-model='searchTitleStr'>
        <button class="btn btn-primary" @click='searchTitle'>搜索标题</button>
    </div>
    <div id="infor-list">
        <table  class="table table-striped">
            <tr>
                <th class="title">信息标题</th>
                <th class="date">发表时间</th>
                <th class="nums">投递者</th>
            </tr>
            <tr v-for='obj in showList'>
                <td class="title"><a href="javascript:;" v-text='obj.title' @click='showInfor(obj)'></a></td>
                <td class="date" v-text='obj.date'></td>
                <td class="nums"><a href="javascript:;" v-text='obj.num' @click='showUser(obj.re_id)'></a></td>
            </tr>
        </table>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="inforModal" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">查看发布信息</h4>
                </div>
                <div class="modal-body" style='text-align: left;'>
                    标题：<span v-text='showTitle'></span> <br>
                    内容：<span v-text='showContent'></span> <br>
                    发布时间：<span v-text='showDate'></span> <br>                 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
     <div class="modal fade" tabindex="-1" role="dialog" id="userModal" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">查看投递者信息</h4>
                </div>
                <div class="modal-body" style='text-align: left;'>
                    <table class="table table-hover" v-show='showUserList'>
                        <tr>
                            <th>头像</th>
                            <th>姓名</th>
                            <th>年龄</th>
                            <th>地址</th>
                            <th>详细</th>
                        </tr>
                        <tr v-for='obj in userList'>
                            <td class='dialog-td'><img :src="`images/header/${obj.photo?obj.photo:'default_user.png'}`" style='width:40px;'></td>
                            <td v-text='obj.true_name' class='dialog-td'></td>
                            <td v-text='obj.age' class='dialog-td'></td>
                            <td class='dialog-td'>{{obj.prov}}省{{obj.city}}市</td>
                            <td class='dialog-td'><a href="javascript:;" @click='showUserObj(obj)'>展开</a></td>
                        </tr>
                    </table>
                    <div v-show='!showUserList' >
                        <button class="btn btn-primary" @click='showUserList=true'>返回</button>

                        <ul  style='text-align: center;'>
                            <li>头像：<img :src="`images/header/${userObj.photo?userObj.photo:'default_user.png'}`" style='width:40px;'></li>
                            <li>姓名：<span v-text='userObj.true_name'></span></li>
                            <li>年龄：<span v-text='userObj.age'></span></li>
                            <li>电话：<span v-text='userObj.tel'></span></li>
                            <li>邮箱：<span v-text='userObj.email'></span></li>
                            <li>地址：<span >{{userObj.prov}}省{{userObj.city}}市</span></li>
                            <li>个人简介：<span v-text='userObj.introduction'></span></li>
                        </ul>        
                        <h3 style='text-align: center;'>工作经验</h3>
                        <div style='padding:0 180px '>
                            <ul>
                                <li v-for='(exp,index) in userExp'>
                                    <h4 v-text='index+1' style='text-align: center;'></h4>
                                   内容：<span v-text='exp.content'></span><br><br>
                                   开始时间:<span v-text='exp.start_date'></span><br>
                                   结束时间:<span v-text='exp.end_date'></span><br>
                                </li>
                            </ul>
                        </div>
                       
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
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
                allList:[],
                showTitle:'',
                showContent:'',
                showDate:'',
                userList:[],
                showUserList:true,
                userObj:{},
                userExp:{},
                searchTitleStr:''

            },
            created:function(){
                var _this = this;
                $.get('Enterprise/get_message',function(data){
                    _this.allList = data;
                    _this.showList = data;
                },'json');
            },
            methods:{
                showInfor:function(obj){
                    $('#inforModal').modal('toggle');
                    this.showTitle = obj.title;
                    this.showContent = obj.content;
                    this.showDate = obj.date;
                },
                showUser:function(re_id){
                    this.showUserList = true;
                    var _this = this;
                    $('#userModal').modal('toggle');
                    $.get('Enterprise/get_userlist',{ 
                        re_id:re_id
                    },function(data){
                        _this.userList = data;
                    },'json');
                },
                showUserObj:function(obj){
                    this.showUserList = false;
                    this.userObj = obj;
                    var _this = this;
                    $.get('Enterprise/get_exp',{
                        u_id:obj.u_id
                    },function(data){
                        _this.userExp = data;
                    },'json')
                },
                searchTitle:function(){
                    this.showList = [];
                    var _this = this;
                    this.allList.forEach(function(obj,index){
                        if(obj.title.indexOf(_this.searchTitleStr) >= 0){
                            _this.showList.push(obj);
                        }
                    })
                }
            }
        })
    </script>
</body>
</html>