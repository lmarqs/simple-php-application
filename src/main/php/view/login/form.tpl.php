<div class="row h-100 justify-content-center align-items-center">
    <div class="col-md-6">
        <div class="card">
            <img class="card-img-top"/>
            <div class="card-body">
                <form role="form" class="form-horizontal" method="post">
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Username</label>
                        <div class="col-sm-8">
                            <input name="username" required type="text" class="form-control" value="<?=$params['username']?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="text" class="col-sm-4 control-label">Password</label>
                        <div class="col-sm-8">
                            <input name="password" required type="password" placeholder="Password" class="form-control" value="<?=$params['password']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-lg btn-block" value="Login">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?=$BUNDLES_SERVER_ADDRESS?>/public/bundle/login/form.js"></script>