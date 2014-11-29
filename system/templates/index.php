<?php $this->load_template("sections/header"); ?>
HELLO!

<h3>Page</h3>
<pre>
<?php var_dump($this->page); ?>
</pre>

<h3>User</h3>
<pre>
<?php var_dump($this->u); ?>
</pre>

<?php $this->load_template("sections/footer"); ?>
