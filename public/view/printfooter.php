<?php if(!isset($muted)) {?>
	<div id="footer">
		<div class="container">
		  <p class="text-muted text-center text-primary">All rights reserved. Copyright <?php echo date("Y"); ?>, <img src="../img/logofooter.png" alt="Stratford University.">
			</p>
		</div>

	</div>
<?php } ?>
</body>


<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>




</html>


<?php
  // Close database connection
	if (isset($connection)) {
	  mysqli_close($connection);
	}
?>