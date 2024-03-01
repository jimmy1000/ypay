<?php
namespace app\common\util;
use Mrwanghongda\SmsSdk\Sms\SmsFactory;

class SmsBao
{
    const SMS_BAO = 'bao';
    const SMS_TENCENT = 'tencent';
    const SMS_ALIYUN = 'aliyun';
    
    
    public static function go($code,$tel)
    {
        $data = getConfig();
        $smsObj = (new SmsFactory(SmsFactory::SMS_BAO))->getSmsService();
        $config = [
            'smsbao-api' => $data['smsbao-api'],
            /* 填写平台对应的CAM密匙secretId，短信宝填写平台账号*/
            'secretId' => $data['smsbao-user'],
            /* 填写平台对应的CAM密匙secretKey，短信宝填写平台密码*/
            'secretKey' => $data['smsbao-pass'],
            /* 短信应用ID: 短信SdkAppId在 [短信控制台] 添加应用后生成的实际SdkAppId，示例如1400006666 ,短信宝默认为空*/
            'smsSdkAppId' => '',
            /* 验证码,示例如5039 */
            'code' => $code,
            /* 填写腾讯、阿里平台对应的签名内容,短信宝则默认为空 */
            'signName' => '',
            /* 发送的手机号,示例如17899873465 */
            'tel' => $tel,
            /* 模板 ID: 必须填写已审核通过的模板 ID。模板ID可登录 [短信控制台] 查看 */
            'templateId' => "",
            /* 模板发送的短信内容，短信宝则需要填写 如："【短信宝】您的验证码是"5390",3分钟有效。", 腾讯、阿里默认为空 */
            'content' => '【'.$data['smsbao-SignName'].'】您的验证码是'.$code.'，验证码3分钟有效。',//
        ];
        
        try {
            $result = $smsObj->send($config);
            return ['code'=>'200','msg'=>'发送成功'];
        } catch (Exception $e) {
            return ['code'=>'201','msg'=>'发送失败'.$e->errorMessage()];
        }
        
        
    }
    



}