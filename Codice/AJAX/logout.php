<?php
//elimina la sessione attiva (fa appunto il logout)
//richiamata da JS/logout.js

    header("Content-Type: application/json");

    session_start();

    session_destroy();

    echo json_encode(['success' => true]);