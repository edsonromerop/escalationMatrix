<?php 
session_destroy();
echo '
    <script>
        localStorage.clear();
        window.location = "login";
    </script>
';