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

<!-- HEAD AND NAVIGATION -->
<?php include("nav.php"); include ("dbconnect.php") ?>
<!-- HEAD AND NAVIGATION END -->

<div id="body">
<!-- MAIN -->
<div class="container-fluid" id="outer">

<!-- TITLE -->
  <div class="container-fluid" style="color: #ffffff;">
    <h4>Eye Cataract Program</h4> <br>
  </div>
<!-- TITLE -->

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
          <hr>
              
          <form method="post" action="submit.php">

          <!-- CASE NUMBER-->
            <div class="form-group row">
              <label class="control-label col-md-2" for="CASE_NUM" style="float:left; width:170px;">Case Number </label>
              <div class="col-md-2" style="width: 150px; float: left;">
                <input pattern="20\d\d-\d\d\d\d\d" title="Case Numbers range from 2000-00000 to 2099-99999." class="form-control" id="CASE_NUM" placeholder="20XX-XXXXX" maxlength="<?php echo $CASE_LENG; ?>" name="CASE_NUM" required>
              </div>
            </div>
          <!-- CASER NUMBER END -->

          <!-- RADIO FOR LICENSE -->
            <div class="radio-buttons row">
              <label class="control-label col-md-2" for="SURG_LIC" style="float:left; width:170px;">Conducted by: </label>
              <form name="raddoc" method="post" action="<?php
                $selected=$_POST['optradio'];
                if ($selected=="NEW"){
                  echo "I AM CUTE";
                }
              ?>">
                <label class="radio-inline"><input type="radio" name="optradio" value="OLD" style="float: left">Use existing license</label>
                <label class="radio-inline"><input type="radio" name="optradio" value="NEW">Use new license</label>
              </form>
              
            </div>
          <!-- RADIO FOR LICENSE END -->
          
          <!-- SURGEON LICENSE NUMBER -->
            <div class="form-group row">
              
              <div class="col-md-7" style="float:left;">
              <div style="width: 325px; float: left; margin-right:10px; padding-left: 150px;">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="background-color: white; color: gray;">Surg. License Number
                <span class="caret"></span></button>
                <ul class="dropdown-menu" style="margin-left: 150px;">

                  <?php
                    $result= $mydatabase->query("select DOC_LICENSE_NUM from DOCTOR");

                    while ($row = $result->fetch_assoc()) {
                      echo '<li><a href="#">';
                      unset($license);
                      $license = $row['DOC_LICENSE_NUM'];
                      echo $license.'</a></li>';
                    }
                  ?>
                </ul>
                

                <!--

                <input pattern="\d{7}" title="License Number ranges from 0000000-9999999." class="form-control" id="SURG_LIC" placeholder="Surg. License Number" maxlength="<?php echo $SURG_LENG; ?>" name="SURG_LIC" required>

                -->
              </div>
              <div style="width: 250px; float: left; margin-right:10px;">
      				  <input class="form-control" id="SURG_NAME" placeholder="Surgeon Name" maxlength="40">
      			  </div>
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
                      <div class="col-md-7"  style="float:left;">
                      <div style="float:left; width:170px; margin-right:10px;">
                        <input  class="form-control" id="PAT_ID" placeholder="Enter Patient ID" maxlength="<?php echo $ID_LENG; ?>" name="PAT_ID" required>
                      </div>
					            <div style="width: 180px; float: left; margin-right:10px;">
						            <input type="text" class="form-control" id="PAT_NAME" placeholder="Patient Name" maxlength="<?php echo $MAX_NAME; ?>" name="PAT_NAME">
					           </div>
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
                    <div class="col-md-7"  style="float:left; min-width:400px;">
                      <div>
                          <label class="sr-only" for="MM">Month</label>
                          <select class="form-control" name="MM" style="width: 120px; float: left; margin-right:10px;" required>
                            <?php for ($j=0; $j < count($MONTH_choice); $j++) { 
                              echo '<option value="'.($j+1).'">'.$MONTH_choice[$j].'</option>';
                             } ?>
                          </select>
                      </div>

                      <div style="width: 80px; float: left; margin-right:10px;">
                          <label class="sr-only" for="DD">Day</label>
                          <input pattern="\d||[0-2]\d|3[0-1]|" class="form-control" placeholder="DD" maxlength="<?php echo $SURG_DATE_DD; ?>" name="DD" required>
                      </div>

                      <div  style="width: 100px; float: left; margin-right:10px;">
                          <label class="sr-only" for="YY">Year</label>
                          <input pattern="[1-2]\d\d\d" class="form-control" placeholder="YYYY" maxlength="<?php echo $SURG_DATE_YY; ?>" name="YY" required>
                      </div>
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
</div>

</body>
</html>