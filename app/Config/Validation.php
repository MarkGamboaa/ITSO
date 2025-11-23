<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    // for adding user
    public array $user = [
        'first_name' => 'required|min_length[2]',
        'last_name'  => 'required|min_length[2]',
        'email'      => 'required|valid_email|is_unique[users.email,user_id,{user_id}]',
        'role' => 'required|in_list[ITSO,Associate,Student]'
    ];
    
    public array $user_update = [
        'first_name' => 'required|min_length[2]',
        'last_name'  => 'required|min_length[2]',
        'email'      => 'required|valid_email',
        'role'       => 'required|in_list[ITSO,Associate,Student]'
    ];

    public array $reservation = [
        'email'         => 'required|valid_email',
        'equipment_id'  => 'required|integer|is_not_unique[equipment.equipment_id]',
        'quantity'      => 'required|integer|greater_than[0]'
    ];

    public array $reservation_errors = [
        'email' => [
            'required' => 'Email is required.',
            'valid_email' => 'Please provide a valid email address.'
        ],
        'equipment_id' => [
            'required' => 'Equipment selection is required.',
            'is_not_unique' => 'Invalid equipment selected.'
        ],
        'quantity' => [
            'required' => 'Quantity is required.',
            'greater_than' => 'Quantity must be greater than 0.'
        ]
    ];

    public array $borrow_rules = [
        'email'          => 'required|valid_email',
        'equipment_id'   => 'required|integer|is_not_unique[equipment.equipment_id]',
        'borrow_quantity'=> 'required|integer|greater_than[0]',
    ];

    public array $password_reset = [
        'new_password' => 'required|min_length[8]|max_length[255]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]+$/]',
        'confirm_password' => 'required|matches[new_password]'
    ];

    public array $password_reset_errors = [
        'new_password' => [
            'required' => 'Password is required.',
            'min_length' => 'Password must be at least 8 characters long.',
            'max_length' => 'Password cannot exceed 255 characters.',
            'regex_match' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character (@$!%*?&#).'
        ],
        'confirm_password' => [
            'required' => 'Please confirm your password.',
            'matches' => 'Passwords do not match.'
        ]
    ];

    public array $equipment = [
    'name'            => 'required|min_length[2]',
    'total_count'     => 'required|integer|greater_than[0]',
    'available_count' => 'required|integer|greater_than_equal_to[0]',
    'is_active'       => 'in_list[0,1]',
    'accessories'     => 'permit_empty|string'
];

    
}
