<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <link rel="stylesheet" href="./CSS/style.css?v=2.2">
    <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
</head>
<body style="background-color: #FBF6F0;">
    <?php 
        session_start();
        require_once './root/connect.php';
        require_once './root/alert.php';
    ?>

    <?php 
        if(isset($_SESSION["loged"])){
            header('location: index.php');
        }
    ?>

    <?php

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;

        require './PHPMailer/src/Exception.php';
        require './PHPMailer/src/PHPMailer.php';
        require './PHPMailer/src/SMTP.php';

        if(isset($_POST['send_email'])){
            //Import PHPMailer classes into the global namespace
            //These must be at the top of your script, not inside a function
            
            //Load Composer's autoloader
            // require 'vendor/autoload.php';

            //Create an instance; passing `true` enables exceptions

            $user_email = $_POST['email'];

            $query = "SELECT * FROM employee WHERE email = '$user_email'";
            $rows = mysqli_query($connect,$query);
            $count = mysqli_num_rows($rows);
    
            if($count < 1){
                phpAlert('Anh bạn à =))');
                goto end_php;
            }
            
            $user_query = "SELECT name,password FROM employee WHERE email = '$user_email'";
            $result = mysqli_query($connect, $user_query);
            $user_result_array = mysqli_fetch_array($result);
            $user_name = $user_result_array['name'];
            $user_password = $user_result_array['password'];

            $mail = new PHPMailer(true);

            try {
                //Server settings
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'banner.prox@gmail.com';                     //SMTP username
                $mail->Password   = 'gg15963258741';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 587;   
                $mail->SMTPSecure = "tls";                                 //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                $mail->CharSet = 'UTF-8';

                //Recipients
                $mail->setFrom('banner.prox@gmail.com', 'Prox');
                $mail->addAddress($user_email, $user_name);     //Add a recipient
                // $mail->addAddress('ellen@example.com');               //Name is optional
                // $mail->addReplyTo('info@example.com', 'Information');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');

                //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Có vẻ như bạn đã quên mất một thứ gì đó quan trọng :((';
                $mail->Body    = '
                    Đừng lo, hãy ngồi xuống nhâm nhi ly trà và nhớ lại :(( 
                    <br>Nếu vẫn khum nhớ thì hãy nhấn vào nút bên dưới (link uy tín không virus) 
                    <br>
                    <table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 30px;">
                        <tr>
                            <td>
                                <table cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td style="border-radius: 5px;" bgcolor="#ED2939">
                                            <a href="http://localhost/admin_clone/reset_password.php?resetPassword='. $user_password .'&email=' . $user_email . '" target="_blank" style="padding: 8px 12px; border: 1px solid #ED2939;border-radius: 5px;font-family: Helvetica, Arial, sans-serif;font-size: 14px; color: #ffffff;text-decoration: none;font-weight:bold;display: inline-block;">
                                                Reset password !             
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>

                ';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                // echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

            end_php:
        }
        

    ?>

    <div class="login-form">
        <img
                src="https://i.ibb.co/6bZRxw4/P-ogrange.png"
                alt=""
                class="login-logo"
        />
        <h1 class="login-title">Welcome</h1>
        <h1 class="login-title orange">Prox Shopping Services</h1>
        <form action="" method="post">

            <label for="email">Nhập email của bạn</label>
            <input name="email" id="email" type="email" placeholder="Email" value="
            <?php 
                if(isset($_SESSION["email"])){
                     echo $_SESSION["email"];
                }
            ?>" autocomplete="off">

            <br>
            <br>

            <input type="submit" onclick="return checkValidEmail();" name="send_email" value="Submit">
            
        </form>
    </div>

    <div id="hidden_result" style="display: none;"><p class="access">0</p></div>
    
</body>
<script>

$.myjQuery = function(email_input) {
    return $.ajax({
            type: "post",
            url: "./root/checkValidEmail.php",
            data: {email: email_input},
            async: false,
           
    }).done(function (data) {
        $('.access').html(data);
    });
};

function checkValidEmail(){
    let email_input =  document.getElementById('email').value;


    $.myjQuery(email_input);

    let access = document.getElementsByClassName('access')[0].textContent;
    if(access == "1"){
        alert('Vui lòng kiểm tra email !');
        return true;
    }else{
        alert('Email không khả dụng !');
        return false;
    }
}
</script>
<script src="./JS/loginValidate.js?v=3.2"></script>
</html>