<?php

    include 'dbconnect.php';

    session_start();
    $email = $password ="";
    $user_err = $email_err = $password_err = "";

    if(count($_POST) > 0) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    if(empty(trim($password))) {
        $password_err = "Please Enter Your Password";
    }
    function email_validation($email) {
        return (!preg_match(
    "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email))
            ? FALSE : TRUE;
    }
    if(!email_validation("$email")) {
        $email_err .= "Invalid Email.<br/>";
    }
    else{
    if(!empty($email) and !empty($password)){
    $sql = "select * from users where email='".$email."'AND password='".$password."'";
    $result = mysqli_query($conn, $sql);
    
    

    if(mysqli_num_rows($result)==1){
        while($row = $result->fetch_assoc()) {
            $_SESSION["name"] = $row["firstname"]. " " .$row["lastname"];
            $_SESSION["Email"] = $row["email"];
            $_SESSION["Phone"] = $row["phone"];
            $_SESSION["Gender"] = $row["gender"];
            
        }
        header('Location: http://localhost/php%20assignment/welcome.php');
        
            
     }
    else{
        $user_err = "Wrong Email or Password";
    }
}

}
}   
?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="./styles/login.css">
    </head>

    <body>
        <h1>Login Form</h1>
        <div>
            <?php echo $user_err ?>
        <form action="login.php" method="POST">
            <p>Email: <input type="text" id="email" name="email" value = "<?php echo $email ;?>"><?php echo $email_err ;?> </p>
            <p>Password: <input type="password" id="password" name="password" value = "<?php echo $password;?>"> <?php echo $password_err?> </p>
            <p> <input type="submit"> </p>
        </form>
        </div>
    </body>
</html>