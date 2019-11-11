$(() => {
    $("#add-to-cart, .add").on({
        click: function (e) {
            const id = $(e.target).data('id');

            console.log(id, e.target);
            const request = $.ajax(`/api/cart/?action=add&id=${id}`, {
                type: "GET",
            });
            request.done(function (answer) {
                    if ($(e.target).hasClass('add')) {
                        const product = $(`#product_id-${$(e.target).data('id')}`);

                        let product_price = product.data('price'),
                            product_count = product.data('count');

                        product.data('count', ++product_count);
                        product
                            .find('#prod-count')
                            .text(product.data('count'));
                        product
                            .find('#prod-sum')
                            .text(` ${product.data('count') * product_price} р.`);
                    }
                    $('a#cart-menu span').text(answer['count']);
                    // console.log(answer);
                },
            );
            request.fail(function (answer) {
                    alert(answer['message']);
                    // console.log(answer);
                },
            )
        }
    });
    $(".del").on({
        click: function (e) {
            const id = $(e.target).data('id');

            const request = $.ajax(`/api/cart/?action=del&id=${id}`, {
                type: "GET",
            });
            request.done(function (answer) {
                    const product = $(`#product_id-${$(e.target).data('id')}`);

                    let product_price = product.data('price'),
                        product_count = product.data('count');

                    product.data('count', --product_count);

                    if (product.data('count') === 0) {
                        product.remove();
                    }

                    product
                        .find('#prod-count')
                        .text(product.data('count'));
                    product
                        .find('#prod-sum')
                        .text(` ${product.data('count') * product_price} р.`);
                    $('a#cart-menu span').text(answer['count']);
                    console.log(answer);
                },
            );
            request.fail(function (answer) {
                    alert(answer['message']);
                    console.log(answer);
                },
            )
        }
    });
});