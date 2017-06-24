<?php
if (isset($error)) {
	echo '<div class="errors">' . $error . '</div>';
}
?>
<form method="post" action="">
	<label for="email">Your email address</label>
	<input type="text" id="email" name="email">

	<label for="password">Your password</label>
	<input type="password" id="password" name="password">

	<input type="submit" name="login" value="Log in">
</form>