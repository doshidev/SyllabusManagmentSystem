<?php if(!isset($muted)) {?>
	<div id="footer" class="footer">
		<div class="container">
		  <p class="text-muted text-center text-primary">All rights reserved. Copyright <?php echo date("Y"); ?>, <img src="img/logofooter.png" alt="Stratford University.">
			</p>
		</div>

	</div>
<?php } ?>
</body>

<!-- jQuery -->
<script src="js/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="js/metisMenu.min.js"></script>



<!-- DataTables JavaScript -->
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>

<!-- Javascript CDN for Data Tables
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.9/js/jquery.dataTables.js"></script> -->

<!-- Custom Theme JavaScript -->
<script src="js/sb-admin-2.js"></script>

<!-- Summernote JS for Editor -->
<script src="summernote/summernote.min.js"></script>

<!-- Handsontable - JavaScript data grid editor. Excel-like grid editing with HTML & JavaScript -->
<script data-jsfiddle="common" src="handsontable/handsontable.full.js"></script>

</html>


<?php
  // Close database connection
	if (isset($connection)) {
	  mysqli_close($connection);
	}

	if (isset($conn)) {
	  $conn = null;
	}

	
?>