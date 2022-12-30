<!-- use Core\Helpers\Helper; -->
<div class="row d-flex justify-content-center align-items-center">
    <div class="d-flex justify-content-center align-items-center" style="width: 18rem;">
        <div id="userInputContainer"  class="card-body">
            <p class="card-text">Title : <strong><?= $data->item->title ?></strong></p>
            <p class="card-text">Cost : <strong>$<?= $data->item->cost ?></strong></p>
            <p class="card-text">Price : <strong>$<?= $data->item->price ?></strong></p>
            <p class="card-text">Quantity : <strong><?= $data->item->quantity ?></strong></p>
            <div class="mt-5 d-flex flex-row-reverse gap-3">
                <a href="/items/edit?id=<?= $data->item->id ?>" class="btn btn-warning">Edit</a>
                <a href="/items/delete?id=<?= $data->item->id ?>" class="btn btn-danger" onclick="return confirm('Are You Sure Delete <?= $data->item->title ?>  ?')">Delete</a>
                <a href="/items" class="btn btn-success">Back</a>
            </div>
        </div>
    </div>
</div>