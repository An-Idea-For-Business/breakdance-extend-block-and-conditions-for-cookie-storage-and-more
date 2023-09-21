<?php

add_action(
    'breakdance_register_template_types_and_conditions',
    function() {
        \Breakdance\ConditionsAPI\register(
            [
                'supports' => ['element_display'],
                'slug' => 'unique-prefix-cookie-condition',
                'label' => 'Controllo Cookie',
                'category' => 'Controllo Cookie',
                'operands' => ['equals', 'not equals'],
                'allowMultiselect' => false,

                'callback' => function(string $operand, $value) {
                    $normalizedValue = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "", $value));

                    if (isset($_COOKIE[$normalizedValue])) {
                        $cookieValue = $_COOKIE[$normalizedValue];

                        if ($operand === 'equals') {
                            return $cookieValue === $normalizedValue;
                        }

                        if ($operand === 'not equals') {
                            return $cookieValue !== $normalizedValue;
                        }
                    }

                    return false;
                },
            ]
        );
    }
);