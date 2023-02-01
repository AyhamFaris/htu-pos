const url = "https://funny-bhabha.165-232-116-43.plesk.page";

//ajax chart
if (window.location.href === url+"/dashboard") {
  $.ajax({
    type: "get",
    url: url+"/api/selling/item/quantity",
    success: function (response) {
      var barColors = [];

      for (let index = 0; index < response.body.length; index++) {
        barColors.push("#" + Math.floor(Math.random() * 16777215).toString(16));
      }

      var xValues = [];
      var yValues = [];
      response.body.forEach((element) => {
        xValues.push(element.title);
        yValues.push(parseInt(element.quantity));
      });
      yValues.push(parseInt(5));
      new Chart("myChart", {
        type: "bar",
        data: {
          labels: xValues,
          datasets: [
            {
              backgroundColor: barColors,
              data: yValues,
            },
          ],
        },
        options: {
          legend: {
            display: false,
          },
          title: {
            display: true,
            text: "Items Quantity",
          },
        },
      });
      console.log(response);
    },
  });
}

//Selling Dashboard
if (window.location.href === url+"/selling/page") {
  var user_id = $("#user_id");
  var item_id;
  const items = $("#items");
  const quanitiy = $("#quantity");
  var quantity_item;
  const price = $("#price");
  const addItem = $("#add-item");
  const table = $("tbody");
  const totalSalesElement = $("#total-sales");
  let totalSales = 0;
  var Actual_item_quantity;

  // View the dashboard sale page
  $.ajax({
    type: "get",
    url: url+"/api/selling",
    success: function (response) {
      i = 1;
      response.body.forEach((element) => {
        table.append(`
                  <tr id= "${element.id}">
                      <td>${i++}</td>
                      <td>${element.title_name}</td>
                      <td>${element.quantity}</td>
                      <td>$ ${element.total}</td>
                      <td>
                      <a data-id="${
                        element.id
                      }"><i id="trash" class="fa-solid fa-x pe-3"></i></a>
                      <a href="/transactions/edit?id=${element.id}&item_id=${
          element.item_id
        }"><i id="edit" class="fa-solid fa-pen-to-square"></i></a>
                      </td>
                  </tr>
                  `);
        $(`a[data-id="${element.id}"]`).click(function () {
          let data = {
            id: element.id,
            item_id: element.item_id,
            quantity: element.quantity,
          };
          $.ajax({
            type: "post",
            url: url+"/api/selling/delete",
            data: JSON.stringify(data),
            success: function (response) {
              alertify.set("notifier", "position", "top-right");
              alertify.success("The Transaction Deleted");
              $(`tr[id=${element.id}]`).remove();
            },
            error: function (e) {},
          });
        });
        totalSales = parseInt(totalSales) + parseInt(element.total);
      });

      totalSalesElement.text(totalSales);
    },
  });

  // View all items
  $.ajax({
    type: "get",
    url: url+"/api/items",
    success: function (response) {
      var id_data = 1;
      response.body.forEach((element) => {
        $(items).append(`
                  <option id = "${id_data++}" value = ${element.id}> ${
          element.title
        }</option>
                  `);
      });
    },
  });

  //The quantity of the element and the changes taking place on it
  items.change(function () {
    item_id = $(this).children(":selected").attr("value");
    $.ajax({
      type: "post",
      url: url+"/api/item",
      data: JSON.stringify({ id: item_id }),
      success: function (response) {
        quanitiy.attr({
          max: response.body.quantity,
          value: quanitiy.val(), // substitute your own         // values (or variables) here
        });

        quanitiy.change(function () {
          quantity_item = quanitiy.val();
          Actual_item_quantity = response.body.quantity;

          price.attr({
            value: response.body.price * quantity_item, // substitute your own         // values (or variables) here
          });
        });
      },
    });
  });

  //Add a new item
  addItem.click(function (e) {
    e.preventDefault();
    let data = {
      item_id: item_id,
      quantity: quantity_item,
      Actual_quantity: Actual_item_quantity,
      total: price.val(),
      user_id: user_id.val(),
    };
    if (data.quantity == 0) {
      alertify.set("notifier", "position", "top-right");
      alertify.error("The required quantity is zero");
    } else if (data.quantity > data.Actual_quantity) {
      alertify.set("notifier", "position", "top-right");
      alertify.error("The required quantity is not available");
    } else if (data.Actual_quantity == 0) {
      alertify.set("notifier", "position", "top-right");
      alertify.error("The Item is Empty");
    } else {
      $.ajax({
        type: "post",
        url: url+"/api/selling/create",
        data: JSON.stringify(data),
        success: function (response) {
          alertify.set("notifier", "position", "top-right");
          alertify.success("The Transaction Added");
          i = 1;
          response.body.forEach((element) => {
            table.append(`
                  <tr id= "${element.id}">
                      <td>${i++}</td>
                      <td>${element.title_name}</td>
                      <td>${element.quantity}</td>
                      <td>$ ${element.total}</td>
                      <td>
                      <a data-id="${
                        element.id
                      }"><i id="trash" class="fa-solid fa-x pe-3"></i></a>
                      <a href="/transactions/edit?id=${element.id}&item_id=${
              element.item_id
            }"><i id="edit" class="fa-solid fa-pen-to-square"></i></a>
                      </td>
                  </tr>
                  `);
            $(`a[data-id="${element.id}"]`).click(function () {
              let data = {
                id: element.id,
                item_id: element.item_id,
                quantity: element.quantity,
              };
              $.ajax({
                type: "post",
                url: url+"/api/selling/delete",
                data: JSON.stringify(data),
                success: function (response) {
                  alertify.set("notifier", "position", "top-right");
                  alertify.success("The Transaction Deleted");
                  $(`tr[id="${element.id}"]`).remove();
                },
                error: function (e) {},
              });
            });
            totalSales = parseInt(totalSales) + parseInt(element.total);
          });
          totalSalesElement.text(totalSales);
        },
        error: function (e) {
          alertify.set("notifier", "position", "top-right");
          alertify.error("The Item is Empty");
        },
      });
    }
  });
}

// Title
const Title = () => {
  let title_name = document.createElement("title");
  title_name.textContent = `${document.location.pathname
    .slice(1)
    .replace("/", " ")}`;
  document.head.appendChild(title_name);
};
Title();
