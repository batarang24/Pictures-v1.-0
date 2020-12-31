<?php

include "connection.php";

    if (isset($_POST['userid']) && isset($_POST['mailid'])) {
        
        $user=$_POST['userid'];
        $mail=$_POST['mailid'];
        if(!empty($_POST['userid']) && !empty($_POST['mailid'])) {
            
            $query="SELECT * FROM `user_details` WHERE `userid`=?;";
            $init=mysqli_stmt_init($connection);
            mysqli_stmt_prepare($init,$query);
            mysqli_stmt_bind_param($init,'s',$user);
            mysqli_stmt_execute($init);
            $result=mysqli_stmt_get_result($init);
            
            if (mysqli_num_rows($result)==1) {
                 
                while ($fetch=mysqli_fetch_assoc($result)) {
                    $femail=$fetch['email'];
                    if ($femail==$mail) {
                        
                       
                    
                    }
                    else{
                        echo "Please enter the correct e-mail id that you gave in the registration";
                    }
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
<form action="forgot.php" method="POST" enctype="multipart/form-data">
    User-id:
    <input type="text" name="userid" placeholder="user-id"><br><br>
    e-mail:
    <input type="email" name="mailid" placeholder="e-mail"><br><br>
    <input type="submit">
</form>