<?php
if (isset($error)) {
	echo '<p class="error">'.$error.'</p>';
}
?>
<form method="post" action="/login">
	<input type="text" name="username" placeholder="Username" />
	<input type="password" name="password" placeholder="Password" />
	<input type="submit" name="submit" value="Login" />
</form>