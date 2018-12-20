<?php
function outJson($data)
{
    header('content-type:application/json;charset=utf-8');
    $data['status'] = isset($data['status']) ? strval($data['status']) : "0";
    echo jsonFormat($data); 
    die;
    // exit(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
}
/** Json数据格式化 
* @param  Mixed  $data   数据 
* @param  String $indent 缩进字符，默认4个空格 
* @return JSON 
*/  
function jsonFormat($data, $indent=null){  
  
    // 对数组中每个元素递归进行urlencode操作，保护中文字符  
    array_walk_recursive($data, 'jsonFormatProtect');  
  
    // json encode  
    $data = json_encode($data);  
  
    // 将urlencode的内容进行urldecode  
    $data = urldecode($data);  
  
    // 缩进处理  
    $ret = '';  
    $pos = 0;  
    $length = strlen($data);  
    $indent = isset($indent)? $indent : '    ';  
    $newline = "\n";  
    $prevchar = '';  
    $outofquotes = true;  
  
    for($i=0; $i<=$length; $i++){  
  
        $char = substr($data, $i, 1);  
  
        if($char=='"' && $prevchar!='\\'){  
            $outofquotes = !$outofquotes;  
        }elseif(($char=='}' || $char==']') && $outofquotes){  
            $ret .= $newline;  
            $pos --;  
            for($j=0; $j<$pos; $j++){  
                $ret .= $indent;  
            }  
        }  
  
        $ret .= $char;  
          
        if(($char==',' || $char=='{' || $char=='[') && $outofquotes){  
            $ret .= $newline;  
            if($char=='{' || $char=='['){  
                $pos ++;  
            }  
  
            for($j=0; $j<$pos; $j++){  
                $ret .= $indent;  
            }  
        }  
  
        $prevchar = $char;  
    }  
  
    return $ret;  
}  
  
/** 将数组元素进行urlencode 
* @param String $val 
*/  
function jsonFormatProtect(&$val){  
    if($val!==true && $val!==false && $val!==null){  
        $val = urlencode($val);  
    }  
}
function writeLog($str){
    $logTit = '==  '.date('Y-m-d H:i:s').'  '.get_client_ip().'  =====================' . PHP_EOL;
    $str    = $logTit.var_export($str,TRUE).PHP_EOL;
    $open   = fopen(dirname(__FILE__)."/log.txt","a" );
    fwrite($open,$str.PHP_EOL);
    fclose($open);
}
function arrayFilterValByKey($arr, $filterKey, $filter = true)
{
    foreach ($arr as $key => $value) {        
        is_null($value) and $arr[$key] = (string)$value;
        if ($filter && !in_array($key, $filterKey)) {
            unset($arr[$key]);
        }

        if (!$filter && in_array($key, $filterKey)) {
            unset($arr[$key]);
        }
    }
    return $arr;
}
function arrayToArray($array)
{
    $keys   = array_keys($array);
    $vals   = array_values($array);
    $newArr = array();
    foreach ($keys as $key => $value) {
        $newArr[] = array(
            'id'   => strval($value),
            'name' => $vals[$key],
        );
    }
    return $newArr;
}
function pageSet($_page, $p = 1, $size = 10)
{
    $pageSet['nowPage']    = strval(intval($p));
    $pageSet['totalPages'] = strval(intval(@$_page->totalPages));
    $pageSet['totalRows']  = strval(intval(@$_page->totalRows));
    $pageSet['pageSize']   = strval($size);
    return $pageSet;
}

function make_avatar_path($uid, $dir = '.')
{
    $uid  = sprintf("%09d", $uid);
    $dir1 = substr($uid, 0, 3);
    $dir2 = substr($uid, 3, 2);
    $dir3 = substr($uid, 5, 2);
    !is_dir($dir . '/' . $dir1) && mkdir($dir . '/' . $dir1, 0777);
    !is_dir($dir . '/' . $dir1 . '/' . $dir2) && mkdir($dir . '/' . $dir1 . '/' . $dir2, 0777);
    !is_dir($dir . '/' . $dir1 . '/' . $dir2 . '/' . $dir3) && mkdir($dir . '/' . $dir1 . '/' . $dir2 . '/' . $dir3, 0777);
    return $dir1 . '/' . $dir2 . '/' . $dir3;
}
function verifyCode($codeId, $txtCode)
{
    $verifyRs = M('verify_code')->where("md5(id) = '{$codeId}'")->getField('content');
    if (isset($verifyRs['content']) && $txtCode == $verifyRs['content']) {
        return true;
    }
    return false;
}
function outWeb($content, $title = '')
{
    header("Content-Type:text/html;charset=utf-8");
    $outStr = '<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<title>' . $title . '</title>
			<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0"/>
			<meta name="apple-mobile-web-app-capable" content="yes"/>
			<meta name="apple-mobile-web-app-status-bar-style" content="black">
            <style>*{max-width:100% !important;text-indent:0px !important;}</style>
		</head>
		<body>' . $content . '</body></html>';
    exit($outStr);
}

function getFriendList($map, $size, $xuid = 0)
{
    //if(empty($map['f.uid'])) return;
    $pre = C('DB_PREFIX');

    //分页处理
    import("ORG.Util.Page");
    $count = M('member_friend f')->where($map)->count('f.id');
    $p     = new Page($count, $size);
    $page  = $p->show();
    $Lsql  = "{$p->firstRow},{$p->listRows}";
    //分页处理

    $list = M('member_friend f')->field("f.uid,f.friend_id,f.add_time,m.user_name,m.credits,fm.user_name as funame,fm.credits as fcredits")->join("{$pre}members m ON f.uid = m.id")->join("{$pre}members fm ON f.friend_id = fm.id")->where($map)->limit($Lsql)->select();
    foreach ($list as $key => $v) {
        if ($map['f.apply_status'] == 0) {
            $list[$key]['user_name'] = $v['user_name'];
            $list[$key]['credits']   = $v['credits'];
        } else {
            $list[$key]['user_name'] = $v['funame'];
            $list[$key]['credits']   = $v['fcredits'];
        }
    }

    $row         = array();
    $row['list'] = $list;
    $row['page'] = $page;
    return $row;
}
function getArticleList($parm)
{
    if (empty($parm['type_id'])) {
        return;
    }

    $map['type_id'] = $parm['type_id'];
    $Osql           = "id DESC";
    $field          = "id,title,art_set,art_info,art_img,art_time,art_url,art_content,type_id";
    //查询条件
    $row = array();
    if ($parm['pagesize']) {
        //分页处理
        import("ORG.Util.Page");
        $count        = M('article')->where($map)->count('id');
        $p            = new Page($count, $parm['pagesize']);
        $row['_page'] = $p;
        $page         = $p->show();
        $Lsql         = "{$p->firstRow},{$p->listRows}";
        //分页处理
    } else {
        $page = "";
        $Lsql = "{$parm['limit']}";
    }
    $data    = M('article')->field($field)->where($map)->order($Osql)->limit($Lsql)->select();
    $suffix  = C("URL_HTML_SUFFIX");
    $typefix = get_type_leve_nid($map['type_id']);
    $typeu   = implode("/", $typefix);
    foreach ($data as $key => $v) {
        if ($v['art_set'] == 1) {
            $data[$key]['arturl'] = (stripos($v['art_url'], "http://") === false) ? "http://" . $v['art_url'] : $v['art_url'];
        }

        //elseif(count($typefix)==1) $data[$key]['arturl'] =
        else {
            $data[$key]['arturl'] = MU("Home/{$typeu}", "article", array("id" => $v['id'], "suffix" => $suffix));
        }

        if ($v["art_img"] == "") {
            $data[$key]["art_img"] = "/UF/Uploads/Article/nopic.png";
        }

        if ($v["art_info"] == "") {
            $data[$key]["art_info"] = strip_tags($v['art_content']);
        }

    }
    $row['list'] = $data;
    $row['page'] = $page;

    return $row;
}
//获取商品,包括分页数据
function getMsgList($parm = array())
{
    $M       = new Model('member_msg');
    $pre     = C('DB_PREFIX');
    $field   = true;
    $orderby = " id DESC";

    if ($parm['pagesize']) {
        //分页处理
        import("ORG.Util.Page");
        $count = $M->where($parm['map'])->count('id');
        $p     = new Page($count, $parm['pagesize']);
        $page  = $p->show();
        $Lsql  = "{$p->firstRow},{$p->listRows}";
        //分页处理
    } else {
        $page = "";
        $Lsql = "{$parm['limit']}";
    }

    $data = M('member_msg')->field(true)->where($parm['map'])->order($orderby)->limit($Lsql)->select();

    $symbol = C('MONEY_SYMBOL');
    $suffix = C("URL_HTML_SUFFIX");
    foreach ($data as $key => $v) {}

    $row          = array();
    $row['list']  = $data;
    $row['page']  = $page;
    $row['count'] = $count;
    return $row;

}

function getWithDrawLog($map, $size, $limit = 10)
{
    if (empty($map['uid'])) {
        return;
    }

    if ($size) {
        //分页处理
        import("ORG.Util.Page");
        $count = M('member_withdraw')->where($map)->count('id');
        $p     = new Page($count, $size);
        $page  = $p->show();
        $Lsql  = "{$p->firstRow},{$p->listRows}";
        //分页处理
    } else {
        $page = "";
        $Lsql = "{$parm['limit']}";
    }

    $status_arr = array('待审核', '审核通过,处理中', '已提现', '审核未通过');
    $list       = M('member_withdraw')->where($map)->order('id DESC')->limit($Lsql)->select();
    foreach ($list as $key => $v) {
        $list[$key]['status_cn'] = $status_arr[$v['withdraw_status']];
    }

    $row                  = array();
    $row['list']          = $list;
    $row['page']          = $page;
    $map['status']        = 1;
    $row['success_money'] = M('member_payonline')->where($map)->sum('money');
    $map['status']        = array('neq', '1');
    $row['fail_money']    = M('member_payonline')->where($map)->sum('money');
    return $row;
}

function getChargeLog($map, $size, $limit = 10, $field = true)
{
    if (empty($map['uid'])) {
        return;
    }

    $row = array();

    if ($size) {
        //分页处理
        import("ORG.Util.Page");
        $count        = M('member_payonline')->where($map)->count('id');
        $p            = new Page($count, $size);
        $row['_page'] = $p;
        $page         = $p->show();
        $Lsql         = "{$p->firstRow},{$p->listRows}";
        //分页处理
    } else {
        $page = "";
        $Lsql = "{$parm['limit']}";
    }

    $status_arr = array('充值未完成', '充值成功', '签名不符', '充值失败');
    $list       = M('member_payonline')->field($field)->where($map)->order('id DESC')->limit($Lsql)->select();
    foreach ($list as $key => $v) {
        $list[$key]['status'] = $status_arr[$v['status']];
    }

    $row['list']          = $list;
    $row['page']          = $page;
    $map['status']        = 1;
    $row['success_money'] = M('member_payonline')->where($map)->sum('money');
    $map['status']        = array('neq', '1');
    $row['fail_money']    = M('member_payonline')->where($map)->sum('money');
    return $row;
}
//借款逾期但还未还的借款列表(逾期)
function getMBreakRepaymentList($uid = 0, $size = 10, $Wsql = "")
{
    if (empty($uid)) {
        return;
    }

    $pre = C('DB_PREFIX');

    if ($size) {
        //分页处理
        import("ORG.Util.Page");
        $count = M()->query("select d.id as count from {$pre}investor_detail d where d.borrow_id in(select tb.id from {$pre}borrow_info tb where tb.borrow_uid={$uid}) AND tb.borrow_status in(6,9) AND d.deadline<" . time() . " AND d.repayment_time=0 {$Wsql} group by d.sort_order,d.borrow_id");
        $count = count($count);
        $p     = new Page($count, $size);
        $page  = $p->show();
        $Lsql  = "{$p->firstRow},{$p->listRows}";
        //分页处理
    } else {
        $page = "";
        $Lsql = "{$parm['limit']}";
    }

    $field = "b.borrow_name,d.status,d.total,d.borrow_id,d.sort_order,sum(d.capital) as capital,sum(d.interest) as interest,d.deadline";
    $sql   = "select {$field} from {$pre}investor_detail d left join {$pre}borrow_info b ON b.id=d.borrow_id where d.borrow_uid ={$uid} AND b.borrow_status in(6,9) AND d.deadline<" . time() . " AND d.repayment_time=0 {$Wsql} group by d.sort_order,d.borrow_id order by  d.borrow_id,d.sort_order limit {$Lsql}";

    $list       = M()->query($sql);
    $status_arr = array('还未还', '已还完', '已提前还款', '逾期还款', '网站代还本金');
    $glodata    = get_global_setting();
    $expired    = explode("|", $glodata['fee_expired']);
    $call_fee   = explode("|", $glodata['fee_call']);
    foreach ($list as $key => $v) {
        $list[$key]['status']   = $status_arr[$v['status']];
        $list[$key]['breakday'] = getExpiredDays($v['deadline']);

        if ($list[$key]['breakday'] > $expired[0]) {
            $list[$key]['expired_money'] = getExpiredMoney($list[$key]['breakday'], $v['capital'], $v['interest']);
        }

        if ($list[$key]['breakday'] > $call_fee[0]) {
            $list[$key]['call_fee'] = getExpiredCallFee($list[$key]['breakday'], $v['capital'], $v['interest']);
        }

        $list[$key]['allneed'] = $list[$key]['call_fee'] + $list[$key]['expired_money'] + $v['capital'] + $v['interest'];
    }
    $row          = array();
    $row['list']  = $list;
    $row['page']  = $page;
    $row['count'] = $count;
    return $row;
}

//集合起每笔借款的每期的还款状态(逾期)
function getMBreakInvestList($map, $size = 10)
{
    $pre = C('DB_PREFIX');

    if ($size) {
        //分页处理
        import("ORG.Util.Page");
        $count = M('investor_detail d')->where($map)->count('d.id');
        $p     = new Page($count, $size);
        $page  = $p->show();
        $Lsql  = "{$p->firstRow},{$p->listRows}";
        //分页处理
    } else {
        $page = "";
        $Lsql = "{$parm['limit']}";
    }

    $field = "m.user_name as borrow_user,b.borrow_interest_rate,d.borrow_id,b.borrow_name,d.status,d.total,d.borrow_id,d.sort_order,d.interest,d.capital,d.deadline,d.sort_order";
    $list  = M('investor_detail d')->field($field)->join("{$pre}borrow_info b ON b.id=d.borrow_id")->join("{$pre}members m ON m.id=b.borrow_uid")->where($map)->limit($Lsql)->select();

    $status_arr = array('还未还', '已还完', '已提前还款', '逾期还款', '网站代还本金');
    $glodata    = get_global_setting();
    $expired    = explode("|", $glodata['fee_expired']);
    $call_fee   = explode("|", $glodata['fee_call']);
    foreach ($list as $key => $v) {
        $list[$key]['status']   = $status_arr[$v['status']];
        $list[$key]['breakday'] = getExpiredDays($v['deadline']);
    }
    $row          = array();
    $row['list']  = $list;
    $row['page']  = $page;
    $row['count'] = $count;
    return $row;
}
//获取借款列表
function getTBorrowList($parm = array())
{
    if (empty($parm['map'])) {
        return array();
    }

    $map     = $parm['map'];
    $orderby = $parm['orderby'];
    $model   = M('transfer_borrow_info b');
    if ($parm['pagesize']) {
        $count = $model->where($map)->count('b.id');
        import("ORG.Util.Page");
        $_page = new Page($count, $parm['pagesize']);
        $page  = $_page->show();
        $Lsql  = "{$_page->firstRow},{$_page->listRows}";
    } else {
        $page = "";
        $Lsql = $parm['limit'];
    }

    $field = "b.id,b.borrow_name,b.borrow_uid,b.borrow_type,b.borrow_status,b.borrow_money,b.borrow_min,b.borrow_max,b.repayment_type,b.borrow_interest_rate,b.borrow_duration,b.add_time,m.user_name,m.id as uid,m.credits,m.customer_name";
    $list  = $model->field($field)
        ->join("__MEMBERS__ m ON m.id=b.borrow_uid")
        ->where($map)
        ->order($orderby)
        ->limit($Lsql)
        ->select();

    $areaList = getArea();
    $suffix   = C("URL_HTML_SUFFIX");
    $bConfig  = C('BORROW');
    foreach ($list as $key => $val) {
        $list[$key] = filterBorrowinfo($val, $bConfig, $areaList, $suffix);
    }

    $row = array();
    return array('list' => $list, 'page' => $page, '_page' => $_page);
}
//获取借款列表
function getBorrowList($parm = array())
{
    if (empty($parm['map'])) {
        return array();
    }

    $map     = $parm['map'];
    $orderby = $parm['orderby'];
    $model   = M('borrow_info b');
    if ($parm['pagesize']) {
        $count = $model->join("__MEMBERS__ m ON m.id=b.borrow_uid")->where($map)->count('b.id');
        import("ORG.Util.Page");
        $_page = new Page($count, $parm['pagesize']);
        $page  = $_page->show();
        $Lsql  = "{$_page->firstRow},{$_page->listRows}";
    } else {
        $page = "";
        $Lsql = $parm['limit'];
    }

    $field = "b.id,b.borrow_name,b.borrow_uid,b.borrow_type,b.borrow_times,b.borrow_status,b.borrow_money,b.borrow_min,b.borrow_max,b.borrow_use,b.repayment_type,b.borrow_interest_rate,b.borrow_duration,b.collect_time,b.add_time,b.province,b.has_borrow,b.has_vouch,b.city,b.area,b.reward_type,b.reward_num,b.password,m.user_name,m.id as uid,m.credits,m.customer_name,m.is_transfer";
    $list  = $model->field($field)
        ->join("__MEMBERS__ m ON m.id=b.borrow_uid")
        ->where($map)
        ->order($orderby)
        ->limit($Lsql)
        ->select();
    $areaList = getArea();
    $suffix   = C("URL_HTML_SUFFIX");
    $bConfig  = C('BORROW');
    foreach ($list as $key => $val) {
        $list[$key] = filterBorrowinfo($val, $bConfig, $areaList, $suffix);
    }

    $row = array();
    return array('list' => $list, 'page' => $page, '_page' => $_page);
}

function filterBorrowinfo($borrowinfo, $bConfig = '', $areaList = '', $suffix = '')
{
    $areaList or $areaList = getArea();
    $suffix or $suffix     = C("URL_HTML_SUFFIX");
    $bConfig or $bConfig   = require C("APP_ROOT") . "Conf/borrow_config.php";

    $bconf = get_bconf_setting();

    $borrowinfo['location']           = $areaList[$borrowinfo['province']] . $areaList[$borrowinfo['city']];
    $borrowinfo['borrow_img']         = str_replace("'", "", $borrowinfo["borrow_img"]);
    $borrowinfo['borrow_img']         = $borrowinfo == "" ? "UF/Uploads/borrowimg/nopic.png" : $borrowinfo['borrow_img'];
    $borrowinfo['repayment_type_cn']  = @$bConfig['REPAYMENT_TYPE'][$borrowinfo["repayment_type"]];
    $borrowinfo['borrow_use_cn']      = @$bconf['BORROW_USE'][$borrowinfo["borrow_use"]];
    $borrowinfo['borrow_duration_cn'] = $borrowinfo['repayment_type'] == 1 ? '天' : '个月';
    $borrowinfo['borrow_status_cn']   = @$bConfig['BORROW_STATUS_CN'][$borrowinfo["borrow_status"]];
    $borrowinfo['need']               = bcsub($borrowinfo['borrow_money'], $borrowinfo['has_borrow'], 2);
    $borrowinfo['leftdays']           = $borrowinfo["borrow_status"] > 2 ? "已经结束" : getLeftTime($borrowinfo['collect_time'], 2);
    $borrowinfo['lefttime']           = strval($borrowinfo['collect_time'] - time()) < 0 ? '0' : strval($borrowinfo['collect_time'] - time());
    $borrowinfo['lefttime'] = $borrowinfo["borrow_status"] > 2 ? '0' : $borrowinfo['lefttime'];

    $borrowinfo['progress']           = getFloatValue($borrowinfo['has_borrow'] / $borrowinfo['borrow_money'] * 100, 0);

    isset($borrowinfo['borrow_info']) and $borrowinfo['borrow_info']    = htmlspecialchars_decode($borrowinfo['borrow_info']);
    isset($borrowinfo['borrow_risk']) and $borrowinfo['borrow_risk']    = htmlspecialchars_decode($borrowinfo['borrow_risk']);
    isset($borrowinfo['has_vouch']) and $borrowinfo['vouch_need']       = bcsub($borrowinfo['borrow_money'], $borrowinfo['has_vouch']);
    isset($borrowinfo['has_vouch']) and $borrowinfo['vouch_progress']   = getFloatValue($borrowinfo['has_vouch'] / $borrowinfo['borrow_money'] * 100, 2);
    isset($borrowinfo['reward_type']) and $borrowinfo['reward_type_cn'] = $borrowinfo['reward_type'] == 1 ? "按投资比例奖励{$borrowinfo['reward_num']}%" : ($borrowinfo['reward_type'] == 2 ? "按固定金额分摊奖励{$borrowinfo['reward_num']}元" : "无");
    $borrow_interest_rate_arr                                           = explode('.', $borrowinfo['borrow_interest_rate'], 2);
    $borrowinfo['borrow_interest_rate_1']                               = isset($borrow_interest_rate_arr[0]) ? $borrow_interest_rate_arr[0] : '0';
    $borrowinfo['borrow_interest_rate_2']                               = isset($borrow_interest_rate_arr[1]) ? $borrow_interest_rate_arr[1] : '00';

    $borrowinfo['linkurl'] = MU("Home/invest", "invest", array("id" => $borrowinfo['id'], "suffix" => $suffix));

    if (@$borrowinfo['danbao'] != 0) {
        $danbao               = M('article')->field("id,title")->where("type_id =7 and id ={$borrowinfo['danbao']}")->find();
        $borrowinfo['danbao'] = $danbao['title']; //担保机构
    } else {
        $borrowinfo['danbao'] = '暂无担保机构'; //担保机构
    }

    return $borrowinfo;
}
function getIcoAttr($map)
{
    $str        = "";
    $rsAttr     = array();
    $borrowWord = array(
        '1'  => '信',
        '2'  => '机构担',
        '3'  => '秒',
        '4'  => '净',
        '5'  => '抵',
        '6'  => '企',
        '10' => '天',
        '11' => '锁',
        '12' => '荐',
        '13' => '奖',
        '14' => '个',
    );
    if ($map['is_transfer'] == 1 || $map['borrow_type'] == 6) {
        $rsAttr[] = array('id' => '6', 'name' => $borrowWord[6]);
    } else {
        $rsAttr[] = array('id' => '14', 'name' => $borrowWord[14]);
    }
    if (in_array($map['borrow_type'], array(1, 2, 3, 4, 5))) {
        $rsAttr[] = array('id' => $map['borrow_type'], 'name' => $borrowWord[$map['borrow_type']]);
    }
    if ($map['repayment_type'] == 1) {
        $rsAttr[] = array('id' => '10', 'name' => $borrowWord[10]);
    }
    if (!empty($map['password'])) {
        $rsAttr[] = array('id' => '11', 'name' => $borrowWord[11]);
    }
    if ($map['is_tuijian'] == 1) {
        $rsAttr[] = array('id' => '12', 'name' => $borrowWord[12]);
    }
    if ($map['reward_type'] > 0 && ($map['reward_num'] > 0 || $map['reward_money'] > 0)) {
        $rsAttr[] = array('id' => '13', 'name' => $borrowWord[13]);
    }

    return $rsAttr;
}
function getLeveName($num, $type = 1)
{
    $leveconfig = FS("Webconfig/leveconfig");
    foreach ($leveconfig as $key => $v) {
        if ($num >= $v['start'] && $num <= $v['end']) {
        	return $v['name'];
        }
    }
    return '';
}
function getTenderList($map, $size, $limit = 10)
{
    $pre     = C('DB_PREFIX');
    $Bconfig = require C("APP_ROOT") . "Conf/borrow_config.php";
    //if(empty($map['i.investor_uid'])) return;
    if (empty($map['investor_uid'])) {
        return;
    }

    if ($size) {
        //分页处理
        import("ORG.Util.Page");
        $count = M('borrow_investor i')->where($map)->count('i.id');
        $p     = new Page($count, $size);
        $page  = $p->show();
        $Lsql  = "{$p->firstRow},{$p->listRows}";
        //分页处理
    } else {
        $page = "";
        $Lsql = "{$parm['limit']}";
    }

    $type_arr = $Bconfig['BORROW_TYPE'];
    /////////////////////////视图查询 fan 20130522//////////////////////////////////////////
    $Model = D("TenderListView");
    $list  = $Model->field(true)->where($map)->order('times ASC')->group('id')->limit($Lsql)->select();
    ////////////////////////视图查询 fan 20130522//////////////////////////////////////////
    foreach ($list as $key => $v) {
        //if($map['i.status']==4){
        if ($map['status'] == 4) {
            $list[$key]['total']          = ($v['borrow_type'] == 3) ? "1" : $v['borrow_duration'];
            $list[$key]['back']           = $v['has_pay'];
            $vx                           = M('investor_detail')->field('deadline')->where("borrow_id={$v['borrowid']} and status=7")->order("deadline ASC")->find();
            $list[$key]['repayment_time'] = $vx['deadline'];
        }
    }

    $row                = array();
    $row['list']        = $list;
    $row['page']        = $page;
    $row['total_money'] = M('borrow_investor i')->where($map)->sum('investor_capital');
    $row['total_num']   = $count;
    return $row;
}

function getBackingList($map, $size, $limit = 10)
{
    $pre = C('DB_PREFIX');
    if (empty($map['d.investor_uid'])) {
        return;
    }

    if ($size) {
        //分页处理
        import("ORG.Util.Page");
        $count = M('investor_detail d')->where($map)->count('d.id');
        $p     = new Page($count, $size);
        $page  = $p->show();
        $Lsql  = "{$p->firstRow},{$p->listRows}";
        //分页处理
    } else {
        $page = "";
        $Lsql = "{$parm['limit']}";
    }

    $type_arr = C('BORROW_TYPE');
    $field    = true;
    $list     = M('investor_detail d')->field($field)->where($map)->order('d.id DESC')->limit($Lsql)->select();
    foreach ($list as $key => $v) {
        //$list[$key]['status'] = $status_arr[$v['status']];
    }

    $row                = array();
    $row['list']        = $list;
    $row['page']        = $page;
    $sx                 = M('investor_detail d')->field("sum(d.capital + d.interest) as tox")->where("d.status=1 AND d.investor_uid={$map['d.investor_uid']}")->find();
    $sxcount            = M('borrow_investor')->where("status=4 AND investor_uid={$map['d.investor_uid']}")->count("id");
    $month              = M('investor_detail d')->field("sum(d.capital + d.interest) as tox")->where($map)->find();
    $row['month_total'] = $month['tox'];
    $row['total_money'] = $sx['tox'];
    $row['total_num']   = $sxcount;
    return $row;
}

//在线客服
function get_qq($type)
{
    $list = M('qq')->where("type = $type and is_show = 1")->order("qq_order DESC")->select();
    return $list;
}

//获取借款列表
function getMemberDetail($uid)
{
    $pre         = C('DB_PREFIX');
    $map['m.id'] = $uid;
    //$field = "*";
    $list = M('members m')->field(true)->join("{$pre}member_banks mbank ON m.id=mbank.uid")->join("{$pre}member_contact_info mci ON m.id=mci.uid")->join("{$pre}member_house_info mhi ON m.id=mhi.uid")->join("{$pre}member_department_info mdpi ON m.id=mdpi.uid")->join("{$pre}member_ensure_info mei ON m.id=mei.uid")->join("{$pre}member_info mi ON m.id=mi.uid")->join("{$pre}member_financial_info mfi ON m.id=mfi.uid")->where($map)->limit($Lsql)->find();
    return $list;
}
//////////////////////////////企业直投 管理模块开始  /////////////////////////////
function getTTenderList($map, $size, $limit = 10)
{
    $pre     = C("DB_PREFIX");
    $Bconfig = require C("APP_ROOT") . "Conf/borrow_config.php";
    if (empty($map['i.investor_uid'])) {
        return;
    }
    if ($size) {
        import("ORG.Util.Page");
        $count = M("transfer_borrow_investor i")->where($map)->count("i.id");
        $p     = new Page($count, $size);
        $page  = $p->show();
        $Lsql  = "{$p->firstRow},{$p->listRows}";
    } else {
        $page = "";
        $Lsql = "{$parm['limit']}";
    }
    $type_arr = $Bconfig['BORROW_TYPE'];
    $field    = "i.*,i.add_time as invest_time,m.user_name as borrow_user,b.borrow_duration,b.borrow_interest_rate,b.add_time as borrow_time,b. repayment_type,b.borrow_money,b.borrow_name,m.credits";
    $list     = M("transfer_borrow_investor i")->field($field)->where($map)->join("{$pre}transfer_borrow_info b ON b.id=i.borrow_id")->join("{$pre}members m ON m.id=b.borrow_uid")->order("i.id DESC")->limit($Lsql)->select();
    foreach ($list as $key => $v) {
        if ($map['i.status'] == 4) {
            $list[$key]['total'] = $v['borrow_type'] == 3 ? "1" : $v['borrow_duration'];
            $list[$key]['back']  = $v['has_pay'];
        }
    }
    $row                = array();
    $row['list']        = $list;
    $row['page']        = $page;
    $row['total_money'] = M("transfer_borrow_investor i")->where($map)->sum("investor_capital");
    $row['total_num']   = $count;
    return $row;
}

function getTDTenderList($map, $size, $limit = 10)
{
    $pre     = C("DB_PREFIX");
    $Bconfig = require C("APP_ROOT") . "Conf/borrow_config.php";
    if (empty($map['d.investor_uid'])) {
        return;
    }
    if ($size) {
        import("ORG.Util.Page");
        $count = M("transfer_investor_detail d")->where($map)->count("d.id");
        $p     = new Page($count, $size);
        $page  = $p->show();
        $Lsql  = "{$p->firstRow},{$p->listRows}";
    } else {
        $page = "";
        $Lsql = "{$parm['limit']}";
    }
    $type_arr = $Bconfig['BORROW_TYPE'];
    $field    = "d.*,m.user_name as borrow_user,b.borrow_name,m.credits,i.add_time";
    $list     = M("transfer_investor_detail d")->field($field)->where($map)->join("{$pre}transfer_borrow_info b ON b.id=d.borrow_id")->join("{$pre}transfer_borrow_investor i ON i.id=d.invest_id")->join("{$pre}members m ON m.id=b.borrow_uid")->order("d.deadline ASC")->limit($Lsql)->select();
    foreach ($list as $key => $v) {
    }
    $row                = array();
    $row['list']        = $list;
    $row['page']        = $page;
    $row['total_money'] = M("transfer_investor_detail d")->where($map)->sum("`capital`+`interest`-`interest_fee`");
    $row['total_num']   = $count;
    return $row;
}
function getBorrowListUser($map,$size,$limit=10){
    if(empty($map['borrow_uid'])) return;
    
    if($size){
        //分页处理
        import("ORG.Util.Page");
        $count = M('borrow_info')->where($map)->count('id');
        $p = new Page($count, $size);
        $page = $p->show();
        $Lsql = "{$p->firstRow},{$p->listRows}";
        //分页处理
    }else{
        $page="";
        $Lsql="{$parm['limit']}";
    }
    
    $Bconfig = require C("APP_ROOT")."Conf/borrow_config.php";
    $status_arr =$Bconfig['BORROW_STATUS_SHOW'];
    $type_arr =$Bconfig['REPAYMENT_TYPE'];
    //$list = M('borrow_info')->where($map)->order('id DESC')->limit($Lsql)->select();
    /////////////使用了视图查询操作 fans 2013-05-22/////////////////////////////////
    $Model = D("BorrowView");
    $list=$Model->field(true)->where($map)->order('times ASC')->group('id')->limit($Lsql)->select();

    /////////////使用了视图查询操作 fans 2013-05-22/////////////////////////////////
    foreach($list as $key=>$v){
        $list[$key]['status'] = $status_arr[$v['borrow_status']];
        $list[$key]['repayment_type_num'] = $v['repayment_type'];
        // $list[$key]['repayment_type'] = $type_arr[$v['repayment_type']];
        $list[$key]['progress'] = getFloatValue($v['has_borrow']/$v['borrow_money']*100,2);
        if($map['borrow_status']==6){
            $vx = M('investor_detail')->field('deadline')->where("borrow_id={$v['id']} and status=7")->order("deadline ASC")->find();
            $list[$key]['repayment_time'] = $vx['deadline'];
        }
        if($map['borrow_status']==5 || $map['borrow_status']==1){
            $vd = M('borrow_verify')->field(true)->where("borrow_id={$v['id']}")->find();
            $list[$key]['dealinfo'] = $vd;
        }
    }
    
    $row=array();
    $row['list'] = $list;
    $row['page'] = $page;
    //$map['status'] = 1;
    //$row['success_money'] = M('member_payonline')->where($map)->sum('money');
    //$map['status'] = array('neq','1');
    //$row['fail_money'] = M('member_payonline')->where($map)->sum('money');
    return $row;
}

     function idcard_verify_number($idcard_base){
        if (strlen($idcard_base) != 17){ return false; }
        // 加权因子
        $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);

        // 校验码对应值
        $verify_number_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');

        $checksum = 0;
        for ($i = 0; $i < strlen($idcard_base); $i++){
            $checksum += substr($idcard_base, $i, 1) * $factor[$i];
        }

        $mod = strtoupper($checksum % 11);
        $verify_number = $verify_number_list[$mod];

        return $verify_number;
    }



    // 将15位身份证升级到18位
    function idcard_15to18($idcard){
        if (strlen($idcard) != 15){
            return false;
        }else{
            // 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码
            if (array_search(substr($idcard, 12, 3), array('996', '997', '998', '999')) !== false){
                $idcard = substr($idcard, 0, 6) . '18'. substr($idcard, 6, 9);
            }else{
                $idcard = substr($idcard, 0, 6) . '19'. substr($idcard, 6, 9);
            }
        }

        $idcard = $idcard . idcard_verify_number($idcard);

        return $idcard;
    }

    //18位身份证校验码有效性检查
    function idcard_checksum18($idcard){
        if(strlen($idcard) == 15) $idcard = idcard_15to18($idcard);
        if (strlen($idcard) != 18){ return false; }
        $aCity = array(11 => "北京",12=>"天津",13=>"河北",14=>"山西",15=>"内蒙古",
        21=>"辽宁",22=>"吉林",23=>"黑龙江",
        31=>"上海",32=>"江苏",33=>"浙江",34=>"安徽",35=>"福建",36=>"江西",37=>"山东",
        41=>"河南",42=>"湖北",43=>"湖南",44=>"广东",45=>"广西",46=>"海南",
        50=>"重庆",51=>"四川",52=>"贵州",53=>"云南",54=>"西藏",
        61=>"陕西",62=>"甘肃",63=>"青海",64=>"宁夏",65=>"新疆",
        71=>"台湾",81=>"香港",82=>"澳门",
        91=>"国外");
        //非法地区
        if (!array_key_exists(substr($idcard,0,2),$aCity)) {
            return false;
        }
        //验证生日
        if (!checkdate(substr($idcard,10,2),substr($idcard,12,2),substr($idcard,6,4))) {
            return false;
        }
        $idcard_base = substr($idcard, 0, 17);
        if (idcard_verify_number($idcard_base) != strtoupper(substr($idcard, 17, 1))){
            return false;
        }else{
            return true;
        }
    }
