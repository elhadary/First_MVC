{{errors}}
<?= isset($GLOBALS['params']['success']) ? $GLOBALS['params']['success'] : null ?>

<form action="/dashboard/add" method="post">
    <div class="form-group">
        <label for="exampleFormControlInput1">Title</label>
        <input name="title" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Title">
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Post</label>
        <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="6"></textarea>
    </div>
    <button type="submit" class="btn btn-info  btn-lg btn-block">Add Post</button>

</form>