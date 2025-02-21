
@include('layouts.partials.header')
<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->
<main class="main" id="top">

  @include('layouts.partials.topbar')

  @yield('content')

  <script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".toggle-status").forEach((toggle) => {
            toggle.addEventListener("change", function () {
                let shopId = this.getAttribute("data-shop-id");
                let isOpen = this.checked ? 1 : 0;

                fetch(`/shops/${shopId}/toggle-status`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    },
                    body: JSON.stringify({ is_open: isOpen }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        let statusLabel = this.closest(".ms-auto").querySelector(".status-label");
                        statusLabel.textContent = isOpen ? "Open" : "Closed";
                        statusLabel.classList.toggle("bg-success", isOpen);
                        statusLabel.classList.toggle("bg-danger", !isOpen);
                    } else {
                        alert("Failed to update shop status");
                    }
                })
                .catch(error => console.error("Error:", error));
            });
        });
    });
</script>
</main>
<!-- ===============================================-->
<!--    End of Main Content-->
<!-- ===============================================-->
@include('layouts.partials.footer')