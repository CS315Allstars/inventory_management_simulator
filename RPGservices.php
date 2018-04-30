<?php
  session_start();

  //Allows CORS
  //
  header("Access-Control-Allow-Origin: *");


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

    $result=mysqli_query($conn,$_SESSION['query']);
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
    /*$name=$_POST['partyName'];
    $sql_insert="INSERT INTO party(partyName) VALUES ('$name')";
    if(mysqli_query($conn,$sql_insert)){
      echo "Items succesfully added to the database.";
    }
    else{
      echo "ERROR: $sql_insert did not run. ".mysqli_error($conn);
    }*/
    $sql_insert=$_POST['vName'];
    echo "SQL: ".$sql_insert;
    $result=mysqli_query($conn,$sql_insert);

    if($conn){
      echo "conn succesful";
    }
    else{
      echo "conn failed";
    }

    if($result){
      echo "result succesful";
    }
    else{
      echo "result failed";
    }
    if(substr($sql_insert,0,6)=='SELECT'){
      //echo "not inserting into table";
      if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
          if(substr_count($sql_insert, "party")>0){
            echo $row['partyName'];
          }
          elseif (substr_count($sql_insert, "characters")>0) {
            echo $row['charName']; 
          }
          
        } 
      }
    }
  }

  mysqli_close($conn);
?>
