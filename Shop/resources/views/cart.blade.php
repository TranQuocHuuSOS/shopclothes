<script>
    $(document).ready(function() {
        $('.quantity-minus').click(function() {
            var quantityValue = $(this).next('.quantity-value');
            var currentQuantity = parseInt(quantityValue.text());

            if (currentQuantity > 1) {
                quantityValue.text(currentQuantity - 1);
                updateTotalPrice(-1, $(this));
            }
        });

        $('.quantity-plus').click(function() {
            var quantityValue = $(this).prev('.quantity-value');
            var currentQuantity = parseInt(quantityValue.text());

            quantityValue.text(currentQuantity + 1);
            updateTotalPrice(1, $(this));
        });

        function updateTotalPrice(quantityChange, button) {
            var productPrice = parseFloat(button.closest('.si-text').find('.product-selected span').text());
            var totalPriceElement = $('.select-total h5');
            var currentTotalPrice = parseFloat(totalPriceElement.text().replace(/[^0-9.-]+/g,""));
            var newTotalPrice = currentTotalPrice + (quantityChange * productPrice);

            totalPriceElement.text(newTotalPrice.toFixed(2) + ' đồng');
        }
    });
</script>
