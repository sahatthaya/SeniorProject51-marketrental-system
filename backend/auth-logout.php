<?php
if (session_start()&&session_destroy()){
include "./1-import-link.php";
    echo "<script>logoutsuccess(); </script> ";
}
