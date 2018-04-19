<?php
  session_start();
  $_SESSION['table']='characters';
  $_SESSION['condi']=' WHERE partyID='.$_GET['id'];
  $_SESSION['rows']='charName,accID,partyID';
  $_SESSION['queryid']=",".$_GET['id'];
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
          var party="ID: "+allParties[i].charID
            +" | Name: "+allParties[i].charName
            +"<?php $_SESSION['id']="+allParties[i].charID
            +";?> <form method='get' action='items.php'><input type='hidden' name='id' value="
            +allParties[i].charID
            +"><input type='submit' value='List of items'></form> ";
          party="<li>"+party+"</li>";
          $("#myitems").append(party);
        }
      });
      $("#saveitem").click(function(){
        var Name=$("#name").val()+"','"+$("#account").val();
        var item={
          vName : Name,

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
      //echo 'Party id is: '.$_GET['id'];
      //echo $_GET['id'];
      ?>
      <p><a href="home.php">Back to party list</a>
      </div>
      <div>
        <h1>RPG Party <? echo $_GET['id'];?></h1>
        <ul id="myitems"></ul>
        <table id='myitemstable'>
          <tr>
            <th>Party ID</th>
            <th>Name</th>
          </tr>

        </table>
      </div>
      <div>

        <h2>Add New Character</h2>
        <label>Character Name:</label>
        <input type="text" id="name"/><br>
        <label>Account number:</label>
        <input type="text" id="account"/><br>
        <input type="button" id="saveitem" value="Save Item"/>
      </div>
  </body>
</html>
