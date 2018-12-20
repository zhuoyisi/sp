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
</style>
<div style="margin: 20px 0px; overflow: hidden; text-align: left; clear: both; float: left;
	padding-left: 8px; width: 785px;">
	<table id="content" style="width: 785px; border-collapse: collapse;" cellspacing="0">
		<tbody>
		<tr style="height:30px; background:#F6F6F6; font-weight:bold;">
        <th class="tdHeard">借款标号</th>
        <!-- <th class="tdHeard">借款标题</th> -->
        <th class="tdHeard">借入人</th>
        <th class="tdHeard">年化利率</th>
        <th class="tdHeard">逾期天数</th>
        <th class="tdHeard">待收本金</th>
        <th class="tdHeard">待收利息</th>
        <th class="tdHeard">当前/总(期)</th>
        </tr>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="noinfotip" style="">
			<td class="tdContent"><a href="<?php echo (getinvesturl($vo["borrow_id"])); ?>" title="<?php echo ($vo["borrow_name"]); ?>" target="_blank"><?php echo ($vo["borrow_id"]); ?></a></td>
			<!-- <td class="tdContent"><a href="<?php echo (getinvesturl($vo["borrow_id"])); ?>" target="_blank"><?php echo ($vo["borrow_name"]); ?></a></td> -->
			<td class="tdContent"><?php echo ($vo["borrow_user"]); ?></td>
			<td class="tdContent"><?php echo ($vo["borrow_interest_rate"]); ?>%</td>
			<td class="tdContent"><?php echo ($vo["breakday"]); ?></td>
			<td class="tdContent"><?php echo ($vo["capital"]); ?></td>
			<td class="tdContent"><?php echo ($vo["interest"]); ?></td>
			<td class="tdContent"><?php echo ($vo["sort_order"]); ?>/<?php echo ($vo["total"]); ?></td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</tbody></table>
<div data="fragment-4" id="pager" style="float: right; text-align: right; width: 500px; padding-right:0px;" class="yahoo2 ajaxpagebar"><?php echo ($pagebar); ?></div>
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