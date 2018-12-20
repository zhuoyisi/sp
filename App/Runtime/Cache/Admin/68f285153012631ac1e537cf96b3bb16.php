<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo ($ts['site']['site_name']); ?>管理后台</title>
<link href="__ROOT__/Style/A/css/style.css" rel="stylesheet" type="text/css">
<link href="__ROOT__/Style/A/js/tbox/box.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="__ROOT__/Style/JBox/Skins/Blue/jbox.css"/><!-- `mxl:teamreward` --><!-- 2014.10.13增补 -->
<script type="text/javascript" src="__ROOT__/Style/A/js/jquery.js"></script>
<script type="text/javascript" src="__ROOT__/Style/A/js/common.js"></script>
<script type="text/javascript" src="__ROOT__/Style/A/js/tbox/box.js"></script>
<script type="text/javascript" src="/Style/My97DatePicker/WdatePicker.js" language="javascript"></script>
<script  src="__ROOT__/Style/JBox/jquery.jBox.min.js" type="text/javascript"></script><!-- `mxl:teamreward` -->
<script  src="__ROOT__/Style/JBox/jquery.jBoxConfig.js" type="text/javascript"></script><!-- `mxl:teamreward` -->
</head>
<body>

<div class="so_main">

<div class="page_tit">支付方式管理</div>
<div class="page_tab"><span data="tab_1"  class="active">丰付支付</span><span data="tab_2">宝付</span><span data="tab_3">易生支付</span><span data="tab_4">汇潮支付</span><span data="tab_5">环迅支付</span><span data="tab_6">网银在线</span><span data="tab_7">财付通</span><span data="tab_8">国付宝</span><span data="tab_9">通联支付</span><span data="tab_10">新浪微支付</span><span data="tab_11">中国移动支付</span><span data="tab_12">双乾支付</span></div>
<div class="form2">
	<form method="post" action="__URL__/save" onsubmit="return subcheck();" enctype="multipart/form-data">
	<!--丰付-->
	<div id="tab_1">
		<dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="pay[sumapay][enable]" value="<?php echo ($k); ?>" id="pay[sumapay][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$sumapay_config["enable"]==$k)||("key"=="value"&&$sumapay_config["enable"]==$v)){ ?><input type="radio" name="pay[sumapay][enable]" value="<?php echo ($k); ?>" id="pay[sumapay][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="pay[sumapay][enable]" value="<?php echo ($k); ?>" id="pay[sumapay][enable]_<?php echo ($i); ?>" /><?php } ?><label for="pay[sumapay][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
		<dl class="lineD"><dt>充值手续费：</dt><dd><input name="pay[sumapay][feerate]" id="pay[sumapay][feerate]"  class="input" type="text" value="<?php echo ($sumapay_config["feerate"]); ?>" ><span id="tip_pay[sumapay][feerate]" class="tip">%</span></dd></dl>
		<dl class="lineD"><dt>商户号：</dt><dd><input name="pay[sumapay][merAcct]" id="pay[sumapay][merAcct]"  class="input" type="text" value="<?php echo ($sumapay_config["merAcct"]); ?>" ><span id="tip_pay[sumapay][merAcct]" class="tip">*</span></dd></dl>
		<dl class="lineD"><dt>支付密钥：</dt><dd><input name="pay[sumapay][merKey]" id="pay[sumapay][merKey]"  class="input" type="text" value="<?php echo ($sumapay_config["merKey"]); ?>" ><span id="tip_pay[sumapay][merKey]" class="tip">*</span></dd></dl>
		<dl class="lineD"><dt>业务类型代码：</dt><dd><input name="pay[sumapay][bizType]" id="pay[sumapay][bizType]"  class="input" type="text" value="<?php echo ($sumapay_config["bizType"]); ?>" ><span id="tip_pay[sumapay][bizType]" class="tip">*</span></dd></dl>
	</div>
	<!--丰付-->
	<!--宝付-->
	<div id="tab_2" style="display:none">
		<dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="pay[baofoo][enable]" value="<?php echo ($k); ?>" id="pay[baofoo][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$baofoo_config["enable"]==$k)||("key"=="value"&&$baofoo_config["enable"]==$v)){ ?><input type="radio" name="pay[baofoo][enable]" value="<?php echo ($k); ?>" id="pay[baofoo][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="pay[baofoo][enable]" value="<?php echo ($k); ?>" id="pay[baofoo][enable]_<?php echo ($i); ?>" /><?php } ?><label for="pay[baofoo][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
		<dl class="lineD"><dt>充值手续费：</dt><dd><input name="pay[baofoo][feerate]" id="pay[baofoo][feerate]"  class="input" type="text" value="<?php echo ($baofoo_config["feerate"]); ?>" ><span id="tip_pay[baofoo][feerate]" class="tip">%</span></dd></dl>
		<dl class="lineD"><dt>商户号：</dt><dd><input name="pay[baofoo][MemberID]" id="pay[baofoo][MemberID]"  class="input" type="text" value="<?php echo ($baofoo_config["MemberID"]); ?>" ><span id="tip_pay[baofoo][MemberID]" class="tip">*</span></dd></dl>
		<dl class="lineD"><dt>终端号：</dt><dd><input name="pay[baofoo][TerminalID]" id="pay[baofoo][TerminalID]"  class="input" type="text" value="<?php echo ($baofoo_config["TerminalID"]); ?>" ><span id="tip_pay[baofoo][TerminalID]" class="tip">*</span></dd></dl>
		<dl class="lineD"><dt>商户证书：</dt><dd><input name="pay[baofoo][pkey]" id="pay[baofoo][pkey]"  class="input" type="text" value="<?php echo ($baofoo_config["pkey"]); ?>" ><span id="tip_pay[baofoo][pkey]" class="tip">*</span></dd></dl>
	</div>
	<!--宝付-->
	<!--易生支付-->
	<div id="tab_3" style="display:none">
		<dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="pay[easypay][enable]" value="<?php echo ($k); ?>" id="pay[easypay][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$easypay_config["enable"]==$k)||("key"=="value"&&$easypay_config["enable"]==$v)){ ?><input type="radio" name="pay[easypay][enable]" value="<?php echo ($k); ?>" id="pay[easypay][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="pay[easypay][enable]" value="<?php echo ($k); ?>" id="pay[easypay][enable]_<?php echo ($i); ?>" /><?php } ?><label for="pay[easypay][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
		<dl class="lineD"><dt>充值手续费：</dt><dd><input name="pay[easypay][feerate]" id="pay[easypay][feerate]"  class="input" type="text" value="<?php echo ($easypay_config["feerate"]); ?>" ><span id="tip_pay[easypay][feerate]" class="tip">%</span></dd></dl>
		<dl class="lineD"><dt>商户开户邮箱：</dt><dd><input name="pay[easypay][seller_email]" id="pay[easypay][seller_email]"  class="input" type="text" value="<?php echo ($easypay_config["seller_email"]); ?>" ><span id="tip_pay[easypay][seller_email]" class="tip">商户开户时注册用的Email邮箱</span></dd></dl>
		<dl class="lineD"><dt>商户号：</dt><dd><input name="pay[easypay][partner]" id="pay[easypay][partner]"  class="input" type="text" value="<?php echo ($easypay_config["partner"]); ?>" ></dd></dl>
		<dl class="lineD"><dt>支付密钥：</dt><dd><input name="pay[easypay][key]" id="pay[easypay][key]"  class="input" type="text" value="<?php echo ($easypay_config["key"]); ?>" ></dd></dl>
		</div>
	<!--易生支付-->
	<!--汇潮支付-->
	<div id="tab_4" style="display:none">
		<dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="pay[ecpss][enable]" value="<?php echo ($k); ?>" id="pay[ecpss][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$ecpss_config["enable"]==$k)||("key"=="value"&&$ecpss_config["enable"]==$v)){ ?><input type="radio" name="pay[ecpss][enable]" value="<?php echo ($k); ?>" id="pay[ecpss][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="pay[ecpss][enable]" value="<?php echo ($k); ?>" id="pay[ecpss][enable]_<?php echo ($i); ?>" /><?php } ?><label for="pay[ecpss][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
		<dl class="lineD"><dt>充值手续费：</dt><dd><input name="pay[ecpss][feerate]" id="pay[ecpss][feerate]"  class="input" type="text" value="<?php echo ($ecpss_config["feerate"]); ?>" ><span id="tip_pay[ecpss][feerate]" class="tip">%</span></dd></dl>
		<dl class="lineD"><dt>商户号：</dt><dd><input name="pay[ecpss][MerNo]" id="pay[ecpss][MerNo]"  class="input" type="text" value="<?php echo ($ecpss_config["MerNo"]); ?>" ><span id="tip_pay[ecpss][MerNo]" class="tip">*</span></dd></dl>
		<dl class="lineD"><dt>支付密钥：</dt><dd><input name="pay[ecpss][MD5key]" id="pay[ecpss][MD5key]"  class="input" type="text" value="<?php echo ($ecpss_config["MD5key"]); ?>" ><span id="tip_pay[ecpss][MD5key]" class="tip">*</span></dd></dl>
	</div>
	<!--汇潮支付-->
	<!--环讯支付-->
	<div id="tab_5" style="display:none">
		<dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="pay[ips][enable]" value="<?php echo ($k); ?>" id="pay[ips][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$ips_config["enable"]==$k)||("key"=="value"&&$ips_config["enable"]==$v)){ ?><input type="radio" name="pay[ips][enable]" value="<?php echo ($k); ?>" id="pay[ips][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="pay[ips][enable]" value="<?php echo ($k); ?>" id="pay[ips][enable]_<?php echo ($i); ?>" /><?php } ?><label for="pay[ips][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
		<dl class="lineD"><dt>充值手续费：</dt><dd><input name="pay[ips][feerate]" id="pay[ips][feerate]"  class="input" type="text" value="<?php echo ($ips_config["feerate"]); ?>" ><span id="tip_pay[ips][feerate]" class="tip">%</span></dd></dl>
		<dl class="lineD"><dt>商户号：</dt><dd><input name="pay[ips][MerCode]" id="pay[ips][MerCode]"  class="input" type="text" value="<?php echo ($ips_config["MerCode"]); ?>" ><span id="tip_pay[ips][MerCode]" class="tip">*</span></dd></dl>
		<dl class="lineD"><dt>商户证书：</dt><dd><input name="pay[ips][MerKey]" id="pay[ips][MerKey]"  class="input" type="text" value="<?php echo ($ips_config["MerKey"]); ?>" ><span id="tip_pay[ips][MerKey]" class="tip">*</span></dd></dl>
	</div>
	<!--环讯支付-->
	<!--网银在线-->
	<div id="tab_6" style="display:none">
		<dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="pay[chinabank][enable]" value="<?php echo ($k); ?>" id="pay[chinabank][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$chinabank_config["enable"]==$k)||("key"=="value"&&$chinabank_config["enable"]==$v)){ ?><input type="radio" name="pay[chinabank][enable]" value="<?php echo ($k); ?>" id="pay[chinabank][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="pay[chinabank][enable]" value="<?php echo ($k); ?>" id="pay[chinabank][enable]_<?php echo ($i); ?>" /><?php } ?><label for="pay[chinabank][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
		<dl class="lineD"><dt>充值手续费：</dt><dd><input name="pay[chinabank][feerate]" id="pay[chinabank][feerate]"  class="input" type="text" value="<?php echo ($chinabank_config["feerate"]); ?>" ><span id="tip_pay[chinabank][feerate]" class="tip">%</span></dd></dl>
		<dl class="lineD"><dt>商户号：</dt><dd><input name="pay[chinabank][mid]" id="pay[chinabank][mid]"  class="input" type="text" value="<?php echo ($chinabank_config["mid"]); ?>" ></dd></dl>
		<dl class="lineD"><dt>MD5密钥：</dt><dd><input name="pay[chinabank][mkey]" id="pay[chinabank][mkey]"  class="input" type="text" value="<?php echo ($chinabank_config["mkey"]); ?>" ></dd></dl>
	</div>
	<!--网银在线-->
	
	<!--财付通-->
	<div id="tab_7" style="display:none">
		<dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="pay[tenpay][enable]" value="<?php echo ($k); ?>" id="pay[tenpay][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$tenpay_config["enable"]==$k)||("key"=="value"&&$tenpay_config["enable"]==$v)){ ?><input type="radio" name="pay[tenpay][enable]" value="<?php echo ($k); ?>" id="pay[tenpay][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="pay[tenpay][enable]" value="<?php echo ($k); ?>" id="pay[tenpay][enable]_<?php echo ($i); ?>" /><?php } ?><label for="pay[tenpay][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
		<dl class="lineD"><dt>充值手续费：</dt><dd><input name="pay[tenpay][feerate]" id="pay[tenpay][feerate]"  class="input" type="text" value="<?php echo ($tenpay_config["feerate"]); ?>" ><span id="tip_pay[tenpay][feerate]" class="tip">%</span></dd></dl>
		<dl class="lineD"><dt>商户号：</dt><dd><input name="pay[tenpay][partner]" id="pay[tenpay][partner]"  class="input" type="text" value="<?php echo ($tenpay_config["partner"]); ?>" ><span id="tip_pay[tenpay][partner]" class="tip">*</span></dd></dl>
		<dl class="lineD"><dt>支付密钥：</dt><dd><input name="pay[tenpay][key]" id="pay[tenpay][key]"  class="input" type="text" value="<?php echo ($tenpay_config["key"]); ?>" ><span id="tip_pay[tenpay][key]" class="tip">*</span></dd></dl>
	</div>
	<!--财付通-->
	<!--国付宝-->
	<div id="tab_8"  style="display:none">
		<dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="pay[guofubao][enable]" value="<?php echo ($k); ?>" id="pay[guofubao][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$guofubao_config["enable"]==$k)||("key"=="value"&&$guofubao_config["enable"]==$v)){ ?><input type="radio" name="pay[guofubao][enable]" value="<?php echo ($k); ?>" id="pay[guofubao][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="pay[guofubao][enable]" value="<?php echo ($k); ?>" id="pay[guofubao][enable]_<?php echo ($i); ?>" /><?php } ?><label for="pay[guofubao][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
		<dl class="lineD"><dt>充值手续费：</dt><dd><input name="pay[guofubao][feerate]" id="pay[guofubao][feerate]"  class="input" type="text" value="<?php echo ($guofubao_config["feerate"]); ?>" ><span id="tip_pay[guofubao][feerate]" class="tip">%</span></dd></dl>
		<dl class="lineD"><dt>商户代码：</dt><dd><input name="pay[guofubao][merchantID]" id="pay[guofubao][merchantID]"  class="input" type="text" value="<?php echo ($guofubao_config["merchantID"]); ?>" ></dd></dl>
		<dl class="lineD"><dt>商户识别码：</dt><dd><input name="pay[guofubao][VerficationCode]" id="pay[guofubao][VerficationCode]"  class="input" type="text" value="<?php echo ($guofubao_config["VerficationCode"]); ?>" ></dd></dl>
		<dl class="lineD"><dt>国付宝帐号：</dt><dd><input name="pay[guofubao][virCardNoIn]" id="pay[guofubao][virCardNoIn]"  class="input" type="text" value="<?php echo ($guofubao_config["virCardNoIn"]); ?>" ></dd></dl>
	</div>
	<!--国付宝-->
	<!--通联-->
	<div id="tab_9" style="display:none">
		<dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="pay[allinpay][enable]" value="<?php echo ($k); ?>" id="pay[allinpay][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$allinpay_config["enable"]==$k)||("key"=="value"&&$allinpay_config["enable"]==$v)){ ?><input type="radio" name="pay[allinpay][enable]" value="<?php echo ($k); ?>" id="pay[allinpay][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="pay[allinpay][enable]" value="<?php echo ($k); ?>" id="pay[allinpay][enable]_<?php echo ($i); ?>" /><?php } ?><label for="pay[allinpay][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
		<dl class="lineD"><dt>充值手续费：</dt><dd><input name="pay[allinpay][feerate]" id="pay[allinpay][feerate]"  class="input" type="text" value="<?php echo ($allinpay_config["feerate"]); ?>" ><span id="tip_pay[allinpay][feerate]" class="tip">%</span></dd></dl>
		<dl class="lineD"><dt>商户号：</dt><dd><input name="pay[allinpay][MerCode]" id="pay[allinpay][MerCode]"  class="input" type="text" value="<?php echo ($allinpay_config["MerCode"]); ?>" ><span id="tip_pay[allinpay][MerCode]" class="tip">*</span></dd></dl>
		<dl class="lineD"><dt>商户key：</dt><dd><input name="pay[allinpay][key]" id="pay[allinpay][key]"  class="input" type="text" value="<?php echo ($allinpay_config["key"]); ?>" ><span id="tip_pay[allinpay][key]" class="tip">*</span></dd></dl>
	</div>
	<!--通联-->
	<!--新浪-->
	<div id="tab_10"  style="display:none">
		<dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="pay[sina][enable]" value="<?php echo ($k); ?>" id="pay[sina][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$sina_config["enable"]==$k)||("key"=="value"&&$sina_config["enable"]==$v)){ ?><input type="radio" name="pay[sina][enable]" value="<?php echo ($k); ?>" id="pay[sina][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="pay[sina][enable]" value="<?php echo ($k); ?>" id="pay[sina][enable]_<?php echo ($i); ?>" /><?php } ?><label for="pay[sina][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
		<dl class="lineD"><dt>充值手续费：</dt><dd><input name="pay[sina][feerate]" id="pay[sina][feerate]"  class="input" type="text" value="<?php echo ($sina_config["feerate"]); ?>" ><span id="tip_pay[sina][feerate]" class="tip">%</span></dd></dl>
		<dl class="lineD"><dt>人民币账号：</dt><dd><input name="pay[sina][merchantAcctId]" id="pay[sina][merchantAcctId]"  class="input" type="text" value="<?php echo ($sina_config["merchantAcctId"]); ?>" ></dd></dl>
		<dl class="lineD"><dt>商户识别码：</dt><dd><input name="pay[sina][pid]" id="pay[sina][pid]"  class="input" type="text" value="<?php echo ($sina_config["pid"]); ?>" ></dd></dl>
		<dl class="lineD"><dt>密钥：</dt><dd><input name="pay[sina][key]" id="pay[sina][key]"  class="input" type="text" value="<?php echo ($sina_config["key"]); ?>" ></dd></dl>
	</div>
	<!--新浪-->
	<!--中国移动-->
	<div id="tab_11" style="display:none">
		<dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="pay[cmpay][enable]" value="<?php echo ($k); ?>" id="pay[cmpay][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$cmpay_config["enable"]==$k)||("key"=="value"&&$cmpay_config["enable"]==$v)){ ?><input type="radio" name="pay[cmpay][enable]" value="<?php echo ($k); ?>" id="pay[cmpay][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="pay[cmpay][enable]" value="<?php echo ($k); ?>" id="pay[cmpay][enable]_<?php echo ($i); ?>" /><?php } ?><label for="pay[cmpay][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
		<dl class="lineD"><dt>充值手续费：</dt><dd><input name="pay[cmpay][feerate]" id="pay[cmpay][feerate]"  class="input" type="text" value="<?php echo ($cmpay_config["feerate"]); ?>" ><span id="tip_pay[cmpay][feerate]" class="tip">%</span></dd></dl>
		<dl class="lineD"><dt>商户号：</dt><dd><input name="pay[cmpay][merchantId]" id="pay[cmpay][merchantId]"  class="input" type="text" value="<?php echo ($cmpay_config["merchantId"]); ?>" ><span id="tip_pay[cmpay][merchantId]" class="tip">*</span></dd></dl>
		<dl class="lineD"><dt>支付密钥：</dt><dd><input name="pay[cmpay][serverCert]" id="pay[cmpay][serverCert]"  class="input" type="text" value="<?php echo ($cmpay_config["serverCert"]); ?>" ><span id="tip_pay[cmpay][serverCert]" class="tip">*</span></dd></dl>
	</div>
	<!--中国移动-->
	<div id="tab_12" style="display:none">
        <dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="pay[95epay][enable]" value="<?php echo ($k); ?>" id="pay[95epay][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$epay_config["enable"]==$k)||("key"=="value"&&$epay_config["enable"]==$v)){ ?><input type="radio" name="pay[95epay][enable]" value="<?php echo ($k); ?>" id="pay[95epay][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="pay[95epay][enable]" value="<?php echo ($k); ?>" id="pay[95epay][enable]_<?php echo ($i); ?>" /><?php } ?><label for="pay[95epay][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
        <dl class="lineD"><dt>充值手续费：</dt><dd><input name="pay[95epay][feerate]" id="pay[95epay][feerate]"  class="input" type="text" value="<?php echo ($epay_config["feerate"]); ?>" ><span id="tip_pay[95epay][feerate]" class="tip">%</span></dd> </dl>
        <dl class="lineD"><dt>商户号：</dt><dd><input name="pay[95epay][MerCode]" id="pay[95epay][MerCode]"  class="input" type="text" value="<?php echo ($epay_config["MerCode"]); ?>" ><span id="tip_pay[95epay][MerCode]" class="tip">*</span></dd></dl>
        <dl class="lineD"><dt>商户证书：</dt><dd><input name="pay[95epay][MerKey]" id="pay[95epay][MerKey]"  class="input" type="text" value="<?php echo ($epay_config["MerKey"]); ?>" ><span id="tip_pay[95epay][MerKey]" class="tip">*</span></dd> </dl>
      </div>
	
	<div class="page_btm">
	  <input type="submit" class="btn_b" value="确定" /><span style="color:#CCCCCC">(所有方式修改提交一次即可)</span>
	</div>
	</form>
</div>

</div>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>