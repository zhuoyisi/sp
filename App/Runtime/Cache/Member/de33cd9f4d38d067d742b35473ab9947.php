<?php if (!defined('THINK_PATH')) exit();?><link href="__ROOT__/Style/Swfupload/swfupload.css" rel="stylesheet" type="text/css"> 

<script type="text/javascript" src="__ROOT__/Style/Js/ajaxfileupload.js"></script>
<style type="text/css">
	.alertDiv { margin: 0px auto; background-color: #FEFACF; border: 1px solid green; line-height: 25px; background-image: url(__ROOT__/Style/M/images/info/001_30.png); background-position: 20px 4px; background-repeat: no-repeat; }
	.btnsave { background-image: url(__ROOT__/Style/M/images/btnsave.jpg); background-repeat: no-repeat; cursor: pointer; width: 74px; height: 26px; border: none; }
	.alertDiv li { margin: 5px 0; list-style-type: decimal; color: #005B9F; padding: 0px; line-height: 20px; }
	.alertDiv ul { text-align: left; list-style-type: decimal; display: block; padding: 0px; margin: 0px 0px 0px 75px; }
	.tdContent { text-align: left; border-bottom: dashed 1px #ccc; font-size: 12px; height: 32px; color: #000; text-indent: 20px; line-height: 32px; }
	.tdEven { background-color: #E8F9F9; }
	.tdHeard { text-align: center; vertical-align: middle; font-size: 12px; font-weight: bold;  height: 25px;  background-color: #F5F5F5; border: 1px #FFF solid; }
	.upfile { width: 195px; border: 1px solid #ccc; background-color: #f9f9f9; margin-right: 4px; vertical-align: middle; height: 22px; cursor: default; line-height: 24px; }
	.trBg { border-top: 1px solid #dedede; border-bottom: 1px solid #dedede; background-color: #f6f6f6; width: 100%; }
	.tdHeard { border: 0px; border-bottom: 1px solid #dedede; border-top: 1px solid #dedede; }
	.tdContent { border: 0px; border-bottom: 1px solid #dedede; height: 32px; }
	.dv_header_8 { background-image: url(); }
	.dv_account_0 { margin-top: 10px; }
	.tdContent{padding-left:0px;  }
</style>


<div style="text-align: left; padding: 2px 0px 0px 8px; width: 100%;">

       <tr>
            <td class="tdTitle">	上传文件：</td>
            <td class="tdContent_pingzheng">
                <div style="display: inline; border: solid 1px #7FAAFF; background-color: #C5D9FF; padding: 5px;">
                    <span id="spanButtonPlaceholder"></span>
                </div>
                
                <dt>图片预览：</dt>
          
                    <table cellpadding="0" cellspacing="0" width="100%" style="margin:0 0 0px 0">
                        <tr id="handfield">
                              <td class="bline" style="background:url(images/albviewbg.gif) #fff 0 20px no-repeat;">
                                <div id="divFileProgressContainer" ></div>
                                <div id="thumbnails"></div>
                              </td>
                        </tr>
                    </table>
               
            </td>
        </tr>
	<input name="uploadFile" id="uploadFile" class="upfile" type="file" style="display:none"><br />
    请输入文件名字：
<input style="height:20px;border: 1px solid #ccc; margin:5px 0 5px 17px; padding-right:4px; background-color: #f9f9f9; line-height:20px" type="text" id="filetxt"  /><br />
<select name="data_type" id="data_type" style="padding:3px"  class="c_select"><option value="">--请选择--</option><?php foreach($to_upload_type as $key=>$v){ if($_X[""]==$key && $_X[""]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select><span id="tip_data_type" class="tip">资料分类</span>&nbsp;&nbsp;&nbsp;
	<input id="btnUpload" value=" " class="thickbox" title="上传文件" style="width: 55px;	border: none; background-image: url(__ROOT__/Style/M/images/account/fileupload.jpg);border: none; cursor: pointer; height: 20px; margin-right:0px;" type="button" onclick="upfile();"><span style="margin-left:10px; margin-right:0px"><img id="loading_makeclub" style="visibility:hidden" src="__ROOT__/Style/Js/loading.gif" /></span>
</div>
<div style="height:auto; margin-top: 10px; float: left; display: inline-block;text-align: left;">
	<table id="content" style="width: 803px; margin-top: 2px;
		border-collapse: collapse; " cellpadding="0" cellspacing="1">
		<tbody><tr class="trBg">
			<th scope="col" class="tdHeard" style="width: 180px; height: 36px; text-align: left;padding-left: 20px;">
				文件名
			</th>
			<th scope="col" class="tdHeard">
				资料分类
			</th>
			<th scope="col" class="tdHeard">
				审核状态
			</th>
			<th scope="col" class="tdHeard">
				操作(说明)
			</th>
		</tr>
		
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vx): $mod = ($i % 2 );++$i;?><tr class="tdEven" id="xf_<?php echo ($vx["id"]); ?>">
		<td class="tdContent" style="width: 350px;text-align:center;text-indent:10px;" title="<?php echo ($vx["data_name"]); ?>"><?php echo (cnsubstr($vx["data_name"],8)); ?></td>
		<td class="tdContent" style="text-align:center;"><?php echo ($vx["class_name"]); ?></td>
		<td class="tdContent" style="text-align:center;"><?php if($vx["status"] == 1): ?><a style="color:red">审核通过</a>
        <?php elseif($vx["status"] == 2): ?>
       审核未通过
        <?php else: ?>未审核<?php endif; ?></td>
		<td class="tdContent" style="text-align:center;">
        <?php if($vx["status"] == 0): ?><input id="btndel" value=" " style="width: 55px; height: 20px; border: none;background-image: url(__ROOT__/Style/M/images/account/filedelete.jpg);cursor: pointer; border: none;" type="button" onclick="delfile(<?php echo ($vx["id"]); ?>);">
    	<?php elseif($vx["status"] == 1): ?>
        加<?php echo (($vx["deal_credits"])?($vx["deal_credits"]):0); ?>个积分
        <?php else: ?>
	<input title="<?php echo ($vx["deal_info"]); ?>" id="btndel" value=" " style="width: 55px; height: 20px; border: none;background-image: url(__ROOT__/Style/M/images/account/filedelete.jpg);cursor: pointer; border: none;" type="button" onclick="delfile(<?php echo ($vx["id"]); ?>);"><?php endif; ?> 
        <?php if($vx["data_url"] != ndefined): ?>| <a href="__ROOT__/<?php echo ($vx["data_url"]); ?>" target="_blank">资料1</a><?php endif; ?> 
        <?php if($vx["data_url1"] != ndefined): ?>| <a href="__ROOT__/<?php echo ($vx["data_url1"]); ?>" target="_blank">资料2</a><?php endif; ?> 
         <?php if($vx["data_url2"] != ndefined): ?>| <a href="__ROOT__/<?php echo ($vx["data_url2"]); ?>" target="_blank">资料3</a><?php endif; ?> 
         <?php if($vx["data_url3"] != ndefined): ?>| <a href="__ROOT__/<?php echo ($vx["data_url3"]); ?>" target="_blank">资料4</a><?php endif; ?> 
         <?php if($vx["data_url4"] != ndefined): ?>| <a href="__ROOT__/<?php echo ($vx["data_url4"]); ?>" target="_blank">资料5</a><?php endif; ?> 
        
        
		</td>
	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	<tr><td colspan="6" class="ajaxpagebar"  data="info6"><?php echo ($page); ?></td></tr>
	</tbody>
	</table>

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
              	if(d) $("#"+id).html(d.content);//更新客户端竞拍信息 作个判断，避免报错
            }
        });
	}catch(e){};
	return false;
})

function delfile(id){
	if(!confirm("删除后不可恢复，确定要删除吗?")) return;
        $.ajax({
            url: "__URL__/delfile",
            data: {"id":id},
            timeout: 5000,
            cache: false,
            type: "post",
            dataType: "json",
            success: function (d, s, r) {
              	if(d){
					if(d.status==1){
						$.jBox.tip("删除成功",'success');
						$("#xf_"+id).remove();
					}else{
						$.jBox.tip(d.message,'fail');
					}
				}
            }
        });
}

function upfile()
{
	$("#loading_makeclub").ajaxStart(function(){	$(this).css("visibility","visible");	}).ajaxComplete(function(){	$(this).css("visibility","hidden");	});
	var name = $("#filetxt").val();
	var fname = $("#uploadFile").val();
	var data_type = $("#data_type").val();
	var img1=$(".albCt input").attr('id');
	var img1=img1;
	var img2=parseInt(img1)+1;
	
	var img3=parseInt(img2)+1;
	var img4=parseInt(img3)+1;
	var img5=parseInt(img4)+1;
	
	var tupian1=$(".tupian_"+img1).val();
	var tupian2=$(".tupian_"+img2).val();
	var tupian3=$(".tupian_"+img3).val();
	var tupian4=$(".tupian_"+img4).val();
	var tupian5=$(".tupian_"+img5).val();
	if(!tupian1){
		$.jBox.tip("请必须上传一张资料",'tip');
		return;
	}
	
	if(data_type==""){
		$.jBox.tip("请选择资料分类",'tip');
		return;
	}

	if(name=="文件名称" || name==""){
		$.jBox.tip("请输入此上传文件的文件名",'tip');
		return;
	}
	$.jBox.tip("上传中......","loading");
	$.ajaxFileUpload({
			url:'__URL__/editdata/?name='+name+'&tupian1='+tupian1+'&tupian2='+tupian2+'&tupian3='+tupian3+'&tupian4='+tupian4+'&tupian5='+tupian5+'&data_type='+data_type,
			secureuri:false,
			fileElementId:'uploadFile',
			dataType: 'json',
			success: function (data, status)
			{
				if(data.status==1){
					$("#uploadFile").val('');
					$("#filetxt").val('');
					$.jBox.tip(data.message,'success');
					updatedata();
				}
				else  $.jBox.tip(data.message,'fail');
			}
		})
}

function updatedata(){
        $.ajax({
            url: "__URL__/editdata/",
            data: {},
            timeout: 5000,
            cache: false,
            type: "get",
            dataType: "json",
            success: function (d, s, r) {
              	if(d) $("#fragment-7").html(d.html);//更新客户端信息 作个判断，避免报错
            }
        });
}
</script>


<!-- 上传-->


<script type="text/javascript" src="__ROOT__/Style/Swfupload/handlers2.js"></script>
<script type="text/javascript" src="__ROOT__/Style/Swfupload/swfupload.js"></script>
<script type="text/javascript">
    var IS_AD = true;
    $(document).ready(function() {
        //swf上传图片
        swfu = new SWFUpload(
        {
            // Backend Settings
            upload_url: "__URL__/uploadImg",
            post_params: {"PHPSESSID": "<?php echo session_id(); ?>", "dopost" : ""},

            // File Upload Settings
            file_size_limit : "2 MB",    // 2MB
            file_types : "*.jpg; *.gif; *.docx; *.doc; *.txt; *.xls; *.png",
            file_types_description : "选择 JPEG/GIF/PNG 格式图片",
            file_upload_limit : "5",

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

    var albImg = 0;
    function addImage(src, pid,imgurl){
        var newImgDiv = document.createElement("div");
        var delstr = '';
        var iptwidth = 180;
        albImg++;
        if(pid != 0) {
            albImg = 'ok' + pid;
            delstr = '<a href="javascript:;" onclick="delPic('+pid+')">[删除]</a>';
        } else {
            albImg = 'err' + albImg;
        }
        newImgDiv.className = 'albCt';
        newImgDiv.id = 'albCt'+albImg;
        document.getElementById("thumbnails").appendChild(newImgDiv);

        if(typeof swf_justimg != 'undefined' && swf_justimg == true){
            newImgDiv.innerHTML = '<img src="'+src+'"/>';
            newImgDiv.innerHTML += '<input type="hidden" name="swfimglist[]" value="'+src+'" />';
        }else{
            newImgDiv.innerHTML = '<img src="'+src+'" width="120" height="120" />'+delstr;
            
            if(typeof arctype != 'undefined' && arctype ==  'article' )
            { 
                iptwidth = 100;
                if(pid != 0) {
                    newImgDiv.innerHTML = '<img src="'+src+'" width="120" onClick="addtoEdit('+pid+')"/>'+delstr;
                }
            }
            newImgDiv.innerHTML += '<input type="hidden" name="swfimglist[]" value="'+src+'" id="'+pid+'" class="tupian_'+pid+'" />';      
        }
    }

    //swf上传后删除图片start
    function delPic(id){
        var imgpath = $("#albCtok"+id).find("input[type='hidden']").eq(0).val();
        var datas = {'picpath':imgpath,'oid':id};
        $.post("__URL__/uploadimg?delpic", datas, picdelResponse,'json');
    }

    function picdelResponse(res){
        var imgdiv = $("#albCtok"+res.data);
            imgdiv.remove();
            ui.success(res.info);
            ui.box.close();
    }
    //swf上传后删除图片end
</script>