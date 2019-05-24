<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="/js/preview.js"></script>
  <script type="text/javascript" src="/js/edit.js"></script>
  <script type="text/javascript" src="/js/sort.js"></script>
  <script type="text/javascript" src="/js/state.js"></script>
</head>
<body>

<div class="px-2 py-2 my-4">
<h2>Cписок отзывов</h2>
<?php

if(isset($_SESSION['login'])) {
  echo "<p class='text-danger'>Вы вошли как $_SESSION[login] <a class='btn btn-primary' href='/index.php/admin/logout'>Выйти</a></p>";
}
else {
  echo "<p><a class='btn btn-primary' href='/index.php/admin/login'>Войти</a></p>";
}
?>

</div>

<div class="btn-group px-2 py-2" role="group">
  <button type="button" class="btn btn-secondary" id="sort-by-date">По дате</button>
  <button type="button" class="btn btn-secondary" id="sort-by-author">По автору</button>
  <button type="button" class="btn btn-secondary" id="sort-by-email">По email</button>
</div>

<div id="feed-list">

<?php

$count = 0;
foreach ($args as $value) {
  if(isset($_SESSION['login']) || $value->getIdState() == 2) {
    echo '<div class="border bg-light px-2 py-2 my-4 message-block" id="'.$count.'"><div data-id="'.$value->getId().'"><p><span class="name">'.$value->getName().'</span>, Email: <span class="email">'.$value->getEmail().'</span>, <span class="date">'.$value->getInsDate().'</span></p><p class="message">'.$value->getMessage().'</p>';
    if($image = $value->getImage()) {
        echo '<p><img src="'.$image.'" alt="..." class="img-thumbnail" style="max-width:320px; max-height:240px; width:auto; height:auto;"></p>';
    }
    if($value->getIsEdit()) {
      echo '<p class="text-danger">отредактировано</p>';
    }
    echo '</div>';
    if(isset($_SESSION['login'])) {
      echo '<button name="edit" class="btn btn-primary">Редактировать</button> '; ?>

        <span class="set-state" style="display: <?= $value->getIdState() == 1 ? 'inline' : 'none' ?>"><button type="button" class="btn btn-success accept">Принять</button> <button type="button" class="btn btn-danger reject">Отклонить</button></span>
        <span class="accepted" style="display: <?= $value->getIdState() == 2 ? 'inline' : 'none' ?>">Состояние: <span class="font-weight-bold text-success"> принято</span></span>
        <span class="rejected" style="display: <?= $value->getIdState() == 3 ? 'inline' : 'none' ?>">Состояние: <span class="font-weight-bold text-danger"> отклонено</span></span>

      <?php
    }
    echo '</div>';
    $count++;
  }
}

 ?>

</div>
<div id="feedback" class="px-2 py-2 my-4">
<h3>Оставить отзыв</h3>
<form method="post" action="/index.php/feed/add" enctype="multipart/form-data">
  <div class="form-group">
    <label for="name">Имя</label>
    <input class="form-control" id="name"  name="name" placeholder="Имя" required>
  </div>
<div class="form-group">
  <label for="email">Email адрес</label>
  <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" placeholder="Введите email" required>
</div>
<div class="form-group">
  <label for="message">Сообщение</label>
  <input class="form-control" id="message" name="message" placeholder="Введите сообщение" required>
</div>
<div class="form-group">
    <label for="image">Изображение</label>
    <input type="file" class="form-control-file" id="image" name="image" accept=".jpg,.gif,.png" required>
  </div>
<button type="submit" class="btn btn-primary">Отправить</button>
</form>
<button class="btn btn-primary" id="preview-btn">Предварительный просмотр</button>
</div>

</body>
</html>
