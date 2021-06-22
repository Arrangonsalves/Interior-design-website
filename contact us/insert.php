<?php
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$subject = $_POST['subject'];
$message = $_POST['message'];
if (!empty($name) || !empty($email) || !empty($phone) || !empty($subject) || !empty($message) {
    $host = "localhost";
       $dbUsername = "root";
       $dbPassword = "";
       $dbname = "youtube";
       
       //createconnection
       $conn = new mysqli($host, $dbusername, $dbPassword, $dbname);
       if (mysqli_connect_error()) {
       die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
       } else {
        $SELECT = "SELECT email From register Where email = ? Limit 1";
        $INSERT = "INSERT Into mydata (name, email, phone, subject, message) values(?, ?, ?, ?, ?, ?)";
        //Prepare statement
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;
        if ($rnum==0) {
         $stmt->close();
         $stmt = $conn->prepare($INSERT);
         $stmt->bind_param("ssssii", $name, $email, $phone, $subject, $message);
         $stmt->execute();
         echo "New record inserted sucessfully";
        } else {
         echo "Someone already register using this email";
        }
        $stmt->close();
        $conn->close();
       }
   } else {
    echo "All field are required";
    die();
   }
   ?>