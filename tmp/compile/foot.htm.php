
  </div>

  <hr>

  <footer>
	<p> <?php echo $this->_var['cfg']['webtitle']; ?> Powered by MySQL <?php echo $this->_var['cfg']['version']; ?> </p>
  </footer>

</div>



<script src="<?php echo $this->_var['cfg']['website']; ?>/js/jquery.js"></script>
<script src="<?php echo $this->_var['cfg']['website']; ?>/js/bootstrap.min.js"></script>
<script src="<?php echo $this->_var['cfg']['website']; ?>/js/bootstrap-datepicker.js"></script>

<script>
$(function(){
	window.prettyPrint && prettyPrint();
	$('#datepicker').datepicker({
		format: 'yyyy-mm-dd'
	});
	$('#datepicker2').datepicker({
		format: 'yyyy-mm-dd'
	});
});
</script>
</body>
</html>