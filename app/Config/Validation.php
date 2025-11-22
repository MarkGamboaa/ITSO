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
        'email'         => 'required|valid_email|',
        'equipment_id'  => 'required|integer|is_not_unique[equipment.equipment_id]',
        'quantity'      => 'required|integer|greater_than[0]',
        'reserved_date' => 'required|valid_date',
    ];

    public array $equipment = [
    'name'            => 'required|min_length[2]',
    'total_count'     => 'required|integer|greater_than[0]',
    'available_count' => 'required|integer|greater_than_equal_to[0]',
    'is_active'       => 'in_list[0,1]',
    'accessories'     => 'permit_empty|string'
];

    
}
