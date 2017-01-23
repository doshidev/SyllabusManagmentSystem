<?php $page_name = "Tables Example" ?>
<?php include("head.php"); ?>

<div id="wrapper">
  <!-- Navigation -->
  <?php require 'nav.php';?>
</div>



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

    	<?php 
			if(isset($_POST["mytable"])){
				$mytable = json_decode($_POST["mytable"]);
				?>
				<table class="table table-bordered">
				<?php
				for ($i=0; $i < count($mytable); $i++) {
					echo "<tr>";
					for ($j=0; $j < count($mytable[$i]); $j++) {
						echo "<td>";
						echo $mytable[$i][$j];
						echo "</td>";
					}
					echo "</tr>";
				}
				?>
				</table>
				<?php
			}
			?>

		  <div id="example"></div>
		  <form method="post" id="myform" action="tableexample.php">
		  	<input type="text" name="mytable" id="mytable" value="">
		  </form>
		  <br/>
			
			<a href="javascript:savedata();" class="btn btn-default">Save</a>
			<br/><br/>
			<div id="output1"></div>
			<div id="output2"></div>
			<div id="output3"></div>
			<div id="output4"></div>
		</div>
	</div>



</div> <!-- page-wrapper -->




<?php include("footer.php"); ?>

<script data-jsfiddle="example">
        <?php if(isset($_POST["mytable"])){?>
        mytable=<?php $_POST["mytable"]?>;
        var data = mytable,
          container = document.getElementById('example'), 
          hot;
        <?php } else {?>
        var data = [
		      ['', 'Kia', 'Nissan', 'Toyota', 'Honda'],
		      ['2014', -5, '', 12, 13],
		      ['2015', '', -11, 14, 13],
		      ['2016', '', 15, -12, 'readOnly']
		    ],
          container = document.getElementById('example'), 
          hot;
        <?php } ?>
	        hot = new Handsontable(container, {
	        	data: data,
	        	startRows: 5,
	        	startCols:5,
	          minSpareRows: 0,
	          colHeaders: true,
	          contextMenu: true,
	          pasteMode:"overwrite",
						fragmentSelection:false,
						multiSelect: true,
						mergeCells: true,
						wordWrap: true,
						autoWrapRow:true,
						autoColumnSize: {syncLimit: '100%'},
						outsideClickDeselects:true,
						contextMenuCopyPaste: {
				      swfPath: 'handsontable/zeroclipboard/ZeroClipboard.swf'
				    }
	        });

	        
	        function savedata(){
	        	finaldata = hot.getData();
	        	finalinstance = hot.getSettings();
	        	mergecells = hot.mergeCells.mergedCellInfoCollection
	        	cells=hot.getCellMeta(0,0)['className'];
	        	//document.getElementById('output1').innerHTML = JSON.stringify(finaldata, null, 4);
	        	document.getElementById('mytable').value = JSON.stringify(finaldata);
	        	//document.getElementById('output2').innerHTML = JSON.stringify(mergecells);
	        	//document.getElementById('output3').innerHTML = JSON.stringify(cells);
	        	document.getElementById('myform').submit();
	        }

	        
      </script>