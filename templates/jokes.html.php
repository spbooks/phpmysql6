<?php foreach($jokes as $joke): ?>
<blockquote>
  <p>
  <?=htmlspecialchars($joke, ENT_QUOTES, 'UTF-8')?>
  </p>
</blockquote>
<?php endforeach; ?>