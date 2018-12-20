<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>票据钱柜</title>
    <meta name="Keywords" content="p2p理财，互联网金融，投资理财产品，个人投资理财，短期理财" />
    <meta name="description" content="互联网投资理财金融服务p2p平台">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <link rel="stylesheet" href="/Style/new/css/main.css">
    <link rel="stylesheet" href="/Style/new/css/common.css" />
    <script type="text/javascript">
        var imgpath = "__ROOT__/Style/M/";
        var curpath = "__URL__";
    </script>
    <script language="JavaScript">
        function keyLogin() {
            if (event.keyCode == 13)   //回车键的键值为13
                document.getElementById("btnReg").click();  //调用登录按钮的登录事件
        }
    </script>
    <style>
        #txtCode {
            width: 143px;
        }        
    </style>
    <script src="/Style/new/js/jquery-1.7.2.js" type=text/javascript></script>
    <script type="text/javascript" src="__ROOT__/Style/M/js/login.js"></script>
    <link type="text/css" rel="stylesheet" href="/Style/JBox/Skins/Currently/jbox.css" />
    <script src="/Style/JBox/jquery.jBox.min.js" type="text/javascript"></script>
    <script src="/Style/JBox/jquery.jBoxConfig.js" type="text/javascript"></script>
</head>

<body style="background-color:#BCD2EE">
    <!--<div class=head>
    <ul class=head_1>
        <li class=li1>服务热线：<span> <?php $dw_kefu=get_qq(2);echo($dw_kefu[0]["qq_num"]); ?></span> </li>

        <?php if($UID > '0'): ?><li><span><a href="/Member" target="_blank" class="primary">欢迎<?php echo session('u_user_name');?></a></span>-<span><a href="/Member/common/actlogout" class="primary" title="退出">退出</a></span></li>

            <?php else: ?>
            <li class=li3><a href="/member/common/register/">免费注册</a></li>
            <li class=li3><a href="/member/common/login/">立即登录</a></li><?php endif; ?>
        <li class=li3><a href="/bangzhu/about.html">关于我们</a></li>
        <li class=li3><a href="/tools/tool2.html">计算器</a></li>
        <li class=li3><a href="/bangzhu/index.html">帮助中心</a></li>
    </ul>
</div>
<div class="logo_wai">
    <div class="zong_width">
        <div class="logo"><a href="/"></a></div>
        <div class="nav">
            <ul>


                <li><a href="/">首页</a></li>
                <li><a href="/invest/index.html">我要投资</a></li>
                <li><a href="/borrow/index.html">我要借款</a></li>
                <li><a href="/bangzhu/safe.html">安全保障</a></li>
                <li><a href="/member">我的账户</a></li>
                <li><a href="/bangzhu/about.html">关于我们</a></li>

            </ul>
        </div>
    </div>
</div>
-->

<div class="slogan"><p>欢迎登陆票据钱柜</p></div>
    
    <div class="container">
        

        <div class="login" >
            <div class="denglu"><a href="__APP__/index.html" style="color:#0099ff; font-size:16px; font-weight:bold">&nbsp;&nbsp;返回首页</a></div>
            <div class="shuoming"><p>票据钱柜为您提供安全、高效、便捷的投资服务</p></div>
            <!--<div class="userstyle">
                <div class="form-group">用户身份 : </div>
                <div class="union">
                    <label class="ui-radiobox" rel="common_user_type"><input type="radio" name="user_type" value="0" checked="checked" /><span>个人</span></label>
                    <label class="ui-radiobox" rel="common_user_type"><input type="radio" name="user_type" value="1" /><span>企业</span></label>
                </div>
            </div>-->
            <!--登录表单-->
            <div class="user-lr-box mt30">
                <div onkeydown="keyLogin();" id="page_login_form">
                    <div style="height:30px; width:317px;" class="field">
                        <div id="dvUser" class="dv_r_4_2"></div>
                    </div>
                    <!--登录表 用户名-->
                    <div class="field username ">
                        <div class="f_l pr">
                            <div class="u_icon"><i class="iconfont">用户名</i></div>
                            <input type="text" value="" class="f-input ui-textbox" placeholder="请输入用户名" id="txtUser" name="email" size="30" tabindex="1" />
                        </div>
                        <div class="blank0"></div>
                    </div>
                    <div class="blank10"></div>
                    <!--登录表 密码-->
                    <div class="field password">
                        <div class="f_l pr">
                            <div class="u_icon"><i class="iconfont">密 码</i></div>
                            <input type="password" value="" class="f-input ui-textbox" placeholder="请输入密码" id="txtPwd" name="user_pwd" size="30" tabindex="2" />
                        </div>
                        <div class="blank0"></div>
                    </div>
                    <div class="blank10"></div>
                    <!--登录表 验证码-->
                    <div class="field username ">
                        <div class="f_l pr">
                            <div class="u_icon"><i class="iconfont">验证码</i></div>
                            <input type="text" value="" class="f-input ui-textbox" placeholder="请输入验证码" id="txtCode" name="email" size="30" tabindex="3" />
                            <img onclick="this.src=this.src+'?t='+Math.random()" id="imVcode" alt="点击换一个校验码" style=" width: auto; height:auto;border: 1px solid #ccc;" src="__URL__/verify" /> <a href="javascript:document.getElementById('imVcode').onclick();">刷新</a>
                        </div>
                        <div class="blank0"></div>
                    </div>
                    <div class="blank10"></div>
                    <!--登录表 密码-->
                    <!--登录表 设置登陆和忘记密码-->
                    <div class="field autologin clearfix">
                        <label class="ui-checkbox mt5" rel="auto_login" style="float:left!important;"><input type="checkbox" id="autologin" name="auto_login" value="1" tabindex="4" /> 下次自动登录</label>
                        <div class="lostpassword f_l"><a href="javascript:getPassWord();" class="f14 lh24 f_blue">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;忘记密码?</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="__APP__/member/common/register/" class="f14 lh24 f_blue">免费注册</a></div>
                        <div class="blank0"></div>
                    </div>
                    <div class="blank10"></div>
                    <!--登录表 登陆按钮-->
                    <div class="field act">
                        <input type="hidden" name="ajax" value="1" />
                        <input type="submit" class="btn_green f_white w360 f18 p10 bdr3 login-submit-btn" id="user-login-submit" name="commit" value="立即登录" tabindex="5" onclick="LoginSubmit(this);" />
                        <div class="blank0"></div>
                    </div>
                    <div class="blank10"></div>

                    <!--登录表 合作账号-->
                    <div style="border-bottom:1px solid #dedede; margin:0px;padding:0;height:25px;width:380px;"></div>

                </div>
            </div>
        </div>
        
        <!--<div class="login-pic"><img src="/Style/new/images/login-left.jpg" /></div>-->
    </div>
    <script type="text/javascript">
        function jfun_dogetpass() {
            var ux = $("#emailname").val();
            if (ux == "") {
                $.jBox.tip('请输入用户名或者邮箱', 'tip');
                return;
            }
            $.jBox.tip("邮件发送中......", "loading");
            $.ajax({
                url: "__APP__/member/common/dogetpass/",
                data: { "u": ux },
                //timeout: 5000,
                cache: false,
                type: "post",
                dataType: "json",
                success: function (d, s, r) {
                    if (d) {
                        if (d.status == 1) {
                            $.jBox.tip("发送成功，请去邮箱查收", 'success');
                            $.jBox.close(true);
                        } else {
                            $.jBox.tip("发送失败，请重试", 'fail');
                        }
                    }
                }
            });

        }

        function getPassWord() {
            $.jBox("get:__APP__/member/common/getpassword/", {
                title: "找回密码",
                width: "auto",
                buttons: { '发送邮件': 'jfun_dogetpass()', '关闭': true }
            });
        }

    </script>

    <style>


#footer{margin-top: 30px;}
.footleft{float:left;}
.footright{float:right;width:290px;position: relative;}
.footright #wechat{width:120px;height: 130px;position: absolute;top:-134px;left:26px;z-index:999;display: none;}
.footbg{background: #333;color: #fff;padding: 10px 0px;height: 102px;}
.ftlink{padding-bottom: 10px;}
.ftlink a{line-height: 38px;font-size: 14px;padding: 0px 15px;color: #fff;}
.ftlink a:hover{color: #E44142;}
.ftimg a{display:block;float:left;margin: 10px 15px;}
#footer .cp{ text-align: center;line-height:30px;padding: 5px 0;color: #666;}
.ftcare{font-size: 14px;color: #fff;line-height: 40px;overflow: hidden;width: 210px;}
.ftcare span{float: left;padding-right: 10px;}
.ftcare a{float:left;display:block;width:30px;height: 30px;margin-top: 5px;transition:0.4s ease;-webkit-transition:0.4s ease;-o-transition:0.4s ease;-moz-transition:0.4s ease;}
.ftcare a.wx{background: url(/Style/ad_right/icon_wx1.png) no-repeat;}
.ftcare a.wx:hover{background: url(/Style/ad_right/icon_wx3.png) no-repeat;}
.ftcare a.wb{background: url(/Style/ad_right/icon_wb1.png) no-repeat;}
.ftcare a.wb:hover{background: url(/Style/ad_right/icon_wb3.png) no-repeat;}
.ftcare a.tx{background: url(/Style/ad_right/icon_tx1.png) no-repeat;}
.ftcare a.tx:hover{background: url(/Style/ad_right/icon_tx3.png) no-repeat;}
.ftcare a{display:block;float:left;margin: 0px 8px;padding-top: 5px;}
.footright h2{font-size: 24px;font-weight:normal;line-height: 30px;display:inline;}
.footright p{line-height: 20px;font-size: 14px;}


</style>

<div style="clear:both; height:0px; width:300px; _display:inline;"></div>
<div class="footer" style="display:none">
  <div class="footer_con">
    <div class="footer_p"><?php echo get_ad(8);?></div>
        <div class="footer_ul footer_gy">
            <h2>关于我们</h2>
            <ul>
                <li><a href="__ROOT__/aboutus/jianjie.html">公司简介</a></li>
                <li><a href="__ROOT__/aboutus/zizhi.html">公司证件</a></li>
                <li><a href="__ROOT__/aboutus/zfsm.html">资费说明</a></li>
                <li><a href="__ROOT__/aboutus/zcfgd.html">政策法规</a></li>	
            </ul>
        </div>
        <div class="footer_ul footer_gy">
            <h2>网贷工具</h2>
            <ul>
                <li><a href="__ROOT__/tools/tool2.html">计算工具</a></li>
                <li><a href="__ROOT__/tuiguang/index.html">推广系统</a></li>
                <li><a href="__ROOT__/member/auto/index.html">自动投标</a></li>
                <li><a href="__ROOT__/member/capital#fragment-2">资金明细</a></li>	
            </ul>
        </div>
    <div class="footer_ul footer_help">
      <h2>帮助信息</h2>
      <ul>
        <li><a href="__ROOT__/bangzhu/index.html">帮助中心</a></li>
        <li><a href="__ROOT__/bangzhu/touzi.html">赎回投资</a></li>
        <li><a href="__ROOT__/bangzhu/new.html">新手指引</a></li>
        <li><a href="__ROOT__/bangzhu/safe.html">安全保障</a></li>
      </ul>
    </div>
    <div class="footer_p footer_last"><?php echo get_ad(9);?></div>
  </div>
  <div class="last_last">
    <?php echo ($glo["bottom"]); ?> 技术支持：<a href="http://www.lvmaque.com/" target="_blank">绿麻雀网贷系统</a>
  </div>
</div>



    <link href="Style/ad_right/gftv3-index.css" rel="stylesheet">
<div id="footer" style="background:#333" >
    <div style="width:980px; margin:0 auto">  	
        <div class="footbg">
          <div class="w1000">
            <div class="footleft">
              <div class="ftlink">
                <a href="/bangzhu/about.html">关于我们</a>
                <a href="/invest/index.html">交易大厅</a>
                <a href="/borrow/index.html">发布票源</a>
                <a href="/bangzhu/safe.html">安全保障</a>
                <!--<a href="/bangzhu/index.html">帮助中心</a>-->
              </div>
              <div class="ftimg">
                <!--<a href="https://ss.knet.cn/verifyseal.dll?sn=e140617371300500303in3000000&comefrom=trust&trustKey=dn&trustValue=www.xyjrp2p.com"><img src="/Style/ad_right/picon_kxwz.png"></a>
                <a href=""><img src="/Style/ad_right/ficon_pjzs.png"></a>
                <a href="" target="_blank"><img src="/Style/ad_right/picon_hyyz.png"></a>
                <a rel="nofollow" href="" target="_blank"><img src="/Style/ad_right/picon_360wz.png"></a>-->
              </div>
            </div>
            <div class="footright">
              <div class="ftcare">
                <!--<span>关注我们</span>
                <a href="" class="wx"></a>
                <a rel="nofollow" href="" target="_blank" class="wb"></a>
                <a rel="nofollow" href="" target="_blank" class="tx"></a>-->
              </div>
              <h2>电话号码</h2>
              <p>周一至周五8：00-17：00（法定节假日除外）</p>
              <div id="wechat"><img src="/Style/ad_right/wechat.png"></div>
            </div>
          </div>
        </div>
  </div>
</div>
                <!-- 友情链接开始 -->
      	<div class="mlinks w1000" style="width:980px; margin:0 auto; padding-top:10px;">
  
          <div style="background:#fafafa; border:1px solid #cdcdcd;height:40px; color:#666666; font-size:14px; line-height:40px; border-left:none; border-right:none ">
          	&nbsp;友情链接：&nbsp;&nbsp;
            <?php $_result=get_home_friend(1,1);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vf): $mod = ($i % 2 );++$i;?><a target="_blank" href="<?php echo ($vf["link_href"]); ?>"><?php echo ($vf["link_txt"]); ?>&nbsp;&nbsp;&nbsp;</a><?php endforeach; endif; else: echo "" ;endif; ?>
                 
          </div>
      	</div>
      	<!-- 友情链接结束 -->
      	        <div class="cp" style="text-align:center; height:40px; margin-top:10px"><span class="last_last"><?php echo ($glo["bottom"]); ?></span></div>
      </div>
      
       </div>















</body></html>

</html>