<?php include "./view/navbar.tpl.php";?>
<br/>
<div class="card">
    <div class="card-body">
        <h5 class="card-title"><?=!$attrs["id"] ? "Creating" : "Updating"?> a contact</h5>
        <a href="/contact" class="btn btn-primary">Contacts</a>
        <br/>
        <br/>
        <form role="form" class="form-horizontal" method="post" autocomplete="off">
            <div class="form-group">
                <label>Name</label>
                <input name="name" autofocus type="text" required value="<?=htmlspecialchars($attrs["name"])?>" class="form-control <?=isset($errs["name"]) ? "is-invalid" : ""?>">
                <div class="invalid-feedback"><?=htmlspecialchars($errs["name"])?></div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Phone</label>
                        <input name="phone" type="tel" value="<?=htmlspecialchars($attrs["phone"])?>" class="form-control <?=isset($errs["phone"]) ? "is-invalid" : ""?>">
                        <div class="invalid-feedback"><?=htmlspecialchars($errs["phone"])?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" type="email" value="<?=htmlspecialchars($attrs["email"])?>" class="form-control <?=isset($errs["email"]) ? "is-invalid" : ""?>">
                        <div class="invalid-feedback"><?=htmlspecialchars($errs["email"])?></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Birthday</label>
                        <input name="birthday" type="date" required value="<?=htmlspecialchars($attrs["birthday"])?>" class="form-control <?=isset($errs["birthday"]) ? "is-invalid" : ""?>">
                        <div class="invalid-feedback"><?=htmlspecialchars($errs["birthday"])?></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Save">
            </div>
        </form>
    </div>
</div>
