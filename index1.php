<center>
	<?php
	error_reporting('0');
	if($_REQUEST['action']!='insert')
	{
		echo "<a href='index1.php?action=insert'>Insert||</a>";	
	}
	if($_REQUEST['action']!='show')                 
	{
        echo "<a href='index1.php?action=show'>Show||</a>";	
	}
	echo "<a href='index1.php'>Exit</a>";
  $url="localhost";
  $username="root";
  $password="";
  $conn=mysqli_connect($url,$username,$password,'pradip');
  if(!$conn){
    die("couldn't perform the query".mysqli_error());
  }
	?>

<?php
if($_REQUEST['action']=='insert')
  {
?>
<h1>Insert Data</h1>
<form method="POST" action="" enctype="multipart/form-data">
<table>
<tr>
    <td>Name</td>
    <td><input type="text" name="name"></td>
</tr>
<tr>
    <td>Phone</td>
    <td><input type="text" name="phone"></td>
</tr>
<tr>
    <td>Image</td>
    <td><input type="file" name="file"></td>
</tr>
<tr>
    <td><input type="submit" name="submit"></td>
</tr>	
</table>
</form>

<?php
}
?>
<?php
if($_REQUEST['submit'])
  {
   echo "hiiii";
   $name=$_POST['name'];
   $phone=$_POST['phone'];
   @mkdir("upload");
   $path="upload/".time().$_FILES['file']['name'];
   copy($_FILES['file']['tmp_name'],$path);
   $qr=mysqli_query($conn,"INSERT into table1(id, Name, Phone, Image) values('','$name','$phone','$path')");
   if($qr)
     {
	  echo"<script>alert('insert successfull')</script>";
	 }
  }
?>
<?php
if($_REQUEST['action']=="show")
  {
    
   $qr=mysqli_query($conn,"SELECT * from table1");
  //  $row=mysqli_fetch_array($qr);
  //  print_r ($row);
   echo "<center><table border='2'>
   <tr>
       <th>Name</th>
       <th>Phone</th>
       <th>Image</th>
	   <th>Update</th>
	   <th>Remove</th>
   </tr>";
while($row=mysqli_fetch_array($qr))
   {
    //echo "hii";
    echo "<tr>";
    echo "<td>".$row['Name']."</td>";
    echo "<td>".$row['Phone']."</td>";
    //echo "<td>".$row['image']."</td>";
    echo"<td><img src=".$row['Image']."></td>";
  ?>
  <td><a href="index1.php?edit=<?php echo $row['id'];?>">Edit</a></td>
  <td><a href="index1.php?del=<?php echo $row['id'];?>">Delete</a></td>

</tr>
<?php 
}
echo "</table></center>";
}
?>

</center>