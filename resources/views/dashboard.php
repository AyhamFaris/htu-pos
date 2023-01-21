<?php

use Core\Helpers\Helper; ?>
<?php if (Helper::check_permission(['user:read'])) : ?>
    <div>
        <div class="dashbord">
            <div class="card-counter users">
                <a href="/users">
                    <div class="inf">
                        <i class="fa fa-users"></i>
                        <span class="count-name">Users</span>
                        <span class="count-numbers"><?= $data->total_users ?></span>
                    </div>
                </a>
            </div>
            <div class="card-counter items">
                <a href="/items">
                    <div class="inf">
                        <i class="fa fa-database"></i>
                        <span>Items</span>
                        <span><?= $data->total_items ?></span>
                    </div>
                </a>
            </div>

            <div class="card-counter accounts">
                <a href="/accounts/page">
                    <div class="inf">
                        <i class="fa fa-calculator"></i>
                        <span>$<?= $data->total_sales ?></span>
                    </div>
                </a>
            </div>

            <div class="card-counter total">
                <div class="inf">
                    <i class="fa fa-bars"></i>
                    <span>Quantity</span>
                    <span><?= $data->total_quantity ?></span>
                </div>
            </div>

        </div>
    </div>


    <div class="table-style mt-5">
        <div class="table-1 me-5">
            <table class="table">
                <h3 class="text-center" style="color:black;">Last 5 Transaction</h3>
                <thead>
                    <tr class="border-bottom">
                        <th>
                            <span class="ml-2">id</span>
                        </th>
                        <th>
                            <span class="ml-2">Item Name</span>
                        </th>
                        <th>
                            <span class="ml-2">Total</span>
                        </th>
                        <th>
                            <span class="ml-2">Quantity</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data->top_transaction as $transaction) : ?>
                        <tr class="border-bottom">
                            <td>
                                <div class="p-2">
                                    <span class="d-block font-weight-bold"><?= $transaction->id ?></span>
                                </div>
                            </td>
                            <td>
                                <div class="p-2 d-flex flex-row align-items-center mb-2">
                                    <div class="d-flex flex-column ml-2">
                                        <span class="d-block font-weight-bold"><?= $transaction->title_name ?></span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="p-2">
                                    <span class="font-weight-bold">$ <?= $transaction->total ?></span>
                                </div>
                            </td>
                            <td>
                                <div class="p-2 d-flex flex-column">
                                    <span><?= $transaction->quantity ?></span>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="table-2">
            <table class="table">
                <h3 class="text-center" style="color:black;">The 5 most Expensive Items</h3>
                <thead>
                    <tr class="border-bottom">
                        <th>
                            <span class="ml-2">id</span>
                        </th>
                        <th>
                            <span class="ml-2">Title</span>
                        </th>
                        <th>
                            <span class="ml-2">Price</span>
                        </th>
                        <th>
                            <span class="ml-2">Quantity</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data->top_item as $item) : ?>
                        <tr class="border-bottom">
                            <td>
                                <div class="p-2">
                                    <span class="d-block font-weight-bold"><?= $item->id ?></span>
                                </div>
                            </td>
                            <td>
                                <div class="p-2 d-flex flex-row align-items-center mb-2">
                                    <div class="d-flex flex-column ml-2">
                                        <span class="d-block font-weight-bold"><?= $item->title ?></span>
                                    </div>
                                </div>

                            </td>
                            <td>
                                <div class="p-2">
                                    <span class="font-weight-bold">$ <?= $item->price ?></span>
                                </div>
                            </td>
                            <td>
                                <div class="p-2 d-flex flex-column">
                                    <span><?= $item->quantity ?></span>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="item_quantity">
        <div class="table-3">
            <table class="table">
                <h3 class="text-center" style="color:black;">Item Quantity</h3>
                <thead>
                    <tr class="border-bottom">
                        <th>
                            <span class="ml-2">Item Name</span>
                        </th>
                        <th>
                            <span class="ml-2">Price</span>
                        </th>
                        <th>
                            <span class="ml-2">Quantity</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data->item_quantity as $item) : ?>
                        <tr class="border-bottom">
                            <td>
                                <div class="p-2 d-flex flex-row align-items-center mb-2">
                                    <div class="d-flex align-items-center">
                                        <img src="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] ?>/resources/Images/<?= $item->img ?>" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1"><?= $item->title ?></p>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="p-2">
                                    <span class="font-weight-bold">$ <?= $item->price ?></span>
                                </div>
                            </td>
                            <td>
                                <div class="p-2 d-flex flex-column">
                                    <span><?= $item->quantity ?></span>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>