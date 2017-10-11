<!DOCTYPE html>
<html>
<head>

	<title>Prototype</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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

//SURGERY INFORMATION FIELDS MAX CHAR VALUES
$CASE_LENG = 10;
$SURG_LENG = 7;
$ID_LENG = 15;
$VI_MAX = 100;
$HIST_MAX = 100;
$DIAG_MAX = 100;
$CLEAR_LENG = 10;
$SURGADD_MAX = 50;
$SURG_DATE_YY = 4; $SURG_DATE_DD = 2;
$REM_MAX = 100;
$MAX_NAME = 40;
$MONTH_choice = array("January","Febuary","March","April","May","June","July","August","September","October","November","December");
//SURGERY INFORMATION FIELDS END

 //CODE SECTION END
?>

<!-- SURGERY FORM -->
<div class="container-fluid" id="basic" style="padding-top: 10px;"">

  <div id="inner">
  <!-- CONTENT -->
		<div class="container-fluid" >
      
      <!-- FORMS -->
        <div class="container-fluid">
          <h3>Surgery Information</h3>
          <hr style=" border: solid 1px #2d4309;  width:100%; padding: 0px;">
              
          <form method="post" action="submit.php">

          <!-- CASE NUMBER-->
            <div class="form-group row">
              <label class="control-label col-md-2" for="CASE_NUM" style="float:left; width:170px;">Case Number </label>
              <div class="col-md-2" style="width: 150px; float: left;">
                <input pattern="20\d\d-\d\d\d\d\d" title="Case Numbers range from 2000-00000 to 2099-99999." class="form-control" id="CASE_NUM" placeholder="20XX-XXXXX" maxlength="<?php echo $CASE_LENG; ?>" name="CASE_NUM" required>
              </div>
            </div>
          <!-- CASER NUMBER END -->

          <!-- SURGEON LICENSE NUMBER -->
            <div class="form-group row">
              <label class="control-label col-md-2" for="SURG_LIC" style="float:left; width:170px;">Conducted by: </label>
              <div class="col-md-2" style="width: 120px; float: left;">
                <input pattern="\d{7}" title="License Number ranges from 0000000-9999999." class="form-control" id="SURG_LIC" placeholder="Surg. Lic." maxlength="<?php echo $SURG_LENG; ?>" name="SURG_LIC" required>
				
              </div>
			  <div class="col-md-2" style="width: 200px; float: left;">
				<input title="Name" class="form-control" id="SURG_NAME" placeholder="Surgeon Name" maxlength="40" name="SURG_LIC" required>
			  </div>
            </div>
          <!-- SURGEON LICENSE NUMBER END -->

          <!-- PATIENT INFORMATION -->
            <div class="panel-group" style="margin-top:25px;">
              <div class="panel panel-default" style="">
                <div class="panel-heading" id="panelh">Patient Information</div>
                  <div class="panel-body">

                  <!-- PATIENT ID -->
                    <div class="form-group row">
                      <label class="control-label col-md-2" for="PAT_ID" style="float:left; width:170px;">Patient ID </label>
                      <div class="col-md-3" style="float:left; width:170px;">
                        <input  class="form-control" id="PAT_ID" placeholder="Enter Patient ID" maxlength="<?php echo $ID_LENG; ?>" name="PAT_ID" required>
                      </div>
					   <div class="col-md-3" style="width: 180px; float: left;">
						<input type="text" class="form-control" id="PAT_NAME" placeholder="Patient Name" maxlength="<?php echo $MAX_NAME; ?>" name="PAT_ID" required>
					  </div>
                    </div>
                  <!-- PATIENT ID END -->

                  <!-- VISUAL IMPARITY -->
                    <div class="form-group row">
                      <label class="control-label col-md-2" for="VI" style="float:left; width:170px;">Visual Imparity </label>
                      <div class="col-md-7" style="width: 600px; float: left;">
                        <textarea type="text" class="form-control" id="VI" placeholder="Description of visual imparity..." maxlength="<?php echo $VI_MAX; ?>" name="VI" rows="2" required></textarea>
                      </div>
                    </div>
                  <!-- VISUAL IMPARITY END -->
                    
                  <!-- MEDICAL HISTORY -->
                    <div class="form-group row">
                      <label class="control-label col-md-2" for="MED_HIST" style="float:left; width:170px;">Medical History </label>
                      <div class="col-md-7" style="width: 600px; float: left;">
                        <textarea type="text" class="form-control" id="MED_HIST" placeholder="Patient medical history..." maxlength="<?php echo $HIST_MAX; ?>" name="MED_HIST" rows="2"></textarea>
                      </div>
                    </div>
                  <!-- MEDICAL HISTORY END -->

                  </div>
                </div>
              </div>
            <!-- VISUAL ACUITY END -->

            <!-- SURGERY DETAILS -->
              <div class="panel-group" style="margin-top:25px;">
                <div class="panel panel-default" style="">
                  <div class="panel-heading" id="panelh">Surgery Details</div>
                    <div class="panel-body">

                  <!-- CLEARANCE -->
                    <div class="form-group row">
                      <label class="control-label col-md-3" for="CLEAR" style="float:left; width:200px;">Clearance Number </label>
                      <div class="col-md-2" style="width: 170px; float: left;">
                        <input type="text" class="form-control" id="CLEAR" placeholder="Enter No." maxlength="<?php echo $CLEAR_LENG; ?>" name="CLEAR" required>
                      </div>
                    </div>
                  <!-- CLEARANCE END -->

                  <!-- SURGERY ADDRESS -->
                    <div class="form-group row">
                      <label class="control-label col-md-3" for="SURG_ADD" style="float:left; width:200px;">Surgery Address</label>
                      <div class="col-md-6" style="width: 550px; float: left;">
                        <input type="" class="form-control" id="SURG_ADD" placeholder="Enter address of where the sugery was conducted..." maxlength="<?php echo $SURGADD_MAX; ?>" name="SURG_ADD">
                      </div>
                    </div>
                  <!-- SURGERY ADDRESS END -->

                  <!-- DATE -->
                    <div class="form-group row">
                      <label class="control-label col-md-3" style="float:left; width:200px;">Date of Surgery </label>

                      <div class="col-md-2">
                          <label class="sr-only" for="MM">Month</label>
                          <select class="form-control"  name="MM" style="width: 120px; float: left;" required>
                            <?php for ($j=0; $j < count($MONTH_choice); $j++) { 
                              echo '<option value="'.($j+1).'">'.$MONTH_choice[$j].'</option>';
                             } ?>
                          </select>
                      </div>

                      <div class="col-md-1" style="width: 80px; float: left;">
                          <label class="sr-only" for="DD">Day</label>
                          <input pattern="\d||[0-2]\d|3[0-1]|" title="" class="form-control" placeholder="DD" maxlength="<?php echo $SURG_DATE_DD; ?>" name="DD" required>
                      </div>

                      <div class="col-md-2" style="width: 100px; float: left;">
                          <label class="sr-only" for="YY">Year</label>
                          <input pattern="[1-2]\d\d\d" title="" class="form-control" placeholder="YYYY" maxlength="<?php echo $SURG_DATE_YY; ?>" name="YY" required>
                      </div>

                    </div>
                  <!-- DATE END -->

                  </div>
                </div>
              </div>
            <!-- SURGERY DETAILS END -->

            <!-- SURGEON REPORT -->
              <div class="panel-group" style="margin-top:25px;">
                <div class="panel panel-default" style="">
                  <div class="panel-heading" id="panelh">Surgery Report</div>
                    <div class="panel-body">

                  <!-- DIAGNOSIS-->
                    <div class="form-group row">
                      <label class="control-label col-md-2" for="DIAG" style="float:left; width:170px;">Diagnosis </label>
                      <div class="col-md-7" style="width: 600px; float: left;">
                        <textarea type="text" class="form-control" id="DIAG" placeholder="Eye Surgery Diagnosis" maxlength="<?php echo $DIAG_MAX; ?>" name="DIAG"></textarea>
                      </div>
                    </div>
                  <!-- DIAGNOSIS END -->
                    
                  <!-- SURGERY REMARKS -->
                    <div class="form-group row">
                      <label class="control-label col-md-2" for="REM" style="float:left; width:170px;">Remarks</label>
                      <div class="col-md-7" style="width: 600px; float: left;">
                        <textarea type="text" class="form-control" id="REM" placeholder="Surgeon's Remarks" maxlength="<?php echo $REM_MAX; ?>" name="REM"></textarea>
                      </div>
                    </div>
                  <!-- SURGERY REMARKS END -->

                  </div>
                </div>
              </div>
            <!-- SURGERY REPORT END -->


          <!-- ENTER -->
          <div class="text-center" style="margin-bottom: 20px;">
            <button type="submit" class="btn" id="go" name="surgery_info">Submit</button>
          </div>
          <!-- ENTER END -->

          </form>
        </div>
      <!-- FORMS END -->
      
    </div>
  <!-- CONTENT END -->

  </div>
</div>
<!-- SURGERY FORM END -->

</div>
<!-- MAIN END -->

</body>
</html>