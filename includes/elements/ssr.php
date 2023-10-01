<?php

// Sanitizzazione e validazione dei dati
$cookie_name = isset($propertiesData['data_of_cookie']['name_of_cookie']) ? sanitize_text_field($propertiesData['data_of_cookie']['name_of_cookie']) : null;
$cookie_value = isset($propertiesData['data_of_cookie']['value_of_cookie']) ? sanitize_text_field($propertiesData['data_of_cookie']['value_of_cookie']) : null;
$cookie_expiry_date = isset($propertiesData['data_of_cookie']['date_of_cookie']) ? sanitize_text_field($propertiesData['data_of_cookie']['date_of_cookie']) : null;

// Verifica se le informazioni sul cookie sono presenti
if ($cookie_name && $cookie_value && $cookie_expiry_date) {
    // Controlla se il cookie esiste già
    if (isset($_COOKIE[$cookie_name])) {
        // Aggiorna il cookie esistente con nuovi valori
        setcookie(
            $cookie_name,
            $cookie_value,
            [
                'expires' => strtotime($cookie_expiry_date),
                'path' => '/',
                'secure' => false,  // Abilita solo se il tuo sito è su HTTPS
                'httponly' => false, // Il cookie sarà accessibile solo attraverso il protocollo HTTP
                'samesite' => 'Strict' // Restringi a Strict o Lax, a seconda delle tue necessità
            ]
        );
    } else {
        // Imposta un nuovo cookie
        setcookie(
            $cookie_name,
            $cookie_value,
            [
                'expires' => strtotime($cookie_expiry_date),
                'path' => '/',
                'secure' => false,  // Abilita solo se il tuo sito è su HTTPS
                'httponly' => false, // Il cookie sarà accessibile solo attraverso il protocollo HTTP
                'samesite' => 'Strict' // Restringi a Strict o Lax, a seconda delle tue necessità
            ]
        );
    }
}

// Qui puoi includere il resto del codice che genera l'HTML per questo elemento
// ...