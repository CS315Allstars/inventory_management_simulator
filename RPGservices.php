<?php
  session_start();
  $url='localhost';
  $database='RPGtracker';
  $username='root' ;
  $password='';

  $conn=mysqli_connect($url,$username,$password,$database);
  if(!$conn){
    die('Connection failed'.$conn->connect_error);
  }
  $method=$_SERVER['REQUEST_METHOD'];
  if($method=="GET"){
    //$colm=$_GET['colm'];
    //$tabl=$_GET['tabl']
    $sql="SELECT * FROM party";
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
    $name=$_POST['partyName'];
    $sql_insert="INSERT INTO party(partyName) VALUES ('$name')";
    if(mysqli_query($conn,$sql_insert)){
      echo "Items succesfully added to the database.";
    }
    else{
      echo "ERROR: $sql_insert did not run. ".mysqli_error($conn);
    }
  }

  mysqli_close($conn);
?>
