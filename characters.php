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
          var party="<td>"+allParties[i].charID
            +"</td><td>"+allParties[i].charName
            +"</td><td><?php $_SESSION['id']="+allParties[i].charID
            +";?> <form method='get' action='items.php'><input type='hidden' name='id' value="
            +allParties[i].charID
            +"><input type='submit' value='List of items'></form></td><td><input type='button'  class='deleteBtn' id='"+allParties[i].charID+"' value='Delete'></td>";
          party="<tr>"+party+"</tr>";
          $("#myitemstable").append(party);
        }
      });
      $('body').on('click', 'input.deleteBtn', function() {   
        var shit="DELETE FROM characters WHERE charID="+this.id+";";
        var item={
          vName : shit,
        };
        console.log(item);
        $.post("http://127.0.0.1/services/RPGservices.php",item,function(data){
          console.log(data);
        });
        document.getElementById(""+this.id+"").remove();
      });
      $("#saveitem").click(function(){
        var Name="INSERT INTO characters (charName,accID, partyID) VALUES ('"+$('#name').val()+"','"+$("#account").val()+"','<?php echo $_GET['id']?>');";
        //var Name=$("#name").val()+"','"+$("#account").val();
        var item={
          vName : Name,
        };
        $.post("http://127.0.0.1/services/RPGservices.php",item,function(data){
          console.log(data);
        });
        $().load("characters.php ");
      });
    });
    </script>
  </head>
  <body>
    <div>
      <p><a href="home.php">Back to party list</a>
      </div>
      <div>
        <h1>RPG Party <? echo $_GET['id'];?></h1>
        <ul id="myitems"></ul>
        <table id='myitemstable'style='width:300px; text-align:center;' border='2px'>
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
