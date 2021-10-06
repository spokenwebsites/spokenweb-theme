<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>test</title>
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>

<?php if(isset($_POST['user'])) $user = $_POST['user'];?>

<body id="test" onload="">
<form name="input" action="http://dutyskip.com/test.php" method="post">
Username: <input type="text" name="user" value="<?php echo $user;?>">
<input type="submit" value="Submit">
</form>
	
</body>
</html>