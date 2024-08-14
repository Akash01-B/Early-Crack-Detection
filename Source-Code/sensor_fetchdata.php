<!DOCTYPE html>
<html lang="en">
<head>
  <title>History page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  
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
<div class="container">
    <h2 class="text-danger text-center my-3">Early Crack Detection</h2>
    <div class="row">
        <div class="col-md-12">
<table class="table table-bordered table-sm">
    <tr class="table-danger">
        <th>S.No</th>
        <th>Crack Status</th>
        <th>Distance Millimeter</th>
        <th>Latitude</th>
        <th>Longitude</th>
        <th>Reading Time</th>
    </tr>
<?php
include("connection.php");
$sql="select * from 3111_crack order by id desc";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0)
{
    $i=1;
    while($row=mysqli_fetch_assoc($result))
    {
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
        <tr>
            <td><?=$i?></td>
            <td><?=$value1?></td>
            <td><?=$value2?></td>
            <td><?=$_COOKIE["a"]?></td>
            <td><?=$_COOKIE["b"]?></td>
            <td><?=$row["reading_time"]?></td>
        </tr>
        <?php
    $i++;
    }
}
?>
</table>
        </div>
    </div>
</div>
<div class="container">
    <div classs="row">
        <div class="col-md-12" >
            <iframe class="mt-4"  src = "https://maps.google.com/maps?q=<?=$_COOKIE["a"]?>,<?=$_COOKIE["b"]?>&hl=es;z=14&amp;output=embed" style="height:53vh;width:100%;"></iframe>      
        </div>
    </div>
</div>
</body>
</html>
