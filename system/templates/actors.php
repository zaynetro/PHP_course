<?php $this->load_template("header"); ?>
<?php
	foreach($this->actors as $actor){
		require("actor_container.php");
	}
?>
<?php $this->load_template("footer"); ?>