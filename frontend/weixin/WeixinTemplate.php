<?php
namespace frontend\Weixin;

/**
 * 微信消息回复基础模板
 * @author v-tangyihang-yx
 *
 */
class WeixinTemplate{
	
	public $time;
	
	public function __construct(){
		$this->time = time();
	}
	
	//回复文本消息
	public function toMsgText($fromUserName, $toUserName, $Msg){
		$text = <<<EOF
<xml>
	<ToUserName><![CDATA[%s]]></ToUserName>
	<FromUserName><![CDATA[%s]]></FromUserName>
	<CreateTime>%s</CreateTime>
	<MsgType><![CDATA[text]]></MsgType>
	<Content><![CDATA[%s]]></Content>
</xml>
EOF;
		$resultStr = sprintf($text, $fromUserName, $toUserName, $this->time, $Msg);
		return $resultStr;
	}
	
	//回复图文消息
	public function toMsgNews($fromUserName, $toUserName, $News){
		if(empty($News))
			exit('send news message not null!!!');
	
		$item = <<<EOF
		<item>
			<Title><![CDATA[%s]]></Title>
			<Description><![CDATA[%s]]></Description>
			<PicUrl><![CDATA[%s]]></PicUrl>
			<Url><![CDATA[%s]]></Url>
		</item>
EOF;
		$items = '';
		foreach($News as $k=>$v){
			$items .= sprintf($item, $v['title'], $v['desc'], $v['pic'], $v['link'])."\r\n";
		}
	
		$new = <<<EOF
<ArticleCount>%s</ArticleCount>
	<Articles>
%s
	</Articles>
EOF;
		$num = count($News);
		$new = sprintf($new, $num, $items);
	
		$text = <<<EOF
<xml>
	<ToUserName><![CDATA[%s]]></ToUserName>
	<FromUserName><![CDATA[%s]]></FromUserName>
	<CreateTime>%s</CreateTime>
	<MsgType><![CDATA[news]]></MsgType>
	%s
</xml>
EOF;
		$resultStr = sprintf($text, $fromUserName, $toUserName, $this->time, $new);
		return $resultStr;
	}
	
}