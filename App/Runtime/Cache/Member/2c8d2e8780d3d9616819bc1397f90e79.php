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
<div style="margin: 10px 0px; overflow: hidden; text-align: left; clear: both; float: left;
    padding-left: 6px;">
    <table id="content" style="width: 785px; border-collapse: collapse;" cellspacing="0">
        <tbody><tr>
            <th scope="col" class="tdHeard" style="width: 63px;">
                借款者
            </th>
            <th scope="col" class="tdHeard" style="width: 130px;">
                借款标
            </th>
            <th scope="col" class="tdHeard" style="width: 73px;">
                利率
            </th>
            <th scope="col" class="tdHeard" style="width: 103px;">
                未还/总期数
            </th>
            <th scope="col" class="tdHeard" style="width: 123px;">
                待收本金/待收利息
            </th>
            <th scope="col" class="tdHeard" style="width: 143px;">
                投资时间
            </th>
            <th scope="col" class="tdHeard" style="width: 143px;">
                到期时间
            </th>
            <th scope="col" class="tdHeard" style="width: 73px;">
                操作
            </th>
        </tr>
        <?php if(is_array($list["data"])): $i = 0; $__LIST__ = $list["data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="noinfotip" style="">
            <td class="tdContent"><?php echo ($vo["user_name"]); ?></td>
            <td class="tdContent" style="padding:0"><a target="_blank" href="<?php echo (getinvesturl($vo["borrow_id"])); ?>" title="<?php echo ($vo["borrow_name"]); ?>"><?php echo (cnsubstr($vo["borrow_name"],10)); ?></a></td>
            <td class="tdContent"><?php echo ($vo["borrow_interest_rate"]); ?>%</td>
            <td class="tdContent"><?php echo ($vo["re_num"]); ?>期/<?php echo ($vo["total"]); ?>期</td>
            <td class="tdContent">￥<?php echo ($vo["capital"]); ?>/￥<?php echo ($vo["interest"]); ?></td>
            <td class="tdContent"><?php echo (date("Y-m-d h:i",$vo["add_time"])); ?></td>
            <td class="tdContent"><?php echo (date("Y-m-d h:i",$vo["deadline"])); ?></if></td>
            <td class="tdContent"><a href="javascript:void(0)" onclick="sellhtml('<?php echo ($vo["id"]); ?>')">转让</a></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody></table>
<div data="fragment-1" id="pager" style="float: right; text-align: right; width: 500px; padding-right: 0px;" class="yahoo2 ajaxpagebar"><?php echo ($list["page"]); ?></div>
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
                  if(d) $("#"+id).html(d.html);
            }
        });
    }catch(e){};
    return false;
})

function sellhtml(id) {
    $.jBox("get:__URL__/sellhtml?id="+id, {
        title: "债权转让",
        width: "auto",
        buttons: {}
    });   
}

</script>