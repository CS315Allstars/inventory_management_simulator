<?php
  session_start();

  //Allows CORS
  //
  header("Access-Control-Allow-Origin: *");


  $url='localhost';
  $database='RPGtracker';
  $username='root' ;
  $password='';
  //$_SESSION['login']="";

  $conn=mysqli_connect($url,$username,$password,$database);
  if(!$conn){
    die('Connection failed'.$conn->connect_error);
  }
  $method=$_SERVER['REQUEST_METHOD'];
  if($method=="GET"){

    $result=mysqli_query($conn,$_GET['query']);
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
  elseif ($method=="POST" && $_POST['action']=='login') {
    $result=mysqli_query($conn,$_POST['vName']);

    if(mysqli_num_rows($result)!=0){
      if (mysqli_fetch_assoc($result)['password']==$_POST['password']){
        $_SESSION['username']=$_POST['username'];
        echo $_SESSION['username'];
      }
    }

    
    else 
      echo 'it did not work';
    //echo "newmethod";
  }

  else if($method=="POST"){
    
    $sql_insert=$_POST['vName'];   
    $result=mysqli_query($conn,$sql_insert);
    if($result)
      echo 'success';
    if(substr($sql_insert,0,6)=='SELECT'){
      //echo "not inserting into table";
      if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
          if(substr_count($sql_insert, "party")>0){
            echo $row['partyName'];
          }
          elseif (substr_count($sql_insert, "characters")>0) {
            echo $row['charName']; 
            //echo "new";
          }
          
        } 
      }
    }
  }

  mysqli_close($conn);
?>
