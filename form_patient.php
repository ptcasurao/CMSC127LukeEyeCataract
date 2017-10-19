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

<?php //CODE SECTION START

//PATIENT INFORMATION FIELDS MAX CHAR VALUES
$ID_LENG = 15;
$PHYL_LENG = 7;
$MAX_NAME = 40;
$FN_MAX = 20;
$LN_MAX = 20;
$STAFFL_LENG = 7;
$VD_MAX = 15;
$DC_MAX = 30;
$REA_MAX = 12;
$LEA_MAX = 12;
$VA_choice = array(10, 12.5, 16, 20, 25, 32, 40, 50, 63, 80, 100, 125, 160, 200);
//PATIENT INFORMATION FIELDS END

//CODE SECTION END
?>

<!-- PATIENT'S FORM -->
<div class="container-fluid" id="basic" style="padding-top: 10px;">

  <div id="inner" style="background-color:;">
  <!-- CONTENT -->
		<div class="container-fluid" >
      
      <!-- FORMS -->
        <div class="container-fluid">
          <h3>Patient Information</h3>
          <hr>
              
          <form method="post" action="submit.php">

          <!-- PATIENT NAME -->
            <div class="form-group row">
              <label class="col-md-2" style="float:left; width:170px;">Name</label>

            <div class="col-md-7">
            <!-- FIRST NAME -->
              <div style="width: 175px; float: left; margin-right:10px;">
                <label class="sr-only" for="PF_NAME" required >First Name</label>
                <input type="text" class="form-control" id="PF_NAME" placeholder="First Name"  maxlength="<?php echo $FN_MAX; ?>" name="PF_NAME" required>
              </div>
            <!-- FIRST NAME END -->

            <!-- LAST NAME -->
              <div style="width: 175px; float: left; margin-right:10px;">
                <label class="sr-only" for="PL_NAME">Last Name</label>
                <input type="text" class="form-control" id="PL_NAME" placeholder="Last Name"  maxlength="<?php echo $LN_MAX; ?>" name="PL_NAME" required>
              </div>
            <!-- LAST NAME END -->
            </div>

            </div>
          <!-- PATIENT NAME END -->

          <!-- INSERT OTHERS -->

          <!-- PATIENT ID -->
            <div class="form-group row">
              <label class="control-label col-md-2" for="PAT_ID" style="float:left; width:170px;">ID Number </label>
            <div class="col-md-7">
			       <div style="width: 150px; float: left; margin-right:10px;">
                <input type="text" class="form-control" id="PAT_ID" placeholder="Patient ID" maxlength="<?php echo $ID_LENG; ?>" name="PAT_ID" required>
              </div>
            </div>
            </div>
          <!-- PATIENT ID END -->

          <div class="well" style="padding-bottom:5px;">
          <!-- PHYSICIAN LICENSE NUMBER -->
            <div class="form-group row">
              <label class="control-label col-md-2" for="PHYS_LIC" style="float:left; width:170px;">Examined by: </label>
              <div class="col-md-7">
              <div style="width: 120px; float: left; margin-right:10px;">
                <input pattern="\d{7}" title="License Number ranges from 0000000-9999999." class="form-control" id="PHYS_LIC" placeholder="Phys. Lic." maxlength="<?php echo $PHYL_LENG; ?>" name="PHYS_LIC" required>
              </div>

			        <div style="width: 200px; float: left; margin-right:10px;">
                <input class="form-control" id="PHYS_NAME" placeholder="Physician Name" maxlength="<?php echo $MAX_NAME; ?>" name="PHYS_NAME">
              </div>
              </div>
            </div>
          <!-- PHYSICIAN LICENSE NUMBER END -->

          <!-- STAFF LICENSE NUMBER -->
            <div class="form-group row">
              <label class="control-label col-md-2" for="STAFF_LIC" style="float:left; width:170px;">Screened by: </label>
              <div class="col-md-7">
              <div style="width: 120px; float: left; margin-right:10px;">
                <input pattern="\d{7}" title="License Number ranges from 0000000-9999999." class="form-control" id="STAFF_LIC" placeholder="Staff Lic." maxlength="<?php echo $STAFFL_LENG; ?>" name="STAFF_LIC" required>
              </div>
			        <div style="width: 200px; float: left; margin-right:10px;">
                <input class="form-control" id="STAFF_NAME" placeholder="Staff Name" maxlength="<?php echo $MAX_NAME; ?>" name="STAFF_NAME">
              </div>
              </div>
            </div>
          <!-- STAFF LICENSE NUMBER END -->
          </div>

          <!-- VISUAL ACUITY -->
            <div class="panel-group" style="margin-top:25px;">
              <div class="panel panel-default" style="">
                <div class="panel-heading" id="panelh">Visual Acuity</div>
                  <div class="panel-body">

                  <!-- LEFT EYE W/ SPECT -->
                    <div class="form-group row">
                      <label class="control-label col-md-4" for="VASL" style="float:left; width:260px;">Left Eye with Spectacles</label>
                      <div class="col-md-3">
                        <div class="input-group">
                          <span class="input-group-addon">20</span>
                          <span class="input-group-addon">/</span>
                          <select class="form-control" id="VASL"  name="VASL" style="width: 80px;" required>
                          <?php for ($j=0; $j < count($VA_choice); $j++) { 
                            echo "<option>".$VA_choice[$j]."</option>";
                           } ?>
                           </select>
                        </div>
                      </div>
                    </div>
                  <!-- END -->
                  
                  <!-- RIGHT EYE W/ SPECT -->
                    <div class="form-group row">
                      <label class="control-label col-md-4" for="VASR" style="float:left; width:260px;">Right Eye with Spectacles</label>
                      <div class="col-md-3">
                        <div class="input-group">
                          <span class="input-group-addon">20</span>
                          <span class="input-group-addon">/</span>
                          <select class="form-control" id="VASR"  name="VASR" style="width: 80px;" required>
                          <?php for ($j=0; $j < count($VA_choice); $j++) { 
                            echo "<option>".$VA_choice[$j]."</option>";
                           } ?>
                           </select>
                        </div>
                      </div>
                    </div>
                  <!-- END -->

                  <!-- LEFT EYE W/O SPECT -->
                    <div class="form-group row">
                      <label class="control-label col-md-4" for="VAL" style="float:left; width:260px;">Left Eye without Spectacles</label>
                      <div class="col-md-3">
                        <div class="input-group">
                          <span class="input-group-addon">20</span>
                          <span class="input-group-addon">/</span>
                          <select class="form-control" id="VAL"  name="VAL" style="width: 80px;" required>
                          <?php for ($j=0; $j < count($VA_choice); $j++) { 
                            echo "<option>".$VA_choice[$j]."</option>";
                           } ?>
                           </select>
                        </div>
                      </div>
                    </div>
                  <!-- END -->

                  <!-- RIGHT EYE W/O SPECT -->
                    <div class="form-group row">
                      <label class="control-label col-md-4" for="VAR" style="float:left; width:260px;">Right Eye without Spectacles</label>
                      <div class="col-md-3">
                        <div class="input-group">
                          <span class="input-group-addon">20</span>
                          <span class="input-group-addon">/</span>
                          <select class="form-control" id="VAR"  name="VAR" style="width: 80px;" required>
                          <?php for ($j=0; $j < count($VA_choice); $j++) { 
                            echo "<option>".$VA_choice[$j]."</option>";
                           } ?>
                           </select>
                        </div>
                      </div>
                    </div>
                  <!-- END -->

                  </div>
                </div>
              </div>
            <!-- VISUAL ACUITY END -->

            <!-- DESCRIPTION OF VISUAL PROBLEM -->
              <div class="panel-group" style="margin-top:25px;">
                <div class="panel panel-default" style="">
                  <div class="panel-heading" id="panelh">Description of Visual Problem</div>
                    <div class="panel-body">

                  <!-- VISUAL DISABILITY -->
                    <div class="form-group row">
                      <label class="control-label col-md-2" for="VD" style="float:left; width:170px;">Visual Disability </label>
                      <div class="col-md-4" style="width: 230px;">
                        <input type="text" class="form-control" id="VD" placeholder="Patient's eye disability..." maxlength="<?php echo $VD_MAX; ?>" name="VD">
                      </div>
                    </div>
                  <!-- VISUAL DISABILITY -->

                  <!-- CAUSE OF DISABILITY -->
                    <div class="form-group row">
                      <label class="control-label col-md-2" for="DC" style="float:left; width:170px;">Cause </label>
                      <div class="col-md-6" style="width: 400px;">
                        <input type="text" class="form-control" id="DC" placeholder="Enter the cause of the patient's visual disability..." maxlength="<?php echo $DC_MAX; ?>" name="DC">
                      </div>
                    </div>
                  <!-- CAUSE OF DISABILITY END -->

                  </div>
                </div>
              </div>
            <!-- DESCRIPTION OF VISUAL PROBLEM END -->

            <!-- AFFECTED EYE -->
              <div class="panel-group" style="margin-top:25px;">
                <div class="panel panel-default" style="">
                  <div class="panel-heading" id="panelh">Affected Eye</div>
                    <div class="panel-body">

                  <!-- AFFECTED PART OF RIGHT EYE -->
                    <div class="form-group row">
                      <label class="control-label col-md-2" for="REA" style="float:left; width:170px;">Right Eye</label>
                      <div class="col-md-4" style="width: 200px;">
                        <input type="" class="form-control" id="REA" placeholder="Affected Area of Eye" maxlength="<?php echo $REA_MAX; ?>" name="REA">
                      </div>
                    </div>
                  <!-- AFFECTED PART OF RIGHT EYE END -->
                    
                  <!-- AFFECTED PART OF LEFT EYE -->
                    <div class="form-group row">
                      <label class="control-label col-md-2" for="LEA" style="float:left; width:170px;">Left Eye</label>
                      <div class="col-md-4" style="width: 200px;">
                        <input type="" class="form-control" id="LEA" placeholder="Affected Area of Eye" maxlength="<?php echo $LEA_MAX; ?>" name="LEA">
                      </div>
                    </div>
                  <!-- AFFECTED PART OF LEFT EYE END -->

                  </div>
                </div>
              </div>
            <!-- DESCRIPTION OF VISUAL PROBLEM END -->


          <!-- ... -->
            
          <!-- ... -->

          <!-- ENTER -->
          <div class="text-center" style="margin-bottom: 20px;">
            <button type="submit" class="btn" id="go" name="patients_info">Submit</button>
          </div>
          <!-- ENTER END -->

          </form>
        </div>
      <!-- FORMS END -->
      
    </div>
  <!-- CONTENT END -->

  </div>
</div>
<!-- PATIENT'S FORM END -->

</div>
<!-- MAIN END -->

</body>
</html>