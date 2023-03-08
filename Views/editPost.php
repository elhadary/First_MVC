{{errors}}
<?php


$post = $GLOBALS['params'];


?>
<?= isset($GLOBALS['params']['success']) ? $GLOBALS['params']['success'] : null ?>
<?php
    if(isset($_GET['success']) && $_GET['success'] == 1)
        echo '<div class="alert alert-success" role="alert">Post edited Successfully</div>';
?>

<form action="/dashboard/edit?id=<?= $post['id'] ?>" method="post">
    <div class="form-group">
        <label for="exampleFormControlInput1">Title</label>
        <input name="title" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Title" value="<?=$post['title'] ?>">
    </div>
    <div class="form-group">
        <input type="hidden" name="id" value="<?= $post['id'] ?>" />

    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Post</label>
        <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="6"><?=$post['text'] ?></textarea>
    </div>

    <button type="submit" class="btn btn-info  btn-lg btn-block">Edit Post</button>

</form>