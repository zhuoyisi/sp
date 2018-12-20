<?php
// 全局设置
class MembersAction extends ACommonAction
{
    /**
    +----------------------------------------------------------
    * 默认操作
    +----------------------------------------------------------
    */
    public function index()
    {
		$map=array();
		if($_REQUEST['uname']){
			$map['m.user_name'] = array("like",urldecode($_REQUEST['uname'])."%");
			$search['uname'] = urldecode($_REQUEST['uname']);	
		}
		if($_REQUEST['realname']){
			$map['mi.real_name'] = urldecode($_REQUEST['realname']);
			$search['realname'] = $map['mi.real_name'];	
		}
		if($_REQUEST['is_vip']=='yes'){
			$map['m.user_leve'] = 1;
			$map['m.time_limit'] = array('gt',time());
			$search['is_vip'] = 'yes';	
		}elseif($_REQUEST['is_vip']=='no'){
			$map['_string'] = 'm.user_leve=0 OR m.time_limit<'.time();
			$search['is_vip'] = 'no';	
		}
		if($_REQUEST['is_transfer']=='yes'){
			$map['m.is_transfer'] = 1;
		}elseif($_REQUEST['is_transfer']=='no'){
			$map['m.is_transfer'] = 0;
		}
		
		//if(session('admin_is_kf')==1){
		//		$map['m.customer_id'] = session('admin_id');
		//}else{
			if($_REQUEST['customer_name']){
				$map['m.customer_id'] = $_REQUEST['customer_id'];
				$search['customer_id'] = $map['m.customer_id'];	
				$search['customer_name'] = urldecode($_REQUEST['customer_name']);	
			}
			
			if($_REQUEST['customer_name']){
				$cusname = urldecode($_REQUEST['customer_name']);
				$kfid = M('ausers')->getFieldByUserName($cusname,'id');
				$map['m.customer_id'] = $kfid;
				$search['customer_name'] = $cusname;	
				$search['customer_id'] = $kfid;	
			}
		//}
		if(!empty($_REQUEST['bj']) && !empty($_REQUEST['lx']) && !empty($_REQUEST['money'])){
			
			if($_REQUEST['lx']=='allmoney'){
				if($_REQUEST['bj']=='gt'){
					$bj = '>';
				}else if($_REQUEST['bj']=='lt'){
					$bj = '<';
				}else if($_REQUEST['bj']=='eq'){
					$bj = '=';
				}
				$map['_string'] = "(mm.account_money+mm.back_money) ".$bj.$_REQUEST['money'];
			}else{
				$map[$_REQUEST['lx']] = array($_REQUEST['bj'],$_REQUEST['money']);
			}
			$search['bj'] = $_REQUEST['bj'];	
			$search['lx'] = $_REQUEST['lx'];	
			$search['money'] = $_REQUEST['money'];	
		}

		if(!empty($_REQUEST['start_time']) && !empty($_REQUEST['end_time'])){
			$timespan = strtotime(urldecode($_REQUEST['start_time'])).",".strtotime(urldecode($_REQUEST['end_time']));
			$map['m.reg_time'] = array("between",$timespan);
			$search['start_time'] = urldecode($_REQUEST['start_time']);	
			$search['end_time'] = urldecode($_REQUEST['end_time']);	
		}elseif(!empty($_REQUEST['start_time'])){
			$xtime = strtotime(urldecode($_REQUEST['start_time']));
			$map['m.reg_time'] = array("gt",$xtime);
			$search['start_time'] = $xtime;	
		}elseif(!empty($_REQUEST['end_time'])){
			$xtime = strtotime(urldecode($_REQUEST['end_time']));
			$map['m.reg_time'] = array("lt",$xtime);
			$search['end_time'] = $xtime;	
		}
		
		//分页处理
		import("ORG.Util.Page");
		$count = M('members m')->join("{$this->pre}member_money mm ON mm.uid=m.id")->join("{$this->pre}member_info mi ON mi.uid=m.id")->where($map)->count('m.id');
		$p = new Page($count, C('ADMIN_PAGE_SIZE'));
		$page = $p->show();
		$Lsql = "{$p->firstRow},{$p->listRows}";
		//分页处理
		$field= 'm.id,m.user_phone,m.reg_time,m.user_name,m.customer_name,m.user_leve,m.time_limit,mi.real_name,mm.money_freeze,mm.money_collect,(mm.account_money+mm.back_money) account_money,m.user_email,m.recommend_id,m.is_borrow,m.is_vip';
		$list = M('members m')->field($field)->join("{$this->pre}member_money mm ON mm.uid=m.id")->join("{$this->pre}member_info mi ON mi.uid=m.id")->where($map)->limit($Lsql)->order('m.id DESC')->select();
		
		$list=$this->_listFilter($list);
        $this->assign("bj", array("gt"=>'大于',"eq"=>'等于',"lt"=>'小于'));
        $this->assign("lx", array("allmoney"=>'可用余额',"mm.money_freeze"=>'冻结金额',"mm.money_collect"=>'待收金额'));
        $this->assign("list", $list);
        $this->assign("pagebar", $page);
        $this->assign("search", $search);
        $this->assign("query", http_build_query($search));

        $this->display();
    }

    public function edit() {
        $model = D(ucfirst($this->getActionName()));
		setBackUrl();
        $id = intval($_REQUEST['id']);
        $vo = $model->find($id);
		$vx = M('member_info')->where("uid={$id}")->find();
		if(!is_array($vx)){
			M('member_info')->add(array("uid"=>$id));
		}else{
			foreach($vx as $key=>$vxe){
				$vo[$key]=$vxe;
			}
		}
		
		///////////////////////
		$vb = M('member_banks')->where("uid={$id}")->find();
		if(!is_array($vb)){
			M('member_banks')->add(array("uid"=>$id));
		}else{
			foreach($vb as $key=>$vbe){
				$vo[$key]=$vbe;
			}
		}
		//查寻出客服
		$kefu = M('ausers')->where("is_kf=1")->select();
		 $this->assign('kefu', $kefu);
		//////////////////////
        
		
		//后台调取会员现居住地址
		$area = FS("Webconfig/area");
		$city = M('member_info')->where("uid={$id}")->select();
		$this->assign("city",$city);
		$this->assign("area",$area);
		
		//////////////////////
        $this->assign('vo', $vo);
		$this->assign("utype", C('XMEMBER_TYPE'));
		$this->assign("bank_list",$this->gloconf['BANK_NAME']);
        $this->display();
    }
	
	//添加数据
    public function doEdit() {
        $model = D(ucfirst($this->getActionName()));
        $model2 = M("member_info");
		$model3 = M("member_banks");
		
        if (false === $model->create()) {
            $this->error($model->getError());
        }
        if (false === $model2->create()) {
            $this->error($model2->getError());
        }
		if (false === $model3->create()) {
            $this->error($model3->getError());
        }
		
		$model->startTrans();
        if(!empty($model->user_pass)){
			$model->user_pass=md5($model->user_pass);
		}else{
			unset($model->user_pass);
		}
        if(!empty($model->pin_pass)){
			$model->pin_pass=md5($model->pin_pass);
		}else{
			unset($model->pin_pass);
		}
		$model->user_phone = $model2->cell_phone;
		$model3->add_ip = get_client_ip();
		$model3->add_time = time();
		
		$aUser = get_admin_name();
		$kfid = $model->customer_id;
		//保存客服到vip申请表
		$data_1['kfid']=$kfid;
		$wherer['uid']=$uid1;
		M('vip_apply')->where($wherer)->save($data_1);
		$model->customer_name = $aUser[$kfid];
                 if($model->is_ban=='0'){;
                             $time = strtotime(date("Y-m-d",time()));
                             $where = ' and add_time >'.$time.' and add_time<'.($time+3600*24);
                             $id=$model->id;
                             $data['is_success']='0';
                             M('member_login')->where('uid='.$id.$where)->save($data);
                }
				
		
		unset($model2->real_name);
		unset($model2->idcard);
		$result = $model->save();
		$result2 = $model2->save();
		$result3 = $model3->save();   
               
		
        //保存当前数据对象
        if ($result || $result2 || $result3) { //保存成功
			$model->commit();
			alogs("Members",0,1,'成功执行了会员信息资料的修改操作！');
            //成功提示
            $this->assign('jumpUrl', __URL__."/".session('listaction'));
            $this->success(L('修改成功'));
        } else {
			alogs("Members",0,0,'执行会员信息资料的修改操作失败！');
			$model->rollback();
            //失败提示
            $this->error(L('修改失败'));
        }
    }
	
    public function info()
    {	
		if($_GET['user_name']) $search['m.user_name'] = text($_GET['user_name']);
		else $search=array();
		$wheress['id']= $this->admin_id;
		$res = M('ausers')->where($wheress)->find();
		$list = getMemberInfoList($search,10,$res['u_group_id'],$this->admin_id);//重新传参进去，加条件判断是否是超级管理员 byking
	
		$this->assign("list",$list['list']);
		$this->assign("pagebar",$list['page']);
        $this->assign("search", $search);
        $this->display();
    }
	
    public function infowait()
    {	
		$Bconfig = require C("APP_ROOT")."Conf/borrow_config.php";
		if($_GET['user_name']) $search['m.user_name'] = text($_GET['user_name']);
		else $search=array();
		$wheress['id']= $this->admin_id;
		$res = M('ausers')->where($wheress)->find();
		$list = getMemberApplyList($search,10,$res['u_group_id'],$this->admin_id);
		$this->assign("aType",$Bconfig['APPLY_TYPE']);
		$this->assign("list",$list['list']);
		$this->assign("pagebar",$list['page']);
        $this->display();
    }
	
    public function viewinfo()
    {	
		$Bconfig = require C("APP_ROOT")."Conf/borrow_config.php";
		$this->assign("aType",$Bconfig['APPLY_TYPE']);
		setBackUrl();
		$id = intval($_GET['id']);
		$vx = M('member_apply')->field(true)->find($id);
		$uid = $vx['uid'];
		$vo = getMemberInfoDetail($uid);
		$this->assign("vx",$vx);
		$this->assign("vo",$vo);
		$this->assign("id",$id);
        $this->display();
    }
	
    public function viewinfom()
    {	
		$id = intval($_GET['id']);
		$vo = getMemberInfoDetail($id);
		$this->assign("vo",$vo);
        $this->display();
    }

	public function doEditCredit(){
		$id = intval($_POST['id']);
		$uid = intval($_POST['uid']);
		$data['id'] = $id;
		$data['deal_info'] = text($_POST['deal_info']);
		$data['apply_status'] = intval($_POST['apply_status']);
		$data['credit_money'] = floatval($_POST['credit_money']);
		$newid = M('member_apply')->save($data);
		
		if($newid){
			//审核通过后资金授信改动
			if($data['apply_status']==1){
				$vx = M('member_apply')->field(true)->find($id);
				$umoney = M('member_money')->field(true)->find($vx['uid']);
				
				$moneyLog['uid'] = $vx['uid'];
				if($vx['apply_type']==1){
					$moneyLog['credit_limit'] = floatval($umoney['credit_limit']) + $data['credit_money'];
					$moneyLog['credit_cuse'] = floatval($umoney['credit_cuse']) + $data['credit_money'];
				}elseif($vx['apply_type']==2){
					$moneyLog['borrow_vouch_limit'] = floatval($umoney['borrow_vouch_limit']) + $data['credit_money'];
					$moneyLog['borrow_vouch_cuse'] = floatval($umoney['borrow_vouch_cuse']) + $data['credit_money'];
				}elseif($vx['apply_type']==3){
					$moneyLog['invest_vouch_limit'] = floatval($umoney['invest_vouch_limit']) + $data['credit_money'];
					$moneyLog['invest_vouch_cuse'] = floatval($umoney['invest_vouch_cuse']) + $data['credit_money'];
				}
				
				if(!is_array($umoney))	M('member_money')->add($moneyLog);
				else M('member_money')->where("uid={$vx['uid']}")->save($moneyLog);
			}
			alogs("Members",0,1,'成功执行了会员资料通过后资金授信改动的审核操作！');
			$this->success("审核成功",__URL__."/infowait".session('listaction'));
		}else{
			alogs("Members",0,0,'执行会员资料通过后资金授信改动的审核操作失败！');
			$this->error("审核失败");
		}
	}
	
    public function moneyedit()
    {
		setBackUrl();
		$this->assign("id",intval($_GET['id']));
		$this->display();
    }
	
    public function doMoneyEdit()
    {
		$id = intval($_POST['id']);
		$uid = $id;
		$info = text($_POST['info']);
		$done=false;
		if(floatval($_POST['account_money'])!=0){
			$done=memberMoneyLog($uid,71,floatval($_POST['account_money']),$info);
		}
		if(floatval($_POST['money_freeze'])!=0){
			$done=false;
			$done=memberMoneyLog($uid,72,floatval($_POST['money_freeze']),$info);
		}
		if(floatval($_POST['money_collect'])!=0){
			$done=false;
			$done=memberMoneyLog($uid,73,floatval($_POST['money_collect']),$info);
		}
		//记录
		
        $this->assign('jumpUrl', __URL__."/index".session('listaction'));
		if($done){
			alogs("Members",0,1,'成功执行了会员余额调整的操作！');
			$this->success("操作成功");
		}else{
			alogs("Members",0,0,'执行会员余额调整的操作失败！');
			$this->error("操作失败");
		}
    }
	
    public function creditedit()
    {
		setBackUrl();
		$this->assign("id",intval($_GET['id']));
		$this->display();
    }
	
    public function doCreditEdit()
    {
		$id = intval($_POST['id']);
		
		$umoney = M('member_money')->field(true)->find($id);
		if(intval($_POST['credit_limit'])!=0){
			$moneyLog['uid'] = $id;
			$moneyLog['credit_limit'] = floatval($umoney['credit_limit']) + floatval($_POST['credit_limit']);
			$moneyLog['credit_cuse'] = floatval($umoney['credit_cuse']) + floatval($_POST['credit_limit']);
			if(!is_array($umoney))	$newid = M('member_money')->add($moneyLog);
			else $newid = M('member_money')->where("uid={$id}")->save($moneyLog);
		}
		if(intval($_POST['borrow_vouch_limit'])!=0){
			$moneyLog=array();
			$moneyLog['uid'] = $id;
			$moneyLog['borrow_vouch_limit'] = floatval($umoney['borrow_vouch_limit']) + floatval($_POST['borrow_vouch_limit']);
			$moneyLog['borrow_vouch_cuse'] = floatval($umoney['borrow_vouch_cuse']) + floatval($_POST['borrow_vouch_limit']);
			if(!is_array($umoney) && !$newid)	$newid = M('member_money')->add($moneyLog);
			else $newid = M('member_money')->where("uid={$id}")->save($moneyLog);
		}
		if(intval($_POST['invest_vouch_limit'])!=0){
			$moneyLog=array();
			$moneyLog['uid'] = $id;
			$moneyLog['invest_vouch_limit'] = floatval($umoney['invest_vouch_limit']) + floatval($_POST['invest_vouch_limit']);
			$moneyLog['invest_vouch_cuse'] = floatval($umoney['invest_vouch_cuse']) + floatval($_POST['invest_vouch_limit']);
			if(!is_array($umoney) && !$newid)	$newid = M('member_money')->add($moneyLog);
			else $newid = M('member_money')->where("uid={$id}")->save($moneyLog);
		}
		
		//修改会员信用等级积分（E级->AAA级）
		$userCredits = M('members')->field(true)->find($id);
		if(intval($_POST['credits'])!=0){
			$moneyLog=array();
			$moneyLog['id'] = $id;
			$moneyLog['credits'] = intval($userCredits['credits'])+intval($_POST['credits']);
			if(!is_array($userCredits) && !$newid)	$newid = M('members')->add($moneyLog);
			else $newid = M('members')->where("id={$id}")->save($moneyLog);
		}
		
        $this->assign('jumpUrl', __URL__."/index".session('listaction'));
		if($newid){
			alogs("Members",0,1,'成功执行了会员授信调整的操作！');
			$this->success("操作成功");
		}else{
			alogs("Members",0,0,'执行会员授信调整的操作失败！');
			$this->error("操作失败");
		}
    }
	
	
	public function _listFilter($list){
		$row=array();
		foreach($list as $key=>$v){
			if($v['recommend_id']<>0){
				$v['recommend_name'] = M("members")->getFieldById($v['recommend_id'],"user_name");
			 }else{
				$v['recommend_name'] ="<span style='color:#000'>无推荐人</span>";
			 }
			 if($v['is_vip']==1){
				$v['is_vip'] = "<span style='color:red'>内部发标专员</span>";
			 }else{
				$v['is_vip'] ="个人";
			 }
			($v['user_leve']==1 && $v['time_limit']>time())?$v['user_type'] = "<span style='color:red'>VIP会员</span>":$v['user_type'] = "普通会员";
			$row[$key]=$v;
		}
		return $row;
	}
	
	public function getusername(){
		$uname = M("members")->getFieldById(intval($_POST['uid']),"user_name");
		if($uname) exit(json_encode(array("uname"=>"<span style='color:green'>".$uname."</span>")));
		else exit(json_encode(array("uname"=>"<span style='color:orange'>不存在此会员</span>")));
	}
	
	 public function idcardedit() {
        $model = D(ucfirst($this->getActionName()));
		setBackUrl();
        $id = intval($_REQUEST['id']);
        $vo = $model->find($id);
		$vx = M('member_info')->where("uid={$id}")->find();
		if(!is_array($vx)){
			M('member_info')->add(array("uid"=>$id));
		}else{
			foreach($vx as $key=>$vxe){
				$vo[$key]=$vxe;
			}
		}
        $this->assign('vo', $vo);
		$this->assign("utype", C('XMEMBER_TYPE'));
        $this->display();
    }
	
	//添加身份证信息
    public function doIdcardEdit() {
        $model = D(ucfirst($this->getActionName()));
        $model2 = M("member_info");
		
        if (false === $model->create()) {
            $this->error($model->getError());
        }
        if (false === $model2->create()) {
            $this->error($model->getError());
        }
		
		$model->startTrans();
		/////////////////////////////
		if(!empty($_FILES['imgfile']['name'])){
			$this->fix = false;			
			$this->saveRule = 'uniqid';
			//$this->saveRule = date("YmdHis",time()).rand(0,1000)."_".$model->id;
			$this->savePathNew = C('ADMIN_UPLOAD_DIR').'Idcard/';
			$this->thumbMaxWidth = C('IDCARD_UPLOAD_H');
			$this->thumbMaxHeight = C('IDCARD_UPLOAD_W');
			$info = $this->CUpload();
			$data['card_img'] = $info[0]['savepath'].$info[0]['savename'];
			$data['card_back_img'] = $info[1]['savepath'].$info[1]['savename'];
			
			if($data['card_img']&&$data['card_back_img']){ 
				$model2->card_img=$data['card_img'];
				$model2->card_back_img=$data['card_back_img'];
			}
		}
		///////////////////////////
		$result = $model->save();
		$result2 = $model2->save();

        if ($result || $result2) { 
			$model->commit();
			alogs("Members",0,1,'成功执行了会员身份证代传的操作！');
            //成功提示
            $this->assign('jumpUrl', __URL__."/".session('listaction'));
            $this->success(L('修改成功'));
        } else {
			$model->rollback();
			alogs("Members",0,0,'执行会员身份证代传的操作失败！');
            //失败提示
            $this->error(L('修改失败'));
        }
    }
	///////////////////////////////////	

	public function memberborrow() {
	
		$member_id = intval($_REQUEST['member_id']);
		$map=array();
		
		$map['m.id'] = $member_id;
		//分页处理
		import("ORG.Util.Page");
		$count = M('borrow_investor bi')->join("{$this->pre}members m ON m.id=bi.investor_uid")->where($map)->count('bi.id');
		$p = new Page($count, C('ADMIN_PAGE_SIZE'));
		$page = $p->show();
		$Lsql = "{$p->firstRow},{$p->listRows}";
		//分页处理

		$field= 'bi.id bid,b.id,bi.investor_capital,bi.investor_interest,bi.invest_fee,bi.add_time,bi.is_auto,m.user_name,m.id mid,m.user_phone,b.borrow_duration,b.repayment_type,m.customer_name,b.borrow_type,b.borrow_name';
		$list = M('borrow_investor bi')->field($field)->join("{$this->pre}members m ON m.id=bi.investor_uid")->join("{$this->pre}borrow_info b ON b.id=bi.borrow_id")->where($map)->limit($Lsql)->order("bi.id DESC")->select();
		$list = $this->mb_listFilter($list);
	
		//dump($list);exit;
        $this->assign("list", $list);
        $this->assign("member_id", $member_id);
        $this->assign("pagebar", $page);
        $this->display();
	}
	//qi  直标导出
	public function mb_export(){
	
		import("ORG.Io.Excel");
		alogs("CapitalAccount",0,1,'执行了某会员投标记录列表导出操作！');
		$map=array();
		$member_id = intval($_REQUEST['member_id']);
		$map['m.id'] = $member_id;
		//分页处理
		import("ORG.Util.Page");
		$count = M('borrow_investor bi')->join("{$this->pre}members m ON m.id=bi.investor_uid")->where($map)->count('bi.id');
		$p = new Page($count, C('ADMIN_PAGE_SIZE'));
		$page = $p->show();
		$Lsql = "{$p->firstRow},{$p->listRows}";
		//分页处理
		$pre = $this->pre;
		$field= 'bi.id bid,b.id,bi.investor_capital,bi.investor_interest,bi.invest_fee,bi.add_time,bi.is_auto,m.user_name,m.id mid,m.user_phone,b.borrow_duration,b.repayment_type,m.customer_name,b.borrow_type,b.borrow_name';
		$list = M('borrow_investor bi')->field($field)->join("{$this->pre}members m ON m.id=bi.investor_uid")->join("{$this->pre}borrow_info b ON b.id=bi.borrow_id")->where($map)->order("bi.id DESC")->select();
		$list = $this->mb_listFilter($list);
	
		foreach($list as $v){
			$list[$key]['xmoney'] = $money;
		}
		$row=array();
		$row[0]=array('标号','用户名','手机号','客服','标题','投资金额','应得利息','投资期限','投资成交管理费','还款方式','标种类型','投标方式','投标时间');
		$i=1;
		foreach($list as $v){
				if(!$v['bid']){ break; }
				$row[$i]['uid'] = $v['bid'];
				$row[$i]['user_name'] = $v['user_name'];
				$row[$i]['user_phone'] = $v['user_phone'];
				$row[$i]['customer_name'] = $v['customer_name'];
				$row[$i]['borrow_name'] = $v['borrow_name'];
				$row[$i]['investor_capital'] = $v['investor_capital'];
				$row[$i]['investor_interest'] = $v['investor_interest'];
				if($v['repayment_type_num']){
					$d = "天";
				}else{
					$d = "个月";
				}
				$row[$i]['borrow_duration'] =  $v['borrow_duration'].$d;
				$row[$i]['invest_fee'] = $v['invest_fee'];
				
				$row[$i]['repayment_type'] = $v['repayment_type'];
				$row[$i]['borrow_type'] = $v['borrow_type'];
				$row[$i]['is_auto'] = $v['is_auto'];
				$row[$i]['add_time'] = date('Y-m-d H:i',$v['add_time']);
				
				$i++;
			}
		$xls = new Excel_XML('UTF-8', false, 'datalist');
		$xls->addArray($row);
		$xls->generateXML("mb_export");
	}

	public function transferborrow() {
	
		$member_id = intval($_REQUEST['member_id']);
		$map=array();
		
		$map['m.id'] = $member_id;
		$map['bi.is_jijin'] = 0;
		//分页处理
		import("ORG.Util.Page");
		$count = M('transfer_borrow_investor bi')->join("{$this->pre}members m ON m.id=bi.investor_uid")->where($map)->count('bi.id');
		$p = new Page($count, C('ADMIN_PAGE_SIZE'));
		$page = $p->show();
		$Lsql = "{$p->firstRow},{$p->listRows}";
		//分页处理

		$field= 'bi.id bid,b.id,bi.investor_capital,bi.investor_interest,bi.invest_fee,bi.add_time,bi.is_auto,m.user_name,m.id mid,m.user_phone,b.borrow_duration,b.repayment_type,m.customer_name,b.borrow_type,b.borrow_name';
		$list = M('transfer_borrow_investor bi')->field($field)->join("{$this->pre}members m ON m.id=bi.investor_uid")->join("{$this->pre}transfer_borrow_info b ON b.id=bi.borrow_id")->where($map)->limit($Lsql)->order("bi.id DESC")->select();
		$list = $this->mb_listFilter($list);
	
		//dump($list);exit;
        $this->assign("list", $list);
        $this->assign("member_id", $member_id);
        $this->assign("pagebar", $page);
        $this->display();
	}
	//qi  散标导出
	public function trans_export(){
	
		import("ORG.Io.Excel");
		alogs("CapitalAccount",0,1,'执行了某会员投标记录列表导出操作！');
		$map=array();
		$member_id = intval($_REQUEST['member_id']);
		$map['m.id'] = $member_id;
		$map['bi.is_jijin'] = 0;
		//分页处理
		import("ORG.Util.Page");
		$count = M('transfer_borrow_investor bi')->join("{$this->pre}members m ON m.id=bi.investor_uid")->where($map)->count('bi.id');
		$p = new Page($count, C('ADMIN_PAGE_SIZE'));
		$page = $p->show();
		$Lsql = "{$p->firstRow},{$p->listRows}";
		//分页处理
		$pre = $this->pre;
		$field= 'bi.id bid,b.id,bi.investor_capital,bi.investor_interest,bi.invest_fee,bi.add_time,bi.is_auto,m.user_name,m.id mid,m.user_phone,b.borrow_duration,b.repayment_type,m.customer_name,b.borrow_type,b.borrow_name';
		$list = M('transfer_borrow_investor bi')->field($field)->join("{$this->pre}members m ON m.id=bi.investor_uid")->join("{$this->pre}transfer_borrow_info b ON b.id=bi.borrow_id")->where($map)->order("bi.id DESC")->select();
		$list = $this->mb_listFilter($list);
	
		foreach($list as $v){
			$list[$key]['xmoney'] = $money;
		}
		$row=array();
		$row[0]=array('标号','用户名','手机号','客服','标题','投资金额','应得利息','投资期限','投资成交管理费','还款方式','标种类型','投标方式','投标时间');
		$i=1;
		foreach($list as $v){
				if(!$v['bid']){ break; }
				$row[$i]['uid'] = $v['bid'];
				$row[$i]['user_name'] = $v['user_name'];
				$row[$i]['user_phone'] = $v['user_phone'];
				$row[$i]['customer_name'] = $v['customer_name'];
				$row[$i]['borrow_name'] = $v['borrow_name'];
				$row[$i]['investor_capital'] = $v['investor_capital'];
				$row[$i]['investor_interest'] = $v['investor_interest'];
				if($v['repayment_type_num']){
					$d = "天";
				}else{
					$d = "个月";
				}
				$row[$i]['borrow_duration'] =  $v['borrow_duration'].$d;
				$row[$i]['invest_fee'] = $v['invest_fee'];
				
				$row[$i]['repayment_type'] = $v['repayment_type'];
				$row[$i]['borrow_type'] = $v['borrow_type'];
				$row[$i]['is_auto'] = $v['is_auto'];
				$row[$i]['add_time'] = date('Y-m-d H:i',$v['add_time']);
				
				$i++;
			}
		$xls = new Excel_XML('UTF-8', false, 'datalist');
		$xls->addArray($row);
		$xls->generateXML("trans_export");
	}
	//qi transferborrow
	public function mb_listFilter($list){
		
		$Bconfig = require C("APP_ROOT")."Conf/borrow_config.php";
	 	$listType = $Bconfig['REPAYMENT_TYPE'];
	 	$BType = $Bconfig['BORROW_TYPE'];
		$row=array();
		$aUser = get_admin_name();
		foreach($list as $key=>$v){
			$v['repayment_type_num'] = $v['repayment_type'];
			$v['repayment_type'] = $listType[$v['repayment_type']];
			$v['borrow_type'] = $BType[$v['borrow_type']];
			if($v['deadline']) $v['overdue'] = getLeftTime($v['deadline']) * (-1);
			if($v['borrow_status']==1 || $v['borrow_status']==3 || $v['borrow_status']==5){
				$v['deal_uname_2'] = $aUser[$v['deal_user_2']];
				$v['deal_uname'] = $aUser[$v['deal_user']];
			}

			$v['last_money'] = $v['borrow_money']-$v['has_borrow'];
			if($v['is_auto']==1){
				$v['is_auto']="自动投标";
			}else{
				$v['is_auto']="手动投标";
			}
			
			$row[$key]=$v;
		}
		return $row;
	}
}
?>
