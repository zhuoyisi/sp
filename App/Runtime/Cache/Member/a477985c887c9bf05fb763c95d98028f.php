<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>票据钱柜投资协议-<?php echo ($glo["web_name"]); ?></title>
<style>
  .Lending_Agreement {
  	width:100%;
  	height:auto;
  	margin:0px;
  	padding:0px;
  }
  .Lending_Agreement_center {
  	width:1024px;
  	height:auto;
  	margin:0 auto;
  	border:1px solid #EEEEEE;
  }
  .lending_ageeement_tit {
  	width:960px;
  	height:45px;
  	line-height:45px;
  	color:#666666;
  	font-family:Arial, Helvetica, sans-serif;
  	font-size:28px;
  	font-weight:bold;
  	text-align:center;
  	margin:0 auto;
  	margin-top:30px;
  	border-bottom:1px solid #EEEEEE;
  }
  .ageeement_content {
  	width:1000px;
  	height:auto;
  	margin:0 auto;
  	margin-top:30px;
  	font-size:18px;
  	font-weight:bold;
  	color:#666666;
  	overflow:auto;
  	font-family:Arial, Helvetica, sans-serif;
  }
  .ageeement_content h3 {
  	font-size:18px;
  	font-weight:bold;
  	color:#666666;
  	font-family:Arial, Helvetica, sans-serif;
  	padding-left:10px;
  }
  .font_lendig {
  	font-size:22px;
  	font-weight:bold;
  	color:#666666;
  	font-family:Arial, Helvetica, sans-serif;
  	padding-left:10px;
  	margin-bottom:10px;
  	display:block;
  	margin-top:20px;
  }
  .ageeement_content p {
  	line-height:26px;
  	font-family:Tahoma, Geneva, sans-serif;
  	font-size:20px;
  	color:#666666;
  	margin:0px;
  	font-weight:normal;
  	padding-left:10px;
  	margin-top:6px;
  }
  .ageement_tab {
  	height:40px;
  	line-height:40px;
  }
  .ageement_tab_ite {
  	height:40px;
  	line-height:40px;
  	font-weight:normal;
  }
  .lending_top_inf {
  	width:1000px;
  	height:auto;
  	margin-left:10px;
  }
  .lending_logo {
  	width:1000px;
  	height:100px;
  	border-bottom:2px solid #EEEEEE;
  }
  .lenging_left_logo {
  	width:252px;
  	height:100px;
  	float:left;
  	border-bottom:2px solid #00ADEE;
  }
  .name_inf {
  	width:400px;
  	height:65px;
  	float:left;
  	margin-left:40px;
  	margin-top:2px;
  }
  .lenging_right_inf {
  	width:260px;
  	height:50px;
  	float:left;
  	margin-top:9px;
  }
  .lenging_right_inf ul {
  	margin:0px;
  	padding:0px;
  }
  .lenging_right_inf ul li {
  	width:400px;
  	height:25px;
  	line-height:25px;
  	font-family:Arial, Helvetica, sans-serif;
  	font-size:20px;
  	color:#999999;
  	list-style:none;
  	float:left;
  	padding-left:0px;
  }
  .lenging_right_inf ul li a {
  	color:#999999;
  	text-decoration:none;
  }
  .lenging_right_inf ul li a:hover {
  	color:#FF9900;
  	text-decoration:none;
  }
  .Seal {
  	width:auto;
  	height:auto;
  	margin-right:20px;
  	float:right;
  	text-align:center;
  }
  .seal_text {
  	font-family:Arial, Helvetica, sans-serif;
  	font-size:20px;
  	color:#999999;
  	margin-top:6px;
  	margin-bottom:40px;
  	display:block;
  	font-weight:normal;
  }
  .Agreement_pic {
  	width:200px;
  	height:45px;
  	margin:0 auto;
  }
  a,a:visited{color: #E67714; text-decoration:none;}
</style>
<script type="text/javascript" language="javascript">
	function printht(){
		window.print();
	} 
</script>
</head>
<body>
<div class="Lending_Agreement">
  <div class="Lending_Agreement_center">
    <!--顶部信息开始-->
    <div class="lending_top_inf">
      <div class="lending_logo">
        <div class="lenging_left_logo"><a href="/" target="_blank"><?php echo get_ad(1);?></a></div>
        <div class="name_inf"></div>
        <div class="lenging_right_inf">
          <ul>
            <li class="tel400"><!-- <?php echo get_ad(3);?> -->
              </p>
          </ul>
        </div>
      </div>
    </div>
    <!--顶部信息结束-->
    <div class="lending_ageeement_tit"><span class="Agreement_pic">借款合同</span><span style="float:right; padding-right:10px;"><a href="javascrīpt:void(0);" onclick="printht();" target="_self"><img src="/Style/ad_right/dayin.png" border="0" width="40px" height="20px"></a> </span></div>
	<p align="middle">合同编号：<u><strong>PJQG<?php echo (date("Ymd",$iinfo["add_time"])); echo ($iinfo['id']); ?></strong></u> </p>
    <div class="ageeement_content">
	 <p>甲方（出借人）：<u><?php echo (($mInvest["real_name"])?($mInvest["real_name"]):'未填写'); ?></u></p>
	 <p>乙方（借款人）：<u><?php echo (($mBorrow["real_name"])?($mBorrow["real_name"]):'未填写'); ?></u></p>
	 <p>丙方（见证人/服务商）：<u>山东今劢供应链管理有限公司</u></p>
	 <p>丁方（担保方）：<u>山东同济融资担保股份有限公司</u></p>
	 <!--<p>鉴于：<br /></p>-->
	 <p>甲方愿意接受丙方提供的投资咨询与管理服务，由丙方撮合甲方与乙方达成借贷交易，并由丙方提供与借款协议的履行有关的其他服务，丙方愿意向甲方提供该等服务。</p>
	  <p>乙方通过山东今劢供应链管理有限公司旗下票据钱柜网站 ( www.piaojuqiangui.com) 的居间,就有关借款事项与甲方各出借人达成如下协议：</p>
	 <strong class="font_lendig">第一条 投资信息 </strong>
	 <table  width="980" border="1px" bordercolor="#EEEEEE" cellspacing="0px" style="border-collapse:collapse;margin-top:20px;margin-left:10px;">
        <tr class="ageement_tab">
          <td width="196" height="40" align="center" valign="middle">真实姓名</td>
          <td width="196" height="40" align="center" valign="middle"><?php echo ($glo["web_name"]); ?>帐户 </td>
		   <td width="196" height="40" align="center" valign="middle">投资期数</td>
          <td width="196" height="40" align="center" valign="middle">借出金额</td>
		  <td width="196" height="40" align="center" valign="middle">年利率</td>
          <td width="196" height="40" align="center" valign="middle">借款期限</td>
          <td width="196" height="40" align="center" valign="middle">应收利息</td>
		  <td width="196" height="40" align="center" valign="middle">本息</td>
        </tr>
		<?php if(is_array($detailinfo)): $i = 0; $__LIST__ = $detailinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="ageement_tab_ite">
          <td width="196" height="40" align="center" valign="middle"><?php echo ($mInvest["real_name"]); ?></td>
          <td width="196" height="40" align="center" valign="middle"><?php echo session('u_user_name');?></td>
		  <td width="196" height="40" align="center" valign="middle"><?php echo ($binfo["borrow_name"]); ?></td>
          <td width="196" height="40" align="center" valign="middle"><?php echo ($vo["capital"]); ?></td>
		  <td width="196" height="40" align="center" valign="middle"><?php echo ($binfo["borrow_interest_rate"]); ?>%</td>
          <td width="196" height="40" align="center" valign="middle"><?php echo ($binfo["borrow_duration"]); ?>
          <?php if($binfo["repayment_type"] == 1): ?>天
            <?php else: ?>
            个月<?php endif; ?> </td>
          <td width="196" height="40" align="center" valign="middle"><?php echo ($vo['interest']-$vo['interest_fee']); ?></td>
		  <td width="196" height="40" align="center" valign="middle"><?php echo ($vo["benxi"]); ?></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </table>
	   <strong class="font_lendig">第二条 借款信息</strong>
	   <table width="980" border="1px" bordercolor="#EEEEEE" cellspacing="0px" style="border-collapse:collapse;margin-top:20px;margin-left:10px;">
        <tr class="ageement_tab">
          <td width="120" valign="top"><p align="left">借款总金额</p></td>
          <td width="379" valign="top"><p align="left"><?php echo ($binfo["borrow_money"]); ?></p></td>
        </tr>
		<tr class="ageement_tab">
          <td width="120" valign="top"><p align="left">借款期限</p></td>
          <td width="379" valign="top"><p align="left"><?php echo ($binfo["borrow_duration"]); ?>
          <?php if($binfo["repayment_type"] == 1): ?>天
            <?php else: ?>
            个月<?php endif; ?></p></td>
        </tr>
        <!--<tr class="ageement_tab">
          <td width="120" valign="top"><p align="left">借款期间</p></td>
          <td width="379" valign="top"><p align="left"><?php echo (date("Y年m月d日",$binfo["second_verify_time"])); ?>至<?php echo (date("Y年m月d日",$binfo["deadline"])); ?></p></td>
        </tr>-->
        <tr class="ageement_tab">
          <td width="120" valign="top"><p align="left">还款方式</p></td>
          <td width="379" valign="top"><p align="left"> 一次性还款 </p></td>
        </tr>
        <tr class="ageement_tab">
          <td width="120" valign="top"><p align="left">开始计息日</p></td>
          <td width="379" valign="top"><p align="left"><?php echo (date("Y年m月d日",$binfo["second_verify_time"])); ?></p></td>
        </tr>
        <tr class="ageement_tab">
          <td width="120" valign="top"><p align="left">还款日</p></td>
          <td width="379" valign="top"><p align="left"><?php echo (date("Y年m月d日",$binfo["deadline"])); ?></p></td>
        </tr>
		<tr class="ageement_tab">
          <td width="120" valign="top"><p align="left">借款用途及描述</p></td>
          <td width="379" valign="top"><p align="left"><?php echo ($binfo["borrow_info"]); ?></p></td>
        </tr>
      </table>
	   
	   <strong class="font_lendig">第三条 甲方权利和义务</strong>
      <!--<p> <font color="red">（注：因计算中存在四舍五入，最后一期应收本息与之前略有不同！）</font></p>-->
      <!--<p>借款人真实姓名：<u><?php echo (($mBorrow["real_name"])?($mBorrow["real_name"]):'未填写'); ?></u></p>
      <p><?php echo ($glo["web_name"]); ?>用户名：<u><?php echo ($mBorrow["user_name"]); ?></u></p>
      <p>&nbsp;</p>
     <p>担保方：<u><?php echo (($ht["name"])?($ht["name"]):'未填写'); ?></u></p>
      <p>运营地址：<u><?php echo (($ht["dizhi"])?($ht["dizhi"]):'未填写'); ?></u></p>
	  <p>担保方联系电话：<u><?php echo (($ht["tel"])?($ht["tel"]):'未填写'); ?></u></p>
	  <p>&nbsp;</p>
	  <p align="left">第三方平台：票据钱柜</p>
      <p>鉴于：<br />
      </p>
      <p>1.借款人通过由山东今劢供应链管理有限公司创办的网络借贷中介平台www.xyjrp2p.com（以下简称“票据钱柜”），向票据钱柜的注册会员借款，该借款由担保方为借款人提供担保；</p>
      <p>2.借款人已在该网站注册，并承诺其提供给担保方的信息是完全真实的；</p>
      <p>3.投资人承诺对本协议涉及的借款具有完全的支配能力，是其自有闲散资金，为其合法所得；并承诺其提供给担保方的信息是完全真实的；</p>
      <p>4.借款人有借款需求，投资人亦同意借款，双方有意成为借贷关系； <br />
      <p> 各方协商一致，签订如下协议，共同遵守，共同遵照履行：</p>-->
	  <p>1、甲方自愿注册成为票据钱柜网站投资用户，同意接受山东今劢供应链管理有限公司及票据钱柜提供的网络借贷中介服务，开通在线投资功能，即通过票据钱柜网站向该网站其他注册并开通在线借款功能的借款用户进行投资。</p>
      <p>2、甲方所提供的个人相关信息均真实性和合法，并保证投资资金来源的合法性，否则山东今劢供应链管理有限公司及山东同济融资担保股份有限公司不承担责任。
</p>
    <p>3、甲方开通投资业务前向山东今劢供应链管理有限公司及票据钱柜申请投资账号，第三方平台郑重提醒甲方注意密码的保存、保密。因甲方自身原因导致密码遗失、被窃或者泄露，甲方应立即进行密码修改，在密码确认无法找回的情况下，向山东今劢供应链管理有限公司及票据钱柜办理书面挂失手续，并承担由此造成的所有损失。
</p>
    <p>4、甲方已仔细阅读并充分理解山东今劢供应链管理有限公司及票据钱柜票据钱柜网站上登载的全部文件（包括但不限于服务协议、收费规则、借款协议、通知公告等文件），愿意完全遵守相关文件及其后续修订补充文件中的各项规定，并愿意按照山东今劢供应链管理有限公司及票据钱柜的收费规则及其他规定，支付相关费用。
</p>
 <p>5、甲方VIP会员有权获得山东同济融资担保股份有限公司100%的本息保障。</p>
   <p>6、甲方有权获得在山东今劢供应链管理有限公司及票据钱柜规定标准下的合法收益。 </p>
    <strong class="font_lendig">第四条 乙方权利和义务 </strong>
    <p> 1、乙方自愿注册成为票据钱柜网站借款用户，同意接受山东今劢供应链管理有限公司及票据钱柜提供的网络借贷中介服务，开通在线借款功能，即通过票据钱柜网站向该网站其他注册并开通在线出借功能的投资用户申请借款。
</p>
    <p>2、乙方保证所提供的个人相关信息都是真实的并保证借款用途是的合法性，否则山东今劢供应链管理有限公司及票据钱柜有权提前收回全部借款。 
</p>
    <p> 3、乙方已经完全知悉票据钱柜的费用规则及标准，并愿意按照山东今劢供应链管理有限公司及票据钱柜网站的收费规则、标准及其他规定，支付相关费用。
</p>
    <p> 4、乙方保证谨慎管理在票据钱柜注册的个人账户及密码，如因个人原因导致密码遗失、被窃或者泄露的，乙方会立即向山东今劢供应链管理有限公司及票据钱柜办理书面挂失手续，并承担由此造成的所有经济损失。
</p>
    <p> 5、乙方承诺按照本协议约定的时间和金额按期足额向甲方还款，如借款到期后未及时偿还借款本金及利息的，则按照票据钱柜关于逾期还款的相关罚则违约条款执行。同时，若乙方逾期后由山东同济融资担保股份有限公司垫付该笔借款，则视为投资者对乙方享有借款的到期债权依法转归山东同济融资担保股份有限公司所有，山东同济融资担保股份有限公司将该笔借款垫付给投资者之日起，山东同济融资担保股份有限公司即享有对乙方的依法追偿权，且视为将该债权转让或垫付事宜已通知乙方；同时乙方自愿承担山东同济融资担保股份有限公司对该笔借款追偿过程中所产生的各项费用（包括但不限于该笔借款的本金、利息、违约金、催收费、交通食宿费、律师代理费、诉讼费用等）。
</p>
    <strong class="font_lendig">第五条  丙方权利和义务 </strong>
    <p> 1、山东今劢供应链管理有限公司及票据钱柜致力于个人信息的保护，保护用户个人信息是山东今劢供应链管理有限公司及票据钱柜的一项基本原则。未经您的同意，山东今劢供应链管理有限公司及票据钱柜不会向本网站以外的任何公司、组织和个人披露您的个人信息，但逾期自动曝光和法律法规另有规定的除外。</p>
    <p>2、丙方有权向乙方收取双方约定的平台成交服务费。 
</p>
    <p>3、山东今劢供应链管理有限公司及票据钱柜有义务维持网站的正常运营并承担本协议中约定的责任，但因地震、台风、水灾、火灾、战争及其他不可抗力因素导致的损失，因票据钱柜不可预测或无法控制的系统故障、设备故障、通讯故障、停电等突发事故造成的损失，山东今劢供应链管理有限公司及票据钱柜不承担责任。
</p>
    <p> 4、山东今劢供应链管理有限公司及票据钱柜有义务对协议中其他三方的资料进行审核和监督，在违背《服务协议》、《借款协议》、《担保协议》或《投资协议书》等约定的条款时，山东今劢供应链管理有限公司及票据钱柜有权利宣布提前收回全部借款并采取其他措施。</p>
	<p>5、山东今劢供应链管理有限公司接受其他三方不涉及商业机密、不违反业务规定的合理合法的监督和建议。</p>
    <strong class="font_lendig">第六条   丁方权利和义务</strong>
    <p>丁方作为担保方，自愿为本合同项下借款人的借款承担连带担保责任， 担保的范围为借款本金、利息。当丁方履行了担保义务后，丁方有权在其承担担保责任的范围内向借款人追偿。
</p>
    <p>1、为确保乙方能按时还款，山东同济融资担保股份有限公司同意为乙方担保，担保方式为融资担保。
</p>
    <p>2、山东同济融资担保股份有限公司担保的范围包括乙方在山东今劢供应链管理有限公司及票据钱柜网站申请借款而产生的主债权本金、利息、罚息、复利、违约金、催收费用、损害赔偿金以及实现债权的费用（包括但不限于诉讼费、律师费、评估费等）。
</p>
    <p>3、保证期间，甲方依法将主债权转让给山东同济融资担保股份有限公司，山东同济融资担保股份有限公司在原保证担保的范围内对山东今劢供应链管理有限公司及票据钱柜承担保证责任。</p>
 
    <p>4、山东同济融资担保股份有限公司有义务向山东今劢供应链管理有限公司及票据钱柜如实提供财产和经营状况资料，并接受山东今劢供应链管理有限公司及票据钱柜对其资金和财产状况的监督。
</p>
	 <strong class="font_lendig">第七条   借款的支付和还款方式 </strong>
    <p>1、甲方同意向乙方出借相应款项时，已委托山东今劢供应链管理有限公司及票据钱柜在本借款协议生效时将该笔借款直接划付至乙方帐户。 
</p>
<p>2、乙方/担保方同意向甲方还款时，已委托山东今劢供应链管理有限公司及票据钱柜将还款直接划付甲方帐户。 </p>
<p>3、若乙方/担保方的任何一期还款不足以偿还应还本金、利息和违约金，则甲方之间同意按照各自出借金额在出借金额总额中的比例收取还款。 </p>
<p>4、本协议的履行地为山东今劢供应链管理有限公司及票据钱柜的住所地(山东省临沂市)。 </p>
	 <strong class="font_lendig">第八条   提前到期和提前偿还</strong>
    <p>1、各方同意，若乙方出现如下任何一种情况，则本协议项下的全部借款自动提前到期，乙方/担保方在收到山东今劢供应链管理有限公司及票据钱柜发出的借款提前到期通知后，应立即清偿全部本金、利息、逾期利息及根据协议产生的其他全部费用：
</p>
    <p>(1)乙方因任何原因逾期，逾期还款超过30天的； 
</p>
    <p>(2)乙方的工作单位、职务或住所变更后，未在30天内通知本网站； 
</p>
<p>(3)乙方发生影响其清偿本协议项下借款的其他不利变化，未在30天内通知本网站。
</p>
<p>2、各方同意，乙方有权提前清偿全部或者部分借款而不承担任何的违约责任(借款超过1日不足1个月者利息按足月计算)。
</p>
<p>3、本借款协议中的每一甲方与乙方之间的借款均是相互独立的，一旦乙方逾期未归还借款本息，任何一甲方有权单独对该甲方未收回的借款本息向乙方追索或者提起诉讼。 
</p>
	 <strong class="font_lendig">第九条   法律适用和争议解决</strong>
    <p>本合同受中华人民共和国法律管辖并按中华人民共和国法律解释。合同履行中发生争议，可由各方协商解决，协商不成可向被告所在地人民法院起诉。与票据钱柜平台有关的争议，向票据钱柜平台注册所在地人民法院起诉。
</p>
<strong class="font_lendig"> 第十条   特别条款 </strong>
<p>1、乙方/担保方保证，所借款项用于合法用途，不将所借款项用于任何违法活动(包括但不限于赌博、吸毒、贩毒、卖淫嫖娼等)及一切高风险投资(如证券期货、彩票等)。如违反前述保证或有违反前述保证的嫌疑，则甲方/山东今劢供应链管理有限公司及票据钱柜有权采取下列措施：</p>
    <p>（1）宣布提前收回全部借款； 
</p>
    <p> （2）向公安等有关司法机关举报，追回此款并追究乙方/担保方的刑事责任。
</p>
<p> 2、本网站仅作为网络借贷服务平台，乙方和甲方均不得利用山东今劢供应链管理有限公司及票据钱柜进行信用卡套现和其他洗钱等不正当交易行为，否则甲方、乙方或山东今劢供应链管理有限公司及票据钱柜有权向公安等有关司法机关举报，追究其相关法律责任。 
</p>
<strong class="font_lendig"> 第十一条   其他 </strong>
<p>1、本协议采用电子文本形式制成,并通过网站合同的形式发送至协议各方，各方均认可该形式的法律效力。</p>
    <p>2、本协议自乙方在山东今劢供应链管理有限公司及票据钱柜发布的借款标的审核成功之日即本协议题头标明的签订日起生效，甲方、乙方、山东今劢供应链管理有限公司及票据钱柜、山东同济融资担保股份有限公司各执一份,并具同等法律效力。  
</p>
    <p> 3、甲方、乙方在履行本协议过程中，应遵守山东今劢供应链管理有限公司及票据钱柜的各项规定。
</p>
<p>  4、甲方、乙方、担保方同意、授权或认可，山东今劢供应链管理有限公司及票据钱柜作为网络借款的中间平台根据本协议的规定和山东今劢供应链管理有限公司及票据钱柜的其他规定行使各项权利、发出各项通知或采取各项措施，一切法律后果和风险均由乙方或甲方承担。  
</p>
<p>5、山东今劢供应链管理有限公司及票据钱柜拥有对本协议的最终解释权。</p><br/>
<p>提示：</p>
<p>1.甲方、乙方账户所属银行提供所开立账户的资金结算服务，对业务中涉及的借贷资金风险不承担任何担保、偿还的义务。</p>
<p>2.票据钱柜网站为甲方、乙方提供信息发布、交易撮合、合同订立媒介服务，甲方、乙方在网站绑定账户及密码口令的安全性须自行管理及承担。</p>
<p>3.甲方、乙方应确保在账户所属银行及票据钱柜网站登记的联系方式准确、有效，票据钱柜平台按该联系方式向合同各方发送通知及信息。</p>
<p>4.合同各方应按照法律规定自行处理。</p>
<p>5、山东今劢供应链管理有限公司及票据钱柜拥有对本协议的最终解释权。</p>
	  <br/>
<br/>
	  <div class="Seal" style="float:left;">
         甲方（出借人）：<u><?php echo (($mInvest["real_name"])?($mInvest["real_name"]):'未填写'); ?></div><br/>
		 <div class="Seal" style="float:left;">
         乙方（借款人）：<u><?php echo (($mBorrow["real_name"])?($mBorrow["real_name"]):'未填写'); ?></div><br/>
      <div class="Seal" style="float:left;">
         丙方（见证人/服务商）：山东今劢供应链管理有限公司（票据钱柜网络服务平台）</div>
		 <div class="Seal" style="float:left;">
         丁方（担保方）：山东同济融资担保股份有限公司</div></br></br>
		 <div class="Seal" style="float:left;"><?php echo (date("Y年m月d日",$binfo["second_verify_time"])); ?>
	 </div> 
	   <div class="Seal" style="float:right;">
         <img src="/Style/ad_right/danbao.png" border="0" width="250px" height="250px"><!--<img src="/Style/ad_right/zichan.png" border="0" width="250px" height="250px">--></div>
    </div>
  </div>
</div>
</body>
</html>