<html>
<head> 
    
     <link rel="stylesheet" href="./styles/welcome.css">
</head>
<h1>My Profile</h1>

<?php
    include 'dbconnect.php';
    
    session_start();
    
    
    echo "<div><p> Welcome " .$_SESSION["name"]. "<br></p>"; 
    echo "<p>Email: " .$_SESSION["Email"]. "<br></p>";
    echo "<p>Phone: " .$_SESSION["Phone"]. "<br></p>";
    echo "<p>Gender: " .$_SESSION["Gender"]. "<br> </div></p>";
    
?>

 <a href="contactus.php"> Contact Us</a>

</body>




</html>