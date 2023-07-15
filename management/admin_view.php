<?php
if (isset($_GET['appointments']) && $_GET['appointments'] = 'none') {
    echo "
    <script>
        alert('No Appointments Going on !');
        window.history.replaceState({}, document.title, window.location.pathname);
    </script>
    ";
    unset($_GET['appointments']);
}
admin::fetch_lawyers($conn);