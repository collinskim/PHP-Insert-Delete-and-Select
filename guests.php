<?php
 require("connection.php");
?>
<?php
if (isset($_POST['btn_guests'])){
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$fname= ucfirst(mysqli_real_escape_string($conn,$_POST['fname']));
	$lname= ucfirst(mysqli_real_escape_string($conn,$_POST['lname']));
	$password = md5($_POST['password']);
	$query="INSERT INTO guests_tbl(firstname,lastname)VALUES('{$fname}','{$lname}')";
	$result=mysqli_query($conn,$query);
	header("Location:guests.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>GUESTS</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css"> 
</head>
<body>
<div class="container">
<form action="guests.php" method="POST" name="guest_form" onsubmit="return validate()">
	<center><legend>ADD EMPLOYEE</legend></center><br>
	<input type="text" class="form-control" name="firstname" placeholder="First Name"><br>
	<input type="text" class="form-control" name="lastname" placeholder="Last Name"><br>
	<input type="password" class="form-control" name="password" placeholder="Password"><br>
	<input type="number" class="form-control" name="tel-no" placeholder="Telephone Number"><br>
	<input type="text" class="form-control" name="email" placeholder="Email"><br>
	<input type="number" class="form-control" name="date" placeholder="Date"><br>
	<input type="submit" class="btn btn-primary pull-right" name="register_btn" placeholder="login">
</form>

<h1>PHP TABLE</h1>
<table class="table">
	<thead>
		<tr>
			<th>id</th>
			<th>firstname</th>
			<th>lastname</th>
			<th>action</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$query="SELECT *FROM guests_tbl";
		$result = mysqli_query($conn,$query);
		while($row=mysqli_fetch_array($result)){
			echo '
            <tr>
                <td>'.$row['id'].'</td>
                <td>'.$row['firstname'].'</td>
                <td>'.$row['lastname'].'</td>
                <td><button class="btn btn-success"><a href="guests.php?deleteid='.$row['id'].'"onclick="return confirm(\'ARE YOU SURE!\')">DELETE</button></a></td>
                <td><button class="btn btn-warning"><a href="guest-edit.php?editid='.$row['id'].'"onclick="return confirm(\'ARE YOU SURE!\')">EDIT</a></button></td>
            </tr>';
			
		}
		?>
		<?php
		if (isset($_GET['deleteid'])) {
			$id=$_GET['deleteid'];
			$query="DELETE FROM guests_tbl WHERE id=$id";
			$result=mysqli_query($conn,$query);
			header("Location:guests.php");
		}
		?>
	</tbody>
</table>

<script>
	function validate(){
		var Fname=document.guest_form.fname.value;
		var Lname=document.guest_form.lname.value;
		if (Fname== "") {
			alert('please enter firstname');
			return false;
		}
		
		if (Lname== "") {
			alert('please enter lastname');
			return false;
		}
		return true;
	}
</script>
</div>
<!-- script -->
<script src="js/jquery-3.2.1.slim.min.js "></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>