<?php
/**
 * @funciton userinfo用户基本信息 
 */
class PayAction extends BaseAction {
	protected $uid;
	public function _initialize(){		
		parent::_initialize();
		$this->uid = intval($_REQUEST["uid"]) or die;		
	}
	public function charge(){		
		$uid = $this->uid;
		$this->return_url = "http://".$_SERVER['HTTP_HOST'].U("pay/payreturn",'','');
		$this->notice_url = "http://".$_SERVER['HTTP_HOST'].U("/home/pay/paynotice",'','');

		$money = empty($_REQUEST['money']) ? 0.00 : text($_REQUEST['money']);
		$feeAmt = empty($_REQUEST['feeAmt']) ? 0.00 : text($_REQUEST['feeAmt']);
		$way = empty($_REQUEST['way']) ? 'ecpss2' : text($_REQUEST['way']);
		$source_from = empty($_REQUEST['source_from']) ? '0' : text($_REQUEST['source_from']);
		$merOrderNum = date('YmdHis').'-'.substr(microtime(),2,8);
		$tranDateTime = date("YmdHis",time());

		$money = getFloatValue($money,2);
		$feeAmt = getFloatValue($feeAmt,2);		
		if(empty($money) || $money <= 0){			
			$jsons["tips"] = "请正确填写充值金额";			
			outJson($jsons);
		}
		$rs = array();
		switch ($way) {
			case 'ecpss2':
				$rs = $this->charge_by_ecpss2($money);
				break;
			default:
				$jsons["tips"] = "支付方式不存在！";			
				outJson($jsons);
				break;
		}

		$data['money'] = $money;
		$data['fee']   = empty($rs['fee']) ? '0.00' : getFloatValue($rs['fee'], 2);
		$data['add_time'] = time();
		$data['add_ip'] = get_client_ip();
		$data['status'] = 0 ;
		$data['uid'] = $uid;
		$data['nid'] = $merOrderNum;
		$data['way'] = $way;
		$data['source_from'] = $source_from;
		$newid = M('member_payonline')->add($data);
		if($newid){			
			$this->create( $rs['submitdata'], $rs['req_url'] );//正式环境		
			die;
			$jsons["status"] = '1';
			$jsons["tips"]   = "提交成功！";			
			$jsons = array_merge($rs,$jsons);
		}else{
			$jsons["tips"] = "提交失败，请重试！";			
		}
		outJson($jsons);
	}
	private function charge_by_ecpss2($money = 0.00){
		$payConfig = FS("Webconfig/payconfig");
		if ($payConfig['ecpss2']['enable'] == 0 ){			
			$jsons["tips"] = "对不起，该支付方式被关闭，暂时不能使用！";
			outJson($jsons);
		}		
		$submitdata['MerNo']  = $payConfig['ecpss2']['MerNo'];
		$submitdata['BillNo'] = date('YmdHis').'-'.substr(microtime(),2,8);
		$submitdata['Amount'] = $money;
		$submitdata['ReturnURL'] = $this->return_url."/payid/ecpss2";
		$submitdata['AdviceURL'] = $this->notice_url."/payid/ecpss2";
		$submitdata['orderTime'] = (string)date('YmdHis',time());		
		$submitdata['SignInfo']  = $this->getSign( "ecpss2", $submitdata);		
		$submitdata['defaultBankNumber'] = 'UNIONPAY';
		$submitdata['Remark']    = "帐户充值";
		$submitdata['products']  = "帐户充值";
		$submitdata['fee'] = getfloatvalue( $payConfig['ecpss2']['feerate'] * $money / 100,2);
		$rs['submitdata']  = $submitdata;
		$rs['req_url'] = "https://pay.ecpss.com/sslpayment";
		return $rs;
	}
	private function getSign($type,$data){
		$payConfig = FS("Webconfig/payconfig");
		$md5str="";
		switch($type){
			case "ecpss2":
				$signarray=array('MerNo','BillNo','Amount','ReturnURL');//校验源字符串
				foreach($signarray as $v){
					if(!isset($data[$v])) $md5str .= "";
					else $md5str .= '&'."$data[$v]";
				}			    
				$md5str.='&'.$payConfig['ecpss2']['MD5key'];//MD5密钥
				$md5str = trim($md5str,'&');													
				$md5str = strtoupper(md5($md5str));
				return $md5str;
			case "ecpss2_return":
				$signarray = array( "BillNo", "Amount", "Succeed");//校验源字符串
				foreach ($signarray as $v){
					if($v=='Amount') $data[$v] = getFloatValue($data[$v],2);
					$md5str .= $data[$v];
				}
				$md5str .= $payConfig['ecpss2']['MD5key'];
				$md5str = strtoupper(md5($md5str));
				return $md5str;			
			break;
		}
	}
	public function payreturn(){
		writeLog($_REQUEST);
		$payid = $_REQUEST['payid'];
		switch($payid){
			case "ecpss2":
				$signGet = $this->getSign("ecpss2_return", $_REQUEST);
				if($_REQUEST['MD5info'] == $signGet){
					$recode = $_REQUEST['Succeed'];
					if ($recode=="1" || $recode=="9" || $recode=="19" || $recode=="88") {
						outWeb("充值完成",'页面跳转中.....');die;
					}
				}		
			break;
		}
		outWeb("充值失败",'页面跳转中.....');
	}	
	private function create($data,$submitUrl){
		$inputstr = "";
		foreach($data as $key=>$v){
			$inputstr .= '<input type="hidden"  id="'.$key.'" name="'.$key.'" value="'.$v.'"/>';
		}
		$form = '<form action="'.$submitUrl.'" name="pay" id="pay" method="POST">';
		$form.=	$inputstr;
		$form.=	'</form>';
		$html = '';
        $html.=	$form;
        $html.=	'<script type="text/javascript">document.getElementById("pay").submit();</script>';
		Mheader('utf-8');
		outWeb($html,'请不要关闭页面,支付跳转中.....');		
		exit;
	}
}
