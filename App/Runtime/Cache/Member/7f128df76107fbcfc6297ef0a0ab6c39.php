<?php if (!defined('THINK_PATH')) exit();?>
<style type="text/css">
.tdHeard, .tdContent { border: solid 1px #ccc; }
#pager { margin: 10px 4px 3px 0px; }
.notes_frame { width: 715px; overflow: hidden; margin: 0 auto; height: 40px; margin-top: 10px; }
.notes_frame div { padding-top: 13px; }
.operaframe { width: 720px; overflow: hidden; line-height: 27px; padding-left: 25px; margin-top: 20px; }
.operaframe ul { padding: 0px; margin: 0px; text-align: left; overflow: hidden; line-height: 25px; }
.operaframe ul li { float: left; line-height: 25px; }
</style>

<div class="top_account_bg" style="overflow:hidden; height:20px; line-height:25px">
	<img src="__ROOT__/Style/H/images/ministar.gif" style="margin-right: 5px;">
	已逾期还未还的借款
</div>
<!--选择操作-->
<div class="operaframe">
	<ul id="formTb">
		<li style="width: 70px;"><strong>起止日期：</strong> </li>
		<li style="width: 240px;">
			<input type="text" id="start_time1" value="<?php if($search['start_time1']){echo date('Y-m-d',$search['start_time1']);} ?>" readonly="readonly" class="Wdate timeInput_Day" onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'end_time1\')||\'2020-10-01\'}'})"/>
			至
			<input type="text" value="<?php if($search['end_time1']){echo date('Y-m-d',$search['end_time1']);} ?>" id="end_time1" readonly="readonly" class="Wdate timeInput_Day" onFocus="WdatePicker({minDate:'#F{$dp.$D(\'start_time1\')||\'2020-10-01\'}'})"/>
		</li>
		<li style="width: 120px;">
			<img alt="" src="__ROOT__/Style/M/images/chakan.jpg" id="btn_search" onclick="sdetail1()" style="cursor: pointer;">
		</li>
	</ul>
</div>
<div style="margin-top: 20px; overflow: hidden; text-align: left;">
	<table id="content" style="width: 785px; border-collapse: collapse;
		margin-left: 10px;" cellspacing="0">
		<tbody><tr>
			<th scope="col" class="tdHeard" style="width: 100px;">
				借款标号
			</th>
			<th scope="col" class="tdHeard" style="width: 80px;">
				待还本金
			</th>
			<th scope="col" class="tdHeard" style="width: 80px;">
				待还利息
			</th>
			<th scope="col" class="tdHeard" style="width: 80px;">
				待付罚息
			</th>
			<th scope="col" class="tdHeard" style="width: 100px;">
				待付催收费
			</th>
			<th scope="col" class="tdHeard" style="width: 100px;">
				待付总金额
			</th>
			<th scope="col" class="tdHeard" style="width: 100px;">
				应还日期
			</th>
			<th scope="col" class="tdHeard" style="width: 100px;">
				当前/总(期)
			</th>
			<th scope="col" class="tdHeard" style="width: 60px;">
				逾期天数
			</th>
			<th scope="col" class="tdHeard" style="width: 60px;">
				还款
			</th>
		</tr>
	
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="nodatashowtr">
		<td class="tdContent"><a href="#" title="<?php echo ($vo["borrow_name"]); ?>"><?php echo ($vo["borrow_id"]); ?></a></td>
		<td class="tdContent"><?php echo ($vo["capital"]); ?></td>
		<td class="tdContent"><?php echo ($vo["interest"]); ?></td>
		<td class="tdContent"><?php echo (($vo["expired_money"])?($vo["expired_money"]):0.00); ?></td>
		<td class="tdContent"><?php echo (($vo["call_fee"])?($vo["call_fee"]):0.00); ?></td>
		<td class="tdContent"><?php echo ($vo["allneed"]); ?></td>
		<td class="tdContent"><?php echo (date("Y-m-d",$vo["deadline"])); ?></td>
		<td class="tdContent"><?php echo ($vo["sort_order"]); ?>/<?php echo ($vo["total"]); ?></td>
		<td class="tdContent"><?php echo ($vo["breakday"]); ?></td>
		<td class="tdContent"><a href="javascript:;" onclick="repayment(<?php echo ($vo["borrow_id"]); ?>,<?php echo ($vo["sort_order"]); ?>)">还款</a></td>
	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</tbody></table>
	<div data="fragment-4" id="pager" style="float: right; text-align: right; width: 500px; padding-right: 0px;" class="yahoo2 ajaxpagebar"><?php echo ($pagebar); ?></div>
</div>
<div style="clear: both; float: none;">
</div>

<script type="text/javascript">
function repayment(bid,sort_order){
	x = {"bid":bid,"sort_order":sort_order};
	$.jBox.tip("还款中......",'loading');
	$.ajax({
		url: "__URL__/doexpired",
		data: x,
		timeout: 15000,
		cache: false,
		type: "post",
		dataType: "json",
		success: function (d, s, r) {
			if(d){
				if(d.status==1) $.jBox.tip("还款成功",'success');
				else $.jBox.tip(d.message,'fail');
			}
		}
	});
}


function sdetail1(){
	x = makevar(['start_time1','end_time1']);
	$.ajax({
		url: "__URL__/borrowbreak",
		data: x,
		timeout: 5000,
		cache: false,
		type: "get",
		dataType: "json",
		success: function (d, s, r) {
			if(d) $("#fragment-4").html(d.html);//更新客户端竞拍信息 作个判断，避免报错
		}
	});
}

$('.ajaxpagebar a').click(function(){
	try{	
		var geturl = $(this).attr('href');
		var id = $(this).parent().attr('data');
		var x={};
        $.ajax({
            url: geturl,
            data: x,
            timeout: 5000,
            cache: false,
            type: "get",
            dataType: "json",
            success: function (d, s, r) {
              	if(d) $("#"+id).html(d.html);//更新客户端竞拍信息 作个判断，避免报错
            }
        });
	}catch(e){};
	return false;
})
</script>