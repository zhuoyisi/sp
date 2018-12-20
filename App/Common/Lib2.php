<?php
function EnHtml( $v ) 
{
	return $v;
}
function mydate( $format, $time, $default = "" ) 
{
	if ( 10000 < intval( $time ) ) 
	{
		return date( $format, $time );
	}
	else 
	{
		return $default;
	}
}
function textPost( $data ) 
{
	if ( is_array( $data ) ) 
	{
		foreach ( $data as $key => $v ) 
		{
			$x[$key] = text( $v );
		}
	}
	return $x;
}
function MU($url,$type,$vars=array(),$domain=false){
	//获得基础地址START
	$path = explode("/",trim($url,"/"));
	$model = strtolower($path[1]);
	$action = isset($path[2])?strtolower($path[2]):"";
	//获得基础地址START
	//获取前缀根目录及分组
	$http = UD($path,$domain);
	//获取前缀根目录及分组
	switch($type){
		case "article":
		default:
			if(!isset($vars['id'])){//特殊栏目,用nid来区分,不用ID
				unset($path[0]);//去掉分组名
				$url = implode("/",$path)."/";
				$newurl=$url;
			}else{//普通栏目,带ID
				if(1==1||strtolower(GROUP_NAME) == strtolower(C('DEFAULT_GROUP'))) {//如果是默认分组则去掉分组名
					unset($path[0]);//去掉分组名
					$url = implode("/",$path)."/";
				}
				$newurl=$url.$vars['id'].$vars['suffix'];
			}
		break;
		case "typelist":
				if(1==1||strtolower(GROUP_NAME) == strtolower(C('DEFAULT_GROUP'))) {//如果是默认分组则去掉分组名
					unset($path[0]);//去掉分组名
					$url = implode("/",$path);
				}
				$newurl=$url.$vars['suffix'];
		break;
	}
	
	return $http.$newurl;
	
}
function UD( $url = array( ), $domain = false ) 
{
	$isDomainGroup = true;
	$isDomainD = false;
	$asdd =C("APP_SUB_DOMAIN_DEPLOY" );
	if ( $asdd ) 
	{
		foreach (C("APP_SUB_DOMAIN_RULES" ) as $keyr => $ruler ) 
		{
			if ( strtolower( $url[0]."/" ) == strtolower( $ruler[0] ) ) 
			{
				$isDomainGroup = true;
				$isDomainD = true;
				break;
			}
		}
	}
	if ( strtolower( GROUP_NAME ) == strtolower(C("DEFAULT_GROUP" ) ) ) 
	{
		$isDomainGroup = true;
	}
	if ( $domain === true ) 
	{
		$domain = $_SERVER['HTTP_HOST'];
		if ( $asdd ) 
		{
			$xdomain = explode( ".", $_SERVER['HTTP_HOST'] );
			if ( !isset( $xdomain[2] ) ) 
			{
				$ydomain = "www.".$_SERVER['HTTP_HOST'];
			}
			else 
			{
				$ydomain = $_SERVER['HTTP_HOST'];
			}
			$domain = $domain == "localhost" ? "localhost" : "www".strstr( $ydomain, "." );
			foreach (C("APP_SUB_DOMAIN_RULES" ) as $key => $rule ) 
			{
				if ( false === strpos( $key, "*" ) && $isDomainD ) 
				{
					$domain = $key.strstr( $domain, "." );
					$url = substr_replace( $url, "", 0, strlen( $rule[0] ) );
					break;
				}
			}
		}
	}
	if ( !$isDomainGroup ) 
	{
		$gpurl = __APP__."/".$url[0]."/";
	}
	else 
	{
		$gpurl = __APP__."/";
	}
	if ( $domain ) 
	{
		$url = "http://".$domain.$gpurl;
	}
	else 
	{
		$url = $gpurl;
	}
	return $url;
}
function Mheader( $type ) 
{
	header( "Content-Type:text/html;charset={$type}
" );
}
function auto_charset( $fContents, $from = "gbk", $to = "utf-8" ) 
{
$from = strtoupper( $from ) == "UTF8" ? "utf-8" : $from;
$to = strtoupper( $to ) == "UTF8" ? "utf-8" : $to;
if ( $to == "utf-8" && is_utf8( $fContents ) || strtoupper( $from ) === strtoupper( $to ) || empty( $fContents ) || is_scalar( $fContents ) && !is_string( $fContents ) ) 
{
	return $fContents;
}
if ( is_string( $fContents ) ) 
{
	if ( function_exists( "mb_convert_encoding" ) ) 
	{
		return mb_convert_encoding( $fContents, $to, $from );
	}
	else if ( function_exists( "iconv" ) ) 
	{
		return iconv( $from, $to, $fContents );
	}
	else 
	{
		return $fContents;
	}
}
else if ( is_array( $fContents ) ) 
{
	foreach ( $fContents as $key => $val ) 
	{
		$_key = auto_charset( $key, $from, $to );
		$fContents[$_key] = auto_charset( $val, $from, $to );
		if ( $key != $_key ) 
		{
			unset( $fContents[$key] );
		}
	}
	return $fContents;
}
else 
{
	return $fContents;
}
}
function is_utf8($string) {
	return preg_match('%^(?:
		 [\x09\x0A\x0D\x20-\x7E]            # ASCII
	   | [\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte
	   |  \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
	   | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte
	   |  \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
	   |  \xF0[\x90-\xBF][\x80-\xBF]{2}     # planes 1-3
	   | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
	   |  \xF4[\x80-\x8F][\x80-\xBF]{2}     # plane 16
   )*$%xs', $string);
}


function get_date($date,$t='d',$n=0){
	if($t=='d'){
		$firstday = date('Y-m-d 00:00:00',strtotime("$n day"));
		$lastday = date("Y-m-d 23:59:59",strtotime("$n day"));
	}elseif($t=='w'){
		if($n!=0){$date = date('Y-m-d',strtotime("$n week"));}
		$lastday = date("Y-m-d 00:00:00",strtotime("$date Sunday"));
		$firstday = date("Y-m-d 23:59:59",strtotime("$lastday -6 days"));
	}elseif($t=='m'){
		if($n!=0){
			if(date("m",time())==1) $date = date('Y-m-d',strtotime("$n months -1 day"));//2特殊的2月份
			else $date = date('Y-m-d',strtotime("$n months"));
		}
		
		$firstday = date("Y-m-01 00:00:00",strtotime($date));
		$lastday = date("Y-m-d 23:59:59",strtotime("$firstday +1 month -1 day"));
	}
	return array($firstday,$lastday);

}
function rand_string( $ukey = "", $len = 6, $type = "1", $utype = "1", $addChars = "" ) 
{
$str = "";
switch ( $type ) 
{
case 0 : $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz".$addChars;
break;
case 1 : $chars = str_repeat( "0123456789", 3 );
break;
case 2 : $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ".$addChars;
break;
case 3 : $chars = "abcdefghijklmnopqrstuvwxyz".$addChars;
break;
default : $chars = "ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789".$addChars;
break;
}
if ( 10 < $len ) 
{
$chars = $type == 1 ? str_repeat( $chars, $len ) : str_repeat( $chars, 5 );
}
$chars = str_shuffle( $chars );
$str = substr( $chars, 0, $len );
if ( !empty( $ukey ) ) 
{
$vd['code'] = $str;
$vd['send_time'] = time( );
$vd['ukey'] = $ukey;
$vd['type'] = $utype;
M( "verify" )->add( $vd );
}
return $str;
}
function is_verify( $uid, $code, $utype, $timespan )
{
    if ( !empty( $uid ) )
    {
        $vd['ukey'] = $uid;
    }
    $vd['type'] = $utype;
    $vd['send_time'] = array( "lt", time() + $timespan );
    $vd['code'] = $code;
    $vo = M( "verify" )->field( "ukey" )->where( $vd )->find( );
    if ( is_array( $vo ) )
    {
        return $vo['ukey'];
    }
    else
    {
        return false;
    }
}
function get_global_setting( ) 
{
$list = array( );
if ( !S( "global_setting" ) ) 
{
$list_t =M("global" )->field( "code,text" )->select( );
foreach ( $list_t as $key => $v ) 
{
$list[trim( $v['code'] )] = de_xie( $v['text'] );
}
S( "global_setting", $list );
S( "global_setting", $list, 3600 *C("TTXF_TMP_HOUR" ) );
}
else 
{
$list =S("global_setting" );
}
return $list;
}
function get_user_acl( $uid = "" ) 
{
$model = strtolower( MODULE_NAME );
if (empty($uid)) 
{
return false;
}
$gid =M("ausers" )->field( "u_group_id" )->find( $uid );
$al = get_group_data( $gid['u_group_id'] );
$acl = $al['controller'];
$acl_key = acl_get_key( );
if ( array_keys( $acl[$model], $acl_key ) ) 
{
return true;
}
else 
{
return false;
}
}
function get_group_data( $gid = 0 ) 
{
$gid = intval( $gid );
$list = array( );
if ( $gid == 0 ) 
{
if ( !S( "ACL_all" ) ) 
{
$_acl_data =M("acl" )->select( );
$acl_data = array( );
foreach ( $_acl_data as $key => $v ) 
{
$acl_data[$v['group_id']] = $v;
$acl_data[$v['group_id']]['controller'] = unserialize( $v['controller'] );
}
S( "ACL_all", $acl_data,C("ADMIN_CACHE_TIME" ) );
$list = $acl_data;
}
else 
{
$list =S("ACL_all" );
}
}
else if ( !S( "ACL_".$gid ) ) 
{
$_acl_data =M("acl" )->find( $gid );
$_acl_data['controller'] = unserialize( $_acl_data['controller'] );
$acl_data = $_acl_data;
S( "ACL_".$gid, $acl_data,C("ADMIN_CACHE_TIME" ) );
$list = $acl_data;
}
else 
{
$list =S("ACL_".$gid );
}
return $list;
}
function rmdirr( $dirname ) 
{
if ( !file_exists( $dirname ) ) 
{
return false;
}
if ( is_file( $dirname ) || is_link( $dirname ) ) 
{
return unlink( $dirname );
}
$dir = dir( $dirname );
while ( false !== ( $entry = $dir->read( ) ) ) 
{
if ( $entry == "." || $entry == ".." ) 
{
continue;
}
rmdirr( $dirname.DIRECTORY_SEPARATOR.$entry );
}
$dir->close( );
return rmdir( $dirname );
}
function Rmall( $dirname ) 
{
if ( !file_exists( $dirname ) ) 
{
return false;
}
if ( is_file( $dirname ) || is_link( $dirname ) ) 
{
return unlink( $dirname );
}
$dir = dir( $dirname );
while ( false !== ( $file = $dir->read( ) ) ) 
{
if ( $file == "." || $file == ".." ) 
{
continue;
}
if ( !is_dir( $dirname."/".$file ) ) 
{
unlink( $dirname."/".$file );
}
else 
{
rmall( $dirname."/".$file );
}
rmdir( $dirname."/".$file );
}
$dir->close( );
rmdir( $dirname );
return true;
}
function ReadFiletext( $filepath ) 
{
$htmlfp = @fopen( $filepath, "r" );
while ( $data = @fread( $htmlfp, 1000 ) ) 
{
$string .= $data;
}
@fclose( $htmlfp );
return $string;
}
function MakeFile( $con, $filename ) 
{
makedir( dirname( $filename ) );
$fp = fopen( $filename, "w" );
fwrite( $fp, $con );
fclose( $fp );
}
function MakeDir( $dir ) 
{
return is_dir( $dir ) || makedir( dirname( $dir ) ) && mkdir( $dir, 511 );
}
function get_home_friend( $type, $datas = array( ) ) 
{
$condition['is_show'] = array( "eq", 1 );
$condition['link_type'] = array( "eq", $type );
$type = "friend_home".$type;
if ( !S( $type ) ) 
{
$_list =M("friend" )->field( "link_txt,link_href,link_img,link_type" )->where( $condition )->order( "link_order DESC" )->select( );
$list = array( );
foreach ( $_list as $key => $v ) 
{
$list[$key] = $v;
}
S( $type, $list, 3600 *C("HOME_CACHE_TIME" ) );
}
else 
{
$list =S($type );
}
return $list;
}
function get_type_leve( $id = "0" ) 
{
$model = D( "Acategory" );
if ( !S( "type_son_type" ) ) 
{
$allid = array( );
$data = $model->field( "id,type_nid" )->where( "parent_id = {$id}
" )->select( );
if ( 0 < count( $data ) ) 
{
foreach ( $data as $v ) 
{
$allid[$v['type_nid']] = $v['id'];
$data_1 = array( );
$data_1 = $model->field( "id,type_nid" )->where( "parent_id = {$v['id']}
" )->select( );
if ( 0 < count( $data_1 ) ) 
{
foreach ( $data_1 as $v1 ) 
{
$allid[$v['type_nid']."-".$v1['type_nid']] = $v1['id'];
$data_2 = array( );
$data_2 = $model->field( "id,type_nid" )->where( "parent_id = {$v1['id']}
" )->select( );
if ( 0 < count( $data_2 ) ) 
{
foreach ( $data_2 as $v2 ) 
{
$allid[$v['type_nid']."-".$v1['type_nid']."-".$v2['type_nid']] = $v2['id'];
$data_3 = array( );
$data_3 = $model->field( "id,type_nid" )->where( "parent_id = {$v2['id']}
" )->select( );
if ( 0 < count( $data_3 ) ) 
{
foreach ( $data_3 as $v3 ) 
{
$allid[$v['type_nid']."-".$v1['type_nid']."-".$v2['type_nid']."-".$v3['type_nid']] = $v3['id'];
}
}
}
}
}
}
}
}
S( "type_son_type", $allid, 3600 *C("HOME_CACHE_TIME" ) );
}
else 
{
$allid =S("type_son_type" );
}
return $allid;
}
function get_area_type_leve( $id = "0", $area_id = 0 ) 
{
$model = D( "Aacategory" );
if ( !S( "type_son_type_area".$area_id ) ) 
{
$allid = array( );
$data = $model->field( "id,type_nid" )->where( "parent_id = {$id}
AND area_id={$area_id}
" )->select( );
if ( 0 < count( $data ) ) 
{
foreach ( $data as $v ) 
{
$allid[$area_id.$v['type_nid']] = $v['id'];
$data_1 = array( );
$data_1 = $model->field( "id,type_nid" )->where( "parent_id = {$v['id']}
" )->select( );
if ( 0 < count( $data_1 ) ) 
{
foreach ( $data_1 as $v1 ) 
{
$allid[$area_id.$v['type_nid']."-".$v1['type_nid']] = $v1['id'];
$data_2 = array( );
$data_2 = $model->field( "id,type_nid" )->where( "parent_id = {$v1['id']}
" )->select( );
if ( 0 < count( $data_2 ) ) 
{
foreach ( $data_2 as $v2 ) 
{
$allid[$area_id.$v['type_nid']."-".$v1['type_nid']."-".$v2['type_nid']] = $v2['id'];
$data_3 = array( );
$data_3 = $model->field( "id,type_nid" )->where( "parent_id = {$v2['id']}
" )->select( );
if ( 0 < count( $data_3 ) ) 
{
foreach ( $data_3 as $v3 ) 
{
$allid[$area_id.$v['type_nid']."-".$v1['type_nid']."-".$v2['type_nid']."-".$v3['type_nid']] = $v3['id'];
}
}
}
}
}
}
}
}
S( "type_son_type_area".$area_id, $allid, 3600 *C("HOME_CACHE_TIME" ) );
}
else 
{
$allid =S("type_son_type_area".$area_id );
}
return $allid;
}
function get_type_leve_nid( $id = "0" ) 
{
if ( empty( $id ) ) 
{
return;
}
global $allid;
static $r = array( );
get_type_leve_nid_run( $id );
$r = $allid;
$GLOBALS['allid'] = NULL;
return array_reverse( $r );
}
function get_type_leve_nid_run( $id = "0" ) 
{
global $allid;
$data_parent = $data = "";
$data = D( "Acategory" )->field( "parent_id,type_nid" )->find( $id );
$data_parent = D( "Acategory" )->field( "id,type_nid" )->where( "id = {$data['parent_id']}
" )->find( );
if ( 0 < isset( $data_parent['type_nid'] ) ) 
{
if ( !isset( $allid[0] ) ) 
{
$allid[] = $data['type_nid'];
}
$allid[] = $data_parent['type_nid'];
get_type_leve_nid_run( $data_parent['id'] );
}
else if ( !isset( $allid[0] ) ) 
{
$allid[] = $data['type_nid'];
}
}
function get_type_leve_area_nid( $id = "0", $area_id = 0 ) 
{
if ( empty( $id ) || empty( $area_id ) ) 
{
return;
}
global $allid_area;
static $r = array( );
get_type_leve_area_nid_run( $id );
$r = $allid_area;
$GLOBALS['allid_area'] = NULL;
return array_reverse( $r );
}
function get_type_leve_area_nid_run( $id = "0" ) 
{
global $allid_area;
$data_parent = $data = "";
$data = D( "Aacategory" )->field( "parent_id,type_nid,area_id" )->find( $id );
$data_parent = D( "Aacategory" )->field( "id,type_nid,area_id" )->where( "id = {$data['parent_id']}
" )->find( );
if ( 0 < isset( $data_parent['type_nid'] ) ) 
{
if ( !isset( $allid_area[0] ) ) 
{
$allid_area[] = $data['type_nid'];
}
$allid_area[] = $data_parent['type_nid'];
get_type_leve_area_nid_run( $data_parent['id'] );
}
else if ( !isset( $allid_area[0] ) ) 
{
$allid_area[] = $data['type_nid'];
}
}
function get_son_type( $id ) 
{
$tempname = "type_sfs_son_all".$id;
if ( !S( $tempname ) ) 
{
$row = get_son_type_run( $id );
S( $tempname, $row, 3600 *C("HOME_CACHE_TIME" ) );
}
else 
{
$row =S($tempname );
}
return $row;
}
function get_son_type_run( $id ) 
{
static $rerow = NULL;
global $allid;
$data =M("type" )->field( "id" )->where( "parent_id in ({$id}
)" )->select( );
if ( 0 < count( $data ) ) 
{
foreach ( $data as $key => $v ) 
{
$allid[] = $v['id'];
$nowid[] = $v['id'];
}
$id = implode( ",", $nowid );
get_son_type_run( $id );
}
$rerow = $allid;
$allid = array( );
return $rerow;
}
function get_type_son( $id = 0 ) 
{
$tempname = "type_son_all".$id;
if ( !S( $tempname ) ) 
{
$row = get_type_son_all( $id );
S( $tempname, $row, 3600 *C("HOME_CACHE_TIME" ) );
}
else 
{
$row =S($tempname );
}
return $row;
}
function get_type_son_all( $id = "0" ) 
{
static $rerow = NULL;
global $get_type_son_all_row;
if ( empty( $id ) ) 
{
exit( );
}
$data =M("type" )->where( "parent_id = {$id}
" )->field( "id" )->select( );
foreach ( $data as $key => $v ) 
{
$get_type_son_all_row[] = $v['id'];
$data_son =M("type" )->where( "parent_id = {$v['id']}
" )->field( "id" )->select( );
if ( 0 < count( $data_son ) ) 
{
get_type_son_all( $v['id'] );
}
}
$rerow = $get_type_son_all_row;
$get_type_son_all_row = array( );
return $rerow;
}
function get_type_parent_nid( ) 
{
$row = array( );
$p_nid_new = array( );
if ( !S( "type_parent_nid_temp" ) ) 
{
$data =M("type" )->field( "id" )->select( );
if ( 0 < count( $data ) ) 
{
foreach ( $data as $key => $v ) 
{
$p_nid = get_type_leve_nid( $v['id'] );
$i = $n = count( $p_nid );
if ( 1 < $i ) 
{
for ($j = 0; $j < $n; $j++, $i-- ) 
{
$p_nid_new[$i - 1] = $p_nid[$j];
}
}
else 
{
$p_nid_new = $p_nid;
}
$row[$v['id']] = $p_nid_new;
}
}
S( "type_parent_nid_temp", $row, 3600 *C("HOME_CACHE_TIME" ) );
}
else 
{
$row =S("type_parent_nid_temp" );
}
return $row;
}
function get_type_list( $model, $field = true ) 
{
$acaheName = md5( "type_list_temp".$model.$field );
if ( !S( $acaheName ) ) 
{
$list = D( ucfirst( $model ) )->getField( $field );
S( $acaheName, $list, 3600 *C("HOME_CACHE_TIME" ) );
}
else 
{
$list =S($acaheName );
}
return $list;
}
function get_type_infos( ) 
{
$row = array( );
$type_list = get_type_list( "acategory", "id,type_nid,type_set" );
if ( !isset( $_GET['typeid'] ) ) 
{
$type_nid = get_type_leve( );
$rurl = explode( "?", $_SERVER['REQUEST_URI'] );
$xurl_tmp = explode( "/", str_replace( array( "index.html", ".html" ), array( "", "" ), $rurl[0] ) );
$zu = implode( "-", array_filter( $xurl_tmp ) );
$typeid = $type_nid[$zu];
$typeset = $type_list[$typeid]['type_set'];
}
else 
{
$typeid = intval( $_GET['typeid'] );
$typeset = $type_list[$typeid]['type_set'];
}
if ( $typeset == 1 ) 
{
$templet = "list_index";
}
else 
{
$templet = "index_index";
}
$row['typeset'] = $typeset;
$row['templet'] = $templet;
$row['typeid'] = $typeid;
return $row;
}
function get_area_type_infos( $area_id = 0 ) 
{
$row = array( );
$type_list = get_type_list( "aacategory", "id,type_nid,type_set,area_id" );
if ( !isset( $_GET['typeid'] ) ) 
{
$type_nid = get_area_type_leve( 0, $area_id );
$rurl = explode( "?", $_SERVER['REQUEST_URI'] );
$xurl_tmp = explode( "/", str_replace( array( "index.html", ".html" ), array( "", "" ), $rurl[0] ) );
$zu = implode( "-", array_filter( $xurl_tmp ) );
$typeid = $type_nid[$area_id.$zu];
$typeset = $type_list[$typeid]['type_set'];
}
else 
{
$typeid = intval( $_GET['typeid'] );
$typeset = $type_list[$typeid]['type_set'];
}
if ( $typeset == 1 ) 
{
$templet = "list_index";
}
else 
{
$templet = "index_index";
}
$row['typeset'] = $typeset;
$row['templet'] = $templet;
$row['typeid'] = $typeid;
return $row;
}
function get_type_leve_list( $id = 0, $modelname = false, $type ) 
{
static $rerow = NULL;
global $get_type_leve_list_run_row;
if ( !$modelname ) 
{
$model =D( "type" );
}
else 
{
$model = D( ucfirst( $modelname ) );
}
$stype = $modelname."home_type_leve_list".$id;
if ( !S( $stype ) ) 
{
get_type_leve_list_run( $id, $model, $type );
$rerow = $get_type_leve_list_run_row;
$GLOBALS['get_type_leve_list_run_row'] = NULL;
$data = $rerow;
}
else 
{
$data =S($stype );
}
return $data;
}
function get_type_leve_list_run( $id = 0, $model, $type ) 
{
global $get_type_leve_list_run_row;
$spa = "----";
if ( count( $get_type_leve_list_run_row ) < 1 ) 
{
$get_type_leve_list_run_row = array( );
}
$typelist = $model->where( "parent_id={$id}
and model='{$type}
'" )->field( "type_name,id,parent_id" )->order( "sort_order DESC" )->select( );
foreach ( $typelist as $k => $v ) 
{
$leve = intval( get_typeleve( $v['id'], $model ) );
$v['type_name'] = str_repeat( $spa, $leve ).$v['type_name'];
$get_type_leve_list_run_row[] = $v;
$typelist_s1 = $model->where( "parent_id={$v['id']}
and model='{$type}
'" )->field( "type_name,id" )->select( );
if ( 0 < count( $typelist_s1 ) ) 
{
get_type_leve_list_run( $v['id'], $model, $type );
}
}
}
function get_type_leve_list_area( $id = 0, $modelname = false, $area_id = 0 ) 
{
static $rerow = NULL;
global $get_type_leve_list_area_run_row;
if ( !$modelname ) 
{
$model = D( "type" );
}
else 
{
$model = D( ucfirst( $modelname ) );
}
$stype = $modelname."home_type_leve_list_area".$id.$area_id;
if ( !S( $stype ) ) 
{
get_type_leve_list_area_run( $id, $model, $area_id );
$rerow = $get_type_leve_list_area_run_row;
$GLOBALS['get_type_leve_list_area_run_row'] = NULL;
$data = $rerow;
S( $stype, $data, 3600 *C("HOME_CACHE_TIME" ) );
}
else 
{
$data =S($stype );
}
return $data;
}
function get_type_leve_list_area_run( $id = 0, $model, $area_id ) 
{
global $get_type_leve_list_area_run_row;
$spa = "----";
if ( count( $get_type_leve_list_area_run_row ) < 1 ) 
{
$get_type_leve_list_area_run_row = array( );
}
$typelist = $model->where( "parent_id={$id}
AND area_id={$area_id}
" )->field( "type_name,id,parent_id" )->order( "sort_order DESC" )->select( );
foreach ( $typelist as $k => $v ) 
{
$leve = intval( get_typeleve( $v['id'], $model ) );
$v['type_name'] = str_repeat( $spa, $leve ).$v['type_name'];
$get_type_leve_list_area_run_row[] = $v;
$typelist_s1 = $model->where( "parent_id={$v['id']}
" )->field( "type_name,id" )->select( );
if ( 0 < count( $typelist_s1 ) ) 
{
get_type_leve_list_area_run( $v['id'], $model, $area_id );
}
}
}
function get_typeLeve( $typeid, $model ) 
{
$typeleve = 0;
global $typeleve;
static $rt = 0;
get_typeleve_run( $typeid, $model );
$rt = $typeleve;
unset( $GLOBALS['typeleve'] );
return $rt;
}
function get_typeLeve_run( $typeid, $model ) 
{
global $typeleve;
$condition['id'] = $typeid;
$v = $model->field( "parent_id" )->where( $condition )->find( );
if ( 0 < $v['parent_id'] ) 
{
$typeleve++;
get_typeleve_run( $v['parent_id'], $model );
}
}
function de_xie( $arr ) 
{
$data = array( );
if ( is_array( $arr ) ) 
{
foreach ( $arr as $key => $v ) 
{
if ( is_array( $v ) ) 
{
foreach ( $v as $skey => $sv ) 
{
if ( is_array( $sv ) ) 
{
}
else 
{
$v[$skey] = stripslashes( $sv );
}
}
$data[$key] = $v;
}
else 
{
$data[$key] = stripslashes( $v );
}
}
}
else 
{
$data = stripslashes( $arr );
}
return $data;
}
function text( $text, $parseBr = false, $nr = false ) 
{
$text = htmlspecialchars_decode( $text );
$text = safe( $text, "text" );
if ( !$parseBr && $nr ) 
{
$text = str_ireplace( array( "\r", "\n", "\t", "&nbsp;" ), "", $text );
$text = htmlspecialchars( $text, ENT_QUOTES );
}
else if ( !$nr ) 
{
$text = htmlspecialchars( $text, ENT_QUOTES );
}
else 
{
$text = htmlspecialchars( $text, ENT_QUOTES );
$text = nl2br( $text );
}
$text = trim( $text );
return $text;
}
function safe( $text, $type = "html", $tagsMethod = true, $attrMethod = true, $xssAuto = 1, $tags = array( ), $attr = array( ), $tagsBlack = array( ), $attrBlack = array( ) ) 
{
$text_tags = "";
$font_tags = "<i><b><u><s><em><strong><font><big><small><sup><sub><bdo><h1><h2><h3><h4><h5><h6>";
$base_tags = $font_tags."<p><br><hr><a><img><map><area><pre><code><q><blockquote><acronym><cite><ins><del><center><strike>";
$form_tags = $base_tags."<form><input><textarea><button><select><optgroup><option><label><fieldset><legend>";
$html_tags = $base_tags."<ul><ol><li><dl><dd><dt><table><caption><td><th><tr><thead><tbody><tfoot><col><colgroup><div><span><object><embed>";
$all_tags = $form_tags.$html_tags."<!DOCTYPE><html><head><title><body><base><basefont><script><noscript><applet><object><param><style><frame><frameset><noframes><iframe>";
$text = strip_tags( $text, $
{
$type."_tags" }
);
if ( $type != "all" ) 
{
while ( preg_match( "/(<[^><]+) (onclick|onload|unload|onmouseover|onmouseup|onmouseout|onmousedown|onkeydown|onkeypress|onkeyup|onblur|onchange|onfocus|action|background|codebase|dynsrc|lowsrc)([^><]*)/i", $text, $mat ) ) 
{
$text = str_ireplace( $mat[0], $mat[1].$mat[3], $text );

/*
		//发现需要处理的while语句,主参照如下说明进行修复:
		//出错代码
		do
		{
			if ( 0 < strlen( $word ) )
			{
				//...代码
			}
		} while ( 1 );
		//正确结果, 注意while语句的修复处理.
		while (strlen($word) > 0)
		{
			//...代码
		}
		*/
}
while ( preg_match( "/(<[^><]+)(window\\.|javascript:|js:|about:|file:|document\\.|vbs:|cookie)([^><]*)/i", $text, $mat ) ) 
{
$text = str_ireplace( $mat[0], $mat[1].$mat[3], $text );
}
}
return $text;
}
function h($text, $tags = null){
	$text	=	trim($text);
	$text	=	preg_replace('/<!--?.*-->/','',$text);
	//完全过滤注释
	$text	=	preg_replace('/<!--?.*-->/','',$text);
	//完全过滤动态代码
	$text	=	preg_replace('/<\?|\?'.'>/','',$text);
	//完全过滤js
	$text	=	preg_replace('/<script?.*\/script>/','',$text);

	$text	=	str_replace('[','&#091;',$text);
	$text	=	str_replace(']','&#093;',$text);
	$text	=	str_replace('|','&#124;',$text);
	//过滤换行符
	$text	=	preg_replace('/\r?\n/','',$text);
	//br
	$text	=	preg_replace('/<br(\s\/)?'.'>/i','[br]',$text);
	$text	=	preg_replace('/(\[br\]\s*){10,}/i','[br]',$text);
	//过滤危险的属性，如：过滤on事件lang js
	while(preg_match('/(<[^><]+) (lang|on|action|background|codebase|dynsrc|lowsrc)[^><]+/i',$text,$mat)){
		$text=str_replace($mat[0],$mat[1],$text);
	}
	while(preg_match('/(<[^><]+)(window\.|javascript:|js:|about:|file:|document\.|vbs:|cookie)([^><]*)/i',$text,$mat)){
		$text=str_replace($mat[0],$mat[1].$mat[3],$text);
	}
	if(empty($tags)) {
		$tags = 'table|tbody|td|th|tr|i|b|u|strong|img|p|br|div|span|em|ul|ol|li|dl|dd|dt|a|alt|h[1-9]?';
		$tags.= '|object|param|embed';	// 音乐和视频
	}
	//允许的HTML标签
	$text	=	preg_replace('/<(\/?(?:'.$tags.'))( [^><\[\]]*)?>/i','[\1\2]',$text);
	//过滤多余html
	$text	=	preg_replace('/<\/?(html|head|meta|link|base|basefont|body|bgsound|title|style|script|form|iframe|frame|frameset|applet|id|ilayer|layer|name|style|xml)[^><]*>/i','',$text);
	//过滤合法的html标签
	while(preg_match('/<([a-z]+)[^><\[\]]*>[^><]*<\/\1>/i',$text,$mat)){
		$text=str_replace($mat[0],str_replace('>',']',str_replace('<','[',$mat[0])),$text);
	}
	//转换引号
	while(preg_match('/(\[[^\[\]]*=\s*)(\"|\')([^\2\[\]]+)\2([^\[\]]*\])/i',$text,$mat)){
		$text = str_replace($mat[0], $mat[1] . '|' . $mat[3] . '|' . $mat[4],$text);
	}
	//过滤错误的单个引号
	// 修改:2011.05.26 kissy编辑器中表情等会包含空引号, 简单的过滤会导致错误
//	while(preg_match('/\[[^\[\]]*(\"|\')[^\[\]]*\]/i',$text,$mat)){
//		$text=str_replace($mat[0],str_replace($mat[1],'',$mat[0]),$text);
//	}
	//转换其它所有不合法的 < >
	$text	=	str_replace('<','&lt;',$text);
	$text	=	str_replace('>','&gt;',$text);
    $text   =   str_replace('"','&quot;',$text);
    //$text   =   str_replace('\'','&#039;',$text);
	 //反转换
	$text	=	str_replace('[','<',$text);
	$text	=	str_replace(']','>',$text);
	$text	=	str_replace('|','"',$text);
	//过滤多余空格
	$text	=	str_replace('  ',' ',$text);
	return $text;
}
function get_thumb_pic( $str ) 
{
$path = explode( "/", $str );
$sc = count( $path );
$path[$sc - 1] = "thumb_".$path[$sc - 1];
return implode( "/", $path );
}
function get_kvtable( $nid = "" ) 
{
$stype = "kvtable".$nid;
$list = array( );
if ( !S( $stype ) ) 
{
if ( !empty( $nid ) ) 
{
$tmplist =M("kvtable" )->where( "nid='{$nid}
'" )->field( true )->select( );
}
else 
{
$tmplist =M("rule" )->field( true )->select( );
}
foreach ( $tmplist as $v ) 
{
$list[$v['id']] = $v;
}
S( $stype, $list, 3600 *C("HOME_CACHE_TIME" ) );
$row = $list;
}
else 
{
$list =S($stype );
$row = $list;
}
return $row;
}
function cnsubstr( $str, $length, $start = 0, $charset = "utf-8", $suffix = true ) 
{
$str = strip_tags( $str );
if ( function_exists( "mb_substr" ) ) 
{
if ( mb_strlen( $str, $charset ) <= $length ) 
{
return $str;
}
$slice = mb_substr( $str, $start, $length, $charset );
}
else 
{
$re['utf-8'] = "/[\x01-]|[�-�][�-�]|[�-�][�-�]{2}|[�-][�-�]{3}/";
$re['gb2312'] = "/[\x01-]|[�-�][�-�]/";
$re['gbk'] = "/[\x01-]|[�-�][@-�]/";
$re['big5'] = "/[\x01-]|[�-�]([@-~]|�-�])/";
preg_match_all( $re[$charset], $str, $match );
if ( count( $match[0] ) <= $length ) 
{
return $str;
}
$slice = join( "", array_slice( $match[0], $start, $length ) );
}
if ( $suffix ) 
{
return $slice."…";
}
return $slice;
}
function getLastTimeFormt( $time, $type = 0 ) 
{
if ( $type == 0 ) 
{
$f = "m-d H:i";
}
else if ( $type == 1 ) 
{
$f = "Y-m-d H:i";
}
$agoTime = time( ) - $time;
if ( $agoTime <= 60 && 0 <= $agoTime ) 
{
return $agoTime."秒前";
}
else if ( $agoTime <= 3600 && 60 < $agoTime ) 
{
return intval( $agoTime / 60 )."分钟前";
}
else if ( date( "d", $time ) == date( "d", time( ) ) && 3600 < $agoTime ) 
{
return "今天 ".date( "H:i", $time );
}
else if ( date( "d", $time + 86400 ) == date( "d", time( ) ) && $agoTime < 172800 ) 
{
return "昨天 ".date( "H:i", $time );
}
else 
{
return date( $f, $time );
}
}
function get_avatar( $uid, $size = "middle", $type = "" ) 
{
$size = in_array( $size, array( "big", "middle", "small" ) ) ? $size : "big";
$uid = abs( intval( $uid ) );
$uid = sprintf( "%09d", $uid );
$dir1 = substr( $uid, 0, 3 );
$dir2 = substr( $uid, 3, 2 );
$dir3 = substr( $uid, 5, 2 );
$typeadd = $type == "real" ? "_real" : "";
$path = __ROOT__."/Style/header/customavatars/".$dir1."/".$dir2."/".$dir3."/".substr( $uid, -2 ).$typeadd."_avatar_{$size}
.jpg";
if ( !file_exists(C("WEB_ROOT" ).$path ) ) 
{
$path = __ROOT__."/Style/header/images/"."noavatar_{$size}
.gif";
}
return $path;
}
function get_Area_list( $id = "" ) 
{
$cacheName = "temp_area_list_s";
if ( !S( $cacheName ) ) 
{
$list =M("area" )->getField( "id,name" );
S( $cacheName, $list, 3.6e+009 );
}
else 
{
$list =S($cacheName );
}
if ( !empty( $id ) ) 
{
return $list[$id];
}
else 
{
return $list;
}
}
function ip2area( $ip = "" ) 
{
if ( strlen( $ip ) < 6 ) 
{
return;
}
import( "ORG.Net.IpLocation" );
$Ip = new IpLocation( "CoralWry.dat" );
$area = $Ip->getlocation( $ip );
$area = auto_charset( $area );
if ( $area['country'] ) 
{
$res = $area['country'];
}
if ( $area['area'] ) 
{
$res = $res."(".$area['area'].")";
}
if ( empty( $res ) ) 
{
$res = "未知";
}
return $res;
}
function second2string( $second, $type = 0 ) 
{
$day = floor( $second / 86400 );
$second %= 86400;
$hour = floor( $second / 3600 );
$second %= 3600;
$minute = floor( $second / 60 );
$second %= 60;
switch ( $type ) 
{
case 0 : if ( 1 <= $day ) 
{
$res = $day."天";
}
else if ( 1 <= $hour ) 
{
$res = $hour."小时";
}
else 
{
$res = $minute."分钟";
}
break;
case 1 : if ( 5 <= $day ) 
{
$res = date( "Y-m-d H:i", time( ) + $second );
}
else if ( 1 <= $day && $day < 5 ) 
{
$res = $day."天前";
}
else if ( 1 <= $hour ) 
{
$res = $hour."小时前";
}
else 
{
$res = $minute."分钟前";
break;
}
}
return $res;
}
function FS( $filename, $data = "", $path = "" ) 
{
$path =C("WEB_ROOT" ).$path;
if ( $data == "" ) 
{
$f = explode( "/", $filename );
$num = count( $f );
if ( 2 < $num ) 
{
$fx = $f;
array_pop( $f );
$pathe = implode( "/", $f );
$re = f( $fx[$num - 1], "", $pathe."/" );
}
else 
{
isset( $f[1] ) ? ( $re = f( $f[1], "",C("WEB_ROOT" ).$f[0]."/" ) ) : ( $re = f( $f[0] ) );
}
return $re;
}
else if ( !empty( $path ) ) 
{
$re = f( $filename, $data, $path );
}
else 
{
$re = f( $filename, $data );
}
}
function formtUrl( $url ) 
{
if ( !stristr( $url, "http://" ) ) 
{
$url = str_replace( "http://", "", $url );
}
$fourl = explode( "/", $url );
$domain = get_domain( "http://".$fourl[0] );
$perfix = str_replace( $domain, "", $fourl[0] );
return $perfix.$domain;
}
function get_domain( $url ) 
{
$pattern = "/[/w-]+/.(com|net|org|gov|biz|com.tw|com.hk|com.ru|net.tw|net.hk|net.ru|info|cn|com.cn|net.cn|org.cn|gov.cn|mobi|name|sh|ac|la|travel|tm|us|cc|tv|jobs|asia|hn|lc|hk|bz|com.hk|ws|tel|io|tw|ac.cn|bj.cn|sh.cn|tj.cn|cq.cn|he.cn|sx.cn|nm.cn|ln.cn|jl.cn|hl.cn|js.cn|zj.cn|ah.cn|fj.cn|jx.cn|sd.cn|ha.cn|hb.cn|hn.cn|gd.cn|gx.cn|hi.cn|sc.cn|gz.cn|yn.cn|xz.cn|sn.cn|gs.cn|qh.cn|nx.cn|xj.cn|tw.cn|hk.cn|mo.cn|org.hk|is|edu|mil|au|jp|int|kr|de|vc|ag|in|me|edu.cn|co.kr|gd|vg|co.uk|be|sg|it|ro|com.mo)(/.(cn|hk))*/";
preg_match( $pattern, $url, $matches );
if ( 0 < count( $matches ) ) 
{
return $matches[0];
}
else 
{
$rs = parse_url( $url );
$main_url = $rs['host'];
if ( !strcmp( long2ip( sprintf( "%u", ip2long( $main_url ) ) ), $main_url ) ) 
{
return $main_url;
}
else 
{
$arr = explode( ".", $main_url );
$count = count( $arr );
$endArr = array( "com", "net", "org" );
if ( in_array( $arr[$count - 2], $endArr ) ) 
{
$domain = $arr[$count - 3].".".$arr[$count - 2].".".$arr[$count - 1];
}
else 
{
$domain = $arr[$count - 2].".".$arr[$count - 1];
}
return $domain;
}
}
}
function getFloatValue( $f, $len ) 
{
return number_format( $f, $len, ".", "" );
}
function get_remote_img( $content ) 
{
$rt =C("WEB_ROOT" );
$img_dir =C("REMOTE_IMGDIR" ) ?C("REMOTE_IMGDIR" ) : "/UF/Remote";
$base_dir = substr( $rt, 0, strlen( $rt ) - 1 );
$content = stripslashes( $content );
$img_array = array( );
preg_match_all( "/(src|SRC)=[\"|'| ]{0,}(http:\\/\\/(.*)\\.(gif|jpg|jpeg|bmp|png|ico))/isU", $content, $img_array );
$img_array = array_unique( $img_array[2] );
set_time_limit( 0 );
$imgUrl = $img_dir."/".strftime( "%Y%m%d", time( ) );
$imgPath = $base_dir.$imgUrl;
$milliSecond = strftime( "%H%M%S", time( ) );
if ( !is_dir( $imgPath ) ) 
{
makedir( $imgPath, 511 );
}
foreach ( $img_array as $key => $value ) 
{
$value = trim( $value );
$get_file = @file_get_contents( $value );
$rndFileName = $imgPath."/".$milliSecond.$key.".".substr( $value, -3, 3 );
$fileurl = $imgUrl."/".$milliSecond.$key.".".substr( $value, -3, 3 );
if ( $get_file ) 
{
$fp = @fopen( $rndFileName, "w" );
@fwrite( $fp, $get_file );
@fclose( $fp );
}
$content = ereg_replace( $value, $fileurl, $content );
}
return $content;
}
function getSubSite( ) 
{
$map['is_open'] = 1;
$list =M("area" )->field( true )->where( $map )->select( );
$cdomain = explode( ".", $_SERVER['HTTP_HOST'] );
$cpx = array_pop( $cdomain );
$doamin = array_pop( $cdomain );
$host = ".".$doamin.".".$cpx;
foreach ( $list as $key => $v ) 
{
$list[$key]['host'] = "http://".$v['domain'].$host;
}
return $list;
}
function getCreditsLog( $map, $size ) 
{
if ( empty( $map['uid'] ) ) 
{
return;
}
if ( $size ) 
{
import( "ORG.Util.Page" );
$count =M("member_creditslog" )->where( $map )->count( "id" );
$p = new Page( $count, $size );
$page = $p->show( );
$Lsql = "{$p->firstRow}
,{$p->listRows}
";
}
$list =M("member_creditslog" )->where( $map )->order( "id DESC" )->limit( $Lsql )->select( );
$type_arr =C("MONEY_LOG" );
foreach ( $list as $key => $v ) 
{
}
$row = array( );
$row['list'] = $list;
$row['page'] = $page;
return $row;
}
function getCredit( $uid ) 
{
$pre =C("DB_PREFIX" );
$user =M("members m" )->join( "{$pre}
member_money mm ON m.id=mm.uid" )->where( "m.id={$uid}
" )->find( );
if ( !is_array( $user ) ) 
{
return "用户出错，请重新操作";
}
$credit = array( );
$credit['xy']['limit'] = getfloatvalue( $user['credit_limit'], 2 );
$credit['xy']['use'] = getfloatvalue(M("borrow_info" )->where( "borrow_uid = {$uid}
AND borrow_status in(0,2,4,6) AND borrow_type=1" )->sum( "borrow_money-repayment_money" ), 2 );
$credit['xy']['cuse'] = getfloatvalue( $credit['xy']['limit'] - $credit['xy']['use'], 2 );
$credit['db']['limit'] = getfloatvalue( $user['vouch_limit'], 2 );
$credit['db']['use'] = getfloatvalue(M("borrow_info" )->where( "borrow_uid = {$uid}
AND borrow_status in(0,2,4,6) AND borrow_type=2" )->sum( "borrow_money-repayment_money" ), 2 );
$credit['db']['cuse'] = getfloatvalue( $credit['db']['limit'] - $credit['db']['use'], 2 );
$credit['dy']['limit'] = getfloatvalue( $user['diya_limit'], 2 );
$credit['dy']['use'] = getfloatvalue(M("borrow_info" )->where( "borrow_uid = {$uid}
AND borrow_status in(0,2,4,6) AND borrow_type=5" )->sum( "borrow_money-repayment_money" ), 2 );
$credit['dy']['cuse'] = getfloatvalue( $credit['dy']['limit'] - $credit['dy']['use'], 2 );
$credit['jz']['limit'] = getfloatvalue( 0.9 *M("investor_detail" )->where( " investor_uid={$uid}
AND status =7 " )->sum( "capital+interest-interest_fee" ), 2 );
$credit['jz']['use'] = getfloatvalue(M("borrow_info" )->where( "borrow_uid = {$uid}
AND borrow_status in(0,2,4,6) AND borrow_type=4" )->sum( "borrow_money+borrow_interest-repayment_money-repayment_interest" ), 2 );
$credit['jz']['cuse'] = getfloatvalue( $credit['jz']['limit'] - $credit['jz']['use'], 2 );
$credit['all']['limit'] = getfloatvalue( $credit['xy']['limit'] + $credit['db']['limit'] + $credit['dy']['limit'], 2 );
$credit['all']['use'] = getfloatvalue( $credit['xy']['use'] + $credit['db']['use'] + $credit['dy']['use'], 2 );
$credit['all']['cuse'] = getfloatvalue( $credit['all']['limit'] - $credit['all']['use'], 2 );
return $credit;
}
function getIntegralLog( $map, $size ) 
{
if ( empty( $map['uid'] ) ) 
{
return;
}
if ( $size ) 
{
import( "ORG.Util.Page" );
$count =M("member_integrallog" )->where( $map )->count( "id" );
$p = new Page( $count, $size );
$page = $p->show( );
$Lsql = "{$p->firstRow}
,{$p->listRows}
";
}
$list =M("member_integrallog" )->where( $map )->order( "id DESC" )->limit( $Lsql )->select( );
$type_arr =C("INTEGRAL_LOG" );
foreach ( $list as $key => $v ) 
{
$list[$key]['type'] = $type_arr[$v['type']];
}
$row = array( );
$row['list'] = $list;
$row['page'] = $page;
return $row;
}
function Notice( $type, $uid, $data = array( ) ) 
{
$datag = get_global_setting( );
$datag = de_xie( $datag );
$msgconfig = fs( "Webconfig/msgconfig" );
$emailTxt = fs( "Webconfig/emailtxt" );
$smsTxt = fs( "Webconfig/smstxt" );
$msgTxt = fs( "Webconfig/msgtxt" );
$emailTxt = de_xie( $emailTxt );
$smsTxt = de_xie( $smsTxt );
$msgTxt = de_xie( $msgTxt );
import( "ORG.Net.Email" );
$port = $msgconfig['stmp']['port'];
$smtpserver = $msgconfig['stmp']['server'];
$smtpuser = $msgconfig['stmp']['user'];
$smtppwd = $msgconfig['stmp']['pass'];
$mailtype = "HTML";
$sender = $msgconfig['stmp']['user'];
$smtp = new smtp( $smtpserver, $port, true, $smtpuser, $smtppwd, $sender );
$minfo =M("members" )->field( "user_email,user_name,user_phone" )->find( $uid );
$uname = $minfo['user_name'];
switch ( $type ) 
{
case 1 : $vcode = rand_string( $uid, 32, 0, 1 );
$link = "<a href=\"".c( "WEB_URL" )."/member/common/emailverify?vcode=".$vcode."\">点击链接验证邮件</a>";
$body = str_replace( array( "#UserName#" ), array( $uname ), $msgTxt['regsuccess'] );
addinnermsg( $uid, "恭喜您注册成功", $body );
$subject = "您刚刚在".$datag['web_name']."注册成功";
$body = str_replace( array( "#UserName#", "#LINK#" ), array( $uname, $link ), $emailTxt['regsuccess'] );
$to = $minfo['user_email'];
$send = $smtp->sendmail( $to, $sender, $subject, $body, $mailtype );
return $send;
case 2 : $vcode = rand_string( $uid, 10, 3, 3 );
$pcode = rand_string( $uid, 6, 1, 3 );
$subject = "您刚刚在".$datag['web_name']."注册成功";
$body = str_replace( array( "#CODE#" ), array( $vcode ), $emailTxt['safecode'] );
$to = $minfo['user_email'];
$send = $smtp->sendmail( $to, $sender, $subject, $body, $mailtype );
$content = str_replace( array( "#CODE#" ), array( $pcode ), $smsTxt['safecode'] );
$sendp = sendsms( $minfo['user_phone'], $content );
return $send;
case 3 : $vcode = rand_string( $uid, 6, 1, 4 );
$content = str_replace( array( "#CODE#" ), array( $vcode ), $smsTxt['safecode'] );
$send = sendsms( $minfo['user_phone'], $content );
return $send;
case 4 : $vcode = rand_string( $uid, 6, 1, 5 );
$content = str_replace( array( "#CODE#" ), array( $vcode ), $smsTxt['safecode'] );
$send = sendsms( $data['phone'], $content );
return $send;
case 5 : $vcode = rand_string( $uid, 10, 1, 6 );
$subject = "您刚刚在".$datag['web_name']."申请更换手机的安全码";
$body = str_replace( array( "#CODE#" ), array( $vcode ), $emailTxt['changephone'] );
$to = $minfo['user_email'];
$send = $smtp->sendmail( $to, $sender, $subject, $body, $mailtype );
return $send;
case 6 : $subject = "恭喜，你在".$datag['web_name']."发布的借款审核通过";
$body = str_replace( array( "#UserName#" ), array( $uname ), $emailTxt['verifysuccess'] );
$to = $minfo['user_email'];
$send = $smtp->sendmail( $to, $sender, $subject, $body, $mailtype );
$body = str_replace( array( "#UserName#" ), array( $uname ), $msgTxt['verifysuccess'] );
addinnermsg( $uid, "恭喜借款审核通过", $body );
return $send;
case 7 : $vcode = rand_string( $uid, 32, 0, 7 );
$link = "<a href=\"".c( "WEB_URL" )."/member/common/getpasswordverify?vcode=".$vcode."\">点击链接验证邮件</a>";
$subject = "您刚刚在".$datag['web_name']."申请了密码找回";
$body = str_replace( array( "#UserName#", "#LINK#" ), array( $uname, $link ), $emailTxt['getpass'] );
$to = $minfo['user_email'];
$send = $smtp->sendmail( $to, $sender, $subject, $body, $mailtype );
return $send;
case 8 : $vcode = rand_string( $uid, 32, 0, 1 );
$link = "<a href=\"".c( "WEB_URL" )."/member/common/emailverify?vcode=".$vcode."\">点击链接验证邮件</a>";
$subject = "您刚刚在".$datag['web_name']."申请邮件验证";
$body = str_replace( array( "#UserName#", "#LINK#" ), array( $uname, $link ), $emailTxt['regsuccess'] );
$to = $minfo['user_email'];
$send = $smtp->sendmail( $to, $sender, $subject, $body, $mailtype );
return $send;
case 9 : $subject = "您在".$datag['web_name']."的还款最终期限即将到期。";
$body = str_replace( array( "#UserName#", "#borrowName#", "#borrowMoney#" ), array( $uname, $data['borrowName'], $data['borrowMoney'] ), $emailTxt['repaymentTip'] );
$to = $minfo['user_email'];
$send = $smtp->sendmail( $to, $sender, $subject, $body, $mailtype );
return $send;
case 10 : $vcode = rand_string( $uid, 32, 0, 7 );
$link = "<a href=\"".c( "WEB_URL" )."/member/index/getpaypasswordverify?vcode=".$vcode."\">点击链接验证邮件</a>";
$subject = "您刚刚在".$datag['web_name']."申请了支付密码找回";
$body = str_replace( array( "#UserName#", "#LINK#" ), array( $uname, $link ), $emailTxt['getpaypass'] );
$to = $minfo['user_email'];
$send = $smtp->sendmail( $to, $sender, $subject, $body, $mailtype );
return $send;
}
}
function SMStip( $type, $mob, $from = array( ), $to = array( ) ) 
{
if ( empty( $mob ) ) 
{
return;
}
$datag = get_global_setting( );
$datag = de_xie( $datag );
$smsTxt = fs( "Webconfig/smstxt" );
$smsTxt = de_xie( $smsTxt );
if ( $smsTxt[$type]['enable'] == 1 ) 
{
$body = str_replace( $from, $to, $smsTxt[$type]['content'] );
$send = sendsms( $mob, $body );
}
else 
{
return;
}
}
function MTip( $type, $uid = 0, $info = "", $autoid = "" ) 
{
$datag = get_global_setting( );
$datag = de_xie( $datag );
$port = 25;
$id1 = "{$type}
_1";
$id2 = "{$type}
_2";
$per =C("DB_PREFIX" );
$sql = "select 1 as tip1,0 as tip2,m.user_email,m.id from {$per}
members m WHERE m.id={$uid}
";
$memail = m( )->query( $sql );
switch ( $type ) 
{
case "chk1" : $to = "";
$subject = "您刚刚在".$datag['web_name']."修改了登陆密码";
$body = "您刚刚在".$datag['web_name']."修改了登陆密码,如不是自己操作,请尽快联系客服";
$innerbody = "您刚刚修改了登陆密码,如不是自己操作,请尽快联系客服";
foreach ( $memail as $v ) 
{
if ( 0 < $v['tip1'] ) 
{
addinnermsg( $v['id'], "您刚刚修改了登陆密码", $innerbody );
}
if ( 0 < $v['tip2'] ) 
{
$to = empty( $to ) ? $v['user_email'] : $to.",".$v['user_email'];
}
}
break;
case "chk2" : $to = "";
$subject = "您刚刚在".$datag['web_name']."修改了提现的银行帐户";
$body = "您刚刚在".$datag['web_name']."修改了提现的银行帐户,如不是自己操作,请尽快联系客服";
$innerbody = "您刚刚修改了提现的银行帐户,如不是自己操作,请尽快联系客服";
foreach ( $memail as $v ) 
{
if ( 0 < $v['tip1'] ) 
{
addinnermsg( $v['id'], "您刚刚修改了提现的银行帐户", $innerbody );
}
if ( 0 < $v['tip2'] ) 
{
$to = empty( $to ) ? $v['user_email'] : $to.",".$v['user_email'];
}
}
break;
case "chk6" : $to = "";
$subject = "您刚刚在".$datag['web_name']."申请了提现操作";
$body = "您刚刚在".$datag['web_name']."申请了提现操作,如不是自己操作,请尽快联系客服";
$innerbody = "您刚刚申请了提现操作,如不是自己操作,请尽快联系客服";
foreach ( $memail as $v ) 
{
if ( 0 < $v['tip1'] ) 
{
addinnermsg( $v['id'], "您刚刚申请了提现操作", $innerbody );
}
if ( 0 < $v['tip2'] ) 
{
$to = empty( $to ) ? $v['user_email'] : $to.",".$v['user_email'];
}
}
break;
case "chk7" : $to = "";
$subject = "您在".$datag['web_name']."发布的借款标刚刚初审未通过";
$body = "您在".$datag['web_name']."发布的第{$info}
号借款标刚刚初审未通过";
$innerbody = "您发布的第{$info}
号借款标刚刚初审未通过";
foreach ( $memail as $v ) 
{
if ( 0 < $v['tip1'] ) 
{
addinnermsg( $v['id'], "刚刚您的借款标初审未通过", $innerbody );
}
if ( 0 < $v['tip2'] ) 
{
$to = empty( $to ) ? $v['user_email'] : $to.",".$v['user_email'];
}
}
break;
case "chk8" : $to = "";
$subject = "您在".$datag['web_name']."发布的借款标刚刚初审通过";
$body = "您在".$datag['web_name']."发布的第{$info}
号借款标刚刚初审通过";
$innerbody = "您发布的第{$info}
号借款标刚刚初审通过";
foreach ( $memail as $v ) 
{
if ( 0 < $v['tip1'] ) 
{
addinnermsg( $v['id'], "刚刚您的借款标初审通过", $innerbody );
}
if ( 0 < $v['tip2'] ) 
{
$to = empty( $to ) ? $v['user_email'] : $to.",".$v['user_email'];
}
}
break;
case "chk9" : $to = "";
$subject = "您在".$datag['web_name']."发布的借款标刚刚复审通过";
$body = "您在".$datag['web_name']."发布的第{$info}
号借款标刚刚复审通过";
$innerbody = "您发布的第{$info}
号借款标刚刚复审通过";
foreach ( $memail as $v ) 
{
if ( 0 < $v['tip1'] ) 
{
addinnermsg( $v['id'], "刚刚您的借款标复审通过", $innerbody );
}
if ( 0 < $v['tip2'] ) 
{
$to = empty( $to ) ? $v['user_email'] : $to.",".$v['user_email'];
}
}
break;
case "chk12" : $to = "";
$subject = "您在".$datag['web_name']."的发布的借款标刚刚复审未通过";
$body = "您在".$datag['web_name']."的发布的第{$info}
号借款标复审未通过";
$innerbody = "您发布的第{$info}
号借款标复审未通过";
foreach ( $memail as $v ) 
{
if ( 0 < $v['tip1'] ) 
{
addinnermsg( $v['id'], "刚刚您的借款标复审未通过", $innerbody );
}
if ( 0 < $v['tip2'] ) 
{
$to = empty( $to ) ? $v['user_email'] : $to.",".$v['user_email'];
}
}
break;
case "chk10" : $to = "";
$subject = "您在".$datag['web_name']."的借款标已满标";
$body = "刚刚您在".$datag['web_name']."的第{$info}
号借款标已满标，请登陆查看";
$innerbody = "刚刚您的借款标已满标";
foreach ( $memail as $v ) 
{
if ( 0 < $v['tip1'] ) 
{
addinnermsg( $v['id'], "刚刚您的第{$info}
号借款标已满标", $innerbody );
}
if ( 0 < $v['tip2'] ) 
{
$to = empty( $to ) ? $v['user_email'] : $to.",".$v['user_email'];
}
}
break;
case "chk11" : $to = "";
$subject = "您在".$datag['web_name']."的借款标已流标";
$body = "您在".$datag['web_name']."发布的第{$info}
号借款标已流标，请登陆查看";
$innerbody = "您的第{$info}
号借款标已流标";
foreach ( $memail as $v ) 
{
if ( 0 < $v['tip1'] ) 
{
addinnermsg( $v['id'], "刚刚您的借款标已流标", $innerbody );
}
if ( 0 < $v['tip2'] ) 
{
$to = empty( $to ) ? $v['user_email'] : $to.",".$v['user_email'];
}
}
break;
case "chk25" : $to = "";
$subject = "您在".$datag['web_name']."的借入的还款进行了还款操作";
$body = "您对在".$datag['web_name']."借入的第{$info}
号借款进行了还款，请登陆查看";
$innerbody = "您对借入的第{$info}
号借款进行了还款";
foreach ( $memail as $v ) 
{
if ( 0 < $v['tip1'] ) 
{
addinnermsg( $v['id'], "您对借入标还款进行了还款操作", $innerbody );
}
if ( 0 < $v['tip2'] ) 
{
$to = empty( $to ) ? $v['user_email'] : $to.",".$v['user_email'];
}
}
break;
case "chk27" : $to = "";
$subject = "您在".$datag['web_name']."设置的第{$autoid}
号自动投标按设置投了新标";
$body = "您在".$datag['web_name']."设置的第{$autoid}
号自动投标按设置对第{$info}
号借款进行了投标，请登陆查看";
$innerbody = "您设置的第{$autoid}
号自动投标对第{$info}
号借款进行了投标";
foreach ( $memail as $v ) 
{
if ( 0 < $v['tip1'] ) 
{
addinnermsg( $v['id'], "您设置的第{$autoid}
号自动投标按设置投了新标", $innerbody );
}
if ( 0 < $v['tip2'] ) 
{
$to = empty( $to ) ? $v['user_email'] : $to.",".$v['user_email'];
}
}
break;
case "chk14" : $to = "";
$subject = "您在".$datag['web_name']."投标的借款成功了";
$body = "您在".$datag['web_name']."投标的第{$info}
号借款借出成功了";
$innerbody = "您投标的借款成功了";
foreach ( $memail as $v ) 
{
if ( 0 < $v['tip1'] ) 
{
addinnermsg( $v['id'], "您投标的第{$info}
号借款借款成功", $innerbody );
}
if ( 0 < $v['tip2'] ) 
{
$to = empty( $to ) ? $v['user_email'] : $to.",".$v['user_email'];
}
}
break;
case "chk15" : $to = "";
$subject = "您在".$datag['web_name']."投标的借款流标了";
$body = "您在".$datag['web_name']."投标的第{$info}
号借款流标了，相关资金已经返回帐户，请登陆查看";
$innerbody = "您投标的借款流标了";
foreach ( $memail as $v ) 
{
if ( 0 < $v['tip1'] ) 
{
addinnermsg( $v['id'], "您投标的第{$info}
号借款流标了，相关资金已经返回帐户", $innerbody );
}
if ( 0 < $v['tip2'] ) 
{
$to = empty( $to ) ? $v['user_email'] : $to.",".$v['user_email'];
}
}
break;
case "chk16" : $to = "";
$subject = "您在".$datag['web_name']."借出的借款收到了新的还款";
$body = "您在".$datag['web_name']."借出的第{$info}
号借款收到了新的还款，请登陆查看";
$innerbody = "您借出的借款收到了新的还款";
foreach ( $memail as $v ) 
{
if ( 0 < $v['tip1'] ) 
{
addinnermsg( $v['id'], "您借出的第{$info}
号借款收到了新的还款", $innerbody );
}
if ( 0 < $v['tip2'] ) 
{
$to = empty( $to ) ? $v['user_email'] : $to.",".$v['user_email'];
}
}
break;
case "chk18" : $to = "";
$subject = "您在".$datag['web_name']."借出的借款逾期网站代还了本金";
$body = "您在".$datag['web_name']."借出的第{$info}
号借款逾期网站代还了本金，请登陆查看";
$innerbody = "您借出的第{$info}
号借款逾期网站代还了本金";
foreach ( $memail as $v ) 
{
if ( 0 < $v['tip1'] ) 
{
addinnermsg( $v['id'], "您借出的第{$info}
号借款逾期网站代还了本金", $innerbody );
}
if ( 0 < $v['tip2'] ) 
{
$to = empty( $to ) ? $v['user_email'] : $to.",".$v['user_email'];
}
}
break;
}
}
function investMoney( $uid, $borrow_id, $money, $_is_auto = 0 ) 
{
$pre =C("DB_PREFIX" );
$done = false;
$datag = get_global_setting( );
$dataname =C("DB_NAME");
$db_host =C("DB_HOST");
$db_user =C("DB_USER");
$db_pwd =C("DB_PWD");

$bdb = new PDO( "mysql:host=".$db_host.";dbname=".$dataname."", "".$db_user."", "".$db_pwd."" );
$bdb->beginTransaction( );
$bId = $borrow_id;
$sql1 = "SELECT suo FROM lzh_borrow_info_lock WHERE id = ? FOR UPDATE";
$stmt1 = $bdb->prepare( $sql1 );
$stmt1->bindParam( 1, $bId );
$stmt1->execute();
$binfo =M("borrow_info" )->field( "borrow_uid,borrow_money,borrow_interest_rate,borrow_type,borrow_duration,repayment_type,has_borrow,reward_money,money_collect")->find($borrow_id);
$vminfo = getminfo( $uid, "m.user_leve,m.time_limit,mm.account_money,mm.back_money,mm.money_collect");

if ($vminfo['account_money'] + $vminfo['back_money'] + $binfo['reward_money'] < $money ) 
{
return "您当前的可用金额为：".($vminfo['account_money'] + $vminfo['back_money'] + $binfo['reward_money'] )." 对不起，可用余额不足，不能投标";
}
if (0 < $binfo['money_collect'] && $vminfo['money_collect'] < $binfo['money_collect']) 
{
return "对不起，此标设置有投标待收金额限制，您当前的待收金额为".$vminfo['money_collect']."元，小于该标设置的待收金额限制".$binfo['money_collect']."元。";
}
$fee_rate = $datag['fee_invest_manage'] / 100;
$havemoney = $binfo['has_borrow'];
if ( $binfo['borrow_money'] - $havemoney - $money < 0 ) 
{
return "对不起，此标还差".( $binfo['borrow_money'] - $havemoney )."元满标，您最多投标".( $binfo['borrow_money'] - $havemoney )."元";
}
$borrow_invest =M("borrow_investor" )->where( "borrow_id = {\$borrow_id}" )->sum("investor_capital");
$investMoney = D("borrow_investor");
$investMoney->startTrans( );
$investinfo['status'] = 1;
$investinfo['borrow_id'] = $borrow_id;
$investinfo['investor_uid'] = $uid;
$investinfo['borrow_uid'] = $binfo['borrow_uid'];
if ($binfo['borrow_money'] < $borrow_invest['investor_capital']) 
{
$investinfo['investor_capital'] = $binfo['borrow_money'] - $binfo['has_borrow'];
}
else 
{
$investinfo['investor_capital'] = $money;
}
$investinfo['is_auto'] = $_is_auto;
$investinfo['add_time'] = time( );
$savedetail = array( );
switch ($binfo['repayment_type']) 
{

case 1 : 
$investinfo['investor_interest'] = getfloatvalue( $binfo['borrow_interest_rate'] / 360 * $investinfo['investor_capital'] * $binfo['borrow_duration'] / 100, 4 );
$investinfo['invest_fee'] = getfloatvalue( $fee_rate * $investinfo['investor_interest'], 4 );
$invest_info_id =M("borrow_investor" )->add( $investinfo );
$investdetail['borrow_id'] = $borrow_id;
$investdetail['invest_id'] = $invest_info_id;
$investdetail['investor_uid'] = $uid;
$investdetail['borrow_uid'] = $binfo['borrow_uid'];
$investdetail['capital'] = $investinfo['investor_capital'];
$investdetail['interest'] = $investinfo['investor_interest'];
$investdetail['interest_fee'] = $investinfo['invest_fee'];
$investdetail['status'] = 0;
$investdetail['sort_order'] = 1;
$investdetail['total'] = 1;
$savedetail[] = $investdetail;
break;
case 2 : 
$monthData['type'] = "all";
$monthData['money'] = $investinfo['investor_capital'];
$monthData['year_apr'] = $binfo['borrow_interest_rate'];
$monthData['duration'] = $binfo['borrow_duration'];
$repay_detail = equalmonth( $monthData );
$investinfo['investor_interest'] = $repay_detail['repayment_money'] - $investinfo['investor_capital'];
$investinfo['invest_fee'] = getfloatvalue( $fee_rate * $investinfo['investor_interest'], 4 );
$invest_info_id =M("borrow_investor" )->add( $investinfo );
$monthDataDetail['money'] = $investinfo['investor_capital'];
$monthDataDetail['year_apr'] = $binfo['borrow_interest_rate'];
$monthDataDetail['duration'] = $binfo['borrow_duration'];
$repay_list = equalmonth( $monthDataDetail );
$i = 1;
foreach ( $repay_list as $key => $v ) 
{
$investdetail['borrow_id'] = $borrow_id;
$investdetail['invest_id'] = $invest_info_id;
$investdetail['investor_uid'] = $uid;
$investdetail['borrow_uid'] = $binfo['borrow_uid'];
$investdetail['capital'] = $v['capital'];
$investdetail['interest'] = $v['interest'];
$investdetail['interest_fee'] = getfloatvalue( $fee_rate * $v['interest'], 4 );
$investdetail['status'] = 0;
$investdetail['sort_order'] = $i;
$investdetail['total'] = $binfo['borrow_duration'];
$i++;
$savedetail[] = $investdetail;
}
break;
case 3 : 
$monthData['month_times'] = $binfo['borrow_duration'];
$monthData['account'] = $investinfo['investor_capital'];
$monthData['year_apr'] = $binfo['borrow_interest_rate'];
$monthData['type'] = "all";
$repay_detail = equalseason( $monthData );
$investinfo['investor_interest'] = $repay_detail['repayment_money'] - $investinfo['investor_capital'];
$investinfo['invest_fee'] = getfloatvalue( $fee_rate * $investinfo['investor_interest'], 4 );
$invest_info_id =M("borrow_investor" )->add( $investinfo );
$monthDataDetail['month_times'] = $binfo['borrow_duration'];
$monthDataDetail['account'] = $investinfo['investor_capital'];
$monthDataDetail['year_apr'] = $binfo['borrow_interest_rate'];
$repay_list = equalseason( $monthDataDetail );
$i = 1;
foreach ( $repay_list as $key => $v ) 
{
$investdetail['borrow_id'] = $borrow_id;
$investdetail['invest_id'] = $invest_info_id;
$investdetail['investor_uid'] = $uid;
$investdetail['borrow_uid'] = $binfo['borrow_uid'];
$investdetail['capital'] = $v['capital'];
$investdetail['interest'] = $v['interest'];
$investdetail['interest_fee'] = getfloatvalue( $fee_rate * $v['interest'], 4 );
$investdetail['status'] = 0;
$investdetail['sort_order'] = $i;
$investdetail['total'] = $binfo['borrow_duration'];
$i++;
$savedetail[] = $investdetail;
}
break;
case 4 : $monthData['month_times'] = $binfo['borrow_duration'];
$monthData['account'] = $investinfo['investor_capital'];
$monthData['year_apr'] = $binfo['borrow_interest_rate'];
$monthData['type'] = "all";
$repay_detail = equalendmonth( $monthData );
$investinfo['investor_interest'] = $repay_detail['repayment_account'] - $investinfo['investor_capital'];
$investinfo['invest_fee'] = getfloatvalue( $fee_rate * $investinfo['investor_interest'], 4 );
$invest_info_id =M("borrow_investor" )->add( $investinfo );
$monthDataDetail['month_times'] = $binfo['borrow_duration'];
$monthDataDetail['account'] = $investinfo['investor_capital'];
$monthDataDetail['year_apr'] = $binfo['borrow_interest_rate'];
$repay_list = equalendmonth( $monthDataDetail );
$i = 1;
foreach ( $repay_list as $key => $v ) 
{
$investdetail['borrow_id'] = $borrow_id;
$investdetail['invest_id'] = $invest_info_id;
$investdetail['investor_uid'] = $uid;
$investdetail['borrow_uid'] = $binfo['borrow_uid'];
$investdetail['capital'] = $v['capital'];
$investdetail['interest'] = $v['interest'];
$investdetail['interest_fee'] = getfloatvalue( $fee_rate * $v['interest'], 4 );
$investdetail['status'] = 0;
$investdetail['sort_order'] = $i;
$investdetail['total'] = $binfo['borrow_duration'];
$i++;
$savedetail[] = $investdetail;
}
break;
case 5 :
$monthData['month_times'] = $binfo['borrow_duration'];
$monthData['account'] = $investinfo['investor_capital'];
$monthData['year_apr'] = $binfo['borrow_interest_rate'];
$monthData['type'] = "all";
$repay_detail = equalendmonthonly( $monthData );
$investinfo['investor_interest'] = $repay_detail['repayment_account'] - $investinfo['investor_capital'];
$investinfo['invest_fee'] = getfloatvalue( $fee_rate * $investinfo['investor_interest'], 4 );
$invest_info_id =M("borrow_investor" )->add( $investinfo );
$monthDataDetail['month_times'] = $binfo['borrow_duration'];
$monthDataDetail['account'] = $investinfo['investor_capital'];
$monthDataDetail['year_apr'] = $binfo['borrow_interest_rate'];
$monthDataDetail['type'] = "all";
$repay_list = equalendmonthonly( $monthDataDetail );
$investdetail['borrow_id'] = $borrow_id;
$investdetail['invest_id'] = $invest_info_id;
$investdetail['investor_uid'] = $uid;
$investdetail['borrow_uid'] = $binfo['borrow_uid'];
$investdetail['capital'] = $repay_list['capital'];
$investdetail['interest'] = $repay_list['interest'];
$investdetail['interest_fee'] = getfloatvalue($fee_rate * $repay_list['interest'], 4);
$investdetail['status'] = 0;
$investdetail['sort_order'] = 1;
$investdetail['total'] = 1;
$savedetail[] = $investdetail;
break;
}

foreach ( $savedetail as $key => $val ) 
{
$invest_defail_id =M("investor_detail" )->add($val);
}
$last_have_money =M("borrow_info" )->getFieldById($borrow_id, "has_borrow");
$upborrowsql = "update `{$pre}borrow_info` set ";
$upborrowsql .= "`has_borrow`=".( $last_have_money + $money ).",`borrow_times`=`borrow_times`+1";
$upborrowsql .= " WHERE `id`={$borrow_id}";
$upborrow_res = M( )->execute( $upborrowsql );

if ( $invest_defail_id && $invest_info_id && $upborrow_res ) 
{
$investMoney->commit( );
$res = membermoneylog( $uid, 6, 0 - $money, "对{$borrow_id}
号标进行投标", $binfo['borrow_uid'] );
$today_reward = explode( "|", $datag['today_reward'] );
if ( $binfo['repayment_type'] == "1" ) 
{
$reward_rate = floatval( $today_reward[0] );
}
else if ( $binfo['borrow_duration'] == 1 ) 
{
$reward_rate = floatval( $today_reward[0] );
}
else if ( $binfo['borrow_duration'] == 2 ) 
{
$reward_rate = floatval( $today_reward[1] );
}
else 
{
$reward_rate = floatval( $today_reward[2] );
}
if ( $binfo['borrow_type'] != 3 ) 
{
$vd['add_time'] = array( "lt", time( ) );
$vd['investor_uid'] = $uid;
$borrow_invest_count =M("borrow_investor" )->where( $vd )->count( "id" );
if ( 0 < $reward_rate && 0 < $vminfo['back_money'] && 0 < $borrow_invest_count ) 
{
if ( $vminfo['back_money'] < $money ) 
{
$reward_money_s = $vminfo['back_money'];
}
else 
{
$reward_money_s = $money;
}
$save_reward['borrow_id'] = $borrow_id;
$save_reward['reward_uid'] = $uid;
$save_reward['invest_money'] = $reward_money_s;
$save_reward['reward_money'] = $reward_money_s * $reward_rate / 1000;
$save_reward['reward_status'] = 0;
$save_reward['add_time'] = time( );
$save_reward['add_ip'] = get_client_ip( );
$newidxt =M("today_reward" )->add( $save_reward );
if ( $newidxt ) 
{
$result = membermoneylog( $uid, 33, $save_reward['reward_money'], "续投有效金额({$reward_money_s}
)的奖励({$borrow_id}
号标)预奖励", 0, "@网站管理员@" );
}
}
else 
{
$result = true;
}
}
if ( $havemoney + $money == $binfo['borrow_money'] ) 
{
borrowfull( $borrow_id, $binfo['borrow_type'] );
}
if ( !$res && !$result ) 
{
M( "investor_detail" )->where( "invest_id={$invest_info_id}
" )->delete( );
M( "borrow_investor" )->where( "id={$invest_info_id}
" )->delete( );
$upborrowsql = "update `{$pre}
borrow_info` set ";
$upborrowsql .= "`has_borrow`=".$havemoney.",`borrow_times`=`borrow_times`-1";
$upborrowsql .= " WHERE `id`={$borrow_id}
";
$upborrow_res = M( )->execute( $upborrowsql );
$done = false;
}
else 
{
$done = true;
}
}
else 
{
$investMoney->rollback( );
}
return $done;
}
function borrowFull( $borrow_id, $btype = 0 ) 
{
$pre =C("DB_PREFIX" );
if ( $btype == 3 ) 
{
borrowapproved( $borrow_id );
sleep( 3 );
borrowrepayment( $borrow_id, 1 );
}
else 
{
$saveborrow['borrow_status'] = 4;
$saveborrow['full_time'] = time( );
$upborrow_res =M("borrow_info" )->where( "id={$borrow_id}
" )->save( $saveborrow );
}
}
function borrowRefuse( $borrow_id, $type ) 
{
$pre =C("DB_PREFIX" );
$done = false;
$borrowInvestor = D( "borrow_investor" );
$binfo =M("borrow_info" )->field( "id,borrow_type,borrow_money,borrow_uid,borrow_duration,repayment_type" )->find( $borrow_id );
$investorList =M("borrow_investor" )->field( "id,investor_uid,investor_capital" )->where( "borrow_id={$borrow_id}
" )->select( );
M( "investor_detail" )->where( "borrow_id={$borrow_id}
" )->delete( );
if ( $binfo['borrow_type'] == 1 ) 
{
$limit_credit = memberlimitlog( $binfo['borrow_uid'], 12, $binfo['borrow_money'], $info = "{$borrow_id}
号标流标,返还借款信用额度" );
}
$borrowInvestor->startTrans( );
$bstatus = $type == 2 ? 3 : 5;
$upborrow_info =M("borrow_info" )->where( "id={$borrow_id}
" )->setField( "borrow_status", $bstatus );
$buname =M("members" )->getFieldById( $binfo['borrow_uid'], "user_name" );
if ( is_array( $investorList ) ) 
{
$upsummary_res =M("borrow_investor" )->where( "borrow_id={$borrow_id}
" )->setField( "status", $type );
$moneynewid_x_temp = true;
$bxid_temp = true;
foreach ( $investorList as $v ) 
{
mtip( "chk15", $v['investor_uid'], $borrow_id );
$accountMoney_investor =M("member_money" )->field( true )->find( $v['investor_uid'] );
$datamoney_x['uid'] = $v['investor_uid'];
$datamoney_x['type'] = $type == 3 ? 16 : 8;
$datamoney_x['affect_money'] = $v['investor_capital'];
$datamoney_x['account_money'] = $accountMoney_investor['account_money'] + $datamoney_x['affect_money'];
$datamoney_x['collect_money'] = $accountMoney_investor['money_collect'];
$datamoney_x['freeze_money'] = $accountMoney_investor['money_freeze'] - $datamoney_x['affect_money'];
$datamoney_x['back_money'] = $accountMoney_investor['back_money'];
$mmoney_x['money_freeze'] = $datamoney_x['freeze_money'];
$mmoney_x['money_collect'] = $datamoney_x['collect_money'];
$mmoney_x['account_money'] = $datamoney_x['account_money'];
$mmoney_x['back_money'] = $datamoney_x['back_money'];
$_xstr = $type == 3 ? "复审未通过" : "募集期内标未满,流标";
$datamoney_x['info'] = "第{$borrow_id}
号标".$_xstr."，返回冻结资金";
$datamoney_x['add_time'] = time( );
$datamoney_x['add_ip'] = get_client_ip( );
$datamoney_x['target_uid'] = $binfo['borrow_uid'];
$datamoney_x['target_uname'] = $buname;
$moneynewid_x =M("member_moneylog" )->add( $datamoney_x );
if ( $moneynewid_x ) 
{
$bxid =M("member_money" )->where( "uid={$datamoney_x['uid']}
" )->save( $mmoney_x );
}
$moneynewid_x_temp = $moneynewid_x_temp && $moneynewid_x;
$bxid_temp = $bxid_temp && $bxid;
}
}
else 
{
$moneynewid_x_temp = true;
$bxid_temp = true;
$upsummary_res = true;
}
if ( $moneynewid_x_temp && $upsummary_res && $bxid_temp && $upborrow_info ) 
{
$listreward =M("today_reward" )->field( "reward_uid,reward_money" )->where( "borrow_id={$borrow_id}
AND reward_status=0" )->select( );
if ( !empty( $listreward ) ) 
{
foreach ( $listreward as $v ) 
{
membermoneylog( $v['reward_uid'], 35, 0 - $v['reward_money'], "续投奖励({$borrow_id}
号标)预奖励取消", 0, "@网站管理员@" );
}
$updata_s['deal_time'] = time( );
$updata_s['reward_status'] = 2;
M( "today_reward" )->where( "borrow_id={$borrow_id}
AND reward_status=0" )->save( $updata_s );
}
$done = true;
$borrowInvestor->commit( );
}
else 
{
$borrowInvestor->rollback( );
}
return $done;
}
function borrowApproved( $borrow_id ) 
{
$pre =C("DB_PREFIX" );
$done = false;
$_P_fee = get_global_setting( );
$invest_integral = $_P_fee['invest_integral'];
$borrowInvestor = D( "borrow_investor" );
$binfo =M("borrow_info" )->field( "borrow_type,reward_type,reward_num,borrow_fee,borrow_money,borrow_uid,borrow_duration,repayment_type" )->find( $borrow_id );
$investorList = $borrowInvestor->field( "id,borrow_id,investor_uid,investor_capital,investor_interest,reward_money" )->where( "borrow_id={$borrow_id}
" )->select( );
$endTime = strtotime( date( "Y-m-d", time( ) )." ".$_P_fee['back_time'] );
if ( $binfo['borrow_type'] == 3 || $binfo['repayment_type'] == 1 ) 
{
$deadline_last = strtotime( "+{$binfo['borrow_duration']}
day", $endTime );
}
else 
{
$deadline_last = strtotime( "+{$binfo['borrow_duration']}
month", $endTime );
}
$getIntegralDays = intval( ( $deadline_last - $endTime ) / 3600 / 24 );
$borrowInvestor->startTrans( );
try 
{
$_investor_num = count( $investorList );
foreach ( $investorList as $key => $v ) 
{
$_reward_money = 0;
if ( 0 < $binfo['reward_type'] ) 
{
$investorList[$key]['reward_money'] = getfloatvalue( $v['investor_capital'] * $binfo['reward_num'] / 100, 4 );
}
else 
{
$investorList[$key]['reward_money'] = 0;
}
mtip( "chk14", $v['investor_uid'], $borrow_id );
$upsummary_res = M( )->execute( "update `{$pre}
borrow_investor` set `deadline`={$deadline_last}
,`status`=4,`reward_money`='".$investorList[$key]['reward_money']."' WHERE `id`={$v['id']}
" );
}
$upborrow_res = M( )->execute( "update `lzh_borrow_info` set `deadline`={$deadline_last}
,`borrow_status`=6  WHERE `id`={$borrow_id}
" );
switch ( $binfo['repayment_type'] ) 
{
case 2 : case 3 : case 4 : for ($i = 1; $i <= $binfo['borrow_duration']; $i++ ) 
{
$deadline = 0;
$deadline = strtotime( "+{$i}
month", $endTime );
$updetail_res = M( )->execute( "update `lzh_investor_detail` set `deadline`={$deadline}
,`status`=7 WHERE `borrow_id`={$borrow_id}
AND `sort_order`={$i}
" );
break;
}
case 1 : case 5 : $deadline = 0;
$deadline = $deadline_last;
$updetail_res = M( )->execute( "update `{$pre}
investor_detail` set `deadline`={$deadline}
,`status`=7 WHERE `borrow_id`={$borrow_id}
" );
break;
}
if ( $updetail_res && $upsummary_res && $upborrow_res ) 
{
$done = true;
$borrowInvestor->commit( );
}
else 
{
$done = false;
$borrowInvestor->rollback( );
}
}
catch ( Exception $e ) 
{
$done = false;
$borrowInvestor->rollback( );
}
if ( $done ) 
{
$_P_fee = get_global_setting( );
$_borraccount = membermoneylog( $binfo['borrow_uid'], 17, $binfo['borrow_money'], "第{$borrow_id}
号标复审通过，借款金额入帐" );
if ( !$_borraccount ) 
{
return false;
}
$_borrfee = membermoneylog( $binfo['borrow_uid'], 18, 0 - $binfo['borrow_fee'], "第{$borrow_id}
号标借款成功，扣除借款管理费" );
if ( !$_borrfee ) 
{
return false;
}
$_freezefee = membermoneylog( $binfo['borrow_uid'], 19, 0 - $binfo['borrow_money'] * $_P_fee['money_deposit'] / 100, "第{$borrow_id}
号标借款成功，冻结{$_P_fee['money_deposit']}
%的保证金" );
if ( !$_freezefee ) 
{
return false;
}
$_investor_num = count( $investorList );
$_remoney_do = true;
foreach ( $investorList as $v ) 
{
$integ = intval( $v['investor_capital'] * $getIntegralDays * $invest_integral / 1000 );
$reintegral = memberintegrallog( $v['investor_uid'], 2, $integ, "第{$borrow_id}
号标复审通过，应获积分：".$integ."分,投资金额：".$v['investor_capital']."元,投资天数：".$getIntegralDays."天" );
if ( isbirth( $v['investor_uid'] ) ) 
{
$reintegral = memberintegrallog( $v['investor_uid'], 2, $integ, "亲，祝您生日快乐，本站特赠送您{$integ}
积分作为礼物，以表祝福。" );
}
$wmap['investor_uid'] = $v['investor_uid'];
$wmap['borrow_id'] = $v['borrow_id'];
$daishou =M("investor_detail" )->field( "interest" )->where( "investor_uid = {$v['investor_uid']}
and borrow_id = {$v['borrow_id']}
and invest_id ={$v['id']}
" )->sum( "interest" );
if ( 0 < $v['reward_money'] ) 
{
$_remoney_do = false;
$_reward_m = membermoneylog( $v['investor_uid'], 20, $v['reward_money'], "第{$borrow_id}
号标复审通过，获取投标奖励", $binfo['borrow_uid'] );
$_reward_m_give = membermoneylog( $binfo['borrow_uid'], 21, 0 - $v['reward_money'], "第{$borrow_id}
号标复审通过，支付投标奖励", $v['investor_uid'] );
if ( $_reward_m && $_reward_m_give ) 
{
$_remoney_do = true;
}
}
$remcollect = membermoneylog( $v['investor_uid'], 15, $v['investor_capital'], "第{$borrow_id}
号标复审通过，冻结本金成为待收金额", $binfo['borrow_uid'] );
$reinterestcollect = membermoneylog( $v['investor_uid'], 28, $daishou, "第{$borrow_id}
号标复审通过，应收利息成为待收利息", $binfo['borrow_uid'] );
$vo =M("members" )->field( "user_name,recommend_id,recommend_type" )->find( $v['investor_uid'] );
$_rate = $_P_fee['award_invest'] / 1000;
$jiangli = getfloatvalue( $_rate * $v['investor_capital'], 2 );
if ( !( $vo['recommend_id'] != 0 && $vo['recommend_type'] == 0 ) && !( ( $binfo['borrow_type'] == "1" || $binfo['borrow_type'] == "2" || $binfo['borrow_type'] == "5" ) && $binfo['repayment_type'] != "1" ) ) 
{
membermoneylog( $vo['recommend_id'], 13, $jiangli, $vo['user_name']."对{$borrow_id}
号标投资成功，你获得推广奖励".$jiangli."元。", $v['investor_uid'] );
}
}
if ( !$_remoney_do || !$remcollect || !$reinterestcollect ) 
{
return false;
}
$listreward =M("today_reward" )->field( "reward_uid,reward_money" )->where( "borrow_id={$borrow_id}
AND reward_status=0" )->select( );
if ( !empty( $listreward ) ) 
{
foreach ( $listreward as $v ) 
{
membermoneylog( $v['reward_uid'], 34, $v['reward_money'], "续投奖励({$borrow_id}
号标)预奖励到账", 0, "@网站管理员@" );
}
$updata_s['deal_time'] = time( );
$updata_s['reward_status'] = 1;
M( "today_reward" )->where( "borrow_id={$borrow_id}
AND reward_status=0" )->save( $updata_s );
}
}
return $done;
}
function lastRepayment( $binfo ) 
{
$x = true;
if ( $binfo['borrow_type'] == 2 ) 
{
$x = false;
$x = memberlimitlog( $binfo['borrow_uid'], 8, $binfo['borrow_money'], $info = "{$binfo['id']}
号标还款完成" );
if ( !$x ) 
{
return false;
}
$vocuhlist =M("borrow_vouch" )->field( "uid,vouch_money" )->where( "borrow_id={$binfo['id']}
" )->select( );
foreach ( $vocuhlist as $vv ) 
{
$x = memberlimitlog( $vv['uid'], 10, $vv['vouch_money'], $info = "您担保的{$binfo['id']}
号标还款完成" );
}
}
else if ( $binfo['borrow_type'] == 1 ) 
{
$x = false;
$x = memberlimitlog( $binfo['borrow_uid'], 7, $binfo['borrow_money'], $info = "{$binfo['id']}
号标还款完成" );
}
else 
{
$x = true;
}
if ( !$x ) 
{
return false;
}
$_P_fee = get_global_setting( );
if ( $_P_fee['money_deposit'] == 0 ) 
{
$bxid = true;
}
else 
{
$accountMoney_borrower =M("member_money" )->field( "account_money,money_collect,money_freeze,back_money" )->find( $binfo['borrow_uid'] );
$datamoney_x['uid'] = $binfo['borrow_uid'];
$datamoney_x['type'] = 24;
$datamoney_x['affect_money'] = $binfo['borrow_money'] * $_P_fee['money_deposit'] / 100;
$datamoney_x['account_money'] = $accountMoney_borrower['account_money'] + $datamoney_x['affect_money'];
$datamoney_x['collect_money'] = $accountMoney_borrower['money_collect'];
$datamoney_x['freeze_money'] = $accountMoney_borrower['money_freeze'] - $datamoney_x['affect_money'];
$datamoney_x['back_money'] = $accountMoney_borrower['back_money'];
$mmoney_x['money_freeze'] = $datamoney_x['freeze_money'];
$mmoney_x['money_collect'] = $datamoney_x['collect_money'];
$mmoney_x['account_money'] = $datamoney_x['account_money'];
$mmoney_x['back_money'] = $datamoney_x['back_money'];
$datamoney_x['info'] = "网站对{$binfo['id']}
号标还款完成的解冻保证金";
$datamoney_x['add_time'] = time( );
$datamoney_x['add_ip'] = get_client_ip( );
$datamoney_x['target_uid'] = 0;
$datamoney_x['target_uname'] = "@网站管理员@";
$moneynewid_x =M("member_moneylog" )->add( $datamoney_x );
if ( $moneynewid_x ) 
{
$bxid =M("member_money" )->where( "uid={$datamoney_x['uid']}
" )->save( $mmoney_x );
}
}
if ( $bxid && $x ) 
{
return true;
}
else 
{
return false;
}
}
function borrowRepayment( $borrow_id, $sort_order, $type = 1 ) 
{
$pre =C("DB_PREFIX" );
$done = false;
$borrowDetail = D( "investor_detail" );
$binfo =M("borrow_info" )->field( "id,borrow_uid,borrow_type,borrow_money,borrow_duration,repayment_type,has_pay,total,deadline" )->find( $borrow_id );
$b_member =M("members" )->field( "user_name" )->find( $binfo['borrow_uid'] );
if ( $sort_order <= $binfo['has_pay'] ) 
{
return "本期已还过，不用再还";
}
if ( $binfo['has_pay'] == $binfo['total'] ) 
{
return "此标已经还完，不用再还";
}
if ( $binfo['has_pay'] + 1 < $sort_order ) 
{
return ( ( "对不起，此借款第".( $binfo['has_pay'] + 1 ) )."期还未还，请先还第".( $binfo['has_pay'] + 1 ) )."期";
}
if ( time( ) < $binfo['deadline'] && $type == 2 ) 
{
return "此标还没逾期，不用代还";
}
$voxe = $borrowDetail->field( "sort_order,sum(capital) as capital, sum(interest) as interest,sum(interest_fee) as interest_fee,deadline,substitute_time" )->where( "borrow_id={$borrow_id}
" )->group( "sort_order" )->select( );
foreach ( $voxe as $ee => $ss ) 
{
if ( $ss['sort_order'] == $sort_order ) 
{
$vo = $ss;
}
}
if ( $vo['deadline'] < time( ) ) 
{
$is_expired = true;
if ( 0 < $vo['substitute_time'] ) 
{
$is_substitute = true;
}
else 
{
$is_substitute = false;
}
$expired_days = getexpireddays( $vo['deadline'] );
$expired_money = getexpiredmoney( $expired_days, $vo['capital'], $vo['interest'] );
$call_fee = getexpiredcallfee( $expired_days, $vo['capital'], $vo['interest'] );
}
else 
{
$is_expired = false;
$expired_days = 0;
$expired_money = 0;
$call_fee = 0;
}
mtip( "chk25", $binfo['borrow_uid'], $borrow_id );
$accountMoney_borrower =M("member_money" )->field( "money_freeze,money_collect,account_money,back_money" )->find( $binfo['borrow_uid'] );
if ( $type == 1 && $binfo['borrow_type'] != 3 && $accountMoney_borrower['account_money'] + $accountMoney_borrower['back_money'] < $vo['capital'] + $vo['interest'] + $expired_money + $call_fee ) 
{
return "帐户可用余额不足，本期还款共需".( $vo['capital'] + $vo['interest'] + $expired_money + $call_fee )."元，请先充值";
}
if ( $is_substitute && $is_expired ) 
{
$borrowDetail->startTrans( );
$datamoney_x['uid'] = $binfo['borrow_uid'];
$datamoney_x['type'] = 11;
$datamoney_x['affect_money'] = 0 - ( $vo['capital'] + $vo['interest'] );
if ( $datamoney_x['affect_money'] + $accountMoney_borrower['back_money'] < 0 ) 
{
$datamoney_x['account_money'] = $accountMoney_borrower['account_money'] + $accountMoney_borrower['back_money'] + $datamoney_x['affect_money'];
$datamoney_x['back_money'] = 0;
}
else 
{
$datamoney_x['account_money'] = $accountMoney_borrower['account_money'];
$datamoney_x['back_money'] = $accountMoney_borrower['back_money'] + $datamoney_x['affect_money'];
}
$datamoney_x['collect_money'] = $accountMoney_borrower['money_collect'];
$datamoney_x['freeze_money'] = $accountMoney_borrower['money_freeze'];
$mmoney_x['money_freeze'] = $datamoney_x['freeze_money'];
$mmoney_x['money_collect'] = $datamoney_x['collect_money'];
$mmoney_x['account_money'] = $datamoney_x['account_money'];
$mmoney_x['back_money'] = $datamoney_x['back_money'];
$datamoney_x['info'] = "对{$borrow_id}
号标第{$sort_order}
期还款";
$datamoney_x['add_time'] = time( );
$datamoney_x['add_ip'] = get_client_ip( );
$datamoney_x['target_uid'] = 0;
$datamoney_x['target_uname'] = "@网站管理员@";
$moneynewid_x =M("member_moneylog" )->add( $datamoney_x );
if ( $moneynewid_x ) 
{
$bxid_1 =M("member_money" )->where( "uid={$datamoney_x['uid']}
" )->save( $mmoney_x );
}
$accountMoney =M("member_money" )->field( "money_freeze,money_collect,account_money,back_money" )->find( $binfo['borrow_uid'] );
$datamoney_x = array( );
$mmoney_x = array( );
$datamoney_x['uid'] = $binfo['borrow_uid'];
$datamoney_x['type'] = 30;
$datamoney_x['affect_money'] = 0 - $expired_money;
if ( $datamoney_x['affect_money'] + $accountMoney['back_money'] < 0 ) 
{
$datamoney_x['account_money'] = $accountMoney['account_money'] + $accountMoney['back_money'] + $datamoney_x['affect_money'];
$datamoney_x['back_money'] = 0;
}
else 
{
$datamoney_x['account_money'] = $accountMoney['account_money'];
$datamoney_x['back_money'] = $accountMoney['back_money'] + $datamoney_x['affect_money'];
}
$datamoney_x['collect_money'] = $accountMoney['money_collect'];
$datamoney_x['freeze_money'] = $accountMoney['money_freeze'];
$mmoney_x['money_freeze'] = $datamoney_x['freeze_money'];
$mmoney_x['money_collect'] = $datamoney_x['collect_money'];
$mmoney_x['account_money'] = $datamoney_x['account_money'];
$mmoney_x['back_money'] = $datamoney_x['back_money'];
$datamoney_x['info'] = "{$borrow_id}
号标第{$sort_order}
期的逾期罚息";
$datamoney_x['add_time'] = time( );
$datamoney_x['add_ip'] = get_client_ip( );
$datamoney_x['target_uid'] = 0;
$datamoney_x['target_uname'] = "@网站管理员@";
$moneynewid_x =M("member_moneylog" )->add( $datamoney_x );
if ( $moneynewid_x ) 
{
$bxid_2 =M("member_money" )->where( "uid={$datamoney_x['uid']}
" )->save( $mmoney_x );
}
$accountMoney_2 =M("member_money" )->field( "money_freeze,money_collect,account_money,back_money" )->find( $binfo['borrow_uid'] );
$datamoney_x = array( );
$mmoney_x = array( );
$datamoney_x['uid'] = $binfo['borrow_uid'];
$datamoney_x['type'] = 31;
$datamoney_x['affect_money'] = 0 - $call_fee;
if ( $datamoney_x['affect_money'] + $accountMoney_2['back_money'] < 0 ) 
{
$datamoney_x['account_money'] = $accountMoney_2['account_money'] + $accountMoney_2['back_money'] + $datamoney_x['affect_money'];
$datamoney_x['back_money'] = 0;
}
else 
{
$datamoney_x['account_money'] = $accountMoney_2['account_money'];
$datamoney_x['back_money'] = $accountMoney_2['back_money'] + $datamoney_x['affect_money'];
}
$datamoney_x['collect_money'] = $accountMoney_2['money_collect'];
$datamoney_x['freeze_money'] = $accountMoney_2['money_freeze'];
$mmoney_x['money_freeze'] = $datamoney_x['freeze_money'];
$mmoney_x['money_collect'] = $datamoney_x['collect_money'];
$mmoney_x['account_money'] = $datamoney_x['account_money'];
$mmoney_x['back_money'] = $datamoney_x['back_money'];
$datamoney_x['info'] = "网站对借款人收取的第{$borrow_id}
号标第{$sort_order}
期的逾期催收费";
$datamoney_x['add_time'] = time( );
$datamoney_x['add_ip'] = get_client_ip( );
$datamoney_x['target_uid'] = 0;
$datamoney_x['target_uname'] = "@网站管理员@";
$moneynewid_x =M("member_moneylog" )->add( $datamoney_x );
if ( $moneynewid_x ) 
{
$bxid_3 =M("member_money" )->where( "uid={$datamoney_x['uid']}
" )->save( $mmoney_x );
}
$updetail_res = M( )->execute( "update `{$pre}
investor_detail` set `repayment_time`=".time( ).",`status`=5 WHERE `borrow_id`={$borrow_id}
AND `sort_order`={$sort_order}
" );
$upborrowsql = "update `{$pre}
borrow_info` set ";
$upborrowsql .= "`substitute_money`=0";
if ( $sort_order == $binfo['total'] ) 
{
$upborrowsql .= ",`borrow_status`=10";
}
$upborrowsql .= ",`has_pay`={$sort_order}
";
if ( $is_expired ) 
{
$upborrowsql .= ",`expired_money`=`expired_money`+{$expired_money}
";
}
$upborrowsql .= " WHERE `id`={$borrow_id}
";
$upborrow_res = M( )->execute( $upborrowsql );
if ( $updetail_res && $bxid_1 && $bxid_2 && $bxid_3 && $upborrow_res ) 
{
$borrowDetail->commit( );
canceldebt( $borrow_id );
return true;
}
else 
{
$borrowDetail->rollback( );
return false;
}
}
$detailList = $borrowDetail->field( "invest_id,investor_uid,capital,interest,interest_fee,borrow_id,total" )->where( "borrow_id={$borrow_id}
AND sort_order={$sort_order}
" )->select( );
$datag = get_global_setting( );
$credit_borrow = explode( "|", $datag['credit_borrow'] );
if ( $type == 1 ) 
{
$day_span = ceil( ( $vo['deadline'] - time( ) ) / 86400 );
$credits_money = intval( $vo['capital'] / $credit_borrow[4] );
$credits_info = "对第{$borrow_id}
号标的还款操作,获取投资积分";
if ( 0 <= $day_span && $day_span <= 3 ) 
{
$credits_result = memberintegrallog( $binfo['borrow_uid'], 1, intval( $vo['capital'] / 1000 ), "对第{$borrow_id}
号标进行了正常的还款操作,获取投资积分" );
$idetail_status = 1;
}
else if ( -3 <= $day_span && $day_span < 0 ) 
{
$credits_result = membercreditslog( $binfo['borrow_uid'], 4, $credits_money * $credit_borrow[1], "对第{$borrow_id}
号标的还款操作(迟到还款),扣除信用积分" );
$idetail_status = 3;
}
else if ( $day_span < -3 ) 
{
$credits_result = membercreditslog( $binfo['borrow_uid'], 5, $credits_money * $credit_borrow[2], "对第{$borrow_id}
号标的还款操作(逾期还款),扣除信用积分" );
$idetail_status = 5;
}
else if ( 3 < $day_span ) 
{
$credits_result = memberintegrallog( $binfo['borrow_uid'], 1, intval( $vo['capital'] * $day_span / 1000 ), "对第{$borrow_id}
号标进行了提前还款操作,获取投资积分" );
$idetail_status = 2;
}
if ( !$credits_result ) 
{
return "因积分记录失败，未完成还款操作";
}
}
$borrowDetail->startTrans( );
$bxid = true;
if ( $type == 1 ) 
{
$bxid = false;
$datamoney_x['uid'] = $binfo['borrow_uid'];
$datamoney_x['type'] = 11;
$datamoney_x['affect_money'] = 0 - ( $vo['capital'] + $vo['interest'] );
if ( $datamoney_x['affect_money'] + $accountMoney_borrower['back_money'] < 0 ) 
{
$datamoney_x['account_money'] = floatval( $accountMoney_borrower['account_money'] + $accountMoney_borrower['back_money'] + $datamoney_x['affect_money'] );
$datamoney_x['back_money'] = 0;
}
else 
{
$datamoney_x['account_money'] = $accountMoney_borrower['account_money'];
$datamoney_x['back_money'] = floatval( $accountMoney_borrower['back_money'] ) + $datamoney_x['affect_money'];
}
$datamoney_x['collect_money'] = $accountMoney_borrower['money_collect'];
$datamoney_x['freeze_money'] = $accountMoney_borrower['money_freeze'];
$mmoney_x['money_freeze'] = $datamoney_x['freeze_money'];
$mmoney_x['money_collect'] = $datamoney_x['collect_money'];
$mmoney_x['account_money'] = $datamoney_x['account_money'];
$mmoney_x['back_money'] = $datamoney_x['back_money'];
$datamoney_x['info'] = "对{$borrow_id}
号标第{$sort_order}
期还款";
$datamoney_x['add_time'] = time( );
$datamoney_x['add_ip'] = get_client_ip( );
$datamoney_x['target_uid'] = 0;
$datamoney_x['target_uname'] = "@网站管理员@";
$moneynewid_x =M("member_moneylog" )->add( $datamoney_x );
if ( $moneynewid_x ) 
{
$bxid =M("member_money" )->where( "uid={$datamoney_x['uid']}
" )->save( $mmoney_x );
}
if ( $is_expired ) 
{
if ( 0 < $expired_money ) 
{
$accountMoney =M("member_money" )->field( "money_freeze,money_collect,account_money,back_money" )->find( $binfo['borrow_uid'] );
$datamoney_x = array( );
$mmoney_x = array( );
$datamoney_x['uid'] = $binfo['borrow_uid'];
$datamoney_x['type'] = 30;
$datamoney_x['affect_money'] = 0 - $expired_money;
if ( $datamoney_x['affect_money'] + $accountMoney['back_money'] < 0 ) 
{
$datamoney_x['account_money'] = $accountMoney['account_money'] + $accountMoney['back_money'] + $datamoney_x['affect_money'];
$datamoney_x['back_money'] = 0;
}
else 
{
$datamoney_x['account_money'] = $accountMoney['account_money'];
$datamoney_x['back_money'] = $accountMoney['back_money'] + $datamoney_x['affect_money'];
}
$datamoney_x['collect_money'] = $accountMoney['money_collect'];
$datamoney_x['freeze_money'] = $accountMoney['money_freeze'];
$mmoney_x['money_freeze'] = $datamoney_x['freeze_money'];
$mmoney_x['money_collect'] = $datamoney_x['collect_money'];
$mmoney_x['account_money'] = $datamoney_x['account_money'];
$mmoney_x['back_money'] = $datamoney_x['back_money'];
$datamoney_x['info'] = "{$borrow_id}
号标第{$sort_order}
期的逾期罚息";
$datamoney_x['add_time'] = time( );
$datamoney_x['add_ip'] = get_client_ip( );
$datamoney_x['target_uid'] = 0;
$datamoney_x['target_uname'] = "@网站管理员@";
$moneynewid_x =M("member_moneylog" )->add( $datamoney_x );
if ( $moneynewid_x ) 
{
$bxid =M("member_money" )->where( "uid={$datamoney_x['uid']}
" )->save( $mmoney_x );
}
}
if ( 0 < $call_fee ) 
{
$accountMoney_borrower =M("member_money" )->field( "money_freeze,money_collect,account_money,back_money" )->find( $binfo['borrow_uid'] );
$datamoney_x = array( );
$mmoney_x = array( );
$datamoney_x['uid'] = $binfo['borrow_uid'];
$datamoney_x['type'] = 31;
$datamoney_x['affect_money'] = 0 - $call_fee;
if ( $datamoney_x['affect_money'] + $accountMoney_borrower['back_money'] < 0 ) 
{
$datamoney_x['account_money'] = $accountMoney_borrower['account_money'] + $accountMoney_borrower['back_money'] + $datamoney_x['affect_money'];
$datamoney_x['back_money'] = 0;
}
else 
{
$datamoney_x['account_money'] = $accountMoney_borrower['account_money'];
$datamoney_x['back_money'] = $accountMoney_borrower['back_money'] + $datamoney_x['affect_money'];
}
$datamoney_x['collect_money'] = $accountMoney_borrower['money_collect'];
$datamoney_x['freeze_money'] = $accountMoney_borrower['money_freeze'];
$mmoney_x['money_freeze'] = $datamoney_x['freeze_money'];
$mmoney_x['money_collect'] = $datamoney_x['collect_money'];
$mmoney_x['account_money'] = $datamoney_x['account_money'];
$mmoney_x['back_money'] = $datamoney_x['back_money'];
$datamoney_x['info'] = "网站对借款人收取的第{$borrow_id}
号标第{$sort_order}
期的逾期催收费";
$datamoney_x['add_time'] = time( );
$datamoney_x['add_ip'] = get_client_ip( );
$datamoney_x['target_uid'] = 0;
$datamoney_x['target_uname'] = "@网站管理员@";
$moneynewid_x =M("member_moneylog" )->add( $datamoney_x );
if ( $moneynewid_x ) 
{
$bxid =M("member_money" )->where( "uid={$datamoney_x['uid']}
" )->save( $mmoney_x );
}
}
}
}
$upborrowsql = "update `{$pre}
borrow_info` set ";
$upborrowsql .= "`repayment_money`=`repayment_money`+{$vo['capital']}
";
$upborrowsql .= ",`repayment_interest`=`repayment_interest`+ {$vo['interest']}
";
$upborrowsql .= ",`has_pay`={$sort_order}
";
if ( $type == 2 ) 
{
$total_subs = $vo['capital'] + $vo['interest'];
$upborrowsql .= ",`substitute_money`=`substitute_money`+ {$total_subs}
";
if ( $binfo['has_pay'] + 1 == $binfo['total'] ) 
{
$upborrowsql .= ",`borrow_status`=9";
}
}
if ( $type == 1 && $sort_order == $binfo['total'] ) 
{
$upborrowsql .= ",`borrow_status`=7";
}
if ( $is_expired ) 
{
$upborrowsql .= ",`expired_money`=`expired_money`+{$expired_money}
";
}
$upborrowsql .= " WHERE `id`={$borrow_id}
";
$upborrow_res = M( )->execute( $upborrowsql );
if ( $type == 2 ) 
{
$updetail_res = M( )->execute( "update `{$pre}
investor_detail` set `receive_capital`=`capital`,`substitute_time`=".time( )." ,`substitute_money`=`substitute_money`+{$total_subs}
,`status`=4 WHERE `borrow_id`={$borrow_id}
AND `sort_order`={$sort_order}
" );
}
else if ( $is_expired ) 
{
$updetail_res = M( )->execute( "update `{$pre}
investor_detail` set `receive_capital`=`capital` ,`receive_interest`=(`interest`-`interest_fee`),`repayment_time`=".time( ).",`call_fee`={$call_fee}
,`expired_money`={$expired_money}
,`expired_days`={$expired_days}
,`status`={$idetail_status}
WHERE `borrow_id`={$borrow_id}
AND `sort_order`={$sort_order}
" );
}
else 
{
$updetail_res = M( )->execute( "update `{$pre}
investor_detail` set `receive_capital`=`capital` ,`receive_interest`=(`interest`-`interest_fee`),`repayment_time`=".time( ).", `status`={$idetail_status}
WHERE `borrow_id`={$borrow_id}
AND `sort_order`={$sort_order}
" );
}
$smsUid = "";
foreach ( $detailList as $v ) 
{
$debt =M("invest_detb" )->field( "serialid" )->where( "invest_id={$v['invest_id']}
and status=1" )->find( );
$getInterest = $v['interest'] - $v['interest_fee'];
$upsql = "update `{$pre}
borrow_investor` set ";
$upsql .= "`receive_capital`=`receive_capital`+{$v['capital']}
,";
$upsql .= "`receive_interest`=`receive_interest`+ {$getInterest}
,";
if ( $type == 2 ) 
{
$total_s_invest = $v['capital'] + $getInterest;
$upsql .= "`substitute_money` = `substitute_money` + {$total_s_invest}
,";
}
if ( $sort_order == $binfo['total'] ) 
{
$upsql .= "`status`=5,";
}
$upsql .= "`paid_fee`=`paid_fee`+{$v['interest_fee']}
";
$upsql .= " WHERE `id`={$v['invest_id']}
";
$upinfo_res = M( )->execute( $upsql );
if ( $upinfo_res ) 
{
$accountMoney =M("member_money" )->field( "money_freeze,money_collect,account_money,back_money" )->find( $v['investor_uid'] );
$datamoney['uid'] = $v['investor_uid'];
$datamoney['type'] = $type == 2 ? "10" : "9";
$datamoney['affect_money'] = $v['capital'] + $v['interest'];
$datamoney['collect_money'] = $accountMoney['money_collect'] - $datamoney['affect_money'];
$datamoney['freeze_money'] = $accountMoney['money_freeze'];
if ( $binfo['borrow_type'] != 3 ) 
{
$datamoney['account_money'] = $accountMoney['account_money'];
$datamoney['back_money'] = $accountMoney['back_money'] + $datamoney['affect_money'];
}
else 
{
$datamoney['account_money'] = $accountMoney['account_money'] + $datamoney['affect_money'];
$datamoney['back_money'] = $accountMoney['back_money'];
}
$mmoney['money_freeze'] = $datamoney['freeze_money'];
$mmoney['money_collect'] = $datamoney['collect_money'];
$mmoney['account_money'] = $datamoney['account_money'];
$mmoney['back_money'] = $datamoney['back_money'];
$datamoney['info'] = $type == 2 ? "网站对{$v['borrow_id']}
号标第{$sort_order}
期代还" : "收到会员对{$v['borrow_id']}
号标第{$sort_order}
期的还款";
if ( $debt['serialid'] ) 
{
$datamoney['info'] = $type == 2 ? "网站对{$debt['serialid']}
号债权第{$sort_order}
期代还" : "收到会员对{$debt['serialid']}
号债权第{$sort_order}
期的还款";
}
$datamoney['add_time'] = time( );
$datamoney['add_ip'] = get_client_ip( );
if ( $type == 2 ) 
{
$datamoney['target_uid'] = 0;
$datamoney['target_uname'] = "@网站管理员@";
}
else 
{
$datamoney['target_uid'] = $binfo['borrow_uid'];
$datamoney['target_uname'] = $b_member['user_name'];
}
$moneynewid =M("member_moneylog" )->add( $datamoney );
if ( $moneynewid ) 
{
$xid =M("member_money" )->where( "uid={$datamoney['uid']}
" )->save( $mmoney );
}
if ( $type == 2 ) 
{
mtip( "chk18", $v['investor_uid'], $borrow_id );
}
else 
{
mtip( "chk16", $v['investor_uid'], $borrow_id );
}
$smsUid .= empty( $smsUid ) ? $v['investor_uid'] : ",{$v['investor_uid']}
";
$xid_z = true;
if ( 0 < $v['interest_fee'] && $type == 1 ) 
{
$xid_z = false;
$accountMoney_z =M("member_money" )->field( "money_freeze,money_collect,account_money,back_money" )->find( $v['investor_uid'] );
$datamoney_z['uid'] = $v['investor_uid'];
$datamoney_z['type'] = 23;
$datamoney_z['affect_money'] = 0 - $v['interest_fee'];
$datamoney_z['collect_money'] = $accountMoney_z['money_collect'];
$datamoney_z['freeze_money'] = $accountMoney_z['money_freeze'];
if ( $accountMoney_z['back_money'] + $datamoney_z['affect_money'] < 0 ) 
{
$datamoney_z['back_money'] = 0;
$datamoney_z['account_money'] = $accountMoney_z['account_money'] + $accountMoney_z['back_money'] + $datamoney_z['affect_money'];
}
else 
{
$datamoney_z['account_money'] = $accountMoney_z['account_money'];
$datamoney_z['back_money'] = $accountMoney_z['back_money'] + $datamoney_z['affect_money'];
}
$mmoney_z['money_freeze'] = $datamoney_z['freeze_money'];
$mmoney_z['money_collect'] = $datamoney_z['collect_money'];
$mmoney_z['account_money'] = $datamoney_z['account_money'];
$mmoney_z['back_money'] = $datamoney_z['back_money'];
$datamoney_z['info'] = "网站已将第{$v['borrow_id']}
号标第{$sort_order}
期还款的利息管理费扣除";
$datamoney_z['add_time'] = time( );
$datamoney_z['add_ip'] = get_client_ip( );
$datamoney_z['target_uid'] = 0;
$datamoney_z['target_uname'] = "@网站管理员@";
$moneynewid_z =M("member_moneylog" )->add( $datamoney_z );
if ( $moneynewid_z ) 
{
$xid_z =M("member_money" )->where( "uid={$datamoney_z['uid']}
" )->save( $mmoney_z );
}
}
}
}
if ( $updetail_res && $upinfo_res && $xid && $upborrow_res && $bxid && $xid_z ) 
{
$borrowDetail->commit( );
canceldebt( $borrow_id );
$_last = true;
if ( $binfo['total'] == $binfo['has_pay'] + 1 && $type == 1 ) 
{
$_last = false;
$_is_last = lastrepayment( $binfo );
if ( $_is_last ) 
{
$_last = true;
}
}
$done = true;
$vphone =M("member_info" )->field( "cell_phone" )->where( "uid in({$smsUid}
) and cell_phone !=''" )->select( );
$sphone = "";
foreach ( $vphone as $v ) 
{
$sphone .= empty( $sphone ) ? $v['cell_phone'] : ",{$v['cell_phone']}
";
}
smstip( "payback", $sphone, array( "#ID#", "#ORDER#" ), array( $borrow_id, $sort_order ) );
}
else 
{
$borrowDetail->rollback( );
}
return $done;
}
function getBorrowInterestRate( $rate, $duration ) 
{
return $rate / 1200 * $duration;
}
function getMoneyLog( $map, $size ) 
{
if ( empty( $map['uid'] ) ) 
{
return;
}
if ( $size ) 
{
import( "ORG.Util.Page" );
$count =M("member_moneylog" )->where( $map )->count( "id" );
$p = new Page( $count, $size );
$page = $p->show( );
$Lsql = "{$p->firstRow}
,{$p->listRows}
";
}
$list =M("member_moneylog" )->where( $map )->order( "id DESC" )->limit( $Lsql )->select( );
$type_arr =C("MONEY_LOG" );
foreach ( $list as $key => $v ) 
{
$list[$key]['type'] = $type_arr[$v['type']];
}
$row = array( );
$row['list'] = $list;
$row['page'] = $page;
return $row;
}
function memberMoneyLog( $uid, $type, $amoney, $info = "", $target_uid = "", $target_uname = "", $fee = 0 ) 
{
$xva = floatval( $amoney );
if ( empty( $xva ) ) 
{
return true;
}
$done = false;
$MM =M("member_money" )->field( "money_freeze,money_collect,account_money,back_money" )->find( $uid );
if ( !is_array( $MM ) || empty( $MM ) ) 
{
M( "member_money" )->add( array( "uid" => $uid ) );
$MM =M("member_money" )->field( "money_freeze,money_collect,account_money,back_money" )->find( $uid );
}
$Moneylog = D( "member_moneylog" );
if ( in_array( $type, array( "71", "72", "73" ) ) ) 
{
$type_save = 7;
}
else 
{
$type_save = $type;
}
if ( $target_uname == "" && 0 < $target_uid ) 
{
$tname =M("members" )->getFieldById( $target_uid, "user_name" );
}
else 
{
$tname = $target_uname;
}
if ( $target_uid == "" && $target_uname == "" ) 
{
$target_uid = 0;
$tname = "@网站管理员@";
}
$Moneylog->startTrans( );
$data['uid'] = $uid;
$data['type'] = $type_save;
$data['info'] = $info;
$data['target_uid'] = $target_uid;
$data['target_uname'] = $tname;
$data['add_time'] = time( );
$data['add_ip'] = get_client_ip( );
switch ( $type ) 
{
case 5 : $data['affect_money'] = $amoney;
if ( $MM['back_money'] + $amoney + $fee < 0 ) 
{
$data['back_money'] = 0;
$data['account_money'] = $MM['account_money'] + $MM['back_money'] + $amoney + $fee;
}
else 
{
$data['back_money'] = $MM['back_money'];
$data['account_money'] = $MM['account_money'] + $amoney + $fee;
}
$data['collect_money'] = $MM['money_collect'];
$data['freeze_money'] = $MM['money_freeze'] - $amoney;
break;
case 4 : case 6 : case 37 : $data['affect_money'] = $amoney;
if ( $MM['back_money'] + $amoney + $fee < 0 ) 
{
$data['back_money'] = 0;
$data['account_money'] = $MM['account_money'] + $MM['back_money'] + $amoney + $fee;
}
else 
{
$data['back_money'] = $MM['back_money'] + $amoney + $fee;
$data['account_money'] = $MM['account_money'];
}
$data['collect_money'] = $MM['money_collect'];
$data['freeze_money'] = $MM['money_freeze'] - $amoney;
break;
case 12 : $data['affect_money'] = $amoney;
if ( abs( $fee ) < $MM['account_money'] + $MM['back_money'] ) 
{
if ( $MM['back_money'] + $amoney + $fee < 0 ) 
{
$data['back_money'] = 0;
$data['account_money'] = $MM['account_money'] + $MM['back_money'] + $amoney + $fee;
}
else 
{
$data['back_money'] = $MM['back_money'] + $amoney + $fee;
$data['account_money'] = $MM['account_money'];
}
$data['collect_money'] = $MM['money_collect'];
$data['freeze_money'] = $MM['money_freeze'] - $amoney;
}
else 
{
if ( $MM['back_money'] + $amoney + $fee < 0 ) 
{
$data['back_money'] = 0;
$data['account_money'] = $MM['account_money'] + $MM['back_money'] + $amoney;
}
else 
{
$data['back_money'] = $MM['back_money'] + $amoney;
$data['account_money'] = $MM['account_money'];
}
$data['collect_money'] = $MM['money_collect'];
$data['freeze_money'] = $MM['money_freeze'] - $amoney + $fee;
}
break;
case 29 : $data['affect_money'] = $amoney;
$data['account_money'] = $MM['account_money'];
$data['back_money'] = $MM['back_money'];
$data['collect_money'] = $MM['money_collect'];
$data['freeze_money'] = $MM['money_freeze'] + $amoney + $fee;
break;
case 36 : $data['affect_money'] = $amoney;
if ( abs( $fee ) < $MM['account_money'] + $MM['back_money'] ) 
{
if ( $MM['back_money'] + $fee < 0 ) 
{
$data['account_money'] = $MM['account_money'] + $MM['back_money'] + $fee;
$data['back_money'] = 0;
}
else 
{
$data['account_money'] = $MM['account_money'];
$data['back_money'] = $MM['back_money'] + $fee;
}
$data['collect_money'] = $MM['money_collect'];
$data['freeze_money'] = $MM['money_freeze'];
}
else 
{
$data['account_money'] = $MM['account_money'];
$data['back_money'] = $MM['back_money'];
$data['collect_money'] = $MM['money_collect'];
$data['freeze_money'] = $MM['money_freeze'] + $fee;
}
break;
case 8 : case 19 : case 24 : case 34 : $data['affect_money'] = $amoney;
if ( $MM['account_money'] + $amoney < 0 ) 
{
$data['account_money'] = 0;
$data['back_money'] = $MM['account_money'] + $MM['back_money'] + $amoney;
}
else 
{
$data['account_money'] = $MM['account_money'] + $amoney;
$data['back_money'] = $MM['back_money'];
}
$data['collect_money'] = $MM['money_collect'];
$data['freeze_money'] = $MM['money_freeze'] - $amoney;
break;
case 3 : case 17 : case 18 : case 20 : case 21 : case 40 : case 41 : case 42 : $data['affect_money'] = $amoney;
if ( $MM['account_money'] + $amoney < 0 ) 
{
$data['account_money'] = 0;
$data['back_money'] = $MM['account_money'] + $MM['back_money'] + $amoney;
}
else 
{
$data['account_money'] = $MM['account_money'] + $amoney;
$data['back_money'] = $MM['back_money'];
}
$data['collect_money'] = $MM['money_collect'];
$data['freeze_money'] = $MM['money_freeze'];
break;
case 9 : case 10 : $data['affect_money'] = $amoney;
$data['account_money'] = $MM['account_money'];
$data['collect_money'] = $MM['money_collect'] - $amoney;
$data['freeze_money'] = $MM['money_freeze'];
$data['back_money'] = $MM['back_money'] + $amoney;
break;
case 15 : case 39 : $data['affect_money'] = $amoney;
$data['account_money'] = $MM['account_money'];
$data['collect_money'] = $MM['money_collect'] + $amoney;
$data['freeze_money'] = $MM['money_freeze'] - $amoney;
$data['back_money'] = $MM['back_money'];
break;
case 28 : case 38 : case 73 : $data['affect_money'] = $amoney;
$data['account_money'] = $MM['account_money'];
$data['collect_money'] = $MM['money_collect'] + $amoney;
$data['freeze_money'] = $MM['money_freeze'];
$data['back_money'] = $MM['back_money'];
break;
case 72 : case 33 : case 35 : $data['affect_money'] = $amoney;
$data['account_money'] = $MM['account_money'];
$data['collect_money'] = $MM['money_collect'];
$data['freeze_money'] = $MM['money_freeze'] + $amoney;
$data['back_money'] = $MM['back_money'];
break;
case 71 : default : $data['affect_money'] = $amoney;
if ( $MM['account_money'] + $amoney <= 0 ) 
{
$data['account_money'] = 0;
$data['back_money'] = $MM['account_money'] + $MM['back_money'] + $amoney;
}
else 
{
$data['account_money'] = $MM['account_money'] + $amoney;
$data['back_money'] = $MM['back_money'];
}
$data['collect_money'] = $MM['money_collect'];
$data['freeze_money'] = $MM['money_freeze'];
break;
}
$newid =M("member_moneylog" )->add( $data );
$mmoney['money_freeze'] = $data['freeze_money'];
$mmoney['money_collect'] = $data['collect_money'];
$mmoney['account_money'] = $data['account_money'];
$mmoney['back_money'] = $data['back_money'];
if ( $newid ) 
{
$xid =M("member_money" )->where( "uid={$uid}
" )->save( $mmoney );
}
if ( $xid ) 
{
$done = true;
$Moneylog->commit( );
}
else 
{
$Moneylog->rollback( );
}
return $done;
}
function memberLimitLog( $uid, $type, $alimit, $info = "" ) 
{
$xva = floatval( $alimit );
if ( empty( $xva ) ) 
{
return true;
}
$done = false;
$MM =M("member_money" )->field( "money_freeze,money_collect,account_money,back_money", true )->find( $uid );
if ( !is_array( $MM ) ) 
{
M( "member_money" )->add( array( "uid" => $uid ) );
$MM =M("member_money" )->field( "money_freeze,money_collect,account_money,back_money", true )->find( $uid );
}
$Moneylog = D( "member_moneylog" );
if ( in_array( $type, array( "71", "72", "73" ) ) ) 
{
$type_save = 7;
}
else 
{
$type_save = $type;
}
$Moneylog->startTrans( );
$data['uid'] = $uid;
$data['type'] = $type_save;
$data['info'] = $info;
$data['add_time'] = time( );
$data['add_ip'] = get_client_ip( );
$data['credit_limit'] = 0;
$data['borrow_vouch_limit'] = 0;
$data['invest_vouch_limit'] = 0;
switch ( $type ) 
{
case 1 : case 4 : case 7 : case 12 : $_data['credit_limit'] = $alimit;
break;
case 2 : case 5 : case 8 : $_data['borrow_vouch_limit'] = $alimit;
break;
case 3 : case 6 : case 9 : case 10 : $_data['invest_vouch_limit'] = $alimit;
break;
case 11 : $_data['credit_limit'] = $alimit;
$mmoney['credit_limit'] = $MM['credit_limit'] + $_data['credit_limit'];
break;
}
$data = array_merge( $data, $_data );
$newid =M("member_limitlog" )->add( $data );
$mmoney['credit_cuse'] = $MM['credit_cuse'] + $data['credit_limit'];
$mmoney['borrow_vouch_cuse'] = $MM['borrow_vouch_cuse'] + $data['borrow_vouch_limit'];
$mmoney['invest_vouch_cuse'] = $MM['invest_vouch_cuse'] + $data['invest_vouch_limit'];
if ( $newid ) 
{
$xid =M("member_money" )->where( "uid={$uid}
" )->save( $mmoney );
}
if ( $xid ) 
{
$Moneylog->commit( );
$done = true;
}
else 
{
$Moneylog->rollback( );
}
return $done;
}
function memberCreditsLog( $uid, $type, $acredits, $info = "无" ) 
{
if ( $acredits == 0 ) 
{
return true;
}
$done = false;
$mCredits =M("members" )->getFieldById( $uid, "credits" );
$Creditslog =D( "member_creditslog" );
$Creditslog->startTrans( );
$data['uid'] = $uid;
$data['type'] = $type;
$data['affect_credits'] = $acredits;
$data['account_credits'] = $mCredits + $acredits;
$data['info'] = $info;
$data['add_time'] = time( );
$data['add_ip'] = get_client_ip( );
$newid = $Creditslog->add( $data );
$xid =M("members" )->where( "id={$uid}
" )->setField( "credits", $data['account_credits'] );
if ( $xid ) 
{
$Creditslog->commit( );
$done = true;
}
else 
{
$Creditslog->rollback( );
}
return $done;
}
function memberIntegralLog( $uid, $type, $integral, $info = "无" ) 
{
if ( $integral == 0 ) 
{
return true;
}
$pre =C("DB_PREFIX" );
$done = false;
$Db = new Model( );
$Db->startTrans( );
$Member = $Db->table( $pre."members" )->where( "id={$uid}
" )->find( );
$data['uid'] = $uid;
$data['type'] = $type;
$data['affect_integral'] = $integral;
$data['active_integral'] = $integral + $Member['active_integral'];
$data['account_integral'] = $integral + $Member['integral'];
$data['info'] = $info;
$data['add_time'] = time( );
$data['add_ip'] = get_client_ip( );
if ( $integral < 0 && $data['active_integral'] < 0 ) 
{
return false;
}
else if ( $integral < 0 && 0 < $data['active_integral'] ) 
{
$data['account_integral'] = $Member['integral'];
}
$newid = $Db->table( $pre."member_integrallog" )->add( $data );
$xid = $Db->table( $pre."members" )->where( "id={$uid}
" )->setInc( "active_integral", $integral );
if ( 0 < $integral ) 
{
$yid = $Db->table( $pre."members" )->where( "id={$uid}
" )->setInc( "integral", $integral );
}
else 
{
$yid = true;
}
if ( $newid && $xid && $yid ) 
{
$Db->commit( );
$done = true;
}
else 
{
$Db->rollback( );
}
return $done;
}
function getMemberMoneySummary( $uid ) 
{
$pre =C("DB_PREFIX" );
$umoney =M("member_money" )->field( true )->find( $uid );
$withdraw =M("member_withdraw" )->field( "withdraw_status,sum(withdraw_money) as withdraw_money,sum(second_fee) as second_fee" )->where( "uid={$uid}
" )->group( "withdraw_status" )->select( );
$withdraw_row = array( );
foreach ( $withdraw as $wkey => $wv ) 
{
$withdraw_row[$wv['withdraw_status']] = $wv;
}
$withdraw0 = $withdraw_row[0];
$withdraw1 = $withdraw_row[1];
$withdraw2 = $withdraw_row[2];
$payonline =M("member_payonline" )->where( "uid={$uid}
AND status=1" )->sum( "money" );
$commission1 =M("borrow_investor" )->where( "investor_uid={$uid}
" )->sum( "paid_fee" );
$commission2 =M("borrow_info" )->where( "borrow_uid={$uid}
AND borrow_status in(2,4)" )->sum( "borrow_fee" );
$uplevefee =M("member_moneylog" )->where( "uid={$uid}
AND type=2" )->sum( "affect_money" );
$czfee =M("member_payonline" )->where( "uid={$uid}
AND status=1" )->sum( "fee" );
$toubiaojl =M("borrow_investor" )->where( "borrow_uid ={$uid}
" )->sum( "reward_money" );
$tuiguangjl =M("member_moneylog" )->where( "uid={$uid}
and type=13" )->sum( "affect_money" );
$xianxiajl =M("member_moneylog" )->where( "uid={$uid}
and type=32" )->sum( "affect_money" );
$xtjl =M("member_moneylog" )->where( "uid={$uid}
and type=34" )->sum( "affect_money" );
$circulation =M("transfer_borrow_investor" )->field( "sum(investor_capital)as investor_capital, sum(investor_interest) as investor_interest, sum(invest_fee) as invest_fee" )->where( "investor_uid=".$uid." and status=1" )->find( );
$moneylog =M("member_moneylog" )->field( "type,sum(affect_money) as money" )->where( "uid={$uid}
" )->group( "type" )->select( );
$list = array( );
foreach ( $moneylog as $vs ) 
{
$list[$vs['type']]['money'] = 0 < $vs['money'] ? $vs['money'] : $vs['money'] * -1;
}
$tx =M("member_withdraw" )->field( "uid,sum(withdraw_money) as withdraw_money,sum(second_fee) as second_fee" )->where( "uid={$uid}
and withdraw_status=2" )->group( "uid" )->select( );
foreach ( $tx as $vt ) 
{
$list['tx']['withdraw_money'] = $vt['withdraw_money'];
$list['tx']['withdraw_fee'] = $vt['second_fee'];
}
$capitalinfo = getmemberborrowscan( $uid );
$money['zye'] = $umoney['account_money'] + $umoney['back_money'] + $umoney['money_collect'] + $umoney['money_freeze'];
$money['kyxjje'] = $umoney['account_money'] + $umoney['back_money'];
$money['djje'] = $umoney['money_freeze'];
$money['jjje'] = 0;
$money['dsbx'] = $capitalinfo['tj']['dsze'] + $capitalinfo['tj']['willgetInterest'] + $circulation['investor_capital'] + $circulation['investor_interest'] - $circulation['invest_fee'];
$money['dfbx'] = $capitalinfo['tj']['dhze'];
$money['dxrtb'] = $capitalinfo['tj']['dqrtb'];
$money['dshtx'] = $withdraw0['withdraw_money'];
$money['clztx'] = $withdraw1['withdraw_money'];
$money['total_1'] = $money['kyxjje'] + $money['jjje'] + $money['dsbx'] - $money['dfbx'] + $money['dxrtb'] + $money['dshtx'] + $money['clztx'];
$money['jzlx'] = $capitalinfo['tj']['earnInterest'];
$money['jflx'] = $capitalinfo['tj']['payInterest'];
$money['xtjj'] = $list['34']['money'] + $list[40]['money'];
$money['ljhyf'] = $list['14']['money'] + $list['22']['money'] + $list['25']['money'] + $list['26']['money'];
$money['ljtxsxf'] = $list['tx']['withdraw_fee'];
$money['ljczsxf'] = $czfee;
$money['ljtbjl'] = $list['20']['money'] + $list[41]['money'];
$money['ljtgjl'] = $list['13']['money'];
$money['xxjl'] = $list['32']['money'];
$money['jkglf'] = $list['18']['money'];
$money['yqf'] = $list['30']['money'] + $list['31']['money'];
$money['zftbjl'] = $toubiaojl;
$money['total_2'] = $money['jzlx'] - $money['jflx'] - $money['ljhyf'] - $money['ljtxsxf'] - $money['ljczsxf'] + $money['ljtbjl'] + $money['ljtgjl'] + $money['xxjl'] + $money['xtjj'] - $money['jkglf'] - $money['yqf'] - $money['zftbjl'];
$money['ljtzje'] = $capitalinfo['tj']['borrowOut'];
$money['ljjrje'] = $capitalinfo['tj']['borrowIn'];
$money['ljczje'] = $payonline;
$money['ljtxje'] = $withdraw2['withdraw_money'];
$money['ljzfyj'] = $commission1 + $commission2;
$money['dslxze'] = $capitalinfo['tj']['willgetInterest'] + $circulation['investor_interest'];
$money['dflxze'] = $capitalinfo['tj']['willpayInterest'];
return $money;
}
function getBorrowInvest( $borrowid = 0, $uid ) 
{
if ( empty( $borrowid ) ) 
{
return;
}
$vx =M("borrow_info" )->field( "id" )->where( "id={$borrowid}
AND borrow_uid={$uid}
" )->find( );
if ( !is_array( $vx ) ) 
{
return;
}
$binfo =M("borrow_info" )->field( "borrow_name,borrow_uid,borrow_type,borrow_duration,repayment_type,has_pay,total,deadline" )->find( $borrowid );
$list = array( );
switch ( $binfo['repayment_type'] ) 
{
case 1 : case 5 : $field = "borrow_id,sort_order,sum(capital) as capital,sum(interest) as interest,status,sum(receive_interest+receive_capital+if(receive_capital>=0,interest_fee,0)) as paid,deadline";
$vo =M("investor_detail" )->field( $field )->where( "borrow_id={$borrowid}
AND `sort_order`=1" )->group( "sort_order" )->find( );
$status_arr = array( "还未还", "已还完", "已提前还款", "迟到还款", "网站代还本金", "逾期还款", "", "待还" );
if ( $vo['deadline'] < time( ) && $vo['status'] == 7 ) 
{
$vo['status'] = "逾期未还";
}
else 
{
$vo['status'] = $status_arr[$vo['status']];
}
$vo['needpay'] = sprintf( "%.2f", $vo['interest'] + $vo['capital'] - $vo['paid'] );
$list[] = $vo;
break;
default : for ($i = 1; $i <= $binfo['borrow_duration']; $i++ ) 
{
$field = "borrow_id,sort_order,sum(capital) as capital,sum(interest) as interest,status,sum(receive_interest+receive_capital+if(receive_capital>=0,interest_fee,0)) as paid,deadline";
$vo =M("investor_detail" )->field( $field )->where( "borrow_id={$borrowid}
AND `sort_order`={$i}
" )->group( "sort_order" )->find( );
$status_arr = array( "还未还", "已还完", "已提前还款", "迟到还款", "网站代还本金", "逾期还款", "", "待还" );
if ( $vo['deadline'] < time( ) && $vo['status'] == 7 ) 
{
$vo['status'] = "逾期未还";
}
else 
{
$vo['status'] = $status_arr[$vo['status']];
}
$vo['needpay'] = sprintf( "%.2f", $vo['interest'] + $vo['capital'] - $vo['paid'] );
$list[] = $vo;
break;
}
}
$row = array( );
$row['list'] = $list;
$row['name'] = $binfo['borrow_name'];
return $row;
}
function getDurationCount( $uid = 0 ) 
{
if ( empty( $uid ) ) 
{
return;
}
$pre =C("DB_PREFIX" );
$field = "d.status,d.repayment_time";
$sql = "select {$field}
from {$pre}
investor_detail d left join {$pre}
borrow_info b ON b.id=d.borrow_id where d.borrow_id in(select tb.id from {$pre}
borrow_info tb where tb.borrow_uid={$uid}
) group by d.borrow_id, d.sort_order";
$list = m( )->query( $sql );
$week_1 = array( strtotime( "-7 day", strtotime( date( "Y-m-d", time( ) )." 00:00:00" ) ), strtotime( date( "Y-m-d", time( ) )." 23:59:59" ) );
$time_1 = array( strtotime( "-1 month", strtotime( date( "Y-m-d", time( ) )." 00:00:00" ) ), strtotime( date( "Y-m-d", time( ) )." 23:59:59" ) );
$time_6 = array( strtotime( "-6 month", strtotime( date( "Y-m-d", time( ) )." 00:00:00" ) ), strtotime( date( "Y-m-d", time( ) )." 23:59:59" ) );
$row_time_1 = array( );
$row_time_2 = array( );
$row_time_3 = array( );
$row_time_4 = array( );
foreach ( $list as $v ) 
{
switch ( $v['status'] ) 
{
case 1 : if ( $time_6[0] < $v['repayment_time'] && $v['repayment_time'] < $time_6[1] ) 
{
$row_time_3['zc'] = $row_time_3['zc'] + 1;
if ( $week_1[0] < $v['repayment_time'] && $v['repayment_time'] < $week_1[1] ) 
{
$row_time_1['zc'] = $row_time_1['zc'] + 1;
}
if ( $time_1[0] < $v['repayment_time'] && $v['repayment_time'] < $time_1[1] ) 
{
$row_time_2['zc'] = $row_time_2['zc'] + 1;
}
}
$row_time_4['zc'] = $row_time_4['zc'] + 1;
break;
case 2 : if ( $time_6[0] < $v['repayment_time'] && $v['repayment_time'] < $time_6[1] ) 
{
$row_time_3['tq'] = $row_time_3['tq'] + 1;
if ( $week_1[0] < $v['repayment_time'] && $v['repayment_time'] < $week_1[1] ) 
{
$row_time_1['tq'] = $row_time_1['tq'] + 1;
}
if ( $time_1[0] < $v['repayment_time'] && $v['repayment_time'] < $time_1[1] ) 
{
$row_time_2['tq'] = $row_time_2['tq'] + 1;
}
}
$row_time_4['tq'] = $row_time_4['tq'] + 1;
break;
case 3 : if ( $time_6[0] < $v['repayment_time'] && $v['repayment_time'] < $time_6[1] ) 
{
$row_time_3['ch'] = $row_time_3['ch'] + 1;
if ( $week_1[0] < $v['repayment_time'] && $v['repayment_time'] < $week_1[1] ) 
{
$row_time_1['ch'] = $row_time_1['ch'] + 1;
}
if ( $time_1[0] < $v['repayment_time'] && $v['repayment_time'] < $time_1[1] ) 
{
$row_time_2['ch'] = $row_time_2['ch'] + 1;
}
}
$row_time_4['ch'] = $row_time_4['ch'] + 1;
break;
case 5 : if ( $time_6[0] < $v['repayment_time'] && $v['repayment_time'] < $time_6[1] ) 
{
$row_time_3['yq'] = $row_time_3['yq'] + 1;
if ( $week_1[0] < $v['repayment_time'] && $v['repayment_time'] < $week_1[1] ) 
{
$row_time_1['yq'] = $row_time_1['yq'] + 1;
}
if ( $time_1[0] < $v['repayment_time'] && $v['repayment_time'] < $time_1[1] ) 
{
$row_time_2['yq'] = $row_time_2['yq'] + 1;
}
}
$row_time_4['yq'] = $row_time_4['yq'] + 1;
break;
case 6 : if ( $time_6[0] < $v['repayment_time'] && $v['repayment_time'] < $time_6[1] ) 
{
$row_time_3['wh'] = $row_time_3['wh'] + 1;
if ( $week_1[0] < $v['repayment_time'] && $v['repayment_time'] < $week_1[1] ) 
{
$row_time_1['wh'] = $row_time_1['wh'] + 1;
}
if ( $time_1[0] < $v['repayment_time'] && $v['repayment_time'] < $time_1[1] ) 
{
$row_time_2['wh'] = $row_time_2['wh'] + 1;
}
}
$row_time_4['wh'] = $row_time_4['wh'] + 1;
break;
}
}
$row['history1'] = $row_time_1;
$row['history2'] = $row_time_2;
$row['history3'] = $row_time_3;
$row['history4'] = $row_time_4;
return $row;
}
function getMemberBorrow( $uid = 0, $size = 10 ) 
{
if ( empty( $uid ) ) 
{
return;
}
$pre =C("DB_PREFIX" );
$field = "b.borrow_name,d.total,d.borrow_id,d.sort_order,sum(d.capital) as capital,sum(d.interest) as interest,d.status,sum(d.receive_interest+d.receive_capital+if(d.receive_capital>=0,d.interest_fee,0)) as paid,d.deadline";
$sql = "select {$field}
from {$pre}
investor_detail d left join {$pre}
borrow_info b ON b.id=d.borrow_id where d.borrow_id in(select tb.id from {$pre}
borrow_info tb where tb.borrow_status=6 AND tb.borrow_uid={$uid}
) AND d.repayment_time=0 group by d.sort_order, d.borrow_id order by  d.borrow_id,d.sort_order limit 0,10";
$list = m( )->query( $sql );
$status_arr = array( "还未还", "已还完", "已提前还款", "迟到还款", "网站代还本金", "逾期还款", "", "待还" );
foreach ( $list as $key => $v ) 
{
if ( $v['deadline'] < time( ) && $v['status'] == 7 ) 
{
$list[$key]['status'] = "逾期未还";
}
else 
{
$list[$key]['status'] = $status_arr[$v['status']];
}
}
$row = array( );
$row['list'] = $list;
return $row;
}
function getLeftTime( $timeend, $type = 1 ) 
{
if ( $type == 1 ) 
{
$timeend = strtotime( date( "Y-m-d", $timeend )." 23:59:59" );
$timenow = strtotime( date( "Y-m-d", time( ) )." 23:59:59" );
$left = ceil( ( $timeend - $timenow ) / 3600 / 24 );
}
else 
{
$left_arr = timediff( time( ), $timeend );
$left = $left_arr['day']."天 ".$left_arr['hour']."小时 ".$left_arr['min']."分钟 ".$left_arr['sec']."秒";
}
return $left;
}
function timediff( $begin_time, $end_time ) 
{
if ( $begin_time < $end_time ) 
{
$starttime = $begin_time;
$endtime = $end_time;
}
else 
{
$starttime = $end_time;
$endtime = $begin_time;
}
$timediff = $endtime - $starttime;
$days = intval( $timediff / 86400 );
$remain = $timediff % 86400;
$hours = intval( $remain / 3600 );
$remain %= 3600;
$mins = intval( $remain / 60 );
$secs = $remain % 60;
$res = array( "day" => $days, "hour" => $hours, "min" => $mins, "sec" => $secs );
return $res;
}
function addInnerMsg( $uid, $title, $msg ) 
{
if ( empty( $uid ) ) 
{
return;
}
$data['uid'] = $uid;
$data['title'] = $title;
$data['msg'] = $msg;
$data['send_time'] = time( );
m( "inner_msg" )->add( $data );
}
function getTypeList( $parm ) 
{
$Osql = "sort_order DESC";
$field = "id,type_name,type_set,add_time,type_url,type_nid,parent_id";
$Lsql = "{$parm['limit']}
";
$pc = D( "navigation" )->where( "parent_id={$parm['type_id']}
and model='navigation'" )->count( "id" );
if ( 0 < $pc ) 
{
$map['is_hiden'] = 0;
$map['parent_id'] = $parm['type_id'];
$map['model'] = "navigation";
$data = D( "navigation" )->field( $field )->where( $map )->order( $Osql )->limit( $Lsql )->select( );
}
else if ( !isset( $parm['notself'] ) ) 
{
$map['is_hiden'] = 0;
$map['parent_id'] = D( "Acategory" )->getFieldById( $parm['type_id'], "parent_id" );
$data = D( "Acategory" )->field( $field )->where( $map )->order( $Osql )->limit( $Lsql )->select( );
}
$typefix = get_type_leve_nid( $parm['type_id'] );
$typeu = $typefix[0];
$suffix =C("URL_HTML_SUFFIX" );
foreach ( $data as $key => $v ) 
{
if ( $v['type_set'] == 2 ) 
{
if ( empty( $v['type_url'] ) ) 
{
$data[$key]['turl'] = "javascript:alert('请在后台添加此栏目链接');";
}
else 
{
$data[$key]['turl'] = $v['type_url'];
}
}
else if ( $parm['model'] == "navigation" || $v['parent_id'] == 0 ) 
{
$data[$key]['turl'] = mu( "Home/{$v['type_nid']}
/index", "typelist", array( "suffix" => $suffix ) );
}
else if ( $parm['model'] == "article" || $v['parent_id'] == 0 ) 
{
$data[$key]['turl'] = mu( "Home/{$v['type_nid']}
/index", "typelist", array( "suffix" => $suffix ) );
}
else 
{
$data[$key]['turl'] = mu( "Home/{$typeu}
/{$v['type_nid']}
", "typelist", array( "suffix" => $suffix ) );
}
}
$row = array( );
$row = $data;
return $row;
}
function getTypeListActa( $parm ) 
{
$Osql = "sort_order DESC";
$field = "id,type_name,type_set,add_time,type_url,type_nid,parent_id";
$Lsql = "{$parm['limit']}
";
$pc = D( "Acategory" )->where( "parent_id={$parm['type_id']}
and model='article'" )->count( "id" );
if ( 0 < $pc ) 
{
$map['is_hiden'] = 0;
$map['parent_id'] = $parm['type_id'];
$map['model'] = "article";
$data = D( "Acategory" )->field( $field )->where( $map )->order( $Osql )->limit( $Lsql )->select( );
}
else if ( !isset( $parm['notself'] ) ) 
{
$map['is_hiden'] = 0;
$map['parent_id'] = D( "Acategory" )->getFieldById( $parm['type_id'], "parent_id" );
$data = D( "Acategory" )->field( $field )->where( $map )->order( $Osql )->limit( $Lsql )->select( );
}
$typefix = get_type_leve_nid( $parm['type_id'] );
$typeu = $typefix[0];
$suffix =C("URL_HTML_SUFFIX" );
foreach ( $data as $key => $v ) 
{
if ( $v['type_set'] == 2 ) 
{
if ( empty( $v['type_url'] ) ) 
{
$data[$key]['turl'] = "javascript:alert('请在后台添加此栏目链接');";
}
else 
{
$data[$key]['turl'] = $v['type_url'];
}
}
else if ( $parm['model'] == "article" || $v['parent_id'] == 0 ) 
{
$data[$key]['turl'] = mu( "Home/{$v['type_nid']}
/index", "typelist", array( "suffix" => $suffix ) );
}
else 
{
$data[$key]['turl'] = mu( "Home/{$typeu}
/{$v['type_nid']}
", "typelist", array( "suffix" => $suffix ) );
}
}
$row = array( );
$row = $data;
return $row;
}
function newTip( $borrow_id ) 
{
$binfo =M("borrow_info" )->field( "borrow_type,borrow_interest_rate,borrow_duration" )->find( );
if ( $binfo['borrow_type'] == 3 ) 
{
$map['borrow_type'] = 3;
}
else 
{
$map['borrow_type'] = 0;
}
$tiplist =M("borrow_tip" )->field( true )->where( $map )->select( );
foreach ( $tiplist as $key => $v ) 
{
$minfo =M("members m" )->field( "mm.account_money,mm.back_money,m.user_phone" )->join( "lzh_member_money mm on m.id=mm.uid" )->find( $v['uid'] );
if ( $v['interest_rate'] <= $binfo['borrow_interest_rate'] && $v['doration_from'] <= $binfo['borrow_duration'] && $binfo['borrow_duration'] <= $v['doration_to'] && $v['account_money'] <= $minfo['account_money'] + $minfo['back_money'] ) 
{
empty( $tipPhone ) ? ( $tipPhone .= "{$v['user_phone']}
" ) : ( $tipPhone .= ",{$v['user_phone']}
" );
}
}
$smsTxt = fs( "Webconfig/smstxt" );
$smsTxt = de_xie( $smsTxt );
sendsms( $tipPhone, $smsTxt['newtip'] );
}
function getBorrowInterest( $type, $money, $duration, $rate ) 
{
switch ( $type ) 
{
case 1 : $day_rate = $rate / 36000;
$interest = getfloatvalue( $money * $day_rate * $duration, 4 );
break;
case 2 : $parm['duration'] = $duration;
$parm['money'] = $money;
$parm['year_apr'] = $rate;
$parm['type'] = "all";
$intre = equalmonth( $parm );
$interest = $intre['repayment_money'] - $money;
break;
case 3 : $parm['month_times'] = $duration;
$parm['account'] = $money;
$parm['year_apr'] = $rate;
$parm['type'] = "all";
$intre = equalseason( $parm );
$interest = $intre['interest'];
break;
case 4 : $parm['month_times'] = $duration;
$parm['account'] = $money;
$parm['year_apr'] = $rate;
$parm['type'] = "all";
$intre = equalendmonth( $parm );
$interest = $intre['interest'];
break;
case 5 : $parm['month_times'] = $duration;
$parm['account'] = $money;
$parm['year_apr'] = $rate;
$parm['type'] = "all";
$intre = equalendmonthonly( $parm );
$interest = $intre['interest'];
break;
}
return $interest;
}
function EqualMonth( $data = array( ) ) 
{
if ( isset( $data['money'] ) && 0 < $data['money'] ) 
{
$account = $data['money'];
}
else 
{
return "";
}
if ( isset( $data['year_apr'] ) && 0 < $data['year_apr'] ) 
{
$year_apr = $data['year_apr'];
}
else 
{
return "";
}
if ( isset( $data['duration'] ) && 0 < $data['duration'] ) 
{
$duration = $data['duration'];
}
if ( isset( $data['borrow_time'] ) && 0 < $data['borrow_time'] ) 
{
$borrow_time = $data['borrow_time'];
}
else 
{
$borrow_time = time( );
}
$month_apr = $year_apr / 1200;
$_li = pow( 1 + $month_apr, $duration );
$repayment = round( $account * ( $month_apr * $_li ) / ( $_li - 1 ), 4 );
$_result = array( );
if ( isset( $data['type'] ) && $data['type'] == "all" ) 
{
$_result['repayment_money'] = $repayment * $duration;
$_result['monthly_repayment'] = $repayment;
$_result['month_apr'] = round( $month_apr * 100, 4 );
}
else 
{
for ($i = 0; $i < $duration; $i++ ) 
{
if ( $i == 0 ) 
{
$interest = round( $account * $month_apr, 4 );
}
else 
{
$_lu = pow( 1 + $month_apr, $i );
$interest = round( ( $account * $month_apr - $repayment ) * $_lu + $repayment, 4 );
}
$_result[$i]['repayment_money'] = getfloatvalue( $repayment, 4 );
$_result[$i]['repayment_time'] = get_times( array( "time" => $borrow_time, "num" => $i + 1 ) );
$_result[$i]['interest'] = getfloatvalue( $interest, 4 );
$_result[$i]['capital'] = getfloatvalue( $repayment - $interest, 4 );
}
}
return $_result;
}
function EqualSeason( $data = array( ) ) 
{
if ( isset( $data['month_times'] ) && 0 < $data['month_times'] ) 
{
$month_times = $data['month_times'];
}
if ( $month_times % 3 != 0 ) 
{
return false;
}
if ( isset( $data['account'] ) && 0 < $data['account'] ) 
{
$account = $data['account'];
}
else 
{
return "";
}
if ( isset( $data['year_apr'] ) && 0 < $data['year_apr'] ) 
{
$year_apr = $data['year_apr'];
}
else 
{
return "";
}
if ( isset( $data['borrow_time'] ) && 0 < $data['borrow_time'] ) 
{
$borrow_time = $data['borrow_time'];
}
else 
{
$borrow_time = time( );
}
$month_apr = $year_apr / 1200;
$_season = $month_times / 3;
$_season_money = round( $account / $_season, 4 );
$_yes_account = 0;
$repayment_account = 0;
$_all_interest = 0;
for ($i = 0; $i < $month_times; $i++ ) 
{
$repay = $account - $_yes_account;
$interest = round( $repay * $month_apr, 4 );
$repayment_account += $interest;
$capital = 0;
if ( $i % 3 == 2 ) 
{
$capital = $_season_money;
$_yes_account += $capital;
$repay = $account - $_yes_account;
$repayment_account += $capital;
}
$_result[$i]['repayment_money'] = getfloatvalue( $interest + $capital, 4 );
$_result[$i]['repayment_time'] = get_times( array( "time" => $borrow_time, "num" => $i + 1 ) );
$_result[$i]['interest'] = getfloatvalue( $interest, 4 );
$_result[$i]['capital'] = getfloatvalue( $capital, 4 );
$_all_interest += $interest;
}
if ( isset( $data['type'] ) && $data['type'] == "all" ) 
{
$_resul['repayment_money'] = $repayment_account;
$_resul['monthly_repayment'] = round( $repayment_account / $_season, 4 );
$_resul['month_apr'] = round( $month_apr * 100, 4 );
$_resul['interest'] = $_all_interest;
return $_resul;
}
else 
{
return $_result;
}
}
function EqualEndMonth( $data = array( ) ) 
{
if ( isset( $data['month_times'] ) && 0 < $data['month_times'] ) 
{
$month_times = $data['month_times'];
}
if ( isset( $data['account'] ) && 0 < $data['account'] ) 
{
$account = $data['account'];
}
else 
{
return "";
}
if ( isset( $data['year_apr'] ) && 0 < $data['year_apr'] ) 
{
$year_apr = $data['year_apr'];
}
else 
{
return "";
}
if ( isset( $data['borrow_time'] ) && 0 < $data['borrow_time'] ) 
{
$borrow_time = $data['borrow_time'];
}
else 
{
$borrow_time = time( );
}
$month_apr = $year_apr / 1200;
$_yes_account = 0;
$repayment_account = 0;
$_all_interest = 0;
$interest = round( $account * $month_apr, 4 );
for ($i = 0; $i < $month_times; $i++ ) 
{
$capital = 0;
if ( $i + 1 == $month_times ) 
{
$capital = $account;
}
$_result[$i]['repayment_account'] = $interest + $capital;
$_result[$i]['repayment_time'] = get_times( array( "time" => $borrow_time, "num" => $i + 1 ) );
$_result[$i]['interest'] = $interest;
$_result[$i]['capital'] = $capital;
$_all_interest += $interest;
}
if ( isset( $data['type'] ) && $data['type'] == "all" ) 
{
$_resul['repayment_account'] = $account + $interest * $month_times;
$_resul['monthly_repayment'] = $interest;
$_resul['month_apr'] = round( $month_apr * 100, 4 );
$_resul['interest'] = $_all_interest;
return $_resul;
}
else 
{
return $_result;
}
}
function EqualEndMonthOnly( $data = array( ) ) 
{
if ( isset( $data['month_times'] ) && 0 < $data['month_times'] ) 
{
$month_times = $data['month_times'];
}
if ( isset( $data['account'] ) && 0 < $data['account'] ) 
{
$account = $data['account'];
}
else 
{
return "";
}
if ( isset( $data['year_apr'] ) && 0 < $data['year_apr'] ) 
{
$year_apr = $data['year_apr'];
}
else 
{
return "";
}
if ( isset( $data['borrow_time'] ) && 0 < $data['borrow_time'] ) 
{
$borrow_time = $data['borrow_time'];
}
else 
{
$borrow_time = time( );
}
$month_apr = $year_apr / 1200;
$interest = getfloatvalue( $account * $month_apr * $month_times, 4 );
if ( isset( $data['type'] ) && $data['type'] == "all" ) 
{
$_resul['repayment_account'] = $account + $interest;
$_resul['monthly_repayment'] = $interest;
$_resul['month_apr'] = round( $month_apr * 100, 4 );
$_resul['interest'] = $interest;
$_resul['capital'] = $account;
return $_resul;
}
}
function getMinfo($uid,$field = "m.pin_pass,mm.account_money,mm.back_money") 
{
 $pre = C( "DB_PREFIX" );
    $vm = M( "members m" )->field($field)->join( "{$pre}member_money mm ON mm.uid=m.id" )->where( "m.id={$uid}" )->find();
    
return $vm;
}
function getMemberInfoDone( $uid ) 
{
$pre =C("DB_PREFIX" );
$field = "m.id,m.id as uid,m.user_name,mbank.uid as mbank_id,mi.uid as mi_id,mhi.uid as mhi_id,mci.uid as mci_id,mdpi.uid as mdpi_id,mei.uid as mei_id,mfi.uid as mfi_id,s.phone_status,s.id_status,s.email_status,s.safequestion_status";
$row =M("members m" )->field( $field )->join( "{$pre}
member_banks mbank ON m.id=mbank.uid" )->join( "{$pre}
member_contact_info mci ON m.id=mci.uid" )->join( "{$pre}
member_department_info mdpi ON m.id=mdpi.uid" )->join( "{$pre}
member_house_info mhi ON m.id=mhi.uid" )->join( "{$pre}
member_ensure_info mei ON m.id=mei.uid" )->join( "{$pre}
member_info mi ON m.id=mi.uid" )->join( "{$pre}
member_financial_info mfi ON m.id=mfi.uid" )->join( "{$pre}
members_status s ON m.id=s.uid" )->where( "m.id={$uid}
" )->find( );
$is_data =M("member_data_info" )->where( "uid={$row['uid']}
" )->count( "id" );
$i == 0;
if ( 0 < $row['mbank_id'] ) 
{
$i++;
$row['mbank'] = "<span style='color:green'>已填写</span>";
}
else 
{
$row['mbank'] = "<span style='color:black'>未填写</span>";
}
if ( 0 < $row['mci_id'] ) 
{
$i++;
$row['mci'] = "<span style='color:green'>已填写</span>";
}
else 
{
$row['mci'] = "<span style='color:black'>未填写</span>";
}
if ( 0 < $is_data ) 
{
$row['mdi_id'] = $is_data;
$row['mdi'] = "<span style='color:green'>已填写</span>";
}
else 
{
$row['mdi'] = "<span style='color:black'>未填写</span>";
}
if ( 0 < $row['mhi_id'] ) 
{
$i++;
$row['mhi'] = "<span style='color:green'>已填写</span>";
}
else 
{
$row['mhi'] = "<span style='color:black'>未填写</span>";
}
if ( 0 < $row['mdpi_id'] ) 
{
$i++;
$row['mdpi'] = "<span style='color:green'>已填写</span>";
}
else 
{
$row['mdpi'] = "<span style='color:black'>未填写</span>";
}
if ( 0 < $row['mei_id'] ) 
{
$i++;
$row['mei'] = "<span style='color:green'>已填写</span>";
}
else 
{
$row['mei'] = "<span style='color:black'>未填写</span>";
}
if ( 0 < $row['mfi_id'] ) 
{
$i++;
$row['mfi'] = "<span style='color:green'>已填写</span>";
}
else 
{
$row['mfi'] = "<span style='color:black'>未填写</span>";
}
if ( 0 < $row['mi_id'] ) 
{
$i++;
$row['mi'] = "<span style='color:green'>已填写</span>";
}
else 
{
$row['mi'] = "<span style='color:black'>未填写</span>";
}
$row['i'] = $i;
return $row;
}
function getMemberBorrowScan( $uid ) 
{
$field = "borrow_status,count(id) as num,sum(borrow_money) as money,sum(repayment_money) as repayment_money";
$borrowNum =M("borrow_info" )->field( $field )->where( "borrow_uid = {$uid}
" )->group( "borrow_status" )->select( );
foreach ( $borrowNum as $v ) 
{
$borrowCount[$v['borrow_status']] = $v;
}
$field = "status,sort_order,borrow_id,sum(capital) as capital,sum(interest) as interest";
$repaymentNum =M("investor_detail" )->field( $field )->where( "borrow_uid = {$uid}
" )->group( "sort_order,borrow_id" )->select( );
foreach ( $repaymentNum as $v ) 
{
$repaymentStatus[$v['status']]['capital'] += $v['capital'];
$repaymentStatus[$v['status']]['interest'] += $v['interest'];
$repaymentStatus[$v['status']]['num']++;
}
$field = "status,count(id) as num,sum(investor_capital) as investor_capital,sum(reward_money) as reward_money,sum(investor_interest) as investor_interest,sum(receive_capital) as receive_capital,sum(receive_interest) as receive_interest,sum(invest_fee) as invest_fee";
$investNum =M("borrow_investor" )->field( $field )->where( "investor_uid = {$uid}
" )->group( "status" )->select( );
$_reward_money = 0;
foreach ( $investNum as $v ) 
{
$investStatus[$v['status']] = $v;
$_reward_money += floatval( $v['reward_money'] );
}
$field = "borrow_id,sort_order,sum(`capital`) as capital,count(id) as num";
$expiredNum =M("investor_detail" )->field( $field )->where( "`repayment_time`=0 and borrow_uid={$uid}
AND status=7 and `deadline`<".time( )." " )->group( "borrow_id,sort_order" )->select( );
$_expired_money = 0;
foreach ( $expiredNum as $v ) 
{
$expiredStatus[$v['borrow_id']][$v['sort_order']] = $v;
$_expired_money += floatval( $v['capital'] );
}
$rowtj['expiredMoney'] = getfloatvalue( $_expired_money, 2 );
$rowtj['expiredNum'] = count( $expiredNum );
$field = "borrow_id,sort_order,sum(`capital`) as capital,count(id) as num";
$expiredInvestNum =M("investor_detail" )->field( $field )->where( "`repayment_time`=0 and `deadline`<".time( )." and investor_uid={$uid}
AND status <> 0" )->group( "borrow_id,sort_order" )->select( );
$_expired_invest_money = 0;
foreach ( $expiredInvestNum as $v ) 
{
$expiredInvestStatus[$v['borrow_id']][$v['sort_order']] = $v;
$_expired_invest_money += floatval( $v['capital'] );
}
$rowtj['expiredInvestMoney'] = getfloatvalue( $_expired_invest_money, 2 );
$rowtj['expiredInvestNum'] = count( $expiredInvestNum );
$rowtj['jkze'] = getfloatvalue( floatval( $borrowCount[6]['money'] + $borrowCount[7]['money'] + $borrowCount[8]['money'] + $borrowCount[9]['money'] ), 2 );
$rowtj['yhze'] = getfloatvalue( floatval( $borrowCount[6]['repayment_money'] + $borrowCount[7]['repayment_money'] + $borrowCount[8]['repayment_money'] + $borrowCount[9]['repayment_money'] ), 2 );
$rowtj['dhze'] = getfloatvalue( $rowtj['jkze'] - $rowtj['yhze'], 2 );
$rowtj['jcze'] = getfloatvalue( floatval( $investStatus[4]['investor_capital'] ), 2 );
$rowtj['ysze'] = getfloatvalue( floatval( $investStatus[4]['receive_capital'] ), 2 );
$rowtj['dsze'] = getfloatvalue( $rowtj['jcze'] - $rowtj['ysze'], 2 );
$rowtj['fz'] = getfloatvalue( $rowtj['jcze'] - $rowtj['jkze'], 2 );
$rowtj['dqrtb'] = getfloatvalue( $investStatus[1]['investor_capital'], 2 );
$circulation =M("transfer_borrow_investor" )->field( "sum(investor_interest)as investor_interest, sum(invest_fee) as invest_fee" )->where( "investor_uid=".$uid." and status=1" )->find( );
$rowtj['earnInterest'] = getfloatvalue( floatval( $investStatus[5]['receive_interest'] + $investStatus[6]['receive_interest'] + $circulation['investor_interest'] - $investStatus[5]['invest_fee'] - $investStatus[6]['invest_fee'] - $circulation['invest_fee'] ), 2 );
$receive_interest =M("transfer_borrow_investor" )->where( "investor_uid=".$uid )->sum( "investor_capital" );
$rowtj['payInterest'] = getfloatvalue( floatval( $repaymentStatus[1]['interest'] + $repaymentStatus[2]['interest'] + $repaymentStatus[3]['interest'] ), 2 );
$rowtj['willgetInterest'] = getfloatvalue( floatval( $investStatus[4]['investor_interest'] - $investStatus[4]['receive_interest'] ), 2 );
$rowtj['willpayInterest'] = getfloatvalue( floatval( $repaymentStatus[7]['interest'] ), 2 );
$rowtj['borrowOut'] = getfloatvalue( floatval( $investStatus[4]['investor_capital'] + $investStatus[5]['investor_capital'] + $investStatus[6]['investor_capital'] + $receive_interest ), 2 );
$rowtj['borrowIn'] = getfloatvalue( floatval( $borrowCount[6]['money'] + $borrowCount[7]['money'] + $borrowCount[8]['money'] + $borrowCount[9]['money'] ), 2 );
$rowtj['jkcgcs'] = $borrowCount[6]['num'] + $borrowCount[7]['num'] + $borrowCount[8]['num'] + $borrowCount[9]['num'];
$rowtj['tbjl'] = $_reward_money;
$circulation_bor =M("transfer_borrow_investor" )->field( "sum(investor_capital) as investor_capital, count(id) as num" )->where( "investor_uid=".$uid." and status=1" )->find( );
$investStatus[8]['investor_capital'] += $circulation_bor['investor_capital'];
$investStatus[8]['num'] += $circulation_bor['num'];
unset( $circulation_bor );
$circulation_bor =M("transfer_borrow_investor" )->field( "sum(investor_capital) as investor_capital, count(id) as num" )->where( "investor_uid=".$uid." and status=2" )->find( );
$investStatus[9]['investor_capital'] += $circulation_bor['investor_capital'];
$investStatus[9]['num'] += $circulation_bor['num'];
$circulation_bor =M("transfer_borrow_investor i" )->field( "sum(i.investor_capital) as investor_capital, count(i.id) as num" )->where( "i.status=2 and i.investor_uid=".$uid )->join( "{$pre}
transfer_borrow_info b ON b.id=i.borrow_id" )->order( "i.id DESC" )->find( );
$row = array( );
$row['tborrowOut'] = $receive_interest;
$row['borrow'] = $borrowCount;
$row['repayment'] = $repaymentStatus;
$row['invest'] = $investStatus;
$row['tj'] = $rowtj;
$row['circulation_bor'] = $circulation_bor;
return $row;
}
function getUserWC( $uid ) 
{
$row = array( );
$field = "count(id) as num,sum(withdraw_money) as money";
$row['W'] =M("member_withdraw" )->field( $field )->where( "uid={$uid}
AND withdraw_status=2" )->find( );
$field = "count(id) as num,sum(money) as money";
$row['C'] =M("member_payonline" )->field( $field )->where( "uid={$uid}
AND status=1" )->find( );
return $row;
}
function getExpiredDays( $deadline ) 
{
if ( $deadline < 1000 ) 
{
return "数据有误";
}
return ceil( ( time( ) - $deadline ) / 3600 / 24 );
}
function getExpiredMoney( $expired, $capital, $interest ) 
{
$glodata = get_global_setting( );
$expired_fee = explode( "|", $glodata['fee_expired'] );
if ( $expired <= $expired_fee[0] ) 
{
return 0;
}
return getfloatvalue( ( $capital + $interest ) * $expired * $expired_fee[1] / 1000, 2 );
}
function getExpiredCallFee( $expired, $capital, $interest ) 
{
$glodata = get_global_setting( );
$call_fee = explode( "|", $glodata['fee_call'] );
if ( $expired <= $call_fee[0] ) 
{
return 0;
}
return getfloatvalue( ( $capital + $interest ) * $expired * $call_fee[1] / 1000, 2 );
}
function getNet( $uid ) 
{
$_minfo = getminfo( $uid, "m.pin_pass,mm.account_money,mm.back_money,mm.credit_cuse,mm.money_collect" );
$borrowNum =M("borrow_info" )->field( "borrow_type,count(id) as num,sum(borrow_money) as money,sum(repayment_money) as repayment_money" )->where( "borrow_uid = {$uid}
AND borrow_status=6 " )->group( "borrow_type" )->select( );
$borrowDe = array( );
foreach ( $borrowNum as $k => $v ) 
{
$borrowDe[$v['borrow_type']] = $v['money'] - $v['repayment_money'];
}
$_netMoney = getfloatvalue( 0.9 * $_minfo['money_collect'] - $borrowDe[4], 2 );
return $_netMoney;
}
function setBackUrl( $per = "", $suf = "" ) 
{
$url = $_SERVER['HTTP_REFERER'];
$urlArr = parse_url( $url );
$query = $per."?1=1&".$urlArr['query'].$suf;
session( "listaction", $query );
}
function logInvestCredit( $uid, $money, $type, $borrow_id, $duration ) 
{
$xs = $type == 1 ? 1 : 2;
if ( $duration == 1 ) 
{
$xs = 1;
}
$credit = $xs * $duration * $money;
$data['uid'] = $uid;
$data['borrow_id'] = $borrow_id;
$data['invest_money'] = $money;
$data['duration'] = $duration;
$data['invest_type'] = $type;
$data['get_credit'] = $credit;
$data['add_time'] = time( );
$data['add_ip'] = get_client_ip( );
$newid =M("invest_credit" )->add( $data );
$update['invest_credits'] = array( "exp", "`invest_credits`+{$credit}
" );
if ( $newid ) 
{
M( "members" )->where( "id={$uid}
" )->save( $update );
}
}
function isBirth( $uid ) 
{
$pre =C("DB_PREFIX" );
$id =M("member_info i" )->field( "i.idcard" )->join( "{$pre}
members_status s ON s.uid=i.uid" )->where( "i.uid = {$uid}
AND s.id_status=1 " )->find( );
if ( !id ) 
{
return false;
}
$bir = substr( $id['idcard'], 10, 4 );
$now = date( "md" );
if ( $bir == $now ) 
{
return true;
}
else 
{
return false;
}
}
function sendemail( $to, $subject, $body ) 
{
$msgconfig = fs( "Webconfig/msgconfig" );
import( "ORG.Net.Email" );
$port = $msgconfig['stmp']['port'];
$smtpserver = $msgconfig['stmp']['server'];
$smtpuser = $msgconfig['stmp']['user'];
$smtppwd = $msgconfig['stmp']['pass'];
$mailtype = "HTML";
$sender = $msgconfig['stmp']['user'];
$smtp = new smtp( $smtpserver, $port, true, $smtpuser, $smtppwd, $sender );
$send = $smtp->sendmail( $to, $sender, $subject, $body, $mailtype );
return $send;
}
function getTInvestUrl( $id ) 
{
return __APP__."/tinvest/{$id}
".c( "URL_HTML_SUFFIX" );
}
function TinvestMoney( $uid, $borrow_id, $num, $duration, $_is_auto = 0, $repayment_type = 5 ) 
{
$pre =C("DB_PREFIX" );
$done = false;
$datag = get_global_setting( );
$parm = "企业直投";
$dataname =C("DB_NAME" );
$db_host =C("DB_HOST" );
$db_user =C("DB_USER" );
$db_pwd =C("DB_PWD" );
$bdb = new PDO( "mysql:host=".$db_host.";dbname=".$dataname."", "".$db_user."", "".$db_pwd."" );
$bdb->beginTransaction( );
$bId = $borrow_id;
$sql1 = "SELECT suo FROM lzh_transfer_borrow_info_lock WHERE id = ? FOR UPDATE";
$stmt1 = $bdb->prepare( $sql1 );
$stmt1->bindParam( 1, $bId );
$stmt1->execute( );
$invest_integral = $datag['invest_integral'];
$fee_rate = $datag['fee_invest_manage'];
$binfo =M("transfer_borrow_info" )->field( "id,borrow_uid,borrow_money,borrow_interest_rate,borrow_duration,repayment_type,transfer_out,transfer_back,transfer_total,per_transfer,is_show,deadline,min_month,reward_rate,increase_rate,borrow_fee,is_jijin" )->find( $borrow_id );
if ( $binfo['is_jijin'] == 1 ) 
{
$parm = "定投宝";
}
else 
{
$parm = "企业直投";
}
$vminfo = getminfo( $uid, "m.user_leve,m.time_limit,mm.account_money,mm.back_money,mm.money_collect" );
if ( $num < 1 ) 
{
return "对不起,您购买的份数小于最低允许购买份数,请重新输入认购份数！";
}
if ( $binfo['transfer_total'] - $binfo['transfer_out'] < $num ) 
{
return "对不起,您购买的份数已超出当前可供购买份数,请重新输入认购份数！";
}
if ( $num < 1 ) 
{
return "最少要投一份！";
}
$money = $binfo['per_transfer'] * $num;
if ( $vminfo['account_money'] + $vminfo['back_money'] < $money ) 
{
return "对不起，您的可用余额不足,不能投标";
}
$investMoney = D( "transfer_borrow_investor" );
$investMoney->startTrans( );
$now = time( );
if ( $binfo['is_jijin'] == 1 ) 
{
$binfo['repayment_type'] = $repayment_type;
}
switch ( $binfo['repayment_type'] ) 
{
case 1 : $investinfo['status'] = 1;
$investinfo['borrow_id'] = $borrow_id;
$investinfo['investor_uid'] = $uid;
$investinfo['borrow_uid'] = $binfo['borrow_uid'];
$investinfo['investor_capital'] = $money;
$investinfo['transfer_num'] = $num;
$investinfo['transfer_month'] = $duration;
$investinfo['deadline'] = $now + $duration * 24 * 3600;
$investinfo['reward_money'] = getfloatvalue( $binfo['reward_rate'] * $money / 100, 2 );
$interest_rate = $binfo['borrow_interest_rate'];
$investinfo['investor_interest'] = getfloatvalue( $interest_rate / 360 * $money * $duration / 100, 2 );
$investinfo['final_interest_rate'] = $interest_rate;
$investinfo['invest_fee'] = getfloatvalue( $fee_rate * $investinfo['investor_interest'] / 100, 2 );
$invest_info_id =M("transfer_borrow_investor" )->add( $investinfo );
$investDetail['repayment_time'] = 0;
$investDetail['borrow_id'] = $borrow_id;
$investDetail['invest_id'] = $invest_info_id;
$investDetail['investor_uid'] = $uid;
$investDetail['borrow_uid'] = $binfo['borrow_uid'];
$investDetail['capital'] = $money;
$investDetail['interest'] = getfloatvalue( $investinfo['investor_interest'], 2 );
$investDetail['interest_fee'] = $investinfo['invest_fee'];
$investDetail['status'] = 7;
$investDetail['receive_interest'] = 0;
$investDetail['receive_capital'] = 0;
$investDetail['sort_order'] = 1;
$investDetail['total'] = 1;
$investDetail['deadline'] = $now + $duration * 24 * 3600;
$IDetail[] = $investDetail;
break;
case 2 : $interest_rate = $binfo['borrow_interest_rate'];
$monthData['duration'] = $duration;
$monthData['money'] = $money;
$monthData['year_apr'] = $interest_rate;
$monthData['type'] = "all";
$repay_detail = equalmonth( $monthData );
$investinfo['status'] = 1;
$investinfo['borrow_id'] = $borrow_id;
$investinfo['investor_uid'] = $uid;
$investinfo['borrow_uid'] = $binfo['borrow_uid'];
$investinfo['investor_capital'] = $money;
$investinfo['transfer_num'] = $num;
$investinfo['transfer_month'] = $duration;
$investinfo['add_time'] = $now;
$investinfo['deadline'] = $now + $duration * 30 * 24 * 3600;
$investinfo['reward_money'] = getfloatvalue( $binfo['reward_rate'] * $money / 100, 2 );
$investinfo['final_interest_rate'] = $interest_rate;
$monthDataDetail['duration'] = $duration;
$monthDataDetail['money'] = $money;
$monthDataDetail['year_apr'] = $interest_rate;
$repay_list = equalmonth( $monthDataDetail );
$i = 1;
foreach ( $repay_list as $key => $v ) 
{
$investinfo['investor_interest'] += round( $v['interest'], 2 );
$investinfo['invest_fee'] += getfloatvalue( $fee_rate * $v['interest'] / 100, 2 );
$i++;
}
$invest_info_id =M("transfer_borrow_investor" )->add( $investinfo );
$i = 1;
$capital_detail_all = 0;
foreach ( $repay_list as $key => $v ) 
{
$investDetail['repayment_time'] = 0;
$investDetail['borrow_id'] = $borrow_id;
$investDetail['invest_id'] = $invest_info_id;
$investDetail['investor_uid'] = $uid;
$investDetail['borrow_uid'] = $binfo['borrow_uid'];
if ( $i < $duration ) 
{
$investDetail['capital'] = round( $v['capital'], 2 );
$capital_detail_all += $investDetail['capital'];
}
else 
{
$investDetail['capital'] = $money - $capital_detail_all;
}
$investDetail['interest'] = $v['interest'];
$investDetail['interest_fee'] = getfloatvalue( $fee_rate * $v['interest'] / 100, 2 );
$investDetail['status'] = 7;
$investDetail['receive_interest'] = 0;
$investDetail['receive_capital'] = 0;
$investDetail['sort_order'] = $i;
$investDetail['total'] = $duration;
$investDetail['deadline'] = $now + $i * 30 * 24 * 3600;
$IDetail[] = $investDetail;
$i++;
}
break;
case 4 : $interest_rate = $binfo['borrow_interest_rate'];
$monthData['month_times'] = $duration;
$monthData['account'] = $money;
$monthData['year_apr'] = $interest_rate;
$monthData['type'] = "all";
$repay_detail = equalendmonth( $monthData );
$investinfo['status'] = 1;
$investinfo['borrow_id'] = $borrow_id;
$investinfo['investor_uid'] = $uid;
$investinfo['borrow_uid'] = $binfo['borrow_uid'];
$investinfo['investor_capital'] = $money;
$investinfo['transfer_num'] = $num;
$investinfo['transfer_month'] = $duration;
$investinfo['add_time'] = $now;
$investinfo['deadline'] = $now + $duration * 30 * 24 * 3600;
$investinfo['reward_money'] = getfloatvalue( $binfo['reward_rate'] * $money / 100, 2 );
if ( $binfo['is_jijin'] == 1 ) 
{
$investinfo['is_jijin'] = 1;
}
$investinfo['final_interest_rate'] = $interest_rate;
$monthDataDetail['month_times'] = $duration;
$monthDataDetail['account'] = $money;
$monthDataDetail['year_apr'] = $interest_rate;
$repay_list = equalendmonth( $monthDataDetail );
$i = 1;
foreach ( $repay_list as $key => $v ) 
{
$investinfo['investor_interest'] += round( $v['interest'], 2 );
$investinfo['invest_fee'] += getfloatvalue( $fee_rate * $v['interest'] / 100, 2 );
$i++;
}
$invest_info_id =M("transfer_borrow_investor" )->add( $investinfo );
$i = 1;
foreach ( $repay_list as $key => $v ) 
{
$investDetail['repayment_time'] = 0;
$investDetail['borrow_id'] = $borrow_id;
$investDetail['invest_id'] = $invest_info_id;
$investDetail['investor_uid'] = $uid;
$investDetail['borrow_uid'] = $binfo['borrow_uid'];
$investDetail['capital'] = $v['capital'];
if ( $i == $duration ) 
{
$investDetail['interest'] = $v['interest'];
}
else 
{
$investDetail['interest'] = $v['interest'];
}
$investDetail['interest_fee'] = getfloatvalue( $fee_rate * $v['interest'] / 100, 2 );
$investDetail['status'] = 7;
$investDetail['receive_interest'] = 0;
$investDetail['receive_capital'] = 0;
$investDetail['sort_order'] = $i;
$investDetail['total'] = $duration;
$investDetail['deadline'] = $now + $i * 30 * 24 * 3600;
$IDetail[] = $investDetail;
$i++;
}
break;
case 5 : $investinfo['status'] = 1;
$investinfo['borrow_id'] = $borrow_id;
$investinfo['investor_uid'] = $uid;
$investinfo['borrow_uid'] = $binfo['borrow_uid'];
$investinfo['investor_capital'] = $money;
$investinfo['transfer_num'] = $num;
$investinfo['transfer_month'] = $duration;
$investinfo['is_auto'] = $_is_auto;
$investinfo['add_time'] = time( );
$investinfo['deadline'] = time( ) + $investinfo['transfer_month'] * 30 * 24 * 3600;
$investinfo['reward_money'] = getfloatvalue( $binfo['reward_rate'] * $money / 100, 2 );
$interest_rate = $binfo['borrow_interest_rate'] + $duration * $binfo['increase_rate'];
$investinfo['investor_interest'] = getfloatvalue( $interest_rate * $money * $duration / 1200, 2 );
$investinfo['final_interest_rate'] = $interest_rate;
$investinfo['invest_fee'] = getfloatvalue( $fee_rate * $investinfo['investor_interest'] / 100, 2 );
$invest_info_id =M("transfer_borrow_investor" )->add( $investinfo );
$endTime = strtotime( date( "Y-m-d", time( ) )." ".$datag['auto_back_time'] );
$detailInterest = getfloatvalue( $investinfo['investor_interest'] / $duration, 2 );
$investDetail['repayment_time'] = 0;
$investDetail['borrow_id'] = $borrow_id;
$investDetail['invest_id'] = $invest_info_id;
$investDetail['investor_uid'] = $uid;
$investDetail['borrow_uid'] = $binfo['borrow_uid'];
$investDetail['capital'] = $money;
$investDetail['interest'] = getfloatvalue( $investinfo['investor_interest'], 2 );
$investDetail['interest_fee'] = $investinfo['invest_fee'];
$investDetail['status'] = 7;
$investDetail['receive_interest'] = 0;
$investDetail['receive_capital'] = 0;
$investDetail['sort_order'] = 1;
$investDetail['total'] = 1;
$investDetail['deadline'] = $now + $duration * 30 * 24 * 3600;
$IDetail[] = $investDetail;
break;
case 6 : $interest_rate = $binfo['borrow_interest_rate'];
$monthData['month_times'] = $duration;
$monthData['account'] = $money;
$monthData['year_apr'] = $interest_rate;
$monthData['type'] = "all";
$repay_detail = compoundmonth( $monthData );
$investinfo['status'] = 1;
$investinfo['borrow_id'] = $borrow_id;
$investinfo['investor_uid'] = $uid;
$investinfo['borrow_uid'] = $binfo['borrow_uid'];
$investinfo['investor_capital'] = $money;
$investinfo['transfer_num'] = $num;
$investinfo['transfer_month'] = $duration;
$investinfo['is_auto'] = $_is_auto;
$investinfo['add_time'] = time( );
$investinfo['deadline'] = time( ) + $investinfo['transfer_month'] * 30 * 24 * 3600;
$investinfo['reward_money'] = getfloatvalue( $binfo['reward_rate'] * $money / 100, 2 );
$interest_rate = $binfo['borrow_interest_rate'];
$investinfo['investor_interest'] = getfloatvalue( $repay_detail['interest'], 2 );
$investinfo['final_interest_rate'] = $interest_rate;
$investinfo['invest_fee'] = getfloatvalue( $fee_rate * $investinfo['investor_interest'] / 100, 2 );
if ( $binfo['is_jijin'] == 1 ) 
{
$investinfo['is_jijin'] = 1;
}
$invest_info_id =M("transfer_borrow_investor" )->add( $investinfo );
$endTime = strtotime( date( "Y-m-d", time( ) )." ".$datag['auto_back_time'] );
$detailInterest = getfloatvalue( $investinfo['investor_interest'] / $duration, 2 );
$investDetail['repayment_time'] = 0;
$investDetail['borrow_id'] = $borrow_id;
$investDetail['invest_id'] = $invest_info_id;
$investDetail['investor_uid'] = $uid;
$investDetail['borrow_uid'] = $binfo['borrow_uid'];
$investDetail['capital'] = $money;
$investDetail['interest'] = getfloatvalue( $investinfo['investor_interest'], 2 );
$investDetail['interest_fee'] = $investinfo['invest_fee'];
$investDetail['status'] = 7;
$investDetail['receive_interest'] = 0;
$investDetail['receive_capital'] = 0;
$investDetail['sort_order'] = 1;
$investDetail['total'] = 1;
$investDetail['deadline'] = $now + $duration * 30 * 24 * 3600;
$IDetail[] = $investDetail;
break;
}
$Tinvest_defail_id =M("transfer_investor_detail" )->addAll( $IDetail );
if ( $invest_info_id && $Tinvest_defail_id ) 
{
$investMoney->commit( );
$res = membermoneylog( $uid, 37, 0 - $money, "对{$borrow_id}
号{$parm}
进行了投标", $binfo['borrow_uid'] );
$_borraccount = membermoneylog( $binfo['borrow_uid'], 17, $money, "第{$borrow_id}
号{$parm}
已被认购{$money}
元，{$money}
元已入帐" );
if ( empty( $binfo['transfer_out'] ) ) 
{
$binfo['transfer_out'] = 0;
}
if ( intval( $binfo['transfer_out'] ) + $num == $binfo['transfer_total'] ) 
{
$_borrfee = membermoneylog( $binfo['borrow_uid'], 18, 0 - $binfo['borrow_fee'], "第{$borrow_id}
号{$parm}
被认购完毕，扣除借款管理费{$binfo['borrow_fee']}
元" );
if ( !$_borrfee ) 
{
return false;
}
}
$endTime = strtotime( date( "Y-m-d", time( ) )." ".$_P_fee['back_time'] );
if ( $binfo['repayment_type'] == 1 ) 
{
$deadline_last = strtotime( "+{$duration}
day", $endTime );
}
else 
{
$deadline_last = strtotime( "+{$duration}
month", $endTime );
}
$getIntegralDays = intval( ( $deadline_last - $endTime ) / 3600 / 24 );
$integ = intval( $investinfo['investor_capital'] * $getIntegralDays * $invest_integral / 1000 );
if ( 0 < $integ ) 
{
$reintegral = memberintegrallog( $uid, 2, $integ, "对{$borrow_id}
号{$parm}
进行投标，应获积分：".$integ."分,投资金额：".$investinfo['investor_capital']."元,投资天数：".$getIntegralDays."天" );
if ( isbirth( $uid ) ) 
{
$reintegral = memberintegrallog( $uid, 2, $integ, "亲，祝您生日快乐，本站特赠送您{$integ}
积分作为礼物，以表祝福。" );
}
}
$res1 = membermoneylog( $uid, 39, $investinfo['investor_capital'], "您对第{$borrow_id}
号{$parm}
投标成功，冻结本金成为待收金额", $binfo['borrow_uid'] );
$res2 = membermoneylog( $uid, 38, $investinfo['investor_interest'] - $investinfo['invest_fee'], "第{$borrow_id}
号{$parm}
应收利息成为待收利息", $binfo['borrow_uid'] );
if ( 0 < $investinfo['reward_money'] ) 
{
$_remoney_do = false;
$_reward_m = membermoneylog( $uid, 41, $investinfo['reward_money'], "第{$borrow_id}
号{$parm}
认购成功，获取投标奖励", $binfo['borrow_uid'] );
$_reward_m_give = membermoneylog( $binfo['borrow_uid'], 42, 0 - $investinfo['reward_money'], "第{$borrow_id}
号{$parm}
已被认购，支付投标奖励", $uid );
if ( $_reward_m && $_reward_m_give ) 
{
$_remoney_do = true;
}
}
$vo =M("members" )->field( "user_name,recommend_id,recommend_type" )->find( $uid );
$_rate = $datag['award_invest'] / 1000;
$jiangli = getfloatvalue( $_rate * $investinfo['investor_capital'], 2 );
if ( $vo['recommend_id'] != 0 && $vo['recommend_type'] == 0 ) 
{
membermoneylog( $vo['recommend_id'], 13, $jiangli, $vo['user_name']."对{$borrow_id}
号标投资成功，你获得推广奖励".$jiangli."元。", $uid );
}
$out = $binfo['transfer_out'] + $num;
$progress = getfloatvalue( $out / $binfo['transfer_total'] * 100, 2 );
$upborrowsql = "update `{$pre}
transfer_borrow_info` set ";
$upborrowsql .= "`transfer_out` = `transfer_out` + {$num}
,";
$upborrowsql .= "`progress`= {$progress}
";
if ( $progress == 100 || $out == $binfo['transfer_total'] ) 
{
$upborrowsql .= ",`is_show` = 0";
}
$upborrowsql .= " WHERE `id`={$borrow_id}
";
$upborrow_res = M( )->execute( $upborrowsql );
if ( !$res || !$res1 || !$res2 ) 
{
$out = $binfo['transfer_out'] + $num;
$progress = getfloatvalue( $out / $binfo['transfer_total'] * 100, 2 );
M( "transfer_borrow_investor" )->where( "id={$invest_info_id}
" )->delete( );
M( "transfer_investor_detail" )->where( "invest_id={$invest_info_id}
" )->delete( );
$upborrowsql = "update `{$pre}
transfer_borrow_info` set ";
$upborrowsql .= "`transfer_out` = `transfer_out` - {$num}
";
$upborrowsql .= "`progress`= {$progress}
";
if ( $out == $binfo['transfer_total'] ) 
{
$upborrowsql .= ",`is_show` = 1";
}
$upborrowsql .= " WHERE `id`={$borrow_id}
";
$upborrow_res = M( )->execute( $upborrowsql );
$done = false;
}
else 
{
$today_reward = explode( "|", $datag['today_reward'] );
if ( $binfo['borrow_duration'] == 1 ) 
{
$reward_rate = floatval( $today_reward[0] );
}
else if ( $binfo['borrow_duration'] == 2 ) 
{
$reward_rate = floatval( $today_reward[1] );
}
else 
{
$reward_rate = floatval( $today_reward[2] );
}
$vd['add_time'] = array( "lt", time( ) );
$vd['investor_uid'] = $uid;
$borrow_invest_count =M("transfer_borrow_investor" )->where( $vd )->count( "id" );
if ( 0 < $reward_rate && 0 < $vminfo['back_money'] && 0 < $borrow_invest_count ) 
{
if ( $vminfo['back_money'] < $money ) 
{
$reward_money_s = $vminfo['back_money'];
}
else 
{
$reward_money_s = $money;
}
$save_reward['borrow_id'] = $borrow_id;
$save_reward['reward_uid'] = $uid;
$save_reward['invest_money'] = $reward_money_s;
$save_reward['reward_money'] = $reward_money_s * $reward_rate / 1000;
$save_reward['reward_status'] = 1;
$save_reward['add_time'] = time( );
$save_reward['add_ip'] = get_client_ip( );
$newidxt =M("today_reward" )->add( $save_reward );
if ( $newidxt ) 
{
$result = membermoneylog( $uid, 40, $save_reward['reward_money'], "{$parm}
续投有效金额({$reward_money_s}
)的奖励({$borrow_id}
号{$parm}
)奖励", 0, "@网站管理员@" );
}
}
$done = true;
}
}
else 
{
$investMoney->rollback( );
}
return $done;
}
function getTransferLeftmonth( $deadline ) 
{
$lefttime = $deadline - time( );
if ( $lefttime <= 0 ) 
{
return 0;
}
$leftMonth = floor( $lefttime / 2592000 );
return $leftMonth;
}
function alogs( $type, $tid, $tstatus, $deal_info = "", $deal_user = "" ) 
{
$arr = array( );
$arr['type'] = $type;
$arr['tid'] = $tid;
$arr['tstatus'] = $tstatus;
$arr['deal_info'] = $deal_info;
$arr['deal_user'] = $deal_user ? $deal_user : session( "adminname" );
$arr['deal_ip'] = get_client_ip( );
$arr['deal_time'] = time( );
$newid =M("auser_dologs" )->add( $arr );
return $newid;
}
function getMarketUrl( $id ) 
{
return __APP__."/Market/{$id}
".c( "URL_HTML_SUFFIX" );
}
function cnsubstr2( $str, $length, $start = 0, $charset = "utf-8", $suffix = true ) 
{
$str = strip_tags( $str );
if ( function_exists( "mb_substr" ) ) 
{
if ( mb_strlen( $str, $charset ) <= $length ) 
{
return $str;
}
$slice = mb_substr( $str, $start, $length, $charset );
}
else 
{
$re['utf-8'] = "/[\x01-]|[�-�][�-�]|[�-�][�-�]{2}|[�-][�-�]{3}/";
$re['gb2312'] = "/[\x01-]|[�-�][�-�]/";
$re['gbk'] = "/[\x01-]|[�-�][@-�]/";
$re['big5'] = "/[\x01-]|[�-�]([@-~]|�-�])/";
preg_match_all( $re[$charset], $str, $match );
if ( count( $match[0] ) <= $length ) 
{
return $str;
}
$slice = join( "", array_slice( $match[0], $start, $length ) );
}
if ( $suffix ) 
{
return $slice;
}
return $slice;
}
function CompoundMonth( $data = array( ) ) 
{
if ( isset( $data['month_times'] ) && 0 < $data['month_times'] ) 
{
$month_times = $data['month_times'];
}
if ( isset( $data['account'] ) && 0 < $data['account'] ) 
{
$account = $data['account'];
}
else 
{
return "";
}
if ( isset( $data['year_apr'] ) && 0 < $data['year_apr'] ) 
{
$year_apr = $data['year_apr'];
}
else 
{
return "";
}
if ( isset( $data['borrow_time'] ) && 0 < $data['borrow_time'] ) 
{
$borrow_time = $data['borrow_time'];
}
else 
{
$borrow_time = time( );
}
$month_apr = $year_apr / 1200;
$mpow = pow( 1 + $month_apr, $month_times );
$repayment_account = getfloatvalue( $account * $mpow, 4 );
if ( isset( $data['type'] ) && $data['type'] == "all" ) 
{
$_resul['repayment_account'] = $repayment_account;
$_resul['month_apr'] = round( $month_apr * 100, 4 );
$_resul['interest'] = $repayment_account - $account;
$_resul['capital'] = $account;
$_resul['shouyi'] = round( $_resul['interest'] / $account * 100, 2 );
return $_resul;
}
}

?>