<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>招聘信息</title>
    <base href="<?php echo site_url();?>">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/reset.css">
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
        #infor-list .title a{
            display: block;
            overflow: hidden;
            text-overflow:ellipsis;
            white-space: nowrap;
            width:350px;
        }
        #infor-list .title{
            width:350px;
        }
        #infor-list .com{
            width: 200px;
        }
         #infor-list .com a{
            display: block;
            overflow: hidden;
            text-overflow:ellipsis;
            white-space: nowrap;
            width:200px;
        }
        .weight-fw{
            font-weight: bold;
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
    <div id="app">
        <div id="search">
            <input type="text" class="form-control" v-model='searchTitStr'>
            <button class="btn btn-primary" @click='searchTitle'>搜索标题</button>
        </div>
        <div id="infor-list">
            <table  class="table table-striped">
                <tr>
                    <th class="title">标题</th>
                    <th class='com'>公司名称</th>
                    <th class="date">发布时间</th>
                </tr>
                <tr v-for='obj in showList'>
                    <td class="title"><a href="javasctipt:;" v-text='obj.title' @click='showContent(obj)'></a></td>
                    <td class='com'><a href="javasctipt:;" v-text='obj.en_name'  @click='showEn(obj)'></a></td>
                    <td class="date" v-text='obj.date'></td>
                </tr>
            </table>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="myDialog" role="dialog" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" v-text='modalTitle'></h4>
                    </div>
                    <div class="modal-body">
                        <div v-show='showBox'>
                            <span class="weight-fw">标题：</span><span v-text='boxTitle'></span><br>
                            <span class="weight-fw">内容：</span><span v-text='boxContent'></span><br>
                            <span class="weight-fw">发布公司：</span><span v-text='boxEn_name'></span><br>
                            <span class="weight-fw">发布时间：</span><span v-text='boxDate'></span><br>
                            <span class="weight-fw">投递：</span><span v-text='isStatic'></span>
                        </div>
                        <div v-show='!showBox'>
                            <span class="weight-fw">公司名称：</span><span v-text='boxEn_name'></span><br>
                            <span class="weight-fw">公司性质：</span><span v-text='boxNature'></span><br>
                            <span class="weight-fw">所属行业：</span><span v-text='boxIndustry'></span><br>
                            <span class="weight-fw">公司地址：</span><span >{{boxProv}}省{{boxCity}}市</span><br>
                            <span class="weight-fw">联系电话：</span><span v-text='boxTel'></span><br>
                            <span class="weight-fw">联系人：</span><span v-text='boxContacter'></span><br>
                            <span class="weight-fw">电子邮箱：</span><span v-text='boxEmail'></span><br>
                            <span class="weight-fw">企业介绍：</span><span v-text='boxIntroduction'></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" v-show='showBox' @click='pushResume'  id='push-btn'>投递简历</button>
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
                showBox:true,
                modalTitle:'',
                boxTitle:'',
                boxContent:'',
                boxEn_name:'',
                boxDate:'',
                boxNature:'',
                boxIndustry:'',
                boxProv:'',
                boxCity:'',
                boxTel:'',
                boxContacter:'',
                boxEmail:'',
                boxIntroduction:'',
                isStatic:'否',
                oResult:{},
                searchTitStr:''
            },
            created:function(){
                var _this = this;
                $.get('User/recruitment_infor',function(data){
                    _this.showList = data;
                    _this.allList = data;
                },'json')
            },
            methods:{
                showContent:function(obj){
                    $('#myDialog').modal('toggle');
                    this.modalTitle = '招聘信息';
                    this.showBox = true;
                    this.boxTitle = obj.title ;
                    this.boxContent= obj.content ;
                    this.boxEn_name= obj.en_name ;
                    this.boxDate = obj.date ;
                    this.oResult = obj;
                    var _this = this;
                    $.post('User/check_resume',{
                            e_id:this.oResult.e_id,
                            re_id:this.oResult.re_id
                        },function(data){
                             if(data == 'yes'){
                                _this.isStatic = '是';
                                $('#push-btn').attr('disabled','disabled');
                            }else if(data == 'no'){
                                _this.isStatic = '否';
                                $('#push-btn').removeAttr('disabled');
                            }
                        },'text')
                },
                showEn:function(obj){
                    $('#myDialog').modal('toggle');
                    this.modalTitle = '公司信息';
                    this.showBox = false;
                    this.boxNature = obj.nature;
                    this.boxIndustry = obj.industry;
                    this.boxProv = obj.prov;
                    this.boxCity = obj.city;
                    this.boxTel = obj.tel;
                    this.boxContacter = obj.contacter;
                    this.boxIntroduction = obj.introduction;
                    this.boxEmail = obj.email;
                    this.boxEn_name = obj.en_name;
                },
                pushResume:function(){
                    if(confirm('向此公司岗位投递简历？')){
                        $.post('User/push_resume',{
                            e_id:this.oResult.e_id,
                            re_id:this.oResult.re_id
                        },function(data){
                            if(data == 'success'){
                                history.go(0);  
                            }
                        },'text')
                    }
                },
                searchTitle:function(){
                    this.showList = [];
                    var _this = this;
                    this.allList.forEach(function(obj,index){
                        if(obj.title.indexOf(_this.searchTitStr) >= 0){
                            _this.showList.push(obj);
                        }
                    })
                }
            }
        })
    </script>
</body>
</html>