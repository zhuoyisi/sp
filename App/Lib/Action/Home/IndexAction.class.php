<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends HCommonAction {
    public function app()
    {
        
            $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
            if(strpos($useragent, 'iphone')||strpos($useragent, 'ipad')){
                $source_from = 2;
            }else if(strpos($useragent, 'android')){
                $source_from = 1;
            }else{
                $source_from = 1;
            }
        
        if($source_from == 1){
            $path_name = dirname(APP_PATH).'/UF/dw/app-release.apk';   
        }else{
            $path_name = dirname(APP_PATH).'/UF/dw/ocCrazy.ipa';   
        }
        $save_name = 'xyjrp2p.v2.'. end(explode('.', $path_name));
        $save_name or $save_name = basename($path_name);
        ob_end_clean();
        $hfile = fopen($path_name, "rb") or die("Can not find file: $path_name\n");
        Header("Content-type: application/octet-stream");
        Header("Content-Transfer-Encoding: binary");
        Header("Accept-Ranges: bytes");
        Header("Content-Length: ".filesize($path_name));
        Header("Content-Disposition: attachment; filename=\"$save_name\"");
        while (!feof($hfile)) {
           echo fread($hfile, 32768);
        }
        fclose($hfile);

        // outWeb('', '版本更新');
    }
    public function index(){
	
		$per = C('DB_PREFIX');
	    $Bconfig = require C("APP_ROOT")."Conf/borrow_config.php";
		//网站公告
		$parm['type_id'] = 9;
		$parm['limit'] = 3;
		$this->assign("noticeList",getArticleList($parm));
    //网站公告
    
    //正在进行的贷款
    $searchMap = array();
    $searchMap['b.borrow_status']=array("in",'2,4,6,7');
    $searchMap['b.is_tuijian']=array("in",'0,1');
	$searchMap['m.is_transfer']=array("in",'0');
	$searchMap['b.borrow_type']=array("in",'1,2,3,4,5');
    $parm=array();
    $parm['map'] = $searchMap;
    $parm['limit'] = 4;
    $parm['orderby']="b.borrow_status ASC,b.id DESC";
    $listBorrow = getBorrowList($parm);
    $this->assign("listBorrow",$listBorrow);
	//正在进行的贷款
    $searchMap = array();
    $searchMap['b.borrow_status']=array("in",'2,4,6,7');
    $searchMap['b.is_tuijian']=array("in",'0,1');
	$searchMap['m.is_transfer']=array("in",'1');
	$searchMap['b.borrow_type']=array("in",'1,2,3,4,5');
    $parm=array();
    $parm['map'] = $searchMap;
    $parm['limit'] = 2;
    $parm['orderby']="b.borrow_status ASC,b.id DESC";
    $listJBorrow = getBorrowList($parm);
    $this->assign("listJBorrow",$listJBorrow);
	//测试时间获取函数开始
	//$date = date("Y-m-d",time());
   	//$ret =  get_date($date,'m');
   	//dump($ret);exit;
	//测试时间获取函数结束
	 

		$members = M('members')->count();
		$this->assign("members",$members);
		
			$loan_info = loan_total_info();
	$this->assign("loan_info",$loan_info);
    
    $map1['status'] = array("in","4,5");
    $receive_capital=array();
    $receive_capital = M('borrow_investor')->where($map1)->SUM('investor_capital') +  M('transfer_borrow_investor')->where($map1)->SUM('investor_capital');
	$receive_interest=array();
    $receive_interest = M('borrow_investor')->where($map1)->SUM('investor_interest') +  M('transfer_borrow_investor')->where($map1)->SUM('investor_interest');
	$this->assign("receive_capital",$receive_capital);
	$this->assign("receive_interest",$receive_interest);
		
		D("DebtBehavior");
    $Debt = new DebtBehavior();
    $list = $Debt->listAll($parm);
    $this->assign("list", $list);
	

   ///////////////企业直投列表开始  fan 2013-10-21//////////////
    $parm = array();
    $searchMap = array();
    //$searchMap['borrow_status']=2;
	//$searchMap['b.on_off']=1;
	$searchMap['b.is_jijin']=0;
    $searchMap['b.is_show'] = array('in','0,1');
	$searchMap['b.borrow_status'] = array('neq','3');
	$searchMap['b.online_time']=array("lt",time());
    $parm['map'] = $searchMap;
    $parm['limit'] = 5;
    $parm['orderby'] = "b.is_show desc,b.progress asc";
    $listTBorrow = getTBorrowList($parm);
    $this->assign("listTBorrow",$listTBorrow);
    ///////////////企业直投列表结束  fan 2013-10-21//////////////
    ///////////////定投宝列表开始  fan 2014-06-13//////////////
		$parm = array();
		$searchMap = array();
		//$searchMap['borrow_status']=2;
		//$searchMap['is_tuijian']=0;
		//$searchMap['on_off']=1;
		$searchMap['is_jijin']=1;
		$searchMap['b.online_time']=array("lt",time()+300);
		$parm['map'] = $searchMap;
		$parm['limit'] = 5;
		$parm['orderby'] = "b.is_show desc,b.borrow_status ASC,b.borrow_duration ASC,b.online_time desc";
		$listFBorrow = getTBorrowList($parm);
		//dump($listFBorrow);
		$this->assign("listFBorrow",$listFBorrow);
		
	///////////////定投宝列表结束  fan 2014-06-13///////////////

  //exit;
    $this->display();
    /****************************募集期内标未满,自动流标 新增 2013-03-13****************************/

    //流标返回
    $mapT = array();
    $mapT['collect_time']=array("lt",time());
    $mapT['borrow_status'] = 2;
    $tlist = M("borrow_info")->field("id,borrow_uid,borrow_type,borrow_money,first_verify_time,borrow_interest_rate,borrow_duration,repayment_type,collect_day,collect_time")->where($mapT)->select();
    if(empty($tlist)) exit;
    foreach($tlist as $key=>$vbx){
    $borrow_id=$vbx['id'];
    //流标
    $done = false;
    $borrowInvestor = D('borrow_investor');
    $binfo = M("borrow_info")->field("borrow_type,borrow_money,borrow_uid,borrow_duration,repayment_type")->find($borrow_id);
    $investorList = $borrowInvestor->field('id,investor_uid,investor_capital')->where("borrow_id={$borrow_id}")->select();
    M('investor_detail')->where("borrow_id={$borrow_id}")->delete();
    if($binfo['borrow_type']==1) $limit_credit = memberLimitLog($binfo['borrow_uid'],12,($binfo['borrow_money']),$info="{$binfo['id']}号标流标");//返回额度
    $borrowInvestor->startTrans();
    
    $bstatus = 3;
    $upborrow_info = M('borrow_info')->where("id={$borrow_id}")->setField("borrow_status",$bstatus);
    //处理借款概要
    $buname = M('members')->getFieldById($binfo['borrow_uid'],'user_name');
    //处理借款概要
    if(is_array($investorList)){
    $upsummary_res = M('borrow_investor')->where("borrow_id={$borrow_id}")->setField("status",$type);
    foreach($investorList as $v){
    MTip('chk15',$v['investor_uid']);//sss
    $accountMoney_investor = M("member_money")->field(true)->find($v['investor_uid']);
    $datamoney_x['uid'] = $v['investor_uid'];
    $datamoney_x['type'] = ($type==3)?16:8;
    $datamoney_x['affect_money'] = $v['investor_capital'];
    $datamoney_x['account_money'] = ($accountMoney_investor['account_money'] + $datamoney_x['affect_money']);//投标不成功返回充值资金池
    $datamoney_x['collect_money'] = $accountMoney_investor['money_collect'];
    $datamoney_x['freeze_money'] = $accountMoney_investor['money_freeze'] - $datamoney_x['affect_money'];
    $datamoney_x['back_money'] = $accountMoney_investor['back_money'];
    
    //会员帐户
    $mmoney_x['money_freeze']=$datamoney_x['freeze_money'];
    $mmoney_x['money_collect']=$datamoney_x['collect_money'];
    $mmoney_x['account_money']=$datamoney_x['account_money'];
    $mmoney_x['back_money']=$datamoney_x['back_money'];
    
    //会员帐户
    $_xstr = ($type==3)?"复审未通过":"募集期内标未满,流标";
    $datamoney_x['info'] = "第{$borrow_id}号标".$_xstr."，返回冻结资金";
    $datamoney_x['add_time'] = time();
    $datamoney_x['add_ip'] = get_client_ip();
    $datamoney_x['target_uid'] = $binfo['borrow_uid'];
    $datamoney_x['target_uname'] = $buname;
    $moneynewid_x = M('member_moneylog')->add($datamoney_x);
    if($moneynewid_x) $bxid = M('member_money')->where("uid={$datamoney_x['uid']}")->save($mmoney_x);
    }
    }else{
    $moneynewid_x = true;
    $bxid=true;
    $upsummary_res=true;
    }
    
    if($moneynewid_x && $upsummary_res && $bxid && $upborrow_info){
    $done=true;
    $borrowInvestor->commit();
    }else{
    $borrowInvestor->rollback();
    }
    if(!$done) continue;
    
    
    MTip('chk11',$vbx['borrow_uid'],$borrow_id);
    $verify_info['borrow_id'] = $borrow_id;
    $verify_info['deal_info_2'] = text($_POST['deal_info_2']);
    $verify_info['deal_user_2'] = 0;
    $verify_info['deal_time_2'] = time();
    $verify_info['deal_status_2'] = 3;
    if($vbx['first_verify_time']>0) M('borrow_verify')->save($verify_info);
    else  M('borrow_verify')->add($verify_info);
    
    $vss = M("members")->field("user_phone,user_name")->where("id = {$vbx['borrow_uid']}")->find();
    SMStip("refuse",$vss['user_phone'],array("#USERANEM#","ID"),array($vss['user_name'],$verify_info['borrow_id']));
    //@SMStip("refuse",$vss['user_phone'],array("#USERANEM#","ID"),array($vss['user_name'],$verify_info['borrow_id']));
    //updateBinfo
    $newBinfo=array();
    $newBinfo['id'] = $borrow_id;
    $newBinfo['borrow_status'] = 3;
    $newBinfo['second_verify_time'] = time();
    $x = M("borrow_info")->save($newBinfo);
    }
    /****************************募集期内标未满,自动流标 新增 2013-03-13****************************/
    
    }	
  }
	
