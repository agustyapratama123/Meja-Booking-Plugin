jQuery(document).ready(function($) {
    function loadStep(step, extraData = {}) {
        $.ajax({
            type: 'POST',
            url: MejaBookingData.ajax_url,
            data: {
                action: 'meja_booking_route',
                nonce: MejaBookingData.nonce,
                step: step,
                ...extraData
            },
            success: function(response) {
                if (response.success) {
                    $('#meja-booking-app').html(response.data.html);
                } else {
                    alert('Gagal memuat data.');
                }
            }
        });
    }

    // Inisialisasi langkah pertama
    loadStep('form');

    // Delegasi klik form agar tidak reload
    $(document).on('submit', 'form', function(e) {
        e.preventDefault();

        const formData = $(this).serializeArray();
        const data = {};

        formData.forEach(item => data[item.name] = item.value);

        if ($(this).find('[name="booking_step1_submit"]').length) {
            loadStep('menu', data);
        } else if ($(this).find('[name="booking_step2_submit"]').length) {
            loadStep('cart', data);
        } else if ($(this).find('[name="checkout_submit"]').length) {
            alert('Checkout berhasil (simulasi).');
        }
    });
});
