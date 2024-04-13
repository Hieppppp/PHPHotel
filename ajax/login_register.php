<?php

    require('../admin/inc/db_config.php');
    require('../admin/inc/enssentials.php');
    require('../inc/sendgrid/sendgrid-php.php');

    date_default_timezone_set('Asia/Ho_Chi_Minh'); // Thay thế 'Asia/Hanoi' bằng 'Asia/Ho_Chi_Minh' nếu cần thiết

        
    function send_mail($uemail, $token,$type){

        if($type == "email_confirmation"){
            $page = 'email_confirm.php';
            $subject = "Account Verification Link";
            $content = "Confirm your email";
        }
        else{
            $page = 'index.php';
            $subject = "Account Reset Link";
            $content = "Reset your email";
        }

        $email = new \SendGrid\Mail\Mail();
        $email->setFrom(SENDGRID_EMAIL);
        $email->setSubject($subject);

        $email->addTo($uemail);
    
        $email->addContent(
            "text/html", 
            "
                Click the link to $content: <br>
                <a href ='".SITE_URL."$page?$type&email=$uemail&token=$token'>
                    CLICK ME
                </a>
            "
        );
        $sendgrid = new \SendGrid(SENDGRID_API_KEY);
    
        try {
            $response = $sendgrid->send($email);
            if ($response->statusCode() === 202) {
                return true;
            } else {
                file_put_contents('sendgrid_error.log', "SendGrid failed: " . $response->statusCode() . " - " . $response->body() . PHP_EOL, FILE_APPEND);
                return false;
            }
        } catch (Exception $e) {
            file_put_contents('sendgrid_error.log', "SendGrid error: " . $e->getMessage() . PHP_EOL, FILE_APPEND);
            return false;
        }
    }

    if(isset($_POST['register'])){
        $data = filteration($_POST);

        // match pass and confirm pass

        if($data['pass'] != $data ['cpass']){
            echo 'pass_mismatch';
            exit;
        }

        //check user exists or not
        $u_exist = select(
            "SELECT * FROM `user_cred` WHERE `email`=? OR `phonenum`=? LIMIT 1",
            [$data['email'], $data['phonenum']],
            "ss"
        );

        if(mysqli_num_rows($u_exist)!=0){
            $u_exist_fetch = mysqli_fetch_assoc($u_exist);
            echo ($u_exist_fetch['email'] == $data['email'])? 'email_already' : 'phone_already';
            exit;
        }

        //upload user image
        $img = uploadUserImage($_FILES['profile']);

        if($img == 'inv_img'){
            echo 'inv_img';
            exit;
        }
        elseif($img == 'upd_failed'){
            echo 'upd_failed';
            exit;
        }

        //send confirmation link to user's mail
        $token = bin2hex(random_bytes(16));

        if(!send_mail($data['email'],$token,"email_confirmation")){
            echo 'email_failed';
            exit;
        }

        $enc_pass = password_hash($data['pass'],PASSWORD_BCRYPT);

        $query = "INSERT INTO `user_cred`(`name`, `email`, `address`, `phonenum`, `pincode`, `dob`, 
            `profile`, `password`, `token`) VALUES (?,?,?,?,?,?,?,?,?)";
        
        $values = [$data['name'],$data['email'],$data['address'],$data['phonenum'],$data['pincode']
            ,$data['dob'],$img,$enc_pass,$token];

        if(insert($query, $values,'sssssssss')){
            echo 1;
        }
        else{
            echo 'ins_failed';
        }
            
    }

    if(isset($_POST['login'])){

        $data = filteration($_POST);

        //check user exists or not
        $u_exist = select(
            "SELECT * FROM `user_cred` WHERE `email`=? OR `phonenum`=? LIMIT 1",
            [$data['email_mob'], $data['email_mob']],"ss");
            
        if(mysqli_num_rows($u_exist)==0){
            echo 'inv_email_mob';
        }
        else{
            $u_fetch = mysqli_fetch_assoc($u_exist);
            if($u_fetch['is_verified']==0){
                echo 'not_verified';
            }
            else if($u_fetch['status']==0){
                echo 'inactive';
            }
            else{
                if(!password_verify($data['pass'],$u_fetch['password'])){
                    echo 'invalid_pass';
                }
                else{
                    session_start();
                    $_SESSION['login'] = true;
                    $_SESSION['uId'] = $u_fetch['id'];
                    $_SESSION['uName'] = $u_fetch['name'];
                    $_SESSION['uPic'] = $u_fetch['profile'];
                    $_SESSION['uPhone'] = $u_fetch['phonenum'];
                    echo 1;
                }
            }
        }
        

        
            
    }

    if(isset($_POST['forgot_pass'])){

        $data = filteration($_POST);

        //check user exists or not
        $u_exist = select(
            "SELECT * FROM `user_cred` WHERE `email`=? LIMIT 1", [$data['email']],"s");
            
        if(mysqli_num_rows($u_exist)==0){
            echo 'inv_email';
        }
        else{
            $u_fetch = mysqli_fetch_assoc($u_exist);
            if($u_fetch['is_verified']==0){
                echo 'not_verified';
            }
            else if($u_fetch['status']==0){
                echo 'inactive';
            }
            else{
                // send reset link to email
                $token = bin2hex(random_bytes(16));

                if(!send_mail($data['email'],$token,'account_recovery')){
                    echo 'mail_failed';
                }
                else{
                   
                    $date = date('Y-m-d H:i:s'); // Khởi tạo biến $date với thời gian hiện tại


                    $query = mysqli_query($con,"UPDATE `user_cred` SET `token`='$token',`t_expire`='$date'
                     WHERE `id`='$u_fetch[id]'");

                    if($query){
                        echo 1;
                    }
                    else{
                        echo 'upd_failed';
                    }
                }
            }

        }


    }







?>