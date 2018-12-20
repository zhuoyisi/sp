<?php
/**
 * @funciton userinfo用户基本信息
 */
class UserAction extends BaseAction
{
    public function _initialize()
    {
        parent::_initialize();
        $this->uid = intval($_REQUEST["uid"]) or die;
    }
    /**
     * 用户基息
     * @param uid  用户id
     */
    public function userinfo()
    {
        $minfo = $this->getUser($this->uid);
        if ($minfo) {
            $jsons['status'] = "1";
            $jsons['minfo']  = $minfo;
        } else {
            $jsons['status'] = "0";
            $jsons['tips']   = "获取用户信息失败！";
        }
        outJson($jsons);
    }

    /**
     *
     * @param $uid
     */
    private function getUser($uid)
    {
        $minfo = getMinfo($uid, "m.id,m.user_name,pin_pass,IFNULL(m.user_email,'') as user_email,m.user_phone,m.user_leve,m.is_transfer,m.time_limit,mi.sex,IFNULL(mi.real_name,'') as real_name,IFNULL(mi.idcard,'') as idcard,IFNULL(mm.money_freeze,'0.00') as money_freeze,IFNULL(mm.money_collect,'0.00') as money_collect,IFNULL(mm.back_money,0.00) as back_money,IFNULL(mm.account_money,0.00) as account_money,IFNULL(mm.money_freeze+mm.money_collect+mm.account_money+mm.back_money,'0.00') as all_money,credits,customer_name");        
        if ($minfo) {
            $minfo['account_money'] = trim(Fmoney($minfo['account_money'] + $minfo['back_money']),'￥');
            $minfo['money_freeze']  = trim(Fmoney($minfo['money_freeze']),'￥');
            $minfo['money_collect'] = trim(Fmoney($minfo['money_collect']),'￥');
            $minfo['all_money']     = trim(Fmoney($minfo['all_money']),'￥');

            $benefit                = get_personal_benefit($uid);
            $minfo['money_benefit'] = getFloatValue($benefit['total'], 2);
            if ($minfo['sex'] == '男') {
                $minfo['sex'] = "1";
            } elseif ($minfo['sex'] == '女') {
                $minfo['sex'] = "2";
            } else {
                $minfo['sex'] = "0";
            }
            $minfo['pin_pass']  = empty($minfo['pin_pass']) ? '0' : '1';
            $minfo['userpic']   = $this->domainUrl . trim(get_avatar($minfo['id']) . '?token=' . md5(time()) . rand(1, 100),'/');
            $membersStatus      = M('members_status')->field('id_status,phone_status,email_status,safequestion_status')->where("uid='{$uid}'")->find();
            if(!is_array($membersStatus)){
                M("members_status")->add(array(
                    "uid" => $uid,
                    "phone_status" => 0,
                    "id_status" => 0,
                    "email_status" => 0,
                    "account_status" => 0,
                    "credit_status" => 0,
                    "safequestion_status" => 0,
                    "video_status" => 0,
                    "face_status" => 0
                ));                
            }
            $minfo['id_status'] = @$membersStatus['id_status'] == 1 ? '1' : (@$membersStatus['id_status'] == 3 ? '2' : '0');

            $minfo['vip_status'] = !($minfo['user_leve'] > 0 && $minfo['time_limit'] > time()) ? '0' : '1';
            $vip_apply           = M('vip_apply')->where("uid={$this->uid} AND status=0")->count("id");
            if ($vip_apply > 0) {
                $minfo['vip_status'] = '2';
            }
            $minfo['user_leve']    = getLeveName($minfo['credits']);
            $minfo['phone_status'] = @$membersStatus['phone_status'] == 1 ? '1' : '0';
            $minfo['email_status'] = @$membersStatus['email_status'] == 1 ? '1' : '0';
            $minfo['safequestion_status'] = @$membersStatus['safequestion_status'] == 1 ? '1' : '0';

            $vobank = M("member_banks")->field(true)->where("uid = {$uid} and bank_num !=''")->count();
            $minfo['bank_status'] = $vobank ? '1' : '0';

            $minfo['msg_num']      = M('inner_msg')->where('status !=1 and uid = ' . $uid)->count();
            $minfo['msg_num']      = (string)intval($minfo['msg_num']);
        }
        return $minfo;
    }
    public function setavatar()
    {
        $uid                  = $this->uid;
        $uid                  = abs(intval($uid));
        $base64_image_content = $_REQUEST["avatar_base64"] or die;
        
        $path="./Style/header/customavatars/".$this->make_avatar_path($uid,"./Style/header/customavatars");
        $new_file = $path."/".substr($uid, -2)."_avatar_big.jpg";
        $new_file1 = $path."/".substr($uid, -2)."_avatar_middle.jpg";
        $new_file2 = $path."/".substr($uid, -2)."_avatar_small.jpg";
        
        if(file_put_contents($new_file, base64_decode($base64_image_content))){
            file_put_contents($new_file1, base64_decode($base64_image_content));
            file_put_contents($new_file2, base64_decode($base64_image_content));                
                $jsons["status"] = "1";
                $jsons["avatar"] = $this->domainUrl."Style/header/customavatars/".$this->make_avatar_path($uid,"./Style/header/customavatars")."/".substr($uid, -2)."_avatar_big.jpg";
                $jsons["tips"]   = "上传成功！";
             
        }else{
            $jsons["status"] = "0";
            $jsons["tips"]   = "上传失败！";
        }
        outJson($jsons);
    }
    private function make_avatar_path($uid, $dir = '.') {
        $uid = sprintf("%09d", $uid);
        $dir1 = substr($uid, 0, 3);
        $dir2 = substr($uid, 3, 2);
        $dir3 = substr($uid, 5, 2);
        !is_dir($dir.'/'.$dir1) && mkdir($dir.'/'.$dir1, 0777);
        !is_dir($dir.'/'.$dir1.'/'.$dir2) && mkdir($dir.'/'.$dir1.'/'.$dir2, 0777);
        !is_dir($dir.'/'.$dir1.'/'.$dir2.'/'.$dir3) && mkdir($dir.'/'.$dir1.'/'.$dir2.'/'.$dir3, 0777);
        return $dir1.'/'.$dir2.'/'.$dir3;
    }
    public function verify_mobile_do()
    {
        $uid        = $this->uid;
        $txtCode    = empty($_REQUEST['txtCode']) ? die : $_REQUEST['txtCode']; //验证码
        $codeId     = empty($_REQUEST['codeId']) ? die : $_REQUEST['codeId']; //验证码id
        $user_phone = !empty($_REQUEST['user_phone']) ? $_REQUEST['user_phone'] : die; //新绑定手机号
        $is_verify  = M('members_status')->getFieldByUid($this->uid, 'phone_status');
        if ($is_verify == 1) {
            $jsons['tips'] = '您已经通过手机认证！';
            outJson($jsons);
        }
        $verifyRs = M('verify_code')->where("md5(id) = '{$codeId}'")->field('id,content')->find();
        if ($txtCode == @$verifyRs['content']) {
            $newmobile = M('members')->where(array('id' => $uid))->save(array('user_phone' => $user_phone));
            M('members_status')->where(array('uid' => $uid))->setField('phone_status', '1');
            $jsons['tips'] = '手机认证通过！';
            $jsons['status'] = '1';
            outJson($jsons);
        }
        $jsons['tips'] = '验证失败！';
        outJson($jsons);
    }
    public function verify_email_do()
    {
        $uid        = $this->uid;
        $user_email = !empty($_REQUEST['user_email']) ? $_REQUEST['user_email'] : die; //新绑定手机号
        $is_verify  = M('members_status')->getFieldByUid($this->uid, 'email_status');
        if ($is_verify == 1) {
            $jsons['tips'] = '您已经通过邮箱认证！';
            outJson($jsons);
        }
        $data['user_email']    = $user_email;
        $data['last_log_time'] = time();
        $newid                 = M('members')->where("id = {$this->uid}")->save($data); //更改邮箱，重新激活
        if (!($newid === false)) {
            $status = Notice(8, $this->uid);
            if ($status) {
                $jsons['status'] = "1";
                $jsons['tips']   = '验证邮件已发送，请注意查收，并点击链接完成邮箱认证！';
                outJson($jsons);
            } else {
                $jsons['tips'] = '邮件发送失败,请重试！';
                outJson($jsons);
            }
        } else {
            $jsons['tips'] = '邮件发送失败,请重试！';
            outJson($jsons);
        }
    }
    public function change_mobile()
    {
        $uid      = $this->uid;
        $txtCode  = empty($_REQUEST['txtCode']) ? '' : text($_REQUEST['txtCode']); //验证码
        $codeId   = empty($_REQUEST['codeId']) ? '' : $_REQUEST['codeId']; //验证码id
        $verifyRs = M('verify_code')->where("md5(id) = '{$codeId}' and content = '{$txtCode}'")->count('id');
        if (!$verifyRs) {
            $jsons["tips"] = "验证码不正确！";
            outJson($jsons);
        }
        $jsons['status'] = '1';
        outJson($jsons);
    }
    public function change_mobile_do()
    {
        $uid        = $this->uid;
        $txtCode    = empty($_REQUEST['txtCode']) ? '' : $_REQUEST['txtCode']; //验证码
        $codeId     = empty($_REQUEST['codeId']) ? '' : $_REQUEST['codeId']; //验证码id
        $new_mobile = empty($_REQUEST['new_mobile']) ? '' : $_REQUEST['new_mobile']; //新绑定手机号

        if ($new_mobile == '' or $txtCode == '' or $codeId == '') {
            die;
        }
        $verifyRs = M('verify_code')->field('id,content')->where("md5(id) = '{$codeId}'")->find();
        if ($txtCode == @$verifyRs['content']) {
            $newmobile       = M('members')->where(array('id' => $uid))->save(array('user_phone' => $new_mobile));
            $jsons['status'] = '1';
            outJson($jsons);
        }
        $jsons['tips'] = '验证失败！';
        outJson($jsons);
    }
	public function change_mobile_by_question_send(){
		$r = Notice(5,$this->uid);
		if($r){
			$jsons['status'] = '1';
			$jsons['tips'] = '发送成功！';
            outJson($jsons);	
		}else{
			$jsons['tips'] = '发送失败！';
            outJson($jsons);
		}
	}
	public function change_mobile_by_question(){
		$code = text($_REQUEST['safecode']);
		$r = is_verify($this->uid,$code,6,10*60);
		if(!$r) {
			$jsons['tips'] = '验证失败！';
	        outJson($jsons);
		}
		$map['answer1'] = text($_REQUEST['answer1']);
		$map['answer2']  = text($_REQUEST['answer2']);
		$map['uid']  = $this->uid;
		$c = M('member_safequestion')->where($map)->count('uid');
		if($c > 0) {
			$jsons['status'] = '1';
			$jsons['tips'] = '验证成功！';
	        outJson($jsons);
		}else{
			$jsons['tips'] = '验证失败！';
	        outJson($jsons);
	    }
	}
    public function change_mobile_by_question_do()
    {
        $uid        = $this->uid;
        $txtCode    = empty($_REQUEST['txtCode']) ? '' : $_REQUEST['txtCode']; //验证码
        $codeId     = empty($_REQUEST['codeId']) ? '' : $_REQUEST['codeId']; //验证码id
        $new_mobile = empty($_REQUEST['new_mobile']) ? '' : $_REQUEST['new_mobile']; //新绑定手机号
        $code = text($_REQUEST['safecode']);

        if ($new_mobile == '' or $txtCode == '' or $codeId == '') {
            die;
        }
		$r = is_verify($this->uid,$code,6,10*60);
		if(!$r) {
			$jsons['tips'] = '验证失败！';
	        outJson($jsons);
		}
		$map['answer1'] = text($_REQUEST['answer1']);
		$map['answer2']  = text($_REQUEST['answer2']);
		$map['uid']  = $this->uid;
		$c = M('member_safequestion')->where($map)->count('uid');
		if($c==0) {
			$jsons['status'] = '1';
			$jsons['tips'] = '验证成功！';
	        outJson($jsons);
		}else{
			$jsons['tips'] = '验证失败！';
	        outJson($jsons);
	    }

        $verifyRs = M('verify_code')->field('id,content')->where("md5(id) = '{$codeId}'")->find();
        if ($txtCode == @$verifyRs['content']) {
            $newmobile       = M('members')->where(array('id' => $uid))->save(array('user_phone' => $new_mobile));
            $jsons['status'] = '1';
            outJson($jsons);
        }
        $jsons['tips'] = '验证失败！';
        outJson($jsons);
    }	
    public function change_pass()
    {
        $uid     = $this->uid;
        $old     = !empty($_REQUEST['oldpassword']) ? md5($_REQUEST['oldpassword']) : die;
        $newpwd  = !empty($_REQUEST['newpassword']) ? md5($_REQUEST['newpassword']) : die;
        $newpwd1 = !empty($_REQUEST['newpasswordre']) ? md5($_REQUEST['newpasswordre']) : die;
        if ($newpwd != $newpwd1) {
            $jsons["tips"] = "两次密码输入不一样";
            outJson($jsons);
        }
        $user_pass = M('members')->getFieldById($uid, 'user_pass');
        if ($old != $user_pass) {
            $jsons["tips"] = "原密码错误，请重新输入";
            outJson($jsons);
        }
        if ($old == $newpwd) {
            $jsons["tips"] = "设置失败，请勿让新密码与老密码相同";
            outJson($jsons);
        }
        $newid = M('members')->where("id={$uid}")->setField('user_pass', $newpwd1);
        if ($newid) {
            MTip('chk1', $uid);
            $jsons["status"] = '1';
            $jsons["tips"]   = '修改成功';
            outJson($jsons);
        }
        $jsons["tips"] = "操作失败，请联系客服！";
        outJson($jsons);
    }
    public function change_pinpass()
    {
        $uid     = $this->uid;
        $old     = !empty($_REQUEST['oldpassword']) ? md5($_REQUEST['oldpassword']) : die;
        $newpwd  = !empty($_REQUEST['newpassword']) ? md5($_REQUEST['newpassword']) : die;
        $newpwd1 = !empty($_REQUEST['newpasswordre']) ? md5($_REQUEST['newpasswordre']) : die;
        if ($newpwd != $newpwd1) {
            $jsons["tips"] = "两次密码输入不一样";
            outJson($jsons);
        }
        $members = M('members')->find($uid);
        if ($old == $newpwd1) {
            $jsons["tips"] = "设置失败，请勿让新密码与老密码相同";
            outJson($jsons);
        }
        if (empty($members['pin_pass'])) {
            if ($members['user_pass'] == $old) {
                $newid = M('members')->where("id={$uid}")->setField('pin_pass', $newpwd1);
                if ($newid) {
                    $jsons['status'] = "1";
                    outJson($jsons);
                } else {
                    $jsons["tips"] = "设置失败，请重试";
                    outJson($jsons);
                }
            } else {
                $jsons["tips"] = "原支付密码(即登陆密码)错误，请重试！";
                outJson($jsons);
            }
        } else {
            if ($members['pin_pass'] == $old) {
                $newid = M('members')->where("id={$uid}")->setField('pin_pass', $newpwd1);
                if ($newid) {
                    $jsons["status"] = '1';
                    $jsons["tips"]   = '修改成功';
                    outJson($jsons);
                }
            } else {
                $jsons["tips"] = "原支付密码错误，请重试！";
                outJson($jsons);
            }
        }
        $jsons["tips"] = "操作失败，请联系客服！";
        outJson($jsons);
    }
	public function find_pinpass(){
		$jsons['status']="0";
		$per = C('DB_PREFIX');
		$map['user_phone'] = text($_REQUEST['user_phone']);
		$map['id'] = $this->uid;
		$txtPassword = text($_REQUEST['pin_pass']);
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

		$oldpass = M("members")->getFieldById($user["id"],'pin_pass');
		if($oldpass == md5($txtPassword)){
			$newid = true;
		}else{
			$newid = M()->execute("update {$per}members set `pin_pass`='".md5($txtPassword)."' where id=".$user["id"]);
		}
		if($newid){
			$jsons['status']="1";
			$jsons['tips'] = "修改支付成功！";
			outJson($jsons);
		}else{
			$jsons['tips'] = "修改支付失败，请重试！";
			outJson($jsons);
		}
	}
    public function msglist()
    {
        $jsons["status"] = 0;
        $is_read         = intval($_REQUEST["is_read"]);
        $p               = intval($_REQUEST['p']) ? intval($_REQUEST['p']) : 1;
        $map['uid']      = $this->uid;
        // $map['status']   = empty($is_read) ? 0 : 1;
        //分页处理
        $count = M('inner_msg')->where($map)->count('id');

        $page = new Page($count, 10);
        $page->show();
        $pageSet['nowPage']    = strval($p);
        $pageSet['totalPages'] = strval(intval($page->totalPages));
        $pageSet['totalRows']  = strval($page->totalRows);
        $pageSet['pageSize']   = strval(10);

        $Lsql = "{$page->firstRow},{$page->listRows}";
        //分页处理
        $list = M('inner_msg')->where($map)->order('id DESC')->limit($Lsql)->select();
        foreach ($list as $key => $val) {
            $msglist[$key]["id"]      = $val["id"];
            $msglist[$key]["title"]   = $val["title"];
            $msglist[$key]["is_read"] = $val["status"];
            // $msglist[$key]["send_time"] = date("Y-m-d  H:i:s", $val["send_time"]);
        }
        $jsons['page'] = $pageSet;
        if (ceil($count / 10) < $_REQUEST["p"]) {
            unset($msglist);
            $msglist         = array();
            $jsons["status"] = 1;
            $jsons["tips"]   = "已经是最后一页啦";
            outJson($jsons);
        }
        $jsons["status"] = 1;
        $jsons["list"]   = is_array($msglist) ? $msglist : array();
        outJson($jsons);
    }
    public function msgview()
    {
        $jsons["status"] = 1;
        $map['uid']      = $this->uid;
        $id              = intval($_REQUEST['id']) or die;
        M("inner_msg")->where("id={$id} AND uid={$this->uid}")->setField("status", 1);
        $vo                 = M("inner_msg")->where("id='{$id}' AND uid={$this->uid}")->find();
        $jsons["title"]     = $vo['title'];
        $jsons["inner_msg"] = $vo['msg'];
        $jsons["send_time"] = date("Y-m-d  H:i:s", $vo["send_time"]);
        outJson($jsons);
    }
    public function msgdel()
    {
        $jsons["status"] = 0;
        $map['uid']      = $this->uid;
        $id              = text($_REQUEST['id']) or die;
        $rs              = M("inner_msg")->where("id in({$id}) AND uid={$this->uid}")->delete();        
        if ($rs) {
            $jsons['status'] = '1';
            $jsons["tips"] = "删除成功！";
        } else {
            $jsons["tips"] = "删除失败！";
        }
        outJson($jsons);
    }
    public function safequestion()
    {
        $isset = M('members_status')->getFieldByUid($this->uid, 'safequestion_status');
        if ($isset == 1) {
            $jsons['isset'] = '1';
            $sq             = M('member_safequestion')->field('question1,question2')->find($this->uid);
        } else {
            $jsons['isset'] = '0';
        }
        $jsons['question_now']  = is_array($sq) ? $sq : array();
        $jsons['question_list'] = arrayToArray(array(
            '您母亲的生日是？'     => '您母亲的生日是？',
            '您母亲的姓名是？'     => '您母亲的姓名是？',
            '您父亲的生日是？'     => '您父亲的生日是？',
            '您父亲的姓名是？'     => '您父亲的姓名是？',
            '您孩子的生日是？'     => '您孩子的生日是？',
            '您孩子的姓名是？'     => '您孩子的姓名是？',
            '您配偶的名字是？'     => '您配偶的名字是？',
            '您配偶的生日是？'     => '您配偶的生日是？',
            '您的出生地是哪里？'    => '您的出生地是哪里？',
            '您最喜欢什么颜色？'    => '您最喜欢什么颜色？',
            '您是什么学历？'      => '您是什么学历？',
            '您的属相是什么的？'    => '您的属相是什么的？',
            '您小学就读的是哪所学校？' => '您小学就读的是哪所学校？',
            '您最崇拜谁？'       => '您最崇拜谁？',
            '您打字经常用什么输入法？' => '您打字经常用什么输入法？',
            '您是什么时间参加工作的？' => '您是什么时间参加工作的？')
        );

        outJson($jsons);
    }
    public function safequestion_do()
    {
        $data['question1'] = text($_REQUEST['question1']);
        $data['question2'] = text($_REQUEST['question2']);
        $data['answer1']   = text($_REQUEST['answer1']);
        $data['answer2']   = text($_REQUEST['answer2']);
        $data['add_time']  = time();
        $c                 = M('member_safequestion')->where("uid = {$this->uid}")->count('uid');
        if ($c == 1) {
            $newid = M("member_safequestion")->where("uid={$this->uid}")->save($data);
        } else {
            $data['uid'] = $this->uid;
            $newid       = M('member_safequestion')->add($data);
        }
        if ($newid) {
            M('members_status')->where("uid = {$this->uid}")->setField('safequestion_status', 1);
            $newid = setMemberStatus($this->uid, 'safequestion', 1, 6, '安全问题');
            if ($newid) {
                addInnerMsg($uid, "您的安全问题已设置", "您的安全问题已设置");
            }
            $jsons['status'] = '1';
            $jsons['tips']   = '您的设置成功！';
            outJson($jsons);
        } else {
            $jsons['tips'] = '修改失败！';
            outJson($jsons);
        }
    }
    public function safequestion_verify(){
		$map['answer1'] = text($_REQUEST['answer1']);
		$map['answer2']  = text($_REQUEST['answer2']);
		$map['uid']  = $this->uid;
		$c = M('member_safequestion')->where($map)->count('uid');
		if($c > 0) {
			$jsons['status'] = '1';
			$jsons['tips'] = '验证成功！';
            outJson($jsons);
		}
		else{
			$jsons['tips'] = '验证失败！';
            outJson($jsons);
		}
    }
    public function safequestion_verify_send(){
    	$r = Notice(2,$this->uid);
		if($r){
			$jsons['status'] = '1';
			$jsons['tips'] = '发送成功！';
            outJson($jsons);	
		}else{
			$jsons['tips'] = '发送失败！';
            outJson($jsons);
		}
    }
	public function safequestion_verify_code(){
		$pcode = is_verify($this->uid,text($_REQUEST['pcode']),3,10*60);
		$ecode = is_verify($this->uid,text($_REQUEST['ecode']),3,10*60);

		if($pcode && $ecode){
			$jsons['status'] = '1';
			$jsons['tips'] = '验证成功！';
            outJson($jsons);
		}else{
			$jsons['status'] = '0';
			$jsons['tips'] = '验证失败！';
            outJson($jsons);
		}
	}
    public function editdata()
    {
        $p              = intval($_REQUEST['p']) ? intval($_REQUEST['p']) : "1";
        $to_upload_type = get_upload_type($this->uid);
        $model          = M('member_data_info');

        import("ORG.Util.Page");
        $count = $model->where("uid={$this->uid}")->count('id');
        $_page = new Page($count, 15);
        $page  = $_page->show();
        $Lsql  = "{$_page->firstRow},{$_page->listRows}";
        $list  = $model->field('id,data_name,status,type,deal_credits,data_url,data_url1,data_url2,data_url3,data_url4')->where("uid={$this->uid}")->order("type DESC")->limit($Lsql)->select();
        foreach ($list as $key => $val) {
            $integration             = FS('Webconfig/integration');
            $list[$key]['type']      = $integration[$val['type']]['description'];
            $list[$key]['status_cn'] = $val['status'] == 1 ? '审核通过' : ($val['status'] == 2 ? '未通过' : '未审核');
        }
        $jsons['to_upload_type'] = arrayToArray($to_upload_type);
        $jsons['list']           = (array) $list;
        $jsons['page']           = pageSet($_page, 10);
        $jsons['status']         = '1';
        outJson($jsons);
    }
    public function editdata_do()
    {
        $data_url = text($_REQUEST['data_url']);
        $data_url1 = text($_REQUEST['data_url1']);
        $data_url2 = text($_REQUEST['data_url2']);
        $data_url3 = text($_REQUEST['data_url3']);
        $data_url4 = text($_REQUEST['data_url4']);
        
        $path = './'.C('MEMBER_UPLOAD_DIR').'MemberData/';
        $new_file = $path.date('YmdHis') . '-' . substr(microtime(), 2, 8)."_{$this->uid}_data_url.jpg";
        $new_file1 = $path.date('YmdHis') . '-' . substr(microtime(), 2, 8)."_{$this->uid}_data_url1.jpg";
        $new_file2 = $path.date('YmdHis') . '-' . substr(microtime(), 2, 8)."_{$this->uid}_data_url2.jpg";
        $new_file3 = $path.date('YmdHis') . '-' . substr(microtime(), 2, 8)."_{$this->uid}_data_url3.jpg";
        $new_file4 = $path.date('YmdHis') . '-' . substr(microtime(), 2, 8)."_{$this->uid}_data_url4.jpg";

        $jsons["tips"] = '';
        if(!empty($_REQUEST['data_url']) && !file_put_contents($new_file, base64_decode($data_url))){
        	$jsons["tips"] .= "资料一上传失败！";
            // outJson($jsons);
        }
        if(!empty($_REQUEST['data_url1']) && !file_put_contents($new_file1, base64_decode($data_url1))){
        	$jsons["tips"] .= "资料一上传失败！";
            // outJson($jsons);
        }
        if(!empty($_REQUEST['data_url2']) && !file_put_contents($new_file2, base64_decode($data_url2))){
        	$jsons["tips"] .= "资料一上传失败！";
            // outJson($jsons);
        }
        if(!empty($_REQUEST['data_url3']) && !file_put_contents($new_file3, base64_decode($data_url3))){
        	$jsons["tips"] .= "资料一上传失败！";
            // outJson($jsons);
        }
        if(!empty($_REQUEST['data_url4']) && !file_put_contents($new_file4, base64_decode($data_url4))){
        	$jsons["tips"] .= "资料一上传失败！";
            // outJson($jsons);
        }
        $savedata['data_url']  = !empty($_REQUEST['data_url']) ? trim($new_file,'./') : '';
        $savedata['data_url1'] = !empty($_REQUEST['data_url1']) ? trim($new_file1,'./') : '';
        $savedata['data_url2'] = !empty($_REQUEST['data_url2']) ? trim($new_file2,'./') : '';
        $savedata['data_url3'] = !empty($_REQUEST['data_url3']) ? trim($new_file3,'./') : '';
        $savedata['data_url4'] = !empty($_REQUEST['data_url4']) ? trim($new_file4,'./') : '';

        $savedata['type']      = intval($_REQUEST['type']);
        $savedata['data_name'] = text($_REQUEST['data_name']);
        $savedata['size']      = filesize($new_file);
        $savedata['ext']       = 'jpg';
        $savedata['uid']       = $this->uid;
        $savedata['add_time']  = time();
        $savedata['status']    = '0';
        $model                 = M('member_data_info');        
        if (false === $model->create($savedata)) {            
            $jsons['tips'] = $model->getError();
            outJson($jsons);
        } elseif ($result = $model->add()) {
            $jsons['tips']   = "文件上传成功！". ($jsons['tips'] ? "其中".$jsons['tips'] : '');
            $jsons['status'] = '1';
            outJson($jsons);
        } else {            
            $jsons['tips'] = "文件失败，其中".$jsons['tips'];
            outJson($jsons);
        }
    }
    public function editdata_del(){
        $id = intval($_REQUEST['id']) ? intval($_REQUEST['id']) : die;
        $model=M('member_data_info');
        $vo = $model->field("uid,status")->where("id={$id}")->find();
        if(!is_array($vo)) {
            $jsons['tips'] = "提交数据有误";
            outJson($json);   
        }else if($vo['uid']!=$this->uid){
            $jsons['tips'] = "不是你的资料";
            outJson($json);   
        }else if($vo['status']==1){
            $jsons['tips'] = "审核通过的资料不能删除";
            outJson($json);   
        }else{
            $newid = $model->where("id={$id}")->delete();
        }
        if(@$newid){
            $jsons['tips']   = "撤销成功";
            $jsons['status'] = '1';
        }
        else{
            $jsons['tips'] = "删除失败，请重试";
        }
        outJson($jsons);   
    }
    public function credit_detail()
    {
        $user       = M('members')->where("id={$this->uid}")->find();
        $logtype    = C('MONEY_LOG');
        $map['uid'] = $this->uid;
        $list       = getCreditsLog($map, 15);
        $listLog    = array();
        foreach ($list['list'] as $key => $value) {
            $listLog[] = array(
                'add_time'        => date("Y-m-d", $value['add_time']),
                'affect_credits'  => $value['affect_credits'],
                'account_credits' => $value['account_credits'],
                'info'            => $value['info'],
            );
        }
        $jsons['credits'] = $user['credits'];
        $jsons['level']   = getLeveName($user['credits']);
        $jsons['list']    = (array) $listLog;
        $jsons['page']    = pageSet($list['_page']);
        $jsons['status']  = '1';
        outJson($jsons);
    }
    public function chargeoff()
    {
        $config    = FS("Webconfig/payoff");
        $bank      = $config['BANK'];
        $bank_list = array();
        foreach ($bank as $key => $value) {
            $value['id'] = (string) ($key + 1);
            $bank_list[] = $value;
        }
        $jsons['bank_list']     = is_array($bank_list) ? $bank_list : array();
        $jsons['desc_off']      = strip_tags($config['BANK_INFO']);
        $jsons['agreement_url'] = $this->domainUrl . 'Public/charge.html';
        $jsons['status']        = "1";
        outJson($jsons);
    }
    public function chargeoff_do()
    {
        $offData['money'] = getFloatValue($_REQUEST['money'],2) > 0 ? getFloatValue($_REQUEST['money'],2) : die;
        $bank_id = intval($_REQUEST['bank_id']) ? intval($_REQUEST['bank_id']) : die;
        //本地要保存的信息
        $payimg     = text(@$_REQUEST["payimg"]);
        $offData['payimg']   = '';
        if(!empty($payimg)){
            $path = './'.C('MEMBER_UPLOAD_DIR').'PayImg/'.$this->uid.'/';
            if(!is_dir($path)) mkdir($path);
            $new_file1 = $path.date("YmdHis",time()).rand(0,1000).".jpg";
            if(!file_put_contents($new_file1, base64_decode($payimg))){
                $jsons["tips"] = "打款凭证上传失败！";
                outJson($jsons);
            }else{
                $offData['payimg']   = serialize(array(trim($new_file1,'.')));
            }
        }        
        $config              = FS("Webconfig/payoff");
        $bank_id             = intval($_REQUEST['bank_id']) - 1;
        $offData['fee']      = 0;
        $offData['add_time']      = time();
        $offData['nid']      = 'offline';
        $offData['add_ip'] = get_client_ip();
        $offData['way']      = 'off';
        $offData['tran_id']  = text($_REQUEST['tran_id']);
        $offData['off_bank'] = $config['BANK'][$bank_id]['bank'] . ' 开户名：' . $config['BANK'][$bank_id]['payee'];
        $offData['off_way']  = text($_REQUEST['off_way']);
        $offData['bank'] = strtoupper(@$_REQUEST['bank_code']);
        $offData['status'] = '0';
        $offData['uid'] = $this->uid;
        $newid               = M('member_payonline')->add($offData);
        if ($newid) {
            $jsons['status'] = "1";
            $jsons['tips']   = "线下充值提交成功，请等待管理员审核";
            outJson($jsons);
        } else {
            $jsons['tips'] = "线下充值提交失败，请重试";
            outJson($jsons);
        }
    }
    public function charge_log()
    {
        if ($_REQUEST['start_time'] && $_REQUEST['end_time']) {
            $_REQUEST['start_time'] = strtotime($_REQUEST['start_time'] . " 00:00:00");
            $_REQUEST['end_time']   = strtotime($_REQUEST['end_time'] . " 23:59:59");

            if ($_REQUEST['start_time'] < $_REQUEST['end_time']) {
                $map['add_time']      = array("between", "{$_REQUEST['start_time']},{$_REQUEST['end_time']}");
                $search['start_time'] = $_REQUEST['start_time'];
                $search['end_time']   = $_REQUEST['end_time'];
            }
        }
        $map['uid']             = $this->uid;
        $p                      = intval($_REQUEST['p']) ? intval($_REQUEST['p']) : "1";
        $list                   = getChargeLog($map, 10, 10, 'id,status,FROM_UNIXTIME(add_time,"%Y-%m-%d") as add_time,money');
        $jsons['list']          = is_array($list['list']) ? $list['list'] : array();
        $jsons['success_money'] = getFloatValue($list['success_money'], 2);
        $jsons['fail_money']    = getFloatValue($list['fail_money'], 2);
        $jsons['deadline']      = date('Y-m-d H:i:s');
        $jsons['page']          = pageSet($list['_page'], 10);
        $jsons['status']        = "1";
        outJson($jsons);
    }
    public function capital_config()
    {
        $jsons['status']  = "1";
        $jsons['logtype'] = arrayToArray(C('MONEY_LOG'));
        outJson($jsons);
    }
    public function capital()
    {
        $p          = intval($_REQUEST['p']) ? intval($_REQUEST['p']) : "1";
        $map['uid'] = $this->uid;
        if ($_REQUEST['start_time'] && $_REQUEST['end_time']) {
            $_REQUEST['start_time'] = strtotime($_REQUEST['start_time'] . " 00:00:00");
            $_REQUEST['end_time']   = strtotime($_REQUEST['end_time'] . " 23:59:59");

            if ($_REQUEST['start_time'] < $_REQUEST['end_time']) {
                $map['add_time'] = array("between", "{$_REQUEST['start_time']},{$_REQUEST['end_time']}");
            }
        }
        if (!empty($_REQUEST['log_type'])) {
            $map['type']        = intval($_REQUEST['log_type']);
            $search['log_type'] = intval($_REQUEST['log_type']);
        }
        $list             = getMoneyLog($map, 10);
        foreach ($list['list'] as $key => $value) {
            $value['add_time'] = date('Y-m-d H:i:s',$value['add_time']);
            $value['account_money'] += $value['back_money'];
            
            $value = arrayFilterValByKey($value,array('type','add_time','info','affect_money','account_money','collect_money','freeze_money'));
            $list['list'][$key] = $value;
        }
        $jsons['status']  = "1";
        $jsons['loglist'] = is_array($list['list']) ? $list['list'] : array();
        $jsons['page']    = pageSet($list['_page'], $p);
        $jsons['status']  = "1";
        outJson($jsons);
    }

    public function vip($verify = false)
    {
        $jsons['status'] = "0";
        $members         = M('members')->field('user_leve,time_limit')->find($this->uid);
        if ($members['user_leve'] > 0 && $members['time_limit'] > time()) {
            $jsons['tips'] = "你已经是VIP，到期时间为" . date('Y-m-d', $members['time_limit']);
            outJson($jsons);
        }
        $vip_apply = M('vip_apply')->where("uid={$this->uid} AND status=0")->count("id");
        if ($vip_apply > 0) {
            $jsons['tips'] = "您的VIP申请已在处理中，请耐心等待！";
            outJson($jsons);
        }
        if ($verify) {
            return true;
        }

        $list = M('ausers')->field('id,real_name')->where("is_kf = 1")->select();
        // foreach ($list as $key => $value) {
        //     $list[$key]['avatar'] = $this->domainUrl . get_avatar($value['id'] + 10000000);
        // }
        $jsons['list']    = is_array($list) ? $list : '';
        $jsons['vip_fee'] = $this->glo['fee_vip'].'元/年';
        $jsons['status']  = "1";
        outJson($jsons);
    }
    public function vip_apply()
    {

        $this->vip(true);
        $customer_id     = intval(@$_REQUEST['customer_id']);
        $des             = text(@$_REQUEST['des']);
        $jsons['status'] = "0";

        $xe = M('members_status')->field('phone_status,email_status,id_status')->find($this->uid);
		if($xe['phone_status']!=1) {
			$jsons['tips'] = "请先完成手机认证！";
            outJson($jsons);
		}		
		if($xe['email_status']!=1){			
			// $jsons['tips'] = "请先完成邮箱认证！";
   //          outJson($jsons);		
		}
		if($xe['id_status']!=1){
			$jsons['tips'] = "请先完成实名认证！";
            outJson($jsons);			
		}

		$mmdata=M('member_money')->where("uid={$this->uid}")->find();
		$datag = get_global_setting();
		$mmpd=$mmdata['account_money']+$mmdata['back_money']-$datag['fee_vip'];
		if($mmpd<0){
			$jsons['tips'] = "您的余额不足,请充值后再申请！";
            outJson($jsons);
		}


        if (!$customer_id) {
            $jsons['tips'] = "请选择客服！";
            outJson($jsons);
        }
        if (empty($des)) {
            $jsons['tips'] = "请填写申请说明！";
            outJson($jsons);
        }
        $savedata['province_now'] = '0';
        $savedata['city_now']     = '0';
        $savedata['area_now']     = '0';
        $savedata['kfid']         = $customer_id;
        $savedata['uid']          = $this->uid;
        $savedata['des']          = $des;
        $savedata['add_time']     = time();
        $savedata['status']       = 0;
        $newid                    = M('vip_apply')->add($savedata);
        if ($newid) {
            $jsons['status'] = "1";
            $jsons['tips']   = "VIP申请已提交，请耐心等待审核……";
        } else {
            $jsons['tips'] = "VIP申请失败，请稍后重试！";
        }
        outJson($jsons);
    }
    public function idcard_apply()
    {
        $uid               = $this->uid;
        $real_name         = text($_REQUEST["realname"]) or die;
        $cardid            = text($_REQUEST["idcard"]) or die;
        $card_img     = text($_REQUEST["card_img"]) or die;
        $card_back_img     = text($_REQUEST["card_back_img"]) or die;
        if(!idcard_checksum18($cardid)){
            $jsons["tips"] = "此身份证号码验证失败！";
            outJson($jsons);
        }
        $path = './'.C('MEMBER_UPLOAD_DIR').'Idcard/';
        $new_file1 = $path.date("YmdHis",time()).rand(0,1000)."_{$this->uid}.jpg";
        $new_file2 = $path.date("YmdHis",time()).rand(0,1000)."_{$this->uid}_back.jpg";        
        if(!file_put_contents($new_file1, base64_decode($card_img))
            || !file_put_contents($new_file2, base64_decode($card_back_img))
            ){
            $jsons["tips"] = "上传失败！";
            outJson($jsons);
        }

        $data['card_img'] = $new_file1;
        $data['card_back_img'] = $new_file2;
        $data['real_name'] = $real_name;
        $data['idcard']    = $cardid;
        $data['up_time']   = time();
        /////////////////////////
        $data1['idcard']  = text($cardid);
        $data1['up_time'] = time();
        $data1['uid']     = $uid;
        $datag            = get_global_setting();
        $data1['status']  = 0;
        $hasApply         = M('name_apply')->where("uid = {$uid}")->count('uid');
        if ($hasApply) {
            M('name_apply')->where("uid ={$uid}")->save($data1);
        } else {
            M('name_apply')->add($data1);
        }
        $hasUid = M('member_info')->getFieldByIdcard($data['idcard'], 'uid');
        if ($hasIdcard && $hasUid != $uid) {
            $jsons["tips"] = "此身份证号码已使用！";
            outJson($jsons);
        }
        $hasInfo = M('member_info')->where("uid = {$uid}")->count('uid');
        if ($hasInfo) {
            $newid = M('member_info')->where("uid = {$uid}")->save($data);
        } else {
            $data['uid'] = $uid;
            $newid       = M('member_info')->add($data);
        }
        if (isset($newid) && $newid) {
            $id_status = 3;            
            $rs = M('members_status')->where("uid={$this->uid}")->setField('id_status', $id_status);
            if (!($rs === false)) {
                $jsons["status"] = '1';
                $jsons["tips"]   = $id_status == 1 ? '实名认证通过！' : "实名认证申请审核中……";
                outJson($jsons);
            } else {
                $dt['uid']       = $uid;
                $dt['id_status'] = $id_status;
                $rs              = M('members_status')->add($dt);
                if ($rs) {
                    $jsons["status"] = '1';
                    $jsons["tips"]   = $id_status == 1 ? '实名认证通过！' : "实名认证申请已提交，请耐心等待审核……";
                    outJson($jsons);
                }
            }
        }
        $jsons["tips"] = "申请失败，请重试！";
        outJson($jsons);
    }
    public function moneylimit($verify = false)
    {
        $hasApply = M('member_apply')->field('apply_status')->where("uid={$this->uid} and apply_status = 0")->count('id');
        if ($hasApply) {
            $jsons['tips'] = "您的申请正在审核，请等待此次审核结束再提交新的申请";
            outJson($jsons);
        }
        if ($verify) {
            return true;
        }

        $Binfo      = require C("APP_ROOT") . "Conf/borrow_config.php";
        $apply_type = $Binfo['APPLY_TYPE'];

        $jsons['apply_type'] = arrayToArray($apply_type);
        $jsons['status']     = "1";
        outJson($jsons);
    }
    public function moneylimit_apply()
    {
        $this->moneylimit(true);
        $apply['uid']         = $this->uid;
        $apply['apply_type']  = intval(@$_REQUEST['apply_type']);
        $apply['apply_money'] = floatval(@$_REQUEST['apply_money']);
        $apply['apply_info']  = text(@$_REQUEST['apply_info']);

        if (empty($apply['apply_type'])) {
            $jsons['tips'] = "请选择申请类型！";
            outJson($jsons);
        }
        if (empty($apply['apply_money'])) {
            $jsons['tips'] = "请填写申请额度！";
            outJson($jsons);
        }
        if (empty($apply['apply_info']) || strlen($apply['apply_info']) > 50) {
            $jsons['tips'] = "申请说明不能为空，切不能超过50个字！";
            outJson($jsons);
        }

        $apply['add_time']     = time();
        $apply['apply_status'] = 0;
        $apply['add_ip']       = get_client_ip();
        $newid                 = M('member_apply')->add($apply);
        if ($newid) {
            $jsons['status'] = "1";
            $jsons['tips']   = "申请已提交，请耐心等待审核……";
        } else {
            $jsons['tips'] = "申请失败，请稍后重试！";
        }
        outJson($jsons);
    }
    public function moneylimit_log()
    {
        $map['uid'] = $this->uid;
        $p          = intval($_REQUEST['p']) ? intval($_REQUEST['p']) : "1";
        $model      = M('member_apply');
        $count      = $model->where($map)->count('id');
        $_page      = new Page($count, '10');
        $_page->show();
        $Lsql = "{$_page->firstRow},{$_page->listRows}";
        //分页处理
        $status_arr = array('待审', '通过', '未通过');
        $Binfo      = require C("APP_ROOT") . "Conf/borrow_config.php";
        $apply_type = $Binfo['APPLY_TYPE'];
        $list       = $model->field('id,apply_type,apply_money,credit_money,add_time,apply_status')->where($map)->order('id DESC')->limit($Lsql)->select();
        foreach ($list as $key => $v) {
            $v['status_cn']     = $status_arr[$v['apply_status']];
            $v['apply_type_cn'] = $apply_type[$v['apply_type']];
            $v['add_time']      = date('Y-m-d H:i', $v['add_time']);

            $v['name']  = '申请' . $v['apply_money'] . '[' . $v['status_cn'] . ']';
            $v          = arrayFilterValByKey($v, array('id', 'name'));
            $list[$key] = $v;
        }
        $jsons['list']   = is_array($list) ? $list : array();
        $jsons['page']   = pageSet($_page, $p, '10');
        $jsons['status'] = "1";
        outJson($jsons);
    }
    public function moneylimit_log_detail()
    {
        $map['uid'] = $this->uid;
        $id         = intval($_REQUEST['id']) ? intval($_REQUEST['id']) : die;
        $map['id']  = $id;
        $model      = M('member_apply');
        $status_arr = array('待审', '通过', '未通过');
        $Binfo      = require C("APP_ROOT") . "Conf/borrow_config.php";
        $apply_type = $Binfo['APPLY_TYPE'];
        $log_detail = $model->field('id,apply_type,apply_money,credit_money,add_time,apply_status,deal_info')->where($map)->find();

        $log_detail['status_cn']     = $status_arr[$log_detail['apply_status']];
        $log_detail['apply_type_cn'] =(string) $apply_type[$log_detail['apply_type']];
        $log_detail['add_time']      = date('Y-m-d H:i', $log_detail['add_time']);

        $list = arrayFilterValByKey($v, array('id', 'apply_type'));

        $jsons           = $log_detail;
        $jsons['status'] = "1";
        outJson($jsons);
    }
    public function promotion()
    {
        $award_invest             = $this->glo['award_invest'];
        $jsons['promotion_desc1'] = "邀请好友成功投标（不包含秒还标、净值标、天标交易），立即送您千分之{$award_invest}的奖金，赶快行动吧。";
        $jsons['promotion_desc2'] = "您可以通过QQ，MSN等IM工具或者微博与邮件把下面的链接告诉您的好友，邀请他们加入进来。";
        $jsons['promotion_link']  = C('WEB_URL') . U('/member/common/register', array('invite' => $this->uid));
        $jsons['status']          = "1";
        outJson($jsons);
    }
    public function promotion_log()
    {
        $p                     = intval($_REQUEST['p']) ? intval($_REQUEST['p']) : "1";
        $map['uid']            = $this->uid;
        $map['type']           = array("in", "1,13");
        $logList               = getMoneyLog($map, 10);
        $jsons['total_award']  = M('member_moneylog')->where($map)->sum('affect_money');
        $jsons['total_award']  = strval(floatval($jsons['total_award']));
        $jsons['reward_money'] = M('members')->getFieldById($this->uid, 'reward_money');
        $jsons['last_time']    = date('Y-m-d H:i:s');
        $jsons['list']         = $logList['list'];
        $jsons['page']         = pageSet($logList['_page'], $p, '10');
        $jsons['status']       = "1";
        outJson($jsons);
    }
    public function promotion_friend()
    {
        $uid             = $this->uid;
        $field           = "m.user_name,sum(ml.affect_money) award_money ";
        $award_money_log = M("members m")->field($field)->join("__MEMBER_MONEYLOG__ ml ON m.id = ml.target_uid ")->where("m.recommend_id ={$uid} AND ml.type =13")->group("ml.target_uid")->select();

        $members_list             = M("members m")->field("user_name,FROM_UNIXTIME(reg_time) as reg_time")->where(" m.recommend_id ={$uid}")->group("m.id")->select();
        $jsons['award_money_log'] = $award_money_log;
        $jsons['members_list']    = $members_list;
        $jsons['last_time']       = date('Y-m-d H:i:s');
        $jsons['status']          = "1";
        outJson($jsons);
    }
    public function bond()
    {
        $p                   = intval($_REQUEST['p']) ? intval($_REQUEST['p']) : "1";        
        $showType            = isset($_REQUEST['show_type']) ? text($_REQUEST['show_type']) : 'cantransfer';
        D("DebtBehavior");        
        $Bond  = new DebtBehavior($this->uid);        
        switch ($showType) {
            case 'onbonds':
                $list = $Bond->onBonds();
                foreach ($list['data'] as $key => $value) {
                    $value['period']       = $value['period'];
                    $value['total_period'] = $value['total'];
                    $value['add_time']     = date('Y-m-d H:i', $value['addtime']);
                    $list['data'][$key]    = arrayFilterValByKey($value, array('id','borrow_id','invest_id', 'borrow_name', 'add_time', 'period', 'total_period', 'investor_capital', 'investor_interest', 'borrow_interest_rate', 'money','user_name','transfer_price','status'));
                }
                break;
            case 'successclaims':
                $list = $Bond->successDebt();
                foreach ($list['data'] as $key => $value) {
                    $value['add_time']      = date('Y-m-d H:i', $value['buy_time']);
                    $value['agreement_url'] = $this->domainUrl.'api/user/dond_agreement?uid='.$this->uid.'&invest_id='.$value['invest_id'];
                    $list['data'][$key]     = arrayFilterValByKey($value, array('id','invest_id', 'borrow_name', 'add_time', 'user_name', 'period', 'total_period', 'money', 'transfer_price', 'borrow_interest_rate', 'agreement_url'));
                }
                break;
            case 'buybond':
                $list = $Bond->buydetb();
                foreach ($list['data'] as $key => $value) {
                    $value['add_time']      = date('Y-m-d H:i', $value['buy_time']);
                    // $value['agreement_url'] = $this->domainUrl.'api/user/dond_agreement?uid='.$this->uid.'&invest_id='.$value['invest_id'];
                    $list['data'][$key]     = arrayFilterValByKey($value, array('id', 'invest_id','borrow_name', 'add_time', 'user_name', 'period', 'total_period', 'money', 'transfer_price', 'borrow_interest_rate', 'agreement_url'));
                }
                break;
            case 'onbond':
                $list = $Bond->onDetb();                
                foreach ($list['data'] as $key => $value) {
                    $value['capital'] = getFloatvalue($value['capital'],2);
                    $value['interest'] = getFloatvalue($value['interest'],2);
                	$value['period']       = (string)$value['has_pay'];
                    $value['total_period'] = (string)$value['total_period'];
                    $value['deadline']      = date('Y-m-d H:i', $value['deadline']);
                    $value['agreement_url'] = $this->domainUrl.'api/user/dond_agreement?uid='.$this->uid.'&invest_id='.$value['invest_id'];
                    $list['data'][$key]     = arrayFilterValByKey($value, array('id','invest_id' ,'borrow_name', 'user_name', 'period', 'total_period', 'money', 'capital', 'interest','deadline','borrow_interest_rate' ,'agreement_url'));
                }
                break;
            case 'cancellist':
                $list = $Bond->cancelList();
                foreach ($list['data'] as $key => $value) {
                    $value['cancel_time'] = date('Y-m-d H:i', $value['cancel_time']);
                    $list['data'][$key]   = arrayFilterValByKey($value, array('id', 'borrow_name', 'deadline', 'user_name', 'cancel_times', 'period', 'total_period', 'money','cancel_time', 'remark', 'borrow_interest_rate'));
                }
                break;
            case 'cantransfer':
                $datag = get_global_setting();            
                // $jsons['bond_rate'] = $datag['debt_fee'];
                $list = $Bond->canTransfer();    
                foreach ($list['data'] as $key => $value) {
                    $value['add_time']     = date('Y-m-d H:i', $value['add_time']);
                    $value['deadline']     = date('Y-m-d H:i', $value['deadline']);
                    $value['period']       = $value['re_num'];
                    $value['money']       = (string)($value['capital'] + $value['interest']);
                    $value['total_period'] = $value['total'];                    
                    $value['bond_rate'] = $datag['debt_fee']; 
                    $list['data'][$key]    = arrayFilterValByKey($value, array('id','borrow_id', 'borrow_name','money', 'user_name', 'add_time', 'deadline', 'period', 'total_period', 'investor_capital', 'investor_interest', 'borrow_interest_rate','bond_rate'));

                }                
            default:
                break;
        }
        $jsons['list']   = is_array($list['data']) ? $list['data'] : array();
        $jsons['page']   = pageSet($list['_page'], $p, 10);
        $jsons['status'] = "1";
        outJson($jsons);
    }
    public function dond_agreement(){
        D("DebtBehavior");        
        $Bond  = new DebtBehavior($this->uid);        

        $invest_id = $this->_get('invest_id','trim',0);
        $ht=M('hetong')->field('hetong_img,name,dizhi,tel')->find(); 
        $content = M("article_category")->field("type_content, type_name")->where("type_nid='agreement_debt'")->find();
        $this->assign('content', $content['type_content']);
        $this->assign('title', $content['type_name']);
        $this->assign('ht', $ht);
        
        $debt = M("invest_detb d")
                ->join(C('DB_PREFIX')."borrow_investor i ON d.invest_id=i.id")
                ->join(C('DB_PREFIX')."borrow_info b ON i.borrow_id=b.id")
                ->join(C('DB_PREFIX')."members m ON d.sell_uid=m.id")
                ->field("d.serialid, d.buy_time, d.transfer_price, d.buy_uid, m.user_name, b.borrow_name, b.id, b.borrow_interest_rate, b.total, b.has_pay,b.second_verify_time")
                ->where("d.invest_id={$invest_id}")->find();
        $debt_total = $Bond->getAlsoPeriods($invest_id);
        $this->assign('debt_total', $debt_total);
        $buy_user = M("members")->field("user_name")->where("id={$debt['buy_uid']}")->find();
        $this->assign('buy_user', $buy_user['user_name']);
        $this->assign('debt', $debt);
        $html = $this->fetch();        
        outWeb($html);
    }
    public function bond_sell()
    {
        $money     = floatval($_REQUEST['money']) or die;
        $paypass   = $_REQUEST['paypass'] or die;
        $invest_id = intval($_REQUEST['id']) or die;
        if ($money && $paypass && $invest_id) {            
            D("DebtBehavior");        
	        $Bond  = new DebtBehavior($this->uid);        
            $result    = $Bond->sell($invest_id, $money, $paypass);
            if ($result ==='TRUE' || strstr($result, '转让成功')) {
                $jsons['tips']   = '提交转让成功，请等待审核。';
                $jsons['status'] = "1";
                outJson($jsons);
            } else {
                $jsons['tips'] = $result;
                outJson($jsons);
            }
        } else {
            $jsons['tips'] = '债权转让发布失败！';
            outJson($jsons);
        }
    }
    public function bond_cancel()
    {
        $invest_id = $_REQUEST['id'] or die;
        $paypsss   = strval($_REQUEST['paypass']) or die;
        D("DebtBehavior");        
        $Bond  = new DebtBehavior($this->uid);        
        if ($Bond->cancel($invest_id, $paypsss)) {
            $jsons['tips']   = '撤销成功';
            $jsons['status'] = "1";
            outJson($jsons);
        } else {
            $jsons['tips'] = '撤销失败';
            outJson($jsons);
        }
    }
    public function borrow_in()
    {
        $p                 = intval($_REQUEST['p']) ? intval($_REQUEST['p']) : "1";
        $showType          = isset($_REQUEST['show_type']) ? text($_REQUEST['show_type']) : 'borrowing';
        $map['borrow_uid'] = $this->uid;
        if ($_REQUEST['start_time'] && $_REQUEST['end_time']) {
            $_REQUEST['start_time'] = strtotime($_REQUEST['start_time'] . " 00:00:00");
            $_REQUEST['end_time']   = strtotime($_REQUEST['end_time'] . " 23:59:59");

            if ($_REQUEST['start_time'] < $_REQUEST['end_time']) {
                $map['add_time']      = array("between", "{$_REQUEST['start_time']},{$_REQUEST['end_time']}");
                $search['start_time'] = $_REQUEST['start_time'];
                $search['end_time']   = $_REQUEST['end_time'];
            }
        }
        switch ($showType) {
            case 'borrowpaying':
                $map['borrow_status'] = 6;
                $map['status']        = 7;
                $list = getBorrowListUser($map, 10);
                break;

            case 'borrowbreak':
                if ($_REQUEST['start_time1'] && $_REQUEST['end_time1']) {
                    $_REQUEST['start_time1'] = strtotime($_REQUEST['start_time1'] . " 00:00:00");
                    $_REQUEST['end_time1']   = strtotime($_REQUEST['end_time1'] . " 23:59:59");

                    if ($_REQUEST['start_time1'] < $_REQUEST['end_time1']) {
                        $Wsql                  = " AND ( d.deadline between {$_REQUEST['start_time1']} AND {$_REQUEST['end_time1']} ) ";
                        $search['start_time1'] = $_REQUEST['start_time1'];
                        $search['end_time1']   = $_REQUEST['end_time1'];
                    }
                }
                $list = getMBreakRepaymentList($this->uid, 10, $Wsql);
                $Wsql = "";
                break;
            case 'borrowfail':
                $map['borrow_status'] = array("in", "1,3,5");
                $list                 = getBorrowListUser($map, 10);
                break;
            case 'borrowdone':
                $map['borrow_status'] = 7;
                $list                 = getBorrowListUser($map, 10);
                break;
            case 'borrowing':
            default:
                $map['borrow_status'] = array("in", "0,2");
                $list                 = getBorrowListUser($map, 10);
                break;
        }
        // outJson($list);die;
        foreach ($list['list'] as $key => $value) {
            $value             = filterBorrowinfo($value);
            $value['add_time'] = date('Y-m-d', $value['add_time']);
            $value['deadline'] = date('Y-m-d', $value['deadline']);
            
            $value['repayment_time'] = date('Y-m-d', $value['repayment_time']);            
            $value['dealinfo'] = isset($value['dealinfo']['deal_info']) ? $value['dealinfo']['deal_info'] : '';
            $showType == 'borrowdone' and $value['repayment_money_all'] = (string)($value['borrow_interest'] + $value['borrow_money']);
            $showType == 'borrowbreak' and $value['breakday'] = (string)($value['breakday']);
            $showType == 'borrowbreak' and $value['id'] = $value['borrow_id'];
            $showType == 'borrowbreak' and $value['call_fee'] = $value['call_fee'] ? $value['call_fee'] : '0.00';
            $value['repayment_type'] = $value['repayment_type_cn'];
            $list['list'][$key] = arrayFilterValByKey($value, array('id', 'borrow_name', 'borrow_money', 'repayment_type', 'add_time', 'repayment_money', 'borrow_interest_rate','borrow_duration', 'borrow_duration_cn', 'repayment_time', 'status', 'dealinfo', 'repayment_money_all', 'capital', 'interest', 'expired_money', 'call_fee', 'allneed', 'deadline', 'sort_order', 'total', 'breakday'));
        }
        $jsons['list']   = is_array($list['list']) ? $list['list'] : array();
        $jsons['page']   = pageSet($list['_page'], $p);
        $jsons['status'] = "1";
        outJson($jsons);
    }
    public function borrow_in_cancel(){
        $borrow_id               = isset($_REQUEST["id"]) ? $_REQUEST["id"] : die;
        $newid = M('borrow_info')->where("borrow_uid={$this->uid} AND id={$borrow_id} AND borrow_status=0")->delete();
        if($newid){
            $jsons['status'] = '1';
            $jsons['tips'] = '撤消成功';
        }else{            
            $jsons['tips'] = "出错，如果您正在撤回的是还未初审的标，请重试，如已经初审，则不能撤回";
        }
        outJson($jsons);        
    }
    public function borrow_in_detail()
    {
        $borrow_id               = isset($_REQUEST["id"]) ? $_REQUEST["id"] : die;
        $uid                     = $this->uid;
        $pre                     = C('DB_PREFIX');
        $list                    = getBorrowInvest($borrow_id, $uid);
        foreach ($list['list'] as $key => $value) {
            $value['deadline'] = date('Y-m-d H:i:s',$value['deadline']);
            $value['status_cn'] = $value['status'];
            $value['status'] = $value['needpay'] == 0 && $value['status'] != '网站代还本金' ? '0' : '1';
            $list['list'][$key] = $value;
        }
        $jsons['repayment_list'] = (array) $list['list'];
        $jsons['borrow_name'] = $list['name'];
        $jsons['status']         = "1";
        outJson($jsons);

    }
    public function borrow_repayment()
    {
        $pre            = C('DB_PREFIX');
        $borrow_id      = intval($_REQUEST['id']) ? intval($_REQUEST['id']) : die;
        $sort_order     = intval($_REQUEST['sort_order'])  ? intval($_REQUEST['sort_order']) : die;
        $uid            = $this->uid;
        
        $vo = M("borrow_info")->field('id')->where("id={$borrow_id} AND borrow_uid={$uid}")->find();
        if (!is_array($vo)) {            
            $jsons["tips"] = "数据有误！";
            outJson($jsons);
        }
        $res = borrowRepayment($borrow_id, $sort_order);        
        if (true === $res) {
            $jsons["status"]     = '1';
            $jsons["tips"] = "还款成功";
            outJson($jsons);
        } elseif (!empty($res)) {            
            $jsons["tips"] = $res;
            outJson($jsons);
        } else {            
            $jsons["tips"] = "还款失败，请重试或联系客服";
            outJson($jsons);
        }
    }
    // 投资管理
    public function tendindex()
    {
        $totalList                  = getMemberBorrowScan($this->uid);
        $jsons['total_tending']     = getFloatValue($totalList['invest']['1']['investor_capital'], 2);
        $jsons['total_tendbacking'] = getFloatValue($totalList['invest']['4']['investor_capital'], 2);
        $jsons['total_tenddone']    = getFloatValue($totalList['invest']['5']['investor_capital'], 2);
        $jsons['total_tendbreak']   = getFloatValue($totalList['tj']['expiredInvestMoney'], 2);
        $jsons['total_all']         = getFloatValue($totalList['tj']['borrowOut'], 2);
        $jsons['status']            = '1';
        outJson($jsons);
    }
    public function tendout()
    {
        $p                   = intval($_REQUEST['p']) ? intval($_REQUEST['p']) : "1";
        $map['investor_uid'] = $this->uid;
        $showType            = isset($_REQUEST['show_type']) ? text($_REQUEST['show_type']) : 'tending';
        switch ($showType) {
            case 'tendbacking':
                $map['status'] = 4;
                $list          = getTenderList($map, 10);
                break;
            case 'tenddone':
                $map['status'] = array("in", "5,6");
                $list          = getTenderList($map, 10);
                break;
            case 'tendbreak':
                $map['d.status']         = array('neq', 0);
                $map['d.repayment_time'] = array('eq', "0");
                $map['d.deadline']       = array('lt', time());
                $list                    = getMBreakInvestList($map, 10);                             
                break;
            case 'tending':
            default:
                $map['status'] = 1;
                $list          = getTenderList($map, 10);
                break;
        }        
        foreach ($list['list'] as $key => $value) {
            if($showType == 'tendbreak'){
                $value['investor_capital'] = $value['capital'];
                $value['investor_interest'] = $value['interest'];
            }
        	$value['investor_money_all'] = $value['investor_capital'] + $value['investor_interest'];
        	$value['receive_money_all'] = (string)($value['receive_capital'] + $value['receive_interest']);
        	$value['repayment_time_cn'] = date('Y-m-d',$value['repayment_time']);
        	$value['invest_time_cn'] = date('Y-m-d',$value['invest_time']);

            // 备注
            $value['remark'] = 'agreement';            
            if($value['period'] > 0 && $value['detb_status'] == 1 && $value['debt_uid'] == $this->uid){
                $value['remark'] = "购买 {$value['period']}期债权";
            }elseif($value['period'] > 0 and $value['detb_status'] == 1){
                $value['remark'] = "转让 {$value['period']}期债权";
            }else{
                $value['agreement_url'] = '';
            }
            if($showType == 'tendbreak'){                
                $value['back'] = $value['sort_order'];
            }
        	$value = filterBorrowinfo($value);
            // $value['borrow_interest_rate'] .= '%';
        	$value = arrayFilterValByKey($value,array('id','borrow_id','borrow_name','borrow_user','invest_time_cn','borrow_money','borrow_interest_rate','borrow_duration','borrow_duration_cn','investor_capital','investor_interest','investor_money_all','back','total','sort_order','repayment_time_cn','receive_money_all','receive_capital','receive_interest','breakday','remark','agreement_url'));
        	$list['list'][$key] = $value;
        }
        $jsons['list']        = is_array($list['list']) ? $list['list'] : array();
        $jsons['page']        = pageSet($list['_page'], $p);
        $jsons['total_money'] = getFloatValue($list['total_money'], 2);
        $jsons['total_num']   = strval($list['total_num']);
        $jsons['status']      = "1";
        outJson($jsons);
    }

    public function bank_config()
    {

        $list = arrayToArray($this->gloconf['BANK_NAME']);
        foreach ($list as $key => $value) {
            $list[$key]['back_ico'] = $this->domainUrl . strtolower($value['id']) . '.jpg';
        }
        $jsons["bank_name_list"] = $list;

        $map['reid'] = intval($_REQUEST['rid']) ? intval($_REQUEST['rid']) : '1';
        $alist       = M('area')->field('id,name')->order('sort_order DESC')->where($map)->select();
        foreach ($alist as $key => $value) {
            $map['reid']   = $value['id'];
            $value['city'] = M('area')->field('id,name')->order('sort_order DESC')->where($map)->select();
            $alist[$key]   = $value;
        }
        $jsons['area_list'] = $alist;
        $jsons['status']    = "1";
        outJson($jsons);
    }
    public function bankedit()
    {

        $ids = M('members_status')->getFieldByUid($this->uid, 'id_status');
        if ($ids == 1) {
            $voinfo = M("member_info")->field('idcard,real_name')->find($this->uid);
            $vobank = M("member_banks")->field(true)->where("uid = {$this->uid} and bank_num !=''")->find();

            // $jsons['bank_province'] = M('area')->getFieldByName("{$vobank['bank_province']}", 'id');
            $jsons['bank_province'] = $vobank['bank_province'];
            $jsons['bank_province'] = (string)$jsons['bank_province'];
            // $jsons['bank_city']     = M('area')->getFieldByName("{$vobank['bank_city']}", 'id');
            $jsons['bank_city'] = $vobank['bank_city'];
            $jsons['bank_city'] = (string)$jsons['bank_city'];
            $jsons['bank_num']       = $vobank['bank_num'] ? hidecard($vobank['bank_num']) : '还没有登记您的银行账号';
            $jsons['is_bind_bank']   = $vobank['bank_num'] ? '1' : '0';
            $jsons['bank_name']      = (string) $vobank['bank_name'];
            $jsons['real_name']      = (string) $voinfo['real_name'];
            $jsons['bank_address']   = (string) $vobank['bank_address'];
            $jsons['desc_1']         = '请用户尽量填写较大的银行（如农行、工行、建行、中国银行等），避免填写那些比较少见的银行（如农村信用社、平安银行、恒丰银行等）。 否则提现资金很容易会被退款。';
            $jsons['desc_2']         = '请您填写完整联系方式，以便遇到问题时，工作人员可以及时联系到您。';
            $jsons['status']         = '1';
        } else {
            $jsons['status'] = '0';
            $jsons['tips']   = '您还未完成身份验证，请先进行实名认证';
        }
        outJson($jsons);
    }
    public function banksave()
    {
        $bank_info = M('member_banks')->field("uid, bank_num")->where("uid=" . $this->uid)->find();

        !$bank_info['uid'] && $data['uid'] = $this->uid;
        $data['bank_num']                  = text($_REQUEST['bank_num']);
        $data['bank_name']                 = text($_REQUEST['bank_name']);
        $data['bank_address']              = text($_REQUEST['bank_address']);
        $data['bank_province']             = text($_REQUEST['province']);
        $data['bank_city']                 = text($_REQUEST['city']);
        $data['add_ip']                    = get_client_ip();
        $data['add_time']                  = time();
        if ($bank_info['uid']) {
            /////////////////////新增银行卡修改锁定开关 开始 20130510 fans///////////////////////////
            if (intval($this->glo['edit_bank']) != 1 && $bank_info['bank_num']) {
                $jsons['tips'] = "为了您的帐户资金安全，银行卡已锁定，如需修改，请联系客服";
                outJson($jsons);
            }
            /////////////////////新增银行卡修改锁定开关 结束 20130510 fans///////////////////////////
            $old = text($_REQUEST['oldaccount']);
            if ($bank_info['bank_num'] && $old != $bank_info['bank_num']) {
                $jsons['tips'] = '原银卡号不对';
                outJson($jsons);
            }
            $newid = M('member_banks')->where("uid=" . $this->uid)->save($data);
        } else {
            $newid = M('member_banks')->add($data);
        }
        if ($newid) {
            MTip('chk2', $this->uid);
            $jsons['status'] = '1';
            $jsons['tips']   = '绑定成功！';
            outJson($jsons);
        } else {
            $jsons['tips'] = '操作失败，请重试';
            outJson($jsons);
        }
    }
    public function withdraw(){
    	$pre = C('DB_PREFIX');
		$field = "m.user_name,m.user_phone,(mm.account_money+mm.back_money) all_money,mm.account_money,mm.back_money,i.real_name,b.bank_num,b.bank_name,b.bank_address";
		$vo = M('members m')->field($field)->join("{$pre}member_info i on i.uid = m.id")->join("{$pre}member_money mm on mm.uid = m.id")->join("{$pre}member_banks b on b.uid = m.id")->where("m.id={$this->uid}")->find();
		if(empty($vo['bank_num'])){
			$jsons['tips'] = '您还未绑定银行帐户，请先绑定！';
            outJson($jsons);
		}else{			
			$jsons['status']             = "1";
			$jsons['account_money'] = getFloatvalue($vo['all_money'],2);
			$jsons['bank_num'] =  substr($vo['bank_num'],-(strlen($vo['bank_num']) - 12));
			$jsons['bank_name'] = $vo['bank_name'];
			outJson($jsons);
		}		
    }
    public function withdraw_validate()
    {
        $uid            = $this->uid;
        $pre            = C('DB_PREFIX');
        $withdraw_money = floatval($_REQUEST['withdraw_money']) or die;
        $pwd            = md5($_REQUEST['passwd']) or die;
		
		$vo = M('members m')->field('mm.account_money,mm.money_collect,mm.back_money,m.user_leve,m.time_limit')->join("{$pre}member_money mm on mm.uid = m.id")->where("m.id={$this->uid} AND m.pin_pass='{$pwd}'")->find();
        $borrow_info = M("borrow_info")
                        ->field("sum(borrow_money+borrow_interest+borrow_fee) as borrow, sum(repayment_money+repayment_interest) as also")
                        ->where("borrow_uid = {$this->uid} and borrow_type=4 and borrow_status in (0,2,4,6,8,9,10)")
                        ->find();
		if(!is_array($vo)) {
			$jsons['tips'] = '支付密码错误！';
            outJson($jsons);
		}
        $borrow_money = $vo['account_money']+$vo['back_money']-($borrow_info['borrow']+$borrow_info['also']);
        $dh_money = $borrow_info['borrow']+$borrow_info['also'];
        if($vo['money_collect'] < $dh_money){
        	$jsons['tips'] = "存在债权转让标借款".($borrow_info['borrow']+$borrow_info['also'])."元未还，请先还款";
            outJson($jsons);	            
        }
		if(($vo['account_money']+$vo['back_money'])<$withdraw_money){
			$jsons['tips'] = '提现额大于帐户余额！';
            outJson($jsons);	
		}
		$start = strtotime(date("Y-m-d",time())." 00:00:00");
		$end = strtotime(date("Y-m-d",time())." 23:59:59");
		$wmap['uid'] = $this->uid;
		$wmap['withdraw_status'] = array("neq",3);
		$wmap['add_time'] = array("between","{$start},{$end}");
		$today_money = M('member_withdraw')->where($wmap)->sum('withdraw_money');	
		$today_time = M('member_withdraw')->where($wmap)->count('id');	
		
		$tqfee = explode("|",$this->glo['fee_tqtx']);
		$fee[0] = explode("-",$tqfee[0]);
		$fee[1] = explode("-",$tqfee[1]);
		$fee[2] = explode("-",$tqfee[2]);
		
		$one_limit = $fee[2][0]*10000;
		//if($withdraw_money<100 ||$withdraw_money>$one_limit) ajaxmsg("单笔提现金额限制为100-{$one_limit}元",2);
		$today_limit = $fee[2][1]/$fee[2][0];
		//if($today_time>$today_limit){
					//$message = "一天最多只能提现{$today_limit}次";
					//ajaxmsg($message,2);
		//}
		
		if(1==1 || $vo['user_leve']>0 && $vo['time_limit']>time()){
		//////////////////////////////////////////
			$itime = strtotime(date("Y-m", time())."-01 00:00:00").",".strtotime( date( "Y-m-", time()).date("t", time())." 23:59:59");
			$wmapx['uid'] = $this->uid;
			$wmapx['withdraw_status'] = array("neq",3);
			$wmapx['add_time'] = array("between","{$itime}");
			$times_month = M("member_withdraw")->where($wmapx)->count("id");
			
			$tqfee1 = explode("|",$this->glo['fee_tqtx']);
			$fee1[0] = explode("-",$tqfee1[0]);
			$fee1[1] = explode("-",$tqfee1[1]);
			if(($withdraw_money-$vo['back_money'])>=0){
				$maxfee1 = ($withdraw_money-$vo['back_money'])*$fee1[0][0]/1000;
				if($maxfee1>=$fee1[0][1]){
					$maxfee1 = $fee1[0][1];
				}
				
				$maxfee2 = $vo['back_money']*$fee1[1][0]/1000;
				if($maxfee2>=$fee1[1][1]){
					$maxfee2 = $fee1[1][1];
				}
				
				$fee = $maxfee1+$maxfee2;
				$money = $withdraw_money-$vo['back_money'];
			}else{
				$fee = $vo['back_money']*$fee1[1][0]/1000;
			}
			
			if($withdraw_money <= $vo['back_money'])
			{
				$message = "您好，您申请提现{$withdraw_money}元，小于目前的回款总额{$vo['back_money']}元，因此无需手续费，确认要提现吗？";
			}else{
				$message = "您好，您申请提现{$withdraw_money}元，其中有{$vo['back_money']}元在回款之内，无需提现手续费，另有{$money}元需收取提现手续费{$fee}元，确认要提现吗？";
			}
			$jsons['status'] = '1';
			$jsons['tips'] = $message;
            outJson($jsons);		
			
			if(($today_money+$withdraw_money)>$fee[2][1]*10000){
				$message = "单日提现上限为{$fee[2][1]}万元。您今日已经申请提现金额：{$today_money}元,当前申请金额为:{$withdraw_money}元,已超出单日上限，请您修改申请金额或改日再申请提现";					
				$jsons['status'] = '0';
				$jsons['tips'] = $message;
	            outJson($jsons);		
			}
			
		//////////////////////////////////////////////
				
		}else{//普通会员暂未使用
				if(($today_money+$withdraw_money)>300000){
					$message = "您是普通会员，单日提现上限为30万元。您今日已经申请提现金额：$today_money元,当前申请金额为:$withdraw_money元,已超出单日上限，请您修改申请金额或改日再申请提现";
					$jsons['status'] = '0';
					$jsons['tips'] = $message;
		            outJson($jsons);
				}
				$tqfee = $this->glo['fee_pttx'];
				$fee = getFloatValue($tqfee*$withdraw_money/100,2);
				
				if( ($vo['account_money']-$withdraw_money - $fee)<0 ){
					$message = "您好，您申请提现{$withdraw_money}元，提现手续费{$fee}元将从您的提现金额中扣除，确认要提现吗？";
				}else{
					$message = "您好，您申请提现{$withdraw_money}元，提现手续费{$fee}元将从您的帐户余额中扣除，确认要提现吗？";
				}
				$jsons['status'] = '1';
				$jsons['tips'] = $message;
	            outJson($jsons);
		}


    }
    public function withdraw_do()
    {
        $pre            = C('DB_PREFIX');
        $withdraw_money = floatval($_REQUEST['withdraw_money']) or die;
        $pwd            = md5($_REQUEST['passwd']);
		$vo = M('members m')->field('mm.account_money,mm.back_money,(mm.account_money+mm.back_money) all_money,m.user_leve,m.time_limit')->join("{$pre}member_money mm on mm.uid = m.id")->where("m.id={$this->uid} AND m.pin_pass='{$pwd}'")->find();
		if(!is_array($vo)) {
			$jsons['tips'] = '非法操作！';
            outJson($jsons);
		}
		$borrow_money = $vo['account_money']+$vo['back_money']-($borrow_info['borrow']+$borrow_info['also']);
        $dh_money = $borrow_info['borrow']+$borrow_info['also'];
        if($vo['money_collect'] < $dh_money){
        	$jsons['tips'] = "存在债权转让标借款".($borrow_info['borrow']+$borrow_info['also'])."元未还，请先还款";
            outJson($jsons);	            
        }
		if($vo['all_money']<$withdraw_money){
			$jsons['tips'] = '提现额大于帐户余额！';
            outJson($jsons);	
		}
		$start = strtotime(date("Y-m-d",time())." 00:00:00");
		$end = strtotime(date("Y-m-d",time())." 23:59:59");
		$wmap['uid'] = $this->uid;
		$wmap['withdraw_status'] = array("neq",3);
		$wmap['add_time'] = array("between","{$start},{$end}");
		$today_money = M('member_withdraw')->where($wmap)->sum('withdraw_money');	
		$today_time = M('member_withdraw')->where($wmap)->count('id');	
		$tqfee = explode("|",$this->glo['fee_tqtx']);
		$fee[0] = explode("-",$tqfee[0]);
		$fee[1] = explode("-",$tqfee[1]);
		$fee[2] = explode("-",$tqfee[2]);
		$one_limit = $fee[2][0]*10000;
		//if($withdraw_money<100 ||$withdraw_money>$one_limit) ajaxmsg("单笔提现金额限制为100-{$one_limit}元",2);
		$today_limit = $fee[2][1]/$fee[2][0];
		//if($today_time>=$today_limit){
					//$message = "一天最多只能提现{$today_limit}次";
					//ajaxmsg($message,2);
		//}
		
		if(1==1 || $vo['user_leve']>0 && $vo['time_limit']>time()){
			if(($today_money+$withdraw_money)>$fee[2][1]*10000){
				$message = "单日提现上限为{$fee[2][1]}万元。您今日已经申请提现金额：{$today_money}元,当前申请金额为:{$withdraw_money}元,已超出单日上限，请您修改申请金额或改日再申请提现";
				$jsons['tips'] = $message;
	            outJson($jsons);
			}
			$itime = strtotime(date("Y-m", time())."-01 00:00:00").",".strtotime( date( "Y-m-", time()).date("t", time())." 23:59:59");
			$wmapx['uid'] = $this->uid;
			$wmapx['withdraw_status'] = array("neq",3);
			$wmapx['add_time'] = array("between","{$itime}");
			$times_month = M("member_withdraw")->where($wmapx)->count("id");
			
		
			$tqfee1 = explode("|",$this->glo['fee_tqtx']);
			$fee1[0] = explode("-",$tqfee1[0]);
			$fee1[1] = explode("-",$tqfee1[1]);
			if(($withdraw_money-$vo['back_money'])>=0){
				$maxfee1 = ($withdraw_money-$vo['back_money'])*$fee1[0][0]/1000;
				if($maxfee1>=$fee1[0][1]){
					$maxfee1 = $fee1[0][1];
				}
				
				$maxfee2 = $vo['back_money']*$fee1[1][0]/1000;
				if($maxfee2>=$fee1[1][1]){
					$maxfee2 = $fee1[1][1];
				}
				
				$fee = $maxfee1+$maxfee2;
				$money = $withdraw_money-$vo['back_money'];
			}else{
				//$fee = $vo['back_money']*$fee1[1][0]/1000;
				$fee = $withdraw_money*$fee1[1][0]/1000;
				if($fee>=$fee1[1][1]){
					$fee = $fee1[1][1];
				}
			}
			
			
			
			if(($vo['all_money']-$withdraw_money - $fee)<0 ){
			
				//$withdraw_money = ($withdraw_money - $fee);
				$moneydata['withdraw_money'] = $withdraw_money;
				$moneydata['withdraw_fee'] = $fee;
				$moneydata['second_fee'] = $fee;
				$moneydata['withdraw_status'] = 0;
				$moneydata['uid'] =$this->uid;
				$moneydata['add_time'] = time();
				$moneydata['add_ip'] = get_client_ip();
				$newid = M('member_withdraw')->add($moneydata);
				if($newid){
					memberMoneyLog($this->uid,4,-$withdraw_money,"提现,默认自动扣减手续费".$fee."元",'0','@网站管理员@',0);
					MTip('chk6',$this->uid);
					$jsons['tips'] = "恭喜，提现申请提交成功";
					$jsons['status']  = "1";
		            outJson($jsons);					
				} 
				
			}else{
				$moneydata['withdraw_money'] = $withdraw_money;
				$moneydata['withdraw_fee'] = $fee;
				$moneydata['second_fee'] = $fee;
				$moneydata['withdraw_status'] = 0;
				$moneydata['uid'] =$this->uid;
				$moneydata['add_time'] = time();
				$moneydata['add_ip'] = get_client_ip();
				$newid = M('member_withdraw')->add($moneydata);
				if($newid){
					//memberMoneyLog($this->uid,4,-$withdraw_money,"提现,默认自动扣减手续费".$fee."元",'0','@网站管理员@',-$fee);
					memberMoneyLog($this->uid,4,-$withdraw_money,"提现,默认自动扣减手续费".$fee."元",'0','@网站管理员@');
					MTip('chk6',$this->uid);
					$jsons['tips'] = "恭喜，提现申请提交成功";
					$jsons['status']  = "1";
		            outJson($jsons);
				} 
			}
			$jsons['tips'] = "对不起，提现出错，请重试";
			$jsons['status']  = "0";
            outJson($jsons);			
		}else{//普通会员暂未使用
				if(($today_money+$withdraw_money)>300000){
					$message = "您是普通会员，单日提现上限为30万元。您今日已经申请提现金额：$today_money元,当前申请金额为:$withdraw_money元,已超出单日上限，请您修改申请金额或改日再申请提现";
					$jsons['tips'] = $message;
		            outJson($jsons);
				}
				$tqfee = $this->glo['fee_pttx'];
				$fee = getFloatValue($tqfee*$withdraw_money/100,2);
				
				if( ($vo['account_money']-$withdraw_money - $fee)<0 ){
				
					$withdraw_money = ($withdraw_money - $fee);
					$moneydata['withdraw_money'] = $withdraw_money;
					$moneydata['withdraw_fee'] = $fee;
					$moneydata['withdraw_status'] = 0;
					$moneydata['uid'] =$this->uid;
					$moneydata['add_time'] = time();
					$moneydata['add_ip'] = get_client_ip();
					$newid = M('member_withdraw')->add($moneydata);
					if($newid){
						memberMoneyLog($this->uid,4,-$withdraw_money - $fee,"提现,自动扣减手续费".$fee."元");
						MTip('chk6',$this->uid);
						$jsons['tips'] = "恭喜，提现申请提交成功";
						$jsons['status']  = "1";
			            outJson($jsons);
					} 
				}else{
					$moneydata['withdraw_money'] = $withdraw_money;
					$moneydata['withdraw_fee'] = $fee;
					$moneydata['withdraw_status'] = 0;
					$moneydata['uid'] =$this->uid;
					$moneydata['add_time'] = time();
					$moneydata['add_ip'] = get_client_ip();
					$newid = M('member_withdraw')->add($moneydata);
					if($newid){
						memberMoneyLog($this->uid,4,-$withdraw_money,"提现,自动扣减手续费".$fee."元",'0','@网站管理员@',-$fee);
						MTip('chk6',$this->uid);
						$jsons['tips'] = "恭喜，提现申请提交成功";
						$jsons['status']  = "1";
			            outJson($jsons);
					} 
				}				
				$jsons['tips'] = "对不起，提现出错，请重试";
				$jsons['status']  = "0";
	            outJson($jsons);
		}

    }
    public function withdraw_log()
    {
        $p          = intval($_REQUEST['p']) ? intval($_REQUEST['p']) : "1";
        $map['uid'] = $this->uid;
        if ($_REQUEST['start_time'] && $_REQUEST['end_time']) {
            $_REQUEST['start_time'] = strtotime($_REQUEST['start_time'] . " 00:00:00");
            $_REQUEST['end_time']   = strtotime($_REQUEST['end_time'] . " 23:59:59");

            if ($_REQUEST['start_time'] < $_REQUEST['end_time']) {
                $map['add_time']      = array("between", "{$_REQUEST['start_time']},{$_REQUEST['end_time']}");         
            }
        }
        $list       = getWithDrawLog($map, 15);
        $bank = M('member_banks')->find($this->uid);        
        foreach ($list['list'] as $key => $value) {
        	$value['bank_name'] = $bank['bank_name'];
        	$value['bank_num'] = '**** **** **** '.(string)substr($bank['bank_num'],-(strlen($bank['bank_num']) - 12));;
        	$value['withdraw_money_pay'] = '--';
        	if($value['withdraw_status'] == 2 ){
        		$value['withdraw_money_pay'] = $value['withdraw_money'] - $value['withdraw_fee'];        		
        	}
            $value['add_time']  = date('Y-m-d', $value['add_time']);            
            $list['list'][$key] = arrayFilterValByKey($value, array('id','bank_name','bank_num','withdraw_fee','add_time', 'withdraw_status','status_cn', 'withdraw_money','withdraw_money_pay'));
        }
        $jsons['page']   = pageSet($list['_page'], $p);
        $jsons['list']   = is_array($list['list']) ? $list['list'] : array();
        $jsons['status'] = '1';
        outJson($jsons);
    }
    public function withdraw_back(){            
        $id = intval($_GET['id']) ? intval($_GET['id']) : die;
        $map['withdraw_status'] = 0;
        $map['uid'] = $this->uid;
        $map['id'] = $id;
        $vo = M('member_withdraw')->where($map)->find();
        if(!is_array($vo)){
            $jsons['tips'] = '记录不存在！';
            outJson($jsons);       
        }        
        $field = "(mm.account_money+mm.back_money) all_money,mm.account_money,mm.back_money";
        $m = M('member_money mm')->field($field)->where("mm.uid={$this->uid}")->find();
        ////////////////////////////////////////////////////
        $newid = M('member_withdraw')->where($map)->delete();
        if($newid){
            $res = memberMoneyLog($this->uid,5,$vo['withdraw_money'],"撤消提现",'0','@网站管理员@');
        }
        if(@$res) {
            $jsons['status'] = '1';
            $jsons['tips'] = '撤销成功！';
        }else{
            $jsons['tips'] = '撤销失败！';
        }
        outJson($jsons);        
    
    }
    public function autolong()
    {
        $map['uid']         = $this->uid;
        $map['borrow_type'] = in_array($_REQUEST['borrow_type'], array(1, 3)) ? $_REQUEST['borrow_type'] : 1;
        $vo                 = M('auto_borrow')->where($map)->find();
        $jsons['is_set']    = isset($vo['id']) ? '1' : '0';
        if ($jsons['is_set']) {
            $jsons['status']        = @$vo['is_use'] == 0 ? '0' : '1';
            $jsons['status_cn']     = @$vo['is_use'] == 0 ? '当前设置已暂停使用' : '当前设置已启用';
            $MAXMOONS               = 180;
            $jsons['is_auto_day']   = ($vo['duration_to'] >= $MAXMOONS) ? 1 : 0;
            $jsons['duration_to']   = $vo['duration_to'] % $MAXMOONS;
            $jsons['invest_money']  = $vo['invest_money'];
            $jsons['min_invest']    = $vo['min_invest'];
            $jsons['interest_rate'] = $vo['interest_rate'];
            $jsons['duration_from'] = $vo['duration_from'];
            $jsons['account_money'] = $vo['account_money'];
            $jsons['end_time']      = date('Y-m-d', $vo['end_time']);
            $jsons['id'] = $vo['id'];
        }

        $x = M('members')->field("time_limit,user_leve")->find($this->uid);
        if ($x['time_limit'] > 0 && $x['user_leve'] == 1) {
            $is_vip = 1;
        } else {
            $is_vip = 0;
        }

        $jsons['is_vip'] = (string) $is_vip;
        $glo             = $this->glo;
        $jsons['desc']   = "普通标自动投标的总额最高只能达到标的金额的{$glo['auto_rate']}%（例如您设置自动投标金额为3万，如果有借款人借款20万，那么您最高投标金额为20*{$glo['auto_rate']}/100万）";
        $jsons['status'] = '1';
        outJson($jsons);
    }
    public function autolong_do()
    {
        $x                                                                   = M('members')->field("time_limit,user_leve")->find($this->uid);
        ($x['time_limit'] > 0 && $x['user_leve'] == 1) ? $is_vip             = 1 : $is_vip             = 0;
        (intval(@$_REQUEST['invest_money']) == 0 && $is_vip == 1) ? $is_full = 1 : $is_full = 0;
        $data['min_invest']                                                  = floatval($_REQUEST['min_invest']);
        $data['duration_from']                                               = intval($_REQUEST['duration_from']);
        $data['duration_to']                                                 = intval($_REQUEST['duration_to']);

        $data['uid']           = $this->uid;
        $data['account_money'] = floatval($_REQUEST['account_money']);
        $data['borrow_type']   = in_array($_REQUEST['borrow_type'], array(1, 3)) ? $_REQUEST['borrow_type'] : 1;
        $data['interest_rate'] = intval($_REQUEST['interest_rate']);
        if (!empty($_REQUEST['expireddate']) && isset($_REQUEST['expireddate'])) {
            $data['end_time'] = strtotime($_REQUEST['expireddate'] . " 00:00:00");
        } else {
            $data['end_time'] = time() + 60 * 60 * 24 * 30;
        }
        //`mxl:autoday`
        $MAXMOONS = 180;
        if (isset($_REQUEST['is_auto_day']) && $_REQUEST['is_auto_day'] == 1) {
            $data['duration_to'] += $MAXMOONS; //此处隐含限制条件是duration_to最大不能超过75个月
        }
        //`mxl:autoday`
        $data['is_auto_full'] = $is_full;
        $data['invest_money'] = floatval($_REQUEST['invest_money']);
        $data['add_ip']       = get_client_ip();
        $data['add_time']     = time();

        $c = M('auto_borrow')->field('id')->where("uid={$this->uid} AND borrow_type={$data['borrow_type']}")->find();
        if (is_array($c)) {
            $data['id'] = $c['id'];
            $newid      = M('auto_borrow')->save($data);
            if (!($newid === false)) {
                $jsons['tips']   = '修改成功！';
                $jsons['status'] = '1';
                outJson($jsons);
            } else {
                $jsons['tips'] = '修改失败！';
                outJson($jsons);
            }
        } else {
            $data['invest_time'] = time();
            $newid               = M('auto_borrow')->add($data);
            if ($newid) {
                $jsons['tips']   = '修改成功！';
                $jsons['status'] = '1';
                outJson($jsons);
            } else {
                $jsons['tips'] = '修改失败！';
                outJson($jsons);
            }
        }
    }
    public function auto_is_use(){
        $aid = intval($_REQUEST['id']);
        $is_use = intval($_REQUEST['is_use']);
        $vo = M('auto_borrow')->where("uid={$this->uid} AND id={$aid}")->find();        
        if(is_array($vo)){
            $newid = M('auto_borrow')->where("id={$aid}")->setField('is_use',$is_use);
            if($newid) {
                $jsons['status'] = '1';
                $jsons['tips'] = $is_use ? '设置启用成功！' : '设置取消成功！';
                outJson($jsons);
            }
        }
        $jsons['tips'] = '设置失败！';
        outJson($jsons);
    }
    public function feedback()
    {
        $msg = text($_REQUEST['msg']);

        $jsons['tips']   = '提交成功';
        $jsons['status'] = '1';
        outJson($jsons);
    }
}
