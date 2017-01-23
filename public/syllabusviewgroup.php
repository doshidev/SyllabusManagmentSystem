<?php 
$content = getById("syllabi_type_group", "id", $content_id);
echo $content["pretext"];
?>
<div class="row">
  <div class="col-lg-12">
    
        <?php $cnt = 0;?>
        <?php $groupdetails = getAll("syllabi_type_groupdetails", array("groupid"=>$content["id"]), "display_index", "asc");?>
        <?php if($content["type"] == "panel") {?>
          <div class="row">
          <?php foreach($groupdetails as $group){ ?>
            <div class="col-lg-<?php echo (12/$content["cols"]); ?> col-md-6">
              <div class="panel panel-<?php echo $group["titlecolor"]; ?>">
                <div class="panel-heading">
                  <?php echo $group["title"]; ?>
                </div>
                
                <div class="panel-body">
                  <span class="pull-left">
                    <?php echo $group["content"]; ?>
                  </span>
                  <div class="clearfix"></div>
                </div>

                <?php if ($group["footer"] != "" or $group["footer"] != null) { ?>
                <div class="panel-footer">
                  <span class="pull-left"><?php echo $group["footer"]; ?></span>
                  <div class="clearfix"></div>
                </div>                  
                <?php }?>
              </div>
            </div>

          <?php } ?>
          </div>
        <?php } ?>

        <?php if($content["type"] == "accordian") {?>
          <div class="panel-group" id="accordion">
            <?php foreach($groupdetails as $group){ ?>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $group["id"]; ?>"><?php echo $group["title"]; ?></a>
                  </h4>
                </div>
                <div id="collapse<?php echo $group["id"]; ?>" class="panel-collapse collapse">
                  <div class="panel-body">
                    <?php echo $group["content"]; ?>
                  </div>
                </div>
              </div>
            <?php }?>
          </div>
        <?php } ?>

        <?php if($content["type"] == "tabs") {?>
          
            <!-- tabs -->
            <ul class="nav nav-tabs">
              <?php $cnt = 0; ?>
              <?php foreach($groupdetails as $group){ ?>
              <li <?php echo ($cnt ==0) ? "class='active'" : null;?> >
                <a href="#t<?php echo $group["id"]; ?>" data-toggle="tab">
                  <?php echo $group["title"]; ?>
                </a>
              </li>
              <?php $cnt++; ?>
              <?php } ?>
            </ul>

              <!-- Tab panes -->
            <div class="tab-content">
              <?php $cnt = 0; ?>
              <?php foreach($groupdetails as $group){ ?>
              <div class="tab-pane fade <?php echo ($cnt == 0) ? "in active" : null;?>" id="t<?php echo $group["id"]; ?>">
                  <h4><?php echo $group["title"]; ?></h4>
                  <p><?php echo $group["content"]; ?></p>
              </div>
               <?php $cnt++; ?>
              <?php } ?>
            </div>


          
        <?php } ?>
        
        <?php if($content["type"] == "well") {?>
          <div class="row">
            <?php foreach($groupdetails as $group){ ?>
              <div class="col-lg-<?php echo (12/$content["cols"]); ?>">
                <div class="well">
                  <h4><?php echo $group["title"]; ?></h4>
                  <p><?php echo $group["content"]; ?></p>
                </div>
              </div>
            <?php } ?>
          </div>
        <?php } ?>

  </div>
</div>   
<?php echo $content["posttext"]; ?>
