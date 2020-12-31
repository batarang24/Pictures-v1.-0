<?php
    include 'connection.php';
    ob_start();

        if (isset($_POST['usersid']) && isset($_POST['passwords'])) {
            
            $usersid=$_POST['usersid'];
            $passwords=$_POST['passwords'];
            //echo $usersid;
            if(!empty($_POST['usersid']) && !empty($_POST['passwords'])){

                $query="SELECT * FROM `user_details` WHERE `userid`=?;";
                $init=mysqli_stmt_init($connection);
                mysqli_stmt_prepare($init,$query);
                mysqli_stmt_bind_param($init,'s',$usersid);
                mysqli_stmt_execute($init);
                $result=mysqli_stmt_get_result($init);
                $rows=mysqli_num_rows($result);
                if ($rows==1) {
                    while ($fetch=mysqli_fetch_assoc($result)) {
                        $verify=password_verify($passwords,$fetch['password']);
                        if ($verify==true) {
                            header("Location:userdetails.php?login=success welcome back $usersid");
                        }
                        else{
                            echo "Password is incorrect";
                        }
                    }
                }
                else{
                    echo "You doesnot have pictures account create a new account to join pictures";
                }

            }
            else{
                echo "All fields are required";
            }
        }
 ?>
<form action="login.php" method="POST" enctype="multipart/form-data">
    User-id:
    <input type="text" name="usersid" placeholder="User-id"><br><br>
    Password:
    <input type="password" name="passwords" placeholder="password"><br><br>
    <input type="submit" value="Login"><br><br>

    <a href="newaccount.php">Create new account</a><br><br>
    <a href="forgot.php">Forgot password?</a>
    
    

</form>