<?php
session_start();
if(!isset($_SESSION["email"]))
    header("Location: ../index.html");

$backgroundImage = $_SESSION["background"];
if($backgroundImage == 1)
  $img = "ClashAlumniCardTemplate.jpg";
else if($backgroundImage == 2)
  $img = "Picture4.png";
else
  $img = "ScapeAlumniCardTemplate.jpg";

if(strpos($_SESSION["collegeattended"], "AND") !== false)
  $collegeAttended = explode("AND", $_SESSION["collegeattended"]);

$alumnphoto = $_SESSION['alumnphoto'];

?>

<!DOCTYPE html>
<html>
<head>
  <title>Alumni Titan card</title>
  <link rel="stylesheet" type="text/css" href="../css/alumnicard.css">
  <script src="../js/alumnicard.js" type="text/javascript"></script>
</head>
<body>

<div class="header">
  <img id="background" src="../Images/Other/Gradiant.jpg" alt="loginBanner.jpg" width="100%" height="150px">
  <img id="forground" src="../Images/Other/Logo.png" alt="loginBanner.jpg" height="150px">
</div>

<?php if($backgroundImage == 1)://clash ?>
<div class="clashbackground" id="alumnicard">

  <table style="width:80%" class="bottom-left">
  <?php if(strlen($_SESSION["firstname"] . " " . $_SESSION["lastname"]) > 20)://put first and last names on seperate lines ?>
      <tr>
        <td ><?php echo $_SESSION["firstname"] ?></td>
        <td rowspan="2"><?php echo "'" . substr($_SESSION["graduationyear"], -2); ?></td>
        <td rowspan="2"><?php echo $_SESSION["alumnusid"]; ?></td>
      </tr>
      <tr>
        <td><?php echo $_SESSION["lastname"] ?></td>
      </tr>
    <?php else: ?>
    <tr>
        <td><?php echo $_SESSION["firstname"] . " " . $_SESSION["lastname"]; ?></td>
        <td><?php echo "'" . substr($_SESSION["graduationyear"], -2); ?></td>
        <td><?php echo $_SESSION["alumnusid"]; ?></td>
      </tr>
    <?php endif; ?>
    <?php if(isset($collegeAttended))://College graduated from appears on two lines ?>
      <tr>
        <td><?php echo $collegeAttended[0]; ?></td>
        <td></td>
        <td rowspan="2"><?php// echo "QR Code"; ?></td>
      </tr>
      <tr>
        <td><?php echo "AND " . $collegeAttended[1]; ?></td>
        <td></td>
      </tr>
    <?php else://display it on one line ?>
      <tr>
        <td><?php echo $_SESSION["collegeattended"]; ?></td>
        <td></td>
        <td><?php// echo "QR Code"; ?></td>
      </tr>
    <?php endif; ?>
  </table>
</div>
   


<?php elseif($backgroundImage == 2)://COB ?>
<div class="cobbackground" id="alumnicard">

  <table style="width:80%" class="bottom-left">
  <?php if(strlen($_SESSION["firstname"] . " " . $_SESSION["lastname"]) > 20)://put first and last names on seperate lines ?>
      <tr>
        <td ><?php echo $_SESSION["firstname"] ?></td>
        <td rowspan="2"><?php echo "'" . substr($_SESSION["graduationyear"], -2); ?></td>
        <td rowspan="2"><?php echo $_SESSION["alumnusid"]; ?></td>
      </tr>
      <tr>
        <td><?php echo $_SESSION["lastname"] ?></td>
      </tr>
    <?php else: ?>
    <tr>
        <td><?php echo $_SESSION["firstname"] . " " . $_SESSION["lastname"]; ?></td>
        <td><?php echo "'" . substr($_SESSION["graduationyear"], -2); ?></td>
        <td><?php echo $_SESSION["alumnusid"]; ?></td>
      </tr>
    <?php endif; ?>
    <?php if(isset($collegeAttended))://College graduated from appears on two lines ?>
      <tr>
        <td><?php echo $collegeAttended[0]; ?></td>
        <td></td>
        <td rowspan="2"><?php// echo "QR Code"; ?></td>
      </tr>
      <tr>
        <td><?php echo "AND " . $collegeAttended[1]; ?></td>
        <td></td>
      </tr>
    <?php else://display it on one line ?>
      <tr>
        <td><?php echo $_SESSION["collegeattended"]; ?></td>
        <td></td>
        <td><?php// echo "QR Code"; ?></td>
      </tr>
    <?php endif; ?>
  </table>
</div>



<?php else://Scape ?>
<div class="scapebackground" id="alumnicard">

  <table style="width:80%" class="bottom-left">
  <?php if(strlen($_SESSION["firstname"] . " " . $_SESSION["lastname"]) > 20)://put first and last names on seperate lines ?>
      <tr>
        <td ><?php echo $_SESSION["firstname"] ?></td>
        <td rowspan="2"><?php echo "'" . substr($_SESSION["graduationyear"], -2); ?></td>
        <td rowspan="2"><?php echo $_SESSION["alumnusid"]; ?></td>
      </tr>
      <tr>
        <td><?php echo $_SESSION["lastname"] ?></td>
      </tr>
    <?php else: ?>
    <tr>
        <td><?php echo $_SESSION["firstname"] . " " . $_SESSION["lastname"]; ?></td>
        <td><?php echo "'" . substr($_SESSION["graduationyear"], -2); ?></td>
        <td><?php echo $_SESSION["alumnusid"]; ?></td>
      </tr>
    <?php endif; ?>
    <?php if(isset($collegeAttended))://College graduated from appears on two lines ?>
      <tr>
        <td><?php echo $collegeAttended[0]; ?></td>
        <td></td>
        <td rowspan="2"><?php// echo "QR Code"; ?></td>
      </tr>
      <tr>
        <td><?php echo "AND " . $collegeAttended[1]; ?></td>
        <td></td>
      </tr>
    <?php else://display it on one line ?>
      <tr>
        <td><?php echo $_SESSION["collegeattended"]; ?></td>
        <td></td>
        <td><?php// echo "QR Code"; ?></td>
      </tr>
    <?php endif; ?>
  </table>

</div>
<?php endif; ?>

<br>
<div id="upload">
  <form action="upload.php" method="post" enctype="multipart/form-data" >
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*" onsubmit="return submit()">
    
    <input type="submit" value="Save Profile Picture" name="submit" id="save" >
    <input type="submit" value="Remove Profile Picture" name="removephoto" id="remove" >
</form>
<br>
<span id="photoerror"><?php echo $_SESSION['photoerror']; ?></span>
<br>
<br>
<div>
    <?php if(strcmp($alumnphoto, "default.jpg")){//clash ?>
    <img id="alumnphoto" src="../Images/Uploads/<?php echo $alumnphoto; ?>" id="profilephoto" height="175px" width="150" />
    <?php } ?>
</div>
<br>
<form id="logout" action="logout.php" method="post" enctype="multipart/form-data">
    <input id="button" type="submit" value="Log Out" name="logout">
</form>
</div>
<br>
<br>

</body>
</html>