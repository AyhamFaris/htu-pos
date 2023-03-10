<div class="style-form">
    <div class="form-items-edit">
        <h2>Edit quantity Transaction</h2>
        <form action="/account/update" method="POST">
            <input type="hidden" name="id" value="<?= $data->transaction->id ?>">
            <input type="hidden" name="item_id" value="<?= $data->transaction->item_id ?>">
            <div class="col-md-12 ">
                <input onfocus="this.style.color='#000000'" class="form-control" type="text" placeholder="transaction Title" value="<?= $_GET['item_name'] ?>" disabled>
            </div>

            <div class="col-md-12 ">
                <input onfocus="this.style.color='#000000'" class="form-control" type="text" placeholder="transaction Total" value="$ <?= $data->transaction->total ?>" disabled>
            </div>

            <div class="col-md-12 ">
                <input onfocus="this.style.color='#000000'" class="form-control" type="text" name="quantity" placeholder="<?= $data->transaction->quantity ?>" value="">
                <div class="form-button mt-3">
                    <button type="submit" class="btn btn-warning mt-4 mb-2">Update</button>
                    <a href="/accounts/page" class="btn btn-danger ms-3 mt-4 mb-2">Cancel</a>
                </div>
        </form>
    </div>
</div>