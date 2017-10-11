<!DOCTYPE html>
<html>
<head>

	<title>Prototype</title>
	<meta charset="utf-8">
	<meta iewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="stylesheet" href="bootstrap.min.css">  -->
  <link rel="stylesheet" href="./bootstrap.min.css">
  <!--  <script src="jquery.min.js"></script> -->
  <script src="./jquery.min.js"></script>
    <!--  <script src="bootstrap.min.js"></script>  -->
  <script src="./bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="theme2.css">

</head>

<body style="justify-content: center;">

<!-- MAIN -->
<div class="container-fluid" id="outer">

<!-- HEAD AND NAVIGATION -->
<?php
  $placeholder = "Luke foundation (placeholder)";
  $page = array("Doctors", "Patient", "Surgery");
  $link = array("doctors.php", "patient.php", "surgery.php");
  $doctor = array("Physicians", "Surgeons");
?>
<div>
  <nav class="navbar navbar-default">
    <div class="container-fluid" style="padding: 0px;">
      <div id="banner" style="background-image: url(p_holder.jpg);">
        <?php echo $placeholder; ?> </div> </div>
    <div class="container-fluid">
      <div>
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navi" style="border-color:rgba(255, 255, 255,0.5); background-color:rgba(255, 255, 255,0.7);">
            <?php for($i=0; $i<count($page);$i++){ ?>
              <span class="icon-bar"></span>
            <?php } ?>
          </button>
          <a class="navbar-brand" href="Home.php" id="navlink" style="font-size: 12pt; color:#2d4309;"> <span class="glyphicon glyphicon-home"></span> Home </a>
        </div>
      <div class="collapse navbar-collapse" id="navi">
        <ul class="nav navbar-nav" >
          <?php for ($i=0; $i < count($page); $i++) { echo '<li><a href="'.$link[$i].'" id="navlink" style="color:#4a6a15;">'.$page[$i].'</a></li>'; } ?> </ul>
      </div>

      </div>
    </div>
  </nav>
</div>
<!-- HEAD AND NAVIGATION END -->

<!-- TITLE -->
  <div class="container-fluid" style="color: #ffffff;">
    <h4>Eye Cataract Program</h4> <br>
  </div>
<!-- TITLE -->

<!-- PAGE DESCRIPTION -->
<!--
  - SUBMISSION: form information will be sent to page "submit.php"
  - PROGRESS: to be checked for further revision
  - COMPLETED? not yet but very close
  - REMARKS:-check on form field limitations/ resizability / field morphing when screen changes... etc.
            -watch out for form wrapping when screen changes/ adjust max width and min width
            -stability (to be improved)
 -->
<!-- PAGE DESCRIPTION END -->

<?php  //CODE SECTION START

//DOCTOR INFORMATION FIELDS MAX CHAR VALUES
$FN_MAX = 15;
$LN_MAX = 20;
$LIC_LENG = 7;
$ADDR_MAX = 50;
//DOCTOR INFORMATION END

 //CODE SECTION END
?>

<!-- DOCTORS FORM -->
<div class="container-fluid" id="basic" style="padding-top: 10px;">

  <div id="inner">
  <!-- CONTENT -->
		<div class="container-fluid" >
      
      <!-- FORMS -->
        <div class="container-fluid">
          <h3>Doctor Information</h3>
          <hr style=" border: solid 1px #2d4309;  width:100%; padding: 0px;">
              
          <form method="post" action="submit.php" >

          <!-- NAME -->
            <div class="form-group row">
              <label class="col-md-2" style="float:left; width:170px;">Name</label>

            <!-- LAST NAME -->
              <div class="col-md-2" style="width: 175px; float: left;">
                <label class="sr-only" for="L_NAME">Last Name</label>
                <input type="text" class="form-control" id="L_NAME" placeholder="Last Name"  maxlength="<?php echo $LN_MAX; ?>" name="L_NAME" required>
              </div>
            <!-- LAST NAME END -->

            <!-- FIRST NAME -->
              <div class="col-md-2" style="width: 175px; float: left; ">
                <label class="sr-only" for="F_NAME" required >First Name</label>
                <input type="text" class="form-control" id="F_NAME" placeholder="First Name"  maxlength="<?php echo $FN_MAX; ?>" name="F_NAME" style="float: left;" required >
              </div>
            <!-- FIRST NAME END -->
            
            </div>
          <!-- NAME END -->

          <!-- LICENSE NUMBER -->
            <div class="form-group row">
              <label class="control-label col-md-2" for="LICENSE_NUM" style="float:left; width:170px;">License Number</label>
              <div class="col-md-2" style="width: 115px; float: left;">
                <input pattern="\d{7}" title="License Number ranges from 0000000-9999999." class="form-control" id="LICENSE_NUM" placeholder="Lic. No." maxlength="<?php echo $LIC_LENG; ?>" name="LICENSE_NUM" required>
              </div>
            </div>
          <!-- LICENSE NUMBER END -->

          <!-- ADDRESS -->
            <div class="form-group row">
              <label class="control-label col-md-2" for="ADDRESS" style="float:left; width:170px;">Address</label>
              <div class="col-md-6" style="width: 500px; float: left;">
                <input type="text" class="form-control" id="ADDRESS" placeholder="Enter Home or Work Address" maxlength="<?php echo $ADDR_MAX; ?>" name="ADDRESS">
              </div>
            </div>
          <!-- ADDRESS END -->

          <!-- ENTER -->
          <div class="text-center" style="margin-bottom: 20px;">
            <button type="submit" class="btn" id="go" name="doctors_info">Submit</button>
          </div>
          <!-- ENTER END -->

          </form>
        </div>
      <!-- FORMS END -->
      
    </div>
  <!-- CONTENT END -->

  </div>
</div>
<!-- DOCTORS FORM END -->

<?php
//ERROR CHECKING

//...code
?>

</div>
<!-- MAIN END -->

</body>
</html>
