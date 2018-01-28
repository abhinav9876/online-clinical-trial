<?php

return [
    'user_status'                  => [
        'inactive' => 0,
        'active'   => 1,
    ],
    'user_type'                    => [
        'admin' => 0,
        'cro'   => 1,
        'smo'   => 2,
        'pro'   => 3
    ],
    'cro_user_type'                => [
        'admin'  => 0,
        'member' => 1,
    ],
    'smo_user_type'                => [
        'admin'  => 0,
        'member' => 1,
    ],
    'pro_account_type'             => [
        'admin'  => 0,
        'member' => 1,
    ],
    'cro_type'                     => [
        'cro'   => 0,
        'maker' => 1,
    ],
    'drug_type'                    => [
        'japic'  => 0,
        'umin'   => 1,
        'jmacct' => 2,
    ],
    // Project model
    'project_category'             => [
        'phase_1'              => 0,
        'phase_2'              => 1,
        'phase_3'              => 2,
        'phase_4'              => 3,
        'health_foods'         => 4,
        'cosmetics'            => 5,
        'clinical_study'       => 6,
        'medical_investigator' => 7,
        'otherwise'            => 8,
    ],
    'project_notification'         => [
        'disabled' => 0,
        'enabled'  => 1,
    ],
    'project_status'               => [
        'pending' => 0,
        'opening' => 1,
        'closed'  => 2,
    ],
    'online_screening_answer_type' => [
        'dropdown' => 0,
        'checkbox' => 1,
        'freetext' => 2,
        'matrix'   => 3,
    ],
    'subject_status'               => [
        'default'                   => 0,
        'phone_1'                   => 1,
        'phone_2'                   => 2,
        'phone_3'                   => 3,
        'booked'                    => 4,
        'visited'                   => 5,
        'informed_consent_obtained' => 6,
        'incorporated'              => 7,
        'disqualified'              => 8,
        'ng'                        => 9,
    ],
    'subject_sex'                  => [
        'male'   => 0,
        'female' => 1
    ],
    'post_gender_conditions'       => [
        'male'   => 0,
        'female' => 1,
        'any'    => 2
    ],
    'form_checkbox_on'             => 1,
    'form_select_unselected'       => -1,
    'form_action'                  => [
        'save'   => 0,
        'delete' => 1,
    ],
];
