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

<!-- HEAD AND NAVIGATION END -->
<?php include("header.php"); ?>

<!--
DOCTOR BASIC INFORMATION:
  - FIRST NAME
  - LAST NAME
  - LICENSE NUMBER
  - ADRESS

DOCTOR SECONDARY INFORMATION
  - ...
-->

<?php //CODE SECTION STARTS HERE

//ESTABLISHING MYSQL LINK (1)
include("dbconnect.php");
//ESTABLISHING MYSQL LINK END (1)

//MAX VALUES
$FN_MAX = 15;
$LN_MAX = 20;
$LIC_LENG = 7;
$ADDR_MAX = 50;
//MAX VALUES END

//CODE SECTION ENDS HERE
?>

<!-- DOCTORS -->
<div class="container-fluid" id="basic" >
  <div id="inner" >

  <!-- TITLE -->
    <div class="container-fluid" >
        <h4 style="color:#337ab7;">Doctors</h4>
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
      if (isset($_GET["currentpage"])) { $current_p  = $_GET["currentpage"]; } else { $current_p=1; };
      if (isset($_GET["profilepage"])) { $profile_p = $_GET["profilepage"]; $DEFAULT=1;

        //RECEIVE UPDATE
        if(isset($_POST['doctors_update'])){
          $D_DLN = $_POST['LICENSE_NUM'];
          $D_LN = $_POST['L_NAME'];
          $D_FN = $_POST['F_NAME'];
          $D_A = $_POST['ADDRESS'];
          $toupdate = $_POST['doctors_update'];

          $D_update = "UPDATE DOCTOR SET DOC_LICENSE_NUM = '$D_DLN', LAST_NAME = '$D_LN', FIRST_NAME = '$D_FN', ADDRESS ='$D_A' WHERE DOC_LICENSE_NUM = '$toupdate' ";
      
          if ($mydatabase->query($D_update) === TRUE) {
            //echo "Record updated successfully";
          } else {
            // echo '<script> window.location = "doctors.php?profilepage='.$_POST['doctors_update'].'"; </script>';
            echo '
            <div class="alert alert-danger alert-dismissable">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
              <strong>Error!</strong> Cannot update record. License Number '.$D_DLN.' already exists.
            </div>';
            //echo "Error updating record: " . $mydatabase->error;
          }
        }//RECIEVE UPDATE END

      } else {};
      if (isset($_GET["delete"])) { $delete_p =$_GET["delete"]; $DEFAULT=2; } else {};

      //MYSQL SECTION
      $limit = 20;
      $begin = ($current_p-1)*$limit;
      $D_query = "SELECT * FROM DOCTOR order by LAST_NAME asc limit $begin, ".$limit;
      $output = $mydatabase->query($D_query);
      //MYSQL SECTION END

      if($DEFAULT==0){
        if ($output->num_rows > 0) {

          //MAIN PAGE

          //HEADER
          echo '<li class="list-group-item" id="tophead">';
          echo '<div class="container-fluid row">';
          echo '<div class="col-md-1" style="width:120px; float:left;"><b>'.'Last Name'.'</b></div>';
          echo '<div class="col-md-1" style="width:120px; float:left;"><b>'.'First Name'.'</b></div>';
          echo '<div class="col-md-1" style="width:120px; float:left;"><b>'.'License No.'.'</b></div>';
          echo '<div class="col-md-5" style="float:left;"><b>'.'Address'.'</b></div>';
          echo '</div>';
          echo '</li>';
          //HEADER END

          //CONTENT
          while($dataline = $output->fetch_assoc()) { 
            echo '<li class="list-group-item">';
            echo '<div class="row">';
                echo '<div class="col-md-1" style="width:120px; float:left;">'.$dataline["LAST_NAME"].'</div>';
                echo '<div class="col-md-1" style="width:120px; float:left;">'.$dataline["FIRST_NAME"].'</div>';
                echo '<div class="col-md-1" style="width:120px; float:left;">'.$dataline["DOC_LICENSE_NUM"].'</div>';
                echo '<div class="col-md-5" style="float:left;">'.$dataline["ADDRESS"].'</div>';
                echo '<div class="col-md-2" style="width:150px; float:right;"><a href="'.'doctors.php'.'?profilepage='.$dataline["DOC_LICENSE_NUM"].'">'.'see more'.'</a></div>';
            echo '<div>';
            echo '</li>';
          } //CONTENT END

      //PAGER
      echo '<div style="text-align:center;">';
      echo '<ul class="pagination" style="margin:auto;"><br>';

        $check = "SELECT DOC_LICENSE_NUM FROM DOCTOR";
        $check2 = $mydatabase->query($check);
        $item_no = $check2->num_rows;
        $page_no = ceil($item_no/$limit);

        if($page_no>1){
          for ($p_no=0; $p_no < $page_no; $p_no++) { 
            echo '<li><a style="color:#337ab7;" href="'.'doctors.php'.'?currentpage='.($p_no+1).'">'.($p_no+1).'</a> </li>';
          }
        } 

      echo '</ul>';
      echo '</div>';
      //PAGER END
      
      } else { echo "No Records."; }

      //MAIN PAGE END

    }else if ($DEFAULT==1) {

      //SEE MORE PAGE

      //MYSQL SECTION
      $output1 = $mydatabase->prepare("SELECT * FROM DOCTOR where DOC_LICENSE_NUM = '$profile_p' ");      
      $output1->execute();
      $line = $output1->get_result();
      $dataline = $line->fetch_assoc();
      //MYSQL SECTION END

      //VALUES
        $D_LN = $dataline["LAST_NAME"];
        $D_FN = $dataline["FIRST_NAME"];
        $D_DLN = $dataline["DOC_LICENSE_NUM"];
        $D_A = $dataline["ADDRESS"];
      //VALUES END

      //CONTENT
      echo '<div>
        <div class="container-fluid">
          <h3>Dr. '.$D_FN.' '.$D_LN.'</h3>
          <div class="panel panel-default" style="padding-bottom:10px;">
            <div class="panel-heading" id="tophead1">Doctor Information</div>
            <div class="panel-body row" style="margin:0px; padding:5px 10px;">
              <div class="col-md-3" >'.'License Number'.'</div>
              <div class="col-md-9">'.$D_DLN.'</div>
            </div>
            <div class="panel-body row" style="margin:0px; padding:5px 10px;">
              <div class="col-md-3" >'.'Address'.'</div>
              <div class="col-md-9">'.$D_A.'</div>
            </div>
          </div>
        </div>
      </div>';
      //CONTENT END

      //BUTTONS AND LINKS
      echo '<a role="button" class="btn btn-default"'.'href="'.'doctors.php'.'?delete='.$profile_p.'" style="margin-left:15px;"> <span class="fa fa-trash" style="font-size:15px;"></span> Delete </a>';
      echo '<button type="button" class="btn btn-default" data-toggle="modal" data-target="#EditBox" style="margin-left:10px;"><span class="fa fa-edit" style="font-size:15px;"></span> Edit</button>';
      echo '<div style="text-align:right;"><button class="btn" id="go" style="margin-right:15px;" onclick="history.back();">Back</button></div>';
      //BUTTONS AND LINKS END

      // POP-UP ALERT
      echo '<div class="modal fade" id="EditBox" role="dialog" style="top:50px;">
        <div class="modal-dialog modal-lg">';
    
        //POP-UP CONTENT
        echo '<div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Record</h4>
          </div>
          <div class="modal-body">';

        //EDIT FORM
        echo '<div class="container-fluid">
          <form method="post" id="updating" action="#" >

          <div class="container-fluid" style="margin-bottom: 10px;">
            <label for="F_NAME" style="width: 175px; float: left; ">First Name </label>
            <input type="text" class="form-control" id="F_NAME" maxlength="'.$FN_MAX.'" name="F_NAME" value="'.$D_FN.'" style="width: 150px; float: left;" required >
          </div>
          <div class="container-fluid" style="margin-bottom: 10px;">
            <label for="L_NAME" style="width: 175px; float: left; ">Last Name </label>
            <input type="text" class="form-control" id="L_NAME" maxlength="'.$LN_MAX.'" name="L_NAME" value="'.$D_LN.'" style="width: 150px; float: left;" required >
          </div>
          <div class="container-fluid" style="margin-bottom: 10px;">
            <label for="LICENSE_NUM" style="width: 175px; float: left; ">License No. </label>
            <input pattern="\d{7}" title="License Number ranges from 0000000-9999999." type="text" class="form-control" id="LICENSE_NUM" maxlength="'.$LIC_LENG.'" name="LICENSE_NUM" value="'.$D_DLN.'" style="width: 90px; float: left;" required >
          </div>
          <div class="container-fluid" style="margin-bottom: 10px;">
            <label for="ADDRESS" style="width: 175px; float: left; ">Address </label>
            <input type="text" class="form-control" id="ADDRESS" maxlength="'.$ADDR_MAX.'" name="ADDRESS" value="'.$D_A.'" style="max-width: 450px; float: left;">
          </div>
          <div class="text-center" style="margin-top: 20px;">
            <button type="submit" onclick="update()" class="btn btn-default" value="'.$D_DLN.'" name="doctors_update">Update</button>
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
            var license = document.getElementById("LICENSE_NUM").value;
            document.getElementById("updating").action = "doctors.php?profilepage="+license;
          }
        </script>';
      
      echo '</div>
        </div>';
      //POP-UP ALERT END

    //SEE MORE PAGE END

    }else if($DEFAULT==2){

      //DELETE PAGE
      $del = "DELETE FROM DOCTOR WHERE DOC_LICENSE_NUM = '$delete_p' ";

      if ($mydatabase->query($del) === TRUE) {
        echo "Record deleted.";
        echo '<div style="text-align:right;"><a href="'.'doctors.php'.'">Back</a></div>';
      } else {
        echo "Error deleting record: " . $mydatabase->error;
      } //DELETE PAGE END

    }

    //CODE SECTION ENDS HERE ?>

          </ul>
        </div>
      <!-- PROFILES END -->

      <!-- MODIFIABLE CODE ENDS HERE -->

      </div>
    </div>
  <!-- CONTENT END -->

  </div>
</div>
<!-- DOCTORS -->

<?php $mydatabase->close(); ?>

</div>
<!-- MAIN END -->

</body>
</html>