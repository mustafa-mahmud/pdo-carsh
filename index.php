<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'pdoposts';

//set DSN
$dsn = "mysql:host=$host;dbname=$dbname";
//create object
$pdo = new PDO($dsn, $user, $password);
//set default fetch array mode (it is works like fetchAll(PDO::FETCH_OBJ))
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
//change emulation mode (if you do not use it, then execute([...]) will be string mode,and it will make problem), alway use it
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

//pdo query
// $stmt = $pdo->query("select * from posts");

//associative array
/* while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
echo $row['title'] . '<br/>';
} */

/* //object
while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
echo $row->title . '<br/>';
} */

//default fetch option, as top defined ($pdo->setAttribute())
/* while ($row = $stmt->fetch()) {
echo $row->title . '<br/>';
} */

//PREPARE STATEMENTS (prepare & execute)

//UNSAFE WAY (DO NOT DO THAT WAY)
//$sql="select * from posts where author='tony'";

//fetch by prepare with position parameter
/* $author = 'Tony';
$sql = "select * from posts where author=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$author]);
$post = $stmt->fetchAll();

// var_dump($post);
foreach ($post as $post) {
echo $post->title . "<br/>";
} */

//fetch by prepare with name parameter
/* $author = 'Tony';
$isPublished = false;

$sql = "select * from posts where author=:author && is_published=:bool";
$stmt = $pdo->prepare($sql);
$stmt->execute(['bool' => $isPublished, 'author' => $author]);
$post = $stmt->fetchAll();

// var_dump($post);
foreach ($post as $post) {
echo $post->title . "<br/>";
} */

//fetch single post
/* $id = 1;
$sql = "select * from posts where id=:id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$post = $stmt->fetch(); */

//row count
/* $author = 'John';
$sql = "select * from posts where author=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$author]);
$postCount = $stmt->rowCount();
echo $postCount; */

//insert data
/* $title = 'Post five title';
$body = 'Post Five body';
$author = 'Kevin';

$sql = "insert into posts (title,body,author) values (:title,:body,:author)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['title' => $title, 'body' => $body, 'author' => $author]);
echo 'Post added'; */

//update data
/* $id = 1;
$body = 'This is post one updated';
$author = 'Tony';

$sql = "update posts set body=:body where id=:id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['body' => $body, 'id' => $id]);
echo 'Post Updated'; */

//delete data
/* $id = 2;
$sql = "delete from posts where id=:id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
echo 'Post deleted'; */

//search data
/* $search = "%five%";
$sql = "select * from posts where title like ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$search]);
$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

foreach ($posts as $post) {
echo $post->title . '<br/>';
} */

//limit
$author = 'Tony';
$is_published = true;
$limit = 1;

$sql = "select * from posts where author=:author && is_published=:is_pub limit :lim";
$stmt = $pdo->prepare($sql);
$stmt->execute(['author' => $author, 'is_pub' => $is_published, 'lim' => $limit]);
$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

foreach ($posts as $post) {
  echo $post->title . '<br/>';
}
?>