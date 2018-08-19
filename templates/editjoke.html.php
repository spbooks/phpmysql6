<form action="" method="post">
    <input type="hidden" name="joke[id]" value="<?=$joke['id'] ?? ''?>">
    <label for="joketext">joke를 입력하세요:</label>
    <textarea id="joketext" name="joke[joketext]" rows="3" cols="40"><?=$joke['joketext'] ?? ''?></textarea>
    <input type="submit" name="submit" value="저장">
</form>