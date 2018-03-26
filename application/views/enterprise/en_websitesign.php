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
<div id="content">
     <div id="search">
        <input type="text" class="form-control" v-model='titName'>
        <button class="btn btn-primary" @click='searchTitle'>搜索公告</button>
    </div>
    <div id="infor-list">
        <table  class="table table-striped">
            <tr>
                <th class="title">公告标题</th>
                <th class="date">发表时间</th>
            </tr>
            <tr v-for='obj in showList'>
                <td class="title"><a href="javascript:;" v-text='obj.title' @click='showContentAn(obj)'></a></td>
                <td class="date" v-text='obj.date'></td>
            </tr>
        </table>
    </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="contentModal" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">公告信息</h4>
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
</div>
   
<script src="js/jquery-1.12.4.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/vue.js"></script>
<script>
    var vm = new Vue({
        el:'#content',
        data:{
            showList:[],
            titName:'',
            allList:[],
            showTitle:'',
            showContent:'',
            showDate:''
        },
        created:function(){
            var _this = this;
            $.get('Enterprise/get_announce',{},function(data){
                _this.allList = data;
                _this.showList = data;
            },'json')
        },
        methods:{
            searchTitle:function(){
                this.showList = [];
                var _this = this;
                this.allList.forEach(function(obj,index){
                    if(obj.title.indexOf(_this.titName) >= 0){
                        _this.showList.push(obj);
                    }
                })
            },
            showContentAn:function(obj){
                $('#contentModal').modal('toggle');
                this.showTitle = obj.title;
                this.showContent = obj.content;
                this.showDate = obj.date;
            }
        }
    })
</script>
</body>
</html>