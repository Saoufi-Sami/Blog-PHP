<?php

$articles = json_decode(
    file_get_contents(__DIR__ . '/articles.json'),
    true
);

$dsn = 'mysql:host=localhost;dbname=blog;charset=utf8mb4';
$user = 'paul';
$pwd = 'Pomme123;';

$pdo = new PDO($dsn, $user, $pwd, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$statement = $pdo->prepare('
  INSERT INTO article (
    title,
    category,
    content,
    image
  ) VALUES (
    :title,
    :category,
    :content,
    :image
  )
');

foreach ($articles as $article) {
    $statement->execute([
        ':title'    => $article['title'],
        ':category' => $article['category'],
        ':content'  => $article['content'],
        ':image'    => $article['image'],
    ]);
}
