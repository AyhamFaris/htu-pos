
const Add_Title = () => {
    let title_name = document.createElement('title');
    title_name.textContent = `${document.location.pathname.slice(1).replace('/', ' ')}`;
    document.head.appendChild(title_name)
};


Add_Title()


if (window.location.href === 'http://htu.pos/selling/page') {

$(function () {
    var user_id = $('#user_id');
    var item_id;
    var quantity_item;
    const items = $('#items');
    const quanitiy = $('#quantity');
    const price = $('#price');
    const addItem = $('#add-item');
    const table = $('tbody');
    const totalSalesElement = $('#total-sales');
    let totalSales = 0;


    $.ajax({
        type: "get",
        url: "http://htu.pos/api/selling",
        success: function (response) {
            i = 1;
            response.body.forEach(element => {
                table.append(`
                <tr id= "${element.id}">
                    <td>${i++}</td>
                    <td>${element.title_name}</td>
                    <td>${element.quantity}</td>
                    <td>$ ${element.total}</td>
                    <td>
                    <a data-id="${element.id}"><i id="trash" class="fa-solid fa-x pe-3"></i></a>
                    <a href="/transactions/edit?id=${element.id}&item_id=${element.item_id}"><i id="edit" class="fa-solid fa-pen-to-square"></i></a>
                    </td>
                </tr>
                `);
                $(`a[data-id="${element.id}"]`).click(function () {
                    let data = {
                        id: element.id,
                        item_id: element.item_id,
                        quantity: element.quantity
                    };
                    $.ajax({
                        type: "post",
                        url: "http://htu.pos/api/selling/delete",
                        data: JSON.stringify(data),
                        success: function (response) {
                            alertify.set('notifier','position', 'top-right');
                            alertify.success('The Transaction Deleted');
                            $(`tr[id=${element.id}]`).remove();
                        },
                        error: function (e) {
                        }

                    });
                })
                totalSales = parseInt(totalSales) + parseInt(element.total);
            });


            totalSalesElement.text(totalSales);
        }
    });


    $.ajax({
        type: "get",
        url: "http://htu.pos/api/items",
        success: function (response) {
            var id_data = 1;
            response.body.forEach(element => {
                $('#items').append(`
                <option id = "${id_data++}" value = ${element.id}> ${element.title}</option>
                `);
            });
        }
    });

    $("#items").change(function () {
        item_id = $(this).children(":selected").attr("value")
        $.ajax({
            type: "post",
            url: "http://htu.pos/api/item",
            data: JSON.stringify({ id: item_id }),
            success: function (response) {
                $("#quantity").attr({
                    "max": response.body.quantity,
                    "value": $("#quantity").val(),        // substitute your own         // values (or variables) here
                });

                $('#quantity').change(function () {
                    quantity_item = $('#quantity').val(),
                        $("#price").attr({
                            "value": response.body.price * $('#quantity').val(),        // substitute your own         // values (or variables) here
                        });
                });
            },
        });

    });

    addItem.click(function (e) {
        e.preventDefault();
        let data = {
            item_id: item_id,
            quantity: quantity_item,
            total: price.val(),
            user_id: user_id.val(),
        };
        if (data.quantity != 0) {
            $.ajax({
                type: "post",
                url: "http://htu.pos/api/selling/create",
                data: JSON.stringify(data),

                success: function (response) {
                    alertify.set('notifier','position', 'top-right');
                    alertify.success('The Transaction Added');
                    i = 1;
                    response.body.forEach(element => {
                        table.append(`
                <tr id= "${element.id}">
                    <td>${i++}</td>
                    <td>${element.title_name}</td>
                    <td>${element.quantity}</td>
                    <td>$ ${element.total}</td>
                    <td>
                    <a data-id="${element.id}"><i id="trash" class="fa-solid fa-x pe-3"></i></a>
                    <a href="/transactions/edit?id=${element.id}&item_id=${element.item_id}"><i id="edit" class="fa-solid fa-pen-to-square"></i></a>
                    </td>
                </tr>
                `);
                        $(`a[data-id="${element.id}"]`).click(function () {
                            let data = {
                                id: element.id,
                                item_id: element.item_id,
                                quantity: element.quantity
                            };
                            $.ajax({
                                type: "post",
                                url: "http://htu.pos/api/selling/delete",
                                data: JSON.stringify(data),
                                success: function (response) {
                                    alertify.set('notifier','position', 'top-right');
                                    alertify.success('The Transaction Deleted');
                                    $(`tr[id="${element.id}"]`).remove();
                                },
                                error: function (e) {
                                }
                            });
                        })
                        totalSales = parseInt(totalSales) + parseInt(element.total);
                    });
                    totalSalesElement.text(totalSales);

                },
                error: function (e) {
                    alertify.set('notifier','position', 'top-right');
                    alertify.error('The Item is Empty');
                }
            });
        } else {
            alertify.set('notifier','position', 'top-right');
            alertify.notify('You must enter the required quantity or required item');
        }
    });
});
}
