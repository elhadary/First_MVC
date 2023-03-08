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
                    <button type="button" class="btn btn-info">Edit</button>
                    <button type="button" class="btn btn-danger">Delete</button>

                </th>

            </tr>
    <?php }
    ?>
    </tbody>
</table>