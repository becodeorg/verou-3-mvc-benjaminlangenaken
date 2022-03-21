<?php require 'View/includes/header.php' ?>

<?php // Use any data loaded in the controller here ?>

<section>
<h1>Articles</h1>
<ul>
<?php foreach ($articles as $article) : ?>
<a href="index.php?page=articles-show"><li><?= $article->title ?> (<?= $article->formatPublishDate() ?>)</li></a>
<?php endforeach; ?>
</ul>
</section>

<?php require 'View/includes/footer.php'?>