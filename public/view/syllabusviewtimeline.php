<?php 
$content = getById("syllabi_type_timeline", "id", $content_id);
echo $content["pretext"];
?>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
          <i class="fa fa-clock-o fa-fw"></i> <?php echo $content["title"] ?>
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <ul class="timeline">
          <?php $cnt = 0;?>
          <?php $timelinedetails = getAll("syllabi_type_timelinedetails", array("timelineid"=>$content["id"]), "display_index", "asc");?>
          <?php foreach($timelinedetails as $timeline){ ?>
            <?php $cnt++; ?>
            <li <?php echo ($cnt % 2 == 0) ? "class='timeline-inverted'" : "" ?> >
                <div class="timeline-badge <?php echo ($timeline["badgecolor"] != "stadard") ? $timeline["badgecolor"] : "" ?>">
                	<?php echo ($timeline["icon"] == "number") ? $cnt : "<i class='{$timeline["icon"]}'></i>" ?>
                </div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4 class="timeline-title"><?php echo $timeline["title"]; ?></h4>
                    </div>
                    <div class="timeline-body" style="width:100%; word-wrap: break-word; overflow-wrap: break-word; overflow:auto">
                        <?php echo $timeline["content"]; ?>
                    </div>
                </div>
            </li>
              
          <?php } ?>
        </ul>
      </div>
      <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
  </div>
</div>   
<?php echo $content["posttext"]; ?>
