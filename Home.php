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
    <h4>Eye Cataract Program</h4>
  </div>
<!-- TITLE -->

<!-- HOME -->
<div class="container-fluid" id="basic" style="padding-top: 10px; background-color: rgba(74, 106, 21  ,0);">

  <div id="inner">
  <!-- CONTENT -->

		<div class="container-fluid" >
      <div class="row" >

      <!-- LEFT COLUMN -->
      <div class="col-sm-3" style="width: 220px;">
        <div class="container-fluid" style="width: 100%; margin:0px 5px; float:left;">
          <div class="row" id="menu">
          <div class="panel-group" style="margin: 0px;">
              <div class="panel panel-default" style="border:0px; border-radius:5px;">
                <div class="panel-heading" id="tophead1"> <span class="fa fa-pencil" style="font-size:20px;"> </span> FORMS</div>
                <div class="panel-body" style="padding:0px;">

            <!-- ITEM-->
              <?php
                $add = array("Doctor","Patient","Surgery");
                $add_link = array("form_doctors.php","form_patient.php","form_surgery.php");

                for($i=0;$i < count($add);$i++){ 
                  echo '<a id="link" href="'.$add_link[$i].'">';
                ?>
                <div id="boxl" style="width:95%; ">
                <?php echo "<h5>".$add[$i]."</h5>"; ?>
                </div></a>
              <?php } ?>
            <!-- ITEM END -->

              </div>
            </div>
          </div>
          <br>

          <div id="box" style="min-height:0px; width: 100%; margin:0px; background-color:#ffffff;">
            <h4>#ITEM1</h4>
            
          </div>

          <br>

          <div id="box" style="min-height:0px; width: 100%; margin:0px; background-color:#ffffff;">
            <h4>#ITEM2</h4>
            
          </div>

          </div>
        </div>
      </div>
      <!-- LEFT COLUMN END -->

      <!-- RIGHT COLUMN -->
      <div class="container-fluid">
        <div class="col-sm-9" style="min-width: 70%; max-width: 100%; float:left; margin:auto;">	
          

          <!-- CENTER SPACE: WHAT TO DO? -->
          <!-- TO BE CONSTRUCTED -->

          <div id="box" style="min-height:0px; margin:0px; background-color:#ffffff; float:left; width:100%; ">
            <h4>Links to Other Databases</h4>
          <?php 
          $external_databases = array('Database 01', 'Database 02', 'Database 03', 'Database 04', 'Database 05');

          echo '<ul>';
          for ($i=0; $i < sizeof($external_databases); $i++) { 
            echo '<li><a href="#">'.$external_databases[$i].'</a></li>';
          }
          echo '</ul>';
          ?>
          </div>

        <div>
      </div>
      <!-- RIGHT COLUMN END -->

      </div>
    </div>

  <!-- CONTENT END -->

  </div>
</div>
<!-- HOME -->

</div>
<!-- MAIN END -->

</body>
</html>