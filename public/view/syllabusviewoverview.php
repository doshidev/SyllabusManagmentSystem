<?php
$content = getById("syllabi_type_overview", "id", $content_id);
$schedule = getVwById("VWSyllabi_sectionschedule", "SectionId", $syllabus["SectionId"]);
$faculty = getVwById("VWSyllabi_section_people", "SectionId", $syllabus["SectionId"]);
?>

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-<?php echo $button_color[$syllabus["academic_session"]];?>">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-12">
            <h1>
              <?php echo $syllabus["event_id"]?>: &nbsp;<?php echo $event["EVENT_LONG_NAME"]?>
            </h1>
          </div>
        </div>
      </div>

      <div class="panel-footer">
        <span class="pull-left">
          <?php echo $department["LONG_DESC"]; ?>
        </span>

        <div class="clearfix"></div>
      </div>

    </div>
  </div>

</div>
<!-- /.row -->
<div class="row">
  <div class="col-lg-8">

    <div class="panel panel-default">
      <div class="panel-heading">
        <b>Course Overview</b>
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <div class="table">
          <table class="table table-bordered table-hover">
            <tbody>
              <tr>
                <td>Course Section:</td>
                <td>
                  <?php echo $syllabus["section"];?>
                </td>
              </tr>
              <tr>
                <td>Class Schedule:</td>
                <td>
                  <?php echo $schedule["DAY"]; ?>
                  <?php if($syllabus["section"]!="OL"){?>
                                    ,&nbsp;
                  <?php echo date_format(date_create($schedule["START_TIME"]), 'g:i A'); ?>&nbsp;-&nbsp;
                  <?php echo date_format(date_create($schedule["END_TIME"]), 'g:i A'); ?>
                  <?php } ?>
                </td>

              </tr>
              <tr>
                <td>Quarter:</td>
                <?php $quarter = "Q" . substr($syllabus["academic_term"],1,1);?>
                <td>
                  <?php echo $quarter . ", " . $syllabus["academic_year"]; ?>
                </td>
              </tr>
              <tr>
                <td class="text-nowrap">Number of Credits:</td>
                <td>
                  <?php echo $event["CREDITS"]; ?> total credits
                </td>
              </tr>
              <tr>
                <td>Prerequisite(s):</td>
                <td>
                  <?php
                  $prereq = getPrereq($syllabus["SectionId"]);
                  if(isset($prereq)){
                    foreach ($prereq as $prereqs){
                      echo $prereqs["PREREQ_EVENT_ID"] . ", ";
                    }
                  }
                  ?>
                  <?php echo $content["prerequisite"]; ?>
                </td>
              </tr>

              <tr>
                <td>Cancellation #:</td>
                <td>
                  <?php echo $content["cancellation_number"]; ?>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.panel-body -->
    </div>
    <!-- /.panel -->


  </div>
  <!-- /.col-lg-8 -->
  <div class="col-lg-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <i class="fa fa-user fa-fw"></i>
        Instructor
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <div class="list-group">
          <a href="#" class="list-group-item">
            <?php if(isset($faculty["PREFIX"])){
                    echo "<span class='lead'>" . $faculty["PREFIX"] . "</span> ";
                  }?>
            <span class="lead">
              <?php echo $faculty["FIRST_NAME"]; ?>
            </span>
            <span class="lead">
              <?php echo $faculty["LAST_NAME"]; ?>
            </span>
          </a>
          <a href="#" class="list-group-item">
            <?php echo $faculty["UserLDAPId"] . "@stratford.edu"; ?>
            <span class="pull-right text-muted small">
              <em>Email</em>
            </span>
          </a>
          <a href="#" class="list-group-item">
            <?php echo $content["office_hours"]; ?>
            <span class="pull-right text-muted small">
              <em>Office Hours</em>
            </span>
          </a>
          <a href="#" class="list-group-item">
            <?php echo $content["office_location"]; ?>
            <span class="pull-right text-muted small">
              <em>Office Location</em>
            </span>
          </a>
          <a href="#" class="list-group-item">
            <?php echo $content["office_phone"]; ?>
            <span class="pull-right text-muted small">
              <em>Office Phone</em>
            </span>
          </a>
          <a href="#" class="list-group-item">
            <?php echo $content["faculty_phone"]; ?>
            <span class="pull-right text-muted small">
              <em>Phone</em>
            </span>
          </a>

        </div>
        <!-- /.list-group -->

      </div>
      <!-- /.panel-body -->
    </div>
    <!-- /.panel -->

  </div>
  <!-- /.col-lg-4 -->
</div>
<!-- /.row -->


