<?php
class TenderAction extends ACommonAction
{
	public function index()
	{
		$startdate = $_REQUEST['startdate'];
		$enddate = $_REQUEST['enddate'];
		$user_name = $_REQUEST['user_name'];
		$real_name = $_REQUEST['real_name'];
		$borrow_name = $_REQUEST['borrow_name'];
		$search = array();
		
		$map='1 = 1 ';	
		if($startdate){	
			$startdate = strtotime($startdate);
			$map .= ' and bi.add_time  > ' . $startdate;
			$search['startdate'] =  $startdate;
		}
		if($enddate){
			$enddate = strtotime($enddate);
			$map .= ' and bi.add_time  < ' . $enddate;
			$search['enddate'] =  $enddate;
		}
		if($user_name){
			$map .= " and m.user_name  = '" . $user_name . "' and bi.status != '2' and bi.status != '3' and bi.status != '0'";
			$search['user_name'] =  $user_name;
		}
		if($real_name){
			$map .= " and mi.real_name  = '" . $real_name . "' and bi.status != '2' and bi.status != '3' and bi.status != '0'";
			$search['real_name'] =  $real_name;
		}
		if($borrow_name){
			$map .= " and b.borrow_name  = '" . $borrow_name . "' and bi.status != '2' and bi.status != '3' and bi.status != '0'";
			$search['borrow_name'] =  $borrow_name;
		}

		//分页处理
		import("ORG.Util.Page");
		$count = M('borrow_investor bi')->join("{$this->pre}members m ON m.id=bi.investor_uid")->join("{$this->pre}member_info mi ON m.id=mi.uid")->where($map)->count('bi.id');
		$p = new Page($count, C('ADMIN_PAGE_SIZE'));
		$page = $p->show();
		$Lsql = "{$p->firstRow},{$p->listRows}";
		//分页处理
		$pre = $this->pre;
		$field= 'bi.id bid,b.id,bi.investor_capital,bi.investor_interest,bi.invest_fee,bi.add_time,bi.is_auto,m.user_name,m.id mid,m.user_phone,b.borrow_duration,b.repayment_type,m.customer_name,b.borrow_type,b.borrow_name,mi.real_name';
		$list = M('borrow_investor bi')->field($field)->join("{$this->pre}members m ON m.id=bi.investor_uid")->join("{$this->pre}member_info mi ON m.id=mi.uid")->join("{$this->pre}borrow_info b ON b.id=bi.borrow_id")->where($map)->limit($Lsql)->order("bi.id DESC")->select();
		$list = $this->mb_listFilter($list);
        $this->assign("list", $list);
        
        $this->assign("pagebar", $page);
		$this->assign("search", $search);
		$this->assign("query", http_build_query($search));
        $this->display();
	}
	public function export(){
	
		import("ORG.Io.Excel");
		alogs("CapitalAccount",0,1,'执行指定条件下投标记录列表导出操作！');	
		$map = '1 = 1 ';
		
		if($_REQUEST['startdate']){	
			$map .= ' and bi.add_time  > ' . $_REQUEST['startdate'];
		}
		if($_REQUEST['enddate']){
			$map .= ' and bi.add_time  < ' . $_REQUEST['enddate'];
		}
		if($_REQUEST['user_name']){
			$map .= " and m.user_name  = '" . $_REQUEST['user_name'] . "' and bi.status != '2' and bi.status != '3' and bi.status != '0'";
		}
		if($_REQUEST['real_name']){
			$map .= " and mi.real_name  = '" . $_REQUEST['real_name'] . "' and bi.status != '2' and bi.status != '3' and bi.status != '0'";
		}
		if($_REQUEST['borrow_name']){
			$map .= " and b.borrow_name  = '" . $_REQUEST['borrow_name'] . "' and bi.status != '2' and bi.status != '3' and bi.status != '0'";
		}
		
		//分页处理
		import("ORG.Util.Page");
		$count = M('borrow_investor bi')->join("{$this->pre}members m ON m.id=bi.investor_uid")->join("{$this->pre}member_info mi ON m.id=mi.uid")->where($map)->count('bi.id');
		$p = new Page($count, C('ADMIN_PAGE_SIZE'));
		$page = $p->show();
		$Lsql = "{$p->firstRow},{$p->listRows}";
		//分页处理
		$pre = $this->pre;
		$field= 'bi.id bid,b.id,bi.investor_capital,bi.investor_interest,bi.invest_fee,bi.add_time,bi.is_auto,m.user_name,m.id mid,m.user_phone,b.borrow_duration,b.repayment_type,m.customer_name,b.borrow_type,b.borrow_name,mi.real_name';
		$list = M('borrow_investor bi')->field($field)->join("{$this->pre}members m ON m.id=bi.investor_uid")->join("{$this->pre}member_info mi ON m.id=mi.uid")->join("{$this->pre}borrow_info b ON b.id=bi.borrow_id")->where($map)->order("bi.id DESC")->select();
		$list = $this->mb_listFilter($list);
	
		foreach($list as $v){
			$list[$key]['xmoney'] = $money;
		}
		$row=array();
		$row[0]=array('标号','用户名','用户名','手机号','客服','标题','投资金额','应得利息','投资期限','投资成交管理费','还款方式','标种类型','投标方式','投标时间');
		$i=1;
		foreach($list as $v){
				if(!$v['bid']){ break; }
				$row[$i]['uid'] = $v['bid'];
				$row[$i]['user_name'] = $v['user_name'];
				$row[$i]['real_name'] = $v['real_name'];
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
		$xls->generateXML("tender");
	}
	public function transfer()
	{

		$startdate = $_REQUEST['startdate'];
		$enddate = $_REQUEST['enddate'];
		$user_name = $_REQUEST['user_name'];
		$real_name = $_REQUEST['real_name'];
		$search = array();
		
		$map='1 = 1 ';	
		if($startdate){	
			$startdate = strtotime($startdate);
			$map .= ' and bi.add_time  > ' . $startdate;
			$search['startdate'] =  $startdate;
		}
		if($enddate){
			$enddate = strtotime($enddate);
			$map .= ' and bi.add_time  < ' . $enddate;
			$search['enddate'] =  $enddate;
		}
		if($user_name){
			$map .= " and m.user_name  = '" . $user_name . "'";
			$search['user_name'] =  $user_name;
		}
		if($real_name){
			$map .= " and mi.real_name  = '" . $real_name . "'";
			$search['real_name'] =  $real_name;
		}
		$map.= " and bi.is_jijin  = 0";
		//分页处理
		import("ORG.Util.Page");
		$count = M('transfer_borrow_investor bi')->join("{$this->pre}members m ON m.id=bi.investor_uid")->join("{$this->pre}member_info mi ON m.id=mi.uid")->where($map)->count('bi.id');
		$p = new Page($count, C('ADMIN_PAGE_SIZE'));
		$page = $p->show();
		$Lsql = "{$p->firstRow},{$p->listRows}";
		//分页处理
		$pre = $this->pre;
		$field= 'bi.id bid,b.id,bi.investor_capital,bi.investor_interest,bi.invest_fee,bi.add_time,bi.is_auto,m.user_name,m.id mid,m.user_phone,b.borrow_duration,b.repayment_type,m.customer_name,b.borrow_type,b.borrow_name,mi.real_name,bi.is_jijin';
		$list = M('transfer_borrow_investor bi')->field($field)->join("{$this->pre}members m ON m.id=bi.investor_uid")->join("{$this->pre}member_info mi ON m.id=mi.uid")->join("{$this->pre}transfer_borrow_info b ON b.id=bi.borrow_id")->where($map)->limit($Lsql)->order("bi.id DESC")->select();
		
		$list = $this->mb_listFilter($list);
		
        $this->assign("list", $list);
        
        $this->assign("pagebar", $page);
		$this->assign("search", $search);
		$this->assign("query", http_build_query($search));
        $this->display();
	}
	public function transfer_export(){
	
		import("ORG.Io.Excel");
		alogs("CapitalAccount",0,1,'执行指定条件下投标记录列表导出操作！');	
		$map = '1 = 1 ';
		
		if($_REQUEST['startdate']){	
			$map .= ' and bi.add_time  > ' . $_REQUEST['startdate'];
		}
		if($_REQUEST['enddate']){
			$map .= ' and bi.add_time  < ' . $_REQUEST['enddate'];
		}
		if($_REQUEST['user_name']){
			$map .= " and m.user_name  = '" . $_REQUEST['user_name'] . "'";
		}
		if($_REQUEST['real_name']){
			$map .= " and mi.real_name  = '" . $_REQUEST['real_name'] . "'";
		}
		$map.= " and bi.is_jijin  = 0";
		//分页处理
		import("ORG.Util.Page");
		$count = M('transfer_borrow_investor bi')->join("{$this->pre}members m ON m.id=bi.investor_uid")->join("{$this->pre}member_info mi ON m.id=mi.uid")->where($map)->count('bi.id');
		$p = new Page($count, C('ADMIN_PAGE_SIZE'));
		$page = $p->show();
		$Lsql = "{$p->firstRow},{$p->listRows}";
		//分页处理
		$pre = $this->pre;
		$field= 'bi.id bid,b.id,bi.investor_capital,bi.investor_interest,bi.invest_fee,bi.add_time,bi.is_auto,m.user_name,m.id mid,m.user_phone,b.borrow_duration,b.repayment_type,m.customer_name,b.borrow_type,b.borrow_name,mi.real_name,bi.is_jijin';
		$list = M('transfer_borrow_investor bi')->field($field)->join("{$this->pre}members m ON m.id=bi.investor_uid")->join("{$this->pre}member_info mi ON m.id=mi.uid")->join("{$this->pre}transfer_borrow_info b ON b.id=bi.borrow_id")->where($map)->order("bi.id DESC")->select();
		$list = $this->mb_listFilter($list);
	
		foreach($list as $v){
			$list[$key]['xmoney'] = $money;
		}
		$row=array();
		$row[0]=array('标号','用户名','用户名','手机号','客服','标题','投资金额','应得利息','投资期限','投资成交管理费','还款方式','标种类型','投标方式','投标时间');
		$i=1;
		foreach($list as $v){
				if(!$v['bid']){ break; }
				$row[$i]['uid'] = $v['bid'];
				$row[$i]['user_name'] = $v['user_name'];
				$row[$i]['real_name'] = $v['real_name'];
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
		$xls->generateXML("transfer_tenter");
	}
	//qi
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

			$v['last_money'] = $v['borrow_money']-$v['has_borrow'];//新增剩余金额
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