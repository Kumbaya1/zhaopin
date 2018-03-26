<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>编辑个人简历</title>
    <base href="<?php echo site_url();?>">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/flexDate.min.css">
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
            width: 1000px;
            padding-bottom:20px;
            margin: 20px auto;
            border: 1px solid #ccc;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            position: relative;
        }
        #img{
            height:150px;
            width: 150px;
            position: absolute;
            top:150px;
            right: 250px;
            text-align: center;
        }
        #img img{
            width: 100%;
            height: 100%;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
        }
        #img a{
            font-size: 14px;
            display: block;
            margin-top: 10px;
        }
        #img a:hover{
            color: #cba;
        }
        #img button{
            margin-top: 100px;
        }
        .form-control{
            width: 200px;
            display: inline;
        }
        .form-control.city{
            width: 98px;
        }
        .detail{
            color: red;
            padding:0 8px;
        }
        #my-infor{
            padding:40px 80px;
        }
        #my-infor p{
            margin-bottom: 20px;
        }
       
        textarea{
            width: 340px;
            resize: none;
            height: 100px;

        }
        .caption{
            display: inline-block;
            width: 80px;
            text-align: right;
        }
        #change-btn{
            /*text-align: center;*/
            margin-top:30px;
        }
        #change-btn li{
            border-bottom: 1px solid #ccc;
            width: 750px;
            margin-left: 30px;
        }
        #change-btn li .dela{
           text-align: right;
        }
        #err-msg {
            text-align: center;
            color: red;
            font-size: 16px;
            background: #ccc;
        }
        .modal-body{
            padding:20px 45px;
        }
        #myExp .modal-body input{
            width: 40px;
        }
        .modal-body{
            text-align: center;
        }
        .modal-body li p{
            text-indent: 2em;
            word-break:break-all;
            text-align: left;
        }
        #head-form,#headimg-box{
            display: inline-block;
            text-align: left;
            overflow: hidden;
        }
        #headimg-box img{
            width: 100px;
        }
        .h4-tit{
            border-bottom: 1px solid;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }
        .addExp-box button{
            margin-left: 400px;
        }
        .addExp-box input{
            width: 150px;
        }
        .addExp-box textarea{
            width: 400px;
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
    <div id="form">
        <div id="err-msg">
            <span v-text='errMsg'></span>
        </div>

        <div id="img">
            <img src="images/header/<?php echo $user['photo']?$user['photo']:'default_user.png';?>" alt="">
            <a href="javascript:;" @click='headImg'>上传头像</a>
            <button class="btn btn-default" @click='edit'>完成修改</button>
        </div>
        <div id="my-infor">
            <h4 class="h4-tit">个人资料</h4>
            <p><span class="detail">*</span><span class="caption">真实姓名：</span><input type="text" class="form-control" v-model='trueName'></p>
            <p><span class="detail">*</span><span class="caption">性别：</span><input type="radio" name="sex" value="男" v-model='sex'>男 <input type="radio" name="sex"  value="女" v-model='sex'>女</p>
            <p><span class="detail">*</span><span class="caption">年龄：</span><input type="text" class="form-control" v-model='age'></p>
            <p><span class="detail">*</span><span class="caption">电话：</span><input type="text" class="form-control" v-model='tel'></p>
            <p><span class="detail">*</span><span class="caption">email：</span><input type="text" class="form-control" v-model='email'></p>
            <span class="detail">*</span><span class="caption">地区：</span>
            <select onchange="showcity(this.value, document.getElementById('userCity'));" name="province" id="userProvince" class="form-control city" v-model='prov'>
                <option value="">--请选择省份--</option>
                <option value="北京">北京</option>
                <option value="上海">上海</option>
                <option value="广东">广东</option>
                <option value="江苏">江苏</option>
                <option value="浙江">浙江</option>
                <option value="重庆">重庆</option>
                <option value="安徽">安徽</option>
                <option value="福建">福建</option>
                <option value="甘肃">甘肃</option>
                <option value="广西">广西</option>
                <option value="贵州">贵州</option>
                <option value="海南">海南</option>
                <option value="河北">河北</option>
                <option value="黑龙江">黑龙江</option>
                <option value="河南">河南</option>
                <option value="湖北">湖北</option>
                <option value="湖南">湖南</option>
                <option value="江西">江西</option>
                <option value="吉林">吉林</option>
                <option value="辽宁">辽宁</option>
                <option value="内蒙古">内蒙古</option>
                <option value="宁夏">宁夏</option>
                <option value="青海">青海</option>
                <option value="山东">山东</option>
                <option value="山西">山西</option>
                <option value="陕西">陕西</option>
                <option value="四川">四川</option>
                <option value="天津">天津</option>
                <option value="新疆">新疆</option>
                <option value="西藏">西藏</option>
                <option value="云南">云南</option>
                <option value="香港">香港特别行政区</option>
                <option value="澳门">澳门特别行政区</option>
                <option value="台湾">台湾</option>
                <option value="海外">海外</option>
            </select>
            <select name="city" id="userCity" class="form-control city" v-model='city'></select>
            <br>
            <br>
            <span class="detail">*</span><span class="caption">个人简介：</span><br><textarea v-model='detail'></textarea><br>
            <div class="exp-box">
                <h4 class="h4-tit">工作经验</h4>
            </div>
            <div id="change-btn">
                <ul>
                    <li v-for='(obj,index) in userExp'>
                        <h5>{{index+1}}</h5>
                        <span>起止时间:{{obj.start_date}}-----{{obj.end_date}}</span><p>详细：{{obj.content}}</p>
                        <div class="dela">
                            <a href="javascript:;" @click='delExp(obj)'>删除</a>
                        </div>
                    </li>
                </ul>
                <p  v-show="addExpShow" class="addExp-box">起始时间：<input id='s_date' type="text" readonly class="flexDate" format="yyyy-MM-dd" clearBtn="false">&nbsp;&nbsp;结束时间：<input id='e_date'  type="text" readonly class="flexDate" format="yyyy-MM-dd" clearBtn="false"></p>
                <p v-show="addExpShow" class="addExp-box"><span>内容：</span>
                    <textarea v-model='expContent'></textarea><br>
                    <button @click='addExp'>保存</button>
                </p>
                <a href="javascript:;" @click='addOneExp'>+ 继续添加</a>
                <!-- <button class="btn  btn-default" @click="editExp">添加工作经验</button> -->
                
            </div>
            
        </div>
<!--         <div class="modal fade" tabindex="-1" role="dialog" id="myExp" role="dialog" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">添加工作经验</h4>
                    </div>
                    <div class="modal-body">
                        从<input type="text" v-model='s_year'>年<input type="text" v-model='s_mon'>月<input type="text" v-model='s_day'>日&nbsp;&nbsp;&nbsp;
                        到<input type="text" v-model='e_year'>年<input type="text" v-model='e_mon'>月<input type="text" v-model='e_day'>日 <br>
                        详细描述：<br><textarea  class="textarea" v-model='expContent'></textarea><br>
                        <h3>以往工作经验:</h3>
                        <ul>
                            <li v-for='exp in userExp'>
                                <span v-text='exp.start_date'>2017-01-01</span>至<span v-text='exp.end_date'>2018-01-01</span>
                                <p v-text='exp.content' style='text-indent: 2em;'></p>
                                <a href="javascript:;" @click='delExp(exp)'>删除</a>
                            </li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" @click='addExp'>增加</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="head-img" role="dialog" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">上传头像</h4>
                    </div>
                    <div class="modal-body">
                       <form action="User/updata_img" method="post" enctype="multipart/form-data" id='head-form'>
                            <input  type="file" name="file1">
                            <input type="submit" name="sub" value='提交'><br>
                            <span style="color: red;">（大小限制100KB以下,格式jpg、png、gif、jpeg）</span>
                       </form>
                        <div id="headimg-box">
                           <img src="images/header/<?php echo $user['photo']?$user['photo']:'default_user.png' ;?>">
                       </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
    <script src="js/getcity.js"></script>
    <script src="js/jquery-1.12.4.js"></script>
    <script src="js/flexDate.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/vue.js"></script>
    <script>
        // FlexDate.setSkin('#ff8000');
        // var date=new FlexDate({
        //     e: '.flexDate1',
        //     format: 'yyyy-MM-dd HH:mm:ss',
        //     value: '2017-07-08 12:30:30',
        //     clearBtn: true,
        //     todayBtn: true,
        //     confirmBtn: true,
        //     min:'2017-07-01',
        //     max:new Date(),
        //     zIndex:999,
        //     bindClick:true,
        //     confirm: function (value) {}
        // });
        var vm = new Vue({
            el:'#form',
            data:{
                trueName:'',
                sex:'',
                age:'',
                tel:'',
                email:'',
                prov:'',
                city:'',
                detail:'',
                errMsg:'',
                userExp:[],
                expContent:'',
                addExpShow:false
            },
            created:function(){
                var _this = this;
                $.get('User/get_user_resume',function(data){
                    _this.trueName = data.true_name;
                    _this.sex = data.sex;
                    _this.age = data.age;
                    _this.tel = data.tel;
                    _this.email = data.email;
                    _this.prov = data.prov;
                    _this.city = data.city;
                    _this.detail = data.introduction;
                    // console.log(data);
                    showcity(_this.prov, $('#userCity')[0]);
                },'json');
            },
            mounted:function(){
                // $('#userCity').trigger('select');
                this.editExp();
            },
            methods:{
                editExp:function(){
                    var _this = this;
                    $('#myExp').modal('show');
                    $.get('User/get_user_exp',function(data){
                        _this.userExp = data;
                    },'json');
                },
                addOneExp:function(){
                    this.addExpShow = true;
                    $('#s_date').val('');
                    $('#e_date').val('');
                    this.expContent = '';
                },
                edit:function(){
                    var trueName = this.trueName,
                        sex = this.sex,
                        age = this.age,
                        tel = this.tel,
                        email = this.email,
                        prov = this.prov,
                        city = this.city,
                        detail = this.detail,
                        telReg = /^1[3|4|5|7|8][0-9]{9}$/,
                        emailReg =  "";
                        this.errMsg = '';
                            if(!trueName){
                                this.errMsg ='请输入真实姓名';
                            }else if(!sex){
                                this.errMsg = '请选择性别';
                            }else if(age ==''){
                                this.errMsg = '请输入正确年龄';
                            }else if(!tel){
                                this.errMsg = '请输入电话号码';
                            }else if(!email){
                                this.errMsg = '请输入电子邮箱';
                            }else if(!prov){
                                this.errMsg = '请输入所在省份';
                            }else if(!city){
                                this.errMsg = '请选择所在城市';
                            }else if(!detail){
                                this.errMsg = '请输入个人简介';
                            }else{
                            $.post('User/update_user',{trueName:trueName,
                                        sex:sex,
                                        age:age,
                                        tel:tel,
                                        email:email,
                                        prov:prov,
                                        city:city,
                                        detail:detail
                                    },function(data){
                                if(data == 'success'){
                                    alert('修改成功!');
                                    history.go(0);
                                }else if(data == 'fail'){
                                    alert('当前未做任何修改!');
                                }
                            },'text');
                        }
                },
                delExp(exp){
                    var _this = this;
                    if(confirm('确实要删除此条？')){
                        $.post('User/del_exp',{exp_id:exp.exp_id},function(data){
                            if(data){
                                _this.editExp(); 
                            }
                        })
                    }
                },
                addExp(){
                    var startDate = $('#s_date').val(),
                        endDate = $('#e_date').val(),
                        expContent = this.expContent,
                        _this = this;
                    if( startDate !='' && endDate != '' &&  expContent != ''){
                          $.post('User/add_exp',{
                            start_date:startDate,
                            end_date:endDate,
                            content:expContent
                        },function(data){
                            if(data){
                                 _this.editExp();
                                 _this.addExpShow = false;
                            }
                        },'text');
                    }
                  
                },
                headImg:function(){
                    $('#head-img').modal('show');
                }
            }   
        })
    </script>
</body>
</html>