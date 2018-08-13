<?php include "./view/navbar.tpl.php";?>
<br/>
<div class="card">
    <div class="card-body">
        <h5 class="card-title"><?=$attr['id'] == null ? 'Creating' : 'Updating'?> a contact</h5>
        <a href="/contact" class="btn btn-primary">Contacts</a>
        <br/>
        <br/>
        <form role="form" class="form-horizontal" method="post" autocomplete="off">
            <div class="form-group">
                <label>Name</label>
                <input name="name" type="text" required class="form-control <?=isset($errs['name']) ? 'is-invalid' : ''?>">
                <div class="invalid-feedback"><?=$errs['name']?></div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Phone</label>
                        <input name="phone" type="tel" class="form-control <?=isset($errs['phone']) ? 'is-invalid' : ''?>">
                        <div class="invalid-feedback"><?=$errs['phone']?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" type="email" class="form-control <?=isset($errs['email']) ? 'is-invalid' : ''?>">
                        <div class="invalid-feedback"><?=$errs['email']?></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Birthday</label>
                        <input bame="birthday" type="date" class="form-control <?=isset($errs['birthday']) ? 'is-invalid' : ''?>">
                        <div class="invalid-feedback"><?=$errs['birthday']?></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Save">
            </div>
        </form>
    </div>
</div>