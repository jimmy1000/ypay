<?php
namespace app\common\util;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\ClientException;
use AlibabaCloud\Client\ServerException;

class AliSms
{
    /**
     * @param string $phone  手机号码
     * @param int $code  验证码
     * @return bool  true
     */
    public static function send($phone,$code)
    {
        $data = getConfig();
        if (empty($phone) || empty($code)) {
            return false;
        }
        try {
            $templateParam = json_encode(['code' => $code]);
            // 创建客户端
            //foo:此处填写自己的accessKey和bar:accessKeySecret
            AlibabaCloud::accessKeyClient($data['alisms-accessKeyId'],$data['alisms-Secret'])
                ->regionId('cn-hangzhou')
                ->asDefaultClient();
            // 发送请求
            $result = AlibabaCloud::rpc()
                ->product('Dysmsapi')
                // ->scheme('https') // https | http
                ->version('2017-05-25')
                ->action('SendSms')
                ->method('POST')
                ->host('dysmsapi.aliyuncs.com')
                ->options([
                    'query' => [
                        'RegionId' => 'cn-hangzhou',
                        //需要发送到那个手机
                        'PhoneNumbers' => $phone,
                        //必填项 签名(需要在阿里云短信服务后台申请)
                        'SignName' => $data['alisms-SignName'],
                        //必填项 短信模板code (需要在阿里云短信服务后台申请)
                        'TemplateCode' => $data['alisms-LoginCodeId'],
                        //如果在短信中添加了${code} 变量则此项必填 要求为JSON格式
                        'TemplateParam' => $templateParam,
                    ],
                ])
                ->request();
        } catch (ServerException $e) {
            // Get server error message
            return $e->getErrorMessage();
        } catch (ClientException $e) {
            // Get client error message
            return $e->getErrorMessage();
        }
        return true;
    }

    public static function reg($phone,$code)
    {
        $data = getConfig();
        if (empty($phone) || empty($code))
        {
            return false;
        }
        try {
            $templateParam = json_encode(['code' => $code]);
            //foo:此处填写自己的accessKey和bar:accessKeySecret
            AlibabaCloud::accessKeyClient($data['alisms-accessKeyId'],$data['alisms-Secret'])
                ->regionId('cn-hangzhou')
                ->asDefaultClient();
            // 发送请求
            $result = AlibabaCloud::rpc()
                ->product('Dysmsapi')
                ->version('2017-05-25')
                ->action('SendSms')
                ->method('POST')
                ->host('dysmsapi.aliyuncs.com')
                ->options([
                    'query' => [
                        'RegionId' => 'cn-hangzhou',
                        //需要发送到那个手机
                        'PhoneNumbers' => $phone,
                        //必填项 签名(需要在阿里云短信服务后台申请)
                        'SignName' => $data['alisms-SignName'],
                        //必填项 短信模板code (需要在阿里云短信服务后台申请)
                        'TemplateCode' => $data['alisms-RegCodeId'],
                        //如果在短信中添加了${code} 变量则此项必填 要求为JSON格式
                        'TemplateParam' => $templateParam,
                    ],
                ])
                ->request();
        } catch (ServerException $e) {
            return $e->getErrorMessage();
        } catch (ClientException $e) {
            return $e->getErrorMessage();
        }
        return true;
    }



}