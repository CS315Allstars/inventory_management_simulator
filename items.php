<?php
  session_start();
  //$_SESSION['username']=$uname_value;
  $uname_value=$_SESSION['username'];

  //$_SESSION['table']='items';
  //$_SESSION['query']='SELECT * FROM items WHERE charID='.$_GET['id'];
  //$_SESSION['rows']='itemName,itemWeight,itemValue,itemType,charID';
?>
<!DOCTYPE html>
<html>
  <head>
    <title> Items</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>      
      $(document).ready(function(){
        var item={
          query : 'SELECT * FROM items WHERE charID='+<?php echo $_GET['id']?>,
        };
      $.get("http://127.0.0.1/services/inventory/RPGservices.php",item,function(data,status){
        console.log(data);
        var allParties=JSON.parse(data);
        for(var i=0;i<allParties.length;i++){
          var party="<td>"+allParties[i].itemID
            +"</td><td>"+allParties[i].itemName
            +"</td><td>"+allParties[i].itemWeight
            +"</td><td>"+allParties[i].itemValue
            +"</td><td>"+allParties[i].itemType
            +"</td><td>"+allParties[i].charID
            +"</td><td><input type='button'  class='deleteBtn button' id='"+allParties[i].itemID+"' value='Delete'></td>";           
          party="<tr id='"+allParties[i].itemID+"'>"+party+"</tr>";
          $("#myitemstable").append(party);
        }
        var charQuery="SELECT charName FROM characters WHERE charID='"+allParties[0].charID+"';";
        var item={
          vName : charQuery,
          action: "",
        };
        console.log(item);

        // if ("<?php echo $_SESSION['username']?>"=="") {
        //   //document.getElementById("welsomesession").style.display='none';
        //   $('td:nth-child(7),th:nth-child(7)').hide();
        //   $('#actionmenu').hide();
        //   console.log("SESSION NOT SET");
        //   //console.log("O hai "+$uname_value);
        // }
        // else{
        //   console.log("Guess who? ITS: <?php echo $_SESSION['username']?>");
        // }

        $.post("http://127.0.0.1/services/inventory/RPGservices.php",item,function(data){
          console.log(data);
          $("#header").text("Items belonging to "+data);
          $("#header2").text("Add new item for character "+data);
        });
      });

      $('body').on('click', 'input.deleteBtn', function() {   
        var what="DELETE FROM items WHERE itemID="+this.id+";";
        var item={
          vName : what,
        };
        console.log(item);
        $.post("http://127.0.0.1/services/inventory/RPGservices.php",item,function(data){
          console.log(data);
        });
        document.getElementById(this.id).remove();
      });
      //thumbnail addition has been set to static
      $("#saveitem").click(function(){
        var Name="INSERT INTO items (itemName,itemWeight,itemValue,itemType,charID) VALUES ('"+$("#name").val()+"','"+$("#weight").val()+"','"+$("#value").val()+"','"+$("#type").val()+"','<?php echo $_GET['id']?>')";

        var item={
          vName : Name,

        };
        console.log(Name);
        $.post("http://127.0.0.1/services/inventory/RPGservices.php",item,function(data){
          console.log(data+"inserttabledatalog");
          //refreshes page automatically after being added
          $("#bodytag").load(location.href );
        });
        //$("#myitemstable").load("items.php ");
      });
    });
    </script>

    <link href="css/home.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon" rel="stylesheet">
  </head>
  <body id='bodytag'>
    <div id="display">
      <div class="backlink">
        <a href="home.php">Back to Party list</a>
        	<!-- A dynamic backlink would be nice -->
        <!-- <form method='get' action='characters.php'><input name='id' type='hidden' value='"
            +allParties[i].partyID
            +"'> -->
      </div>

      <!-- <p><?php echo $_GET['id']?></p> -->

      <div id='tablediv'>
        <h1 id='header'></h1>
        
        <table id='myitemstable'>
          <tr>
            <th>Item ID</th>
            <th>Name</th>
            <th>Weight</th>
            <th>Value</th>
            <th>Type</th>
            <th>Owner</th>
            <th>&nbsp;</th>
          </tr>
        </table>
      </div>

      <div id='actionmenuwrapper'>
        <div id='actionmenu'>
          <h1>Add New Item To Character </h1>
          <label>Item Name:</label>
          <input type="text" id="name" class="tbox"/><br/>
          <label>Item Weight:</label>
          <input type="text" id="weight" class="tbox"/><br/>
          <label>Item Value:</label>
          <input type="text" id="value" class="tbox"/><br/>
          <label>Item Type:</label>
          <input list="typelist" type="text" id="type" class="tbox"/><br/>
          <datalist id="typelist">
            <option value="Armor"></option>
            <option value="Weapon"></option>
            <option value="Misc/Treasure"></option>
            <option value="Consumable"></option>
          </datalist>

          <input type="button" id="saveitem" value="Save Item" class="button" />
        </div>
      </div>
    </div> <!-- display -->
  </body>
</html>
