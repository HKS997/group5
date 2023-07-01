<?php

$page = 'add post';

// include 'header.php';
// include 'footer.php'
?>



<form action="userAddPostDB.php" method="post">
<table align=center>

<tr>

<td><label for="category">Category:</label></td>

<td>
<select name="category" id="category">
   <option value="network">network</option>
   <option value="security">security</option>
   <option value="graphics">graphics</option>
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
   <td><input type="submit" align="center" value="Submit"></td>
   
   </tr>

</table>
</form>


 
   <!--  <td><br><input type="submit" style="color:black ; border-radius: 5px; float: right" value="Submit"></td> -->

</form>

<!-- "background-color: #18A0FB;  -->

