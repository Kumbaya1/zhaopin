<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>公告管理</title>
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
            width: 370px;
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
        }
        #infor-list .title a{
            display: block;
            overflow: hidden;
            text-overflow:ellipsis;
            white-space: nowrap;
            width:200px;
        }
        .modal-body{
            text-align: center;
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
        <input type="text" class="form-control" v-model='searchTitle'>
        <button class="btn btn-primary" @click='searchAn'>搜索公告</button>&nbsp;<button class="btn btn-primary" @click='showAddAn'>添加</button>
    </div>
    <div id="infor-list">
        <table  class="table table-striped">
            <tr>
                <th class="title">公告标题</th>
                <th class="date">发表时间</th>
                <th class="edit">编辑</th>
                <th class="del">删除</th>
            </tr>
            <tr v-for='obj in showList'>
                <td class="title"><a href="javascript:;" v-text='obj.title' @click='editSign(obj)'></a></td>
                <td class="date" v-text='obj.date'></td>
                <td class="edit"><a href="javascript:;" @click='editSign(obj)'>编辑</a></td>
                <td class="del"><a href="javascript:;" @click='delSign(obj)'>删除</a></td>
            </tr>
        </table>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">查看公告</h4>
                </div>
                <div class="modal-body">
                    <label>标题：
                        <input type="text" class="form-control" placeholder="标题" v-model='title'>
                    </label><br>
                    <label>内容：<br>
                        <textarea style="resize:none" cols="30" rows="10" no-resize v-model='content'></textarea>
                    </label>
                    <p v-text='errMsg' style="color: red"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" @click='changeSign'>修改</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="anModal" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">添加公告</h4>
                </div>
                <div class="modal-body">
                    <label>标题：
                        <input type="text" class="form-control" placeholder="标题" v-model='newTitle'>
                    </label><br>
                    <label>内容：<br>
                        <textarea style="resize:none" cols="30" rows="10" no-resize v-model='newContent'></textarea>
                    </label>
                    <p v-text='errAnMsg' style="color: red"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" click='changeSign' @click='addAn'>添加</button>
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
            errMsg:'',
            title:'',
            content:'',
            userObj:{},
            newTitle:'',
            newContent:'',
            errAnMsg:'',
            searchTitle:''

        },
        created:function(){
            var _this = this;
            $.get('Admin/get_sign',function(data){
                _this.showList = data;
                _this.allList = data;
            },'json')
        },
        methods:{
            editSign:function(obj){
                $('#myModal').modal('toggle');
                this.errMsg = '';
                this.userObj = obj;
                this.title = obj.title;
                this.content = obj.content;
            },
            delSign:function(obj){
                if(confirm('确认删除此条公告？')){
                    $.post('Admin/del_sign',{
                        an_id:obj.an_id
                    },function(data){
                        if(data == 'success'){
                            alert('删除成功!');
                            history.go(0);
                        }else if(data == 'fail'){
                            alert('删除失败!');
                        }
                    },'text')
                }
            },
            changeSign:function(){
                this.errMsg = '';
                if(this.userObj.title == this.title && this.userObj.content == this.content){
                    this.errMsg = '当前并未修改!!!';
                }else{
                    $.post('Admin/edit_an',{
                        an_id:this.userObj.an_id,
                        title:this.title,
                        content:this.content
                    },function(data){
                        if(data == 'success'){
                            alert('修改成功!');
                            history.go(0);
                        }else if(data == 'fail'){
                            alert('修改失败!');
                        }
                    },'text')
                }
            },
            searchAn:function(){
                this.showList = [];
                var _this = this;
                this.allList.forEach(function(obj,index){
                    if(obj.title.indexOf(_this.searchTitle) >= 0){
                        _this.showList.push(obj);
                    }
                })
            },
            showAddAn:function(){
                $('#anModal').modal('toggle');
            },
            addAn:function(){
                this.errAnMsg = '';
                var _this = this;
                if(this.newTitle == ''){
                    this.errAnMsg = '标题不能为空！';
                }else if(this.newContent ==''){
                    this.errAnMsg = '内容不能为空！';
                }else{
                    $.post('Admin/add_an',{
                        title:_this.newTitle,
                        content:_this.newContent
                    },function(data){
                         if(data == 'success'){
                            alert('添加成功!');
                            history.go(0);
                        }else if(data == 'fail'){
                            alert('修添加失败!');
                        }
                    },'text')
                }
            }
        }
    })
</script>
</body>
</html>