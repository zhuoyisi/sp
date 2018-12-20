<?php if (!defined('THINK_PATH')) exit();?>
<style type="text/css">
.fontred { color: #005B9F; }
.infolist { margin: 5px 0 10px 20px; border: solid 1px #ddd; padding: 2px; width: 715px; text-align: left; }
.infolist table td { height: 28px; }
.infolist .myfont { color: #ff6500; font-weight: bold; }
#pager a.current { background-color: #ddd; border: solid 1px #ccc; color: #fff; }
#pager a:hover { background-color: #ddd; border: solid 1px #ccc; color: red; }
.tdHeard, .tdContent { border: solid 1px #ccc; }
.tdContent a { text-decoration: underline; }
.tdHeard { background-image: url(__ROOT__/Style/H/images/thbg.jpg); height: 29px; }
.divtitle { height: 20px; line-height: 30px; text-align: left; padding-left: 20px; font-size: 12px; text-indent: 25px; margin-top: 8px; margin-bottom: 1PX; }
#noinfotip .tdContent{width:auto}
.tdContent a{color:#03F; text-decoration:none}
</style>

<div style="margin: 10px 0px; overflow: hidden; text-align: left; clear: both; float: left;padding-left: 8px;">
	<table id="content" style="width: 785px; border-collapse: collapse;" cellspacing="0">
		<tbody>
	<tr>
		<th style="width: 63px;" class="tdHeard" scope="col">
			借款标号
		</th>
		<th style="width: 120px;" class="tdHeard" scope="col">
			借款标题
		</th>
		<th style="width: 63px;" class="tdHeard" scope="col">
			借入人
		</th>
		<th style="width: 63px;" class="tdHeard" scope="col">
			投资金额
		</th>
		<th style="width: 63px;" class="tdHeard" scope="col">
			应收利息
		</th>
		<th style="width: 63px;" class="tdHeard" scope="col">
			待收本息
		</th>
		<th style="width: 63px;" class="tdHeard" scope="col">
			已还本息
		</th>
		<th style="width: 73px;" class="tdHeard" scope="col">
			年化利率
		</th>
		<th style="width: 163px;" class="tdHeard" scope="col">
			已还/总期数(还款期)
		</th>
		<th class="tdHeard" style="width: 50px;" scope="col">
			备注
		</th>
	</tr>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="noinfotip" style="">
			<td class="tdContent"><a href="<?php echo (getinvesturl($vo["borrow_id"])); ?>" title="<?php echo ($vo["borrow_name"]); ?>" target="_blank"><?php echo ($vo["borrow_id"]); ?></a></td>
			<td class="tdContent"><a href="<?php echo (getinvesturl($vo["borrow_id"])); ?>" title="<?php echo ($vo["borrow_name"]); ?>" target="_blank"><?php echo (cnsubstr($vo["borrow_name"],20)); ?></a></td>
			<td class="tdContent"><?php echo ($vo["borrow_user"]); ?></td>
			<td class="tdContent"><?php echo ($vo["investor_capital"]); ?></td>
			<td class="tdContent"><?php echo ($vo["investor_interest"]); ?></td>
			<td class="tdContent"><?php echo ($vo['investor_capital'] + $vo['investor_interest']); ?></td>
			<td class="tdContent"><?php echo ($vo['receive_capital'] + $vo['receive_interest']); ?></td>
			<td class="tdContent"><?php echo ($vo["borrow_interest_rate"]); ?>%</td>
			<td class="tdContent"><?php echo (($vo["back"])?($vo["back"]):"0"); ?>/<?php echo ($vo["total"]); ?>(<?php echo (date("Y-m-d",$vo["repayment_time"])); ?>)(<a href="__URL__/tendoutdetail?id=<?php echo ($vo["id"]); ?>" target="_blank">详情</a>)</td>
			<td class="tdContent">
            <?php if($vo["period"] > 0 and $vo["detb_status"] == 1 and $vo["debt_uid"] == $uid): ?>购买 <?php echo ($vo["period"]); ?>期债权
            <?php elseif($vo["period"] > 0 and $vo["detb_status"] == 1): ?>
            转让 <?php echo ($vo["period"]); ?>期债权
<?php elseif($vo["borrow_type"] == 1): ?>
			<a href="__APP__/member/agreementer/downfile?id=<?php echo ($vo["id"]); ?>" target="_blank">合同</a>
            <?php elseif($vo["borrow_type"] == 2): ?>
			<a href="__APP__/member/agreement/downfile?id=<?php echo ($vo["id"]); ?>" target="_blank">合同</a>
            <?php elseif($vo["borrow_type"] == 5): ?>
			<a href="__APP__/member/agreemented/downfile?id=<?php echo ($vo["id"]); ?>" target="_blank">合同</a>
            <?php else: ?>
            <a href="__APP__/member/agreementeds/downfile?id=<?php echo ($vo["id"]); ?>" target="_blank">合同</a><?php endif; ?>
            </td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</tbody></table>
<div data="fragment-3" id="pager" style="float: right; text-align: right; width: 500px; padding-right: 0px;" class="yahoo2 ajaxpagebar"><?php echo ($pagebar); ?></div>
</div>
<div style="clear: both;">
</div>

<script type="text/javascript">
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
              	if(d) $("#"+id).html(d.html);//更新客户端 作个判断，避免报错
            }
        });
	}catch(e){};
	return false;
})
</script>