<?php
  session_start();
  $sessionPartyID=$_GET['id'];

?>
<!DOCTYPE html>
<html>
  <head>
    <title> Characters</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>$(document).ready(function(){

      $.get("RPGservices.php",function(data,status){
        console.log(data);
        var allParties=JSON.parse(data);
        for(var i=0;i<allParties.length;i++){
          var party="ID: "+allParties[i].partyID
            +" | Name: "+allParties[i].partyName
            +"<?php $_SESSION['id']="+allParties[i].partyID
            +";?> <form method='get' action='characters.php'><input type='hidden' name='id' value="
            +allParties[i].partyID
            +"><input type='submit'></form> ";
          party="<li>"+party+"</li>";
          $("#myitems").append(party);
        }
      });
      $("#saveitem").click(function(){
        var Name=$("#name").val();
        var item={
          partyName : Name,

        };
        $.post("http://127.0.0.1/services/RPGservices.php",item,function(data){
          console.log(data);
        });
      });
    });
    </script>

  </head>
  <body>
    <div>
      <?php
      echo 'Party id is: '.$sessionPartyID;
      //echo $_GET['id'];
      ?>
      <p><a href="home.html">Back to party list</a>
      </div>
      <div>
        <h1>RPG Party <? echo $sessionPartyID?></h1>
        <ul id="myitems"></ul>
      </div>
  </body>
</html>
