<!DOCTYPE html>
<html lang="en">
<head>
  <title>Early Crack Detection</title>
  <meta charset="utf-8">
  <meta http-equiv="refresh" content="5">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    body
    {
        height:100vh;
        background-repeat:no-repeat;
        background-size:100% 100%;
        background-attachment:fixed;
        color:black;
        /*background-image:url("image/war_robot.jpg");*/
    }

</style>
<script>
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "";
  }
}

function showPosition(position) {
  sessionStorage.setItem("a",position.coords.latitude);
  sessionStorage.setItem("b",position.coords.longitude);
  var a=position.coords.latitude;
  var b=position.coords.longitude;
  document.cookie="a="+a;
  document.cookie="b="+b;
}
getLocation();
</script>
</head>

<body onload="getLocation()">
<?php
include("connection.php");
$sql="select * from 3111_crack order by id desc limit 1";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$value1=$row["value1"];
$value2=$row["value2"];
if($value1 == 0)
{
    $value1 = "Crack Detected";
}
else
{
    $value1 = "Crack Not Detected";
}

?>

    <h2 class="text-center text-white py-2" style="background-color:rgba(0,0,0,0.5);">Early Crack Detection</h2>
<div class="container-fluid">
    <div class="row">
        
        <div class="col-md-6 mt-2 mb-3">
            <div class="card mt-4" style="background-color:rgba(0,0,0,0.5);border-radius:10px;">
                <div class="card-body">
            <form action="">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email" class="text-white"><h4>Crack Status:</h4></label>
                        <input type="text" class="form-control" id="lat" value="<?=$value1?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email" class="text-white"><h4>Distance Millimeter:</h4></label>
                        <input type="text" class="form-control" id="lon" value="<?=$value2?> " readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email" class="text-white"><h4>Latitude:</h4></label>
                        <input type="text" class="form-control" id="lat" value="<?=$_COOKIE["a"]?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email" class="text-white"><h4>Longitude:</h4></label>
                        <input type="text" class="form-control" id="lon" value="<?=$_COOKIE["b"]?>" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email" class="text-white"><h4>Reading Time:</h4></label>
                        <input type="text" class="form-control" id="lat" value="<?= $row["reading_time"]?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email" class="text-white"><h4>Control:</h4></label>
                        <?php
                        $abc=json_decode(file_get_contents("light.json"));
                        ?>
                        <input type="text" class="form-control" id="lon" value="<?=$abc->robot?>" readonly>
                    </div>
                </div>
                <center>
              <a href="sensor_fetchdata.php" class="btn btn-danger btn-lg mt-1" style="width:150px;">History</a>      
                </center>
              
            </form>
        </div>
                </div>
            </div>
            <div class = "col-md-4 offset-md-1 mt-5">
                <div class="card p-2 pb-3" style="background-color:rgba(0,0,0,0.6);">
                    <div class="card-body">
                    <div class="kala">
                <center>
                <form method="post" action="">
                    <button type="submit" name="forward" class="btn" style="background-color:rgb(155,255,255)"><i class="fa-solid fa-angle-up"></i></button><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" name="stop" class="btn text-white ml-2 btn-lg" style="border-radius:50%;background-color:rgb(246,0,2)">Stop</button>
                    &nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <br><br>
                    <button type="submit" name="backward" class="btn" style="background-color:rgb(155,255,255)"><i class="fa-solid fa-angle-down"></i></button>
                </form>
                </center>
            </div>
                </div>
            </div>
    </div>
</div>
<?php
if(isset($_POST["forward"]))
{
    $a=array("robot"=>"forward");
    $a=json_encode($a);
    file_put_contents("light.json",$a);
    echo "<script>window.location.replace('index.php');</script>";
}
if(isset($_POST["stop"]))
{
    $a=array("robot"=>"stop");
    $a=json_encode($a);
    file_put_contents("light.json",$a);
    echo "<script>window.location.replace('index.php');</script>";
    
}
if(isset($_POST["backward"]))
{
    $a=array("robot"=>"backward");
    $a=json_encode($a);
    file_put_contents("light.json",$a);
    echo "<script>window.location.replace('index.php');</script>";
    
}
if(isset($_POST["forward1"]))
{
    $a=array("robot"=>"forward");
    $a=json_encode($a);
    file_put_contents("light.json",$a);
    echo "<script>window.location.replace('index.php');</script>";
}
if(isset($_POST["stop1"]))
{
    $a=array("robot"=>"stop");
    $a=json_encode($a);
    file_put_contents("light.json",$a);
    echo "<script>window.location.replace('index.php');</script>";
    
}
if(isset($_POST["backward1"]))
{
    $a=array("robot"=>"backward");
    $a=json_encode($a);
    file_put_contents("light.json",$a);
    echo "<script>window.location.replace('index.php');</script>";
    
}

?>
</body>
</html>
