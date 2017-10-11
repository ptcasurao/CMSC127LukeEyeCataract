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
    <h4>Form Submission</h4> <br>
  </div>
<!-- TITLE -->

<!-- PAGE DESCRIPTION -->
<!--
  - RECEPTION: receives information from forms
  - PROGRESS: incomplete, to be further revised and supplemented
  - REMARKS:-this page processes info. received from the different forms and adds it to the database
 -->
<!-- PAGE DESCRIPTION END -->

<?php  //CODE SECTION START

//ESTABLISHING MYSQL LINK (1)

include("dbconnect.php");

//ESTABLISHING MYSQL LINK END (1)

//FUNCTIONS (2)

  //INSERT INTO DATABASE 
    //(SAMPLE 1) STILL TO BE REVISED/TESTED....
function SUBMIT_DOCTOR($D_FNAME, $D_LNAME, $D_LICENSENUM, $D_ADDR){
  $D_query = "INSERT INTO DOCTOR VALUES ('".$D_LICENSENUM."','".$D_LNAME."','".$D_FNAME."','".$D_ADDR."')";
  if ($GLOBALS['mydatabase']->query($D_query) === TRUE) { echo "New doctor record successfully created."; }
  else { echo "Error. " . $GLOBALS['mydatabase']->error; }
}//END
    //(SAMPLE 2) STILL TO BE REVISED/TESTED....
function SUBMIT_EYEPATIENT($P_ID, $P_PHYLIC, $P_STAFFLIC, $P_VASR, $P_VASL, $P_VAR, $P_VAL, $P_VISUALDISAB, $P_DISABCAUSE, $P_REA, $P_LEA){
  $P_query = "INSERT INTO EYEPATIENT VALUES ('".$P_ID."','".$P_PHYLIC."','".$P_STAFFLIC."','".$P_VASR."','".$P_VASL."','".$P_VAR."','".$P_VAL."','".$P_VISUALDISAB."','".$P_DISABCAUSE."','".$P_REA."','".$P_LEA."')";
  if ($GLOBALS['mydatabase']->query($P_query) === TRUE) { echo "New patient record successfully created."; }
  else { echo "Error. " . $GLOBALS['mydatabase']->error; }
}//END
    //(SAMPLE 3) STILL TO BE REVISED/TESTED....
function SUBMIT_SURGERY($S_CASENUM, $S_SURGLIC, $S_PATID, $S_VISUALIM, $S_MEDHIST, $S_DIAG, $S_CLEAR, $S_SURGADDR, $S_SURGDATE, $S_REMARK){
  $S_query = "INSERT INTO SURGERY VALUES ('".$S_CASENUM."','".$S_SURGLIC."','".$S_PATID."','".$S_VISUALIM."','".$S_MEDHIST."','".$S_DIAG."','".$S_CLEAR."','".$S_SURGADDR."','".$S_SURGDATE."','".$S_REMARK."')";
  if ($GLOBALS['mydatabase']->query($S_query) === TRUE) { echo "New surgery record successfully created. "; }
  else { echo "Error. " . $GLOBALS['mydatabase']->error; }
}//END

//FUNCTIONS END (2)

//var_dump($_POST);

//INFORMATION RECIEVED (3)







//INFORMATION END (3)

//CODE SECTION END
?>

<!-- SUBMIT -->
<div class="container-fluid" id="basic" style="padding-top: 10px;">

  <div id="inner">
  <!-- CONTENT -->
		<div class="container-fluid" >
     <div>
       
     <!-- CONTENT: TO BE CONSTRUCTED -->
     <?php
        if (isset($_POST['doctors_info'])) {
			  //DOCTOR INFORMATION FIELDS
				$F_NAME = $_POST["F_NAME"];
				$L_NAME = $_POST["L_NAME"];
				$LICENSE_NUM = $_POST["LICENSE_NUM"];
				$ADDRESS = $_POST["ADDRESS"];
				//DOCTOR INFORMATION END
          SUBMIT_DOCTOR($F_NAME, $L_NAME, $LICENSE_NUM, $ADDRESS);
        }else if (isset($_POST['patients_info'])) {
			
			  //PATIENT INFORMATION FIELDS          
				$PAT_ID_NUM1 = $_POST["PAT_ID"];       
				$PHY_LICENSE_NUM = $_POST["PHYS_LIC"];
				$STAFF_LICENSE_NUM = $_POST["STAFF_LIC"];  
				$VA_WITH_SPECT_RIGHT = '20/'.$_POST["VASR"];     
				$VA_WITH_SPECT_LEFT = '20/'.$_POST["VASL"];     
				$VA_NO_SPECT_RIGHT = '20/'.$_POST["VAR"];
				$VA_NO_SPECT_LEFT = '20/'.$_POST["VAL"];
				$VISUAL_DISABILITY = $_POST["VD"];         
				$DISABILITY_CAUSE = $_POST["DC"];          
				$RIGHT_EYE_AFFECTED = $_POST["REA"];       
				$LEFT_EYE_AFFECTED = $_POST["LEA"];        
				  //PATIENT INFORMATION FIELDS END
			
          SUBMIT_EYEPATIENT($PAT_ID_NUM1, $PHY_LICENSE_NUM, $STAFF_LICENSE_NUM, $VA_WITH_SPECT_RIGHT, $VA_WITH_SPECT_LEFT, $VA_NO_SPECT_RIGHT, $VA_NO_SPECT_LEFT, $VISUAL_DISABILITY, $DISABILITY_CAUSE, $RIGHT_EYE_AFFECTED, $LEFT_EYE_AFFECTED);
        }else if (isset($_POST['surgery_info'])) {
			
			  //SURGERY INFORMATION FIELDS
				$CASE_NUM = $_POST["CASE_NUM"];       
				$SURG_LICENSE_NUM = $_POST["SURG_LIC"];  
				$PAT_ID_NUM2 = $_POST["PAT_ID"];          
				$VISUAL_IMPARITY = $_POST["VI"];         
				$MED_HISTORY = $_POST["MED_HIST"];       
				$DIAGNOSIS = $_POST["DIAG"];             
				$CLEARANCE_NUM = $_POST["CLEAR"];        
				$SURG_ADDRESS = $_POST["SURG_ADD"];                      
				$SURG_DATE = $_POST["YY"]."-".$_POST["MM"]."-".$_POST["DD"];
				$REMARKS = $_POST["REM"];                                 
				  //SURGERY INFORMATION FIELDS END
			
          SUBMIT_SURGERY($CASE_NUM, $SURG_LICENSE_NUM, $PAT_ID_NUM2, $VISUAL_IMPARITY, $MED_HISTORY, $DIAGNOSIS, $CLEARANCE_NUM, $SURG_ADDRESS, $SURG_DATE, $REMARKS);
        }
        $mydatabase->close();
        echo '<br>';
        echo '<div ><a href="'.'Home.php'.'" >Back-to-Home</a></div>';

     ?>

     </div>
    </div>
  <!-- CONTENT END -->

  </div>
</div>
<!-- SUBMIT END -->

</div>
<!-- MAIN END -->

</body>
</html>