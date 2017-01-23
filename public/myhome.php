<?php $page_name="Dashboard"?>
<?php include("head.php"); ?>

<div id="wrapper">
  <!-- Navigation -->
  <?php require 'nav.php';?>
</div>

<div id="page-wrapper">


  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Dashboard</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-3 col-md-6">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-3">
              <h1><?php echo padString(getCount('syllabi_syllabus', array("type"=>"university")),2)?></h1>
            </div>
            <div class="col-xs-9 text-right">
              <div>University Level<br />Templates</div>
            </div>
          </div>
        </div>
        <a href="templatelibraryuniversity.php">
          <div class="panel-footer">
            <span class="pull-left">View Details</span>
            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="panel panel-green">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-3">
              <h1><?php echo padString(getCount('syllabi_syllabus', array("type"=>"department")),2)?></h1>
            </div>
            <div class="col-xs-9 text-right">
              <div>Department Level<br />Templates</div>
            </div>
          </div>
        </div>
        <a href="templatelibrarydepartment.php">
          <div class="panel-footer">
            <span class="pull-left text-success">View Details</span>
            <span class="pull-right text-success"><i class="fa fa-arrow-circle-right"></i></span>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="panel panel-yellow">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-3">
              <h1><?php echo padString(getCount('syllabi_syllabus', array("type"=>"course")),2)?></h1>
            </div>
            <div class="col-xs-9 text-right">
              <div>Course Level<br />Templates</div>
            </div>
          </div>
        </div>
        <a href="templatelibrarycourse.php">
          <div class="panel-footer">
            <span class="pull-left text-warning">View Details</span>
            <span class="pull-right text-warning"><i class="fa fa-arrow-circle-right"></i></span>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="panel panel-red">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-3">
              <h1><?php echo padString(getCount('syllabi_syllabus', array("type"=>"section")),2)?></h1>
            </div>
            <div class="col-xs-9 text-right">
              <div>Section Level<br />Templates</div>
            </div>
          </div>
        </div>
        <a href="syllabusmanage.php">
          <div class="panel-footer">
            <span class="pull-left text-danger">View Details</span>
            <span class="pull-right text-danger"><i class="fa fa-arrow-circle-right"></i></span>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
    </div>
  </div>
  <!-- /.row -->

  <div class="row">
    <div class="col-lg-12">
      <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="sectionTable1">
          <thead>
            <tr>
              <th class="dt-center">Year</th>
              <th class="dt-center">Term</th>
              <th class="dt-center">Session</th>
              <th class="dt-center">Event</th>
              <th class="dt-center">Course Title</th>
              <th class="dt-center">Section</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sects = getAll("syllabi_syllabus", array("type" => "section"), "academic_year, academic_term", "desc");
            foreach($sects as $sections) {
              
            ?>
            <tr>
              <td class="text-center">
                <?php echo $sections["academic_year"];?>
              </td>
              <td class="text-center">
                <?php echo $sections["academic_term"];?>
              </td>
              <td class="text-center">
                <?php echo $sections["academic_session"];?>
              </td>
              <td class="text-center">
                <?php echo $sections["event_id"];?>
              </td>
              <td>
                <?php echo $sections["templatename"];?>
              </td>
              <td class="text-center">
                <?php echo $sections["section"];?>
              </td>
              <td class="text-center">
                <div class="btn-group pull-right">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-gear"></i>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="syllabusadd.php?id=<?php echo $sections["id"];?>">
                        <i class="fa fa-list-alt"></i>
                        Manage Headers
                      </a>
                    </li>
                    <li>
                      <a href="syllabusview.php?id=<?php echo $sections["id"];?>">
                        <i class="fa fa-list-alt"></i>
                        Manage Content
                      </a>
                    </li>                    
                  </ul>
                  
                </div>
              </td>
            </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
      <!-- /.table-responsive -->
    </div>
  </div>

      <!-- <div class="row">
            <div class="row">&nbsp;</div>
          <div class="jumbotron">
                  <div class ="container">
                      <h1>Hello, <?php echo $_SESSION["syllabi_fname"]; ?>!</h1>
                      <p>Welcome to Syllabi - The collaborative platform of Stratford University for managing course syllabus. Click on the button below to learn more about how the system works.  </p>
                      <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
                    </div>
                </div>
      </div> -->

    </div><!-- /#page-wrapper -->
    <?php include("footer.php"); ?>


<script>
  $(document).ready( function () {
    $("#sectionTable1").DataTable();
  } );
</script>
