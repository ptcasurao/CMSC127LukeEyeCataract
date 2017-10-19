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

<!-- PATIENTS -->
<div class="container-fluid" id="basic" >
  <div id="inner">

  <!-- TITLE -->
    <div class="container-fluid" >
        <h4 style="color:#337ab7;">Eye Cataract Patients</h4>
    </div>
  <!-- TITLE -->

<?php //CODE SECTION STARTS HERE

//ESTABLISHING MYSQL LINK (1)
include("dbconnect.php");
//ESTABLISHING MYSQL LINK END (1)

//MAX VALUES
$ID_LENG = 15;
$FN_LENG = 20;
$LN_LENG = 20;
$PHYL_LENG = 7;
$STAFFL_LENG = 7;
$VD_MAX = 15;
$DC_MAX = 30;
$REA_MAX = 12;
$LEA_MAX = 12;
$VA_choice = array(10, 12.5, 16, 20, 25, 32, 40, 50, 63, 80, 100, 125, 160, 200);
//MAX VALUES END

//CODE SECTION ENDS HERE
?>

<!-- CONTENT -->
    <div class="container-fluid" >
      <div>

      <!-- MODIFIABLE CODE STARTS HERE -->

      <!-- PROFILES -->
        <div class="container-fluid">
          <ul class="list-group">

      <?php //CODE SECTION STARTS HERE

      $DEFAULT = 0;
      if (isset($_GET["currentpage"])) { $current_p  = $_GET["currentpage"]; } else { $current_p=1; };
      if (isset($_GET["profilepage"])) { $profile_p = $_GET["profilepage"]; $DEFAULT=1;

        //RECEIVE UPDATE
        if(isset($_POST['patients_update'])){
          $P_ID = $_POST["PAT_ID"];
          $P_PPFN = $_POST["PAT_PPFN"];
          $P_PPLN = $_POST["PAT_PPLN"];
          $P_PLN = $_POST["_LIC"];
          $P_LN = $_POST["PHYS_LIC"];
          $P_SLN = $_POST["STAFF_LIC"];
          $P_VASR = '20/'.$_POST["VASR"];     
          $P_VASL = '20/'.$_POST["VASL"];     
          $P_VAR = '20/'.$_POST["VAR"];
          $P_VAL = '20/'.$_POST["VAL"];
          $P_VD = $_POST["VD"];
          $P_DC = $_POST["DC"];
          $P_REA = $_POST["REA"];
          $P_LEA = $_POST["LEA"];
          $toupdate = $_POST["patients_update"];

          $P_update = "UPDATE EYEPATIENT SET PAT_ID_NUM = '$P_ID', PAT_FNAME = '$P_PPFN', PAT_LNAME = '$P_PPLN', PHY_LICENSE_NUM = '$P_LN', STAFF_LICENSE_NUM = '$P_SLN', VA_WITH_SPECT_LEFT = '$P_VASL', VA_WITH_SPECT_RIGHT = '$P_VASR', VA_NO_SPECT_LEFT = '$P_VAL', VA_NO_SPECT_RIGHT = '$P_VAR', VISUAL_DISABILITY ='$P_VD', DISABILITY_CAUSE ='$P_DC', RIGHT_EYE_AFFECTED ='$P_REA', LEFT_EYE_AFFECTED ='$P_LEA' WHERE PAT_ID_NUM = '$toupdate' ";
      
          if ($mydatabase->query($P_update) === TRUE) {
            //echo "Record updated successfully";
          } else {
            // echo '<script> window.location = "patient.php?profilepage='.$_POST['patients_update'].'"; </script>';
            echo '
            <div class="alert alert-danger alert-dismissable">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
              <strong>Error updating record: </strong>'.$mydatabase->error.'</div>';
          }
        }//RECIEVE UPDATE END

      } else {};
      if (isset($_GET["delete"])) { $delete_p =$_GET["delete"]; $DEFAULT=2; } else {};

      $limit = 20;
      $begin = ($current_p-1)*$limit;

      //FILTER ADD
      if(isset($_POST["filter_check"])){
        //var_dump($_POST);

        $F_LN = $F_ID = "";
        $D = 0;

        if(isset($_POST["FPL"])) {
          if(strlen($_POST["FPL"])>0){
            $F_LN = ' AND p.PHY_LICENSE_NUM='.trim($_POST["FPL"]);
          }
        }
        if(isset($_POST["FID"])) {
          if(strlen($_POST["FID"])>0){
            $F_ID = ' AND p.PAT_ID_NUM2='.trim($_POST["FID"]);
          }
        }

        $filter =  $F_LN.$F_ID;

      } else {
        $filter = "";
      }
      //FILTER ADD END

      //SEARCH
      if(isset($_GET["search_record"])){
        $search = "";
        $key = trim($_GET["search_record"]);
        if(strlen($key)>0){
          $search = '';
        }
      }else{
        $search = "";
      }
      //SEARCH END

      //MYSQL SECTION
      $P_query = "SELECT * FROM EYEPATIENT p, DOCTOR d where p.PHY_LICENSE_NUM = d.DOC_LICENSE_NUM $filter $search order by p.PAT_LNAME asc limit $begin, ".$limit;
      $output = $mydatabase->query($P_query);
      //MYSQL SECTION END

      if($DEFAULT==0){

        //FILTER
        include("patient_filter.php");
        //FILTER END

        if ($output->num_rows>0) {

      //MAIN PAGE

          //HEADER
          echo '<li class="list-group-item" id="tophead">';
          echo '<div class="container-fluid row">';
          echo '<div class="col-md-2" style="width:175px; float:left;"><b>'.'Last Name'.'</b></div>';
          echo '<div class="col-md-2" style="width:175px; float:left;"><b>'.'First Name'.'</b></div>';
          echo '<div class="col-md-3" style="width:200px; float:left;"><b>'.'Patient ID'.'</b></div>';
          echo '<div class="col-md-2" style="width:175px; float:left;"><b>'.'Screened by'.'</b></div>';
          echo '</div>';
          echo '</li>';
          //HEADER END

          //CONTENT
          while($dataline = $output->fetch_assoc()) { 

            echo '<li class="list-group-item">';
            echo '<div class="row">';

                echo '<div class="col-md-2" style="width:175px; float:left;">'.$dataline["PAT_LNAME"].'</div>';
                echo '<div class="col-md-2" style="width:175px; float:left;">'.$dataline["PAT_FNAME"].'</div>';
                echo '<div class="col-md-3" style="width:200px; float:left;">'.$dataline["PAT_ID_NUM"].'</div>';
                echo '<div class="col-md-2" style="width:175px; float:left;">'.$dataline["FIRST_NAME"].' '.$dataline["LAST_NAME"].'</div>';
                echo '<div class="col-md-2" style=" float:right;">'.'<a href="'.'patient.php'.'?profilepage='.$dataline["PAT_ID_NUM"].'">'.'see full details'.'</a>'.'</div>';
              
            echo '<div>';
            echo '</li>';
            
          }//CONTENT END
      

      //PAGER
      echo '<div style="text-align:center;">';
      echo '<ul class="pagination" style="margin:auto;"><br>';
          
      $check = "SELECT PAT_ID_NUM FROM EYEPATIENT";
      $check2 = $mydatabase->query($check);
      $item_no = $check2->num_rows;
      $page_no = ceil($item_no/$limit);
          
      if($page_no>1){
        for ($p_no=0; $p_no < $page_no; $p_no++) { 
          echo '<li><a style="color:#337ab7;" href="'.'patient.php'.'?currentpage='.($p_no+1).'">'.($p_no+1).'</a> </li>';
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
      $output1 = $mydatabase->prepare("SELECT p.*, d.LAST_NAME, d.FIRST_NAME FROM EYEPATIENT p, DOCTOR d where p.PHY_LICENSE_NUM = d.DOC_LICENSE_NUM and PAT_ID_NUM = '$profile_p' ");      
      $output1->execute();
      $line = $output1->get_result();
      $dataline = $line->fetch_assoc();
      //MYSQL SECTION END

      $VA_LABEL = array("Left Eye with Spectacles", "Right Eye with Spectacles", "Left Eye without Spectacles", "Right Eye without Spectacles");
      $P_VA = array($dataline["VA_WITH_SPECT_LEFT"], $dataline["VA_WITH_SPECT_RIGHT"], $dataline["VA_NO_SPECT_LEFT"], $dataline["VA_NO_SPECT_RIGHT"]);
      $P_VA1 = array( str_replace("20/","",$P_VA[0]),str_replace("20/","",$P_VA[1]),str_replace("20/","",$P_VA[2]),str_replace("20/","",$P_VA[3]));

      //VALUES
      $P_ID = $dataline["PAT_ID_NUM"];
      $P_PPFN = $dataline["PAT_FNAME"];
      $P_PPLN = $dataline["PAT_LNAME"];
      $P_LN = $dataline["PHY_LICENSE_NUM"];
      $P_SLN = $dataline["STAFF_LICENSE_NUM"];
      $P_VD = $dataline["VISUAL_DISABILITY"];
      $P_DC = $dataline["DISABILITY_CAUSE"];
      $P_REA = $dataline["RIGHT_EYE_AFFECTED"];
      $P_LEA = $dataline["LEFT_EYE_AFFECTED"];
      //VALUES END

      //CONTENT
      echo '<div>
        <div class="container-fluid">
          <h3>Patient ID No. '.$P_ID.'</h3>
          <div class="panel panel-default"  style="padding-bottom:10px;">
            <div class="panel-heading" id="tophead1">Patient Record</div>
            <div class="panel-body row" style="margin:0px; padding:5px 10px;">
              <div class="col-md-3" >'.'Patient '.'</div>
              <div class="col-md-9">'.$dataline["PAT_FNAME"].' '.$dataline["PAT_LNAME"].'</div>
            </div>
            <div class="panel-body row" style="margin:0px; padding:5px 10px;">
              <div class="col-md-3" >'.'Examined by: '.'</div>
              <div class="col-md-9">'.$dataline["FIRST_NAME"].' '.$dataline["LAST_NAME"].'</div>
            </div>
            <div class="panel-body row" style="margin:0px; padding:5px 10px;">
              <div class="col-md-3" >'.'Screened by: '.'</div>
              <div class="col-md-9">'.$P_SLN.'</div>
            </div>
          </div>
          <div class="panel panel-default" style="padding-bottom:0px;">
            <div class="panel-heading" style="border: 0px; font-weight:bold;">Visual Acuity</div>
             
            <div style="margin: 0px 50px;">
            <table class="table table-condensed">
              <thead> <tr>
                <th>Condition</th>
                <th>Scale</th>
              </tr> </thead>
            <tbody>';
            for ($t=0; $t < sizeof($P_VA); $t++) {
              echo '<tr>
                <td>'.$VA_LABEL[$t].'</td>
                <td>'.$P_VA[$t].'</td>
              </tr>'; }
            echo '</tbody></table>';
        echo '</div>';
      echo '</div>';

      if((sizeof($dataline["VISUAL_DISABILITY"])>0)){
        echo '<div class="panel panel-default" style="padding-bottom:10px;">
          <div class="panel-heading" style="border: 0px; font-weight:bold;">Visual Problem</div>
          <div class="panel-body row" style="margin:0px; padding:5px 10px;">
            <div class="col-md-3" >'.'Visual Disability'.'</div>
            <div class="col-md-9">'.$P_VD.'</div>
          </div>
          <div class="panel-body row" style="margin:0px; padding:5px 10px;">
            <div class="col-md-3" >'.'Cause'.'</div>
            <div class="col-md-9">'.$P_DC.'</div>
          </div>
        </div>
        <div class="panel panel-default" style="padding-bottom:x;">
          <div class="panel-heading" style="border: 0px; font-weight:bold;">Affected Area of Eye</div>
          <div class="panel-body" style="margin:0px 50px; padding:0px;">
            <table class="table table-condensed">
              <thead>
                <tr> <th>Eye</th> <th>Affected Part</th> </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Left</td>
                  <td>'.$P_LEA.'</td>
                </tr>
                <tr>
                  <td>Right</td>
                  <td>'.$P_REA.'</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>';
        }
      echo'</div> </div>';
      //CONTENT END

      //BUTTONS AND LINKS
      echo '<a role="button" class="btn btn-default"'.'href="'.'doctors.php'.'?delete='.$profile_p.'" style="margin-left:15px;"> <span class="fa fa-trash" style="font-size:15px;"></span> Delete </a>';
      echo '<button type="button" class="btn btn-default" data-toggle="modal" data-target="#EditBox" style="margin-left:10px;"><span class="fa fa-edit" style="font-size:15px;"></span> Edit</button>';
      echo '<div style="text-align:right;"><button class="btn" id="go" style="margin-right:15px;" onclick="history.back();">Back</button></div>';
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

          $leftmargin = 260;

        //EDIT FORM
        echo '<div class="container-fluid">
          <form method="post" id="updating" action="#">
          <div class="container-fluid" style="margin-bottom: 10px;">
            <label for="PAT_ID" style="width: '.$leftmargin.'px; float: left; ">Patient ID No. </label>
            <input type="text" class="form-control" id="PAT_ID" maxlength="'.$ID_LENG.'" name="PAT_ID" value="'.$P_ID.'" style="width: 150px; float: left;" required >
          </div>
          <div class="container-fluid" style="margin-bottom: 10px;">
            <label for="PAT_PPFN" style="width: '.$leftmargin.'px; float: left; "> First Name </label>
            <input type="text" class="form-control" id="PAT_PPFN" maxlength="'.$FN_LENG.'" name="PAT_PPFN" value="'.$P_PPFN.'" style="width: 150px; float: left;" required>
          </div>
          <div class="container-fluid" style="margin-bottom: 10px;">
            <label for="PAT_PPLN" style="width: '.$leftmargin.'px; float: left; "> Last Name </label>
            <input type="text" class="form-control" id="PAT_PPLN" maxlength="'.$LN_LENG.'" name="PAT_PPLN" value="'.$P_PPLN.'" style="width: 150px; float: left;" required>
          </div>
          <div class="container-fluid" style="margin-bottom: 10px;">
            <label for="PHYS_LIC" style="float:left; width:'.$leftmargin.'px;">Physician License No. </label>
            <input pattern="\d{7}" title="License Number ranges from 0000000-9999999." type="text" class="form-control id="PHYS_LIC" maxlength="'.$PHYL_LENG.'" name="PHYS_LIC" value="'.$P_LN.'" style="width: 90px; float: left;" required>
          </div>
          <div class="container-fluid" style="margin-bottom: 10px;">
            <label for="STAFF_LIC" style="float:left; width:'.$leftmargin.'px;">Staff License No. </label>
            <input pattern="\d{7}" title="License Number ranges from 0000000-9999999." type="text" class="form-control id="PHYS_LIC" maxlength="'.$STAFFL_LENG.'" name="STAFF_LIC" value="'.$P_SLN.'" style="width: 90px; float: left;" required>
          </div>
          <div class="container-fluid" style="margin-bottom: 0px;">
          <div class="form-group row">
            <label class="col-md-4" for="VASL" style="float:left; width:'.$leftmargin.'px;">Left Eye with Spectacles</label>
            <div class="col-md-3" style="float: left;">
              <div class="input-group">
                <span class="input-group-addon">20</span>
                <span class="input-group-addon">/</span>
                <select class="form-control" id="VASL"  name="VASL" style="width: 80px; "value="'.$P_VA1[0].'" required>';
                  for ($j=0; $j < count($VA_choice); $j++) { 
                    if($P_VA1[0]==$VA_choice[$j]){
                      echo '<option selected>'.$VA_choice[$j].'</option>';
                    }else{
                      echo '<option>'.$VA_choice[$j].'</option>';
                    }
                  }
                echo '</select>
              </div>
            </div>
          </div>
          </div>
          <div class="container-fluid" style="margin-bottom: 0px;">
          <div class="form-group row">
            <label class="col-md-4" for="VASR" style="float:left; width:'.$leftmargin.'px;">Right Eye with Spectacles</label>
            <div class="col-md-3" style="float: left;">
              <div class="input-group">
                <span class="input-group-addon">20</span>
                <span class="input-group-addon">/</span>
                <select class="form-control" id="VASR"  name="VASR" style="width: 80px;" value="'.$P_VA1[1].'" required>';
                  for ($j=0; $j < count($VA_choice); $j++) { 
                    if($P_VA1[1]==$VA_choice[$j]){
                      echo '<option selected>'.$VA_choice[$j].'</option>';
                    }else{
                      echo '<option>'.$VA_choice[$j].'</option>';
                    }
                  }
                echo '</select>
              </div>
            </div>
          </div>
          </div>
          <div class="container-fluid" style="margin-bottom: 0px;">
          <div class="form-group row" style="padding:0px;">
            <label class="col-md-4" for="VAL" style="float:left; width:'.$leftmargin.'px;">Left Eye without Spectacles</label>
            <div class="col-md-3" style="float: left;">
              <div class="input-group">
                <span class="input-group-addon">20</span>
                <span class="input-group-addon">/</span>
                <select class="form-control" id="VAL"  name="VAL" style="width: 80px;" value="'.$P_VA1[2].'" required>';
                  for ($j=0; $j < count($VA_choice); $j++) { 
                    if($P_VA1[2]==$VA_choice[$j]){
                      echo '<option selected>'.$VA_choice[$j].'</option>';
                    }else{
                      echo '<option>'.$VA_choice[$j].'</option>';
                    }
                  }
                echo '</select>
              </div>
            </div>
          </div>
          </div>
          <div class="container-fluid" style="margin-bottom: 0px;">
          <div class="form-group row">
            <label class="col-md-4" for="VAR" style="float:left; width:'.$leftmargin.'px;">Right Eye without Spectacles</label>
            <div class="col-md-3" style="float: left;">
              <div class="input-group">
                <span class="input-group-addon">20</span>
                <span class="input-group-addon">/</span>
                <select class="form-control" id="VAR"  name="VAR" style="width: 80px;" value="'.$P_VA1[3].'" required>';
                  for ($j=0; $j < count($VA_choice); $j++) { 
                    if($P_VA1[3]==$VA_choice[$j]){
                      echo '<option selected>'.$VA_choice[$j].'</option>';
                    }else{
                      echo '<option>'.$VA_choice[$j].'</option>';
                    }
                  }
                echo '</select>
              </div>
            </div>
          </div>
          </div>
          <div class="container-fluid" style="margin-bottom: 10px;">
            <label for="VD" style="width: '.$leftmargin.'px; float: left; ">Visual Disability </label>
            <input type="text" class="form-control" id="VD" maxlength="'.$VD_MAX.'" name="VD" value="'.$P_VD.'" style="width: 150px; float: left;" >
          </div>
          <div class="container-fluid" style="margin-bottom: 10px;">
            <label for="DC" style="width: '.$leftmargin.'px; float: left; ">Cause of Visual Disability</label>
            <input type="text" class="form-control" id="DC" maxlength="'.$DC_MAX.'" name="DC" value="'.$P_DC.'" style="width: 280px; float: left;" >
          </div>
          <div class="container-fluid" style="margin-bottom: 10px;">
            <label for="LEA" style="width: '.$leftmargin.'px; float: left; ">Affected part of Left Eye</label>
            <input type="text" class="form-control" id="DC" maxlength="'.$LEA_MAX.'" name="LEA" value="'.$P_LEA.'" style="width: 130px; float: left;" >
          </div>
          <div class="container-fluid" style="margin-bottom: 10px;">
            <label for="LEA" style="width: '.$leftmargin.'px; float: left; ">Affected part of Right Eye</label>
            <input type="text" class="form-control" id="DC" maxlength="'.$REA_MAX.'" name="REA" value="'.$P_REA.'" style="width: 130px; float: left;" >
          </div>
          <div class="text-center" style="margin-top: 20px;">
            <button type="submit" onclick="update()" class="btn btn-default" value="'.$P_ID.'" name="patients_update">Update</button>
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
            var id = document.getElementById("PAT_ID").value;
            document.getElementById("updating").action = "patient.php?profilepage="+id;
          }
        </script>';
      
      echo '</div>
        </div>';
      //POP-UP ALERT END

      //FULL DETAILS PAGE END

    }else if($DEFAULT==2){

      //DELETE PAGE

      //MYSQL SECTION
      $del = "DELETE FROM EYEPATIENT WHERE PAT_ID_NUM = '$delete_p' ";
      if ($mydatabase->query($del) === TRUE) {
        echo "Record deleted.";
        echo '<div style="text-align:right;"><a href="'.'patient.php'.'">Back</a></div>';
      } else { echo "Error deleting record: " . $mydatabase->error; }
      //MYSQL SECTION END

      //DELETE PAGE END

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
<!-- PATIENTS END -->

</body>
</html>
