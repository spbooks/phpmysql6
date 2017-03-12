<form action="" method="post">
	<input type="hidden" name="joke[id]" value="<?=$joke['id'] ?? ''?>">
    <label for="joketext">Type your joke here:</label>
    <textarea id="joketext" name="joke[joketext]" rows="3" cols="40"><?=$joke['joketext'] ?? ''?></textarea>
    <input type="submit" name="submit" value="Save">
</form>