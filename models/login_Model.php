<?php

class login_Model extends Model{

    function __construct()
    {
        parent::__construct();
    }

    function getData(){
        
    }

    function setData(){

    }

    function run(){

        $user_name=$_POST['user_name'];
		$password=$_POST['password'];
        
		$sql1 = ("SELECT * FROM SystemUser WHERE EmpID='$user_name' ;");
        $result1 = $this->db->runQuery($sql1);

       
        if (count($result1) >0) {
            
            $sql2 = ("SELECT * FROM accesslevel WHERE EmpID='$user_name' ;");
            $result2 = $this->db->runQuery($sql2);
            
            if(count($result2)>0){
                $_SESSION['myprofile']=$result2[0][1];
                $_SESSION['loginaccess']=$result2[0][2];
                $_SESSION['adminaccess']=$result2[0]['AdminAccess'];
                $_SESSION['memberaccess']= $result2[0]['MemberAccess'] ;
                $_SESSION['leaderaccess']=$result2[0]['LeaderAccess'];
                $_SESSION['manageraccess']=$result2[0]['ManagerAccess'];
                $_SESSION['hraccess']=$result2[0]['HRAccess'];

            }else{
               
                $_SESSION['myprofile']=false;
                $_SESSION['loginaccess']=false;
                $_SESSION['adminaccess']=false;
                $_SESSION['memberaccess']=false;
                $_SESSION['leaderaccess']=false;
                $_SESSION['manageraccess']=false;
                $_SESSION['hraccess']=false;

                $msg = "You cannot access our system";
                echo $msg;
                $_SESSION['msg'] = $msg ;

                return false;
            }
        }

        $hash = $result1[0][5];
        $verify = password_verify($password, $hash); 

        if(password_verify($password, $hash)){

                $_SESSION['login_user'] = $user_name;
                $_SESSION['password'] = $password;
                $_SESSION['emprole'] = $result1[0][4];
                $_SESSION['user_img'] = $result1[0][0];
                $_SESSION['num_login_fail']=0;
                $msg = "valid";
                $_SESSION['msg'] = $msg ;
                ob_start();
                
                return true;
        }
            
        else {
                if (empty($_SESSION['num_login_fail'])){
                    $_SESSION['num_login_fail']  = 0;
                }
                $msg = "invalid username and password";
                $_SESSION['msg'] = $msg ;
                $_SESSION['num_login_fail']  ++;
                $_SESSION['last_login_time'] = time();
                ob_start();
                echo $_SESSION['msg'];
                return false;
        }
        
		

    }

    function login(){

        if (isset($_SESSION['num_login_fail'])) {
            if ($_SESSION['num_login_fail'] >= 2) {
                if ((time() - $_SESSION['last_login_time']) < (2 * 60)) {
                    $_SESSION['msg']="try again after 2 minutes.";
                    echo 'alert("wait")' ;
                    header('location: http://localhost/CO-WMS/login');
                    
                } else{
                    $_SESSION['num_login_fail'] =0;
                   
                }
            }else{
                return $this->run();
            }
        } 

        else{
            return $this->run(); 
        }   
    }

    function doOTP($user_name){


        $sql = "SELECT * FROM systemuser WHERE EmpID = ('$user_name') ; ";
        $res = $this->db->runQuery($sql);

        $otp = mt_rand(10000000, 99999999);
        $_SESSION['otpcode'] = $otp;
        $_SESSION['user'] = $user_name;
        
        if(count($res) > 0){

            $email = $res[0][3];
            $mail_subject = 'Message from Co-WMS website';
            $email_body = "Hello {$user_name}\n" ;
            $email_body .= "Your OTP code : {$otp} \n";
            $email_body .= "Thank you.";
            $from = 'From: cowmsofficial@gmail.com';

            $send_mail_result = mail($email, $mail_subject, $email_body, $from);

            if($send_mail_result){
                return true;
            }else{
               return false;
            }
        }else{
            return false;
        }

    }

    function resetPassword($otpcode , $password){

        if($_SESSION['otpcode'] == $otpcode ){

            $empid = $_SESSION['user'];
            $sql = ("UPDATE systemuser SET PASSWORD = '$password' WHERE EmpID = '$empid' ;");

            if (($this->db->query($sql)) == TRUE) {
                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }
    
}