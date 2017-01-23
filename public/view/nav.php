<!-- Navigation -->

<?php $syllabus = getById("syllabi_syllabus", "id", $syllabus_id);?>
<?php $event = getVwById("VWSyllabi_event", "EVENT_ID", $syllabus["event_id"]);?>
<?php $department = getVwById("VWSyllabi_CODE_DEPARTMENT", "CODE_VALUE", $event["DEPARTMENT"]);?>
<?php $school = getVwById("VWSyllabi_organization", "ORG_CODE_ID", $syllabus["org_code_id"]);?>

<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand"><img src="../img/productlogosm.png" alt=""></a>
    </div>
    <ul class="nav navbar-top-links navbar-right">
      <li class="dropdown">
        <a class="text-danger" href="wkpdf.php?id=<?php echo $_GET["id"]?>&eventid=<?php echo $syllabus["event_id"]?>">
          Download PDF <i class="fa fa-file-pdf-o"></i> 
        </a>
        
        <!-- /.dropdown-user -->
      </li>
    </ul>

    <div class="navbar-default sidebar" role="navigation">
      <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
          <li class="sidebar-search">
            <div>
              <h3><?php echo $event["EVENT_ID"]; ?></h3>
              <h5><?php echo $event["EVENT_LONG_NAME"]; ?></h5>

              </span>
            </div>
            <!-- /input-group -->
          </li>
          <?php
                    $query_array = array(
                      "syllabus_id" => "{$query_params["id"]}",
                      "id" => "_group_id",
                      );
          ?>
          <?php $heads = getAll("syllabi_syllabus_header", $query_array, "display_index", "asc");?>

          <?php foreach ($heads as $header_group){ ?>
          <?php $has_child = getMaxHeaderChild($header_group["syllabus_id"], $header_group["id"]);?>
          <?php if($has_child == 0) { ?>
          <li>
            <a href="#<?php echo $header_group["id"];?>"><i class="<?php echo $header_group["icon"]?>"></i> <?php echo $header_group["header"]?></a>
          </li>
          <?php } else { ?>


          <li>
            <a href="#"><i class="<?php echo $header_group["icon"]?>"></i> <?php echo $header_group["header"]?><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <?php
 $query_array = array(
                                    "syllabus_id" => "{$query_params["id"]}",
                                    "group_id" => "{$header_group["id"]}",
                                    );
              ?>
              <?php $childs = getAll("syllabi_syllabus_header", $query_array, "child_index", "asc");?>
              <?php foreach ($childs as $child_headers){ ?>
              <?php if($child_headers["child_index"] > 0){ ?>
              <li>
                <a href="#<?php echo $child_headers["id"];?>"><?php echo $child_headers["header"]?></a>
              </li>
              <?php }?>
              <?php }?>

            </ul>
            <!-- /.nav-second-level -->
          </li>
          <?php } ?>
          <?php } ?>


        </ul>
      </div>
      <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>