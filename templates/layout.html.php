<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/jokes.css">
    <title><?=$title?></title>
  </head>
  <body>
  <nav>
    <header>
      <h1>인터넷 유머 세상</h1>
    </header>
    <ul>
      <li><a href="/">Home</a></li>
      <li><a href="/joke/list">유머글 목록</a></li>
      <li><a href="/joke/edit">유머글 등록/a></li>
    </ul>
  </nav>

  <main>
  <?=$output?>
  </main>

  <footer>
  &copy; IJDB 2017
  </footer>
  </body>
</html>