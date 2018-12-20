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
<link href="__ROOT__/Style/Swfupload/swfupload.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="__ROOT__/Style/Swfupload/handlers.js"></script>
<script type="text/javascript" src="__ROOT__/Style/Swfupload/swfupload.js"></script>
<script type="text/javascript" src="__ROOT__/Style/My97DatePicker/WdatePicker.js" language="javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {
		//swf上传图片
		swfu = new SWFUpload(
		{
			// Backend Settings
			upload_url: "swfupload",
			post_params: {"PHPSESSID": "<?php echo session_id(); ?>", "dopost" : ""},

			// File Upload Settings
			file_size_limit : "2 MB",	// 2MB
			file_types : "*.jpg; *.gif; *.png",
			file_types_description : "选择 JPEG/GIF/PNG 格式图片",
			file_upload_limit : "0",

			file_queue_error_handler : fileQueueError,
			file_dialog_complete_handler : fileDialogComplete,
			upload_progress_handler : uploadProgress,
			upload_error_handler : uploadError,
			upload_success_handler : uploadSuccess,
			upload_complete_handler : uploadComplete,

			button_image_url : "../images/SmallSpyGlassWithTransperancy_17x18.png",
			button_placeholder_id : "spanButtonPlaceholder",
			button_width: 250,
			button_height: 18,
			button_text : '<span class="button">选择本地图片 <span class="buttonSmall">(单图最大为 2 MB，支持多选)</span></span>',
			button_text_style : '.button { font-family: "宋体", sans-serif; font-size: 12px; } .buttonSmall { font-size: 10pt; }',
			button_text_top_padding: 0,
			button_text_left_padding: 18,
			button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
			button_cursor: SWFUpload.CURSOR.HAND,
			
			// Flash Settings
			flash_url : "__ROOT__/Style/Swfupload/swfupload.swf",

			custom_settings : {
				upload_target : "divFileProgressContainer"
			},
			
			// Debug Settings
			debug: false
		});
		//swf上传图片
	});

</script>
<script type="text/javascript">
//swf上传后排序
function rightPic(o){
	 var o = $("#albCtok"+o);
	 if( o.next().length > 0) {
		  var tmp = o.clone();
		  var oo = o.next();
		  o.remove();
		  oo.after(tmp);
	 }else{
		alert("已经是最后一个了"); 
	 }
}
//swf上传后排序
function leftPic(o){
	 var o = $("#albCtok"+o);
	 if( o.prev().length > 0) {
		  var tmp = o.clone();
		  var oo = o.prev();
		  o.remove();
		  oo.before(tmp);
	 }else{
		alert("已经是第一个了"); 
	 }
}
//swf上传后删除图片start
function delPic(id){
	var imgpath = $("#albCtok"+id).find("input[type='hidden']").eq(0).val();
	var datas = {'picpath':imgpath,'oid':id};
	$.post("__URL__/swfupload?delpic", datas, picdelResponse,'json');
}

function picdelResponse(res){
	var imgdiv = $("#albCtok"+res.data);
		imgdiv.remove();
		ui.success(res.info);
		ui.box.close();
}
//swf上传后删除图片end
</script>
<style type="text/css">
.albCt{height:200px}
</style>
<?php $arr=array_keys($borrow_status); ?>

<div class="so_main">
  <div class="page_tit">审核借款</div>
  <div class="page_tab"><?php if($arr[0]!='6'): ?><span data="tab_1" class="active">基本信息</span><span data="tab_2">审核信息</span><?php endif; ?><span data="tab_3">借款方图片资料</span></div>
  <div class="form2">
    <form method="post" action="__URL__/doEdit<?php echo ($xact); ?>" onsubmit="return subcheck();" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>" />
      <?php if($arr[0]!='6'): ?><div id="tab_1"><?php else: ?><div id="tab_1" style="display:none"><?php endif; ?>
        <dl class="lineD">
          <dt>借款标题：</dt>
          <dd>
            <input name="borrow_name" id="borrow_name"  class="input" type="text" value="<?php echo ($vo["borrow_name"]); ?>" ><span id="tip_borrow_name" class="tip">*</span>
          </dd>
        </dl>
        <dl class="lineD">
          <dt>还款方式：</dt>
          <dd>
            <select name="repayment_type" id="repayment_type"   class="c_select"><option value="">--请选择--</option><?php foreach($type_list as $key=>$v){ if($vo["repayment_type"]==$key && $vo["repayment_type"]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select><span id="tip_repayment_type" class="tip">*</span>
          </dd>
        </dl>
        <dl class="lineD">
          <dt>借款金额：</dt>
          <dd>
            <input name="borrow_money" id="borrow_money"  class="input" type="text" value="<?php echo ($vo["borrow_money"]); ?>" ><span id="tip_borrow_money" class="tip">*</span>
          </dd>
        </dl>
        <dl class="lineD">
          <dt>年化利率：</dt>
          <dd>
            <input name="borrow_interest_rate" id="borrow_interest_rate"  class="input" type="text" value="<?php echo ($vo["borrow_interest_rate"]); ?>" ><span id="tip_borrow_interest_rate" class="tip">*</span>
          </dd>
        </dl>
        <dl class="lineD">
          <dt>借款期限：</dt>
          <dd>
            <input name="borrow_duration" id="borrow_duration"  class="input" type="text" value="<?php echo ($vo["borrow_duration"]); ?>" ><span id="tip_borrow_duration" class="tip">*</span>
          </dd>
        </dl>
        <dl class="lineD">
          <dt>借款说明：</dt>
          <dd>
            <textarea name="borrow_info" id="borrow_info"  class="areabox" ><?php echo ($vo["borrow_info"]); ?></textarea><span id="tip_borrow_info" class="tip">*</span>
          </dd>
        </dl>
      </div>
      <!--tab1-->
      <?php if($arr[0]!='6'): ?><div id="tab_2"><?php else: ?><div id="tab_2" style="display:none"><?php endif; ?>
        <dl class="lineD">
          <dt>是否允许自动投标：</dt>
          <dd>
            <?php $i=0;$___KEY=array ( 0 => '否', 1 => '是', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="can_auto" value="<?php echo ($k); ?>" id="can_auto_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["can_auto"]==$k)||("key"=="value"&&$vo["can_auto"]==$v)){ ?><input type="radio" name="can_auto" value="<?php echo ($k); ?>" id="can_auto_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="can_auto" value="<?php echo ($k); ?>" id="can_auto_<?php echo ($i); ?>" /><?php } ?><label for="can_auto_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?>
          </dd>
        </dl>
       <!-- <dl class="lineD">
          <dt>是否设为推荐：</dt>
          <dd>
            <?php $i=0;$___KEY=array ( 0 => '否', 1 => '是', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="is_tuijian" value="<?php echo ($k); ?>" id="is_tuijian_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["is_tuijian"]==$k)||("key"=="value"&&$vo["is_tuijian"]==$v)){ ?><input type="radio" name="is_tuijian" value="<?php echo ($k); ?>" id="is_tuijian_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="is_tuijian" value="<?php echo ($k); ?>" id="is_tuijian_<?php echo ($i); ?>" /><?php } ?><label for="is_tuijian_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?>
          </dd>
        </dl>-->
        <dl class="lineD">
          <dt>借款标分类：</dt>
          <dd>
            <?php echo ($borrow_type[$vo['borrow_type']]); ?>
          </dd>
        </dl>
        <?php if($vo['borrow_type'] == 2): ?><div id="danbaojigou" >
		<dl class="lineD">
          <dt>担保机构：</dt>
          <dd>
          <select name="danbao" id="danbao"  title="设置此次借款融资的担保投资公司" class="c_select"><option value="">--请选择--</option><?php foreach($danbao_list as $key=>$v){ if($vo["danbao"]==$key && $vo["danbao"]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select>
		  </dd>
        </dl>
		<dl class="lineD">
          <dt>担保金额：</dt>
          <dd>
           <input name="vouch_money" id="vouch_money"  class="input" type="text" value="<?php echo ($vo["vouch_money"]); ?>" ><span id="tip_vouch_money" class="tip">设置担保金额</span>
		  </dd>
        </dl>
		</div><?php endif; ?>
        <dl class="lineD">
          <dt>借款管理费：</dt>
          <dd>
            <input name="borrow_fee" id="borrow_fee"  class="input" type="text" value="<?php echo ($vo["borrow_fee"]); ?>" ><span id="tip_borrow_fee" class="tip">默认为按后台设置计算出来的，如果私下有协议可以改</span>
          </dd>
        </dl>
        <dl class="lineD">
          <dt>募集时间(天)：</dt>
          <dd>
            <input name="collect_day" id="collect_day"  class="input" type="text" value="<?php echo ($vo["collect_day"]); ?>" ><span id="tip_collect_day" class="tip">在前台展示天数，如在担心在设定时间内不能募集完成，可修改延长</span>
          </dd>
        </dl>
        <dl class="lineD">
          <dt>最多投标总额：</dt>
          <dd>
            <input name="borrow_max" id="borrow_max"  class="input" type="text" value="<?php echo ($vo["borrow_max"]); ?>" ><span id="tip_borrow_max" class="tip">0表示无限制</span>
          </dd>
        </dl>
		 <dl class="lineD">
          <dt>投标待收金额限制设置：</dt>
          <dd>
            <input name="money_collect" id="money_collect"  class="input" type="text" value="<?php echo ($vo["money_collect"]); ?>" ><span id="tip_money_collect" class="tip">0.00表示无限制</span>
          </dd>
        </dl>
        <dl class="lineD">
          <dt>是否通过：</dt>
          <dd>
            <?php $i=0;foreach($borrow_status as $k=>$v){ if(strlen("key1")==1&&$i==0){ ?><input type="radio" name="borrow_status" value="<?php echo ($k); ?>" id="borrow_status_<?php echo ($i); ?>" checked="checked" /><?php }elseif("key1"=="key1"&&$k==$vo["borrow_status"]){ ?><input type="radio" name="borrow_status" value="<?php echo ($k); ?>" id="borrow_status_<?php echo ($i); ?>" checked="checked" /><?php }elseif("key1"=="value1"&&$v==$vo["borrow_status"]){ ?><input type="radio" name="borrow_status" value="<?php echo ($k); ?>" id="borrow_status_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="borrow_status" value="<?php echo ($k); ?>" id="borrow_status_<?php echo ($i); ?>" /><?php } ?><label for="borrow_status_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++;} ?>
          </dd>
        </dl>
        <?php if($vo["borrow_status"] < '3' || $vo["borrow_status"] == '3'): ?><dl class="lineD">
            <dt>初审处理意见：</dt>
            <dd>
              <textarea name="deal_info" id="deal_info"  class="areabox" ><?php echo ($vv["deal_info"]); ?></textarea><span id="tip_deal_info" class="tip">*</span>
            </dd>
          </dl><?php endif; ?>
        <?php if($vo["borrow_status"] > '3'): ?><dl class="lineD">
            <dt>复审处理意见：</dt>
            <dd>
              <textarea name="deal_info_2" id="deal_info_2"  class="areabox" ><?php echo ($vv["deal_info_2"]); ?></textarea><span id="tip_deal_info_2" class="tip">*</span>
            </dd>
          </dl><?php endif; ?>
      </div>
      <!--tab3-->
      <?php if($arr[0]=='6'): ?><div id="tab_3"><?php else: ?><div id="tab_3" style="display:none"><?php endif; ?>
        <dl class="lineD">
          <dt>商品图片：</dt>
          <dd>
            <div style="display: inline; border: solid 1px #7FAAFF; background-color: #C5D9FF; padding: 2px;"><span id="spanButtonPlaceholder"></span></div>
          </dd>
        </dl>
        <dl class="lineD">
          <dt>图片预览：</dt>
          <dd>
            <table cellpadding="0" cellspacing="0" width="100%">
              <tr id="handfield">
                <td colspan="4" class="bline" style="background:url(images/albviewbg.gif) #fff 0 20px no-repeat;"><table width='100%' height='160' style="margin:0 0 20px 0">
                    <tr>
                      <td>
						
						<div id="divFileProgressContainer" style="height:75px;"></div>
			 		<div id="thumbnails">
				<?php $x=1000;foreach(unserialize($vo['updata']) as $v){ $x--; ?>
						<div class="albCt" id="albCtok<?php echo $x; ?>">
							<img width="120" height="120" src="__ROOT__/<?php echo get_thumb_pic($v['img']); ?>"><a onclick="javascript:delPic(<?php echo $x; ?>)" href="javascript:;">[删除]</a><a onclick="javascript:leftPic(<?php echo $x; ?>)" href="javascript:;">[前移]</a><a onclick="javascript:rightPic(<?php echo $x; ?>)" href="javascript:;">[后移]</a><div style="margin-top:10px">注释：<input type="text" style="width:190px;" value="<?php echo $v['info']; ?>" name="picinfo[]"><input type="hidden" value="__ROOT__/<?php echo $v['img']; ?>" name="swfimglist[]"></div>
						</div>					
				<?php } ?>
					</div>
						
						
						</td>
                    </tr>
                  </table></td>
              </tr>
            </table>
          </dd>
        </dl>
      </div>
      <div class="page_btm">
        <input type="submit" class="btn_b" value="确定" />
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">

function addone(){
	var htmladd = '<dl class="lineD"><dt>资料名称：</dt>';
		htmladd+= '<dd><input type="text" name="updata_name[]" value="" />&nbsp;&nbsp;更新时间:<input type="text" name="updata_time[]" onclick="WdatePicker();" class="Wdate" /></dd>';
		htmladd+= '</dl>';
	$(htmladd).appendTo("#tab_3");
}
var cansub = true;
function subcheck(){
	if(!cansub){
		alert("请不要重复提交，如网速慢，请等待！");
		return false;	
	}
	var deal_info = $("#deal_info").val();
	var deal_info_2 = $("#deal_info_2").val();
	var borrow_status = <?php echo ($vo["borrow_status"]); ?>;
	var borrow_money = $("#borrow_money").val();
	var vouch_money = $("#vouch_money").val();
	
	if(vouch_money>borrow_money){
		vouch_money = borrow_money;
		$("#vouch_money").val(borrow_money);
		ui.error("担保金额不能大于借款金额！");
		return false;
	}
	
	if(borrow_status<=3){
		if(deal_info ==""){
			ui.error("初审处理意见不能为空！");
			return false;
		}
	}else{
		if( deal_info_2 ==""){
			ui.error("复审处理意见不能为空！");
			return false;
		}
	}
	cansub = false;
	return true;
}
</script>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>