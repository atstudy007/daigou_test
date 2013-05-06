<?php
/*
 * Money bookers
 */
class Mbookers_Lib
{ 
    var $account;            //商戶名：委託單位代號
    var $key;                //商戶私鑰
    var $orderno;            //訂單號
    var $currency;            //貨幣類型
    var $amount;            //金錢數
    var $action;            //發送到對方伺服器的網址
    var $merchant;            //商戶編號
    var $merchant_name;        //商戶名稱

    /**支付網關向我系統發信息**/
    var $rsSuccessUrl;        //成功的處理網址
    var $rsFailUrl;            //失敗的處理網址
 
    /****初始化商家信息 01 ****/
    function __construct() {
        $this->account    =    "xxx@xx.com.hk";
        $this->key        =    "123123123";
        $this->merchant    =    "2348234";
        $this->merchant_name    =    "商家名称";
        
        $this->action        =    "https://www.moneybookers.com/app/payment.pl";

        $this->rsSuccessUrl = "http://www.yousite.com/receive.php";
        $this->rsFailUrl    = "http://www.yousite.com/failure.php";
        $this->rsNoticeUrl    = $this->rsFailUrl;
    }
    
     
    
    /****發送請求  02 ****/
    function send($info=array()) { 
         $temp = <<<EOD
        <form method="post" action="{$this->action}">
            <input type="hidden" name="pay_to_email" value="{$this->account}">        
            <input type="hidden" name="recipient_description" value="{$this->merchant_name}">    
            <input type="hidden" name="transaction_id" value="{$info['orderno']}">    
            <input type="hidden" name="amount" value="{$info->['amount']}">        
            <input type="hidden" name="currency" value="{$info->['currency']}">
            <input type="hidden" name="return_url" value="{$this->rsNoticeUrl}">
            <input type="hidden" name="cancel_url" value="{$this->rsFailUrl}">
            <input type="hidden" name="status_url" value="{$this->rsSuccessUrl}">
            <input type="hidden" name="payment_methods" value="VSA">
            <input type="hidden" name="hide_login" value="1">      
            <input type='hidden' name='merchant_fields' value="payapi">
            <input type="hidden" name="payapi" value="MBookers">
            <input type="submit" style="display:none">
        </form>
        <script>document.forms[0].submit();</script>
EOD;
         $result = trim($temp); 
        echo $result;
    }
     
    
    /****接收請求  03 02 ****/
    function receive($debug) { 
        
        //trackback payapi to get the payment info
        $payback    =    $this->getPayTrackback($debug);
                
        if ($debug) {
            echo("從getPayTrackback返回的數據：<hr />");
            dump($payback);
        }
        
        //檢查返回結果
        if (empty($payback) && !is_array($payback))                $tb = "err0101";
        elseif ($this->orderno     != $payback["orderno"])         $tb = "err0102";            //訂單號是否修改    
        elseif ($this->amount    != $payback["amount"])             $tb = "err0105";            //金錢
        elseif ($this->account    != $payback['account'])            $tb = "err0106";            //帳號
        elseif ($this->currency    != $payback['currency'])        $tb = "err0103";            //貨幣
        //如果通過以上檢測，則返回成功的驗證代碼
        elseif ($payback['pay_rs'] && '2' == $payback['pay_rs'])        $tb = "Completed";            //成功
        else    $tb = "err0301";                                                        //無修改但支付失敗
        
        $rs["rs"]        =    $tb;
        $rs["pay_id"]    =    $payback["pay_id"];
        $rs["pay_rs"]    =    $payback["pay_rs"];
        $rs["pay_username"]    =    $payback["pay_username"];
        $rs["memo"]        =    $payback;
        return $rs;
    }
    

    //生成返回的MD5加密摘要
    function getPayTrackback($debug) {
        $orderno    =    $_POST['transaction_id'];
        $merchant_id=    $_POST['merchant_id'];
        $account    =    $_POST['pay_to_email'];
        $amount        =    $_POST['mb_amount'];
        $currency    =    $_POST['mb_currency'];
        $pay_id        =    $_POST['mb_transaction_id'];
        $pay_rs        =    $_POST['status']);
        $pay_from_email = $_POST['pay_from_email'];
        $md5sig    =    $_POST['md5sig'];
        
        $sign_msg_str = $merchant_id . $orderno .  strtoupper(md5($this->key)) . $amount . $currency . $pay_rs;
        $sign_msg = STRTOUPPER(MD5($sign_msg_str));

        if($md5sig != $sign_msg) {
            return false;
        }

         if('2' != $pay_rs) {
            return false;
        }

        $result['account']    =    $account;
        $result['pay_id']    =    $pay_id;
        $result['pay_rs']    =    $pay_rs;
        $result['pay_username']    =    $pay_from_email;
        $result['amount']    =    $amount;
        $result['currency']    =    $currency;    
        $result['orderno']    =    $orderno;
        return $result;
    }
 
}