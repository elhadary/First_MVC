<div class="mx-auto col-10 col-md-8 col-lg-6">
    {{errors}}
    <?= isset($GLOBALS['params']['success']) ? $GLOBALS['params']['success'] : null ?>
    <form action="/login" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form></div>