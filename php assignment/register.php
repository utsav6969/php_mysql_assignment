<!DOCTYPE html>

<html>
    <head>
    <?php
    include 'dbconnect.php';
    session_start();

    $firstname = $lastname = $email = $password = $cpassword = $phone = $gender = "";
    $all_field_err = $firstname_err = $lastname_err  = $email_err = $password_err = $cpassword_err = $phone_err = $gender_err = "";
    $password_match_err = $registered_email_err = "" ;

    if(count($_POST) > 0) {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $phone = $_POST["phone"];
    $gender = $_POST["gender"];

    $sql = "Select * from users where email='$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    

    if(empty(trim($firstname))) {
        $firstname_err = "Firstname is mandatory";
    }
    if(empty(trim($lastname))) {
        $lastname_err = "Lastname is mandatory";
    }

    if(empty(trim($password))) {
        $password_err = "Password field is mandatory";
    }
    if(empty(trim($cpassword))) {
        $cpassword_err = "Confirm Your Password";
    }
    if(empty(trim($phone))) {
        $phone_err = "Please Enter Your Phone Number";
    }
    if(empty(trim($gender))) {
        $gender_err = "Please Enter Your Gender";
    }
    
    if(empty(trim($email))) {
        $email_err = "Please Enter an Email";
    }

    if(!preg_match("/^\d{10}+$/", empty($Phone_No)))
    {
        $phone_err = "Enter a valid phone number";
        
    }

    if(!empty($firstname) and !empty($lastname) and !empty($email) and !empty($password) and !empty($cpassword) and !empty($phone) and !empty($gender)){
    if($num == 0) {
        if($password == $cpassword) {
          $sql = "INSERT INTO users ( firstname, 
                lastname, email, password, phone, gender) VALUES ('$firstname', 
                '$lastname', '$email', '$password', '$phone', '$gender')";
    
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $_SESSION["name"] = $firstname. " " .$lastname;
                $_SESSION["Email"] = $email;
                $_SESSION["Phone"] = $phone;
                $_SESSION["Gender"] = $gender;
                header('Location: http://localhost/php%20assignment/welcome.php');
            }
        }
        else{
            $password_match_err = "Passwords do not match";
        }
    }
    if($num>0)
    {
        $registered_email_err = "This Email is already registered";
    }
    }
else{
    $all_field_err = "All fields are mandatory" ;
}
    
} 


?>
        <link rel="stylesheet" href="./styles/register.css">
    </head>


    <body>
        <h1>Signup Form</h1>

        <div>
          <p style="color: red ; text-align : center;">  <?php echo $registered_email_err ;
            echo $password_match_err ;
            echo $all_field_err ;?> </p>

        
        <form action="register.php" method="POST">

            <p><input type="text" id="firstname" name="firstname" value ="<?php echo $firstname ; ?>" placeholder="Enter Your First Name" > <?php echo $firstname_err ; ?></p>
            <p><input type="text" id="lastname" name="lastname" value ="<?php echo $lastname ; ?>" placeholder="Enter Your Last Name"><?php echo $lastname_err ; ?></p>
            <p><input type="password" id="password" name="password" value ="<?php echo $password ; ?>" placeholder="Enter Your Password"><?php echo $password_err ; ?></p>
            <p><input type="password" id="cpassword" name="cpassword" value ="<?php echo $cpassword ; ?>" placeholder="Confirm Your Password"><?php echo $cpassword_err ; ?></p>
            <p><input type="text" id="email" name="email" value ="<?php echo $email ; ?>" placeholder="Enter Your Email Address"><?php echo $email_err ; ?> </p>
            <p><input type="text" id="phone" name="phone" value ="<?php echo $phone ; ?>" placeholder="Enter Your Phone"><?php echo $phone_err ; ?></p>
            <p><input type="text" id="gender" name="gender" value ="<?php echo $gender ; ?>" placeholder="Enter Your Gender"><?php echo $gender_err ; ?></p>
            <p><input type="submit" ></p>
            <a href="login.php">Already a user?</a>
        </form>
    </div>
    </body>
</html>