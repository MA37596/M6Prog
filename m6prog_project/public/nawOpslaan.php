<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
        echo '<table>';
        echo '<tr><th>Veld</th><th>Waarde</th></tr>';
        foreach ($_POST as $key => $value) {
            echo '<tr><td>' . htmlspecialchars($key) . '</td><td>' . htmlspecialchars($value) . '</td></tr>';
        }
        echo '</table>';
    } else {
        echo '<p>Er zijn geen gegevens ontvangen.</p>';
    }




    $naam = '';
    if ( empty( $_POST['naam']) ) {
        echo '<b style="color:#f00;">Je moet wel je naam invullen</b>';
    } else {
        $naam = $_POST['naam'];
    }
 
    echo '<br>';
    
    ?>