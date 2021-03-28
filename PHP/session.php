<?php
    session_start([
        'save_handler' => 'redis',
        'save_path' => 'tcp://localhost:6379'
    ]);
    echo session_id()."<br>";
    if (empty($_SESSION['admin'])) {
        $_SESSION['admin'] = [0,1,2,session_id()];
    }
    echo session_id()."<br>";

    