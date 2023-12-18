<?php

require './includes/database-connection.php';             // Create PDO object
require './includes/functions.php';

$sql = " SELECT a.* , c.name AS category,
        CONCAT(m.forename, ' ', m.surname) AS author,
        i.file     AS image_file,
        i.alt      AS image_alt
        FROM article    AS a
        JOIN category   AS c ON a.category_id = c.id
        JOIN member2     AS m ON a.member_id   = m.id
        LEFT JOIN image AS i ON a.image_id    = i.id
        WHERE a.published = 1
        ORDER BY a.id DESC
        LIMIT 6   ";
$articles = pdo($pdo,$sql)->fetchAll();
$sql2 = "SELECT id, name FROM category WHERE navigation = 1;";
$navigation  = pdo($pdo, $sql2)->fetchAll();
$section     = '';                                       // Current category
$title       = '기본 타이틀';                          // HTML <title> content
$description = '검색용';
include 'includes/header.php';
?>
<main class="container grid" id="content">
<a href="practice.php">스크립트 연습</a>
    <?php foreach ($articles as $article) { ?>
      <article class="summary">
        아티클 : <a href="article.php?id=<?= $article['id'] ?>">
          <img src="uploads/<?= html_escape($article['image_file'] ?? 'blank.png') ?>"
               alt="<?= html_escape($article['image_alt']) ?>">
          <h2><?= html_escape($article['title']) ?></h2>
          <p><?= html_escape($article['summary']) ?></p>
        </a>
        <p class="credit">
          카테고리 :  <a href="category.php?id=<?= $article['category_id'] ?>">
          <?= html_escape($article['category']) ?></a>
          by <a href="member.php?id=<?= $article['member_id'] ?>">
          <?= html_escape($article['author']) ?></a>
        </p>
      </article>
    <?php } ?>
  </main>
<?php include 'includes/footer.php'; ?>
