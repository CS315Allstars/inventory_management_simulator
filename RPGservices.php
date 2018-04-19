<?php
  session_start();
  $url='localhost';
  $database='RPGtracker';
  $username='root' ;
  $password='';
  //$_GET['table'];
  $conn=mysqli_connect($url,$username,$password,$database);
  if(!$conn){
    die('Connection failed'.$conn->connect_error);
  }
  $method=$_SERVER['REQUEST_METHOD'];
  if($method=="GET"){
    $sql="SELECT * FROM ".$_SESSION['table'].$_SESSION['condi'];
    $result=mysqli_query($conn,$sql);
    $rows=array();
    if(mysqli_num_rows($result)>0){
      while($r=mysqli_fetch_assoc($result)){
        array_push($rows,$r);
      }
      print json_encode($rows);
    }else{
      echo "No data";
    }
  }

  else if($method=="POST"){
    echo $_POST['vName'];
    //$name=$_POST['vName'];
    //$sql_insert="INSERT INTO ".$_SESSION['table']."(".$_SESSION['rows'].") VALUES ('$name'".$_SESSION['queryid'].")";
    $sql_insert=$_POST['vName'];

    if(mysqli_query($conn,$sql_insert)){
      echo "Items succesfully added to the database.";
    }
    else{
      echo " ERROR: $sql_insert did not run. ".mysqli_error($conn);
    }
  }

  mysqli_close($conn);
?>
