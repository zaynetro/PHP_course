<?php $this->load_template("header"); ?>

<div class='container'>
  <h2>Actor</h2>
	<div class="actor_profile">
		<img src="<?= $this->actor[0]["picture_url"] ?>" alt="<?= $this->actor[0]["name"] ?>">
		<div><?= $this->actor[0]["name"] ?></div>
	</div>
</div>

<?php $this->load_template("footer"); ?>