<div class="container-style mt-5">
    <div class="item-dashbord">
        <h1>Items Dashbaord:</h1>
        <table class="table tabel-shadow align-middle mb-0">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Title</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($data->items as $item) : ?>
                    <tr>
                        <td class="text-center">
                            <p class="fw-bold mb-1"><?= $i++ ?></p>
                        </td>
                        <td class="text-center">
                            <p class="fw-bold"><?= $item->title ?></p>
                        </td>

                        <td class="text-center">$<?= $item->price ?></td>
                        <td class="ps-5 text-center"><?= $item->quantity ?></td>
                        <td class="ps-3 text-center">
                            <a href="./item?id=<?= $item->id; ?>" class="btn btn-warning text-center"><i class="fa-solid fa-check fa-fw me-3"></i>Check Item</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>