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
                    // Normalize the value to ensure a consistent format.
                    $normalizedValue = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '', $value));
                    // Check if a cookie with the normalized value is set.
                    if (isset($_COOKIE[$normalizedValue])) {
                        $cookieValue = $_COOKIE[$normalizedValue];
                        // Check if the operand is 'equals' and return true if the cookie value matches the normalized value.
                        if ($operand === 'equals') {
                            return $cookieValue === $normalizedValue;
                        }
                        // Check if the operand is 'not equals' and return true if the cookie value does not match the normalized value.
                        if ($operand === 'not equals') {
                            return $cookieValue !== $normalizedValue;
                        }
                    }
                    // Return false if no conditions are met.
                    return false;
                },
            ]
        );
    }
);