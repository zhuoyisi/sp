<?php if (!defined('THINK_PATH')) exit();?><meta name="renderer" content="ie-stand">
<?php if($email_status == '1'): ?><div style="overflow: auto; width: 594px; height: auto; text-align:center; padding:20px; font-size:18px" id="mybox2_content"> <span style="font-size:12px;color:#030303;"><img src="__ROOT__/Style/M/images/zhuce1.gif" style="vertical-align:middle">&nbsp;&nbsp;亲爱的[<?php echo session('u_user_name');?>]，您好，您已通过邮箱认证,认证的邮箱为：<?php echo ($email); ?><br/>
    <br/>
    如需修改邮箱，请联系网站管理员！</span> </div>
  <?php else: ?>
  <div style=" width: 600px; height: 460px;" id="mybox1_content">
    <div style="width:100%; margin:20px 0px 0px 0px;  height:36px;line-height:36px;background-position:0px -49px; "></div>
    <div style="width:100%; height:270px;">
      <div style="width:20%; height:270px; line-height:30px;float:left;font-size:14px;text-align:center ; "><img src="__ROOT__/Style/M/images/s_email.gif" style="vertical-align:middle"></div>
      <?php if($email == ''): ?><div style="width:80%; height:170px; line-height:30px;float:left;font-size:14px;">
       <span style="margin:20px;display:block; text-align:left;">
        <span style="font-size:12px;color:#030303;">请输入您的电子邮箱：
        <input type="text" style="width:173px;height:21px;line-height:21px;font-size:14px;font-weight:bold;margin:5px;" id="email">
        <a style="text-decoration:none; color:#333;" onclick="sendValidEmail()" href="javascript:;">【发送激活邮件】</a></span><br>
		<span style="font-size:12px;color:#030303;"><img src="__ROOT__/Style/M/images/zhuce1.gif" style="vertical-align:middle">&nbsp;&nbsp;请注意以下事项：</span><br>
        <span style="font-size:12px;color:#030303;">1、如果收件箱里没有收到该邮件，请查看垃圾箱，以免被误判为垃圾邮件。</span><br>
		<span style="font-size:12px;color:#030303;">2、如果您的邮箱长时间没有收到我们的激活邮件，请点击重新发送激活邮件：<br>
        <span style="font-size:12px;color:#030303;">3、如果您在验证过程中，出现任何问题，请联系客服。</span>
       </span>
      </div>
      <?php else: ?>
      <div style="width:80%; height:270px; line-height:30px;float:left;font-size:14px;"><span style="margin:20px;display:block; text-align:left;"><span style="font-size:12px;color:#030303;">请激活您的注册邮箱：
        <input type="text" style="width:173px;height:21px;line-height:21px;font-size:14px;font-weight:bold;margin:5px;" id="email" value="<?php echo ($email); ?>">
        <a style="text-decoration:none; color:#333;" onclick="sendValidEmail()" href="javascript:;">【发送激活邮件】</a></span><br>
        请立刻登录您的电子邮箱，完成验证。<br>
        <span style="font-size:12px;color:#030303;"><img src="__ROOT__/Style/M/images/zhuce1.gif" style="vertical-align:middle">&nbsp;&nbsp;请注意以下事项：</span><br>
        <span style="font-size:12px;color:#030303;">1、如果收件箱里没有收到该邮件，请查看垃圾箱，以免被误判为垃圾邮件。</span><br>
        <span style="font-size:12px;color:#030303;">2、如果您的邮箱长时间没有收到我们的激活邮件，请点击重新发送激活邮件：<br>
        <span style="font-size:12px;color:#030303;">3、如果您在验证过程中，出现任何问题，请联系客服。</span></span>
       </div><?php endif; ?>
    </div>
  </div><?php endif; ?>