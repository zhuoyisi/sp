<?php if (!defined('THINK_PATH')) exit();?><form class="ajax-invest" method="post" name="investForm" id="investForm" action="__URL__/investmoney">
	<input type="hidden" name="borrow_id" id="borrow_id" value="<?php echo ($vo["id"]); ?>" />
	<input type="hidden" name="money" id="money" value="<?php echo ($investMoney); ?>" />
    <ul class="item">
			<?php if($has_pin == 'yes'): ?><li>
					<h6>支付密码</h6>
					<input type="password" id="pin" name="pin" />
				</li>
				<?php if(!empty($vo['password'])): ?><li>
					<h6>定向标密码</h6>
					<input type="password" id="borrow_pass" name="borrow_pass" />
				</li><?php endif; ?>
				<li>
					<div>
					<a href="javascript:void(0);" class="center" onclick="PostData()">立即投资</a>
					</div>
				</li>
			<?php else: ?>
				<li>
					<a href='__APP__/member/user#fragment-3' target="_blank" onclick="$.jBox.close();" class="center">请设置支付密码</a>
				</li><?php endif; ?>
	</ul>
</form>
<script type="text/javascript">
borrow_min = <?php echo (($vo["borrow_min"])?($vo["borrow_min"]):0); ?>;
borrow_max = <?php echo (($vo["borrow_max"])?($vo["borrow_max"]):0); ?>;
</script>