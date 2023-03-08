<?php
if(isset($_GET['success']) && $_GET['success'] == 1)
    echo '<div class="alert alert-danger" role="alert">Post deleted Successfully</div>';
?>
<table class="table table-striped table-dark">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Snippet</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($GLOBALS['params']['posts'] as $post)
    {?>
            <tr>
                <th scope="row"><?= $post['id'] ?></th>
                <th scope="row"><?= $post['title'] ?></th>
                <th scope="row"><?= $post['text'] ?></th>
                <th scope="row">
                    <a href="/dashboard/edit?id=<?= $post['id'] ?>" type="button" class="btn btn-info">Edit</a>
                    <a href="/dashboard/delete?id=<?= $post['id'] ?>" type="button" class="btn btn-danger">Delete</a>

                </th>

            </tr>
    <?php }
    ?>
    </tbody>
</table>
<a href="/dashboard/add" type="submit" class="btn btn-info  btn-lg btn-block">Add new post</a>