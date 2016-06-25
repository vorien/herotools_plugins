<script type="text/javascript">
	$(function() {

		$("#mainhand").html("<?php echo $mainonlyhtml; ?>");
		$("#offhand").html("<?php echo $offonlyhtml; ?>");
		$("#eitherhand").html("<?php echo $bothhtml; ?>");

		$(".cl").draggable({revert: "invalid", stack: ".cl-drop, .droppable"});

	});

</script>

<?php
//
//debug($mainonlyhtml);
//debug($bothhtml);
//debug($offonlyhtml);
?>
