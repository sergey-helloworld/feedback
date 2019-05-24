<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <script src="/js/jquery-3.3.1.min.js"></script>
  <script src="/js/preview.js"></script>
  <title>Оставить отзыв</title>
</head>
<body>
  <div id="feedback">
  <h2>Оставить отзыв</h2>
  <form method="post" action="<?=$selfController?>">
    <div class="form-group">
      <label for="name">Имя</label>
      <input class="form-control" id="name"  name="name" placeholder="Имя">
    </div>
  <div class="form-group">
    <label for="email">Email адрес</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" placeholder="Введите email">
  </div>
  <div class="form-group">
    <label for="message">Сообщение</label>
    <input class="form-control" id="message" name="message" placeholder="Введите сообщение">
  </div>
  <button type="submit" class="btn btn-primary">Отправить</button>
</form>
  <button class="btn btn-primary" id="preview">Предварительный просмотр</button>
</div>
  <a href="/index.php">На главную</a>
</body>
</html>
