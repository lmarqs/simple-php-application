<?php include "./view/navbar.tpl.php";?>
<br/>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Contacts</h5>
        <a href="/contact/create" class="btn btn-primary">Add Contact</a>
    </div>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">E-mail</th>
                <th scope="col">Birthday</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<script src="<?=$BUNDLES_SERVER_ADDRESS?>/public/bundle/contact/list.js"></script>