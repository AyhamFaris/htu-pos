<div class="style-form">
    <div class="form-items">
        <h2>Create User</h2>
        <form action="/users/store" method="POST">
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
                <input style="color: #C0C0C0;" onfocus="this.style.color='#000000'" class="form-control" type="text" name="display_name" placeholder="Display Name" required>
            </div>

            <div class="">
                <input style="color: #C0C0C0;" onfocus="this.style.color='#000000'" class="form-control" type="email" name="email" placeholder="E-mail" required>
            </div>
            <div class=" ">
                <input style="color: #C0C0C0;" onfocus="this.style.color='#000000'" class="form-control" type="text" name="username" placeholder="Username" required>

            </div>
            <div class="">
                <input style="color: #C0C0C0;" onfocus="this.style.color='#000000'" class="form-control" type="password" name="password" placeholder="Password" required>

            </div>

            <div class="">
                <select class="form-select" id="user-role" aria-label="Role" name="role">
                    <option value="admin">Admin</option>
                    <option value="procurement">Procurement</option>
                    <option value="seller">Seller</option>
                    <option value="account">Accountant</option>
                </select>
            </div>


            <div class="form-button mt-3">
                <button type="submit" class="btn btn-success mt-4 mb-2">Create</button>
                <a href="/users" class="btn btn-danger ms-3 mt-4 mb-2">Cancel</a>
            </div>

        </form>
    </div>
</div>