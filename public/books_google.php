<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Book List</title>
</head>

<body>

<?php
	// $xml="books.xml";
if(isset($_GET['isbn'])){
	$queryISBN = $_GET['isbn'];
	
	//ISBN DB Example
	//$xml="http://isbndb.com/api/books.xml?access_key=CD22BH05&results=texts&index1=isbn&value1=" . $queryISBN;
	
	// Google Books - Search by ISBN
	//$api_url="https://www.googleapis.com/books/v1/volumes?q=isbn:" . $queryISBN;

	// Google Books - Search by Name
	$api_url="https://www.googleapis.com/books/v1/volumes?q=isbn:" . $queryISBN;

	//www.googleapis.com/books/v1/volumes?q=flowers+inauthor:keyes&key=yourAPIKey

	// $xml="http://www.stratford.edu/sites/all/themes/evolve/custom/faculty-listing/xml/SBA.xml";
	//$myxml = simplexml_load_file($xml) or die("Error: Cannot create object");
	$json_file = file_get_contents($api_url);
	//$json = json_encode($json_file);
	$array = json_decode($json_file,TRUE);
	
	if ($array["totalItems"] > 0){

		$bookitem = $array["items"][0]["volumeInfo"];
		
		// ISBN
		?>
		<script type="text/javascript">
			parent.document.getElementById("isbn").value = "<?php echo $queryISBN;?>";
			parent.document.getElementById("isbndiv").className = "form-group input-group has-success";
		</script>
		<?php 		

		// Book Title
		if (array_key_exists("title", $bookitem)){

			?>
			<script type="text/javascript">
				parent.document.getElementById("title").value = "<?php echo $bookitem["title"];?>";
				parent.document.getElementById("titlediv").className = "form-group input-group has-success";
			</script>
			<?php 
		}

		// Author
		if (array_key_exists("authors", $bookitem)){
			$author =  "";
			foreach($bookitem["authors"] as $authors){
				$author .=  $authors . ", ";			
			}
			$author = substr($author, 0, -2);

			?>
			<script type="text/javascript">
				parent.document.getElementById("author").value = "<?php echo $author;?>";
				parent.document.getElementById("authordiv").className = "form-group input-group has-success";
			</script>
			<?php 
		}
		

		// Publisher
		if (array_key_exists("publisher", $bookitem)){

			?>
			<script type="text/javascript">
				parent.document.getElementById("publisher").value = "<?php echo $bookitem["publisher"];?>";
			</script>
			<?php 
		}

		// Published Date
		if (array_key_exists("publishedDate", $bookitem)){

			?>
			<script type="text/javascript">
				parent.document.getElementById("publisheddate").value = "<?php echo $bookitem["publishedDate"];?>";
			</script>
			<?php 
		}

		// Page Count
		if (array_key_exists("pageCount", $bookitem)){

			?>
			<script type="text/javascript">
				parent.document.getElementById("pagecount").value = "<?php echo $bookitem["pageCount"];?>";
			</script>
			<?php 
		}

		// Category
		if (array_key_exists("categories", $bookitem)){
			$category =  "";
			//$cnt = 0;
			foreach($bookitem["categories"] as $cat){
				//echo "category " . $cnt . " = " . $cat;
				$category .=  $cat . ", ";			
			}
			$category = substr($category, 0, -2);

			?>
			<script type="text/javascript">
				parent.document.getElementById("category").value = "<?php echo $category;?>";
			</script>
			<?php 
		}	

		//Thumbnail		
		if (array_key_exists("imageLinks", $bookitem)){
			?>
			<script type="text/javascript">
				parent.document.getElementById("smallthumbnail").value = "<?php echo $bookitem["imageLinks"]["smallThumbnail"];?>";
				parent.document.getElementById("img-thumbnail").src = "<?php echo $bookitem["imageLinks"]["smallThumbnail"];?>";
			</script>
			<?php 	
		}

	}

	 echo "<pre>";
	 print_r($array);
	 echo "</pre>";

}
	?>    
	

<script type="text/javascript">
	parent.$("#myModal").modal("hide");
</script>

</body>
</html>