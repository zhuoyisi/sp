<?php

/* array(菜单名，菜单url参数，是否显示) */
//error_reporting(E_ALL);
/*
  $acl_inc[$i]['low_leve']['global']  global是model
  每个action前必须添加eqaction_前缀'eqaction_websetting'  => 'at1','at1'表示唯一标志,可独自命名,eqaction_后面跟的action必须统一小写


 */
$acl_inc = array();
$i = 0;
$acl_inc[$i]['low_title'][] = '全局设置';
$acl_inc[$i]['low_leve']['global'] = array("网站设置" => array(
        "列表" => 'at1',
        "增加" => 'at2',
        "删除" => 'at3',
        "修改" => 'at4',
    ),
    "友情链接" => array(
        "列表" => 'at5',
        "增加" => 'at6',
        "删除" => 'at7',
        "修改" => 'at8',
        "搜索" => 'att8',
    ),
    "所有缓存" => array(
        "清除" => 'at22',
    ),
    "后台操作日志" => array(
        "列表" => 'at23',
        "删除" => 'at24',
        "删除一月前操作日志" => 'at25',
    ),
    "data" => array(
        //网站设置
        'eqaction_websetting' => 'at1',
        'eqaction_doadd' => 'at2',
        'eqaction_dodelweb' => 'at3',
        'eqaction_doedit' => 'at4',
        //友情链接
        'eqaction_friend' => 'at5',
        'eqaction_dodeletefriend' => 'at7',
        'eqaction_searchfriend' => 'att8',
        'eqaction_addfriend' => array(
            'at6' => array(
                'POST' => array(
                    "fid" => 'G_NOTSET',
                ),
            ),
            'at8' => array(
                'POST' => array(
                    "fid" => 'G_ISSET',
                ),
            ),
        ),
        //清除缓存
        'eqaction_cleanall' => 'at22',
        'eqaction_adminlog' => 'at23',
        'eqaction_dodeletelog' => 'at24',
        'eqaction_dodellogone' => 'at25', //删除近期一个月内的后台操作日志
    )
);
$acl_inc[$i]['low_leve']['ad'] = array("广告管理" => array(
        "列表" => 'ad1',
        "增加" => 'ad2',
        "删除" => 'ad4',
        "修改" => 'ad3',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'ad1',
        'eqaction_add' => 'ad2',
        'eqaction_doadd' => 'ad2',
        'eqaction_edit' => 'ad3',
        'eqaction_doedit' => 'ad3',
        'eqaction_swfupload' => 'ad3',
        'eqaction_dodel' => 'ad4',
		
    )
);

$acl_inc[$i]['low_leve']['loginonline'] = array("登陆接口管理" => array(
        "查看" => 'dl1',
        "修改" => 'dl2',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'dl1',
        'eqaction_save' => 'dl2',
    )
);
$acl_inc[$i]['low_leve']['auto'] = array("自动执行参数" => array(
        "查看" => "atjb1",
        "修改" => "atjb2",
        "开启程序" => "atjb3",
        "关闭程序" => "atjb4",
        "开启服务" => "atjb5",
        "卸载服务" => "atjb7",
        "当前运行状态" => "atjb6",
    ),
    "data" => array(
        "eqaction_index" => "atjb1",
        "eqaction_save" => "atjb2",
        "eqaction_start" => "atjb3",
        "eqaction_close" => "atjb4",
        "eqaction_startserver" => "atjb5",
        "eqaction_stopserver" => "atjb7",
        "eqaction_showstatus" => "atjb6",
    )
);

$i++;
$acl_inc[$i]['low_title'][] = '借款管理';
$acl_inc[$i]['low_leve']['borrow'] = array("初审待审核借款" => array(
        "列表" => 'br1',
        "审核" => 'br2',
    ),
    "复审待审核借款" => array(
        "列表" => 'br3',
        "审核" => 'br4',
    ),
    "招标中的借款" => array(
        "列表" => 'br5',
        "审核" => 'br6',
        "人工处理" => 'br8',
    ),
    "还款中的借款" => array(
        "列表" => 'br7',
        "一周内到期标" => 'br7',
        "投资记录" => 'br15',
		"修改" => 'br20',
    ),
    "已完成的借款" => array(
        "列表" => 'br9',
    ),
    "已流标借款" => array(
        "列表" => 'br11',
    ),
    "初审未通过的借款" => array(
        "列表" => 'br13',
    ),
    "复审未通过的借款" => array(
        "列表" => 'br14',
    ),
    "异常未满的借款" => array(
        "列表" => 'br16',
        "人工处理" => 'br17',
    ),
    "data" => array(
        //网站设置
        'eqaction_waitverify' => 'br1',
        'eqaction_edit' => 'br2',
        'eqaction_edit' => 'br4',
        'eqaction_edit' => 'br6',
        'eqaction_doeditwaitverify' => 'br2',
        'eqaction_waitverify2' => 'br3',
        'eqaction_doeditwaitverify2' => 'br4',
        'eqaction_waitmoney' => 'br5',
        'eqaction_doeditwaitmoney' => 'br6',
        'eqaction_repaymenting' => 'br7',
        'eqaction_doweek' => 'br7',
        'eqaction_done' => 'br9',
        'eqaction_unfinish' => 'br11',
        'eqaction_fail' => 'br13',
        'eqaction_fail2' => 'br14',
        'eqaction_swfupload' => 'br2',
        'eqaction_dowaitmoneycomplete' => 'br8',
        'eqaction_doinvest' => 'br15',
        'eqaction_borrowfull' => 'br16',
        'eqaction_domoneycomplete' => 'br17',
		'eqaction_doeditrepaymenting' => 'br20',
    )
);
$acl_inc[$i]['low_leve']['debt'] = array("债权转让" => array(
        '查看' => 'debt1',
        '审核' => 'debt2',
    ),
    "data" => array(
        'eqaction_index' => 'debt1',
        'eqaction_audit' => 'debt2',
    ),
);
$acl_inc[$i]['low_leve']['expired'] = array("逾期借款管理" => array(
        "查看" => 'yq1',
        "代还" => 'yq2',
    ),
    "逾期会员列表" => array(
        "列表" => 'yq3',
    ),
    "data" => array(
        'eqaction_index' => 'yq1',
        'eqaction_doexpired' => 'yq2',
        'eqaction_member' => 'yq3',
    )
);
$i++;
$acl_inc[$i]['low_title'][] = '企业直投管理';
$acl_inc[$i]['low_leve']['tborrow'] = array("企业直投管理" => array(
        "列表" => "tb1",
        "添加" => "tb2",
        "修改" => "tb3",
        "删除" => "tb6",
        "投资记录" => 'tb4',
        "流标" => 'tb7',),
    "data" => array(
        "eqaction_endtran" => "tb1",
        "eqaction_index" => "tb1",
        "eqaction_repayment" => "tb1",
        "eqaction_liubiaolist" => "tb1",
        "eqaction_getusername" => "tb2",
        "eqaction_swfupload" => "tb2",
        "eqaction_add" => "tb2",
        "eqaction_doadd" => "tb2",
        "eqaction_getusername" => "tb3",
        "eqaction_swfupload" => "tb3",
        "eqaction_edit" => "tb3",
        "eqaction_doedit" => "tb3",
        "eqaction_dodel" => "tb6",
        'eqaction_doinvest' => 'tb4',
        'eqaction_liubiao' => 'tb7',
    )
);
$i++;
$acl_inc[$i]['low_title'][] = '定投宝管理';
$acl_inc[$i]['low_leve']['fund'] = array("定投宝管理" => array( 
												"列表" => "fund1", 
												"添加" => "fund2", 
												"修改" => "fund3", 
												"删除" => "fund5",
												"投资记录" =>'fund4',),
										"data" => array( 
										"eqaction_endtran" => "fund1", 
										"eqaction_index" => "fund1", 
										"eqaction_repayment" => "fund1",
										"eqaction_getusername" => "fund2", 
										"eqaction_swfupload" => "fund2", 
										"eqaction_add" => "fund2", 
										"eqaction_doadd" => "fund2", 
										"eqaction_getusername" => "fund3", 
										"eqaction_swfupload" => "fund3", 
										"eqaction_edit" => "fund3", 
										"eqaction_doedit" => "fund3", 
										"eqaction_dodel" => "fund5",
										'eqaction_doinvest'  => 'fund4',
										)
);
$i++;



$acl_inc[$i]['low_title'][] = '自动投标会员';
$acl_inc[$i]['low_leve']['automembers'] = array("自动投标会员" => array(
        "列表" => "am1",
        "修改" => "am2",
        ),
    "data" => array(
        "eqaction_index" => 'am1',
        'eqaction_doedit' =>'am2',
    )
);
$i++;
$acl_inc[$i]['low_title'][] = '会员管理';
$acl_inc[$i]['low_leve']['members'] = array("会员列表" => array(
        "列表" => 'me1',
        "调整余额" => 'mx2',
        "调整授信" => 'mx3',
        "删除会员" => 'mxw',
        "修改客户类型" => 'xmxw',
    ),
    "会员资料" => array(
        "列表" => 'me3',
        "查看" => 'me4',
    ),
    "额度申请待审核" => array(
        "列表" => 'me7',
        "审核" => 'me6',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'me1',
        'eqaction_info' => 'me3',
        'eqaction_viewinfom' => 'me4',
        'eqaction_infowait' => 'me7',
        'eqaction_viewinfo' => 'me6',
        'eqaction_doeditcredit' => 'me6',
        'eqaction_domoneyedit' => 'mx2',
        'eqaction_moneyedit' => 'mx2',
        'eqaction_creditedit' => 'mx3',
        'eqaction_dodel' => 'mxw',
        'eqaction_edit' => 'xmxw',
        'eqaction_doedit' => 'xmxw',
        'eqaction_docreditedit' => 'mx3',
        'eqaction_idcardedit' => 'xmxw',
        'eqaction_doidcardedit' => 'xmxw',
        'eqaction_memberborrow' => 'xmxw',
        'eqaction_mb_export' => 'xmxw',
        'eqaction_transferborrow' => 'xmxw',
        'eqaction_trans_export' => 'xmxw',
    )
);
$acl_inc[$i]['low_leve']['common'] = array("会员详细资料" => array(
        "查询" => 'mex5',
        "账户通讯" => 'sms1',
        "具体通讯" => 'sms2',
        "节日通讯" => 'sms3',
        "通讯记录" => 'sms4',
    ),
    "data" => array(
        'eqaction_member' => 'mex5',
        'eqaction_sms' => 'sms1',
        'eqaction_sendsms' => 'sms2',
        'eqaction_sendgala' => 'sms3',
        'eqaction_smslog' => 'sms4',
    )
);
$acl_inc[$i]['low_leve']['refereedetail'] = array("推荐人管理" => array(
        "列表" => 'referee_1',
        "导出" => 'referee_2',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'referee_1',
        'eqaction_export' => 'referee_2',
    )
);
$acl_inc[$i]['low_leve']['jubao'] = array("举报信息" => array(
        "列表" => 'me5',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'me5',
    )
);

$i++;
$acl_inc[$i]['low_title'][] = '认证及申请管理';
$acl_inc[$i]['low_leve']['vipapply'] = array("VIP申请列表" => array(
        "列表" => 'vip1',
        "审核" => 'vip2',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'vip1',
        'eqaction_edit' => 'vip2',
        'eqaction_doedit' => 'vip2',
    )
);
$acl_inc[$i]['low_leve']['memberid'] = array("会员实名认证管理" => array(
        "列表" => 'me10',
        "审核" => 'me9',
        "导出" => 'me8',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'me10',
        'eqaction_edit' => 'me9',
        'eqaction_doedit' => 'me9',
        'eqaction_export' => 'me8',
    )
);
$acl_inc[$i]['low_leve']['memberdata'] = array("会员上传资料管理" => array(
        "列表" => 'dat1',
        "审核" => 'dat3',
        "上传资料" => 'dat4',
        "上传展示资料" => 'dat5',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'dat1',
        'eqaction_swfupload' => 'dat1',
        'eqaction_edit' => 'dat3',
        'eqaction_doedit' => 'dat3',
        'eqaction_upload' => 'dat4',
        'eqaction_doupload' => 'dat4',
        'eqaction_uploadshow' => 'dat5',
        'eqaction_douploadshow' => 'dat5',
    )
);
$acl_inc[$i]['low_leve']['verifyphone'] = array("手机认证会员" => array(
        "列表" => 'vphone1',
        "导出" => 'vphone2',
        "审核" => 'vphone3',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'vphone1',
        'eqaction_export' => 'vphone2',
        'eqaction_edit' => 'vphone3',
        'eqaction_doedit' => 'vphone3',
    )
);

//`mxl:teamreward`
//团队长管理
$i++;
$acl_inc[$i]['low_title'][] = '团队长管理';
$acl_inc[$i]['low_leve']['teamuser']= array( "团队长管理" =>array(
												 "列表" 		=> 'at77',
												 "增加" 		=> 'at78',
												 "删除" 		=> 'at79',
												 "上传头像"	=> 'at99',
												 "修改" 		=> 'at80',
												 "省市" 		=> 'at81',
												),
										   	  "data" => array(
										   		//权限管理
												'eqaction_index'  => 'at77',
												'eqaction_getarea'  => 'at81',
												'eqaction_dodelete'    => 'at79',
												'eqaction_header'    => 'at99',
												'eqaction_memberheaderuplad'    => 'at99',
												'eqaction_addadmin' =>array(
																'at78'=>array(//增加
																	'POST'=>array(
																		"uid"=>'G_NOTSET',
																	),
																 ),	
																'at80'=>array(//修改
																	'POST'=>array(
																		"uid"=>'G_ISSET',
																	),
																 ),	
												),
											)
							);
//经纪人管理
$i++;
$acl_inc[$i]['low_title'][] = '经纪人管理';
$acl_inc[$i]['low_leve']['broker']= array( "经纪人管理" =>array(
												 "列表" 		=> 'at77',
												 "增加" 		=> 'at78',
												 "删除" 		=> 'at79',
												 "上传头像"	=> 'at99',
												 "修改" 		=> 'at80',
												 "省市" 		=> 'at81',
												 "解除关系" 		=> 'at82',
												 "重置关系" 		=> 'at83',
												),
										   	  "data" => array(
										   		//权限管理
												'eqaction_index'  => 'at77',
												'eqaction_getarea'  => 'at81',
												'eqaction_relieve'  => 'at82',
												'eqaction_reset'  => 'at83',
												'eqaction_ajax_reset'  => 'at83',
												'eqaction_resetact'  => 'at83',
												'eqaction_dodelete'    => 'at79',
												'eqaction_header'    => 'at99',
												'eqaction_memberheaderuplad'    => 'at99',
												'eqaction_addadmin' =>array(
																'at78'=>array(//增加
																	'POST'=>array(
																		"uid"=>'G_NOTSET',
																	),
																 ),	
																'at80'=>array(//修改
																	'POST'=>array(
																		"uid"=>'G_ISSET',
																	),
																 ),	
												),
											)
							);
//投资人管理
$i++;
$acl_inc[$i]['low_title'][] = '投资人管理';
$acl_inc[$i]['low_leve']['investor']= array( "投资人管理" =>array(
												 "列表" 		=> 'at77',
												 "解除关系" 		=> 'at82',
												 "重置关系" 		=> 'at83',
												  "导出"     		=> 'at80',
												),
										   	  "data" => array(
										   		//权限管理
												'eqaction_index'  => 'at77',
												
												'eqaction_relieve'  => 'at82',
												'eqaction_reset'  => 'at83',
												'eqaction_ajax_reset'  => 'at83',
												'eqaction_resetact'  => 'at83',
												'eqaction_export'  => 'at80',
												
											)
							);
//经纪人提成统计管理
$i++;
$acl_inc[$i]['low_title'][] = '经纪人提成统计';
$acl_inc[$i]['low_leve']['brokermoney']= array( "经纪人提成统计" =>array(
												 "经纪人列表" 		=> 'at77',
												 "投资人列表" 		=> 'at79',
												  "导出"     		=> 'at80',
												),
										   	  "data" => array(
										   		//权限管理
												'eqaction_index'  => 'at77',
												'eqaction_investorlist'  => 'at79',
												'eqaction_listinvestor'  => 'at79',//`mxl:invlist`
												'eqaction_export'  => 'at80',
												
											)
							);
//团队长提成统计管理
$acl_inc[$i]['low_title'][] = '团队长提成统计';
$acl_inc[$i]['low_leve']['teammoney']= array( "团队长提成统计" =>array(
												 "团队长列表" 		=> 'at77',
												 "经纪人列表" 		=> 'at78',
												 "投资人列表" 		=> 'at79',
												 "导出"     			=> 'at80',
												),
										   	  "data" => array(
										   		//权限管理
												'eqaction_index'  => 'at77',
												'eqaction_brokerlist'  => 'at78',
												'eqaction_investorlist'  => 'at79',
												'eqaction_export'  => 'at80',
												
											)
							);
//权限管理
//`mxl:teamreward`

$i++;
$acl_inc[$i]['low_title'][] = '积分管理';
$acl_inc[$i]['low_leve']['market'] = array("投资积分管理" => array(
        "投资积分操作记录" => 'mk0',
        "获取列表" => 'mk1',
        "获取操作" => 'mk2',
        "商城商品列表" => 'mk3',
        "商品操作" => 'mk4',
        "上传商品图片" => 'mk5',
    ),
    "抽奖管理" => array(
        "列表" => 'mk6',
        "编辑" => 'mk7',
        "删除" => 'mk8',
    ),
    "评论管理" => array(
        "列表" => 'mkcom1',
        "查看" => 'mkcom2',
        "删除" => 'mkcom3',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'mk0',
        'eqaction_getlog' => 'mk1',
        'eqaction_getlog_edit' => 'mk2',
        'eqaction_dologedit' => 'mk2',
        'eqaction_goods' => 'mk3',
        'eqaction_good_edit' => 'mk4',
        'eqaction_dogoodedit' => 'mk4',
        'eqaction_good_del' => 'mk4',
        'eqaction_lottery' => 'mk6',
        'eqaction_lottery_edit' => 'mk7',
        'eqaction_dolotteryedit' => 'mk7',
        'eqaction_lottery_del' => 'mk8',
        'eqaction_upload_shop_pic' => 'mk5',
        'eqaction_comment' => 'mkcom1',
        'eqaction_dodel' => 'mkcom3',
        'eqaction_edit' => 'mkcom2',
        'eqaction_doedit' => 'mkcom2',
    )
);

$i++;
$acl_inc[$i]['low_title'][] = '充值提现';
$acl_inc[$i]['low_leve']['paylog'] = array("充值记录" => array(
        "列表" => 'cz',
        "充值处理" => 'czgl',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'cz',
        'eqaction_paylogonline' => 'cz',
        'eqaction_paylogoffline' => 'cz',
        'eqaction_edit' => 'czgl',
        'eqaction_doedit' => 'czgl'
    )
);
$acl_inc[$i]['low_leve']['withdrawlog'] = array("提现管理" => array(
        "列表" => 'cg2',
        "审核" => 'cg3',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'cg2',
        'eqaction_edit' => 'cg3',
        'eqaction_doedit' => 'cg3',
        'eqaction_withdraw0' => 'cg2', //待提现      新增加2012-12-02 fanyelei
        'eqaction_withdraw1' => 'cg2', //提现处理中	新增加2012-12-02 fanyelei
        'eqaction_withdraw2' => 'cg2', //提现成功		新增加2012-12-02 fanyelei
        'eqaction_withdraw3' => 'cg2', //提现失败		新增加2012-12-02 fanyelei
    )
);
$acl_inc[$i]['low_title'][] = '待提现列表';
$acl_inc[$i]['low_leve']['withdrawlogwait'] = array("待提现列表" => array(
        "列表" => 'cg4',
        "审核" => 'cg5',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'cg4',
        'eqaction_edit' => 'cg5',
        'eqaction_doedit' => 'cg5',
    )
);
$acl_inc[$i]['low_title'][] = '提现处理中列表';
$acl_inc[$i]['low_leve']['withdrawloging'] = array("提现处理中列表" => array(
        "列表" => 'cg6',
        "审核" => 'cg7',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'cg6',
        'eqaction_edit' => 'cg7',
        'eqaction_doedit' => 'cg7',
    )
);

$i++;
$acl_inc[$i]['low_title'][] = '文章管理';
$acl_inc[$i]['low_leve']['article'] = array("文章管理" => array(
        "列表" => 'at1',
        "添加" => 'at2',
        "删除" => 'at3',
        "修改" => 'at4',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'at1',
        'eqaction_add' => 'at2',
        'eqaction_doadd' => 'at2',
        'eqaction_dodel' => 'at3',
        'eqaction_edit' => 'at4',
        'eqaction_doedit' => 'at4',
    )
);
$acl_inc[$i]['low_leve']['acategory'] = array("文章分类" => array(
        "列表" => 'act1',
        "添加" => 'act2',
        "批量添加" => 'act5',
        "删除" => 'act3',
        "修改" => 'act4',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'act1',
        'eqaction_listtype' => 'act1',
        'eqaction_add' => 'act2',
        'eqaction_doadd' => 'act2',
        'eqaction_dodel' => 'act3',
        'eqaction_edit' => 'act4',
        'eqaction_doedit' => 'act4',
        'eqaction_addmultiple' => 'act5',
        'eqaction_doaddmul' => 'act5',
    )
);
$i++;
$acl_inc[$i]['low_title'][] = '论坛管理';
$acl_inc[$i]['low_leve']['bbs']= array( "论坛管理" =>array(
		 "分类列表" 		=> 'lt1',
		 "分类修改" 		=> 'lt2',

		 "帖子列表" 		=> 'lt3',
		 "帖子修改" 		=> 'lt4',

		 "回复列表" 		=> 'lt5',
		 "回复修改" 		=> 'lt6',
		),
   "data" => array(
			//网站设置
			'eqaction_type'  => 'lt1',
			'eqaction_listtype'  => 'lt1',
			'eqaction_addtype'  => 'lt2',
			'eqaction_edittype'  => 'lt2',
			'eqaction_doedittype'  => 'lt2',
			'eqaction_deltype'  => 'lt2',

			'eqaction_index'  => 'lt3',
			'eqaction_add'  => 'lt4',
			'eqaction_edit'  => 'lt4',
			'eqaction_doedit'  => 'lt4',
			'eqaction_del'  => 'lt4',

			'eqaction_repay'  => 'lt5',
			'eqaction_addrepay'  => 'lt6',
			'eqaction_editrepay'  => 'lt6',
			'eqaction_doeditrepay'  => 'lt6',
			'eqaction_delrepay'  => 'lt6',
		)
);
$i++;
$acl_inc[$i]['low_title'][] = '导航菜单管理';
$acl_inc[$i]['low_leve']['navigation'] = array("导航菜单" => array(
        "列表" => 'nav1',
        "添加" => 'nav2',
        "批量添加" => 'nav5',
        "删除" => 'nav3',
        "修改" => 'nav4',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'nav1',
        'eqaction_listtype' => 'nav1',
        'eqaction_add' => 'nav2',
        'eqaction_doadd' => 'nav2',
        'eqaction_dodel' => 'nav3',
        'eqaction_edit' => 'nav4',
        'eqaction_doedit' => 'nav4',
        'eqaction_addmultiple' => 'nav5',
        'eqaction_doaddmul' => 'nav5',
    )
);
$i++;
$acl_inc[$i]['low_title'][] = '快捷借款管理';
$acl_inc[$i]['low_leve']['feedback'] = array("快捷借款管理" => array(
        "列表" => 'msg1',
        "查看" => 'msg2',
        "删除" => 'msg3',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'msg1',
        'eqaction_dodel' => 'msg3',
        'eqaction_edit' => 'msg2',
    )
);
$i++;
$acl_inc[$i]['low_title'][] = '资金统计';
$acl_inc[$i]['low_leve']['capitalaccount'] = array("会员帐户" => array(
        "列表" => 'capital_1',
        "导出" => 'capital_2',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'capital_1',
        'eqaction_export' => 'capital_2',
    )
);
$acl_inc[$i]['low_leve']['capitalrepay'] = array("直投待还资金统计" => array(
        "查看" => 'capitalrepay_1',
        "导出" => 'capitalrepay_2',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'capitalrepay_1',
        'eqaction_export' => 'capitalrepay_2',
    )
);
$acl_inc[$i]['low_leve']['capitalonline'] = array("充值记录" => array(
        "列表" => 'capital_3',
        "导出" => 'capital_4',
    ),
    "提现记录" => array(
        "列表" => 'capital_5',
        "导出" => 'capital_6',
    ),
    "data" => array(
        //网站设置
        'eqaction_charge' => 'capital_3',
        'eqaction_withdraw' => 'capital_5',
        'eqaction_chargeexport' => 'capital_4',
        'eqaction_withdrawexport' => 'capital_6',
    )
);
$acl_inc[$i]['low_leve']['remark'] = array("备注信息" => array(
        "列表" => 'rm1',
        "增加" => 'rm2',
        "修改" => 'rm3',
    ),
    "data" => array(
        'eqaction_index' => 'rm1',
        'eqaction_add' => 'rm2',
        'eqaction_doadd' => 'rm2',
        'eqaction_edit' => 'rm3',
        'eqaction_doedit' => 'rm3',
    )
);
$acl_inc[$i]['low_leve']['capitaldetail'] = array("会员资金记录" => array(
        "列表" => 'capital_7',
        "导出" => 'capital_8',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'capital_7',
        'eqaction_export' => 'capital_8',
    )
);
$acl_inc[$i]['low_leve']['capitaldetail'] = array("会员资金记录" => array(
        "列表" => 'capital_7',
        "导出" => 'capital_8',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'capital_7',
        'eqaction_export' => 'capital_8',
    )
);
$acl_inc[$i]['low_leve']['capitalall'] = array("网站资金统计" => array(
        "查看" => 'capital_9',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'capital_9',
    )
);
$acl_inc[$i]['low_leve']['tender'] = array("会员投标记录" => array(
        "散标列表" => 'capital_10',
        "散标导出" => 'capital_11',
        "直投列表" => 'capital_12',
        "直投导出" => 'capital_13',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'capital_10',
        'eqaction_export' => 'capital_11',
        'eqaction_transfer' => 'capital_12',
        'eqaction_transfer_export' => 'capital_13',
    )
);
$acl_inc[$i]['low_leve']['capitalrank'] = array("会员投资排行" => array(
        "列表" => 'capital_11',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'capital_11',
    )
);
//权限管理
$i++;
$acl_inc[$i]['low_title'][] = '权限管理';
$acl_inc[$i]['low_leve']['acl'] = array("权限管理" => array(
        "列表" => 'at73',
        "增加" => 'at74',
        "删除" => 'at75',
        "修改" => 'at76',
    ),
    "data" => array(
        //权限管理
        'eqaction_index' => 'at73',
        'eqaction_doadd' => 'at74',
        'eqaction_add' => 'at74',
        'eqaction_dodelete' => 'at75',
        'eqaction_doedit' => 'at76',
        'eqaction_edit' => 'at76',
    )
);
//管理员管理
$i++;
$acl_inc[$i]['low_title'][] = '管理员管理';
$acl_inc[$i]['low_leve']['adminuser'] = array("管理员管理" => array(
        "列表" => 'at77',
        "增加" => 'at78',
        "删除" => 'at79',
        "上传头像" => 'at99',
        "修改" => 'at80',
    ),
    "data" => array(
        //权限管理
        'eqaction_index' => 'at77',
        'eqaction_dodelete' => 'at79',
        'eqaction_header' => 'at99',
        'eqaction_memberheaderuplad' => 'at99',
        'eqaction_addadmin' => array(
            'at78' => array(//增加
                'POST' => array(
                    "uid" => 'G_NOTSET',
                ),
            ),
            'at80' => array(//修改
                'POST' => array(
                    "uid" => 'G_ISSET',
                ),
            ),
        ),
    )
);
//权限管理
$i++;
$acl_inc[$i]['low_title'][] = '数据库管理';
$acl_inc[$i]['low_leve']['db'] = array("数据库信息" => array(
        "查看" => 'db1',
        "备份" => 'db2',
        "查看表结构" => 'db3',
        "优化" => 'db9',
        "一键优化" => 'db10',
    ),
    "数据库备份管理" => array(
        "备份列表" => 'db4',
        "删除备份" => 'db5',
        "恢复备份" => 'db6',
        "打包下载" => 'db7',
    ),
    "清空数据" => array(
        "清空数据" => 'db8',
    ),
    "data" => array(
        //权限管理
        'eqaction_index' => 'db1',
        'eqaction_set' => 'db2',
        'eqaction_backup' => 'db2',
        'eqaction_showtable' => 'db3',
        'eqaction_baklist' => 'db4',
        'eqaction_delbak' => 'db5',
        'eqaction_restore' => 'db6',
        'eqaction_dozip' => 'db7',
        'eqaction_downzip' => 'db7',
        'eqaction_truncate' => 'db8',
        'eqaction_optimize' => 'db9',
        'eqaction_optimize_all' => 'db10',
    )
);
$i++;
$acl_inc[$i]['low_title'][] = '图片上传';
$acl_inc[$i]['low_leve']['kissy'] = array("图片上传" => array(
        "图片上传" => 'at81',
    ),
    "data" => array(
        //权限管理
        'eqaction_index' => 'at81',
    )
);


$i++;
$acl_inc[$i]['low_title'][] = '扩展管理';
$acl_inc[$i]['low_leve']['data']= array( "数据检测" =>array(
												 "待还、待收查询" => 'er6',
												 "充值资金操作重复" => 'er1',
												 "问题借款" 		=> 'er3',
												 "标的数量统计" 	=> 'er4',
												),
										   "data" => array(
												'eqaction_collect'  	=> 'er6',
												'eqaction_paytwo'  		=> 'er1',
												'eqaction_investover'  => 'er3',
												'eqaction_biaonum'  => 'er4',
											)
							);
$acl_inc[$i]['low_leve']['scan']= array( "安全检测" =>array(
                                                 "安全检测"         => 'scan1',
                                                ),
                                                 "data" => array(
                                                   //权限管理
                                                'eqaction_index'  => 'scan1',
                                                'eqaction_scancom'=>'scan1',
                                                'eqaction_updateconfig'=>'scan1',
                                                'eqaction_filefilter'  => 'scan1',
                                                'eqaction_filefunc' =>'scan1',
                                                'eqaction_filecode' =>'scan1',
                                                'eqaction_scanreport'=>'scan1',
                                                'eqaction_view'=>'scan1',
                                              )
                            );

$acl_inc[$i]['low_leve']['scan'] = array("安全检测" => array(
        "安全检测" => 'scan1',
    ),
    "data" => array(
        //权限管理
        'eqaction_index' => 'scan1',
        'eqaction_scancom' => 'scan1',
        'eqaction_updateconfig' => 'scan1',
        'eqaction_filefilter' => 'scan1',
        'eqaction_filefunc' => 'scan1',
        'eqaction_filecode' => 'scan1',
        'eqaction_scanreport' => 'scan1',
        'eqaction_view' => 'scan1',
    )
);
$acl_inc[$i]['low_leve']['mfields'] = array("文件管理" => array(
        "文件管理" => 'at82',
        "空间检查" => 'at83',
    ),
    "data" => array(
        //文件管理
        'eqaction_index' => 'at82',
        'eqaction_checksize' => 'at83',
    )
);

$acl_inc[$i]['low_leve']['bconfig'] = array("业务参数管理" => array(
        "查看" => 'fb1',
        "修改" => 'fb2',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'fb1',
        'eqaction_save' => 'fb2',
    )
);
$acl_inc[$i]['low_leve']['leve'] = array("信用级别管理" => array(
        "查看" => 'jb1',
        "修改" => 'jb2',
    ),
    "投资级别管理" => array(
        "查看" => 'jb3',
        "修改" => 'jb4',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'jb1',
        'eqaction_save' => 'jb2',
        'eqaction_invest' => 'jb3',
        'eqaction_investsave' => 'jb4',
    )
);
$acl_inc[$i]['low_leve']['age'] = array("会员年龄别称" => array(
        "查看" => 'bc1',
        "修改" => 'bc2',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'bc1',
        'eqaction_save' => 'bc2',
    )
);
$acl_inc[$i]['low_leve']['hetong'] = array("合同居间方资料上传管理" => array(
        "查看" => 'ht1',
        "上传" => 'ht2',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'ht1',
        'eqaction_upload' => 'ht2',
    )
);
$acl_inc[$i]['low_title'][] = '在线客服管理';
$acl_inc[$i]['low_leve']['qq'] = array("QQ客服管理" => array(
        "列表" => 'qq5',
        "增加" => 'qq6',
        "删除" => 'qq7',
    ),
    "QQ群管理" => array(
        "列表" => 'qun5',
        "增加" => 'qun6',
        "删除" => 'qun7',
    ),
    "客服电话管理" => array(
        "列表" => 'tel5',
        "增加" => 'tel6',
        "删除" => 'tel7',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'qq5',
        'eqaction_addqq' => 'qq6',
        'eqaction_dodeleteqq' => 'qq7',
        'eqaction_qun' => 'qun5',
        'eqaction_addqun' => 'qun6',
        'eqaction_dodeletequn' => 'qun7',
        'eqaction_tel' => 'tel5',
        'eqaction_addtel' => 'tel6',
        'eqaction_dodeletetel' => 'tel7',
    )
);

//$acl_inc[$i]['low_title'][] = '在线通知管理';
$acl_inc[$i]['low_leve']['payonline'] = array("线上支付接口管理" => array(
        "查看" => 'jk1',
        "修改" => 'jk2',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'jk1',
        'eqaction_save' => 'jk2',
    )
);
$acl_inc[$i]['low_leve']['payoffline'] = array("线下充值银行管理" => array(
        "查看" => 'offline1',
        "修改" => 'offline2',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'offline1',
        'eqaction_saveconfig' => 'offline2',
    )
);
$acl_inc[$i]['low_leve']['msgonline'] = array("通知信息接口管理" => array(
        "查看" => 'jk3',
        "修改" => 'jk4',
    ),
    "通知信息模板管理" => array(
        "查看" => 'jk5',
        "修改" => 'jk6',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'jk3',
        'eqaction_save' => 'jk4',
        'eqaction_templet' => 'jk5',
        'eqaction_templetsave' => 'jk6',
    )
);

$acl_inc[$i]['low_leve']['baidupush'] = array("百度云推送" => array(
        "首页" => 'bd27',
        "消息推送" => 'bd26',
    ),
    "data" => array(
        //网站设置
        'eqaction_index' => 'bd27',
        'eqaction_push_message_android' => 'bd26',
    )
);
?>
