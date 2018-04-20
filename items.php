<?php
  session_start();
  $_SESSION['table']='items';
  $_SESSION['condi']=' WHERE charID='.$_GET['id'];
  $_SESSION['rows']='itemName,itemWeight,itemValue,itemType,charID';
  $_SESSION['queryid']=",".$_GET['id'];
?>
<!DOCTYPE html>
<html>
  <head>
    <title> Items</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>$(document).ready(function(){

      $.get("RPGservices.php",function(data,status){
        console.log(data);
        var allParties=JSON.parse(data);
        for(var i=0;i<allParties.length;i++){
          var party="<td>"+allParties[i].itemID
            +"</td><td>"+allParties[i].itemName
            +"</td><td>"+allParties[i].itemWeight
            +"</td><td>"+allParties[i].itemValue
            +"</td><td>"+allParties[i].itemType
            +"</td><td>"+allParties[i].charID
            +"</td><td><input type='button'  class='deleteBtn' id='"+allParties[i].itemID+"' value='Delete'></td>";           
          party="<tr>"+party+"</tr>";
          $("#myitemstable").append(party);
        }
      });
      $('body').on('click', 'input.deleteBtn', function() {   
        var shit="DELETE FROM items WHERE itemID="+this.id+";";
        var item={
          vName : shit,
        };
        console.log(item);
        $.post("http://127.0.0.1/services/RPGservices.php",item,function(data){
          console.log(data);
        });
      });
      $("#saveitem").click(function(){
        var Name=$("#name").val()+"','"+$("#weight").val()+"','"+$("#value").val()+"','"+$("#type").val();
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
      <a href="home.php">Back to party list</a>
    </div>

    <div>
      <h1>Items belonging to charID <? echo $_GET['id'];?></h1>
      <ul id="myitems"></ul>
      <table id='myitemstable' style='width:50%; text-align:center;' border='2px'>
        <tr>
          <th>Item ID</th>
          <th>Name</th>
          <th>Weight</th>
          <th>Value</th>
          <th>Type</th>
          <th>Owner</th>
        </tr>
      </table>
    </div>

    <div>
      <h2>Add New Item To Character <? echo $_GET['id'];?></h2>
      <label>Item Name:</label>
      <input type="text" id="name"/><br>
      <label>Item Weight:</label>
      <input type="text" id="weight"/><br>
      <label>Item Value:</label>
      <input type="text" id="value"/><br>
      <label>Item Type:</label>
      <input type="text" id="type"/><br>
      <input type="button" id="saveitem" value="Save Item"/>
    </div>
  </body>
</html>
