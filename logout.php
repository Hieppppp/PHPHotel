<?php
    require('admin/inc/enssentials.php');

    session_start();
    session_destroy();
    redirect('index.php');



?>