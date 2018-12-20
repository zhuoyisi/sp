<?php
// 本类由系统自动生成，仅供测试用途
class CommonAction extends MCommonAction {
	var $notneedlogin=true;
    public function index(){
		$this->display();
    }
	
    public function login(){
		$loginconfig = FS("Webconfig/loginconfig");//判断快捷登录是否开启
		$this->assign("loginconfig",$loginconfig);
		$this->display();
    }
	
    public function register(){
		$loginconfig = FS("Webconfig/loginconfig");//判断快捷登录是否开启
		$this->assign("loginconfig",$loginconfig);
		if($_GET['invite']){
		#	$uidx = M('members')->getFieldByUserName(text($_GET['invite']),'id');
			#echo M()->getLastSql();
			//if($uidx>0) session("tmp_invite_user",$uidx);
			$user_name = M('members')->field("user_name")->where("id = {$_GET['invite']}")->find();
			session("tmp_invite_user",$_GET['invite']);
		}
		$this->assign("user_name",$user_name);
		$this->display();
    }
	
	private function actlogin_bak(){
		(false!==strpos($_POST['sUserName'],"@"))?$data['user_email'] = text($_POST['sUserName']):$data['user_name'] = text($_POST['sUserName']);
		$vo = M('members')->field('id,user_name,user_email,user_pass')->where($data)->find();
		if($vo){
			$this->_memberlogin($vo['id']);
			ajaxmsg();
		}else{
			ajaxmsg("用户名不存在",0);	
		}
	}
	
	//实现首页登录
	
		public function actloginshouye(){
		setcookie('LoginCookie','',time()-10*60,"/");
		//uc登陆
		
		$loginconfig = FS("Webconfig/loginconfig"); 
		$uc_mcfg  = $loginconfig['uc'];
		if($uc_mcfg['enable']==1){
			require_once C('APP_ROOT')."Lib/Uc/config.inc.php";
			require C('APP_ROOT')."Lib/Uc/uc_client/client.php";
		}
		
		//uc登陆
//		if($_SESSION['verify'] != md5(strtolower($_POST['sVerCode']))) 
//		{
//			ajaxmsg("验证码错误!",0);
//		}
		
		(false!==strpos($_POST['sUserName'],"@"))?$data['user_email'] = text($_POST['sUserName']):$data['user_name'] = text($_POST['sUserName']);
		$vo = M('members')->field('id,user_name,user_email,user_pass,is_ban')->where($data)->find();
		if($vo['is_ban']==1) ajaxmsg("您的帐户已被冻结，请联系客服处理！",0);
		
		if(!is_array($vo)){
			//本站登陆不成功，偿试uc登陆及注册本站
			if($uc_mcfg['enable']==1){
				list($uid, $username, $password, $email) = uc_user_login(text($_POST['sUserName']), text($_POST['sPassword']));
				if($uid > 0) {
					$regdata['txtUser'] = text($_POST['sUserName']);
					$regdata['txtPwd'] = text($_POST['sPassword']);
					$regdata['txtEmail'] = $email;
					$newuid = $this->ucreguser($regdata);
                     
					if(is_numeric($newuid)&&$newuid>0){
						$logincookie = uc_user_synlogin($uid);//UC同步登陆
						setcookie('LoginCookie',$logincookie,time()+10*60,"/");
						$this->_memberlogin($newuid);
						ajaxmsg();//登陆成功
					}else{
						ajaxmsg($newuid,0);
					}
				}
			}
			//本站登陆不成功，偿试uc登陆及注册本站
			ajaxmsg("用户名或者密码错误！",0);
		}else{
			       
			if($vo['user_pass'] == md5($_POST['sPassword']) ){//本站登陆成功，uc登陆及注册UC
				//uc登陆及注册UC
				if($uc_mcfg['enable']==1){
					$dataUC = uc_get_user($vo['user_name']);
					if($dataUC[0] > 0) {
						$logincookie = uc_user_synlogin($dataUC[0]);//UC同步登陆
						setcookie('LoginCookie',$logincookie,time()+10*60,"/");
					}else{
						$uid = uc_user_register($vo['user_name'], $_POST['sPassword'], $vo['user_email']);
						if($uid>0){
							$logincookie = uc_user_synlogin($dataUC[0]);//UC同步登陆
							setcookie('LoginCookie',$logincookie,time()+10*60,"/");
						}
					}
				}
				//uc登陆及注册UC
				$this->_memberlogin($vo['id']);
				ajaxmsg();
			}else{//本站登陆不成功
				ajaxmsg("用户名或者密码错误！",0);
			}

		}
	}
	//首页登录结束
	
	
	public function actlogin(){
		setcookie('LoginCookie','',time()-10*60,"/");
		//uc登陆
		
		$loginconfig = FS("Webconfig/loginconfig"); 
		$uc_mcfg  = $loginconfig['uc'];
		if($uc_mcfg['enable']==1){
			require_once C('APP_ROOT')."Lib/Uc/config.inc.php";
			require C('APP_ROOT')."Lib/Uc/uc_client/client.php";
		}
		
		//uc登陆
		if($_SESSION['verify'] != md5(strtolower($_POST['sVerCode']))) 
		{
			ajaxmsg("验证码错误!",0);
		}
		
		(false!==strpos($_POST['sUserName'],"@"))?$data['user_email'] = text($_POST['sUserName']):$data['user_name'] = text($_POST['sUserName']);                  
		$vo = M('members')->field('id,user_name,user_email,user_pass,is_ban')->where($data)->find();
		if($vo['is_ban']==1) ajaxmsg("您的帐户已被冻结，请联系客服处理！",0);
//		if($vo['is_ban']==2) ajaxmsg("您的帐户已被冻结，请联系客服处理！",0);
//                读取网站登录次数设置
		$lnum =M('global')->where("code='login_num'")->getField('text'); 
                                         $login_num= intval($lnum);
                                         if($login_num=='0'){        //登录错误次数不受限制
                                             $this->loginlog($vo,0,0);
                                         }else{
                                                  $time = strtotime(date("Y-m-d",time()));
                                                  $where = ' and add_time >'.$time.' and add_time<'.($time+3600*24);
                                                  $fail_login_num =M('member_login')-> where("is_success=1 and uid={$vo['id']}{$where}")->count();
                                                  $ttime =$login_num-1-$fail_login_num;
                                                  if($fail_login_num>$login_num) {
                                                      ajaxmsg("账号密码错误，您还可以登录{$ttime}次",0);  exit;       
                                                  }elseif($fail_login_num==$login_num) {
                                                      $Mdata['is_ban'] = '2';
                                                      M('members')->where('id='.$vo['id'])->save($Mdata);
                                                      ajaxmsg("账号密码错误，今天登录次数超限，请明天再登陆",0); exit;   
                                                  }else{
                                                       $this->loginlog($vo,1,$ttime); 
                                                  }
                                       }           
		
	}
        /**
         * 
         * @param void $vo  登录信息
         * @param int $type  是否开启登录次数限制 0为不限制，1为限制
         */
        protected function loginlog($vo,$type,$ttime){
            $loginconfig = FS("Webconfig/loginconfig"); 
            $uc_mcfg  = $loginconfig['uc'];
            if($uc_mcfg['enable']==1){
                    require_once C('APP_ROOT')."Lib/Uc/config.inc.php";
                    require C('APP_ROOT')."Lib/Uc/uc_client/client.php";
            }
                if(!is_array($vo)){
                      //本站登陆不成功，偿试uc登陆及注册本站
                      if($uc_mcfg['enable']==1){
                              list($uid, $username, $password, $email) = uc_user_login(text($_POST['sUserName']), text($_POST['sPassword']));
                              if($uid > 0) {
                                      $regdata['txtUser'] = text($_POST['sUserName']);
                                      $regdata['txtPwd'] = text($_POST['sPassword']);
                                      $regdata['txtEmail'] = $email;
                                      $newuid = $this->ucreguser($regdata);

                                      if(is_numeric($newuid)&&$newuid>0){
                                              $logincookie = uc_user_synlogin($uid);//UC同步登陆
                                              setcookie('LoginCookie',$logincookie,time()+10*60,"/");
                                              $this->_memberlogin($newuid,0);
                                              ajaxmsg();//登陆成功
                                      }else{
                                              ajaxmsg($newuid,0);
                                      }
                              }  else {
                                   ajaxmsg("用户名或者密码错误！",0); 
                              }
                      }else{
                          //本站登陆不成功，偿试uc登陆及注册本站
                           ajaxmsg("用户名或者密码错误！",0); exit;  
                      }
              }else{

                      if($vo['user_pass'] == md5($_POST['sPassword']) ){//本站登陆成功，uc登陆及注册UC
                              //uc登陆及注册UC
                              if($uc_mcfg['enable']==1){
                                      $dataUC = uc_get_user($vo['user_name']);
                                      if($dataUC[0] > 0) {
                                              $logincookie = uc_user_synlogin($dataUC[0]);//UC同步登陆
                                              setcookie('LoginCookie',$logincookie,time()+10*60,"/");
                                      }else{
                                              $uid = uc_user_register($vo['user_name'], $_POST['sPassword'], $vo['user_email']);
                                              if($uid>0){
                                                      $logincookie = uc_user_synlogin($dataUC[0]);//UC同步登陆
                                                      setcookie('LoginCookie',$logincookie,time()+10*60,"/");
                                              }
                                      }
                              }
                              //uc登陆及注册UC
                              $this->_memberlogin($vo['id'],0);
                              ajaxmsg();
                      }else{//本站登陆不成功
                           $this->_memberlogin($vo['id'],1);
                          if($type=='1'){
                                if($ttime<='0'){
                                     $data['is_ban'] = '2';
                                      M('members')->where('id='.$vo['id'])->save($data);
                                    ajaxmsg("账号密码错误，今天登录次数超限，请明天再登陆",0);    
                                }else{
                                    ajaxmsg("用户名或者密码错误,您还可以登录{$ttime}次",0);    
                                }   
                          }else{
                                 ajaxmsg("用户名或者密码错误！",0); 
                          }  
                      }
              }
        }
	public function actlogout(){
		$this->_memberloginout();
		//uc登陆
		$loginconfig = FS("Webconfig/loginconfig");
		$uc_mcfg  = $loginconfig['uc'];
		if($uc_mcfg['enable']==1){
			require_once C('APP_ROOT')."Lib/Uc/config.inc.php";
			require C('APP_ROOT')."Lib/Uc/uc_client/client.php";
			$logout = uc_user_synlogout();
		}
		//uc登陆
		$this->assign("uclogout",de_xie($logout));
		$this->success("注销成功",__APP__."/");
	}
	
	private function ucreguser($reg){
		$data['user_name'] = text($reg['txtUser']);
		$data['user_pass'] = md5($reg['txtPwd']);
		$data['user_email'] = text($reg['txtEmail']);
		$count = M('members')->where("user_email = '{$data['user_email']}' OR user_name='{$data['user_name']}'")->count('id');
		if($count>0) return "登陆失败,UC用户名冲突,用户名或者邮件已经有人使用";
		$data['reg_time'] = time();
		$data['reg_ip'] = get_client_ip();
		$data['last_log_time'] = time();
		$data['last_log_ip'] = get_client_ip();
		$newid = M('members')->add($data);
		
		if($newid){
			session('u_id',$newid);
			session('u_user_name',$data['user_name']);
			return $newid;
		}
		return "登陆失败,UC用户名冲突";
	}
	
	public function regtemp(){
		session('email_temp',text($_POST['txtEmail']));
	    session('name_temp',text($_POST['txtUser']));
		session('pwd_temp',md5($_POST['txtPwd']));
		session('code_temp',$_POST['sVerCode']);
		session('rec_temp',text($_POST['txtRec']));
		session('transfer_temp',text($_POST['is_transfer']));
		ajaxmsg();
	}
	public function regaction(){
	if(session('email_temp')){
		$data['user_email'] = session('email_temp');
		}
		$data['user_name'] = session('name_temp');
		$data['user_pass'] = session('pwd_temp');
		$data['code'] = session('code_temp');
		$data['is_transfer'] = session('transfer_temp');
		if(session('temp_phone')){
		    $data['user_phone'] = session('temp_phone');
		}
		//`mxl:regnodb`
		$ruser = $data['user_name'];
		$Retemp1 = M('members')->field("id")->where("user_name = '{$ruser}'")->find();
		$Retemp2 = M('ausers')->field("id")->where("user_name = '{$ruser}'")->find();
		if ($Retemp1['id'] > 0 || $Retemp2['id'] > 0) {
			ajaxmsg('用户名已经存在',0);
		}
		//`mxl:regnodb`
		//uc注册
		$loginconfig = FS("Webconfig/loginconfig");
		$uc_mcfg  = $loginconfig['uc'];
		if($uc_mcfg['enable']==1){
			require_once C('APP_ROOT')."Lib/Uc/config.inc.php";
			require C('APP_ROOT')."Lib/Uc/uc_client/client.php";
			$uid = uc_user_register($data['user_name'], $_POST['txtPwd'], $data['user_email']);
			if($uid <= 0) {
				if($uid == -1) {
					ajaxmsg('用户名不合法',0);
				} elseif($uid == -2) {
					ajaxmsg('包含要允许注册的词语',0);
				} elseif($uid == -3) {
					ajaxmsg('用户名已经存在',0);
				} elseif($uid == -4) {
					ajaxmsg('Email 格式有误',0);
				} elseif($uid == -5) {
					ajaxmsg('Email 不允许注册',0);
				} elseif($uid == -6) {
					ajaxmsg('该 Email 已经被注册',0);
				} else {
					ajaxmsg('未定义',0);
				}
			}
		}
		//uc注册
		
		$data['reg_time'] = time();
		$data['reg_ip'] = get_client_ip();
		$data['last_log_time'] = time();
        $data['last_log_ip'] = get_client_ip();
		//$global = get_global_setting();
		//$data['reward_money'] = $global['reg_reward'];//新注册用户奖励
		
		if(session("tmp_invite_user")) {
			$data['recommend_id'] = session("tmp_invite_user");
		}else if(session('rec_temp')){
			$Rectemp = session('rec_temp');
		    $Retemp1 = M('members')->field("id")->where("user_name = '{$Rectemp}'")->find();
			$Retemp2 = M('ausers')->field("id")->where("user_name = '{$Rectemp}'")->find();//`mxl:teamreward`
		    if($Retemp1['id']>0){
				$data['recommend_id'] = $Retemp1['id'];//推荐人为投资人
				$data['recommend_type'] = 0;//`mxl:teamreward`
			}
			//`mxl:teamreward`
			if($Retemp2['id']>0){
				$data['recommend_id'] = $Retemp2['id'];//推荐人为经纪人
				$data['recommend_type'] = 1;
			}
			//`mxl:teamreward`
		}
		
		$newid = M('members')->add($data);
		if($newid){
			$updata['cell_phone'] = session("temp_phone");
			$b = M('member_info')->where("uid = {$newid}")->count('uid');
			if ($b == 1){
				M("member_info")->where("uid={$newid}")->save($updata);
			}else{
				$updata['uid'] = $newid;
				$updata['cell_phone'] = session("temp_phone");
				M('member_info')->add($updata);
			} 
			session('u_id',$newid);
			session('u_user_name',$data['user_name']);
			return $newid;
		}
		
		
	}
	public function sendphone() {
		$smsTxt = FS("Webconfig/smstxt");
		$smsTxt = de_xie($smsTxt);
		$phone = text($_POST['cellphone']);
		$xuid = M('members') -> getFieldByUserPhone($phone, 'id');
		if ($xuid > 0 && $xuid <> $this -> uid) ajaxmsg("", 2);

		$code = rand_string_reg(6, 1, 2);
		$datag = get_global_setting();
		$is_manual = $datag['is_manual'];
		
		if ($is_manual == 0) { // 如果未开启后台人工手机验证，则由系统向会员自动发送手机验证码到会员手机，
			$res = sendsms($phone, str_replace(array("#UserName#", "#CODE#"), array(session('u_user_name'), $code), $smsTxt['verify_phone']));
			#ajaxmsg($res,0);
		} else { // 否则，则由后台管理员来手动审核手机验证
			$res = true;
			$phonestatus = M('members_status') -> getFieldByUid($this -> uid, 'phone_status');
			if ($phonestatus == 1) ajaxmsg("手机已经通过验证", 1);
			$updata['phone_status'] = 3; //待审核
			$updata1['user_phone'] = $phone;
			$a = M('members') -> where("id = {$this->uid}") -> count('id');
			if ($a == 1) $newid = M("members") -> where("id={$this->uid}") -> save($updata1);
			else {
				M('members') -> where("id={$this->uid}") -> setField('user_phone', $phone);
			} 

			$updata2['cell_phone'] = $phone;
			$b = M('member_info') -> where("uid = {$this->uid}") -> count('uid');
			if ($b == 1) $newid = M("member_info") -> where("uid={$this->uid}") -> save($updata2);
			else {
				$updata2['uid'] = $this -> uid;
				$updata2['cell_phone'] = $phone;
				M('member_info') -> add($updata2);
			} 
			$c = M('members_status') -> where("uid = {$this->uid}") -> count('uid');
			if ($c == 1) $newid = M("members_status") -> where("uid={$this->uid}") -> save($updata);
			else {
				$updata['uid'] = $this -> uid;
				$newid = M('members_status') -> add($updata);
			} 
			if ($newid) {
				ajaxmsg();
			} else ajaxmsg("验证失败", 0); 
			// ////////////////////////////////////////////////////////////
		} 
		
		if ($res) {
			session("temp_phone", $phone);
			ajaxmsg();
		} else ajaxmsg("", 0);
	}
	
	public function validatephone() {
		if (session('code_temp')==text($_POST['code'])) {
			$updata['phone_status'] = 1;
			if (!session("temp_phone")) {
				ajaxmsg("验证失败", 0);
			}
            $mid = $this->regaction();
			
			$newid = setMemberStatus($mid, 'phone', 1, 10, '手机');
			if ($newid) {
				ajaxmsg();
			} else{
				ajaxmsg("验证失败", 0);
			}
		} else {
			$this->regaction();
			ajaxmsg("验证校验码不对，请重新输入！", 2);
		} 
	} 
	
	public function emailverify(){
		$code = text($_GET['vcode']);
		$uk = is_verify(0,$code,1,60*1000);
		if(false===$uk){
			$this->error("验证失败");
		}else{
			$this->assign("waitSecond",3);
            setMemberStatus($uk, 'email', 1, 9, '邮箱');  
			$this->success("验证成功",__APP__."/member");
		}
	}
	
	public function getpasswordverify(){
		$code = text($_GET['vcode']);
		$uk = is_verify(0,$code,7,60*1000);
		if(false===$uk){
			$this->error("验证失败");
		}else{
			session("temp_get_pass_uid",$uk);
			$this->display('getpass');
		}
	}
	
	public function setnewpass(){
		$d['content'] = $this->fetch();
		echo json_encode($d);
	}
	
	public function dosetnewpass(){
		$per = C('DB_PREFIX');
		$uid = session("temp_get_pass_uid");
		$oldpass = M("members")->getFieldById($uid,'user_pass');
		if($oldpass == md5($_POST['pass'])){
			$newid = true;
		}else{
			$newid = M()->execute("update {$per}members set `user_pass`='".md5($_POST['pass'])."' where id={$uid}");
		}
		
		if($newid){
			session("temp_get_pass_uid",NULL);
			ajaxmsg();
		}else{
			ajaxmsg('',0);
		}
	}
	
	
	public function ckuser(){
		$map['user_name'] = text($_POST['UserName']);
		$count = M('members')->where($map)->count('id');
        
		if ($count>0) {
			$json['status'] = 0;
			exit(json_encode($json));
        } else {
			$json['status'] = 1;
			exit(json_encode($json));
        }
	}
	
	public function ckemail(){
		$map['user_email'] = text($_POST['Email']);
		$count = M('members')->where($map)->count('id');
        
		if ($count>0) {
			$json['status'] = 0;
			exit(json_encode($json));
        } else {
			$json['status'] = 1;
			exit(json_encode($json));
        }
	}
	public function emailvsend(){
		session('email_temp',text($_POST['email']));
		$mid = $this->regaction();
				
		$status=Notice(8,$mid);
		if($status) ajaxmsg('邮件已发送，请注意查收！',1);
		else ajaxmsg('邮件发送失败,请重试！',0);
		
    }
	public function ckcode(){
	   
		if($_SESSION['verify'] != md5($_POST['sVerCode'])) {
			echo (0);
		 }else{
			echo (1);
        }
	}
	
	public function verify(){
	     ob_clean();
		import("ORG.Util.Image");
		Image::buildImageVerify();
	}
	
	public function regsuccess(){
		$this->assign('userEmail',M('members')->getFieldById($this->uid,'user_email'));
		$d['content'] = $this->fetch();
		echo json_encode($d);
	}


	public function getpassword(){
		$d['content'] = $this->fetch();
		echo json_encode($d);
	}

	public function dogetpass(){
		(false!==strpos($_POST['u'],"@"))?$data['user_email'] = text($_POST['u']):$data['user_name'] = text($_POST['u']);
		$vo = M('members')->field('id')->where($data)->find();
		if(is_array($vo)){
			$res = Notice(7,$vo['id']);
			if($res) ajaxmsg();
			else ajaxmsg('',0);
		}else{
			ajaxmsg('',0);
		}
	}
    public function register2(){
		$this->display();
	}
	public function phone(){
		$this->assign("phone",$_GET['phone']);
		$data['content'] = $this->fetch();
		exit(json_encode($data));
		
	}
	
	//跳过手机验证
	public function skipphone(){
		$this->regaction();
		ajaxmsg();
		
	}
	//推荐人检测
	public function ckInviteUser(){
		$map['user_name'] = text($_POST['InviteUserName']);
		$map2['user_name'] = text($_POST['InviteUserName']);
		$map2['u_group_id'] = 26;
		$count = M('members')->where($map)->count('id');
		$count2 = M('ausers')->where($map2)->count('id');
        
		if ($count==1 || $count2==1) {
			$json['status'] = 1;
			exit(json_encode($json));
        } else {
			$json['status'] = 0;
			exit(json_encode($json));
        }
	}
}