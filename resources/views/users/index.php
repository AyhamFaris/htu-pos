<div class="container-style mt-5">
<h1 class="d-flex justify-content-around mb-5">Users Dashboard</h1>
<div class="row d-flex justify-content-center align-items-center">
    <table class="table tabel-shadow align-middle mb-0 bg-white">
        <thead class="bg-light">
            <tr>
                <th class="ps-5">Name User</th>
                <th class="text-center">Username</th>
                <th class="text-center">Email</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data->users as $user) : ?>
                <tr>
                    <td class="text-center">
                        <div class="d-flex align-items-center">
                            <img src="<?=$_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST']?>/resources/Images/?>/resources/Images/<?= $user->img ?>" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                            <div class="ms-3">
                                <p class="fw-bold mb-1"><?= $user->display_name ?></p>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <p class="fw-bold"><?= $user->username ?></p>
                    </td>
                    <td class="text-center">
                        <p class="fw-bold"><?= $user->email ?></p>
                    </td>
                    <td class="text-center">
                            <a href="./user?id=<?= $user->id ?>" class="btn btn-warning text-center"><i class="fa-solid fa-user-check fa-fw me-3"></i>Check User</a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>
</div>