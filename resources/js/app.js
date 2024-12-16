import './bootstrap';

import Alpine from 'alpinejs';

import Chart from 'chart.js/auto';
window.Alpine = Alpine;

Alpine.start();
$(document).ready(function() {
    // Handle Increase/Decrease Quantity
    $(document).on('click', '.adjust-quantity', function() {
        var productId = $(this).data('id');
        var action = $(this).data('action');
        var quantityInput = $(this).siblings('input');
        var currentQuantity = parseInt(quantityInput.val());

        // Calculate new quantity
        var newQuantity = action === 'increase' ? currentQuantity + 1 : (currentQuantity > 1 ? currentQuantity - 1 : 1);

        // Send AJAX request to update quantity
        $.ajax({
            url: `/cart/update/${productId}`, // Use a template literal for URL
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                quantity: newQuantity
            },
            success: function(response) {
                if (response.success) {
                    // Update quantity in the input field
                    quantityInput.val(newQuantity);
                    // Optionally update total price or other elements
                } else {
                    alert(response.message); // Optional: handle errors or messages
                }
            },
            error: function(xhr) {
                console.error('AJAX Error:', xhr.responseText);
            }
        });
    });
});

