<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 格式化打印数组
 * @param array $arr 要打印的数组
 *
 */
function p($arr) {
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}

/**
 * CURL请求
 * @param string $url 请求url
 * @param array $params 请求参数
 * @param int $timeout 允许执行的最长秒数
 * @param boolean $post 是否post请求
 *
 */
function request($url, $params, $timeout = 30, $post = true) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded"));
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_POST, $post);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        errorLog('Curl error:' . curl_error($ch) . '|详情:' . http_build_query($params));
    }
    curl_close($ch);
    return $result;
}

function http_request($url, $xmldata) {
    if (!extension_loaded("curl")) {
        trigger_error("对不起，请开启curl功能模块！", E_USER_ERROR);
    }
    //初始一个curl会话
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded"));
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

    //设置发送数据
    curl_setopt($curl, CURLOPT_POSTFIELDS, $xmldata);
    $data = curl_exec($curl);
    //把返回的数据传给生成二维码的网页，主要是生成二维码需要的code_url
    if ($data) {
        curl_close($curl);

        return $data;
    } else {
        curl_close($curl);
        return false;
    }
}
/**
 * curl 获取网页数据
 * @param $url url
 * @param $data post data
 * @param $header header
 * @param $referer referer
 * @param $cookieFile cookie
 * @return array
 * @author liujing<liukai5455@163.com>
 */
function runCurl($url, $data = array(), $header = array(), $referer = '', $useragent = '', $cookieFile = ''){
	if(empty($url) || !is_url($url))
	{
		return false;
	}
	$curl = curl_init();

	curl_setopt($curl, CURLOPT_URL, $url);

	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_AUTOREFERER,    true);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 3);
	curl_setopt($curl, CURLOPT_TIMEOUT,        3);

	//设置header array('header_name:header_value,....')
	if(!empty($header))
	{
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
	}
	//设置来源
	if(!empty($referer))
	{
		curl_setopt($curl, CURLOPT_REFERER, $referer);
	}
	//模拟浏览器用户行为
	if(!empty($useragent)){
		curl_setopt($curl, CURLOPT_USERAGENT, $useragent);
	}
	//如果是https 不检查ssh证书
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	//添加post
	if (!empty($data)) {
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS,  $data );
	}
	//带cookie
	if(!empty($cookieFile))
	{
		curl_setopt($curl, CURLOPT_COOKIEJAR, $cookieFile);
		curl_setopt($curl, CURLOPT_COOKIEFILE, $cookieFile);
	}

	$res = curl_exec($curl);
	if(curl_errno($curl))
	{
		return false;
	}
	$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	if($http_code != 200){
		return false;
	}
	curl_close($curl);

	return $res ? $res : false;
}


/**
 * 错误日志
 * @param string $msg 错误信息
 * @param string $filename 日志文件url
 * @param string $str 写入内容
 *
 */
function errorLog($msg = '') {
    $filename = BASEPATH . 'logs/' . 'error-log-' . date("Y-m-d", time()) . '.txt';
//打开文件
    $fd = fopen($filename, "a");
//增加文件
    $str = "[" . date("Y/m/d h:i:s", time()) . "] " . $msg;
//写入字符串
    fwrite($fd, $str . "\n");
//关闭文件
    fclose($fd);
}

/**
 * 分类
 * @param array $list 要处理的数据
 * @param string $pk 数据id
 * @param string $pid 数据父id
 * @param return $tree 处理后的结果
 *
 */
function getTree($list, $pk = 'id', $pid = 'pid', $child = 'children', $root = 0) {
// 创建Tree
    $tree = array();
    if (is_array($list)) {
// 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] = & $list[$key];
        }
        foreach ($list as $key => $data) {
// 判断是否存在parent
            $parentId = $data[$pid];
            if ($root == $parentId) {
                $tree[] = & $list[$key];
            } else {
                if (isset($refer[$parentId])) {
                    $parent = & $refer[$parentId];
                    $parent[$child][] = & $list[$key];
                }
            }
        }
    }
    return $tree;
}

/**
 * 成功提示
 * @param string $url 跳转路径
 * @param string $pid 提示信息
 *
 */
function success($url, $msg) {
    $url = site_url($url);
    echo "<script type='text/javascript'>alert('$msg');location.href='$url'</script>";
    die;
}

/**
 * 失败提示
 * @param string $url 跳转路径
 * @param string $pid 提示信息
 *
 */
function error($url, $msg) {
    $url = site_url($url);
    echo "<script type='text/javascript'>alert('$msg');window.history.back();</script>";
    die;
}

/**
 * 生成uuid
 * @param unknown_type $prefix
 */
function uuid($prefix = '') {
    $str = date("YmdHis", time());
    $time = explode(" ", microtime());
    $time1 = $time[1] . ($time [0] * 1000);
    $time2 = explode(".", $time1);
    $time3 = $time2[0];
    return $prefix . $str . substr($time3, -3);
}
/**
 * 判断是否手机号
 * @param $mobile
 * @return bool
 */
function isMobile( $mobile )
{
	$p = '/\d{11}/';
	return preg_match($p, $mobile);
}
/**
 * 判断是否是验证码
 * @param $mobile
 * @return bool
 */
function isVerifycode( $code )
{
	$p = '/\d{6}/';
	return preg_match($p, $code);
}
/**
 * 判断是否是交易密码
 * @param $mobile
 * @return bool
 */
function isTransPwd( $password )
{
	$p = '/\d{6}/';
	return preg_match($p, $password);
}


/**
 * 判断是否日期
 * @param $date
 * @return bool
 */
function isDate( $date )
{
	$p = '/\d{4}-?\d{2}-?\d{2}/';
	return preg_match($p, $date);
}
/**
 * 判断是否id
 * @param $date
 * @return bool
 */
function isId( $id )
{
	$p = '/^[1-9]\d*$/';
	return preg_match($p, $id);
}
/**
     * 判断是否浮点数
     * @param 
     * @return return_type
     * @author liujing<liukai5455@163.com>
     */
function isFloat($float) {
	$p = '/^[0-9]\d*(\.\d+)*$/';
	return preg_match($p, $float);
}
/**
     * 是否身份证号
     * @param 
     * @return return_type
     * @author liujing<liukai5455@163.com>
     */
function isNumberCard($cardno){
	$p = '/(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/';	
	return preg_match($p, $cardno);
}

/**
 * 正则检测url地址
 * @param  $url
 * @return bool
 * @author liujing<liukai5455@163.com>
 */
function is_url($url)
{
	$p = '/(https|http):\/\/([0-9A-Za-z]+[0-9A-Za-z_\-]*\.)?[0-9A-Za-z_\-]+\.\S+/i';
	if(!preg_match($p, $url))
	{
		return false;;
	}
	return true;
}

/**
 * 判断消息类型
 * @param $date
 * @return bool
 */
function messageType($type)
{
    switch ($type) {
        case 0:
            return '系统通知';
        case 1:
            return '订单';
        case 2:
            return '代金券';
    }
}

/**
 * 获取年龄
 */
function getYear($year)
{
    $birthday = $year;
    $age = date('Y', time()) - date('Y', $birthday) - 1;
    if (date('m', time()) == date('m', $birthday)) {

        if (date('d', time()) > date('d', $birthday)) {
            $age++;
        }
    } elseif (date('m', time()) > date('m', $birthday)) {
        $age++;
    }
    return $age;
}

function returnMsg($msg, $data = null)
{
	return array('msg' => $msg, 'data' => $data);
}

/**
 * 生成uuid
 * @param unknown_type $prefix
 */
function makeUuid($prefix = '') {
	$chars = md5(uniqid(mt_rand(), true));
	$uuid = substr($chars, 0, 8) . '_';
	$uuid .= substr($chars, 8, 4) . '_';
	$uuid .= substr($chars, 12, 4) . '_';
	$uuid .= substr($chars, 16, 4) . '_';
	$uuid .= substr($chars, 20, 12);
	return $prefix . $uuid;
}
/**
 * 经纬度坐标A到B的距离 单位米
 * @param
 * @return return_type
 * @author liujing<liukai5455@163.com>
 */
function pointA2BLength($longitudeA, $latitudeA, $longitudeB, $latitudeB)
{
	$length =  6378.138*2*ASIN(SQRT(POW(SIN(( $latitudeA
	*PI()/180-$latitudeB*PI()/180)/2),2)+COS( $latitudeA
	*PI()/180)*COS($latitudeB*PI()/180)*POW(SIN(( $longitudeA
	*PI()/180-$longitudeB*PI()/180)/2),2)))*1000;
	return ROUND($length);
}

/**
     * 金额转化爱币
     * @param 
     * @return return_type
     * @author liujing<liukai5455@163.com>
     */
function money2Ib($money){
	$ratio = 1;//转化比例
	return sprintf('%.2f', round($money * $ratio, 2) );
}


/**
 * 爱币转化金额
 * @param
 * @return return_type
 * @author liujing<liukai5455@163.com>
 */
function ib2Money($ib){
	$ratio = 1;//转化比例
	return sprintf('%.2f', round($ib * $ratio, 2) );
}

function  formatMoney($money) {
	return sprintf('%.2f', $money );
}

/**
 * 生日转化成年龄
 * @param
 * @return return_type
 * @author liujing<liukai5455@163.com>
 */
function birthdayToAge($birthday)
{
	if(!isDate($birthday)){
		return false;
	}

	list($y1,$m1,$d1) = explode("-", date("Y-m-d", strtotime($birthday) ) );

	$now = strtotime("now");
	list($y2,$m2,$d2) = explode("-", date("Y-m-d",$now) );

	$age = $y2 - $y1;

	if( (int)($m2.$d2) < (int)($m1.$d1) )
		$age -= 1;

	return $age;


}

/**
     * 链接二维数组某一列
     * @param 
     * @return return_type
     * @author liujing<liukai5455@163.com>
     */
function joinCol($key, $array, $delimiter = "|")
{
	if( empty($array) || !is_array($array) ) {
		return false;
	}
	$colArray = array_column($array, $key);
	return rtrim( implode($delimiter, $colArray), $delimiter ) ;
}

/**
 * 生成优惠券code
 * @param int $no_of_codes//定义一个int类型的参数 用来确定生成多少个优惠码
 * @param array $exclude_codes_array//定义一个exclude_codes_array类型的数组
 * @param int $code_length //定义一个code_length的参数来确定优惠码的长度
 * @return array//返回数组
 */
function generate_promotion_code($no_of_codes, $exclude_codes_array = '', $code_length = 4) {
	$characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$promotion_codes = array();
	//这个数组用来接收生成的优惠码
	for ($j = 0; $j < $no_of_codes; $j++) {
		$code = "";
		for ($i = 0; $i < $code_length; $i++) {
			$code .= $characters[mt_rand(0, strlen($characters) - 1)];
		}
		//如果生成的4位随机数不再我们定义的$promotion_codes函数里面
		if (!in_array($code, $promotion_codes)) {
			if (is_array($exclude_codes_array)) { //
				//排除已经使用的优惠码
				if (!in_array($code, $exclude_codes_array)) {
					//将生成的新优惠码赋值给promotion_codes数组
					$promotion_codes[$j] = $code;
				} else {
					$j--;
				}
			} else {
				$promotion_codes[$j] = $code; //将优惠码赋值给数组
			}
		} else {
			$j--;
		}
	}
	return $promotion_codes;
}

/**
     * 短信验证码
     * @param 
     * @return return_type
     * @author liujing<liukai5455@163.com>
     */
function makeVerifyCode()
{
	return mt_rand(100000, 999999);
}

/**
     * 判断是否微信浏览器
     * @param 
     * @return return_type
     * @author liujing<liukai5455@163.com>
     */
function isWechat(){
		$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
		return stripos($agent, 'micromessenger') !== false;
}



function createNoncestr($num = 10)
{
	$str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	$nonceStr = '';
	for( $i = $num; $i > 0; $i--){
		$random = mt_rand(0, strlen($str)-1);
		$nonceStr .= $str[$random];
	}
	return $nonceStr;
}

function makeOrderCode(){
	return md5( createNoncestr().uniqid( mt_rand(1, 10000) ) );
}


?>