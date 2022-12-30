<section>
    <div class="row">
        <div class="left col-6">
        <form id="userInputContainer" action="/user/up_pro" method="POST" class="w-50">
        <input type="hidden" name="id" value="<?= $data->info->id ?>">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Display Name</label>
                <input type="text" class="form-control" name="display_name" value="<?= $data->info->display_name ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">User Name</label>
                <input type="text" class="form-control" name="username" value="<?= $data->info->username ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="text" class="form-control" name="email" value="<?= $data->info->email ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" value="<?= $data->info->password ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">New Password</label>
                <input type="password" class="form-control" name="new-password">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        </div>
        <div class="right col-6">
            <div class="card" style="width: 18rem; top:50px">
                <form id="userInputContainer-img" action="/users/update_img" method="POST" enctype="multipart/form-data">
                    <img src="<?= "http://" . $_SERVER['HTTP_HOST'] ?>/resources/Images/<?= $data->info->img ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <input type="file" id="uplode-img-edit" class="form-control" name="upload" style="background-color: #ddd;">
                        <button type="submit" class="btn btn-warning mt-3">Update img</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>