<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>新用户注册-- <?php echo ($glo["web_name"]); ?></title>
    <meta name="Keywords" content="p2p理财，互联网金融，投资理财产品，个人投资理财，短期理财" />
    <meta name="description" content="互联网投资理财金融服务p2p平台">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <link rel="stylesheet" href="/Style/new/css/main.css">
    <link rel="stylesheet" href="/Style/new/css/common.css" />
    <link rel="stylesheet" href="__ROOT__/Style/H/css/registerstyle.css" />
    <style>
        #tableTestpwd{
            width:317px;
        }
        .user-lr-box .field .frbox {
            width: 570px;
        }
    </style>
    <script type="text/javascript">
        var imgpath = "__ROOT__/Style/M/";
        var curpath = "__URL__";
    </script>
    <script src="/Style/new/js/jquery-1.7.2.js" type=text/javascript></script>
    <link type="text/css" rel="stylesheet" href="/Style/JBox/Skins/Currently/jbox.css" />
    <script src="/Style/JBox/jquery.jBox.min.js" type="text/javascript"></script>
    <script src="/Style/JBox/jquery.jBoxConfig.js" type="text/javascript"></script>
    <script type="text/javascript" src="__ROOT__/Style/M/js/reg.js"></script>
    <script type="text/javascript" src="__ROOT__/Style/js/strength.js"></script>
    <script type="text/javascript" src="__ROOT__/Style/js/autoMail.js"></script>
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
	<div class="slogan"><p>欢迎注册票据钱柜</p></div>
    <div class="zhuce">
        <div class="zhuce_l">
            <div class="user-lr-box f_l bddf brc" style="width:590px">
                <!--手机和邮箱注册表单-->
                <div class="pl15 pr15">
                    <div class="user-lr-box-tit  bb1">
                        <div class="yonghu"><a href="__APP__/index.html" style="color:#0099ff; font-size:16px; font-weight:bold">返回首页</a></div>
                        <div class="blank0"></div>
                    </div>
                </div>
                <form action="#" method="post" id="signup-user-form" autocomplete="off">
                    <div class="userstyle">
                        <div class="form-group">用户身份 : </div>
                        <div class="union">
                            <label class="ui-radiobox" rel="common_user_type"><input type="radio" name="user_type" value="0" checked="checked" /><span>个人</span></label>
                            <label class="ui-radiobox" rel="common_user_type"><input type="radio" name="user_type" value="1" /><span>企业</span></label>
                        </div>
                    </div>
                    <div class="blank10"></div>
                    

                    <div class="field mobile">
                        <div class="f_l frbox pr">
                            <div class="u_icon">
                                <i class="iconfont">用户名</i>
                            </div>
                            <input type="text" value="" placeholder="输入用户名" class="f-input ui-textbox" id="txtUser" size="30" />
                            <div id="dvUser" class="dv_r_4_3"></div>
                                
                            </div>
                        <div class="blank0"></div>
                    </div>
                    <div class="blank10"></div>
                    <!--<div class="field verify">
                        <div class="f_l frbox pr">
                            <input type="text" value="" class="f-input ui-textbox" name="sms_code">
                            <input type="button" value="获取验证码" class="sendsms_button f_l btn_disable" id="get_regsms_code" class="ml5 f_l" />
                            <span class="f-input-tip"></span>
                            <span class="hint"> 输入收到的手机验证码</span>
                        </div>
                        <div class="blank0"></div>
                    </div>
                    <div class="blank10"></div>-->

                    <div class="field password">
                        <div class="f_l frbox pr">
                            <div class="u_icon">
                                <i class="iconfont">密码</i>
                            </div>
                            <input type="password" class="f-input ui-textbox" placeholder="输入密码" id="txtPwd" size="30" onkeyup="pwStrength(this.value)" onblur="pwStrength(this.value)" />
                            <div id="dvPwd" class="dv_r_4_3">
                            </div>
                            <input type="hidden" id="signup-password-ipt" name="user_pwd">
                            
                        </div>
                        <div class="blank0"></div>
                    </div>
                    <div class="field password">
                        <div class="f_l frbox pr">
                            <div class="u_icon">
                                <i class="iconfont">密码强度</i>
                            </div>
                            <table border="0" class="f-input ui-textbox" id="tableTestpwd" cellpadding="0" cellspacing="0" style="float:left;">
                                <tr style="align-content:center;">
                                    <td width="30%" id="strength_L" bgcolor="#f5f5f5" style="text-align:center">弱</td>
                                    <td width="30%" id="strength_M" bgcolor="#f5f5f5" style="text-align:center">中</td>
                                    <td width="30%" id="strength_H" bgcolor="#f5f5f5" style="text-align:center">强</td>
                                </tr>
                            </table>
                            <div class="dv_r_4_3"></div>
                            
                        </div>
                        <div class="blank0"></div>
                    </div>
                    <div class="blank10"></div>
                    <div class="field password">
                        <div class="f_l frbox pr">
                            <div class="u_icon">
                                <i class="iconfont">确认密码</i>
                            </div>
                            <input type="password" class="f-input ui-textbox" placeholder="再次输入密码" id="txtRepwd" size="30" />
                            <div id="dvRepwd" class="dv_r_4_3">
                            </div>
                            
                        </div>
                        <div class="blank0"></div>
                    </div>

                    <div class="blank10"></div>
                    <div class="field weibo ">
                        <div class="f_l frbox pr">
                            <div class="u_icon">
                                <i class="iconfont">推荐人</i>
                            </div>
                            <input type="text" placeholder="输入推荐人会员名" class="f-input ui-textbox" id="txtRec" value="<?php echo ($user_name['user_name']); ?>" /><div id="dvRec" class="dv_r_4_3"></div>
                            <span class="hint">填写推荐人用户名，没有推荐人可不填。</span>
                        </div>
                        <div class="blank0"></div>
                    </div>
                    <div class="blank10"></div>
					<div class="field username">
                        <div class="f_l frbox pr">
                            <div class="u_icon">
                                <i class="iconfont">常用邮箱</i>
                            </div>
                            <input type="text" value="" class="f-input ui-textbox" placeholder="输入常用邮箱" id="txtEmail" size="30" />                            
                            <div id="dvEmail" class="dv_r_4_3">
                            </div>
                            
                        </div>
                        <div class="blank0"></div>
                    </div>
                    <div class="blank10"></div>
                    <!-- 验证码-->
                    <div class="field username ">
                        <div class="f_l pr">
                            <div class="u_icon"><i class="iconfont">验证码</i></div>
                            <input type="text" value="" class="f-input ui-textbox" placeholder="验证码" id="txtCode" name="email" size="30" tabindex="3" />
                            <img onclick="this.src=this.src+'?t='+Math.random()" id="imVcode" alt="点击换一个校验码" style=" width: auto; height:auto;border: 1px solid #ccc;" src="__URL__/verify" /> <a href="javascript:document.getElementById('imVcode').onclick();">刷新</a>
                            <div id="dvCode" class="dv_r_4_3"></div>
                        </div>
                        <div class="blank0"></div>
                    </div>
                    <div class="blank10"></div>

                    <div class="field agreementf14">
                        <label>&nbsp;</label>
                        <label class="ui-checkbox mt5"  style="float:left!important;">
                            <input type="checkbox" name="agreement" id="J_agreement" value="1" checked="checked" /> 同意 <a href="__APP__/aboutus/ruleserver.html" target="_blank" class="f_blue">《票据钱柜平台网站服务协议》</a>
                        </label>
                        <div class="f_l">
                            
                        </div>
                        <div class="blank0"></div>
                    </div>

                    <div class="blank10"></div>

                    <div class="act">
                        <input type="button" class="btn_green w180 f_white f18 b p10 bdr3 reg-submit-btn" id="signup-mobile-submit" name="commit" value="注册" onclick="RegSubmit(this);" />
                    </div>
                    <div class="blank20"></div>
					
                </form>
            </div>
        </div>
		
        <div class="zhuce_r">
            <div class="yiyou">已有票据钱柜账号，<span><a href="/member/common/login/">立即登陆</a></span></div><p>&nbsp;</p>
			<div class="login-pic"><img src="/Style/new/images/faq.jpg" /></div>
        </div>
		

    </div>
	
	
    <script type="text/javascript">
        function closeAction() {
            window.location.href = "__APP__/member/";
        }
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
        $(document).ready(function () {
            $('#txtEmail').autoMail({
                emails: ['qq.com', '163.com', '126.com', 'sina.com', 'sohu.com', 'yahoo.cn', 'gmail.com', 'hotmail.com', 'live.cn']
            });
        });
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