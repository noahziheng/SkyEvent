<?php
/**
* PHP去掉特定的html标签
* @param array $string
* @param bool $str
* @return string
*/
function _strip_tags($str,$tagsArr=array('p')) {
    foreach ($tagsArr as $tag) {
        $p[]="/(<(?:\/".$tag."|".$tag.")[^>]*>)/i";
    }
    $str = preg_replace($p,"",$str);
    $return_str = str_replace("\n",'',$str);
    return $return_str;
}

function input_csv($handle) {
    $out = array ();
    $n = 0;
    while ($data = fgetcsv($handle, 10000)) {
        $num = count($data);
        for ($i = 0; $i < $num; $i++) {
            $out[$n][$i] = $data[$i];
        }
        $n++;
    }
    return $out;
}

function export_csv($filename,$data) {
    C('SHOW_PAGE_TRACE',false);
    header("Content-type:text/csv");
    header("Content-Disposition:attachment;filename=".$filename);
    header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
    header('Expires:0');
    header('Pragma:public');
    echo $data;
}

function token_ident($group){
    $user = session('user');
    if (!$user) {
        return false;
    }
    if ($user['group'] >= $group ) {
        return true;
    }else{
        return false;
    }
}

function byLang($en,$ch)
{
    if(LANG_SET=='zh-cn'){
        return htmlspecialchars_decode($ch);
    }else{
        return htmlspecialchars_decode($en);
    }
}

function getAirportName($code)
{
    return $code;
}

function getEventTitle($id)
{
    $data = D('Event')->find($id);
    $data = json_decode($data['title'],true);
    return $data[LANG_SET];
}

function timeformat($time=0)
{
    return D('Event')->converttime($time);
}

function dateformat($time=0)
{
    return date('Y-n-j',$time);
}

function getUserFullName($id=0)
{
    if($id==0){
        return "Invalid User";
    }
    $res = D('User')->getFullName($id);
    if (!$res) {
        return D('User')->getFullNameAPI($id);;
    }else{
        return $res;
    }
}

function outtime($time)
{
    if(time() > $time){
        return true;
    }else{
        return false;
    }
}

/**
 * 系统邮件发送函数
 * @param string $to    接收邮件者邮箱
 * @param string $name  接收邮件者名称
 * @param string $subject 邮件主题
 * @param string $body    邮件内容
 * @param string $attachment 附件列表
 * @return boolean
 */
 function think_send_mail($to, $name, $subject = '', $body = '', $attachment = null){
    $config = C('THINK_EMAIL');
    //vendor("PHPMailer.class#phpmailer");//从PHPMailer目录导class.phpmailer.php类文件
    require(VENDOR_PATH."PHPMailer/PHPMailerAutoload.php");
    $mail             = new PHPMailer(); //PHPMailer对象
    $mail->CharSet    = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
    $mail->IsSMTP();  // 设定使用SMTP服务
    $mail->SMTPDebug  = 0;                     // 关闭SMTP调试功能
                                               // 1 = errors and messages
                                               // 2 = messages only
    $mail->SMTPAuth   = true;                  // 启用 SMTP 验证功能
    $mail->SMTPSecure = 'ssl';                 // 使用安全协议
    $mail->Host       = $config['SMTP_HOST'];  // SMTP 服务器
    $mail->Port       = $config['SMTP_PORT'];  // SMTP服务器的端口号
    $mail->Username   = $config['SMTP_USER'];  // SMTP服务器用户名
    $mail->Password   = $config['SMTP_PASS'];  // SMTP服务器密码
    $mail->SetFrom($config['SMTP_USER'], 'SkyEvent');
    $mail->Subject    = $subject;
    $mail->MsgHTML($body);
    $mail->AddAddress($to, $name);
    if(is_array($attachment)){ // 添加附件
        foreach ($attachment as $file){
            is_file($file) && $mail->AddAttachment($file);
        }
    }
    return $mail->Send() ? true : $mail->ErrorInfo;
 }

/**
 * 自定义邮件发送函数
 * @param array $user 标准用户信息数组
 * @param string $name  模板名称
 * @param array $data 模板定义数组
 * @return boolean
 */
 function send_mail($user, $name, $data){
    $tpl = C('EMAIL_TPL');
    $notice="<br><div style=\"font-size: 11px; color: #333333;\"><p>本邮件由 SkyEvent 系统自动发出，请勿直接回复</p><p>This email is for informational purposes only - replies to this email will not be read.</p></div>";
    foreach ($data as $key => $value) {
        $tpl[$name][LANG_SET][1]=str_replace('$'.($key+1), $value, $tpl[$name][LANG_SET][1]);
    }
    $tpl[$name][LANG_SET][0]=str_replace('$TITLE', $data[0], $tpl[$name][LANG_SET][0]);
    $tpl[$name][LANG_SET][1]=str_replace('$ID', $user['id'], $tpl[$name][LANG_SET][1]);
    $tpl[$name][LANG_SET][1]=str_replace('$USERNAME', $user['firstname'].' '.$user['lastname'], $tpl[$name][LANG_SET][1]);
    $mail = think_send_mail($user['email'],$user['firstname'].' '.$user['lastname'],$tpl[$name][LANG_SET][0],$tpl[$name][LANG_SET][1].$notice);
    return $mail;
 }

