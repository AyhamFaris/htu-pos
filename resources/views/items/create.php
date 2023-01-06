<div class="create-form">
    <div class="form-items">
        <h2>Create Items</h2>
        <form action="/items/store" method="POST">

            <?php
            if (!empty($_SESSION) && isset($_SESSION['errors']) && !empty($_SESSION['errors'])) : ?>
                <?php foreach ($_SESSION['errors'] as $errors) : ?>
                    <div class='alert alert-danger mb-3' role='alert'>
                        <?= $errors ?>
                    </div>
                <?php endforeach; ?>
            <?php
                $_SESSION['errors'] = null;
            endif; ?>

            <div class="">
                <input style="color: #C0C0C0;" onfocus="this.style.color='#000000'" class="form-control" type="text" name="title" placeholder="Item Title" required>

            </div>

            <div class="mt-3">
                <input style="color: #C0C0C0;" onfocus="this.style.color='#000000'" class="form-control " type="number" name="cost" placeholder="Item Cost" required>
            </div>
            <div class="mt-3">
                <input style="color: #C0C0C0;" onfocus="this.style.color='#000000'" class="form-control" type="number" name="price" placeholder="Item Price" required>

            </div>
            <div class="mt-3">
                <input style="color: #C0C0C0;" onfocus="this.style.color='#000000'" class="form-control" type="number" name="quantity" placeholder="Quantity" required>

            </div>

            <div class="form-button mt-3">
                <button type="submit" class="btn btn-success mt-4 mb-2">Create</button>
                <a href="/items" class="btn btn-danger ms-3 mt-4 mb-2">Cancel</a>
            </div>

        </form>
    </div>
</div>