jQuery(document).ready(function ($) {
  function loadDashboardPage(page = "home") {
    $.ajax({
      type: "POST",
      url: MejaBookingData.ajax_url,
      data: {
        action: "meja_dashboard_route",
        nonce: MejaBookingData.nonce,
        page: page,
      },
      success: function (response) {
        if (response.success) {
          $("#dashboard-app").html(response.data.html);
        } else {
          alert("Gagal memuat data dashboard.");
        }
      },
    });
  }

  // Inisialisasi halaman awal dashboard
  loadDashboardPage();

  // Navigasi klik menu dashboard
  $(document).on("click", ".dashboard-nav a", function (e) {
    e.preventDefault();
    const target = $(this).data("page");
    loadDashboardPage(target);
  });
});
