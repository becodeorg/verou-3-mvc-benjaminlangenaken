<?php require 'View/includes/header.php'?>

<?php // Use any data loaded in the controller here ?>

<section>
<?php foreach ($articles as $article) : ?>
<h1><?= $article->title ?></h1>
<p><?= $article->formatPublishDate() ?></p>
<p><?= $article->description ?></p>
<?php endforeach; ?>

<?php // TODO: links to next and previous ?>
<a href="index.php?page=articles-show">Previous article</a>
<a href="index.php?page=articles-show">Next article</a>
</section>

<?php require 'View/includes/footer.php'?>