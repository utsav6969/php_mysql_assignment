<?php
    include 'dbconnect.php';
    session_start();
    $title = $description = "";
    $title_err = $description_err = $allfield_err = $priority_err = $reply = "";


    if(count($_POST) > 0){
    
    $name = $_SESSION["name"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $priority = $_POST["priority"];
    

    if(empty(trim($title))) {
        $title_err = "Please Fill the Title" ;
    }
    
    if(empty(trim($description))) {
        $description_err = "Please Fill the Description" ;
    }
    
    if(empty(trim($priority))) {
        $priority_err = "Please Select the priority" ;
    }


    
    if(!empty($title) and !empty($description) and !empty($priority)){
        $sql = "INSERT INTO contactus ( name, 
                title, description, priority) VALUES ('$name', 
                '$title', '$description', '$priority')";
    
            $result = mysqli_query($conn, $sql);
    
    
    if($result){
        $reply = "Thanks " .$name. "! For Contacting Us" ;
    }
    else{
        $allfield_err = "All fields are mandatory" ;
    }
}
    }
?>

<html>
    <head>
        <link rel="stylesheet" href="./styles/contactus.css">
        
    </head>
    <body style="background-image: url(./images/pasbg.png)">
            <h1>Contact Form</h1>
            <p class = "reply"><?php echo $reply ;?></p>
            <p class = "reply"><?php echo $allfield_err ;?></p>
            
            
            <div>
            
            <form action="contactus.php" method="POST">
                
                <p>Title:<br><br> <input type="text" id="title" name="title" placeholder="Title" style="width: 500px; height: 50px;" value="<?php echo $title?>"><?php echo $title_err ?> </p>
                <p>Description:<br><br> <textarea placeholder="Description" id="description" name="description" style="width: 500px; height: 100px;" value="<?php echo $title?>"></textarea><?php echo $description_err ?></p>
                <p><label for="priority">Priority:</label><br>
                    <select name="priority" id="priority" style="width: 500px; height: 30px;">
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                    </select></br></p>
                <p><input type="submit" value="Submit" style="width: 100px; height: 30px;"></p>
            </form>
            </div>
        
      

        
    </body>
</html>

