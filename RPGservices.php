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

  //sets up connection to the database
  $conn=mysqli_connect($url,$username,$password,$database);
  if(!$conn){
    die('Connection failed'.$conn->connect_error);
  }
  $method=$_SERVER['REQUEST_METHOD'];
  if($method=="GET"){

    $result=mysqli_query($conn,$_GET['query']);

    //$result=mysqli_query($conn,$_SESSION['query']);
    $rows=array();
    if(mysqli_num_rows($result)>0){
      while($r=mysqli_fetch_assoc($result)){
        array_push($rows,$r);
      }
      print json_encode($rows);
    }else{

      echo "No data";
    }
  }//checks if we are logged in the first place
  elseif ($method=="POST" && $_POST['action']=='login') {
    $result=mysqli_query($conn,$_POST['vName']);

    if(mysqli_num_rows($result)!=0){
      if (mysqli_fetch_assoc($result)['password']==$_POST['password']){
        $_SESSION['username']=$_POST['username'];
        //$uname_value = $_SESSION['username'];
        echo $_SESSION['username'];
        
        //echo $uname_value;

      }
    }

    
    else 
      echo 'it did not work';
    //echo "newmethod";
  }
  /*
	Alternative: use names to distinguish between methods
	
	if(isset($_POST['submitcharacter'])){
		//Rest of code

	}
  */
  else if($method=="POST"){
    
    $sql_insert=$_POST['vName'];   
    $result=mysqli_query($conn,$sql_insert);
    

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
