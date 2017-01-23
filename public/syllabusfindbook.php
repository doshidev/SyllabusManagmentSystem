<?php $page_name = "Find Textbook" ?>
<?php include("head.php"); ?>


<?php

$query_params = checkQueryParams(array("isbn", "title", "author", "bookindex"));

if(!isset($query_params["bookindex"])) {
	$query_params["bookindex"] = 0;
}

$cnt = 0;
$queryp = "";
$queryn = "";
foreach($query_params as $key => $value){
	if($key != "cnt") {
		if($cnt > 0){
			$queryp .= "&";
			$queryn .= "&";
		}
		if($key == "bookindex"){
			$queryp .= $key . "=" . ($value - 1);
			$queryn .= $key . "=" . ($value + 1);
		} else {
			$queryp .= $key . "=" . $value;
			$queryn .= $key . "=" . $value;	
		}	
		$cnt++;
	}
}


$cnt = 0;
// Google Books - Search by Name
$api_url="https://www.googleapis.com/books/v1/volumes?q=";
if(isset($query_params["title"]) && $query_params["title"] != "") {
	$api_url .= urlencode("intitle:'" . $query_params["title"] . "'");
	$cnt++;

}
if(isset($query_params["isbn"])) {
	if($cnt > 0) {
		$api_url .= "+";
	}
	$api_url .="isbn:" . urlencode($query_params["isbn"]);
	$cnt++;
}
if(isset($query_params["author"])) {
	if($cnt > 0) {
		$api_url .= "+";
	}
	$api_url .= urlencode("+inauthor:'" . $query_params["author"] . "'");
}
$api_url .= "&startIndex=" . $query_params["bookindex"];
$api_url .= "&maxResults=1";
$api_url .= "&fields=totalItems,items(volumeInfo(title,authors/*,publisher,publishedDate,industryIdentifiers/*,pageCount,printType,categories/*,imageLinks/*))";

//echo $api_url;

$json_file = file_get_contents($api_url);
$booksarray = json_decode($json_file,TRUE);

$panelcolor = array("primary", "green", "yellow", "red");
$i=0;
$max = $booksarray["totalItems"];

if ($booksarray["totalItems"] > 0){
?>
  <div id="wrapper">
  	<div class="col-lg-12">
  		<div class="seperator">&nbsp;</div>
	    <div class="row">	
	      <div class="col-lg-12">				
						<?php foreach ($booksarray["items"] as $array) { ?>
							<?php $bookitem = $array["volumeInfo"]; ?>
				      <div class="col-lg-12">
				          <div class="panel panel-default">
				              <div class="panel-heading">
			                  <?php echo $bookitem["title"]; ?>
				              </div>
				              <div class="panel-body">
				              	<div class="col-sm-3 text-center">
				              		<?php 
				              		if (array_key_exists("imageLinks", $bookitem)){
														echo "<img src=" . $bookitem["imageLinks"]["smallThumbnail"] . "/>";
													}
													?>
												</div>
												<div class="col-sm-9">
					              	<div class="list-group">
	                  
				                    <span class="list-group-item ">
				                        <span class="lead"><?php echo $bookitem["title"]; ?></span>
				                    </span>

														<?php if (array_key_exists("industryIdentifiers", $bookitem)){ ?>
															<span class="list-group-item">
					                    	<?php 
					                    		$identifier =  "";
																	$bookISBN = null;
					                    	?>
					                    	<?php foreach($bookitem["industryIdentifiers"] as $isbn){ ?>
																	<?php $identifier .=  $isbn["identifier"] . ", ";?>
																	
																	<?php
																	if ($isbn["type"]=="ISBN_13"){
																		$bookISBN = $isbn["identifier"];
																	}

																	if($isbn["type"]=="ISBN_10" & $bookISBN == null) {
																		$bookISBN = $isbn["identifier"];
																	} 
																	?>
																<?php } ?>
																<?php $identifier = substr($identifier, 0, -2); ?>
																<?php echo $identifier; ?>
					                      <span class="pull-right text-muted small"><em>Industry Identifiers</em></span>
					                    </span>			                		
				                		<?php } ?>
				                		
				                		<?php if (array_key_exists("authors", $bookitem)){ ?>
					                		<?php $authors  = null;?>
					                		<?php foreach($bookitem["authors"] as $auth){
																$authors .= $auth . ", ";
															} ?>
															<?php $authors = substr($authors, 0, -2); ?>
					                		<span class="list-group-item">
					                    	<?php echo $authors ; ?>
					                      <span class="pull-right text-muted small"><em>Author</em></span>
					                    </span>
					                  <?php } ?>

					                  <?php if (array_key_exists("publisher", $bookitem)){ ?>
					                		<span class="list-group-item">
					                    	<?php echo $bookitem["publisher"] ; ?>
					                      <span class="pull-right text-muted small"><em>Publisher</em></span>
					                    </span>
					                  <?php } ?>

					                  <?php if (array_key_exists("publishedDate", $bookitem)){ ?>
					                		<span class="list-group-item">
					                    	<?php echo $bookitem["publishedDate"]; ?>
					                      <span class="pull-right text-muted small"><em>Published Date</em></span>
					                    </span>
					                  <?php } ?>

					                  <?php if (array_key_exists("pageCount", $bookitem)){ ?>
					                		<span class="list-group-item">
					                    	<?php echo $bookitem["pageCount"]; ?>
					                      <span class="pull-right text-muted small"><em>Page Count</em></span>
					                    </span>
					                  <?php } ?>

					                  <?php if (array_key_exists("printType", $bookitem)){ ?>
					                		<span class="list-group-item">
					                    	<?php echo $bookitem["printType"]; ?>
					                      <span class="pull-right text-muted small"><em>Print Type</em></span>
					                    </span>
					                  <?php } ?>

					                  <?php if (array_key_exists("categories", $bookitem)){ ?>
					                		<?php $categories  = null;?>
					                		<?php foreach($bookitem["categories"] as $cat){
																$categories .= $cat . ", ";
															}?>
															<?php $categories = substr($categories, 0, -2); ?>
					                		<span class="list-group-item">
					                    	<?php echo $categories ; ?>
					                      <span class="pull-right text-muted small"><em>Category</em></span>
					                    </span>
					                  <?php } ?>


				                  </div>
				                </div>
				              	
												
											
				              </div>
				              <a href="books_google.php?isbn=<?php echo $bookISBN; ?>">
				                  <div class="panel-footer">
				                      <span class="pull-left">Select This Book</span>
				                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				                      <div class="clearfix"></div>
				                  </div>
				              </a>
				          </div>
				      </div>
				    <?php } ?>
			  </div>
			</div>
		</div>

		<div class="col-lg-12">
			<div class="row">
				<div class="col-lg-12">
				  <nav>
				    <ul class="pager">
				      <?php if($query_params["bookindex"] > 0) { ?>
				      <li class="previous"><a href="syllabusfindbook.php?<?php echo $queryp; ?>"><span aria-hidden="true">&larr;</span> Previous</a></li>
				      <?php } ?>
				      
				      <?php if($query_params["bookindex"] < $max - 1) { ?>
				      <li class="next"><a href="syllabusfindbook.php?<?php echo $queryn; ?>">Next <span aria-hidden="true">&rarr;</span></a></li>
				      <?php } ?>
				    </ul>
				  </nav>
			  </div>
			</div>
		</div>
	</div>
<?php } ?>

