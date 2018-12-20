<?php if (!defined('THINK_PATH')) exit();?>   <style type="text/css">
        .btnselall { background-image: url(__ROOT__/Style/H/images/btnselall.jpg); border: 1px solid #ccc; height: 22px; width: 38px; padding: 4px 6px; color: #005B9F; margin: 0px 6px 0PX 0PX; cursor: pointer; }
        .unread { font-weight: bold; cursor: pointer; }
        .read { font-weight: normal; cursor: pointer; }
        DIV.yahoo2 { width: 720px; margin: 0 0 3px; }
        .tableH { background-color: #F6F6F6; height: 20px; line-height: 20px; padding: 0px; }
        #infoTr span { margin: 0px 4px; color: #005B9F; font-weight: bold; }
        .listTr td { border-bottom: 1px solid #C1C8D2; height: 23px; line-height: 23px; text-align: left; text-indent: 20px; }
        .reading td { border-bottom: 1px solid #fff; height: 23px; line-height: 23px; text-align: left; text-indent: 20px; }
        .selectall { margin-right: 4px; }
        .selectone { margin-right: 4px; }
        .contentTr td { border-bottom: 1px solid #C1C8D2; }
        .contentTd { background-color: #F6F6F6; padding: 15px 0px; }
        .contentTd div { width: 670px; margin: 0px auto; text-align: left; line-height: 25px; }
        .contentTd a { text-decoration: underline; }
        .tableHeadTr { }
    </style>
<table id="listTable" style="margin-left: 20px; border: none; border-top: 1px #C1C8D2 solid;
	border-bottom: 1px solid #C1C8D2; border-collapse: collapse; clear: both; width: 760px;" cellspacing="0">
	<tbody><tr class="tableHeadTr" style="background-color: #F6F6F6; height: 23px; line-height: 23px;">
		<td style="text-align: right; border: 1px solid #C1C8D2;" colspan="2">&nbsp;
			
		</td>
		<td style="width: 40px; text-align: center; border-left: 1px solid #C6C9CA; border-bottom: 1px solid #C1C8D2;">
			<img src="__ROOT__/Style/M/images/xf1.jpg">
		</td>
		<td style="width: 136px; text-align: left; text-indent: 20px; border-left: 1px solid #C6C9CA;
			border-bottom: 1px solid #C1C8D2;">
			发件人
		</td>
		<td style="width: 410px; text-align: left; text-indent: 20px; border-left: 1px solid #C6C9CA;
			border-bottom: 1px solid #C1C8D2;">
			主题
		</td>
		<td style="text-align: left; text-indent: 20px; border: 1px solid #C6C9CA; border-bottom: 1px solid #C1C8D2;" colspan="2">
			<a style="color: #000;" href="javascript:void(0)">时间</a>
		</td>
	</tr>
	<tr id="infoTr" class="tableHeadTr" style="height: 30px; line-height: 20px; vertical-align: bottom;">
		<td style="border-bottom: #C1C8D2 solid 2px; text-align: left; text-indent: 8px;" colspan="6">
			未读<span id="spSysMsgCountUn"><?php echo ($unread); ?></span>封，已读<span id="spSysMsgCountRead"><?php echo ($read); ?></span>封，共<span id="spSysMsgCountTotal"><?php echo ($count); ?></span>封
		</td>
	</tr>
	
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="listTr" id="msg_<?php echo ($vo["id"]); ?>">
	<td style="width: 30px; text-align: center; text-indent: 0px;" colspan="2"><input class="selectone" type="checkbox" name="checkbox_msg" id="msg_<?php echo ($vo["id"]); ?>" onclick="checkon(this)" value="<?php echo ($vo["id"]); ?>"></td>
	<td style="width: 40px; text-align: center; text-indent: 0px;"><img src="__ROOT__/Style/M/images/<?php if($vo["status"] == 1): ?>read.jpg<?php else: ?>unread.jpg<?php endif; ?>"></td>
	<td style="width: 136px;"><?php echo ($glo["web_name"]); ?></td>
	<td style="width: 410px;" class="read subject" data="<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></td>
	<td colspan="2"><?php echo (date("Y-m-d",$vo["send_time"])); ?></td>
</tr><?php endforeach; endif; else: echo "" ;endif; ?>

</tbody></table>
<div id="afterTable" class="tableH" style="margin-top: 0px; padding: 10px 8px; width:747px; margin:0 auto;">
	<div style="float: left; width: 160px; text-align: left; height: 20px; line-height: 20px;padding: 0px">
		<table style="border-collapse: collapse; clear: both; visibility: visible;" cellspacing="0">
			<tbody><tr>
				<td style="width: 30px; text-align: center; text-indent: 0px;" colspan="2">
					<input class="selectall" id="selectall" type="checkbox" onclick="ckall();">
				</td>
				<td style="width: 40px; text-align: center; border: none;">
					<label for="selectall" style="margin: 0px 8px 0px 0px;">全选</label>
				</td>
				<td style="width: 60px; text-align: center; border: none;">
					<input value="删除" id="deletebtn1" onclick="delmsg();" class="btnselall" type="button">
				</td>
			</tr>
		</tbody></table>
	</div>
	<div data="fragment-1" class="yahoo2 ajaxpagebar" style="width: 550px; float: right; margin: 0px; padding: 0px;text-align: right; margin-right: 29px;"><?php echo ($pagebar); ?></div>
</div>
<script type="text/javascript">
var readimg = "__ROOT__/Style/M/images/read.jpg";
$(".read").click(function(){
	id = $(this).attr('data');
	$.jBox("get:__URL__/viewmsg/?id="+id, {
		title: "查看信息",
		width: "auto",
		buttons: {'阅读完毕': true }
	});
});

function ckall(){
	if($("#selectall").attr("checked")){
		$('input[name="checkbox_msg"]').attr("checked",true);
	}else{
		$('input[name="checkbox_msg"]').attr("checked",false);
	}
	}
function checkon(o){
    id = o.val();
    if( o.checked == true ){
        $("#msg_"+id).attr('checked','true');
	}else{
		$("#msg_"+id).attr('checked','false');
	}
    }
function getChecked(id) {
	var gids = new Array();
	$.each($("#listTable").find('input:checked'), function(i, n){
		if($(n).val()!=0) gids.push( $(n).val() );
	});
	return gids;
}

function delmsg(id,type){
	aid = getChecked(id);
	aid = aid.toString();
	if(aid==""){
		$.jBox.tip("请先选择要删除的数据");	
		return;
	}
	var datas = {'idarr':aid,'type':type};
	$.post("__URL__/delmsg", datas, delResponse,'json');
}

function delResponse(res){
	if(res.status == '0') {
		$.jBox.tip("删除失败");
	}else {
		aid = res.data.split(',');
		$.each(aid, function(i,n){
			$('#msg_'+n).remove();
		});
		$.jBox.tip("删除成功");
	}
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