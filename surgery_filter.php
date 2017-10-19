<?php

$leftmargin1 = 200;

// BUTTION
echo '<div class="row">';

//REVERT
$where = "'surgery.php'";
echo '<div style="float: right; margin: 0px 30px 10px 0px;"><button type="button" class="btn" id="go" onclick="location.href='.$where.'" >Revert</button></div>'; //REVERT END

// FILTER
echo '<div style="float: right; margin: 0px 10px 10px 0px;"><button type="button" class="btn" data-toggle="collapse" data-target="#upper" id="go" >New Filter</button></div>'; //FILTER END

// SEARCH
echo '<div style="float: right; margin: 0px 10px 10px 0px;"><button type="button" class="btn" data-toggle="collapse" data-target="#upper1" id="go" >Search</button></div>'; //SEARCH END

echo '</div>';
// BUTTON END

/* * * * * * * * * * *
	SEARCH SECTON
 * * * * * * * * * * */

// SEARCH
echo '<div class="container-fluid" style="margin-bottom: 0px;" id="search_record">';

echo '<div class="panel panel-default collapse" style="padding: 0px;" id="upper1">
<div class="panel-body" style="padding:10px;">';

echo '<form class="navbar-form navbar-center" role="search" style="text-align:center;">
    <div class="container-fluid" style="width:350px;">
      <div class="form-group" style="float:left;">
        <input type="text" class="form-control" style="width:200px;" placeholder="Type in a keyword..." maxlength="36" name="search_record">
      </div>
      <button type="submit" class="btn btn-default" id="go" style="float:left;">
        <span class="fa fa-search" style="font-size:15px;"></span> Search
      </button>
    </div>
</form>';
  
echo '</div>
</div>';

echo '</div>';
// SEARCH END


/* * * * * * * * * * *
	FILTER SECTON
 * * * * * * * * * * */

// FILTER 
echo '<div class="container-fluid" style="margin-bottom: 0px;" id="filter">
<form method="post" action="surgery.php">';

echo '<div class="panel panel-default collapse" style="padding: 0px;" id="upper">
<div class="panel-body" style="padding:10px;">';

  // TIME FILTER
  echo'<div class="form-group row" style="margin: 5px; margin-bottom:10px;">
      <label style="width: '.$leftmargin1.'px; float:left;">Surgery Date</label>
      <div>
        <label class="sr-only" for="FSS">Sequence</label>
        <select class="form-control"  name="FSS" style="width: 90px; float: left; margin-right:20px;">
        <option value="<" > before </option>
        <option value="=" selected> on </option>
        <option value=">" > after </option>
        </select>
      </div>
      <div>
        <label class="sr-only" for="FMM">Month</label>
        <select class="form-control"  name="FMM" style="width: 120px; float: left; margin-right:10px;">';
        echo '<option value=""> -Month- </option>';
          for ($j=0; $j < count($MONTH_choice); $j++) {
            echo '<option value="'.($j+1).'">'.$MONTH_choice[$j].'</option>';
          }
        echo '</select>
      </div>
      <div style="width: 45px; float: left; margin-right:10px;">
        <label class="sr-only" for="FDD">Day</label>
        <input pattern="\d||[0-2]\d|3[0-1]|" title="" class="form-control" placeholder="DD" maxlength="'.$SURG_DATE_DD.'" name="FDD">
      </div>
      <div style="width: 65px; float: left; margin-right:10px;">
        <label class="sr-only" for="FYY">Year</label>
        <input pattern="[1-2]\d\d\d" title="" class="form-control" placeholder="YYYY" maxlength="'.$SURG_DATE_YY.'" name="FYY">
      </div>
    </div>';
  // TIME FILTER END

  // SURGEON LICENSE FILTER
  echo'<div class="form-group row" style="margin: 5px; margin-bottom:10px;">
      <label for="FSL" style="float:left; width:'.$leftmargin1.'px;">Surgeon </label>
      <div>
        <input class="form-control" id="SFN" placeholder="Surgeon" name="SURG_FULLNAME" style="width: 200px; float: left; margin-right: 10px;" '.$value_name.' readonly>
        <input class="form-control" id="SURG_NUM" placeholder="License" name="FSL" style="width: 120px; float: left; margin-right: 10px;" '.$value_id.' readonly>
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#picksurgeon" style="float: left; margin-right: 10px;">Find Surgeon</button>
      </div>
    </div>';

  // SURGEON POP-UP FINDER

  echo '<div class="modal fade" id="picksurgeon" role="dialog">
      <div class="modal-dialog">
        
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">List of Doctors</h4>
          </div>
          <div class="modal-body">';
            
            //MYSQL SECTION  
            $popquery1 = $mydatabase->query("SELECT DOC_LICENSE_NUM, LAST_NAME, FIRST_NAME FROM DOCTOR");
            //MYSQL SECTION END

            $cnt = 100;

            //DOCTOR LIST
            if ($popquery1->num_rows > 0) {
              echo '<div class = "container-fluid">';
              while($datalinepop = $popquery1->fetch_assoc()) { 
                $s_fullname = $datalinepop["FIRST_NAME"].' '.$datalinepop["LAST_NAME"];
                $s_license = $datalinepop["DOC_LICENSE_NUM"];
                echo '<button type="button" class="list-group-item row" name="surg_filter" style="margin:0px; padding:5px;" onclick="pick_doc('.$cnt.')">';
                echo '<div class="col-md-2" style="width:220px; float:left;" id="pop_fullname'.$cnt.'">'.$s_fullname.'</div>';
                echo '<div class="col-md-1" style="width:120px; float:left;"><b>License No. </b></div>';
                echo '<div class="col-md-1" style="width:100px; float:left;" id="pop_license'.$cnt.'">'.$s_license.'</div>';
                echo '</button>';
                $cnt++;
              }
              echo '</div>';
            } else { echo "No Records."; }
            //DOCTOR LIST END

         echo '</div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      
      </div>
    </div>';
  // SURGEON POP-UP FINDER END

    $v = 5;
  //SCRIPT
  echo '<script>
    function pick_doc(x){
      var v0 = x;
      var v1 = "pop_fullname";
      var v2 = "pop_license";
      var v3 = v1.concat(v0);
      var v4 = v2.concat(v0);
      var name = document.getElementById(v3).innerHTML;
      var id = document.getElementById(v4).innerHTML;
      document.getElementById("SURG_NUM").value = id;
      document.getElementById("SFN").value = name;
      $("#picksurgeon").modal("hide");
    }
  </script>';
  //SCRIPT END
  
  // SURGEON LICENSE FILTER END

echo '</div>

<div class="panel-footer text-center" style="padding:0px;"><button class="btn" id="go" style="width:100%; height: 100%; padding: 10px; border-color:#f2f2f2;" name="filter_check" type="submit"> Filter Records </button></div>
</div>';

echo '</form>
</div>';
// FILTER END

?>