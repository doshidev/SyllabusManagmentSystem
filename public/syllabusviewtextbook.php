<?php $content = getById("syllabi_type_textbook", "id", $content_id); ?>
<?php if (isset($content["pretext"])){ ?>
<div class="row">
    <div class="col-lg-12">
        <p><?php echo $content["pretext"]; ?></p>
    </div>
</div>
<!-- /.row -->
<?php } ?>

<div class="row">
  <div class="col-lg-12">
      <div class="panel panel-default">
          <div class="panel-heading">
              <div>
                  <div>
                    Required Textbook
                  </div>
              </div>
          </div>
          
          <div class="panel-body">
            
            <div class="col-lg-3 text-center">
              <br/>
              <span class="list-group-item">
              	<img class="img-thumbnail" src="<?php echo $content["smallthumbnail"]; ?>">
            	</span>
              <span class="list-group-item text-left">
              	<?php echo $content["isbn"];?>
                <span class="pull-right text-muted small"><em>ISBN</em></span>
              </span>
              <?php if($content["ebook"] == 1){?>
              <span class="list-group-item text-left">E-Book</span>
              <?php }?>
              <div class="clearfix"></div>
            </div>

            <div class="col-lg-9">
              <div class="panel">
                <div class="panel-body">
                  <div class="list-group">
                  
                    <span class="list-group-item ">
                        <span class="lead"><?php echo $content["title"];?></span>
                    </span>
                		
                		<span class="list-group-item">
                    	<?php echo $content["isbn"];?>
                      <span class="pull-right text-muted small"><em>ISBN</em></span>
                    </span>

                    <span class="list-group-item">
                    	<?php echo $content["author"];?>
                      <span class="pull-right text-muted small"><em>Author</em></span>
                    </span>

                    <span class="list-group-item">
                    	<?php echo $content["publisher"];?>
                      <span class="pull-right text-muted small"><em>Publisher</em></span>
                    </span>

                    <span class="list-group-item">
                    	<?php echo $content["publisheddate"];?>
                      <span class="pull-right text-muted small"><em>Published Date</em></span>
                    </span>
                    
                    <span class="list-group-item">
                    	<?php echo $content["pagecount"];?>
                      <span class="pull-right text-muted small"><em>Page Count</em></span>
                    </span>

                    <span class="list-group-item">
                    	<?php echo $content["category"];?>
                      <span class="pull-right text-muted small"><em>Categories</em></span>
                    </span>
                  </div>
                    <!-- /.list-group -->
                </div>
                <!-- /.panel-body -->
              </div>
              <!-- /.panel -->
              <div class="clearfix"></div>
            </div>
          </div>
      </div>
  </div>
            
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
        <p><?php echo $content["posttext"]; ?></p>
    </div>
</div>
<!-- /.row -->