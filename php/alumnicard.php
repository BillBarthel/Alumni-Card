<!DOCTYPE html>
<html>
<head>
	<title>Alumni Titan card</title>
</head>
<body>
<img src="../TitanCardBackgrounds/alumniCard1.png" alt="Mountain View"><!-- style="width:304px;height:228px;"> -->
<br>
<?php
echo htmlspecialchars($_GET["alumnusID"]);
?>
<br>
<?php
echo htmlspecialchars($_GET["firstName"]);
?>
<br>
<?php
echo htmlspecialchars($_GET["lastName"]);
?>
<br>
<?php
echo htmlspecialchars($_GET["collegeAttended"]);
?>
<br>
<?php
echo htmlspecialchars($_GET["graduationYear"]);
?>
<br>
<?php
echo htmlspecialchars($_GET["qrCode"] . "\$qrCode");
?>
<br>
<?php
echo htmlspecialchars($_GET["alumnPhoto"]) . "\$alumnPhoto";
?>
</body>
</html>