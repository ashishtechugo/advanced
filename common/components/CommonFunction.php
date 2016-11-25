<?php 
namespace common\components;
 
 
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\db\Command;
use yii\db\ActiveRecord;
use linslin\yii2\curl;
class CommonFunction extends Component
{
 
    /**
     * Function : sendMail
     * Send mail from the Tixlo
     * @access public
     * @param $template_id
     * @param $to_email
     * @param $varKeywordContent
     * @param $varKeywordValueContent
     * @param $varCC
     * @param $varBCC
     * @param $varSenderName
     * @param $varSenderEmail
     * @return boolean
     */
    public function sendMail($template_id, $to_email, $varKeywordContent, $varKeywordValueContent, $varCC = "", $varBCC = "", $varSenderName = "", $varSenderEmail = "",$varAttachement = "",$mailSubject = "")
    {
		$result_set = self::getMailContent($template_id);
		//echo '<pre>';print_r($result_set);exit();
        $message = '';
        $message .= '<style type="text/css">
		a { color: #006567;}
		a:hover { color: #F93; }
		</style>';
        $message .= '<table style="padding-left:15px;" width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td style="border-bottom:1px solid #35d3ed; margin-top:30px; padding-bottom:30px; float:left;" width="100%">';
        $result_set = self::getMailContent($template_id);
        if($mailSubject!=''){
            $subject = $mailSubject;
        }else {
            $subject = $result_set['emailSubject'];
        }
	    
        //echo '<pre>';print_r($result_set);exit();
        $message .= $result_set['emailContent'];
        $from = isset($varSenderName) && $varSenderName != '' ? $varSenderName : $result_set['emailFromName'];
        $fromEmail = isset($varSenderEmail) && $varSenderEmail != '' ? $varSenderEmail : $result_set['emailFromEmail'];
        $message = str_replace($varKeywordContent, $varKeywordValueContent, $message);
        $message .= '</td></tr></table>';
        $varMailTo = trim($to_email);
        //$file_path=Yii::app()->getBaseUrl(true).'/img/delivery-order1.pdf';
        //mailing
        //echo '<pre>';print_r($message);exit();
        $params = array('myMail' => $message);
        Yii::$app->mailer->compose()
        ->setFrom($fromEmail)
        ->setTo($varMailTo)
        ->setSubject($subject)
        ->setHtmlBody($message)
        ->send();
        return true;
    }

    /**
     * Function : getMailContent
     * Retriving the specific email template from database
     * @access public
     * @param $argMailID
     * @return array
     */
    public function getMailContent($argMailID){
        
        $emailTempalteArray = Yii::$app->db->createCommand('SELECT pkEmailID,emailFromName,emailFromEmail,emailSubject,emailContent FROM email_templates WHERE pkEmailID=:pkEmailID')
           ->bindValue(':pkEmailID', $argMailID)
           ->queryOne();
        
        return $emailTempalteArray;
    }
	
	
	 /**
     * Function : getDateTimeDiffrence
     * Retriving the date time diffrence
     * @access public
     * @param $statDate,$endDate
     * @return string
     */
    public function getDateTimeDiffrence($statDate,$endDate){
        $hour1=0;  
        $hour2=0;
        $hour3=0;
        $datetimeObj1 = new \DateTime($statDate);
        $datetimeObj2 = new \DateTime($endDate);
        $interval = $datetimeObj1->diff($datetimeObj2);
    
        if($interval->format('%a') > 0){
        $hour1 = $interval->format('%a');
            }
        if($interval->format('%h') > 0){
        $hour2 = $interval->format('%h');
        }

        if($interval->format('%i') > 0){
        $hour3 = $interval->format('%i');
        }
            if($hour1 !=0){
            $day = $hour1.' Days ';
        }
        if($hour2 !=0){
            $hour = $hour2.' Hours ';
        }
        if($hour3 !=0){
            $minute = $hour3.' Minutes ';
        }
            $travelTime     = $day.$hour.$minute;
            
        return $travelTime;
    }

 
    public function getHourDiffrence($statDate,$endDate){
        $hour1=0;  
        $hour2=0;
        $hour3=0;
        $datetimeObj1 = new \DateTime($statDate);
        $datetimeObj2 = new \DateTime($endDate);
        $interval = $datetimeObj1->diff($datetimeObj2);
    
        if($interval->format('%a') > 0){
        $hour1 = $interval->format('%a')*24;
            }
        if($interval->format('%h') > 0){
        $hour2 = $interval->format('%h');
        }

        if($interval->format('%i') > 0){
        $hour3 = $interval->format('%i');
        }
            
        $hourDifference     = $hour1+$hour2.'.'.$hour3;
        
        return $hourDifference;
    }
	
	
	
    function isBetween($input) {
        $from = '23:00';
        $till = '05:00';   
        $f = \DateTime::createFromFormat('!H:i', $from);
        $t = \DateTime::createFromFormat('!H:i', $till);
        $i = \DateTime::createFromFormat('!H:i', $input);
        if ($f > $t) $t->modify('+1 day');
        return ($f <= $i && $i <= $t) || ($f <= $i->modify('+1 day') && $i <= $t);
    }


    function distance($lat1, $lon1, $lat2, $lon2, $unit) {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }


    /**
     * Function : sendSms
     * Send Sms to user
     * @access public
     * @param $phone_number,$message
     * @return array
     */
    public function sendSms($phone_number,$message)
    {
       $curl = new curl\Curl();
       $response = $curl->get('http://sms6.routesms.com:8080/bulksms/bulksms?username=Tixilootp&password=SZb6mjgt&type=0&dlr=0&destination='.$phone_number.'&source=Tixilo&message='.$message.'&url='); 
    }
    
    
    
    /**
     * Function : getDataByCurl
     * get data from url by using get method
     * @access public
     * @param $url
     * @return array
     */
    public function getDataByCurl($url)
    {
       $curl = new curl\Curl();
       $response = $curl->get($url); 
       return $response;
    }


    /**
     * Function : Check For AuthKey
     */
     public function checkAuthkey($token){
         
         $userDetailArray = Yii::$app->db->createCommand('SELECT * FROM driver WHERE auth_key=:auth_key')
           ->bindValue(':auth_key', $token)
           ->queryOne();

         if(!empty($userDetailArray)){
             $updateStatus = Yii::$app->db->createCommand('UPDATE `driver` SET `email_verification_status` = "YES" WHERE auth_key=:auth_key')
             ->bindValue(':auth_key', $token)
             ->execute();
             
             if($updateStatus == 1){
                 return true;
             }
         }else{
             return false;
         }
     }

     /**
     * Function : Check For otp
     */
     public function checkotp($id,$otp,$tablename){
         
         $userDetailArray = Yii::$app->db->createCommand('SELECT * FROM '.$tablename.' WHERE id=:id AND otp=:otp')
           ->bindValue(':id', $id)
           ->bindValue(':otp', $otp)
           ->queryOne();

         if(!empty($userDetailArray)){
             $updateStatus = Yii::$app->db->createCommand('UPDATE `'.$tablename.'` SET `otp_status` = "YES" WHERE id=:id')
             ->bindValue(':id', $id)
             ->execute();
             if($updateStatus == 1){
                 return true;
             }else{
                 return true;
             }
         }else{
             return false;
         }
     }

     /**
     *Genrate otp and update previous otp
     */
     public function genrateotp($id,$tablename){
         $otp = rand(1001,9999);
         $updateStatus = Yii::$app->db->createCommand('UPDATE `'.$tablename.'` SET `otp` = '.$otp.' WHERE id=:id')
             ->bindValue(':id', $id)
             ->execute();
        if($updateStatus == 1){
            return $otp;
        }

     }

     /**
     *Genrate otp and update previous otp for reset password
     */
     public function resetpasswordotp($phone_number,$tablename){
         $otp = rand(1001,9999);
         $updateStatus = Yii::$app->db->createCommand('UPDATE `'.$tablename.'` SET `otp` = '.$otp.' WHERE phone_number=:phone_number')
             ->bindValue(':phone_number', $phone_number)
             ->execute();
        if($updateStatus == 1){
            $userDetailArray = Yii::$app->db->createCommand('SELECT * FROM '.$tablename.' WHERE phone_number=:phone_number AND otp=:otp')
                ->bindValue(':phone_number', $phone_number)
                ->bindValue(':otp', $otp)
                ->queryOne();

            return $userDetailArray;
        }

     }

}