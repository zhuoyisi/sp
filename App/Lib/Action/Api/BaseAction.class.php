<?php
class BaseAction extends Action
{
    protected $glo         = '';
    protected $domainUrl   = '';
    protected $uid         = '0';
    protected $source_from = '';
    //获取公共数据
    public function _initialize()
    {
        import("ORG.Util.Page");
        $this->domainUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        $datag           = get_global_setting();
        $this->glo       = $datag;

        $bconf         = get_bconf_setting();
        $this->gloconf = $bconf; //供PHP里面使用
        $this->pre     = C('DB_PREFIX');

        $this->uid         = intval(@$_REQUEST["uid"]) ? intval(@$_REQUEST["uid"]) : '';
        $this->source_from = in_array(@$_REQUEST['source_from'], array(1, 2)) ? $_REQUEST['source_from'] : '';
        $this->apiacl();
    }
    private function apiacl()
    {
        $data['access_token'] = isset($_REQUEST['access_token']) ? $_REQUEST['access_token'] : time();
        $data['expired_time'] = array('gt', time());
        $data['client_ip']    = get_client_ip();
        $data['grant_type']   = strtolower(MODULE_NAME . '/' . ACTION_NAME);
        $rs                   = M('access_token')->where($data)->find();

        if (empty($rs['id']) && !in_array(strtolower(MODULE_NAME . '/' . ACTION_NAME), array('index/token', 'index/invest_detail', 'index/article_content', 'index/about', 'index/novice', 'index/safe', 'index/notice', 'common/reg_agreement','index/version_update'))) {
            outJson($jsons);
        }        
        $this->source_from = $rs['source_from'];      
        writeLog($_REQUEST);  
    }
    public function token()
    {

        $data['grant_type']  = isset($_REQUEST['grant_type']) ? strtolower($_REQUEST['grant_type']) : "";
        $data['client_id']   = isset($_REQUEST['client_id']) ? $_REQUEST['client_id'] : "";
        $data['add_time']    = isset($_REQUEST['add_time']) ? $_REQUEST['add_time'] : "";
        $data['source_from'] = in_array(@$_REQUEST['source_from'], array(1, 2)) ? $_REQUEST['source_from'] : die;
        $data['sign_info']   = isset($_REQUEST['sign_info']) ? $_REQUEST['sign_info'] : "0";

        $clientArr = array(
            '20160701' => '72SF%F4}B5',
            '20160702' => '72S5%P4}BU',
        );
        $c_client_id     = isset($clientArr[$data['client_id']]) ? $data['client_id'] : time();
        $c_client_secret = isset($clientArr[$data['client_id']]) ? $clientArr[$data['client_id']] : time();

        $sign_info = $data['grant_type'] . $c_client_id . $data['add_time'] . $c_client_secret;
        $sign_info = strtoupper(md5($sign_info));
        if ($data['sign_info'] == $sign_info) {
            $access_token          = md5(strtoupper(substr(md5($c_client_secret), 8, 16)) . strtoupper(substr(md5(time()), 8, 16)));
            $data['expired_time']  = strtotime(rand(30, 60) . " minute");
            $data['access_token']  = $access_token;
            $data['client_secret'] = $c_client_secret;
            $data['client_ip']     = get_client_ip();
            $rs                    = M('access_token')->add($data);
            if ($rs) {
                $jsons['status']       = '1';
                $jsons['access_token'] = $access_token;
            }
        }
        outJson($jsons);
    }
    protected function get_token($action = 'index/index')
    {
        $c_client_secret       = '24SD%F4}S5';
        $data['client_id']     = '20160001';
        $data['grant_type']    = $action;
        $access_token          = md5(strtoupper(substr(md5($c_client_secret), 8, 16)) . strtoupper(substr(md5(time()), 8, 16)));
        $data['add_time']      = date("YmdHis");
        $data['expired_time']  = strtotime(rand(30, 60) . " minute");
        $data['access_token']  = $access_token;
        $data['source_from']   = $this->source_from;
        $data['client_secret'] = $c_client_secret;
        $data['client_ip']     = get_client_ip();        
        $rs                    = M('access_token')->add($data);
        if ($rs) {
            return $access_token;
        } else {
            return '';
        }
    }
    protected function _authcode($string, $operation = 'DECODE', $key = '', $expiry = 0)
    {
        // 动态密匙长度，相同的明文会生成不同密文就是依靠动态密匙
        $ckey_length = 4;
        // 密匙
        $key = md5($key ? $key : "zh_system");
        // 密匙a会参与加解密
        $keya = md5(substr($key, 0, 16));
        // 密匙b会用来做数据完整性验证
        $keyb = md5(substr($key, 16, 16));
        // 密匙c用于变化生成的密文
        $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';
        // 参与运算的密匙
        $cryptkey   = $keya . md5($keya . $keyc);
        $key_length = strlen($cryptkey);
        // 明文，前10位用来保存时间戳，解密时验证数据有效性，10到26位用来保存$keyb(密匙b)，解密时会通过这个密匙验证数据完整性
        // 如果是解码的话，会从第$ckey_length位开始，因为密文前$ckey_length位保存 动态密匙，以保证解密正确
        $string        = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
        $string_length = strlen($string);
        $result        = '';
        $box           = range(0, 255);
        $rndkey        = array();

        // 产生密匙簿
        for ($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($cryptkey[$i % $key_length]);
        }

        // 用固定的算法，打乱密匙簿，增加随机性，好像很复杂，实际上对并不会增加密文的强度
        for ($j = $i = 0; $i < 256; $i++) {
            $j       = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp     = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }

        // 核心加解密部分
        for ($a = $j = $i = 0; $i < $string_length; $i++) {
            $a       = ($a + 1) % 256;
            $j       = ($j + $box[$a]) % 256;
            $tmp     = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            // 从密匙簿得出密匙进行异或，再转成字符
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }

        if ($operation == 'DECODE') {
            // substr($result, 0, 10) == 0 验证数据有效性
            // substr($result, 0, 10) - time() > 0 验证数据有效性
            // substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16) 验证数据完整性
            // 验证数据有效性，请看未加密明文的格式
            if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
                return substr($result, 26);
            } else {
                return '';
            }
        } else {
            // 把动态密匙保存在密文里，这也是为什么同样的明文，生产不同密文后能解密的原因
            // 因为加密后的密文可能是一些特殊字符，复制过程可能会丢失，所以用base64编码
            return $keyc . str_replace('=', '', base64_encode($result));
        }
    }
}
