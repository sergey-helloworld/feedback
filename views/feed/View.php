<html>
<head></head>
<body>
  <p>Название: <?=$args['film']['title']?></p>
  <p>Год выпуска: <?=$args['film']['year']?></p>
  <p>Формат: <?=$args['film']['format']?></p>
  <p>Актеры:
    <?php
      foreach ($args['stars'] as $actor) {
        echo $actor['first_name'].' '.$actor['last_name'].', ';
      }
    ?>
  </p>
  <a href="/index.php">На главную</a>
</body>
</html>
