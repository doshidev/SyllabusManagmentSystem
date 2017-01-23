<?php $page_name = "Manage Content" ?>
<?php include("head.php"); ?>

<style type="text/css">
@media screen and (min-width: 768px) {
  #myModal .modal-dialog  {width:800px;}
  #myModal .modal-body {height: 600px; }
}

#myModal .modal-dialog  {width:70%;}
</style>

<div id="wrapper">
  <!-- Navigation -->
  <?php require 'nav.php';?>
</div>

<!-- Check parameters -->
<?php
	//Check form parameters
	$check_params = checkFormParams(array("id", "action", "syllabus_id", "isbn", "title", "author", "publisher", "publisheddate", "pagecount", "category", "smallthumbnail", "ebook", "pretext", "posttext"));

	if(isset($check_params["action"]) && $check_params["action"] == "update"){
		$update_params = array("isbn" => $check_params["isbn"],
      "title" => $check_params["title"],
      "author" => $check_params["author"],
      "publisher" => $check_params["publisher"],
      "publisheddate" => $check_params["publisheddate"],
      "smallthumbnail"  => $check_params["smallthumbnail"],
      "ebook"  => $check_params["ebook"],
      "pretext"  => $check_params["pretext"],
      "posttext" => $check_params["posttext"]
    );
        if(isset($check_params["pagecount"]) && $check_params["pagecount"]!=null && $check_params["pagecount"]!=''){
      $update_params["pagecount"] = $check_params["pagecount"];
    }
        if(isset($check_params["category"]) && $check_params["category"]!=null && $check_params["category"]!=''){
      $update_params["category"] = $check_params["category"];
    }
    
    updateById("syllabi_type_textbook", $check_params["id"], $update_params);
	redirectTo("syllabusview.php?id={$check_params["syllabus_id"]}");
	} 

  //Check query parameters
  $query_params = checkQueryParams(array("id", "syllabus_id"));
  if(isset($query_params["id"])){
    $syllabus_id = $query_params["id"];
    $content = getById("syllabi_type_textbook", "id", $query_params["id"]);
    $isbn = $content["isbn"];
    $title = $content["title"];
    $author = $content["author"];
    $publisher = $content["publisher"];
    $publisheddate = $content["publisheddate"];
    $pagecount = $content["pagecount"];
    $category = $content["category"];
    $smallthumbnail = $content["smallthumbnail"];
    if(!$smallthumbnail) {
      $smallthumbnail = "img/textbook/noimg.jpg" ;
    }
    $ebook = $content["ebook"];
    $pretext = $content["pretext"];
    $posttext = $content["posttext"];

  } else {
    redirectTo("syllabusmanage.php");  
  }
  
?>

<div id="page-wrapper">
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header"><?php echo $page_name?></h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->	

  <div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
      <li><a href="myhome.php">Home</a></li>
      <li>Manage Content</li>
      </ol>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body">

				  <div class="row">
				    <div class="col-lg-12">
				      <form role="form" method="post" name="syllabusform" id="syllabusform">
				      	<div id="errors">
                </div>

				      	<input class="form-control hidden" name="id" id="id" value="<?php echo $query_params["id"]; ?>">
				      	<input class="form-control hidden" name="syllabus_id" id="syllabus_id" value="<?php echo $query_params["syllabus_id"]; ?>">
				      	<input class="form-control hidden" name="action" id="action" value="update">

                <div class="form-group">
                  <label>Pre Text</label>
                  <textarea name="pretext" id="pretext" class="form-control" rows="3"><?php echo $content["pretext"]; ?></textarea>
                </div>
                
                <div class="panel panel-default">
                  <div class="panel-heading">
                      Required Book
                  </div>
                  <!-- /.panel-heading -->
                  <div class="panel-body">
                    <div id="isbndiv" name="isbndiv" class="form-group input-group <?php echo ($isbn == "") ? "has-error" : "has-success";?>">
                      <span class="input-group-addon">ISBN</span>
                      <input type="text" class="form-control" name="isbn" id="isbn" value="<?php echo $isbn; ?>" placeholder="Enter ISBN" required>
                      <span class="input-group-btn">
                          <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
                            <i class="fa fa-search"></i>
                          </button>
                      </span>

                    </div>

                    <div id="titlediv" name="titlediv" class="form-group input-group <?php echo ($title == "") ? "has-error" : "has-success";?>">
                      <span class="input-group-addon">Title</span>
                      <input type="text" class="form-control" name="title" id="title" value="<?php echo $title; ?>" placeholder="Enter Title" required>
                      <span class="input-group-btn">
                          <button class="btn btn-default" type="button" data-toggle="modal" data-target="#myModal">
                            <i class="fa fa-search"></i>
                          </button>
                      </span>
                    </div>

                   
                    <div id="authordiv" name="authordiv" class="form-group input-group <?php echo ($author == "") ? "has-error" : "has-success";?>">
                      <span class="input-group-addon">Author</span>
                      <input type="text" class="form-control" name="author" id="author" value="<?php echo $author; ?>" placeholder="Enter Author" required>
                      <span class="input-group-btn">
                          <button class="btn btn-default" type="button" data-toggle="modal" data-target="#myModal">
                            <i class="fa fa-search"></i>
                          </button>
                      </span>
                    </div>

                    <!-- modal -->
                    <div class="modal fade text-left" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-body">
                            <iframe name="booksearch" id="booksearch" width="100%" height="100%" src="syllabusfindbook.php"></iframe>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" id="modalclose" data-dismiss="modal">Close</button>
                          </div>
                        </div><!-- /.modal-content -->
                      </div> <!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                    <div class="form-group input-group">
                      <span class="input-group-addon">Publisher</span>
                      <input type="text" class="form-control" name="publisher" id="publisher" value="<?php echo $publisher; ?>" placeholder="Enter Publisher">
                    </div>

                    <div class="form-group input-group">
                      <span class="input-group-addon">Published Date</span>
                      <input type="text" class="form-control" name="publisheddate" id="publisheddate" value="<?php echo $publisheddate; ?>" placeholder="Enter Published Date">
                    </div>

                    <div class="form-group input-group">
                      <span class="input-group-addon">Page Count</span>
                      <input type="text" class="form-control" name="pagecount" id="pagecount" value="<?php echo $pagecount; ?>" placeholder="Enter Page Count">
                    </div>

                    <div class="form-group input-group">
                      <span class="input-group-addon">Category</span>
                      <input type="text" class="form-control" name="category" id="category" value="<?php echo $category; ?>" placeholder="Enter Book Category">
                    </div>

                    <div class="form-group">
                      <label>Thumbnail</label>
                      <input type="hidden" class="form-control" name="smallthumbnail" id="smallthumbnail" value="<?php echo $smallthumbnail; ?>">
                      <br/>
                      <img id="img-thumbnail" name="img-thumbnail" class="img-thumbnail" src="<?php echo $smallthumbnail; ?>">
                    </div>

                    <div class="form-group input-group">
                      <span class="input-group-addon">E-Book?</span>
                      <select name="ebook" id="ebook" class="form-control" onchange>
                        <option value="0" <?php echo ($ebook == "0") ? "selected" : null; ?>>No</option>
                        <option value="1" <?php echo ($ebook == "1") ? "selected" : null; ?>>Yes</option>
                      </select>
                    </div>
                  </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->

                

                <div class="form-group">
                  <label>Post Text</label>
                  <textarea name="posttext" id="posttext" class="form-control" rows="10"><?php echo $content["posttext"]; ?></textarea>
                </div>

				        <a href="javascript:submitForm();" class="btn btn-default">Submit</a>
								<button type="cancel" class="btn btn-default">Cancel</button>

							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

</div> <!-- /.page-wrapper -->



<?php include("footer.php"); ?>


<script type="text/javascript">
$(document).ready(function() {
  $('#pretext').summernote();
  $('#posttext').summernote();
  changeBookSearchSrc();

  $('#isbn').blur(function(){
    if(document.getElementById("isbn").value != ""){
      document.getElementById("isbndiv").className = "form-group input-group has-success";
    } else {
      document.getElementById("isbndiv").className = "form-group input-group has-error";
    }
    changeBookSearchSrc();
  });

  $('#title').blur(function(){
    if(document.getElementById("title").value != ""){
      document.getElementById("titlediv").className = "form-group input-group has-success";
    } else {
      document.getElementById("titlediv").className = "form-group input-group has-error";
    }
    changeBookSearchSrc();
  });

  $('#author').blur(function(){
    if(document.getElementById("author").value != ""){
      document.getElementById("authordiv").className = "form-group input-group has-success";
    } else {
      document.getElementById("authordiv").className = "form-group input-group has-error";
    }
  });

});

function changeBookSearchSrc(){
  isbn = document.getElementById("isbn").value;
  title = document.getElementById("title").value;
  document.getElementById("booksearch").src = "syllabusfindbook.php?isbn=" + isbn + "&title=" + title;
}

function submitForm(){
  var formerrors = "";
  if(document.getElementById("isbn").value == "" || document.getElementById("isbn").value == null || document.getElementById("isbn").value == 0) {
    formerrors += "Enter ISBN. <br/>"
  }
  if(document.getElementById("title").value == "" || document.getElementById("title").value == null) {
    formerrors += "Enter Title. <br/>"
  }
  if(document.getElementById("author").value == "" || document.getElementById("author").value == null) {
    formerrors += "Enter Author. <br/>"
  }

  if (formerrors == "" || formerrors == null) {
    document.forms["syllabusform"].action = "syllabusedittextbook.php";
    document.forms["syllabusform"].submit();
  } else {
    document.getElementById("errors").innerHTML = formerrors;
    document.getElementById("errors").className="alert alert-danger";
  }
}

</script>