<?php require 'View/includes/header.php'?>

<?php
$article= $this->getArticle();

$firstId = $this->firstId();
$lastId = $this->lastId();
$previousId = $this->previousId($article->id);
$nextId = $this->nextId($article->id);
?>

<section>
<h1><?= $article->title ?></h1>
<p><?= $article->formatPublishDate() ?></p>
<p><?= $article->description ?></p>

<a href="index.php?page=articles-show&id=
<?php
if($article->id === $firstId)
{echo $lastId;} else
{echo $previousId['id'];}
?>
">Previous article</a>
<a href="index.php?page=articles-show&id=
<?php
if($article->id === $lastId)
{echo $firstId;} else
{echo $nextId['id'];}
?>
">Next article</a>
<br><br>
</section>

<?php require 'View/includes/footer.php'?>