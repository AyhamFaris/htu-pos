<h1 class="text-center mb-3 mt-3">Accounts Dashboard</h1>
<h4 class="text-center mb-3">Total price : $<?= $data->total_price ?></h4>

<div class="row d-flex justify-content-center align-items-center">
<div id="scrol-table">
    <table class="table tabel-shadow align-middle mb-0">
        <thead class="bg-light">
            <tr>
                <th class="ps-5">Name User</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>created_at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            foreach ($data->transactions as $transaction) :
                $total += $transaction->total;
            ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="<?=$_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST']?>/resources/Images/<?= $transaction->img ?>" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                            <div class="ms-3">
                                <p class="fw-bold mb-1"><?= $transaction->display_name ?></p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <?= $transaction->title ?>
                    </td>
                    <td class="ps-4">
                        <?= $transaction->quantity ?>

                    </td>
                    <td>$<?= $transaction->total ?></td>
                    <td>
                        <?php $date = new \DateTime($transaction->created_at);
                        $transaction->created_at = $date->format('d/m/Y');
                        echo $transaction->created_at;
                        ?>
                    </td>
                    <td>
                        <a href="/account/edit?id=<?= $transaction->transacion_id ?>&item_name=<?= $transaction->title ?>"><i id="edit" class="fa-solid fa-pen-to-square pe-3"></i></a>
                        <a href="/account/delete?id=<?= $transaction->transacion_id ?>&item_id=<?= $transaction->item_id ?>"><i id="trash" class="fa-solid fa-x"></i></a>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>