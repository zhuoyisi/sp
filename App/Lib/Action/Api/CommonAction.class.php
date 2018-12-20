<?php
/**
 * @funciton reg 注册
 * @funciton login 登录
 */
class CommonAction extends BaseAction {	
	/**
	 * 会员注册
	 * @param txtUsername  用户名
	 * @param txtPwd  密码
	 * @param codeId  验证码id
	 * @param txtCode  验证码
	 * @param txtIncode  推荐人用户名
	 */
	public function reg(){
		$jsons['status'] = "0";
		$data['user_name'] = text(urldecode($_REQUEST['txtUsername']));
		$data['user_phone'] = text($_REQUEST['txtPhone']);
		$data['user_pass'] = md5($_REQUEST['txtPwd']);
		$data['user_type'] = text($_REQUEST['user_type']) == 1 ? '1' : '0';
		
		if(empty($data['user_name']) || empty($_REQUEST['txtPwd'])){			
			$jsons["tips"]="注册失败，用户名或密码不能为空！";
			outJson($jsons);
		}
		$count = M('members')->where("user_name='{$data['user_name']}'")->count('id');
		if($count>0){			
			$jsons["tips"]="注册失败，用户名已经有人使用！";
			outJson($jsons);
		}

		if(preg_match("/^1[34578]\d{9}$/", $data['user_phone'])){			
			$map['user_phone'] = text($data['user_phone']);
			$count = M('members')->where($map)->count('id');
			if ($count>0) {				
				$jsons["tips"]="注册失败，当前手机已经使用！";
				outJson($jsons);
	        }	        
		}else{
			$jsons["tips"]="手机号不正确！";
			outJson($jsons);
		}
		$codeId = @$_REQUEST['codeId'];
		$txtCode = @$_REQUEST['txtCode'];
		$verifyRs = M('verify_code')->where("md5(id) = '{$codeId}' and content = {$txtCode}")->count('id');
		if($verifyRs!=1){			
			$jsons["tips"]="验证码错误！";
			outJson($jsons);
		}
		//获取推荐人
		$txtIncode = text($_POST['txtIncode']);
		if(!empty($txtIncode)){
			$txtRecUserid = M('members')->where("user_name='".$txtIncode."'")->getField('id');
			if(!empty($txtRecUserid)) {
				$data['recommend_id']=$txtRecUserid;
			}else{								
				$jsons["tips"]="推荐人不存在，若没有推荐人请留空。";
				outJson($jsons);
			};
		}

		$data['reg_time'] = time();
		$data['reg_ip'] = get_client_ip();
		$data['lastlog_time'] = time();
		$data['lastlog_ip'] = get_client_ip();
		if(session("tmp_invite_user"))  $data['recommend_id'] = session("tmp_invite_user");
		$newid = M('members')->add($data);
		if($newid){
			// 设置手机验证状态
			M("members_status")->add(array(
				  "uid" => $newid,
				  "phone_status" => 1,
				  "id_status" => 0,
				  "email_status" => 0,
				  "account_status" => 0,
				  "credit_status" => 0,
				  "safequestion_status" => 0,
				  "video_status" => 0,
				  "face_status" => 0
			  ));		
			M('member_info')->add(array(
				"uid" => $newid,
			));
			$jsons['uid'] = text($newid);
			Notice(1,$newid,array('email',$data['user_email']));
			$jsons["tips"] = "注册成功！";
			$jsons["status"]="1";
			outJson($jsons);
		}
		else{
			$jsons["tips"]="注册失败，请重试！";
			outJson($jsons);
		}
	}
	/**
	 * 登录接口
	 * @param txtUsername  用户名
	 * @param txtPwd  密码（md5）
	 */
	public function reg_agreement(){
		header("Location: ".U('api/index/article_content',array('show_type'=>'reg_agreement')));
	}
	public function login(){		
		$jsons["status"]="0";
		// (false!==strpos($_REQUEST['UserName'],"@param "))?$data['user_email'] = text($_REQUEST['UserName']):$data['user_name'] = text($_REQUEST['UserName']);
		$pre = C('DB_PREFIX');
		// $user_name = text($_POST['UserName']);
		// $user_pass = text($_POST['Password']);
		$user_name = text(urldecode($_REQUEST['txtUsername']));
		$user_pass = text($_REQUEST['txtPwd']);
		if(empty($user_name) || empty($user_pass)){			
			$jsons["tips"]="登录失败，用户名或密码不能为空！";
			outJson($jsons);
		}

		if(preg_match("/^1[34578]\d{9}$/", $user_name)){
			$whereStr = "(m.user_phone = '{$user_name}' and ms.phone_status = 1) or m.user_name = '{$user_name}'";
		}elseif(filter_var($user_name, FILTER_VALIDATE_EMAIL)){
			$whereStr = "(m.user_email = '{$user_name}' and ms.email_status = 1) or m.user_name = '{$user_name}'";
		}else{
			$whereStr = "m.user_name = '{$user_name}'";
		}

		$vo = M('members m')->field('m.id,m.user_name,m.user_email,m.user_pass,m.is_ban')->join($pre.'members_status ms on m.id=ms.uid')->where($whereStr)->find();
		if($vo['is_ban']==1){			
			$jsons["tips"]="您的帐户已被冻结，请联系客服处理！";
			outJson($jsons);
		}
		
		if( $vo["user_name"]=="" || !is_array($vo)){			
			$jsons["tips"]="用户名或者密码错误！";
			outJson($jsons);
		}
		if($vo['user_pass'] == $user_pass){
			$up['uid'] = $vo['id'];
			$up['add_time'] = time();
			$up['ip'] = get_client_ip();
			M('member_login')->add($up);
			$jsons['uid'] = text($vo['id']);
			$jsons['user_name'] = text($vo['user_name']);
			$jsons["status"]="1";
			$jsons["tips"]="登录成功！";
			outJson($jsons);
		}else{
			$jsons["tips"]="用户名或者密码错误！";				
			outJson($jsons);
		}		
	}
	/**
	 * 找回密码
	 * @param txtPhone  手机号
	 * @param txtPassword  新密码
	 * @param codeId  验证码id
	 * @param txtCode  验证码
	 */
	public function findpass(){
		$jsons['status']="0";
		$per = C('DB_PREFIX');
		$map['user_phone'] = text($_REQUEST['txtPhone']);

		$txtPassword = text($_REQUEST['txtPassword']);
		if($map['user_phone']==""){			
			$jsons['tips'] = "手机号不能为空";
			outJson($jsons);
		}
		if($txtPassword==""){			
			$jsons['tips'] = "密码不能为空";
			outJson($jsons);
		}
		$user = M('members')->where($map)->find();
		if ($user["id"]=="") {			
			$jsons['tips'] = "暂无此手机绑定的用户";
			outJson($jsons);
		}

		$codeId = @$_REQUEST['codeId'];
		$txtCode = @$_REQUEST['txtCode'];
		$verifyRs = M('verify_code')->where("md5(id) = '{$codeId}' and content = {$txtCode}")->count('id');
		if($verifyRs!=1){			
			$jsons['tips']="验证码错误！";
			outJson($jsons);
		}

		$oldpass = M("members")->getFieldById($user["id"],'user_pass');
		if($oldpass == md5($txtPassword)){
			$newid = true;
		}else{
			$newid = M()->execute("update {$per}members set `user_pass`='".md5($txtPassword)."' where id=".$user["id"]);
		}
		if($newid){
			$jsons['status']="1";
			$jsons['tips'] = "修改成功！";
			outJson($jsons);
		}else{
			$jsons['tips'] = "修改失败，请重试！";
			outJson($jsons);
		}
	}
	/**
	 * 发送验证码
	 */
	public function sendcode(){
		$jsons["status"]= "0";
		$code=rand(100000,999999);
		$txtPhone = $_REQUEST["txtPhone"];
		$act = isset($_REQUEST["act"]) ? text($_REQUEST["act"]) : '';		
		
		switch ($act) {
			case 'reg':
				$content= "您正在注册本站会员，验证码为:".$code;
				break;			
			case 'findpass':
				$content= "您正在使用本站找回密码功能，验证码为:".$code;
				break;
			default:
				$content= "您的验证码为:".$code;				
				break;
		}

		if( $txtPhone == "" || !preg_match("/^1[34578]\d{9}$/", $txtPhone) ){
			$jsons["status"]="0";			
			$jsons["tips"]="手机号格式不正确！";			
			outJson($jsons);
		}
		
		$map['user_phone'] = text($txtPhone);
		$count = M('members')->where($map)->count('id');
		if ($act == 'reg' && $count>0) {
			$jsons["status"]="0";			
			$jsons["tips"]="手机号已存在！";							
			outJson($jsons);
        }elseif($act == 'findpass' && $count<=0){
        	$jsons["status"]="0";			
			$jsons["tips"]="手机号不存在！";							
			outJson($jsons);
        }
		
		sendsms($txtPhone, $content);
		$addData = array('content'=>$code,'add_time'=>time());
		$codeId = M('verify_code')->add($addData);
		if($codeId){
			$jsons["status"]="1";
			$jsons["codeId"] = md5($codeId);
			$jsons["tips"]= '验证码已经发送至您的手机！';
			// $jsons["tips"]= '验证码已经发送至您的手机！'.$code.'';
		}
		outJson($jsons);
	}
}
