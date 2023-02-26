<?php

include_once("config.php");

if(isset($_POST['update']))
{	
	// Retrieve record values
	$id = $_POST['id'];
	$name = $_POST['name'];
	$age = $_POST['age'];
	$email = $_POST['email'];	

	$nameErr = $ageErr = $emailErr = "";
	
	// Check for empty fields
	if(empty($name) || empty($age) || empty($email)) {	
		if(empty($name)) {
			$nameErr = "* required";
		}
		if(empty($age)) {
			$ageErr = "* required";
		}
		if(empty($email)) {
			$emailErr = "* required";
		}		
	} else {	

		$stmt = $pdo->prepare("UPDATE contacts SET name = ?, age = ?, email = ? WHERE id = ?");
		$stmt->execute([$name, $age, $email, $id]);


		header("Location: index.php");
	}
}
else if (isset($_POST['cancel'])) {

	header("Location: index.php");
}
?>
<?php



$id = $_GET['id'];


$stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
$stmt->execute([$id]);
$arr = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$arr) {
    printf($arr);
    exit($arr);
}
else {

		$name = $arr['name'];
		$age = $arr['age'];
		$email = $arr['email'];

}
?>
<html>
<head>	
	<title>Edit Contact</title>
	<link rel="stylesheet" href="styles.css" />
</head>
<body>
	<form name="form1" method="post" action="edit.php?id=<?php echo $id ?>">
		<table>
			<tr> 
				<td>Name</td>
				<td>
					<input type="text" name="name" value="<?php echo $name;?>">

				</td>
			</tr>
			<tr> 
				<td>Age</td>
				<td>
					<input type="text" name="age" value="<?php echo $age;?>">

				</td>
			</tr>
			<tr> 
				<td>Email</td>
				<td>
					<input type="text" name="email" value="<?php echo $email;?>">

				</td>
			</tr>
			<tr>
				<td>
					<input class="cancel" type="submit" name="cancel" value="Cancel">
				</td>
				<td>
					<input type="submit" name="update" value="Update">
					<input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>