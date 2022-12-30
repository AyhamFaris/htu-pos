<?php

use Core\Helpers\Helper; ?>
<?php if (Helper::check_permission(['user:read'])) : ?>
<div class="container mt-5">
    <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <a href="/users">
        <div class="card-counter primary">
            <i class="fa fa-users"></i>
            <span class="count-name">Users</span>
            <span class="count-numbers"><?= $data->total_users ?></span>
        </div>
      </a>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
     <a href="/items">
        <div class="card-counter danger">
            <i class="fa fa-database"></i>
            <span class="count-name">Items</span>
            <span class="count-numbers"><?= $data->total_items ?></span>
        </div>
     </a>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
    <a href="/accounts/page">
      <div class="card-counter success">
        <i class="fa fa-ticket"></i>
        <span class="count-name">Accounts</span>
        <span class="count-numbers">$<?= $data->total_sales ?></span>
      </div>
    </a>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="card-counter info">
        <i class="fa-solid fa-hand-holding-dollar"></i>
        <span class="count-name">Total Quantity</span>
        <span class="count-numbers"><?= $data->total_quantity ?></span>
      </div>
    </div>
  </div>
  </div>


<div class="row mt-5">
    <div class="col-6">
<table class="table table-borderless table-responsive card-table p-4">
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
    <?php foreach($data->top_transaction as $transaction): ?>
        <tr class="border-bottom">
            <td>
                <div class="p-2">
                    <span class="d-block font-weight-bold"><?=$transaction->id?></span>
                </div>
            </td>
            <td>
                <div class="p-2 d-flex flex-row align-items-center mb-2">
                    <div class="d-flex flex-column ml-2">
                        <span class="d-block font-weight-bold"><?=$transaction->title_name?></span>
                    </div>
                </div>
            </td>
            <td>
                <div class="p-2">
                    <span class="font-weight-bold">$ <?=$transaction->total?></span>
                </div>
            </td>
            <td>
                <div class="p-2 d-flex flex-column">
                    <span><?=$transaction->quantity?></span>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>

<div class="col-6">
    <table class="table table-borderless table-responsive card-table p-4">
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
        <?php foreach($data->top_item as $item): ?>
        <tr class="border-bottom">
            <td>
                <div class="p-2">
                    <span class="d-block font-weight-bold"><?=$item->id?></span>
                </div>
            </td>
            <td>
                <div class="p-2 d-flex flex-row align-items-center mb-2">
                    <div class="d-flex flex-column ml-2">
                        <span class="d-block font-weight-bold"><?=$item->title?></span>
                    </div>
                </div>

            </td>
            <td>
                <div class="p-2">
                    <span class="font-weight-bold">$ <?=$item->price?></span>
                </div>
            </td>
            <td>
                <div class="p-2 d-flex flex-column">
                    <span><?=$item->quantity?></span>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    </div>
</div>
<?php endif; ?>