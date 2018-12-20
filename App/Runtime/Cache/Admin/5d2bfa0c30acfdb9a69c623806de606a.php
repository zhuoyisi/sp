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

<div class="page_tit">修改分类-"<span style="color:red"><?php echo ($vo["type_name"]); ?></span>"</div>
<div class="page_tab"><span data="tab_1" class="active">基本设置</span><span data="tab_2">高级设置</span></div>
<div class="form2">
	<form method="post" action="__URL__/doEdit" onsubmit="return subcheck();">
	<input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>" />
	<div id="tab_1">
	
	<dl class="lineD"><dt>分类名称：</dt><dd><input name="type_name" id="type_name"  class="input" type="text" value="<?php echo ($vo["type_name"]); ?>" ><span id="tip_type_name" class="tip">*</span></dd></dl>
	<dl class="lineD"><dt>上级分类：</dt><dd><select name="parent_id" id="parent_id"   class="c_select"><option value="">顶级分类</option><?php foreach($type_list as $key=>$v){ if("id" && $v["id"]==$vo["parent_id"]){ ?><option value="<?php echo ($v["id"]); ?>" selected="selected"><?php echo ($v["type_name"]); ?></option><?php }else{ ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["type_name"]); ?></option><?php }} ?></select><span id="tip_parent_id" class="tip">顶级分类则无父分类</span></dd></dl>
	<dl class="lineD"><dt>分类唯一标志：</dt><dd><input name="type_nid" id="type_nid"  class="input" type="text" value="<?php echo ($vo["type_nid"]); ?>" ><span id="tip_type_nid" class="tip">*分类链接的网址标识</span></dd></dl>
	<dl class="lineD"><dt>分类属性：</dt><dd><?php $i=0;$___KEY=array ( 0 => '单页', 1 => '列表页', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="type_set" value="<?php echo ($k); ?>" id="type_set_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["type_set"]==$k)||("key"=="value"&&$vo["type_set"]==$v)){ ?><input type="radio" name="type_set" value="<?php echo ($k); ?>" id="type_set_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="type_set" value="<?php echo ($k); ?>" id="type_set_<?php echo ($i); ?>" /><?php } ?><label for="type_set_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?><span id="tip_type_set" class="tip">*</span></dd></dl>
	<dl class="lineD"><dt>分类排序：</dt><dd><input name="sort_order" id="sort_order"  class="input" type="text" value="<?php echo ($vo["sort_order"]); ?>" onblur="NumberCheck(this);"><span id="tip_sort_order" class="tip">数字越大越靠前</span></dd></dl>
<!--
	<dl class="lineD"><dt>分类简介：</dt><dd><textarea name="type_info" id="type_info"  class="areabox" ><?php echo ($vo["type_info"]); ?></textarea><span id="tip_type_info" class="tip">SEO元素</span></dd></dl>
-->	
	
	<dl class="lineD"><dt>是否隐藏：</dt><dd><?php $i=0;$___KEY=array ( 0 => '否', 1 => '是', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="is_hiden" value="<?php echo ($k); ?>" id="is_hiden_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["is_hiden"]==$k)||("key"=="value"&&$vo["is_hiden"]==$v)){ ?><input type="radio" name="is_hiden" value="<?php echo ($k); ?>" id="is_hiden_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="is_hiden" value="<?php echo ($k); ?>" id="is_hiden_<?php echo ($i); ?>" /><?php } ?><label for="is_hiden_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?><span id="tip_is_hiden" class="tip">隐藏的分类名称不会自动调用,指定ID才会调用</span></dd></dl>
	<!--<dl class="lineD"><dt>跳转路径：</dt><dd><input name="type_url" id="type_url"  class="input" type="text" value="<?php echo ($vo["type_url"]); ?>" ><span id="tip_type_url" class="tip">仅在分类属性为跳转时有效</span></dd></dl>-->
	</div><!--tab1-->
	
	<div id="tab_2" style="display:none">
		<dl class="lineD"><dt>分类内容：</dt>
		  <dd>
			<link href="__ROOT__/Style/Editor/editor/theme/base-min.css" rel="stylesheet"/>
<!--[if lt IE 8]>
<link href="__ROOT__/Style/Editor/editor/theme/cool/editor-pkg-sprite-min.css" rel="stylesheet"/>
<![endif]-->
<!--[if gte IE 8]><!-->
<link href="__ROOT__/Style/Editor/editor/theme/cool/editor-pkg-min-datauri.css" rel="stylesheet"/>
<!--<![endif]-->
<script src="__ROOT__/Style/Editor/kissy-min.js"></script>
<script src="__ROOT__/Style/Editor/uibase-min.js"></script>
<script src="__ROOT__/Style/Editor/dd-min.js"></script>
<script src="__ROOT__/Style/Editor/component-min.js"></script>
<script src="__ROOT__/Style/Editor/overlay-min.js"></script>

<script src="__ROOT__/Style/Editor/editor/editor-all-pkg-min.js?t=20101223a"></script>
<script src="__ROOT__/Style/Editor/editor/biz/ext/editor-plugin-pkg-min.js?t=20101223a"></script>
<script>
function loadEditor(textareaId) {
    KISSY.use('editor', function() {
        var KE = KISSY.Editor;
        var EDITER_UPLOAD = "<?php echo U('/admin/kissy/index/');?>";
       
        //编辑器内弹窗 z-index 底限，防止互相覆盖
        KE.Config.baseZIndex = 10000;

        var cfg = {
            attachForm:true,
            baseZIndex:10000,
            focus:false,
            pluginConfig: {
                "image":{
                    upload:{
                        serverUrl:EDITER_UPLOAD,
                        surfix:"png,jpg,jpeg,gif,bmp",
                        sizeLimit:"2000" // K
                    }
                },
                "flash":{
                    defaultWidth:"300",
                    defaultHeight:"300"
                },
				
                "draft":{
                    interval:5,
                    limit:10,
                    helpHtml:  "<div " +
                            "style='width:200px;'>" +
                            "<div style='padding:5px;'>草稿箱能够自动保存您最新编辑的内容，" +
                            "如果发现内容丢失，" +
                            "请选择恢复编辑历史</div></div>"
                },
				
                "resize":{
                    direction:["y"]
                }
            }
        };

        KE("#"+textareaId, cfg).use(
			"sourcearea," +
            "preview,separator," +
            "undo,separator," +
            "removeformat,font,format,color,table,separator," +
            "list,indent,justify,separator," +
            "link,image,flash,xiami-music,smiley,separator," +
            "video," +
            "draft," +
            "maximize");
    });
}

function getEditorWordCount() {
	var count = 0;
	
	return count;
}
</script>
			<!-- 编辑器调用开始 -->
				<textarea name="type_content" id="type_content" style="width:780px;height:320px;"><?php echo ($vo["type_content"]); ?></textarea>
				<script>
				
					loadEditor("type_content");
				
				</script>
				<!-- 编辑器调用结束 -->
		  </dd>
		</dl>
	</div><!--tab2-->
	<div class="page_btm">
      <input type="hidden" name="model" id="model" value="<?php echo ($vo["model"]); ?>" />
	  <input type="submit" class="btn_b" value="确定" />
	</div>
	</form>
</div>

</div>
<script type="text/javascript">
$("input[name='type_nid']").bind("click", function(event){
	if($(this).val()=="other"){
		$("#other_nid").css("display","");
	}else{
		$("#other_nid").css("display","none");
	}
})

var cansub = true;
function subcheck(){
	if(!cansub){
		alert("请不要重复提交，如网速慢，请等待！");
		return false;	
	}
return true;
}
</script>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>