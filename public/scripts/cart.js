$(() => {
    $("#add-to-cart, .product-count-action").on({
        click: function (e) {
            const id = $(e.target).data('id');
            const action = $(e.target).data('action');

            lockButton(e.target, true);

            const request = $.ajax(`/api/cart/?action=${action}&id=${id}`, {
                type: "GET",
                dataType: "json",
                success: data => {
                    rerenderCartCount(data['count']);
                    lockButton(e.target, false);

                    console.log(data);

                    const product = $(`#product_id-${id}`);

                    if (!product.length) return;

                    const productCount = getProductCount(product, action);

                    if (productCount <= 0) {
                        removeProduct(product);
                    } else {
                        const productSum = getProductSum(product.data('price'), productCount);

                        updateProductCount(product, productCount);
                        rerenderProductPrice(product, productCount, productSum);
                    }
                }
            });
        }
    });
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
    const getProductSum = (productPrice, productCount) => {
        return (productCount * productPrice).toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    };
    const rerenderProductPrice = (product, productCount, productSum) => {
        product
            .find('.prod-count')
            .text(productCount);
        product
            .find('.prod-sum')
            .text(` ${productSum} р.`);
    };
    const rerenderCartCount = (cartCount) => {
        $('a#cart-menu span').text(cartCount > 0 ? cartCount : '');
    }
});
