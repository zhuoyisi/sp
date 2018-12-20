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
.tdHeard { background-image: url(__ROOT__/Style/M/images/thbg.jpg); height: 29px; }
.divtitle { height: 20px; line-height: 30px; text-align: left; padding-left: 20px; font-size: 12px; text-indent: 25px; margin-top: 8px; margin-bottom: 1PX; }
#noinfotip .tdContent{width:auto}
.tdContent a{color:#06F; text-decoration:none}
</style>
<div class="divtitle" style="width: 100%;">
	您目前竞标中的投资总额是：<span class="fontred">￥<?php echo (($total)?($total):"0.00"); ?></span>，共<span class="fontred"><?php echo (($num)?($num):"0"); ?></span>笔投标。
</div>
<div style="margin: 10px 0px; overflow: hidden; text-align: left; clear: both; float: left;
	padding-left: 6px;">
	<table id="content" style="width: 785px; border-collapse: collapse;" cellspacing="0">
		<tbody><tr>
			<th scope="col" class="tdHeard" style="width: 63px;">
				借款标号
			</th>
			<!-- <th scope="col" class="tdHeard" style="width: 63px;">
				标题
			</th> -->
			<th scope="col" class="tdHeard" style="width: 103px;">
				借入人
			</th>
			<th scope="col" class="tdHeard" style="width: 83px;">
				投标日期
			</th>
			<th scope="col" class="tdHeard" style="width: 93px;">
				借款金额
			</th>
			<th scope="col" class="tdHeard" style="width: 63px;">
				年化利率
			</th>
			<th scope="col" class="tdHeard" style="width: 100px;">
				借款期限
			</th>
			<th scope="col" class="tdHeard" style="width: 93px;">
				我的投资金额
			</th>
			<th scope="col" class="tdHeard" style="width: 83px;">
				预期本息
			</th>
		</tr>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="noinfotip" style="">
			<td class="tdContent"><a target="_blank" href="<?php echo (getinvesturl($vo["borrow_id"])); ?>" title="<?php echo ($vo["borrow_name"]); ?>"><?php echo ($vo["borrow_id"]); ?></a></td>
			<!-- <td class="tdContent" style="padding:0"><a target="_blank" href="<?php echo (getinvesturl($vo["borrow_id"])); ?>" title="<?php echo ($vo["borrow_name"]); ?>"><?php echo (cnsubstr($vo["borrow_name"],10)); ?></a></td> -->
			<td class="tdContent"><?php echo ($vo["borrow_user"]); ?></td>
			<td class="tdContent"><?php echo (date("Y-m-d",$vo["invest_time"])); ?></td>
			<td class="tdContent"><?php echo ($vo["borrow_money"]); ?></td>
			<td class="tdContent"><?php echo ($vo["borrow_interest_rate"]); ?>%</td>
			<td class="tdContent"><?php echo ($vo["borrow_duration"]); if($vo["repayment_type"] == 1): ?>天<?php else: ?>个月<?php endif; ?></td>
			<td class="tdContent"><?php echo ($vo["investor_capital"]); ?></td>
			<td class="tdContent"><?php echo ($vo['investor_capital'] + $vo['investor_interest']); ?></td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</tbody></table>
<div data="fragment-2" id="pager" style="float: right; text-align: right; width: 500px; padding-right: 0px;" class="yahoo2 ajaxpagebar"><?php echo ($pagebar); ?></div>
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
              	if(d) $("#"+id).html(d.html);//更新客户端竞拍信息 作个判断，避免报错
            }
        });
	}catch(e){};
	return false;
})
</script>