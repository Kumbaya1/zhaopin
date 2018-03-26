<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>企业注册</title>
    <base href="<?php echo site_url();?>">
    <link rel="stylesheet" href="css/reset.css">
    <style>
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
        #form{
            width: 600px;
            border:1px solid #ccc;
            margin:0 auto;
            /*text-align: center;*/
        }
        h5{
            background: #f4f4f4;
            font-size: 14px;
            padding: 6px 0 6px 8px;
        }
        .detail{
            color: red;
        }
        .name{
            display: inline-block;
            width:70px;
            text-align: right;
            padding-right:3px;
        }
        p{
            margin-top:20px;
        }
        input{
            height: 20px;
        }
        .sex label{
            width: 100px;
        }
        #form div{
            padding-left:150px;
            padding-right:150px;
            padding-bottom:20px;
        }
        button{
            width: 110px;
            height: 35px;
            color:#fff;
            background: #ff9808;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            border:0;
        }
        button:hover{
            opacity: 0.8;
        }
        .btn{
            text-align: center;
        }
        #userProvince,#userCity{
            width: 80px;
            height: 26px;
        }

    </style>
</head>
<body>
    <header>
        <h3>求职、招聘信息网</h3>
    </header>
    <div id="form">
        <h5>企业信息</h5>
        <div>
            <p><label><span class="detail">*</span><span class="name">公司名称</span><input type="text" id="en_name" v-model='en_name'></label></p>
            <p><span class="detail">*</span><span class="name">所在地</span> <select onchange="showcity(this.value, document.getElementById('userCity'));" name="province" id="userProvince" class="form-control city" v-model='prov'>
                <option value="">选择省份</option>
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
            <select name="city" id="userCity" class="form-control city" v-model='city'></select></p>
            <p><label><span class="detail">*</span><span class="name">联系人</span><input type="text" id="contacter" v-model='contact'></label>

            </p>
            <p class="sex">
                <label ><span class="detail">*</span><span class="name">性别</span></label>
                <label ><input type="radio" name="sex" value="男" v-model='sex'>先生</label>
                <label ><input type="radio" name="sex" value="女" v-model='sex'>女士</label>

            </p>
            <p><label><span class="detail">*</span><span class="name">联系电话</span><input type="text" id="tel" v-model='tel'></label></p>
            <p><label><span class="detail">*</span><span class="name">企业性质</span><input type="text"  v-model='nature'></label></p>
            <p><label><span class="detail">*</span><span class="name">所属行业</span><input type="text" v-model='industry'></label></p>
           <p><label><span class="detail">*</span><span class="name">企业简介</span><textarea style="width:173px;height:50px;resize: none;"  v-model='introduction'></textarea></label></p>
        </div>

        <h5>帐户信息</h5>
        <div>
            <p><label><span class="detail">*</span><span class="name">用户名</span><input type="text" id="e_name" v-model='e_name'></label></p>
            <p><label><span class="detail">*</span><span class="name">电子邮箱</span><input type="text" id="email" v-model='email'></label></p>
            <p><label><span class="detail">*</span><span class="name">密码</span><input type="password" v-model='passwprd'></label></p>
            <p><label><span class="detail">*</span><span class="name">确认密码</span><input type="password" v-model='repassword'></label></p>
        </div>
        <div class="btn">
            <button @click='en_regist'>立即注册</button>
            <p v-text='errMsg' style="color: red"></p>
        </div>
    </div>
    <script src="js/getcity.js"></script>
    <script src='js/jquery-1.12.4.js'></script>
    <script src='js/vue.js'></script>
    <script type="text/javascript">
        var vm = new Vue({
            el:'#form',
            data:{
                en_name:'',
                prov:'',
                city:'',
                contact:'',
                sex:'男',
                tel:'',
                e_name:'',
                email:'',
                passwprd:'',
                repassword:'',
                errMsg:'',
                prov:'',
                city:'',
                nature:'',
                industry:'',
                introduction:''
            },
            methods:{
                en_regist:function(){
                    var en_name = this.en_name,
                        prov = this.prov,
                        city = this.city,
                        contact = this.contact,
                        sex = this.sex,
                        tel = this.tel,
                        e_name = this.e_name,
                        email = this.email,
                        passwprd = this.passwprd,
                        repasswprd = this.repassword,
                        nature = this.nature,
                        industry = this.industry,
                        introduction = this.introduction,
                        _this = this;
                    this.errMsg = '';
                    if(en_name == ''){
                        this.errMsg = '公司名不能为空';
                    }else if(prov == '' || city == ''){
                        this.errMsg = '公司地址不能为空';
                    }else if(contact == ''){
                        this.errMsg = '联系人不能为空';
                    }else if(sex == ''){
                        this.errMsg = '联系人性别不能为空';
                    }else if(tel == ''){
                        this.errMsg = '联系人电话不能为空';
                    }else if(nature == ''){
                        this.errMsg = '企业性质不能为空';
                    }else if(industry == ''){
                        this.errMsg = '所属行业不能为空';
                    }else if(introduction == ''){
                        this.errMsg = '企业简介不能为空';
                    }else if(e_name == ''){
                        this.errMsg = '登录帐号不能为空';
                    }else if(email == ''){
                        this.errMsg = '电子邮箱不能为空';
                    }else if(passwprd == ''){
                        this.errMsg = '登录密码不能为空';
                    }else if(passwprd != repasswprd){
                        this.errMsg = '两次密码不一致';
                    }else{
                        $.post('Enterprise/en_regist',{
                            en_name:en_name,
                            prov:prov,
                            city:city,
                            contact:contact,
                            sex:sex,
                            tel:tel,
                            e_name:e_name,
                            email:email,
                            passwprd:passwprd,
                            nature:nature,
                            industry:industry,
                            introduction:introduction
                        },function(data){
                            if(data == 'fail'){
                                _this.errMsg='当前帐号已被注册';
                            }else if(data == 'success'){
                                location.href='Enterprise/index';
                            }
                        },'text');
                    }
                }
            }
        })
    </script>
</body>
</html>