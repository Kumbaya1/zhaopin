<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>查看招聘信息</title>
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
        }
        #infor-list td,#infor-list th{
            text-align: center;
        }
        #infor-list .title a{
            display: block;
            overflow: hidden;
            text-overflow:ellipsis;
            white-space: nowrap;
            width: 200px;
        }
        #infor-list .title{
            width: 200px;
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
        <input type="text" class="form-control"  placeholder='输入信息标题' v-model='titleStr'>
        <button class="btn btn-primary" @click='searchTitle'>搜索信息</button>
    </div>
    <div id="infor-list">
        <table  class="table table-striped">
            <tr>
                <th class="title">信息标题</th>
                <th class="tel">发表时间</th>
                <th class="address">公司名称</th>
                <th class="date">操作</th>
            </tr>
            <tr v-for='obj in showList'>
                <td class="title"><a href="javascript:;" v-text='obj.title' @click='showRe(obj)'></a></td>
                <td class="tel" v-text='obj.date'></td>
                <td class="title"><a href="javascript:;" v-text='obj.en_name' @click='showEn(obj)'></a></td>
                <td class="operation"><a href="javascript:;" @click='delRe(obj.re_id)'>删除</a></td>
            </tr>
        </table>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="enModal" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">查看公司信息</h4>
                </div>
                <div class="modal-body" style='text-align: left;'>
                   <h3>公司信息</h3>
                    <ul>
                        <li class="list-group-item">公司名称：<span v-text='enObj.en_name'></span></li>
                        <li class="list-group-item">公司性质：<span v-text='enObj.nature'></span></li>
                        <li class="list-group-item">公司所属行业：<span v-text='enObj.industry'></span></li>
                        <li class="list-group-item">公司地址：<span v-text='enObj.prov'></span>省<span v-text='enObj.city'></span>市</li>
                        <li class="list-group-item">联系电话：<span v-text='enObj.tel'></span></li>
                        <li class="list-group-item">联系人：<span v-text='enObj.contacter'></span>(<span v-text='enObj.sex'></span>)</li>
                        <li class="list-group-item">电子邮箱：<span v-text='enObj.email'></span></li>
                        <li class="list-group-item">企业介绍：<span v-text='enObj.introduction'></span></li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                </div>
            </div><!-- /.modal-content-->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal --> 
        <div class="modal fade" tabindex="-1" role="dialog" id="reModal" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">查看招聘信息</h4>
                </div>
                <div class="modal-body" style='text-align: left;'>
                   <h3>招聘信息</h3>
                   <div style="padding-left:100px; ">
                        <p><span style="font-weight: bold;">标题：</span><span v-text='enObj.title'></span></p>
                        <p><span style="font-weight: bold;">内容：</span><span v-text='enObj.content'></span></p>
                   </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                </div>
            </div><!-- /.modal-content-->
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
            enObj:{},
            titleStr:''
        },
        created:function(){
            var _this = this;
            $.get('Admin/get_msg',function(data){
                _this.showList = data;
                _this.allList = data;
            },'json')
        },
        methods:{
            showEn:function(obj){
                this.enObj = obj;
                $('#enModal').modal('toggle');
            },
            showRe:function(obj){
                this.enObj = obj;
                $('#reModal').modal('toggle');
            },
            delRe:function(re_id){
                if(confirm('是否删除此条招聘信息？')){
                    $.post('Admin/del_re',{
                        re_id:re_id
                    },function(data){
                        if(data == 'success'){
                            alert('删除成功！');
                            history.go(0);
                        }else if(data == 'fail'){
                            alert('删除失败！');
                        }
                    },'text')
                }
            },
            searchTitle:function(){
                var _this = this;
                this.showList = [];
                this.allList.forEach(function(obj,index){
                    if(obj.title.indexOf(_this.titleStr) >= 0){
                        _this.showList.push(obj)
                    }
                })
            }
        }
    })
</script>
</body>
</html>