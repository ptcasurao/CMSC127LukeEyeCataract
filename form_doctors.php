<!DOCTYPE html>
<html>
<head>

	<title>Prototype</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="references/bootstrap.min.css">
  <link rel="stylesheet" href="references/font-awesome.min.css">
  <script src="references/jquery.min.js"></script>
  <script src="references/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="theme2.css">

</head>

<body style="justify-content: center;">

<!-- MAIN -->
<div class="container-fluid" id="outer">

<!-- HEAD AND NAVIGATION -->
<?php include("header.php"); ?>
<!-- HEAD AND NAVIGATION END -->

<!-- TITLE -->
  <div class="container-fluid" style="color: #ffffff;">
    <h4>Eye Cataract Program</h4> <br>
  </div>
<!-- TITLE -->

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
          <hr>
              
          <form method="post" action="submit.php" >

          <!-- NAME -->
            <div class="form-group row">
              <label class="col-md-2" style="float:left; width:170px;">Name</label>

            <div class="col-md-7">
            <!-- FIRST NAME -->
              <div style="width: 175px; float: left; margin-right:10px;">
                <label class="sr-only" for="F_NAME" required >First Name</label>
                <input type="text" class="form-control" id="F_NAME" placeholder="First Name"  maxlength="<?php echo $FN_MAX; ?>" name="F_NAME" style="float: left;" required >
              </div>
            <!-- FIRST NAME END -->

            <!-- LAST NAME -->
              <div style="width: 175px; float: left; margin-right:10px;">
                <label class="sr-only" for="L_NAME">Last Name</label>
                <input type="text" class="form-control" id="L_NAME" placeholder="Last Name"  maxlength="<?php echo $LN_MAX; ?>" name="L_NAME" required>
              </div>
            <!-- LAST NAME END -->
            </div>

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
