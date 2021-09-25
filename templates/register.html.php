<?php if (!empty($errors)): ?>
	<div class="errors">
		<p>Your account could not be created, please check the following:</p>
		<ul>
		<?php foreach ($errors as $error): ?>
			<li><?= $error ?></li>
		<?php endforeach; 	?>
		</ul>
	</div>
<?php endif; ?>
<form action="" method="post">
    <label for="email">Your email address</label>
    <input name="author[email]" id="email" type="text" value="<?=$author['email'] ?? ''?>">
    
    <label for="name">Your name</label>
    <input name="author[name]" id="name" type="text" value="<?=$author['name'] ?? ''?>">

    <label for="password">Password</label>
    <input name="author[password]" id="password" type="password" value="<?=$author['password'] ?? ''?>">
 
    <input type="submit" name="submit" value="Register account">
</form>