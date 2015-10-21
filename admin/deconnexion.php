<?php
    header('WWW-Authenticate: Basic realm="administration sliders"');
    header('HTTP/1.0 401 Unauthorized');
    echo '<script type="text/javascript">
             window.location.href = "http://www.nidtropical.com/";
          </script>';
    exit();
?>

