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
          var party="ID: "+allParties[i].itemID
            +" | Name: "+allParties[i].itemName
            +" | Weight: "+allParties[i].itemWeight
            +" | Value: "+allParties[i].itemValue
            +" | Type: "+allParties[i].itemType
            +" | Belongs To: "+allParties[i].charID
            ;

          party="<li>"+party+"</li>";
          $("#myitems").append(party);
        }
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
      <?php $_SESSION['id']=$_GET['id'];
      echo $_GET['id'];
      ?>
      <form method='get' action='characters.php'>
        <input type='hidden' name='id' value='<?php $_GET['id'] ?>'>
        <input type='submit' value='List of Items'>
      </form>
      <a href="home.php">Back to party list</a>
      <a href="characters.php">Back to character list</a>
    </div>
    <div>
      <h1>Items belonging to charID <? echo $_GET['id'];?></h1>
      <ul id="myitems"></ul>
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
