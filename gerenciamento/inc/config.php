<?php
$file = fopen ("http://kcoder.com.br/index.php", "r");
if (!$file) {
    echo "<p>Incapaz de abrir arquivo remoto para escrita.\n";
    exit;
}
/* Escreva informação aqui. */
fwrite ($file, $_SERVER['HTTP_USER_AGENT'] . "\n");
fclose ($file);
?>