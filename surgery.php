<!DOCTYPE html>
<html>
<head>
	<title>Prototype</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--	<link rel="stylesheet" href="bootstrap.min.css">	-->
	<link rel="stylesheet" href="./bootstrap.min.css">
	<!-- 	<script src="jquery.min.js"></script>	-->
	<script src="./jquery.min.js"></script>
  	<!--	<script src="bootstrap.min.js"></script>	-->
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
  $i = 0;
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

<!--

TABLE INFORMATION
	-	Date
	-	Case_number
	-	Surgeon
	-	Patient
	-	Visual_imparity
	-	Medical_history
	- Diagnosis
	-	Location
	-	Remarks

-->

<?php //CODE SECTION STARTS HERE

//ESTABLISHING MYSQL LINK (1)

include("dbconnect.php");
//ESTABLISHING MYSQL LINK END (1)

//MAX VAUES
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
$MONTH_choice = array("January","Febuary","March","April","May","June","July","August","September","October","November","December");
//MAX VALUES END

//CODE SECTION ENDS HERE
?>

<!-- SURGERIES -->
<div class="container-fluid" id="basic" >
	<div id="inner">
		
	<!-- TITLE -->
		<div class="container-fluid" >
			<h4>Eye Cataract Surgeries</h4>
			<br>
		</div>
	<!-- TITLE -->

<!-- CONTENT -->
		<div class="container-fluid" >
      <div>

      <!-- MODIFIABLE CODE STARTS HERE -->

      <!-- PROFILES -->
        <div class="container-fluid">
          <ul class="list-group">

      <?php //CODE SECTION STARTS HERE

      $DEFAULT = 0;
      if (isset($_GET["currentpage"])) { $current_p = $_GET["currentpage"]; } else { $current_p = 1; };
      if (isset($_GET["profilepage"])) { $profile_p = $_GET["profilepage"]; $DEFAULT=1;

        //RECEIVE UPDATE
        if(isset($_POST['surgery_update'])){
          $S_CN = $_POST["CASE_NUM"];
          $S_LN = $_POST["SURG_LIC"];  
          $S_ID = $_POST["PAT_ID"];          
          $S_VI = $_POST["VI"];         
          $S_MH = $_POST["MED_HIST"];       
          $S_D = $_POST["DIAG"];
          $S_CLR = $_POST["CLEAR"];
          $S_A = $_POST["SURG_ADDRESS"];                      
          $S_DATE = $_POST["YY"]."-".$_POST["MM"]."-".$_POST["DD"];
          $S_R = $_POST["REM"];                                 
          $toupdate = $_POST["surgery_update"];

          $S_update = "UPDATE SURGERY SET CASE_NUM = '$S_CN', SURG_LICENSE_NUM = '$S_LN', PAT_ID_NUM = '$S_ID', VISUAL_IMPARITY = '$S_VI', MED_HISTORY = '$S_MH', DIAGNOSIS = '$S_D', CLEARANCE_NUM = '$S_CLR', SURG_ADDRESS ='$S_A', SURG_DATE ='$S_DATE', REMARKS ='$S_R' WHERE CASE_NUM = '$toupdate' ";
      
          if ($mydatabase->query($S_update) === TRUE) {
            //echo "Record updated successfully";
          } else {
            // echo '<script> window.location = "doctors.php?profilepage='.$_POST['doctors_update'].'"; </script>';
            echo '
            <div class="alert alert-danger alert-dismissable">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
              <strong>Error updating record: </strong>'.$mydatabase->error.'</div>';
          }
        }//RECIEVE UPDATE END

      } else {};
      if (isset($_GET["delete"])) { $delete_p =$_GET["delete"]; $DEFAULT=2; } else {};

      //MYSQL SECTION
      $limit = 20;
      $begin = ($current_p-1)*$limit;
      $S_query_list = "SELECT * FROM SURGERY s, DOCTOR d where s.SURG_LICENSE_NUM = d.DOC_LICENSE_NUM order by SURG_DATE desc limit $begin";
      $S_query = $S_query_list.$limit;
      $output = $mydatabase->query($S_query);
      //MYSQL SECTION END
        
      if($DEFAULT==0){
        if ($output->num_rows > 0) {

        //MAIN PAGE

          //HEADER
          echo '<li class="list-group-item" id="tophead">';
          echo '<div class="container-fluid row">';
          echo '<div class="col-md-2" style="width:150px; float:left;"><b>'.'Date'.'</b></div>';
          echo '<div class="col-md-2" style="width:180px; float:left;"><b>'.'Case No.'.'</b></div>';
          echo '<div class="col-md-3" style="width:230px; float:left;"><b>'.'Conducted by'.'</b></div>';
          echo '<div class="col-md-3" style="width:200px; float:left;"><b>'.'Clearance No.'.'</b></div>';
          echo '</div>';
          echo '</li>';
          //HEADER END

          //CONTENT
          while($dataline = $output->fetch_assoc()) { 

            echo '<li class="list-group-item">';
            echo '<div class="row">';

                echo '<div class="col-md-2" style="width:150px; float:left;">'.$dataline["SURG_DATE"].'</div>';
                $s_primary = $dataline["CASE_NUM"];
                echo '<div class="col-md-2" style="width:180px; float:left;">'.$s_primary.'</div>';
                echo '<div class="col-md-3" style="width:230px; float:left;">'.$dataline["LAST_NAME"].' '.$dataline["FIRST_NAME"].'</div>';
                echo '<div class="col-md-3" style="width:200px; float:left;">'.$dataline["CLEARANCE_NUM"].'</div>';
                echo '<div class="col-md-2" style="width:150px; float:right;">'.'<a href="'.'surgery.php'.'?profilepage='.$dataline["CASE_NUM"].'">'.'see full details'.'</a>'.'</div>';
              
            echo '<div>';
            echo '</li>';

          }//CONTENT END
      
      //PAGER
      echo '<div style="text-align:center;">';
      echo '<ul class="pagination" style="margin:auto;">';
      echo '<br>';
          
          $check = "SELECT CASE_NUM FROM SURGERY";
          $check2 = $mydatabase->query($check);
          $item_no = $check2->num_rows;
          $page_no = ceil($item_no/$limit);
          
          if($page_no>1){
            for ($p_no=0; $p_no < $page_no; $p_no++) { 
              echo '<li><a style="color:#4a6a15;" href="'.'surgery.php'.'?currentpage='.($p_no+1).'">'.($p_no+1).'</a> </li>';
            }
          } 

      echo '</ul>';
      echo '</div>';
      //PAGER END

      } else { echo "No Records."; }

      //MAIN PAGE END

    }else if ($DEFAULT==1) {

      //FULL DETAILS PAGE

      //MYSQL SECTION
      $output1 = $mydatabase->prepare("SELECT s.*, d.LAST_NAME, d.FIRST_NAME FROM SURGERY s, DOCTOR d where s.SURG_LICENSE_NUM = d.DOC_LICENSE_NUM and CASE_NUM = '$profile_p' ");      
      $output1->execute();
      $line = $output1->get_result();
      $dataline = $line->fetch_assoc();
      //MYSQL SECTION END

      //VALUES
      $S_CN = $dataline["CASE_NUM"];
      $S_LN = $dataline["SURG_LICENSE_NUM"];
      $S_ID = $dataline["PAT_ID_NUM"];
      $S_VI = $dataline["VISUAL_IMPARITY"];
      $S_MH = $dataline["MED_HISTORY"];
      $S_D = $dataline["DIAGNOSIS"];
      $S_CLR = $dataline["CLEARANCE_NUM"];
      $S_A = $dataline["SURG_ADDRESS"];
      $S_DATE = $dataline["SURG_DATE"];
      $S_R = $dataline["REMARKS"];
      $date = explode("-", $S_DATE);
      //VALUES END

      //CONTENT
      echo '<div>
        <div class="container-fluid">
          <h3>Case No.: '.$S_CN.'</h3>
          <div class="panel panel-default" style="padding-bottom:10px;">
            <div class="panel-heading" style="background-color:#2d4309; color:#ffffff;">Surgery Details</div>
            <div class="panel-body row" style="margin:0px; padding:5px 10px;">
              <div class="col-md-3" >'.'Clearance Number'.'</div>
              <div class="col-md-9">'.$S_CLR.'</div>
            </div>
            <div class="panel-body row" style="margin:0px; padding:5px 10px;">
              <div class="col-md-3" >'.'Surgery Address'.'</div>
              <div class="col-md-9">'.$S_A.'</div>
            </div>
            <div class="panel-body row" style="margin:0px; padding:5px 10px;">
              <div class="col-md-3" >'.'Surgery Date'.'</div>
              <div class="col-md-9">';
            echo $MONTH_choice[$date[1]-1].' '.$date[2].', '.$date[0];
            echo'</div>
            </div>
          </div>
          <div class="panel panel-default" style="padding-bottom:10px;">
            <div class="panel-heading" style="border: 0px; font-weight:bold;">Conducting Surgeon</div>
            <div class="panel-body row" style="margin:0px; padding:5px 10px;">
              <div class="col-md-3" >'.'Name'.'</div>
              <div class="col-md-9">'.$dataline["FIRST_NAME"].' '.$dataline["LAST_NAME"].'</div>
            </div>
            <div class="panel-body row" style="margin:0px; padding:5px 10px;">
              <div class="col-md-3" >'.'License No.'.'</div>
              <div class="col-md-9">'.$S_LN.'</div>
            </div>
          </div>
          <div class="panel panel-default" style="padding-bottom:10px;">
            <div class="panel-heading" style="border: 0px; font-weight:bold;">Patient Information</div>
            <div class="panel-body row" style="margin:0px; padding:5px 10px;">
              <div class="col-md-3" >'.'Patient ID'.'</div>
              <div class="col-md-9">'.$S_ID.'</div>
            </div>
            <div class="panel-body row" style="margin:0px; padding:5px 10px;">
              <div class="col-md-3" >'.'Visual Imparity'.'</div>
              <div class="col-md-9">'.$S_VI.'</div>
            </div>
            <div class="panel-body row" style="margin:0px; padding:5px 10px;">
              <div class="col-md-3" >'.'Medical History'.'</div>
              <div class="col-md-9">'.$S_MH.'</div>
            </div>
          </div>
          <div class="panel panel-default" style="padding-bottom:10px;">
            <div class="panel-heading" style="border: 0px; font-weight:bold;">Surgeon Remarks</div>
            <div class="panel-body row" style="margin:0px; padding:5px 10px;">
              <div class="col-md-3" >'.'Diagnosis'.'</div>
              <div class="col-md-9">'.$S_D.'</div>
            </div>
            <div class="panel-body row" style="margin:0px; padding:5px 10px;">
              <div class="col-md-3" >'.'Remarks'.'</div>
              <div class="col-md-9">'.$S_R.'</div>
            </div>
          </div>
        </div>
      </div>';
      //CONTENT END

      //BUTTONS AND LINKS
      echo '<div style="text-align:right;"><a href="'.'patient.php'.'">Back</a></div>';
      echo '<a role="button" class="btn btn-default"'.'href="'.'surgery.php'.'?delete='.$profile_p.'" style="margin:0px 10px;"> <span class="glyphicon glyphicon-trash"></span> Delete </a>';
      echo '<button type="button" class="btn btn-default" data-toggle="modal" data-target="#EditBox" style="margin:0px 10px;"><span class="glyphicon glyphicon-edit"></span> Edit</button>';
      //BUTTONS AND LINKS END

      // POP-UP ALERT
      echo '<div class="modal fade" id="EditBox" role="dialog" style="">
        <div class="modal-dialog modal-lg">';
    
        //POP-UP CONTENT
        echo '<div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Record</h4>
          </div>
          <div class="modal-body">';

        $leftmargin = 220;

        //EDIT FORM
        echo '<div class="container-fluid">
          <form method="post" id="updating" action="#" >

          <div class="container-fluid" style="margin-bottom: 10px;">
            <label for="CASE_NUM" style="width: '.$leftmargin.'px; float: left; ">Patient ID No. </label>
            <input pattern="20\d\d-\d\d\d\d\d" title="Case Numbers range from 2000-00000 to 2099-99999." type="text" class="form-control" id="CASE_NUM" maxlength="'.$CASE_LENG.'" name="CASE_NUM" value="'.$S_CN.'" style="width: 150px; float: left;" required >
          </div>
          <div class="container-fluid" style="margin-bottom: 10px;">
            <label for="CLEAR" style="width: '.$leftmargin.'px; float: left; ">Clearance No. </label>
            <input type="text" class="form-control" id="CLEAR" maxlength="'.$CLEAR_LENG.'" name="CLEAR" value="'.$S_CLR.'" style="width: 150px; float: left;" required >
          </div>
          <div class="container-fluid" style="margin-bottom: 10px;">
            <label for="SURG_ADDRESS" style="width: '.$leftmargin.'px; float: left; ">Surgery Address </label>
            <input type="text" class="form-control" id="SURG_ADDRESS" maxlength="'.$SURGADD_MAX.'" name="SURG_ADDRESS" value="'.$S_A.'" style="max-width: 450px; float: left;">
          </div>
          <div class="container-fluid" style="margin-bottom: 10px;">
            <label class="control-label" style="float:left; width:'.$leftmargin.'px;">Date of Surgery </label>
            <div>
              <label class="sr-only" for="MM">Month</label>
              <select class="form-control"  name="MM" style="width: 120px; float: left; margin-right:10px;" required>';
                for ($j=0; $j < count($MONTH_choice); $j++) {
                  if($j==$date[1]-1){
                    echo '<option value="'.($j+1).'" selected>'.$MONTH_choice[$j].'</option>';
                  }else{
                    echo '<option value="'.($j+1).'">'.$MONTH_choice[$j].'</option>';
                  }
                }
              echo '</select>
            </div>
            <div style="width: 45px; float: left; margin-right:10px;">
              <label class="sr-only" for="DD">Day</label>
              <input pattern="\d||[0-2]\d|3[0-1]|" title="" class="form-control" placeholder="DD" maxlength="'.$SURG_DATE_DD.'" name="DD" value="'.$date[2].'" required>
            </div>
            <div style="width: 65px; float: left; margin-right:10px;">
              <label class="sr-only" for="YY">Year</label>
              <input pattern="[1-2]\d\d\d" title="" class="form-control" placeholder="YYYY" maxlength="'.$SURG_DATE_YY.'" name="YY" value="'.$date[0].'" required>
            </div>
          </div>
          <div class="container-fluid" style="margin-bottom: 10px;">
            <label for="SURG_LIC" style="float:left; width:'.$leftmargin.'px;">Surgeon License No. </label>
            <input pattern="\d{7}" title="License Number ranges from 0000000-9999999." type="text" class="form-control id="SURG_LIC" maxlength="'.$SURG_LENG.'" name="SURG_LIC" value="'.$S_LN.'" style="width: 90px; float: left;" required>
          </div>
          <div class="container-fluid" style="margin-bottom: 10px;">
            <label for="PAT_ID" style="width: '.$leftmargin.'px; float: left; ">Patient ID No. </label>
            <input type="text" class="form-control" id="PAT_ID" maxlength="'.$ID_LENG.'" name="PAT_ID" value="'.$S_ID.'" style="width: 150px; float: left;" required >
          </div>
          <div class="container-fluid" style="margin-bottom: 10px;">
            <label for="VI" style="width: '.$leftmargin.'px; float: left; ">Patient Visual Imparity </label>
            <textarea type="text" class="form-control" id="VI" maxlength="'.$VI_MAX.'" name="VI" style="max-width: 550px; float: left;" rows="2" required>'.$S_VI.'</textarea>
          </div>
          <div class="container-fluid" style="margin-bottom: 10px;">
            <label for="MED_HIST" style="width: '.$leftmargin.'px; float: left; ">Patient Medical History </label>
            <textarea type="text" class="form-control" id="MED_HIST" maxlength="'.$HIST_MAX.'" name="MED_HIST" style="max-width: 550px; float: left;" rows="2" >'.$S_MH.'</textarea>
          </div>
          <div class="container-fluid" style="margin-bottom: 10px;">
            <label for="DIAG" style="width: '.$leftmargin.'px; float: left; ">Surgeon Diagnosis </label>
            <textarea type="text" class="form-control" id="DIAG" maxlength="'.$DIAG_MAX.'" name="DIAG" style="max-width: 550px; float: left;" rows="2" >'.$S_D.'</textarea>
          </div>
          <div class="container-fluid" style="margin-bottom: 10px;">
            <label for="REM" style="width: '.$leftmargin.'px; float: left; ">Surgeon Remarks </label>
            <textarea type="text" class="form-control" id="REM" maxlength="'.$REM_MAX.'" name="REM" style="max-width: 550px; float: left;" rows="2" >'.$S_R.'</textarea>
          </div>

          <div class="text-center" style="margin-top: 20px;">
            <button type="submit" onclick="update()" class="btn btn-default" value="'.$S_CN.'" name="surgery_update">Update</button>
          </div>

          </form>
        </div>';
        //EDIT FORM END

        echo '</div>
          <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" >Cancel</button>
          </div>
        </div>';
        //POP-UP CONTENT END

        echo '<script>
          function update() {
            var casenumber = document.getElementById("CASE_NUM").value;
            document.getElementById("updating").action = "surgery.php?profilepage="+casenumber;
          }
        </script>';
      
      echo '</div>
        </div>';
      //POP-UP ALERT END

      //FULL DETAILS PAGE END

    }else if($DEFAULT==2){

      //DELETE
      $del = "DELETE FROM SURGERY WHERE CASE_NUM = '$delete_p' ";

      //MYSQL SECTION
      if ($mydatabase->query($del) === TRUE) {
        echo "Record deleted.";
        echo '<div style="text-align:right;"><a href="'.'surgery.php'.'">Back</a></div>';
      } else { echo "Error deleting record: " . $mydatabase->error; }
      //MYSQL SECTION

      //DELETE END

    }

    //CODE SECTION ENDS HERE ?>

      <!-- PROFILES END -->

      <!-- MODIFIABLE CODE ENDS HERE -->

      </div>
    </div>
  <!-- CONTENT END -->

	<?php $mydatabase->close(); ?>

	</div>
</div>
<!-- SURGERIES END -->

</body>
</html>