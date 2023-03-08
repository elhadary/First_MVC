<?php
$posts = $GLOBALS['params'];
foreach ($posts as $post)
{
    $post['text'] = substr($post['text'],0,'150').'...';
?>
<div class="jumbotron">
    <div class="container">
        <h1 class="display-4"><?=$post['title']?></h1>
        <p class="lead"><?=$post['text']?></p>
        <a href="/post?id=<?= $post['id'] ?>" type="submit" class="btn btn-info  btn-lg btn-block">Read Post</a>
    </div>
</div>

<?php
}
?>