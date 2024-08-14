


<?php

include "connection.php";
$value1=$_POST['value1'];
$value2=$_POST['value2'];


        date_default_timezone_set('Asia/Kolkata');
        $timestamp = date("Y-m-d H:i:s");
        $sql = "INSERT INTO 3111_crack(value1,value2,reading_time)
        VALUES ('" . $value1 . "','" . $value2 . "','" . $timestamp . "')";

        $result=mysqli_query($conn,$sql);
        
        if ($result) {
            echo "New record created successfully";
        } 
        else {
            echo "Values Are Not Entered";
        }
        $sql4="SELECT * FROM 3111_crack";
$result4=mysqli_query($conn,$sql4);
// print_r($result);
if(mysqli_num_rows($result4)>50){
    $sql51="DELETE FROM 3111_crack ORDER BY id ASC limit 1";
    $result51=mysqli_query($conn,$sql51);
    if($result51){
        echo "deleted Successfully";
    }
    
    
}

?>
