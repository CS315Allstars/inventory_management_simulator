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
<<<<<<< HEAD
    //$sql="SELECT * FROM ".$_SESSION['table'].$_SESSION['condi'];

    $result=mysqli_query($conn,$_SESSION['query']);
=======
    // displays all of table
    // loads all the entries from the DB into the PHP file
    $sql="SELECT * FROM ".$_SESSION['table'].$_SESSION['condi'];
    $result=mysqli_query($conn,$sql);
>>>>>>> origin/marco
    $rows=array();
    if(mysqli_num_rows($result)>0){
      while($r=mysqli_fetch_assoc($result)){
        array_push($rows,$r);
      }
      print json_encode($rows);
    }else{
      echo "<p>Nfdso data</p>";
    }
  }

  else if($method=="POST"){
    $sql_insert=$_POST['vName'];
    //echo $sql_insert;
    $result=mysqli_query($conn,$sql_insert);
    
    if(!$result){
      //echo "YOUR QUERY IS FUCKED";
    }
    if($result){
      //echo "YOUR QUERY IS WORKING";
    }
    //echo $result;
    //echo mysqli_num_rows($result);
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
    /*
    else{
      echo "whoops, youre a fuckhead";
      //echo " ERROR: $sql_insert did not run. ".mysqli_error($conn);
    }*/
    
  }

  mysqli_close($conn);
?>
