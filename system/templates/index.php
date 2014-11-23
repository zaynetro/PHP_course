<?php $this->load_template("header"); ?>
HELLO!

<h3>Page</h3>
<pre>
<?php var_dump($this->page); ?>
</pre>

<h3>User</h3>
<pre>
<?php var_dump($this->u); ?>
</pre>

<?php $this->load_template("footer"); ?>
