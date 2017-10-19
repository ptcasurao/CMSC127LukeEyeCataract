<?php
  $placeholder = "Luke foundation (placeholder)";
  $page = array("Doctors", "Patient", "Surgery");
  $link = array("doctors.php", "patient.php", "surgery.php");
  $link1 = array("form_doctors.php", "form_patient.php", "form_surgery.php");
  $doctor = array("Physicians", "Surgeons");
  $i = 0;

echo '<div>
  <nav class="navbar navbar-default">

    <div class="container-fluid">
      <div>
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navi" style="border-color:#337ab7; background-color:#337ab7; color:#ffffff ;">';
            for($i=0; $i<3;$i++){
              echo '<span class="icon-bar"></span>';
            }
          echo '</button>
          <a class="navbar-brand" href="Home.php" id="navlink" style="font-size: 12pt; color:#ffffff;"> <span class="fa fa-home"  style="font-size:20px"></span> Home </a>
        </div>
        <div class="collapse navbar-collapse" id="navi">
          <ul class="nav navbar-nav" >';
            for ($i=0; $i < count($page); $i++) {
              echo '<li><a href="'.$link[$i].'" id="navlink" style="color:#ffffff;">'.$page[$i].'</a></li>';
            }
            echo '<li class="dropdown">
              <a id="navlink" style="color:#ffffff; background-color: transparent ;" href="" class="dropdown-toggle" data-toggle="dropdown">Forms<span class="caret"></span></a>
              <ul class="dropdown-menu">';
                for ($i=0; $i < count($page); $i++) {
                  echo '<li><a href="'.$link1[$i].'" id="navlink" style="color:#337ab7; background-color:transparent;">'.$page[$i].'</a></li>';
                }
              echo'</ul>
            </li>
          </ul>
        </div>

      </div>
    </div>
  </nav>
</div>';
?>