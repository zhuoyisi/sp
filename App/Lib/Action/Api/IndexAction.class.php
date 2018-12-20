<?php
class IndexAction extends BaseAction
{

    public function index()
    {
        foreach (get_ad(11) as $key => $val) {
            $ad[$key]["img"]   = $this->domainUrl . '/' . $val["img"];
            $ad[$key]["url"]   = strstr($val['url'], 'http') ? $val['url'] : $this->domainUrl . '' . $val["url"];
            $ad[$key]["title"] = empty($val['info']) ? '' : $val['info'];
        }
        $jsons['receive_capital'] = M('borrow_investor')->SUM('investor_capital') + M('transfer_borrow_investor')->SUM('investor_capital');
        $jsons['receive_capital'] = trim(Fmoney($jsons['receive_capital'] + 416820000, 2), '￥');
        $jsons['members']         = M('members')->count() + 3000;
        $jsons["banner"]          = is_array($ad) ? $ad : array();

        $parm['type_id'] = 9;
        $parm['limit']   = 3;
        $notice          = getArticleList($parm);
        $noticeArr       = array();
        foreach ($notice['list'] as $key => $value) {
            $noticeArr[] = array(
                'id'      => $value['id'],
                'title'   => $value['title'],
                'type_id' => $value['type_id'],
            );
        }
        $jsons['notice'] = $noticeArr;
        $jsons['status'] = "1";        
        outJson($jsons);
    }
    public function invest_filter()
    {
        // $jsons['borrow_type'] = array(
        //     array('id' => '0', 'name' => '不限'),
        //     array('id' => '1', 'name' => '信用标'),
        //     array('id' => '3', 'name' => '秒标'),
        //     array('id' => '4', 'name' => '净值标'),
        //     array('id' => '5', 'name' => '抵押标'),
        // );
        $jsons['is_transfer'] = array(
            array('id' => '0', 'name' => '个人用户'),
            array('id' => '1', 'name' => '企业用户'),
        );
        $jsons['borrow_status'] = array(
            array('id' => '0', 'name' => '不限制'),
            array('id' => '2', 'name' => '进行中'),
            array('id' => '4', 'name' => '复审中'),
            array('id' => '6', 'name' => '还款中'),
            array('id' => '7', 'name' => '已完成'),
        );
        $leveconfig    = FS("Webconfig/leveconfig");
        $jsons['leve'] = arrayToArray(array(
            "all"                                                   => "不限制",
            "{$leveconfig['1']['start']}-{$leveconfig['1']['end']}" =>
            "{$leveconfig['1']['name']}", "{$leveconfig['2']['start']}-{$leveconfig['2']['end']}" => "{$leveconfig['2']['name']}",
            "{$leveconfig['3']['start']}-{$leveconfig['3']['end']}" => "{$leveconfig['3']['name']}",
            "{$leveconfig['4']['start']}-{$leveconfig['4']['end']}" => "{$leveconfig['4']['name']}",
            "{$leveconfig['5']['start']}-{$leveconfig['5']['end']}" => "{$leveconfig['5']['name']}",
            "{$leveconfig['6']['start']}-{$leveconfig['6']['end']}" => "{$leveconfig['6']['name']}",
            // "{$leveconfig['7']['start']}-{$leveconfig['7']['end']}" => "{$leveconfig['7']['name']}",
        )
        );
        $jsons['borrow_duration'] = arrayToArray(array("all" => "不限制", "0-3" => "3个月以内", "3-6" => "3-6个月", "6-12" => "6-12个月", "12-24" => "12-24个月"));
        $jsons['status']          = '1';
        outJson($jsons);
    }
    private function investFilterSearch($searchArr = array())
    {
        $curl   = $_SERVER['REQUEST_URI'];
        $urlarr = parse_url($curl);
        parse_str($urlarr['query'], $surl); //array获取当前链接参数，2.
        $urlArr     = array('borrow_status', 'borrow_duration', 'leve');
        $leveconfig = FS("Webconfig/leveconfig");
        $search     = array();
        //搜索条件
        foreach ($urlArr as $v) {
            if ($_GET[$v] && $_GET[$v] != 'all') {
                switch ($v) {
                    case 'leve':
                        $barr                = explode("-", text($_GET[$v]));
                        $search["m.credits"] = array("between", $barr);
                        break;
                    case 'borrow_status':
                        $search["b." . $v] = intval($_GET[$v]);
                        break;
                    default:
                        $barr              = explode("-", text($_GET[$v]));
                        $search["b." . $v] = array("between", $barr);
                        break;
                }
            }
        }

        if ($search['b.borrow_status'] == 0) {
            $search['b.borrow_status'] = array("in", "2,4,6,7");
            $search['b.borrow_type']   = array("in", "1,2,3,4,5");
        }
        $str = "%" . urldecode($_REQUEST['searchkeywords']) . "%";
        if (!empty($_REQUEST['searchkeywords'])) {
            $search['b.borrow_name'] = array("like", $str);
        }
        // if($_GET['is_keyword']=='1'){
        //     $search['m.user_name']=array("like",$str);
        // }elseif($_GET['is_keyword']=='2'){
        //     $search['b.borrow_name']=array("like",$str);

        // }
        return $search;

    }
    public function invest()
    {
        $p                                                              = intval($_REQUEST['p']) ? intval($_REQUEST['p']) : "1";
        $searchMap                                                      = array();
        $searchMap['b.borrow_status']                                   = array("in", '2,4,6,7');
        @$_REQUEST['is_transfer'] != '' and $searchMap['m.is_transfer'] = intval($_REQUEST['is_transfer']);
        $searchMap                                                      = array_merge($searchMap, $this->investFilterSearch());
        $parm                                                           = array();
        $parm['map']                                                    = $searchMap;
        $parm['pagesize']                                               = 10;
        $parm['orderby']                                                = "b.borrow_status ASC,b.id DESC";
        $parm['map']                                                    = $searchMap;
        $listBorrow                                                     = getBorrowList($parm);
        $list                                                           = $listBorrow['list'];
        $borrow_status_show                                             = array('待审核', '初审未通过', '投资', '已流标', '复审中', '复审未通过', '还款中', '已完成', '已逾期', '网站代还', '逾期还款');
        foreach ($list as $key => $value) {
            $value['borrow_money']     = getMoneyFormt($value['borrow_money']);
            $value['borrow_attr']      = getIcoAttr($value);
            $value['borrow_status_cn'] = @$borrow_status_show[$value["borrow_status"]];
            $list[$key]                = arrayFilterValByKey($value, array('id', 'borrow_name', 'borrow_money', 'borrow_times', 'borrow_interest_rate', 'borrow_duration', 'borrow_duration_cn', 'progress', 'borrow_attr', 'borrow_status_cn', 'borrow_status'));
        }
        $pageSet['nowPage']    = strval($p);
        $pageSet['totalPages'] = strval(intval($listBorrow['_page']->totalPages));
        $pageSet['totalRows']  = strval($listBorrow['_page']->totalRows);
        $pageSet['pageSize']   = strval($parm['pagesize']);
        $jsons['list']         = (array) $list;
        $jsons['page']         = $pageSet;
        $jsons["status"]       = "1";
        outJson($jsons);
    }
    public function invest_detail()
    {
        $id              = intval($_REQUEST['id']) ? intval($_REQUEST['id']) : "0";
        $jsons["status"] = "0";
        $borrowinfo      = M('borrow_info')->field('id,borrow_info,borrow_name,borrow_money,borrow_interest_rate,borrow_duration,repayment_type,has_borrow,reward_type,reward_num,borrow_uid,collect_time,borrow_status,borrow_use,add_time,borrow_type,danbao,password')->where('borrow_status in(2,4,6,7)')->find($id);
        if (is_array($borrowinfo)) {
            $borrowinfo                 = filterBorrowinfo($borrowinfo);
            $borrowinfo['borrow_money'] = getMoneyFormt($borrowinfo['borrow_money']);
            $borrowinfo['add_time']     = date('Y-m-d H:i:s', $borrowinfo['add_time']);
            $memberinfo                 = M("members")->where('id=' . $borrowinfo['borrow_uid'])->field('user_name,is_transfer')->find();
            $borrowinfo                 = array_merge($borrowinfo, $memberinfo);
            $borrowinfo['borrow_attr']  = getIcoAttr($borrowinfo);
            $borrowinfo                 = arrayFilterValByKey($borrowinfo, array('borrow_info', 'borrow_risk', 'borrow_img', 'location', 'linkurl', 'reward_type', 'reward_num', 'collect_time', 'leftdays', 'need', 'borrow_uid', 'borrow_max', 'borrow_min', 'repayment_type', 'has_borrow', 'borrow_interest_rate_1', 'borrow_interest_rate_2'), false);
            $jsons['borrowinfo']        = $borrowinfo;
            $jsons["status"]            = "1";
            outJson($jsons);
        } else {
            $jsons["tips"] = "项目不存在！";
        }
        outJson($jsons);
    }

    public function invest_detail_user()
    {
        $id = intval($_REQUEST['id']) ? intval($_REQUEST['id']) : die;
        // if(empty($this->uid)){
        //     $jsons["tips"] = "请先登录！";
        //     outJson($jsons);
        // }
        $pre = C('DB_PREFIX');

        $borrowinfo = M('borrow_info')->field('borrow_uid,borrow_info')->find($id);
        if (!is_array($borrowinfo)) {
            $jsons["tips"] = "项目不存在！";
            outJson($jsons);
        }
        $memberinfo                 = M("members m")->field("m.id,m.customer_name,m.customer_id,m.user_name,m.reg_time,m.is_transfer,m.credits,fi.*,mi.*,mm.*")->join("{$pre}member_financial_info fi ON fi.uid = m.id")->join("{$pre}member_info mi ON mi.uid = m.id")->join("{$pre}member_money mm ON mm.uid = m.id")->where("m.id={$borrowinfo['borrow_uid']}")->find();
        $areaList                   = getArea();
        $memberinfo['location']     = $areaList[$memberinfo['province']] . $areaList[$memberinfo['city']];
        $memberinfo['location_now'] = $areaList[$memberinfo['province_now']] . $areaList[$memberinfo['city_now']];
        $memberinfo['zcze']         = $memberinfo['account_money'] + $memberinfo['back_money'] + $memberinfo['money_collect'] + $memberinfo['money_freeze'];
        $capitalinfo                = getMemberBorrowScan($borrowinfo['borrow_uid']);
        // $jsons['']
        $jsons['real_name']   = (string) $memberinfo['real_name'] ? (string) hidecard($memberinfo['real_name'], 4) : '未填写';
        $jsons['sex']         = (string) $memberinfo['sex'] ? (string) $memberinfo['sex'] : '未填写';
        $jsons['age']         = (string) $memberinfo['age'] ? (string) $memberinfo['age'] : '0';
        $jsons['age']         = $jsons['age'] . '岁' . '(' . getAgeName($jsons['age']) . ')';
        $jsons['education']   = (string) $memberinfo['education'] ? (string) $memberinfo['education'] : '未填写';
        $jsons['fin_monthin'] = (string) $memberinfo['fin_monthin'] ? (string) $memberinfo['fin_monthin'] : '未填写';
        $jsons['zy']          = (string) $memberinfo['zy'] ? (string) $memberinfo['zy'] : '未填写';
        $jsons['fin_car']     = (string) $memberinfo['fin_car'] ? (string) $memberinfo['fin_car'] : '未填写';
        $jsons['marry']       = (string) $memberinfo['marry'] ? (string) $memberinfo['marry'] : '未填写';

        $jsons['zcze']         = $memberinfo['zcze'] > 0 ? (string) getMoneyFormt($memberinfo['zcze']) : '0.00';
        $jsons['dhze']         = $capitalinfo['tj']['dhze'] > 0 ? (string) getMoneyFormt($capitalinfo['tj']['dhze']) : '0.00';
        $jsons['yhze']         = $capitalinfo['tj']['yhze'] > 0 ? (string) getMoneyFormt($capitalinfo['tj']['yhze']) : '0.00';
        $jsons['jcze']         = $capitalinfo['tj']['jcze'] > 0 ? (string) getMoneyFormt($capitalinfo['tj']['jcze']) : '0.00';
        $jsons['dsze']         = $capitalinfo['tj']['dsze'] > 0 ? (string) getMoneyFormt($capitalinfo['tj']['dsze']) : '0.00';
        $jsons['ysze']         = $capitalinfo['tj']['ysze'] > 0 ? (string) getMoneyFormt($capitalinfo['tj']['ysze']) : '0.00';
        $jsons['credit_limit'] = $memberinfo['credit_limit'] > 0 ? (string) getMoneyFormt($memberinfo['credit_limit']) : '0.00';
        $jsons['borrow_info']  = (string) $borrowinfo['borrow_info'];
        $jsons["status"]       = "1";
        outJson($jsons);
    }
    public function invest_detail_data()
    {
        $id         = intval($_REQUEST['id']) ? intval($_REQUEST['id']) : die;
        $pre        = C('DB_PREFIX');
        $borrowinfo = M('borrow_info')->field('borrow_uid,borrow_info,updata')->find($id);
        if (!is_array($borrowinfo)) {
            $jsons["tips"] = "项目不存在！";
            outJson($jsons);
        }
        $data_list = M("member_data_info")->field('add_time,data_name,deal_time,status,data_url')->where("uid={$borrowinfo['borrow_uid']}")->group('type')->select();
        //上传资料类型
        $upload_type = FilterUploadType(FS("Webconfig/integration"));
        foreach ($data_list as $key => $value) {
            $data_list[$key]['add_time']  = date('Y-m-d', $value['add_time']);
            $data_list[$key]['deal_time'] = date('Y-m-d', $value['deal_time']);
            $data_list[$key]['status']    = $value['status'] == 1 ? '通过' : '未通过';
            $data_list[$key]['data_url']  = $this->domainUrl . $value['data_url'];
        }
        $updata = (array)unserialize($borrowinfo['updata']);
        $jsons['updata'] = array();
        foreach ($updata as $key => $value) {
            $jsons['updata'][] = array(
                'info' => $value['info'],
                'data_url' => $this->domainUrl.$value['img'],
                'data_url_thumb' => $this->domainUrl.get_thumb_pic($value['img']),
                );
        }
        $jsons["data_list"] = (array) $data_list;
        $jsons["status"]    = "1";
        outJson($jsons);
    }
    public function invest_list()
    {
        $id          = intval($_REQUEST['id']) ? intval($_REQUEST['id']) : die;
        $fieldx      = "bi.investor_capital,FROM_UNIXTIME(bi.add_time,'%Y-%m-%d') as add_time,m.user_name,IF(bi.is_auto=0,'手动','自动') as is_auto,bi.investor_interest";
        $invest_list = M("borrow_investor bi")->field($fieldx)->join("__MEMBERS__ m ON bi.investor_uid = m.id")->where("bi.borrow_id={$id}")->order("bi.id DESC")->select();
        foreach ($invest_list as $key => $value) {
            $invest_list[$key]['user_name'] = cnsubstr($value['user_name'], 1,  0,'utf-8',false) . '***';
        }
        $borrowinfo = M('borrow_info')->field('has_borrow,borrow_times')->find($id);
        if (!is_array($borrowinfo)) {
            $jsons["tips"] = "项目不存在！";
            outJson($jsons);
        }

        $jsons['has_borrow']   = $borrowinfo['has_borrow'];
        $jsons['borrow_times'] = $borrowinfo['borrow_times'];
        $jsons['invest_list']  = (array) $invest_list;
        $jsons["status"]       = "1";
        outJson($jsons);
    }
    public function invest_pay()
    {
        $jsons["status"] = "0";
        $id              = intval($_REQUEST['id']) ? intval($_REQUEST['id']) : die;
        $uid             = intval($_REQUEST['uid']) ? intval($_REQUEST['uid']) : die;

        $field = "id,borrow_uid,borrow_money,borrow_status,borrow_type,has_borrow,has_vouch,borrow_interest_rate,borrow_duration,repayment_type,collect_time,borrow_min,borrow_max,password,borrow_use,money_collect";
        $vo    = M('borrow_info')->field($field)->find($id);
        if (empty($vo)) {
            $jsons["tips"] = "项目不存在！";
            outJson($jsons);
        }
        if ($this->uid == $vo['borrow_uid']) {
            $jsons["tips"] = "不能去投自己的标！";
            outJson($jsons);
        }
        if ($vo['borrow_status'] != 2) {
            $jsons["tips"] = "只能投正在借款中的标！";
            outJson($jsons);
        }
        $binfo = M("borrow_info")->field('borrow_money,has_borrow,has_vouch,borrow_max,borrow_min,borrow_type,password,money_collect')->find($id);
        $vm    = getMinfo($uid, 'm.pin_pass,mm.account_money,mm.back_money,mm.money_collect');
        ////////////////////////////////////待收金额限制 2013-08-26  fan///////////////////
        if ($binfo['money_collect'] > 0) {
            if ($vm['money_collect'] < $binfo['money_collect']) {
                $jsons["tips"] = "此标设置有投标待收金额限制，您账户里必须有足够的待收才能投此标！";
                outJson($jsons);
            }
        }
        ////////////////////////////////////待收金额限制 2013-08-26  fan///////////////////

        $has_pin = (empty($vm['pin_pass'])) ? "0" : "1";

        $jsons['has_pin']       = $has_pin;
        $jsons['password']      = empty($vo['password']) ? '0' : '1';
        $jsons['account_money'] = getFloatValue($vm['account_money'] + $vm['back_money'], 2);
        $jsons['need']          = $binfo['borrow_money'] - $binfo['has_borrow'];
        $jsons['borrow_min']    = $binfo['borrow_min'];
        $jsons['id']            = $id;
        $jsons['status']        = '1';
        outJson($jsons);
    }
    public function invest_pay_do()
    {
        $jsons["status"] = "0";
        $borrow_id       = intval($_REQUEST['id']) ? intval($_REQUEST['id']) : die;
        $uid             = intval($_REQUEST['uid']) ? intval($_REQUEST['uid']) : die;
        $pin_pass        = isset($_REQUEST['pin_pass']) ? text($_REQUEST['pin_pass']) : "";
        $password        = isset($_REQUEST['password']) ? text($_REQUEST['password']) : "";
        $money           = floatval($_REQUEST['invest_money']) ? floatval(($_REQUEST['invest_money'])) : die;

        $m      = M("member_money")->field('account_money,back_money,money_collect')->find($uid);
        $amoney = $m['account_money'] + $m['back_money'];
        if ($amoney < $money) {
            $jsons["tips"] = "您准备投标{$money}元，但您的账户可用余额为{$amoney}元，请先去充值再投标！";
            outJson($jsons);
        }

        $vm       = getMinfo($this->uid, 'm.pin_pass,mm.account_money,mm.back_money,mm.money_collect');
        $pin      = md5($pin_pass);
        $pin_pass = $vm['pin_pass'];
        if ($pin != $pin_pass) {
            $jsons['tips'] = '支付密码错误，请重试！';
            outJson($jsons);
        }

        $binfo = M("borrow_info")->field('borrow_money,borrow_max,has_borrow,has_vouch,borrow_type,borrow_min,money_collect,borrow_status')->find($borrow_id);
        //定向标 检测密码
        $binfo1 = M("borrow_info")->field('borrow_money,has_borrow,has_vouch,borrow_max,borrow_min,borrow_type,password,money_collect')->find($borrow_id);
        if (!empty($binfo1['password'])) {
            if (empty($password)) {
                $jsons['tips'] = "此标是定向标，必须验证投标密码";
                outJson($jsons);
            } else if ($binfo1['password'] != md5($password)) {
                $jsons['tips'] = "投标密码不正确！";
                outJson($jsons);
            }
        }
        ////////////////////////////////////待收金额限制 2013-08-26  fan///////////////////
        if ($binfo['money_collect'] > 0) {
            if ($m['money_collect'] < $binfo['money_collect']) {
                $jsons['tips'] = "此标设置有投标待收金额限制，您账户里必须有足够的待收才能投此标！";
                outJson($jsons);
            }
        }
        ////////////////////////////////////待收金额限制 2013-08-26  fan///////////////////

        //投标总数检测
        $capital = M('borrow_investor')->where("borrow_id={$borrow_id} AND investor_uid={$this->uid}")->sum('investor_capital');
        if (($capital + $money) > $binfo['borrow_max'] && $binfo['borrow_max'] > 0) {
            $xtee          = $binfo['borrow_max'] - $capital;
            $jsons['tips'] = "您已投标{$capital}元，此投上限为{$binfo['borrow_max']}元，你最多只能再投{$xtee}";
            outJson($jsons);
        }
        //if($binfo['has_vouch']<$binfo['borrow_money'] && $binfo['borrow_type'] == 2) $this->error("此标担保还未完成，您可以担保此标或者等担保完成再投标");
        $need      = $binfo['borrow_money'] - $binfo['has_borrow'];
        $caninvest = $need - $binfo['borrow_min'];
        if ($money > $caninvest && $need == 0) {
            $jsons['tips'] = "尊敬的{$uname}，此标已被抢投满了,下次投标手可一定要快呦！";
            outJson($jsons);
        }
        if (($binfo['borrow_min'] - $money) > 0) {
            $jsons['tips'] = "尊敬的{$uname}，本标最低投标金额为{$binfo['borrow_min']}元，请重新输入投标金额";
            outJson($jsons);
        }
        if (($need - $money) < 0) {
            $jsons['tips'] = "尊敬的{$uname}，此标还差{$need}元满标,您最多只能再投{$need}元";
            outJson($jsons);
        } else {
            if ($binfo['borrow_status'] == 2) {
                $done = investMoney($this->uid, $borrow_id, $money);
            }
        }
        if ($done === true) {
            $jsons['status'] = '1';
            $jsons['tips']   = "恭喜成功投标{$money}元";
            outJson($jsons);
        } else if ($done) {
            $jsons['tips'] = $done;
            outJson($jsons);
        } else {
            $jsons['tips'] = "对不起，投标失败，请重试!";
            outJson($jsons);
        }
    }
    public function debt()
    {
        $p = intval($_REQUEST['p']) ? intval($_REQUEST['p']) : "1";

        $curl   = $_SERVER['REQUEST_URI'];
        $urlarr = parse_url($curl);
        parse_str($urlarr['query'], $surl); //array获取当前链接参数，2.
        $urlArr     = array('borrow_status', 'borrow_duration', 'leve');
        $leveconfig = FS("Webconfig/leveconfig");
        foreach ($urlArr as $v) {
            $newpars = $surl; //用新变量避免后面的连接受影响
            unset($newpars[$v], $newpars['type'], $newpars['order_sort'], $newpars['orderby']); //去掉公共参数，对掉当前参数
            foreach ($newpars as $skey => $sv) {
                if ($sv == "all") {
                    unset($newpars[$skey]);
                }
//去掉"全部"状态的参数,避免地址栏全满
            }

            $newurl               = http_build_query($newpars); //生成此值的链接,生成必须是即时生成
            $searchUrl[$v]['url'] = $newurl;
            $searchUrl[$v]['cur'] = empty($_GET[$v]) ? "all" : text($_GET[$v]);
        }
        $searchMap['borrow_status']   = array("all" => "不限制", "2" => "进行中", "4" => "复审中", "6" => "还款中", "7" => "已完成");
        $searchMap['borrow_duration'] = array("all" => "不限制", "0-3" => "3个月以内", "3-6" => "3-6个月", "6-12" => "6-12个月", "12-24" => "12-24个月");
        $searchMap['leve']            = array("all" => "不限制", "{$leveconfig['1']['start']}-{$leveconfig['1']['end']}" => "{$leveconfig['1']['name']}", "{$leveconfig['2']['start']}-{$leveconfig['2']['end']}" => "{$leveconfig['2']['name']}", "{$leveconfig['3']['start']}-{$leveconfig['3']['end']}" => "{$leveconfig['3']['name']}", "{$leveconfig['4']['start']}-{$leveconfig['4']['end']}" => "{$leveconfig['4']['name']}", "{$leveconfig['5']['start']}-{$leveconfig['5']['end']}" => "{$leveconfig['5']['name']}", "{$leveconfig['6']['start']}-{$leveconfig['6']['end']}" => "{$leveconfig['6']['name']}", "{$leveconfig['7']['start']}-{$leveconfig['7']['end']}" => "{$leveconfig['7']['name']}");

        $search = array();
        //搜索条件
        foreach ($urlArr as $v) {
            if ($_GET[$v] && $_GET[$v] != 'all') {
                switch ($v) {
                    case 'leve':
                        $barr                = explode("-", text($_GET[$v]));
                        $search["m.credits"] = array("between", $barr);
                        break;
                    case 'borrow_status':
                        $search["b." . $v] = intval($_GET[$v]);
                        break;
                    default:
                        $barr              = explode("-", text($_GET[$v]));
                        $search["b." . $v] = array("between", $barr);
                        break;
                }
            }
        }

        if ($search['b.borrow_status'] == 0) {
            $search['b.borrow_status'] = array("in", "2,4,6,7");
        }
        $str = "%" . urldecode($_REQUEST['searchkeywords']) . "%";
        if ($_GET['is_keyword'] == '1') {
            $search['m.user_name'] = array("like", $str);
        } elseif ($_GET['is_keyword'] == '2') {
            $search['b.borrow_name'] = array("like", $str);

        }

        $parm['map'] = $search;

        //dump(M()->GetLastsql());exit;

        D("DebtBehavior");
        $Debt = new DebtBehavior();
        $list = $Debt->listAll($parm);
        // 2|可购买债权，1|转让成功，3|已撤销，4|还款结束，99|审核中
        $status_cn_arr = array(
            '0'  => '待审核',
            '1'  => '转让成功',
            '2'  => '立即购买',
            '3'  => '已撤销',
            // '4'  => '还款结束',
            '2'  => '转让成功',
            '99' => '审核中',
        );        
        foreach ($list['data'] as $key => $value) {
            $value['status'] == '4' and $value['status'] = '1' ;
            $value['status_cn'] = $status_cn_arr[$value['status']];
            $value['level_cn']  = getLeveName($value['credits']);
            $list['data'][$key] = arrayFilterValByKey($value, array('id', 'invest_id', 'borrow_name', 'transfer_price', 'borrow_interest_rate', 'money', 'period', 'total_period', 'level_cn', 'user_name', 'status', 'status_cn'));
        }
        $jsons['list']   = (array) $list['data'];
        $jsons['page']   = pageSet($list['_page'], $p, 10);
        $jsons["status"] = "1";
        outJson($jsons);
    }
    public function debt_detail()
    {
        $pre       = C('DB_PREFIX');
        $id        = intval($_REQUEST['id']) ? intval($_REQUEST['id']) : die;
        $invest_id = intval($_REQUEST['invest_id']) ? intval($_REQUEST['invest_id']) : die;
        $Bconfig   = require C("APP_ROOT") . "Conf/borrow_config.php";

        //合同ID
        $borrowinfo = M("borrow_info bi")->field('bi.*,ac.title,ac.id as aid')->join('lzh_article ac on ac.id= bi.danbao')->where('bi.id=' . $id)->find();
        if (!is_array($borrowinfo) || ($borrowinfo['borrow_status'] == 0)) {
            $jsons['tips'] = '数据有误';
            outJson($jsons);
        }

        $debtinfo               = M("invest_detb")->where("invest_id = {$invest_id}")->find();
        $debtinfo['sell_uname'] = M("members")->getFieldById($debtinfo['sell_uid'], "user_name");
        $debtinfo['credits']    = M("members")->getFieldById($debtinfo['sell_uid'], "credits");
        $debtinfo['deadline']   = M("borrow_investor")->getFieldById($invest_id, "deadline");

        $memberinfo                 = M("members m")->field("m.id,m.customer_name,m.customer_id,m.user_name,m.reg_time,m.credits,fi.*,mi.*,mm.*")->join("{$pre}member_financial_info fi ON fi.uid = m.id")->join("{$pre}member_info mi ON mi.uid = m.id")->join("{$pre}member_money mm ON mm.uid = m.id")->where("m.id={$borrowinfo['borrow_uid']}")->find();
        $areaList                   = getArea();
        $memberinfo['location']     = $areaList[$memberinfo['province']] . $areaList[$memberinfo['city']];
        $memberinfo['location_now'] = $areaList[$memberinfo['province_now']] . $areaList[$memberinfo['city_now']];
        $memberinfo['zcze']         = $memberinfo['account_money'] + $memberinfo['back_money'] + $memberinfo['money_collect'] + $memberinfo['money_freeze'];

        $jsons['borrow_name']          = $borrowinfo['borrow_name'];
        $jsons['borrow_interest_rate'] = $borrowinfo['borrow_interest_rate'];
        $jsons['user_name']            = $memberinfo['user_name'];
        $jsons['sell_uname']           = $debtinfo['sell_uname'];
        $jsons['transfer_price']       = $debtinfo['transfer_price'];
        $jsons['money']                = $debtinfo['money'];
        $jsons['level_cn']             = getLeveName($debtinfo['credits']);
        $jsons['period']               = $debtinfo['period'];
        $jsons['total_period']         = $debtinfo['total_period'];
        $jsons['debt_status']          = $debtinfo['status'];
        $jsons['status_cn']            = $debtinfo['status'] == 2 ? '可购买' : '已结束';
        $jsons['id']                   = $id;
        $jsons['invest_id']            = $invest_id;
        $jsons['status']               = "1";
        outJson($jsons);

    }
    public function debt_pay()
    {
        $uid                     = intval($_REQUEST["uid"]) or die;
        $invest_id               = intval($_REQUEST['invest_id']) ? intval($_REQUEST['invest_id']) : die;
        $debt                    = M("invest_detb")->field("transfer_price, money")->where("invest_id={$invest_id}")->find();
        $buy_user                = M("member_money")->field("account_money, back_money")->where("uid={$uid}")->find();
        $account                 = $buy_user['account_money'] + $buy_user['back_money'];
        $jsons['money']          = $debt['money'];
        $jsons['transfer_price'] = $debt['transfer_price'];
        $jsons['account']        = getFloatValue($account, 2);
        $jsons['invest_id']      = getFloatValue($invest_id, 2);

        $vm    = getMinfo($uid, 'm.pin_pass');
        $has_pin = (empty($vm['pin_pass'])) ? "0" : "1";
        $jsons['has_pin']         = $has_pin;
        $jsons['status']         = '1';
        outJson($jsons);
    }
    public function debt_pay_do()
    {
        $uid       = intval($_REQUEST["uid"]) or die;
        $paypass   = strval($_REQUEST['paypass']) ? strval($_REQUEST['paypass']) : die;
        $invest_id = intval($_REQUEST['invest_id']) ? intval($_REQUEST['invest_id']) : die;
        D("DebtBehavior");
        $Debt = new DebtBehavior($uid);
        // 检测是否可以购买  密码是否正确，余额是否充足
        $result = $Debt->buy($paypass, $invest_id);
        if ($result == '购买成功') {
            $jsons['status'] = "1";
            $jsons["tips"]   = "购买成功！";
        } else {
            $jsons["tips"] = $result;
        }
        outJson($jsons);
    }

    public function borrow()
    {
        $borrow_config           = require C("APP_ROOT") . "Conf/borrow_config.php";
        $jsons['borrow_type']    = arrayToArray($borrow_config['BORROW_TYPE']);
        $jsons['borrow_use']     = arrayToArray($this->gloconf['BORROW_USE']);
        $jsons['borrow_min']     = arrayToArray($this->gloconf['BORROW_MIN']);
        $jsons['borrow_max']     = arrayToArray($this->gloconf['BORROW_MAX']);
        $jsons['borrow_time']    = arrayToArray($this->gloconf['BORROW_TIME']);
        $jsons['repayment_type'] = arrayToArray($borrow_config['REPAYMENT_TYPE']);
        $jsons['reward_type']    = array(
            array('id' => '1', 'name' => '按投标金额比例奖励'),
            array('id' => '2', 'name' => '按固定金额分摊奖励'),
        );
        $jsons['daishou'] = array(
            array('id' => '0', 'name' => '不限制'),
            array('id' => '1', 'name' => '全部待收'),
            array('id' => '2', 'name' => '当月待收'),
            array('id' => '3', 'name' => '当天待收'),
        );
        $borrow_duration_day = explode("|", $this->glo['borrow_duration_day']);
        $day                 = range($borrow_duration_day[0], $borrow_duration_day[1]);
        $day_time            = array();
        foreach ($day as $v) {
            $day_time[$v] = $v . "天";
        }
        $borrow_duration = explode("|", $this->glo['borrow_duration']);
        $month           = range($borrow_duration[0], $borrow_duration[1]);
        $month_time      = array();
        foreach ($month as $v) {
            $month_time[$v] = $v . "个月";
        }
        $jsons['borrow_duration_day']   = arrayToArray($day_time);
        $jsons['borrow_duration_month'] = arrayToArray($month_time);
        $jsons['rate_lixt']             = explode("|", $this->glo['rate_lixi']);
        $jsons['status']                = '1';
        outJson($jsons);
    }
    public function borrow_do()
    {
        $uid          = intval($_REQUEST['uid']) ? intval($_REQUEST['uid']) : die;
        $this->uid = $uid;
        $vo1 = M('members')->field('id,user_name,user_email,user_pass,is_ban')->where("id={$this->uid}")->find();
        if($vo1['is_ban']==1||$vo1['is_ban']==2)  {
            $jsons['tips'] = "您的帐户已被冻结，请联系客服处理！";
            outJson($jsons);   
        }
        $vminfo = M('members')->field("user_leve,time_limit,is_borrow,is_vip")->find($this->uid);
        if($vminfo['is_vip']==0){
            $_xoc = M('borrow_info')->where("borrow_uid={$this->uid} AND borrow_status in(0,2,4)")->count('id');
            if($_xoc>0)  {
                $jsons['tips'] = "您有一个借款中的标，请等待审核";
                outJson($jsons);          
            }

            $vx = M('vip_apply')->where("uid={$this->uid} AND status=0")->count("id");
            if($vx>0) {
                $jsons['tips'] = "您的VIP申请已在处理中，请耐心等待！";
                outJson($jsons);             
            }

            if(!($vminfo['user_leve']>0 && $vminfo['time_limit']>time())){
                $jsons['tips'] = "请先通过VIP审核再发标";
                outJson($jsons);                
            }
            
            if($vminfo['is_borrow']==0){
                $jsons['tips'] = "您目前不允许发布借款，如需帮助，请与客服人员联系！";
                outJson($jsons);                                
            }
            
            $vo = getMemberDetail($this->uid);
            if($vo['province']==0 && $vo['province_now ']==0 && $vo['province_now ']==0 && $vo['city']==0 && $vo['city_now']==0 ){                
                $jsons['tips'] = "请先填写个人详细资料后再发标";
                outJson($jsons);                
            }
        }
        $borrow_type  = in_array(@$_REQUEST['borrow_type'], array(1, 2, 3, 4, 5, 6)) ? $_REQUEST['borrow_type'] : die;
        $borrow_money = intval($_REQUEST['borrow_money']) ? intval($_REQUEST['borrow_money']) : die;
        $pre          = C('DB_PREFIX');
        //相关的判断参数
        $rate_lixt           = explode("|", $this->glo['rate_lixi']);
        $borrow_duration     = explode("|", $this->glo['borrow_duration']);
        $borrow_duration_day = explode("|", $this->glo['borrow_duration_day']);
        $fee_borrow_manage   = explode("|", $this->glo['fee_borrow_manage']);
        $vminfo              = M('members m')->join("{$pre}member_info mf ON m.id=mf.uid")->field("m.user_leve,m.time_limit,mf.province_now,mf.city_now,mf.area_now")->where("m.id={$this->uid}")->find();
        //相关的判断参数
        $borrow['borrow_type'] = $borrow_type;

        if (floatval(@$_REQUEST['borrow_interest_rate']) > $rate_lixt[1] || floatval(@$_REQUEST['borrow_interest_rate']) < $rate_lixt[0]) {
            $jsons['tips'] = "提交的借款利率超出允许范围，请重试";
            outJson($jsons);
        }
        $borrow['borrow_money'] = $borrow_money;

        $_minfo       = getMinfo($this->uid, "m.pin_pass,mm.account_money,mm.back_money,mm.credit_cuse,mm.money_collect");
        $_capitalinfo = getMemberBorrowScan($this->uid);
        ///////////////////////////////////////////////////////
        $borrowNum = M('borrow_info')->field("borrow_type,count(id) as num,sum(borrow_money) as money,sum(repayment_money) as repayment_money")->where("borrow_uid = {$this->uid} AND borrow_status=6 ")->group("borrow_type")->select();
        $borrowDe  = array();
        foreach ($borrowNum as $k => $v) {
            $borrowDe[$v['borrow_type']] = $v['money'] - $v['repayment_money'];
        }
        ///////////////////////////////////////////////////
        switch ($borrow['borrow_type']) {
            case 1: //普通标
                if ($_minfo['credit_cuse'] < $borrow['borrow_money']) {
                    $jsons['tips'] = "您的可用信用额度为{$_minfo['credit_cuse']}元，小于您准备借款的金额，不能发标";
                    outJson($jsons);
                }
                break;
            case 2: //新担保标
            case 3: //秒还标
                break;
            case 4: //净值标
                $_netMoney = getFloatValue($_minfo['money_collect'] - $borrowDe[4], 2);
                if ($_netMoney < $borrow['borrow_money']) {
                    $jsons['tips'] = "您的净值额度{$_netMoney}元，小于您准备借款的金额，不能发标";
                    outJson($jsons);
                }
                break;
            case 5: //抵押标
                //$borrow_type=5;
                break;
        }

        $borrow['borrow_uid']           = $this->uid;
        $borrow['borrow_name']          = text($_REQUEST['borrow_name']);
        $borrow['borrow_duration']      = ($borrow['borrow_type'] == 3) ? 1 : intval($_REQUEST['borrow_duration']); //秒标固定为一月
        $borrow['borrow_interest_rate'] = floatval($_REQUEST['borrow_interest_rate']);
        if (strtolower($_REQUEST['is_day']) == 'yes') {
            $borrow['repayment_type'] = 1;
        } elseif ($borrow['borrow_type'] == 3) {
            $borrow['repayment_type'] = 2;
        }
//秒标按月还
        else {
            $borrow['repayment_type'] = intval($_REQUEST['repayment_type']);
        }

        if ($borrow['repayment_type'] == '1' || $borrow['repayment_type'] == '5') {
            $borrow['total'] = 1;
        } else {
            $borrow['total'] = $borrow['borrow_duration']; //分几期还款
        }
        $borrow['borrow_status'] = 0;
        $borrow['borrow_use']    = intval($_REQUEST['borrow_use']);
        $borrow['add_time']      = time();
        $borrow['collect_day']   = intval($_REQUEST['borrow_time']);
        $borrow['add_ip']        = get_client_ip();
        $borrow['borrow_info']   = text($_REQUEST['borrow_info']);
        $borrow['reward_type']   = intval($_REQUEST['reward_type']);
        $borrow['reward_num']    = floatval($_REQUEST["reward_num"]);
        $borrow['borrow_min']    = intval($_REQUEST['borrow_min']);
        $borrow['borrow_max']    = intval($_REQUEST['borrow_max']);
        /*$borrow['province'] = $vminfo['province_now'];
        $borrow['city'] = $vminfo['city_now'];
        $borrow['area'] = $vminfo['area_now'];*/
        if ($_REQUEST['is_pass'] && intval($_REQUEST['is_pass']) == 1) {
            $borrow['password'] = md5($_REQUEST['password']);
        }

        $borrow['money_collect'] = floatval($_REQUEST['money_collect']); //代收金额限制设置

        //借款费和利息
        $borrow['borrow_interest'] = getBorrowInterest($borrow['repayment_type'], $borrow['borrow_money'], $borrow['borrow_duration'], $borrow['borrow_interest_rate']);

        if ($borrow['repayment_type'] == 1) {
//按天还
            $fee_rate             = (is_numeric($fee_borrow_manage[0])) ? ($fee_borrow_manage[0] / 3000) : 0.001;
            $borrow['borrow_fee'] = round($fee_rate * $borrow['borrow_money'] * $borrow['borrow_duration']);
        } else {
            $fee_rate_1 = (is_numeric($fee_borrow_manage[1])) ? ($fee_borrow_manage[1] / 100) : 0.02;
            $fee_rate_2 = (is_numeric($fee_borrow_manage[2])) ? ($fee_borrow_manage[2] / 100) : 0.002;
            if ($borrow['borrow_duration'] > $fee_borrow_manage[3] && is_numeric($fee_borrow_manage[3])) {
                $borrow['borrow_fee'] = getFloatValue($fee_rate_1 * $borrow['borrow_money'], 2);
                $borrow['borrow_fee'] += getFloatValue($fee_rate_2 * $borrow['borrow_money'] * ($borrow['borrow_duration'] - $fee_borrow_manage[3]), 2);
            } else {
                $borrow['borrow_fee'] = getFloatValue($fee_rate_1 * $borrow['borrow_money'], 2);
            }
        }

        if ($borrow['borrow_type'] == 3) {
//秒还标
            if ($borrow['reward_type'] > 0) {
                $_reward_money = getFloatValue($borrow['borrow_money'] * $borrow['reward_num'] / 100, 2);
            }
            $_reward_money = floatval($_reward_money);
            if (($_minfo['account_money'] + $_minfo['back_money']) < ($borrow['borrow_fee'] + $_reward_money)) {
                $jsons['tips'] = "发布此标您最少需保证您的帐户余额大于等于" . ($borrow['borrow_fee'] + $_reward_money) . "元，以确保可以支付借款管理费和投标奖励费用";
                outJson($jsons);
            }
        }
        //投标上传图片资料（暂隐）
        // foreach(@$_REQUEST['swfimglist'] as $key=>$v){
        //     if($key>10) break;
        //     $row[$key]['img'] = substr($v,1);
        //     $row[$key]['info'] = $_REQUEST['picinfo'][$key];
        // }
        $borrow['updata'] = serialize(array());
        $newid            = M("borrow_info")->add($borrow);
        $suo              = array();
        $suo['id']        = $newid;
        $suo['suo']       = 0;
        $suoid            = M("borrow_info_lock")->add($suo);
        if ($newid) {
            $jsons['status'] = '1';
            $jsons['tips']   = "借款发布成功，网站会尽快初审";
        } else {
            $jsons['tips'] = "发布失败，请先检查是否完成了个人详细资料然后重试";
        }
        outJson($jsons);
    }

    public function borrow_apply_do()
    {
        $data['money']   = text($_REQUEST['money']);
        $data['name']    = text($_REQUEST['name']);
        $data['contact'] = text($_REQUEST['contact']);
        $data['msg']     = text($_REQUEST['msg']);
        $data            = textPost($data);
        $model           = M('feedback');
        if (false === $model->create($data)) {
            $jsons['tips'] = $model->getError();
            outJson($jsons);
        }
        $model->msg      = "借款金额：" . text($data['money']) . "&nbsp;&nbsp;&nbsp;" . $model->msg;
        $model->add_time = time();
        $model->ip       = get_client_ip();
        //保存当前数据对象
        if ($result = $model->add()) {
            //保存成功
            //成功提示
            $jsons['tips']   = '提交成功';
            $jsons['status'] = '1';
        } else {
            //失败提示
            $jsons['tips'] = '反馈失败，请重试';
        }
        outJson($jsons);
    }
    public function article_list()
    {
        $p             = intval($_REQUEST['p']) ? intval($_REQUEST['p']) : "1";
        $show_type     = text($_REQUEST['show_type']) ? text($_REQUEST['show_type']) : "news";
        $show_type_arr = array(
            'web_notice'    => '9',
            'borrow_notice' => '27',
            'active_notice' => '28',
            'news'          => '2',
            'help'          => '22',
            'question'      => '23',
        );
        $type_id = isset($show_type_arr[$show_type]) ? $show_type_arr[$show_type] : $show_type_arr['news'];
        $parm    = array(
            'type_id'  => $type_id,
            'pagesize' => 15,
        );
        $list = getArticleList($parm);
        foreach ($list['list'] as $key => $value) {
            $value['add_time']  = date('Y-m-d', $value['art_time']);
            $value              = arrayFilterValByKey($value, array('id', 'add_time', 'title'));
            $list['list'][$key] = $value;
        }
        $jsons['status'] = '1';
        $jsons['list']   = is_array($list['list']) ? $list['list'] : array();
        $jsons['page']   = pageSet($list['_page'], $p, '10');
        outJson($jsons);
    }
    public function article_list_content()
    {
        $this->article_content('article');
    }
    public function article_content($showType = 'category')
    {
        switch ($showType) {
            case 'category':
                $show_type     = text($_REQUEST['show_type']) ? text($_REQUEST['show_type']) : "about";
                $show_type_arr = array(
                    'about'   => '10',
                    'contact' => '24',
                    'reg_agreement' => '6',
                );
                $id     = isset($show_type_arr[$show_type]) ? $show_type_arr[$show_type] : $show_type_arr['about'];
                $nowRow = M('article_category')->where(array('is_hiden' => 0))->find($id);
                break;
            default:
                $id     = intval($_REQUEST['id']) ? intval($_REQUEST['id']) : die;
                $nowRow = M('article')->find($id);
                break;
        }
        $content = !empty($nowRow['art_content']) ? $nowRow['art_content'] : (!empty($nowRow['type_content']) ? $nowRow['type_content'] : '');
        $content = htmlspecialchars_decode($content);
        outWeb($content);
    }
    public function tool_invest_do()
    {
        // var_dump($_REQUEST);exit();
        $amount        = round(floatval($_REQUEST['amount']), 2); //投资金额
        $date_limit    = intval($_REQUEST['date_limit']); //投资期限
        $rate          = floatval($_REQUEST['rate']); //投资利率
        $reward_rate   = floatval($_REQUEST['reward_rate']); //借款奖励
        $invest_manage = floatval($_REQUEST['invest_manage']); //利息管理费

        $rate_type = (intval($_REQUEST['rate_type']) == 2) ? 2 : 1; //投资利率：1：年利率；2：日利率
        $date_type = (intval($_REQUEST['date_type']) == 2) ? 2 : 1; //投资类型：1：月；2：日

        $repayment_type = intval($_REQUEST['repayment_type']);
        if ($repayment_type != 1 && $rate_type == 2) {
            $rate = $rate * 360;
        }

        if ($repayment_type == 1 && $rate_type == 1) {
            $rate = $rate / 360;
        }

        $repay_detail['reward_money'] = round($amount * $reward_rate / 100, 2);
        $repay_detail['invest_money'] = $amount - $repay_detail['reward_money'];
        switch ($repayment_type) {
            case '1': //按天到期还款
                $repay_detail['repayment_money'] = round($amount * ($rate * $date_limit * (100 - $invest_manage) / 100 + 100) / 100, 2);
                $repay_detail['interest']        = $repay_detail['repayment_money'] - $amount;
                $repay_detail['day_apr']         = round(($repay_detail['repayment_money'] - $repay_detail['invest_money']) * 100 / ($repay_detail['invest_money'] * $date_limit), 2);
                $repay_detail['year_apr']        = round($repay_detail['day_apr'] * 360, 2);
                $repay_detail['month_apr']       = round($repay_detail['day_apr'] * 360 / 12, 2);
                break;
            case '4': //到期还本息
                $repay_detail['repayment_money'] = round(($amount + $amount * ($date_limit * $rate / 12 / 100) * (100 - $invest_manage) / 100), 2);
                $repay_detail['interest']        = $repay_detail['repayment_money'] - $amount;
                $repay_detail['month_apr']       = round(($repay_detail['repayment_money'] - $repay_detail['invest_money']) * 100 / ($repay_detail['invest_money'] * $date_limit), 2);
                $repay_detail['year_apr']        = round($repay_detail['month_apr'] * 12, 2);
                $repay_detail['day_apr']         = round($repay_detail['month_apr'] * 12 / 360, 2);
                break;
            case '3': //每月还息到期还本
                $repay_detail['repayment_money'] = round($amount * ($rate * $date_limit * (100 - $invest_manage) / 100 / 12 + 100) / 100, 2);
                $repay_detail['interest']        = $repay_detail['repayment_money'] - $amount;
                $repay_detail['month_apr']       = round(($repay_detail['repayment_money'] - $repay_detail['invest_money']) * 100 / ($repay_detail['invest_money'] * $date_limit), 2);
                $repay_detail['year_apr']        = round($repay_detail['month_apr'] * 12, 2);
                $repay_detail['day_apr']         = round($repay_detail['month_apr'] * 12 / 360, 2);

                $interest = round($amount * $rate * (100 - $invest_manage) / 100 / 12 / 100, 2); //利息等于应还金额乘月利率
                $repay    = $repay_detail['repayment_money'];
                for ($i = 0; $i < $date_limit; $i++) {
                    if ($i + 1 == $date_limit) {
                        $capital = $amount; //本金只在最后一个月还，本金等于借款金额除季度
                        $repay   = $interest + $capital;
                    } else {
                        $capital = 0;
                        $repay   = $repay - $interest;
                    }

                    $_result[$i]['repayment_money'] = $interest + $capital;
                    $_result[$i]['interest']        = $interest;
                    $_result[$i]['capital']         = $capital;
                    $_result[$i]['last_money']      = $repay;
                }
                break;
            case '5': //先息后本
                $repay_detail['interest'] = round(($amount * ($rate / 12 / 100) * $date_limit) * ((100 - $invest_manage) / 100), 2);
                $repay_detail['invest_money'] -= $repay_detail['interest'];
                $repay_detail['repayment_money'] = $amount;

                $repay_detail['month_apr'] = round(($repay_detail['repayment_money'] - $repay_detail['invest_money']) * 100 / ($repay_detail['invest_money'] * $date_limit), 2);
                $repay_detail['year_apr']  = round($repay_detail['month_apr'] * 12, 2);
                $repay_detail['day_apr']   = round($repay_detail['month_apr'] * 12 / 360, 2);
                break;
            case '2': //按月分期还款
            default:
                $month_apr                       = $rate / (12 * 100);
                $_li                             = pow((1 + $month_apr), $date_limit);
                $repayment                       = ($_li != 1) ? round($amount * ($month_apr * $_li) / ($_li - 1), 2) : round($amount / $date_limit, 2);
                $repay_detail['repayment_money'] = round(($repayment * $date_limit - $amount) * (100 - $invest_manage) / 100 + $amount, 2);
                $repay_detail['interest']        = $repay_detail['repayment_money'] - $amount;

                $repay = $repay_detail['repayment_money'];
                for ($i = 0; $i < $date_limit; $i++) {
                    if ($i == 0) {
                        $interest = round($amount * $month_apr, 2);
                    } else {
                        $_lu      = pow((1 + $month_apr), $i);
                        $interest = round(($amount * $month_apr - $repayment) * $_lu + $repayment, 2);
                    }
                    $fee = $interest * $invest_manage / 100;

                    $_result[$i]['repayment_money'] = getFloatValue($repayment - $fee, 2);
                    $_result[$i]['interest']        = getFloatValue($interest - $fee, 2);
                    $_result[$i]['capital']         = getFloatValue($repayment - $interest, 2);

                    if ($i + 1 != $date_limit) {
                        $repay = $repay - $_result[$i]['repayment_money'];
                    } else {
                        $repay = 0;
                    }

                    $_result[$i]['last_money'] = $repay;
                }

                $month_apr2 = ($repay_detail['repayment_money'] - $repay_detail['invest_money']) / ($repay_detail['invest_money'] * $date_limit);
                $rekursiv   = 0.001;
                for ($i = 0; $i < 100; $i++) {
                    $_li2  = pow((1 + $month_apr2), $date_limit);
                    $repay = $repay_detail['invest_money'] * $date_limit * ($month_apr2 * $_li2) / ($_li2 - 1);
                    if ($repay < $repay_detail['repayment_money'] * 0.99999) {
                        $month_apr2 += $rekursiv;
                    } elseif ($repay > $repay_detail['repayment_money'] * 1.00001) {
                        $month_apr2 -= $rekursiv * 0.9;
                        $rekursiv *= 0.1;
                    } else {
                        break;
                    }

                }
                $repay_detail['month_apr'] = round($month_apr2 * 100, 2);

                $repay_detail['year_apr'] = round($repay_detail['month_apr'] * 12, 2);
                $repay_detail['day_apr']  = round($repay_detail['month_apr'] * 12 / 360, 2);
                break;
        }
        $repay_detail['total_interest'] = round($repay_detail['repayment_money'] - $repay_detail['invest_money'], 2);

        $jsons['repayment_type'] = $repayment_type;
        $jsons['month']          = $date_limit;
        $jsons['repay_list']     = (array) $_result;
        $jsons['repay_detail']   = $repay_detail;
        $jsons['amount']         = $amount;
        $jsons['status']         = '1';
        outJson($jsons);
    }
    public function tool_borrow_do()
    {
        $amount      = round(floatval($_REQUEST['amount']), 4); //借款金额
        $date_limit  = intval($_REQUEST['date_limit']); //借款期限
        $rate        = floatval($_REQUEST['rate']); //借款利率
        $reward_rate = floatval($_REQUEST['reward_rate']); //借款奖励

        //$risk_reserve = floatval($_REQUEST['risk_reserve']);//风险准备金
        $borrow_manage = floatval($_REQUEST['borrow_manage']); //借款管理费

        $rate_type = (intval($_REQUEST['rate_type']) == 2) ? 2 : 1; //投资利率：1：年利率；2：日利率
        $date_type = (intval($_REQUEST['date_type']) == 2) ? 2 : 1; //投资类型：1：月；2：日

        $repayment_type = intval($_REQUEST['repayment_type']); //借款类型
        if ($repayment_type != 1 && $rate_type == 2) {
            $rate = $rate * 360;
        }
//利率
        if ($repayment_type == 1 && $rate_type == 1) {
            $rate = $rate / 360;
        }
//

        $repay_detail['risk_reserve']  = 0; //round($amount*$risk_reserve/100,4);//风险准备金
        $repay_detail['borrow_manage'] = round($amount * $borrow_manage * $date_limit / 100, 2); //借款管理费
        $repay_detail['reward_money']  = round($amount * $reward_rate / 100, 2); //奖励
        $repay_detail['borrow_money']  = $amount - $repay_detail['risk_reserve'] - $repay_detail['borrow_manage'] - $repay_detail['reward_money'];
        switch ($repayment_type) {
            case '1': //按天到期还款
                $repay_detail['repayment_money'] = round($amount * ($rate * $date_limit + 100) / 100, 2);
                $repay_detail['interest']        = $repay_detail['repayment_money'] - $amount;
                $repay_detail['day_apr']         = round(($repay_detail['repayment_money'] - $repay_detail['borrow_money']) * 100 / ($repay_detail['borrow_money'] * $date_limit), 2);
                $repay_detail['year_apr']        = round($repay_detail['day_apr'] * 360, 2);
                $repay_detail['month_apr']       = round($repay_detail['day_apr'] * 360 / 12, 2);
                break;
            case '4': //到期还本息
                $repay_detail['repayment_money'] = round($amount * ($date_limit * $rate / 12 + 100) / 100, 2);
                $repay_detail['interest']        = $repay_detail['repayment_money'] - $amount;
                $repay_detail['month_apr']       = round(($repay_detail['repayment_money'] - $repay_detail['borrow_money']) * 100 / ($repay_detail['borrow_money'] * $date_limit), 2);
                $repay_detail['year_apr']        = round($repay_detail['month_apr'] * 12, 2);
                $repay_detail['day_apr']         = round($repay_detail['month_apr'] * 12 / 360, 2);
                break;
            case '3': //每月还息到期还本
                $repay_detail['repayment_money'] = round($amount * ($rate * $date_limit / 12 + 100) / 100, 2);
                $repay_detail['interest']        = $repay_detail['repayment_money'] - $amount;
                $repay_detail['month_apr']       = round(($repay_detail['repayment_money'] - $repay_detail['borrow_money']) * 100 / ($repay_detail['borrow_money'] * $date_limit), 2);
                $repay_detail['year_apr']        = round($repay_detail['month_apr'] * 12, 2);
                $repay_detail['day_apr']         = round($repay_detail['month_apr'] * 12 / 360, 2);

                $interest = round($amount * $rate / 12 / 100, 2); //利息等于应还金额乘月利率
                for ($i = 0; $i < $date_limit; $i++) {
                    if ($i + 1 == $date_limit) {
                        $capital = $amount;
                    }
//本金只在最后一个月还，本金等于借款金额除季度
                    else {
                        $capital = 0;
                    }

                    $_result[$i]['repayment_money'] = $interest + $capital;
                    $_result[$i]['interest']        = $interest;
                    $_result[$i]['capital']         = $capital;
                    $_result[$i]['last_money']      = $repay_detail['repayment_money'] - $_result[$i]['repayment_money'] * ($i + 1);
                }
                break;
            case '5': //先息后本
                $repay_detail['interest'] = round($amount * $rate * $date_limit / 12 / 100, 2);
                $repay_detail['borrow_money'] -= $repay_detail['interest'];
                $repay_detail['repayment_money'] = $amount;

                $repay_detail['month_apr'] = round(($repay_detail['repayment_money'] - $repay_detail['borrow_money']) * 100 / ($repay_detail['borrow_money'] * $date_limit), 2);
                $repay_detail['year_apr']  = round($repay_detail['month_apr'] * 12, 2);
                $repay_detail['day_apr']   = round($repay_detail['month_apr'] * 12 / 360, 2);
                break;
            case '2': //按月分期还款
            default:
                $month_apr                       = $rate / (12 * 100);
                $_li                             = pow((1 + $month_apr), $date_limit);
                $repayment                       = ($_li != 1) ? round($amount * ($month_apr * $_li) / ($_li - 1), 2) : round($amount / $date_limit, 2);
                $repay_detail['repayment_money'] = $repayment * $date_limit;
                $repay_detail['interest']        = $repay_detail['repayment_money'] - $amount;

                for ($i = 0; $i < $date_limit; $i++) {
                    if ($i == 0) {
                        $interest = round($amount * $month_apr, 2);
                    } else {
                        $_lu      = pow((1 + $month_apr), $i);
                        $interest = round(($amount * $month_apr - $repayment) * $_lu + $repayment, 2);
                    }
                    $_result[$i]['repayment_money'] = getFloatValue($repayment, 2);
                    $_result[$i]['interest']        = getFloatValue($interest, 2);
                    $_result[$i]['capital']         = getFloatValue($repayment - $interest, 2);
                    $_result[$i]['last_money']      = $repay_detail['repayment_money'] - $_result[$i]['repayment_money'] * ($i + 1);
                }

                $month_apr2 = ($repay_detail['repayment_money'] - $repay_detail['borrow_money']) / ($repay_detail['borrow_money'] * $date_limit);
                $rekursiv   = 0.001;
                for ($i = 0; $i < 100; $i++) {
                    $_li2  = pow((1 + $month_apr2), $date_limit);
                    $repay = $repay_detail['borrow_money'] * $date_limit * ($month_apr2 * $_li2) / ($_li2 - 1);
                    if ($repay < $repay_detail['repayment_money'] * 0.99999) {
                        $month_apr2 += $rekursiv;
                    } elseif ($repay > $repay_detail['repayment_money'] * 1.00001) {
                        $month_apr2 -= $rekursiv * 0.9;
                        $rekursiv *= 0.1;
                    } else {
                        break;
                    }

                }
                $repay_detail['month_apr'] = round($month_apr2 * 100, 2);

                $repay_detail['year_apr'] = round($repay_detail['month_apr'] * 12, 2);
                $repay_detail['day_apr']  = round($repay_detail['month_apr'] * 12 / 360, 2);
                break;
        }
        $repay_detail['total_interest'] = round($repay_detail['repayment_money'] - $repay_detail['borrow_money'], 2);
        $jsons['repayment_type']        = $repayment_type;
        $jsons['month']                 = $date_limit;
        $jsons['repay_list']            = (array) $_result;
        $jsons['repay_detail']          = $repay_detail;
        $jsons['amount']                = $amount;
        $jsons['status']                = '1';
        outJson($jsons);
    }
    public function version()
    {
        $now_ver                                          = '5';
        $ver_no                                           = isset($_REQUEST['ver_no']) ? $_REQUEST['ver_no'] : die;
        $jsons['is_update']                               = $now_ver > $ver_no ? '1' : '0';        
        $jsons['is_update'] == 1 and $jsons['update_url'] = $this->domainUrl . U('api/index/version_update').'?access_token='.$this->get_token('index/version_update');
        $jsons['status']                                  = '1';
        outJson($jsons);
    }
    public function version_update()
    {
        if(empty($this->source_from)){
            $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
            if(strpos($useragent, 'iphone')||strpos($useragent, 'ipad')){
                $this->source_from = 2;
            }else if(strpos($useragent, 'android')){
                $this->source_from = 1;
            }else{
                $this->source_from = 1;
            }
        }
        if($this->source_from == 1){
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
}
