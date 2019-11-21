'use strict';

$(() => {
    const lockButton = (button, bool) => $(button).prop('disabled', bool);
    const removeProduct = (product) => product.remove();
    const getProductCount = (product, action) => {
        let productCount = product.data('count');

        if (action === 'add') {
            ++productCount;
        } else if (action === 'del') {
            --productCount;
        }

        return productCount;
    };
    const updateProductCount = (product, productCount) => product.data('count', productCount);
    const formatSum = (sum) => sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    const getProductSum = (productPrice, productCount) => {
        return formatSum(productCount * productPrice);
    };
    const getTotalSum = () => {
        let total = 0;

        $('.prod-sum span').each(function (indx, elem) {
            total += +($(elem).text().replace(/\s+/g, ''));
        });

        return formatSum(total);
    };
    const rerenderProductPrice = (product, productCount, productSum) => {
        product
            .find('.prod-count')
            .text(productCount);
        product
            .find('.prod-sum span')
            .text(productSum);
    };
    const rerenderCartCount = (cartCount) => {
        $('a#cart-menu span').text(cartCount > 0 ? cartCount : '');
    };
    const renderTotalSum = (totalSum) => {
        $('.cart-total_container span').text(totalSum);
    };
    const checkAvailabilityGoodsInCart = () => {
        if (!($('.product').length)) {
            rerenderCart();
        }
    };
    const rerenderCart = () => {
        const message = $('<div />', {
            text: 'Ваша корзина пуста!',
            class: 'cart_message'
        });
        $('.cart-product_container')
            .text('')
            .append(message);
        $('.cart-form_container').remove();
        $('.cart-total_container').parent().remove();
    };
    const countActionRun = (data, id, action) => {
        rerenderCartCount(data['count']);

        const product = $(
            `#product_id-${id}`
        );

        if (!product.length) return;

        const productCount = getProductCount(product, action);

        if (productCount <= 0) {
            removeProduct(product);
            checkAvailabilityGoodsInCart();
        } else {
            const productSum = getProductSum(product.data('price'), productCount);

            updateProductCount(product, productCount);
            rerenderProductPrice(product, productCount, productSum);
        }

        renderTotalSum(getTotalSum());
    };

    checkAvailabilityGoodsInCart();

    $("#add-to-cart, .product-count-action").on({
        click: function (e) {
            const id = $(e.target).data('id');
            const action = $(e.target).data('action');

            lockButton(e.target, true);

            const request = $.ajax(
                `/api/cart/?action=${action}&id=${id}`,
                {
                    type: "GET",
                    dataType: "json",
                    success: data => {
                        console.log(data);
                        lockButton(e.target, false);
                        countActionRun(data, id, action);
                    }
                });
        }
    });

    $('#checkout').on({
        click: function (e) {
            e.preventDefault();

            const email = $('[type="email"]').val();

            if (email === '') {
                alert('Введите e-mail!');
                return;
            }

            const request = $.ajax(
                `/api/order/?action=checkout`,
                {
                    type: "POST",
                    dataType: "json",
                    data: JSON.stringify({
                        email: email,
                    }),
                    success: data => {
                        console.log(data);
                        rerenderCart();
                        rerenderCartCount(0);
                        alert(`Ваш заказ зарегистрирован под номером ${data['order_num']}`);
                    }
                });
        }
    })
});
