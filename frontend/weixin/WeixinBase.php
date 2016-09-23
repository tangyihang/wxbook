<?php
namespace frontend\Weixin;
/**
 * 微信基础方法
 * @author v-tangyihang-yx
 *
 */
class WeixinBase{
	
	/**
	 * 获取微信请求的XML数据
	 *
	 * @return xml
	 */
	function wx_request_xml(){
	
		if(!empty($GLOBALS["HTTP_RAW_POST_DATA"])){
			return $GLOBALS["HTTP_RAW_POST_DATA"];
		}else{
			return file_get_contents('php://input');
		}
	}
}