$('.login').on("click", function(e) {
    e.preventDefault();

    let email = $('input[name="email"]').val(),
        password = $('input[name="password"]').val();

    $.ajax({
        url: 'vendor/signin.php',
        type: 'POST',
        dataType: 'json',
        data: {
            email: email,
            password: password
        },

        success (data) {
            if (data.status) {
                document.location.href = 'profile.php';
            } else {
                // if (data.type == 1) { // не введены все поля
                //     console.log(data.error_fields);
                // }

                $('.msg').removeClass('none').text(data.msg);
            }
        }
    });
});

$('.register').on("click", function(e) {
    e.preventDefault();

    let full_name = $('input[name="full_name"]').val(),
        email = $('input[name="email"]').val(),
        password = $('input[name="password"]').val(),
        password_confirm = $('input[name="password_confirm"]').val();

    $.ajax({
        url: 'vendor/signup.php',
        type: 'POST',
        dataType: 'json',
        data: {
            full_name: full_name,
            email: email,
            password: password,
            password_confirm: password_confirm
        },

        success (data) {
            if (data.status) {
                document.location.href = 'profile.php';
            } else {
                $('.msg').removeClass('none').text(data.msg);
            }
        }
    });
});

let product_img = false;

$('input[name="product_img"]').on("change", function(e) {
    product_img = e.target.files[0];
});

$('input[name="quantity"]').on("change", function(e) {
    let quantity = e.target.valueAsNumber,
        row_id = e.target.id;

    if (quantity < 1) {
        $('input[name="quantity"]').val('1');
        quantity = 1;
    }

    $.ajax({
        url: 'vendor/update_quantity_cart.php',
        type: 'POST',
        dataType: 'json',
        data: {
            quantity: quantity,
            row_id: row_id
        },

        success(data) {
            console.log(data.sum);
            $('.sum').html(`сумма: ${data.sum} руб`);
            // document.getElementsByClassName('class').innerHTML = `${data.sum} руб`;
        }
    });
});

$(document).on("click", ".delete-from-cart", function(e) {
    let row_id = e.target.id;

    $(`tr#${row_id}`).remove();

    $.ajax({
        url: 'vendor/delete_cart_row.php',
        type: 'POST',
        dataType: 'json',
        data: {
            row_id: row_id
        },

        success(data) {
            if (!data.status) {
                document.location.href = 'cart.php';
            } else {
                $('.sum').html(`сумма: ${data.sum} руб`);
            }
        }
    });
});

$(document).on("click", ".add_product", function(e) {
    e.preventDefault();

    let product_name = $('input[name="product_name"]').val(), 
        product_category = $('select[name="product_category"]').val(), 
        product_price = $('input[name="product_price"]').val();
    
    let form = new FormData();
    form.append('product_name', product_name),
    form.append('product_category', product_category),
    form.append('product_price', product_price),
    form.append('product_img', product_img);

    $.ajax({
        url: 'vendor/add_product.php',
        type: 'POST',
        dataType: 'json',
        cache: false,
        processData: false, 
        contentType: false,
        data: form,

        success(data) {
            if (data.status) {
                $('.msg').addClass('none');
                let img = `<td> <img src="${data.path}" height="200"> </td>`,
                    name = `<td> ${data.name} </td>`,
                    price = `<td> ${data.price.replace(/\B(?=(\d{3})+(?!\d))/g, " ")} руб </td>`,
                    category = `<td> ${data.category} </td>`,
                    actions = `<td><a href="edit_panel.php?id=${data.id}">изменить</a><br><a class="delete-from-products" id="${data.id}">удалить</a></td>`;

                $(".products-display-table tbody").append(`<tr id="${data.id}">` + img + name + price + category + actions + `</tr>`);
            } else {
                $('.msg').removeClass('none').text(data.msg);
            }
        }
    });

    delete form;
});

$(document).on("click", ".delete-from-products", function(e) {
    let id = e.target.id;
    
    $(`#${id}`).remove();

    $.ajax({
        url: 'vendor/delete_product.php',
        type: 'POST',
        data: {
            id: id
        }
    })
});

$(document).on("click", ".edit_product", function(e) {
    e.preventDefault();

    let product_name = $('input[name="product_name"]').val(), 
        product_category = $('select[name="product_category"]').val(), 
        product_price = $('input[name="product_price"]').val(),
        product_id = e.target.id;

    let form = new FormData();
    form.append('product_name', product_name),
    form.append('product_category', product_category),
    form.append('product_price', product_price),
    form.append('product_img', product_img);
    form.append('product_id', product_id);
    console.log(form);
    
    $.ajax({
        url: 'vendor/edit_product.php',
        type: 'POST',
        dataType: 'json',
        cache: false,
        processData: false, 
        contentType: false,
        data: form,

        success(data) {
            if (data.status) {
                document.location.href = 'admin_panel.php';
            } else {
                $('.msg').removeClass('none').text(data.msg);
            }
        }
    });

    delete form;
});

$(document).on("click", ".add-to-cart", function(e) {
    e.preventDefault();
    let product_id = e.target.id;

    $.ajax({
        url: 'vendor/add_to_cart.php',
        type: 'POST',
        dataType: 'text',
        data: {
            product_id: product_id
        },

        success(data) {
            document.location.href = 'cart.php';
        }
    })

});

$(document).on("click", ".buy-now", function(e) {
    e.preventDefault();
    let product_id = e.target.id;
});

$(document).on("click", ".buy-cart", function(e) {
    e.preventDefault();
    
    document.location.href = 'order.php';
})

$(document).on("click", ".pay", function(e) {
    
}) 