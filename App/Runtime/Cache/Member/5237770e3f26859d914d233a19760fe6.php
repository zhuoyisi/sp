<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">var bankimg = "__ROOT__/Style/M/";</script>
<script type="text/javascript">var Himg = "__ROOT__/Style/H/";</script>
<script type="text/javascript" src="__ROOT__/Style/M/js/recharge.js"></script>
<style type="text/css">
.dv_header_8 { background-image: url(); }
.dv_account_0 { margin-top: 10px; }


.cz dl{line-height: 200%;margin-bottom: 12px;}
.cz dt{width: 160px;text-align: right; display: inline-block;}
.cz dd{display: inline-block;}
.cz dd input{width: 120px; 
	border: 1px solid #D4D4D4;
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
	color: #555555;
    display: inline-block;
    font-family: Tahoma,"微软雅黑","宋体";
    font-size: 14px;
    height: 20px;
    line-height: 20px;
    padding: 9px 6px; vertical-align: middle;
}

.btn{background: url("/Style/M/images/bank/fukan.jpg") repeat scroll 0 0 transparent;
    border: 0 none;
    cursor: pointer;
    height: 28px;
    width: 124px;
    color: #FFFFFF;
	font-family: Tahoma,微软雅黑,宋体;
}
.btn:hover {
    background-position: 0 -28px;
}


.radiobox {
    display: inline-block;
    font-size: 14px;
	margin:5px;
	width:80px;
    position: relative;
    text-decoration: none;
    vertical-align: middle;
}
a.radiobox:link, a.radiobox:visited {
    background: none repeat scroll 0 0 #F5F5F5;
    border: 2px solid #CFCFCF;
    color: #555555;
    height: 30px;
	padding-top:5px;
	padding-bottom:5px;
	text-align:center;
}
.selected a.radiobox:link, .selected a.radiobox:visited, a.radiobox:active, a.radiobox:hover {
    background: none repeat scroll 0 0 #FFFFFF;
    background-color: #F4F8EB;
    border: 2px solid #A5C85B;
    color: #608908;
    height: 30px;
    outline: 0 none;
	text-align:center;
}




.radiobox .iconcheck {
    bottom: 0;
    display: none;
    position: absolute;
    right: 0;
}

.iconcheck {
    background: url("/Style/M/images/bank/element.png") no-repeat  0 -103px transparent;
    display: inline-block;
    font-size: 0;
    height: 16px;
    line-height: 16px;
    vertical-align: middle;
    width: 16px;
}
.selected .iconcheck {
    display: block;
    background-position: -112px -72px;
    margin: -16px 0 0 104px;
}

.modbank:after {
    clear: both;
    content: ".";
    display: block;
    height: 0;
    visibility: hidden;
}
.modbank {
    color: #666666;
    font: 12px/1.4 "微软雅黑","宋体",Tahoma;
    padding-bottom: 10px;
}

.modbank .banklogo {
    border: 1px solid #DDDEDE;
    cursor: pointer;
    display: block;
    float: left;
    height: 30px;
    line-height: 30px;
    margin: 0 -1px -1px 0;
    position: relative;
    width: 120px;
    z-index: 0;
}
.modbank .banklogo:hover, .modbank .selected {
    background-color: #F4F8EB;
    border: 1px solid #A5C85B;
    z-index: 3;
}


.modbank .iconradio {
    background: url("/Style/M/images/bank/element.png") no-repeat scroll -48px -56px transparent;
    margin-left: 8px;
    margin-right: 8px;
    position: relative;
    vertical-align: -2px;
    display: inline-block;
    font-size: 0;
    height: 16px;
    line-height: 16px;
    vertical-align: middle;
    width: 16px;
}
.modbank .selected .iconradio {
    background-position: -64px -56px;
}

.ico_icbc, .ico_cmb, .ico_ccb, .ico_abc, .ico_boc, .ico_spdb, .ico_sdb, .ico_cib, .ico_bob, .ico_cebb, .ico_boco, .ico_cmbc, .ico_ecitic, .ico_gdb, .ico_pingan, .ico_post, .ico_union, .ico_jsb, .ico_srcb, .ico_hkb, .ico_nbcb, .ico_njcb, .ico_bosh, .ico_hxb, .ico_hzb, .ico_hkbea, .ico_ordos, .ico_cbhb, .ico_jzb, .ico_gdrcu, .ico_nccb, .ico_glccb, .ico_bsb, .ico_ynrcc, .ico_gzcb, .ico_cqrcb, .ico_zjcb {
    background: url("/Style/M/images/bank/bank_ico.png") no-repeat scroll 0 0 transparent;
    display: inline-block;
    height: 18px;
    line-height: 999px;
    margin-right: 3px;
    overflow: hidden;
    position: relative;
    vertical-align: -3px;
    width: 18px;
}
.ico_icbc {
    background-position: 0 0;
}
.ico_cmb {
    background-position: -18px 0;
}
.ico_ccb {
    background-position: -36px 0;
}
.ico_abc {
    background-position: -54px 0;
}
.ico_boc {
    background-position: -72px 0;
}
.ico_spdb {
    background-position: -54px -18px;
}
.ico_sdb {
    background-position: -108px -18px;
}
.ico_cib {
    background-position: 0 -18px;
}
.ico_bob {
    background-position: -126px -18px;
}
.ico_cebb {
    background-position: -90px 0;
}
.ico_boco {
    background-position: -36px -18px;
}
.ico_cmbc {
    background-position: -90px -18px;
}
.ico_ecitic {
    background-position: -126px 0;
}
.ico_gdb {
    background-position: -72px -18px;
}
.ico_pingan {
    background-position: 0 -36px;
}
.ico_post {
    background-position: -18px -18px;
}
.ico_union {
    background-position: -27px -36px;
    width: 27px;
}
.ico_jsb {
    background-position: -54px -36px;
}
.ico_srcb {
    background-position: -72px -37px;
}
.ico_nbcb {
    background-position: -90px -36px;
}
.ico_njcb {
    background-position: -108px -36px;
}
.ico_hkb {
    background-position: -126px -36px;
}
.ico_bosh {
    background-position: 0 -54px;
}
.ico_hxb {
    background-position: -18px -54px;
}
.ico_hzb {
    background-position: -36px -54px;
}
.ico_hkbea {
    background-position: -54px -54px;
}
.ico_ordos {
    background-position: -72px -54px;
}
.ico_cbhb {
    background-position: -108px -54px;
}
.ico_jzb {
    background-position: -90px -54px;
}
.ico_gdrcu {
    background-position: 0 -73px;
}
.ico_nccb {
    background-position: -18px -73px;
}
.ico_glccb {
    background-position: -36px -73px;
}
.ico_bsb {
    background-position: -54px -73px;
}
.ico_ynrcc {
    background-position: -72px -73px;
}
.ico_gzcb {
    background-position: -90px -73px;
}
.ico_cqrcb {
    background-position: -108px -73px;
}
.ico_zjcb {
    background-position: -126px -73px;
}


</style>
<?php if($payConfig['guofubao']['enable'] != '1' && $payConfig['ips']['enable'] != '1' && $payConfig['chinabank']['enable'] != '1' && $payConfig['baofoo']['enable'] != '1' && $payConfig['tenpay']['enable'] != '1' && $payConfig['ecpss']['enable'] != '1' && $payConfig['easypay']['enable'] != '1' && $payConfig['cmpay']['enable'] != '1' && $payConfig['allinpay']['enable'] != '1' && $payConfig['sina']['enable'] != '1' && $payConfig['sumapay']['enable'] != '1' && $payConfig['95epay']['enable'] != '1'): ?><div style="height: 25px; width: 100%; line-height: 25px; text-indent: 26px;
	text-align: left; margin: 0px; padding: 12px 0px; color:#FF0000;" class="charge2">
	温馨提示：网站当前尚未开启任何在线支付，敬请期待。
</div>
<?php else: ?>

<div style="height: 25px; width: 100%; line-height: 25px; text-indent: 26px;
	text-align: left; margin: 0px; padding: 12px 0px;" class="charge2">
	温馨提示：最低充值金额50元。充值免手续费！充值资金可用于进行验证、投标、还款等。充值成功后资金会立刻划拨到您的帐户。
</div><?php endif; ?>
<?php if($payConfig['sumapay']['enable'] == '1'): ?><input type="hidden" value="sumapay" id="pd_bank" name="pd_bank" />
	<?php else: ?>
		<?php if($payConfig['ips']['enable'] == '1'): ?><input type="hidden" value="ips" id="pd_bank" name="pd_bank" />
		<?php elseif($payConfig['baofoo']['enable'] == '1'): ?>
		<input type="hidden" value="baofoo" id="pd_bank" name="pd_bank" />
		<?php elseif($payConfig['ecpss']['enable'] == '1'): ?>
		<input type="hidden" value="ecpss" id="pd_bank" name="pd_bank" />
		<?php elseif($payConfig['easypay']['enable'] == '1'): ?>
		<input type="hidden" value="easypay" id="pd_bank" name="pd_bank" />
		<?php elseif($payConfig['cmpay']['enable'] == '1'): ?>
		<input type="hidden" value="cmpay" id="pd_bank" name="pd_bank" />
		<?php elseif($payConfig['guofubao']['enable'] == '1'): ?>
		<input type="hidden" value="guofubao" id="pd_bank" name="pd_bank" />
		<?php elseif($payConfig['allinpay']['enable'] == '1'): ?>
		<input type="hidden" value="allinpay" id="pd_bank" name="pd_bank" />
		<?php elseif($payConfig['sina']['enable'] == '1'): ?>
		<input type="hidden" value="sina" id="pd_bank" name="pd_bank" />
		<?php elseif($payConfig['chinabank']['enable'] == '1'): ?>
		<input type="hidden" value="1025" id="pd_bank" name="pd_bank" />
		<?php elseif($payConfig['95epay']['enable'] == '1'): ?>
		<input type="hidden" value="95epay" id="pd_bank" name="pd_bank" />
		<?php else: ?>
		<input type="hidden" value="tenpay" id="pd_bank" name="pd_bank" /><?php endif; endif; ?>
<!--资金输入-->
<div class="cz" style="width: 705px;margin: 10px 0 10px 35px;padding: 8px 13px 8px 12px; border:1px #E9E8E7 solid;">
	<dl>
		<dt style="float:left;">账户余额：</dt>
		<dd style="width:500px;"><span style="color: Red;font-size: 24px;font-weight: bold;"><?php echo (($account_money["account_money"])?($account_money["account_money"]):"0.00"); ?></span>&nbsp;&nbsp;元&nbsp;</dd>
	</dl>
	<dl>
		<dt style="float:left;">充值金额：</dt>
		<dd style="width:500px;"><input type="text" name="money" class="input_money" value="0.00"  id="t_money"  onblur="testAmount();" />&nbsp;&nbsp;元&nbsp;&nbsp;<span class="rtu"></span></dd>
		<dt style="float:left;">大写金额:</dt><dd style="width:500px; height:20px;"><span id="d_money_3"></span></dd>
	</dl>
	<div style="clear:both;"></div>
	<?php if($payConfig['chinabank']['enable'] == '1'): ?><dl class="modbank chinabank" style="display:none;">
		<dt>选择银行：</dt>
		<dd style="width:500px;margin-left: 161px;margin-top: -25px;">
			<div >
				<label code='1025'  class="banklogo"><i class="iconradio"></i><i class="ico_icbc"></i>工商银行<i class="iconcheck"></i></label>
				<label code='308'  class="banklogo"><i class="iconradio"></i><i class="ico_cmb"></i>招商银行<i class="iconcheck"></i></label>
				<label code='313'   class="banklogo"><i class="iconradio"></i><i class="ico_ecitic"></i>中信银行<i class="iconcheck"></i></label>
				<label  code='103'  class="banklogo"><i class="iconradio"></i><i class="ico_abc"></i>农业银行<i class="iconcheck"></i></label>
				
				<label  code='305'  class="banklogo"><i class="iconradio"></i><i class="ico_cmbc"></i>民生银行<i class="iconcheck"></i></label>
				
				<label  code='301'  class="banklogo"><i class="iconradio"></i><i class="ico_boco"></i>交通银行<i class="iconcheck"></i></label>
				<label code='312'   class="banklogo"><i class="iconradio"></i><i class="ico_cebb"></i>光大银行<i class="iconcheck"></i></label>
				<label  code='105'  class="banklogo"><i class="iconradio"></i><i class="ico_ccb"></i>建设银行<i class="iconcheck"></i></label>				
				
				<label code='307'   class="banklogo"><i class="iconradio"></i><i class="ico_pingan"></i>平安银行<i class="iconcheck"></i></label>
				
				<label  code='104'  class="banklogo"><i class="iconradio"></i><i class="ico_boc"></i>中国银行<i class="iconcheck"></i></label>
				<label code='3230'   class="banklogo"><i class="iconradio"></i><i class="ico_post"></i>邮政银行<i class="iconcheck"></i></label>
				
				<label  code='309'  class="banklogo"><i class="iconradio"></i><i class="ico_cib"></i>兴业银行<i class="iconcheck"></i></label>
				
				<label code='306'   class="banklogo"><i class="iconradio"></i><i class="ico_gdb"></i>广发银行<i class="iconcheck"></i></label>
				<label  code='3283'  class="banklogo"><i class="iconradio"></i><i class="ico_hxb"></i>华夏银行<i class="iconcheck"></i></label>
				
				<label code='314'   class="banklogo"><i class="iconradio"></i><i class="ico_spdb"></i>浦发银行<i class="iconcheck"></i></label>
				<label code='327'   class="banklogo"><i class="iconradio"></i><i class=""></i>其他银行<i class="iconcheck"></i></label>
			</div>
		</dd>
	</dl><?php endif; ?>
	<?php if($payConfig['cmpay']['enable'] == '1'): ?><dl class="modbank cmpay" style="display:none;">
		<dt>选择银行：</dt>
		<dd style="width:500px;margin-left: 161px;margin-top: -25px;">
			<div >
				<label  code='ABC'  class="banklogo"><i class="iconradio"></i><i class="ico_abc"></i>农业银行<i class="iconcheck"></i></label>
				<label code='ICBC'  class="banklogo"><i class="iconradio"></i><i class="ico_icbc"></i>工商银行<i class="iconcheck"></i></label>
				<label code='CMB'  class="banklogo"><i class="iconradio"></i><i class="ico_cmb"></i>招商银行<i class="iconcheck"></i></label>
				<label code='ECITIC'   class="banklogo"><i class="iconradio"></i><i class="ico_ecitic"></i>中信银行<i class="iconcheck"></i></label>
				
				
				<label  code='CMBC'  class="banklogo"><i class="iconradio"></i><i class="ico_cmbc"></i>民生银行<i class="iconcheck"></i></label>
				
				<label  code='BCOM'  class="banklogo"><i class="iconradio"></i><i class="ico_boco"></i>交通银行<i class="iconcheck"></i></label>
				<label code='CEBB'   class="banklogo"><i class="iconradio"></i><i class="ico_cebb"></i>光大银行<i class="iconcheck"></i></label>
				<label  code='CCB'  class="banklogo"><i class="iconradio"></i><i class="ico_ccb"></i>建设银行<i class="iconcheck"></i></label>				
				
				<label code='SPABANK'   class="banklogo"><i class="iconradio"></i><i class="ico_pingan"></i>平安银行<i class="iconcheck"></i></label>
				
				<label  code='BOC'  class="banklogo"><i class="iconradio"></i><i class="ico_boc"></i>中国银行<i class="iconcheck"></i></label>
				<label code='PSBC'   class="banklogo"><i class="iconradio"></i><i class="ico_post"></i>邮政银行<i class="iconcheck"></i></label>
				
				<label  code='CIB'  class="banklogo"><i class="iconradio"></i><i class="ico_cib"></i>兴业银行<i class="iconcheck"></i></label>
				
				<label code='GDB'   class="banklogo"><i class="iconradio"></i><i class="ico_gdb"></i>广发银行<i class="iconcheck"></i></label>
				<label  code='HXB'  class="banklogo"><i class="iconradio"></i><i class="ico_hxb"></i>华夏银行<i class="iconcheck"></i></label>
				
				<label code='SPDB'   class="banklogo"><i class="iconradio"></i><i class="ico_spdb"></i>浦发银行<i class="iconcheck"></i></label>
			</div>
		</dd>
	</dl><?php endif; ?>
	<div style="clear:both;"></div>
    <hr style="clear:both; margin-top:20px" />
	<dl>
		<dt style="float:left;"><?php if($payConfig['sumapay']['enable'] == '1'): ?>其他方式：<?php else: ?>支付方式:<?php endif; ?></dt>
		<dd class="cz_type"  style="width:500px;">
		<?php if($payConfig['sumapay']['enable'] == '1'): ?><label id="sumapay" class="selected" ><a href="javascript:void(0);" class="radiobox">丰付<i class="iconcheck"></i></a></label><?php endif; ?>
		<?php if($payConfig['chinabank']['enable'] == '1'): ?><label id="chinabank"><a href="javascript:void(0);" class="radiobox">网银在线<i class="iconcheck"></i></a></label><?php endif; ?>
		<?php if($payConfig['cmpay']['enable'] == '1'): ?><label id="cmpay"><a href="javascript:void(0);" class="radiobox">移动支付<i class="iconcheck"></i></a></label><?php endif; ?>
		<?php if($payConfig['ips']['enable'] == '1'): ?><label id="ips"><a href="javascript:void(0);" class="radiobox">环迅支付<i class="iconcheck"></i></a></label><?php endif; ?>
		<?php if($payConfig['baofoo']['enable'] == '1'): ?><label id="baofoo"><a href="javascript:void(0);" class="radiobox">宝付支付<i class="iconcheck"></i></a></label><?php endif; ?>
		
		<?php if($payConfig['easypay']['enable'] == '1'): ?><label id="easypay"><a href="javascript:void(0);" class="radiobox">易生支付<i class="iconcheck"></i></a></label><?php endif; ?>
		<?php if($payConfig['guofubao']['enable'] == '1'): ?><label id="guofubao"><a href="javascript:void(0);" class="radiobox">国付宝支付<i class="iconcheck"></i></a></label><?php endif; ?>
		<?php if($payConfig['ecpss']['enable'] == '1'): ?><label id="ecpss"><a href="javascript:void(0);" class="radiobox">汇潮支付<i class="iconcheck"></i></a></label><?php endif; ?>
		<?php if($payConfig['tenpay']['enable'] == '1'): ?><label id="tenpay"><a href="javascript:void(0);" class="radiobox">财付通支付<i class="iconcheck"></i></a></label><?php endif; ?>
		<?php if($payConfig['allinpay']['enable'] == '1'): ?><label id="allinpay"><a href="javascript:void(0);" class="radiobox">通联支付<i class="iconcheck"></i></a></label><?php endif; ?>
		<?php if($payConfig['sina']['enable'] == '1'): ?><label id="sina"><a href="javascript:void(0);" class="radiobox">新浪支付<i class="iconcheck"></i></a></label><?php endif; ?>
		<?php if($payConfig['95epay']['enable'] == '1'): ?><label id="95epay"><a href="javascript:void(0);" class="radiobox">双乾支付<i class="iconcheck"></i></a></label><?php endif; ?>
			<label id="offline"><a href="#" class="radiobox">线下充值<i class="iconcheck"></i></a></label>
		</dd>
	</dl>
	<dl>
		<div style="text-align:center; width: 61%;">
		<?php if($payConfig['guofubao']['enable'] != '1' && $payConfig['ips']['enable'] != '1' && $payConfig['chinabank']['enable'] != '1' && $payConfig['baofoo']['enable'] != '1' && $payConfig['tenpay']['enable'] != '1' && $payConfig['ecpss']['enable'] != '1' && $payConfig['easypay']['enable'] != '1' && $payConfig['cmpay']['enable'] != '1' && $payConfig['allinpay']['enable'] != '1' && $payConfig['sina']['enable'] != '1' && $payConfig['sumapay']['enable'] != '1' && $payConfig['95epay']['enable'] != '1'): else: ?>
		<button class="btn" id="bank_submit"></button><?php endif; ?>
		
		</div>
	</dl>
	<script type="text/javascript">
        //充值方式
		$('.cz_type label').click(function(){
			if($(this).attr('id')!='offline' && $(this).attr('class')!="selected"){
                var t = $(this).attr('id');

				$('.selected').removeClass('selected');
				$(this).addClass('selected');

				$('.modbank').hide();
				$('.'+t).show();
                return true;
            }else if ($(this).attr('id')=='offline') {
                $('a[href=\'#fragment-3\']').click();
                return false;
            }
		});

        /*$("#baofoo").hover(
            function() {
                $.jBox.tip("宝付支付:招行、工行、民生、光大信用卡无限额");
            },function() {
        });*/

        //选择银行
		$('.banklogo').click(function(){
			if ($(this).hasClass('selected')) {
				$(this).removeClass('selected');
			}else{
				$('.banklogo').filter(".selected").removeClass('selected');
				$(this).addClass('selected');
			}
            return false;
		});

        //充值金额
        $('.input_money').click(function(){
            $('.rtu').html("<img style='margin:2px;' src='/Style/H/images/zhuce1.gif'/>&nbsp;请输入正确的金额，最小充值金额50元。");
            return false;
        });

        $('.input_money').blur(function(){
            BlurMoney();
        });

        function BlurMoney() {
            var pat = /^[0-9]*(\.[0-9]{1,2})?$/;
            var str = $('.input_money').val();

            if (str == "") {
                $('.rtu').html("<img style='margin:2px;' src='/Style/H/images/zhuce2.gif'/>&nbsp;输入的金额不能为空！");
                return false;
            }

            // var m = parseInt(str);
            var m = parseFloat(str);
            // alert(m);

            if (m <50) {
                $('.rtu').html("<img style='margin:2px;' src='/Style/H/images/zhuce2.gif'/>&nbsp;最低充值金额为50元！");
                return false;
            }

            if (pat.test(str)) {
                $('.rtu').html("<img style='margin:2px;' src='/Style/M/images/zhuce3.gif'/>&nbsp;");
                return true;
            }else {
                $('.rtu').html("<img style='margin:2px;' src='/Style/H/images/zhuce2.gif'/>&nbsp;请输入正确的金额，小数点后最多2位数。");
                return false;
            }
        }


        //支付
        $('#bank_submit').click(function(){
            if (BlurMoney()) {
                var money = $(".input_money").val();
                var type = $('.cz_type .selected').attr('id');
                if (type=='ips') {
                    if ($('.modbank .selected').size()==1) {
                        bankCode = $('.modbank .selected').attr('code');
                    }else{
                        bankCode = 'ips';
                    }
                    var url = "bankCode=" + bankCode + "&t_money=" + money;
                    window.open("/Pay/ips?" + url);
                }else if (type=='chinabank') {
                    if ($('.modbank .selected').size()==1) {
                        bankCode = $('.modbank .selected').attr('code');
                    }else{
                        bankCode = '';
                    }
                    var url = "bankCode=" + bankCode + "&t_money=" + money;
                    window.open("/Pay/chinabank?" + url);
                }
				else if (type=='baofoo') {
                    if ($('.modbank .selected').size()==1) {
                        bankCode = $('.modbank .selected').attr('code');
                    }else{
                        bankCode = 'baofoo';
                    }
                    var url = "bankCode=" + bankCode + "&t_money=" + money;
                    window.open("/Pay/baofoo?" + url);
                }else if (type=='guofubao') {
                    if ($('.modbank .selected').size()==1) {
                        bankCode = $('.modbank .selected').attr('code');
                    }else{
                        bankCode = 'guofubao';
                    }
                    var url = "bankCode=" + bankCode + "&t_money=" + money;
                    window.open("/Pay/guofubaopay?" + url);
                }else if (type=='ecpss') {
                    if ($('.modbank .selected').size()==1) {
                        bankCode = $('.modbank .selected').attr('code');
                    }else{
                        bankCode = 'ecpss';
                    }
                    var url = "bankCode=" + bankCode + "&t_money=" + money;
                    window.open("/Pay/ecpss?" + url);
                }else if (type=='tenpay') {
                    if ($('.modbank .selected').size()==1) {
                        bankCode = $('.modbank .selected').attr('code');
                    }else{
                        bankCode = 'tenpay';
                    }
                    var url = "bankCode=" + bankCode + "&t_money=" + money;
                    window.open("/Pay/tenpay?" + url);
                }else if (type=='easypay') {
                    if ($('.modbank .selected').size()==1) {
                        bankCode = $('.modbank .selected').attr('code');
                    }else{
                        bankCode = 'easypay';
                    }
                    var url = "bankCode=" + bankCode + "&t_money=" + money;
                    window.open("/Pay/easypay?" + url);
				}else if (type=='cmpay') {
                    if ($('.modbank .selected').size()==1) {
                        bankCode = $('.modbank .selected').attr('code');
                    }else{
                        bankCode = 'ABC';
                    }
                    var url = "bankCode=" + bankCode + "&t_money=" + money;
                    window.open("/Pay/cmpay?" + url);
				}else if (type=='allinpay') {
                    if ($('.modbank .selected').size()==1) {
                        bankCode = $('.modbank .selected').attr('code');
                    }else{
                        bankCode = 'allinpay';
                    }
                    var url = "bankCode=" + bankCode + "&t_money=" + money;
                    window.open("/Pay/allinpay?" + url);
				}else if (type=='sina') {
                    if ($('.modbank .selected').size()==1) {
                        bankCode = $('.modbank .selected').attr('code');
                    }else{
                        bankCode = 'sina';
                    }
                    var url = "bankCode=" + bankCode + "&t_money=" + money;
                    window.open("/Pay/sina?" + url);
				}else if (type=='sumapay') {
                    if ($('.modbank .selected').size()==1) {
                        bankCode = $('.modbank .selected').attr('code');
                    }else{
                        bankCode = 'sumapay';
                    }
                    var url = "bankCode=" + bankCode + "&t_money=" + money;
                    window.open("/Pay/sumapay?" + url);
				}else if (type=='95epay') {
                    if ($('.modbank .selected').size()==1) {
                        bankCode = $('.modbank .selected').attr('code');
                    }else{
                        bankCode = '95epay';
                    }
                    var url = "bankCode=" + bankCode + "&t_money=" + money;
                    window.open("/Pay/epay?" + url);
				}
            }
            return false;
        });
	</script>
<script type="text/javascript" src="__ROOT__/Style/M/js/amounttochinese.js" language="javascript"></script>
<script type="text/javascript">
$(function() {
	//$("#btnSendMsg").click(sendSMS);
	$("#t_money").bind("keyup", function() {
		$this = $(this);
		$this.val($this.val().toString().replace(/[^(\d|\.)]+/, ""));
	});
	$("#t_money").focus(function() {
		$("#d_money_3").css("display", "none");
	});
});
function testAmount() {
	
	var testreuslt = true;

	if (testreuslt) {
		showChineseAmount();
	}
	return testreuslt;
}

function showChineseAmount() {
	var regamount = /^(([1-9]{1}[0-9]{0,})|([0-9]{1,}\.[0-9]{1,2}))$/;
	var reg = new RegExp(regamount);
	if (reg.test($("#t_money").val())) {
		var amstr = $("#t_money").val();
		var leng = amstr.toString().split('.').length;
		if (leng == 1) {
			$("#t_money").val($("#t_money").val() + ".00");
		}
		$("#d_money_3").html(Arabia_to_Chinese($("#t_money").val()));
		$("#d_money_3").css("display", "");
		$("#d_money_3").css("color", "red");
		$("#d_money_3").removeClass("reg_wrong");
		
	}
	else {
		$("#d_money_3").html("");
	}
}
</script>
</div>

<div style="text-align:left; margin:auto; width:710px; margin-top:10px; color:#999; line-height:180%; ">
<img style="float:left; display:inline;" src="__ROOT__/Style/M/images/minilogo.gif" alt="" /><span style="float:left; display:inline; width:690px;">&nbsp;在您使用以上各家银行充值之前，请注意各个银行的支付金额的上限。<br/>具体各个银行的支付限额请参阅：<a style="text-decoration:underline;" target="_blank" href="/public/bank.html">各银行的网上银行支付限额总表</a>。</span>
</div>