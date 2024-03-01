<?php
namespace app\common\util;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use app\BaseController as B;
use PHPMailer\PHPMailer\Exception;
class Mail
{
    /**
     * 发送邮箱
     * 
     * 使用方式
     * use app\common\util\Mail;
     * Mail::go('123@qq.com','这是来自一封信','你好！')
     * 
     * @param array $data
     * @param string $addr 地址
     * @param string $title 标题
     * @param string $content 内容
     * @return mixed
     */
    public static function go($addr,$title,$content)
    {   
        $mail = new PHPMailer(true);
        $data = getConfig();
        $SmtpSecure = $data['SmtpSecure'] == 1 ? PHPMailer::ENCRYPTION_SMTPS:PHPMailer::ENCRYPTION_STARTTLS;
        try {
            $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER为Debug模式                  
            $mail->CharSet = 'utf-8';          
            $mail->isSMTP();                                    
            $mail->Host = $data['smtp-host'];  
            $mail->SMTPAuth = true;                          
            $mail->Username =  $data['smtp-user'];             
            $mail->Password =  $data['smtp-pass'];
            $mail->SMTPSecure = $SmtpSecure; 
            $mail->Port =  $data['smtp-port'];                                
            $mail->setFrom($data['smtp-user'],$data['sitename']);
            $mail->addAddress($addr);    
            $mail->isHTML(true);                                 
            $mail->Subject = $data['sitename'].'-'.$title;
            $mail->Body    = $content;
            $mail->send();
            return ['code'=>'200','msg'=>'发送成功'];
        } catch (Exception $e) {
            return ['code'=>'201','msg'=>'发送失败'.$e->errorMessage()];
        }
    }



}