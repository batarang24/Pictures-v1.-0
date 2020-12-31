<?php

include 'connection.php';

if (isset($_POST['usersids']) && isset($_POST['passwords']) && isset($_POST['rpassword'])) {
    
    $userids=$_POST['usersids'];
    $password=$_POST['passwords'];
    $passlen=strlen($password);
    $rpassword=$_POST['rpassword'];

    if (!empty($_POST['usersids']) && !empty($_POST['passwords']) && !empty($_POST['rpassword'])) {
        
        $query="SELECT *FROM `user_details` WHERE `userid`=?;";
        $init=mysqli_stmt_init($connection);
        mysqli_stmt_prepare($init,$query);
        mysqli_stmt_bind_param($init,'s',$userids);
        mysqli_stmt_execute($init);
        $result=mysqli_stmt_get_result($init);
        $rows=mysqli_num_rows($result);
        if ($rows==1) {
            
            if ($passlen>8 && $passlen<14) {
                if ($password==$rpassword) {
                    
                    $query1="INSERT INTO `user_details`(`password`) VALUE (?);";
                    mysqli_stmt_prepare($init,$query1);
                    mysqli_stmt_bind_param($init,'s',$password);
                    mysqli_stmt_execute($init);
                
                }
                else{

                    echo "Re-type password is mismatched";
                }
            }
            else{
                echo "Password length must be less than 14 and greater than 8";
            }


        }
        else{
            echo "User-id does'nt exists";
        }
    }
    else{
        echo "All fields are required";
    }

}





?>
<form action="reset.php" method="POST" enctype="multipart/form-data">
    User-id:
    <input type="text" name="usersids" placeholder="User-id"><br><br>
    Reset Password:
    <input type="password" name="passwords" placeholder="Password"><br><br>
    Re-type Password:
    <input type="password" name="rpassword" placeholder="re-type password"><br><br>
    <input type="submit" value="Reset password">
</form> 