<?php

$page = 'post';

include 'includes/header.php';
include 'includes/menu.php';

?>



<form action="addPostDB.php" method="post">
<table align=center>

<tr>

<td><label for="category">Category:</label></td>

<td>
<select name="category">
<option value="" selected align="center">-Select Categories-</option>
   <option value="Networking">Networking</option>
   <option value="Security">Security</option>
   <option value="Multimedia and Graphic">Multimedia and Graphic</option>
   </select>
</td> 
 
</tr>


   <tr>
   <td>Post Title:</td>  
   <td><input type="text" name="postTitle" placeholder="Write Your Post Title Here" style="width: 300px;"> </td> 
   
   </tr>

   <td>Post:</td>
   <td><textarea name ="postQuestion"  placeholder="Write Your Post Here..." 
   rows = "7" cols = "40"></textarea></td>
   </tr>
   
   <tr>
   <td><input type="submit" align="center" style="background-color: #18A0FB; color: #FFFFFF; border-radius: 5px;" value="Submit"></td>
   
   </tr>

</table>
</form>


 
   <!--  <td><br><input type="submit" style="color:black ; border-radius: 5px; float: right" value="Submit"></td> -->

</form>

<!-- "background-color: #0000FF;  -->

<?php

include 'includes/footer.php';

?>
