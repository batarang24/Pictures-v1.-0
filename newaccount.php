<?php

    include'connection.php';
    ob_start();
            if (isset($_POST['name']) && isset($_POST['e-mail']) && isset($_POST['user-id']) && isset($_POST['password'])) {
            $name=$_POST['name'];
            $email=$_POST['e-mail'];
            $userid=$_POST['user-id'];
            $password=$_POST['password'];
            $namelen=strlen($name);
            $userlen=strlen($userid);
            $passlen=strlen($password);
                
            if(!empty($_POST['name']) && !empty($_POST['e-mail']) && !empty($_POST['user-id']) && !empty($_POST['password'])){
                
                if (preg_match("/^[a-zA-Z]*$/",$name)==1) {
                    
                    if ($namelen>3) {
                        
                        if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
                    

                            if ($passlen>8 && $passlen<14) {
                                if ($userlen>4 && $userlen<15){

                                    $query1="SELECT*FROM `user_details` WHERE `userid`=?;";
                                    $init=mysqli_stmt_init($connection);
                                    $prepare=mysqli_stmt_prepare($init,$query1);
                                    mysqli_stmt_bind_param($init,'s',$userid);
                                    mysqli_stmt_execute($init);
                                    $result= mysqli_stmt_get_result($init);
                                    $rows= mysqli_num_rows($result);
                                    if ($rows==0) {
                                        
                                        $hashpwd=password_hash($password,PASSWORD_DEFAULT);
                                        
                                        $query="INSERT INTO `user_details`(`Name`,`email`,`userid`,`password`)VALUES(?,?,?,?);";
                                        mysqli_stmt_prepare($init,$query);
                                        mysqli_stmt_bind_param($init,'ssss',$name,$email,$userid,$hashpwd);
                                        mysqli_stmt_execute($init);
                                        header("Location:userdetails.php?registration=success welcome to pictures");

                                    }
                                    else{
                                        echo "User-id already exists";
                                    }

                                    
                                }
                                else{
                                    echo "user-id length must be less than 15 and greater than 4";
                                }

                            }
                            else{
                                echo "Password length must be less than 14 and greater than 8";
                            }

                        }
                        else{
                            echo "E-mail does'nt exists";
                        }
                    }
                    else{
                        echo "Name length  must be atleast greater than three";
                    }
                }
                else{
                    echo "No special characters are allowed";
                }

            }
            else{
                echo "All fields are required";
            }
            
        }
?>
 <form action="newaccount.php" method="POST"enctype="multipart/form-data">
     Username:
     <input type="text" name="name" placeholder="Username"><br><br>
     E-mail:
    <input type="e-mail" name="email" placeholder="E-mail"><br><br>
     User-id:
    <input type="text" name="user-id" placeholder="user-id"><br><br>
    Password:
    <input type="password" name="password" placeholder="password"><br><br>
    <input type="submit" value="sign in"><br><br>

</form>
