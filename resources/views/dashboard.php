<?php

use Core\Helpers\Helper; ?>
<?php if (Helper::check_permission(['user:read'])) : ?>
    <div>
        <div class="dashbord pt-3">
            <div class="card-counter users">
                <a href="/users">
                    <i class="fa fa-users"></i>
                    <div class="inf">
                        <span class="count-name">Users</span>
                        <span class="count-numbers"><?= $data->total_users ?></span>
                    </div>
                </a>
            </div>
            <div class="card-counter items">
                <a href="/items">
                    <i class="fa fa-database"></i>
                    <div class="inf">
                        <span>Items</span>
                        <span><?= $data->total_items ?></span>
                    </div>
                </a>
            </div>

            <div class="card-counter accounts">
                <a href="/accounts/page">
                    <i class="fa fa-calculator"></i>
                    <div class="inf">
                        <span>Total price</span>
                        <span>$<?= $data->total_sales ?></span>
                    </div>
                </a>
            </div>

            <div class="card-counter total">
                <i class="fa fa-bars"></i>
                <div class="inf">
                    <span>Quantity</span>
                    <span><?= $data->total_quantity ?></span>
                </div>
            </div>

            <div class="card-counter total">
                <a href="/accounts/page">
                    <div class="inf">
                        <span>Total Transaction</span>
                        <span><?= $data->tolal_transaction ?></span>
                    </div>
                </a>
            </div>

        </div>
    </div>

    
    <div class="info-chart mt-5 d-flex justify-content-center align-items-center">
        <div>
            <h3 style="color:black;">The 5 most Expensive Items</h3>
            <table class="table w-50 me-1">
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
                                <div class="d-flex align-items-center">
                                    <img src="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] ?>/resources/Images/<?= $item->img ?>" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1"><?= $item->title ?></p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="p-2">
                                    <span class="font-weight-bold">$ <?= $item->price ?></span>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.2.js" integrity="sha256-pkn2CUZmheSeyssYw3vMp1+xyub4m+e+QK4sQskvuo4=" crossorigin="anonymous"></script>


<?php endif; ?>