<?php

namespace AIFB\BreakdanceCustomConditions;

/**
 * Register a custom condition to control element visibility based on cookie values.
 */
add_action(
    'breakdance_register_template_types_and_conditions',
    function() {
        \Breakdance\ConditionsAPI\register(
            [
                'supports' => ['element_display'],
                'slug' => 'breakdance-extend-conditions-cookie-aifb',
                'label' => 'Controllo Cookie',
                'category' => 'Controllo Cookie',
                'operands' => ['equals', 'not equals'],
                'allowMultiselect' => false,
                'callback' => function(string $operand, $value) {
                    // Sanitize the user input value
                    $sanitizedValue = sanitize_text_field($value); 
                    
                    // Explode the sanitized value to separate cookie name and cookie value
                    $explodedValue = explode(':', $sanitizedValue);
                    
                    // Check if the exploded value has the correct format "name:value"
                    if (count($explodedValue) != 2) {
                        // Return false if the format is incorrect
                        return false;
                    }
                    
                    // Extract the cookie name and value from the exploded value
                    $cookieName = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '', $explodedValue[0]));
                    $cookieValueToCompare = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '', $explodedValue[1]));
                    
                    // Check if a cookie with the specified name is set
                    if (isset($_COOKIE[$cookieName])) {
                        // Sanitize the cookie value
                        $actualCookieValue = sanitize_text_field($_COOKIE[$cookieName]);
                        
                        // Check if the operand is 'equals' and return true if the actual cookie value matches the specified cookie value
                        if ($operand === 'equals') {
                            return $actualCookieValue === $cookieValueToCompare;
                        }
                        
                        // Check if the operand is 'not equals' and return true if the actual cookie value does not match the specified cookie value
                        if ($operand === 'not equals') {
                            return $actualCookieValue !== $cookieValueToCompare;
                        }
                    }
                    
                    // Return false if no conditions are met
                    return true;
                },
            ]
        );
    }
);