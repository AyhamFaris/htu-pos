<div class="row d-flex justify-content-center align-items-center">
    <div class="col-xs-12 col-sm-6 col-md-4">
        <div id="userInputContainer">
            <div class="card-body card-x">
                <!--Title-->
                <h3 class="card-title"><strong><?= $data->user->display_name ?></strong></h3>
                <p class="card-text"><strong><?= $data->user->username ?></strong></p>
                <p class="card-text"><strong><?= $data->user->email ?></strong></p>
                <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
                <div class="mt-5 d-flex flex-row justify-content-center gap-3">
                    <a href="/users/edit?id=<?= $data->user->id ?>" class="btn btn-warning">Edit</a>
                    <a href="/users/delete?id=<?= $data->user->id ?>" class="btn btn-danger" onclick="return confirm('Are You Sure Delete <?= $data->user->display_name ?>  ?')">Delete</a>
                    <a href="/users" class="btn btn-success">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>