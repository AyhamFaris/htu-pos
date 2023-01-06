<div class="selling-title">
    <h1>Selling Dashboard</h1>
</div>
<hr>
<div class="selling-dashbord">
    <div class="left">
        <form id="userInputContainer">
            <input type="hidden" name="user_id" id="user_id" value="<?= $_SESSION['user']['user_id'] ?>">
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">Items</span>
                <select id="items" class="form-select" aria-label="Default select example">
                    <option selected>Select One Of The Items</option>
                </select>
            </div>
            <div class="input-group flex-nowrap mt-5">
                <span class="input-group-text" id="addon-wrapping">Quantity</span>
                <input id="quantity" value="" type="number" class=" form-control" aria-describedby="addon-wrapping" min="0">
            </div>
            <div class="input-group flex-nowrap mt-5">
                <span class="input-group-text" id="addon-wrapping">Price (JOD)</span>
                <input id="price" type="text" value="" class="form-control" aria-describedby="addon-wrapping" min="0">
            </div>
            <button id="add-item" type="submit" class="btn btn-success mt-2"><i class="fa-solid fa-plus"></i></button>
        </form>
    </div>



    <div class="right">
        <div class="mb-3">
            <strong>Total Sales : $<span id="total-sales"></span></strong>
        </div>
        <div id="scrol-table">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Item</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>