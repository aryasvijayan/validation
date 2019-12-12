<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */


if (isset($_POST['submit'])) {
    require "../config.php";
    require "../common.php";
	$fname="";
	$lname="";
	$age="";
	$email="";
	$location="";
	
	$fname_e="";
	$lname_e="";
	$age_e="";
	$email_e="";
	$location_e="";
	
	if(empty($_POST["firstname"]))
	{
		$fname_e="firstname cant be null";
	}
	else
	{
		$fname=$_POST["firstname"];
	}
    if(empty($_POST["lastname"]))
	{
		$lname_e="lastname cant be null";
	}
	else
	{
		$lname=$_POST["lastname"];
	}
	if(empty($_POST["email"]))
	{
		$email_e="email cant be null";
	}
	else
	{
		$email=$_POST["email"];
	}
	if(empty($_POST["age"]))
	{
		$age_e="age cant be null";
	}
	else
	{
		$age=$_POST["age"];
	}
	if(empty($_POST["location"]))
	{
		$location_e="location cant be null";
	}
	else
	{
		$location=$_POST["location"];
	}
	if($fname!="" and $lname!="" and $email!="" and $age!="" and $location!="")
	{
	

    try  {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_user = array(
            "firstname" => $_POST['firstname'],
            "lastname"  => $_POST['lastname'],
            "email"     => $_POST['email'],
            "age"       => $_POST['age'],
            "location"  => $_POST['location']
        );

        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "users",
                implode(", ", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user))
        );
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
	}
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
    <blockquote><?php echo $_POST['firstname']; ?> successfully added.</blockquote>
<?php } ?>
<script>
function validate()
{
	var fname=document.forms["myform"]["firstname"].value;
	var lname=document.forms["myform"]["lastname"].value;
	var ag=document.forms["myform"]["age"].value;
	var emai=document.forms["myform"]["email"].value;
	var loc=document.forms["myform"]["location"].value;
	
	if(fname=="")
	{
	alert("First name cannot be null");
	document.forms["myform"]["firstname"].focus();
	return false;
	}
	else if(lname=="")
	{
	alert("Last name cannot null");
	document.forms["myform"]["lastname"].focus();
	return false;
	}
	else if(ag=="")
	{
	alert("Age not null");
	document.forms["myform"]["age"].focus;
	return false;
	}
	else if(emai=="")
	{
	alert("Email not null");
	document.forms["myform"]["email"].focus;
	return false;
	}
	else if(loc=="")
	{
	alert("Location not null");
	document.forms["myform"]["location"].focus;
	return false;
	}
	else
	{
	    alert("dear "+fname);
	}
}	
</script>

<h2>Add a user</h2>

<form method="post" name="myform" onsubmit="return validate()">
    <label for="firstname">First Name</label>
    <input type="text" name="firstname" id="firstname">
    <label for="lastname">Last Name</label>
    <input type="text" name="lastname" id="lastname">
    <label for="email">Email Address</label>
    <input type="text" name="email" id="email">
    <label for="age">Age</label>
    <input type="text" name="age" id="age">
    <label for="location">Location</label>
    <input type="text" name="location" id="location">
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
