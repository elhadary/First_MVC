<?php $post = $GLOBALS['post'][0] ?>
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading"><?= $post['title'] ?></h1>
        <p class="lead text-muted"><?= $post['text']?></p>
    </div>
</section>