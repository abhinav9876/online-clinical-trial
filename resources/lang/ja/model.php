<?php

return [
    'cro_type'           => [
        'cro'   => 'CRO',
        'maker' => 'Pharmaceutical companies',
    ],
    'user_status'        => [
        'inactive' => '無効',
        'active'   => '有効',
    ],
    'user'               => [
        'id'                    => 'ID',
        'name'                  => 'name',
        'email'                 => 'mail address',
        'password'              => 'password',
        'password_confirmation' => 'password(confirmation)',
        'status'                => 'Status',
        'status_enabled'        => '有効',
        'status_disabled'       => '無効'
    ],
    'cro_user_attribute' => [
        'position'     => 'Position',
        'account_type' => '種別',
    ],
    'smo_user_attribute' => [
        'position'     => 'Position',
        'account_type' => '種別',
    ],
    'pro_user_attribute' => [
        'position'     => 'Position',
        'account_type' => '種別',
    ],
    'cro'                => [
        'zip_code'      => '郵便番号',
        'address'       => 'Street address1',
        'address_sup'   => 'Street address2',
        'address_notes' => 'Remarks'
    ],
    'post'               => [
        'title'                          => 'Test Title',
        'description'                    => '試験概要',
        'facility_name'                  => '施設 name',
        'id'                             => 'ID',
        'selection_criteria'             => '選択基準',
        'exclusion_criteria'             => '除外基準',
        'participation_benefits'         => '試験参加メリット',
        'exam_day_notes'                 => 'Examination dateの注意事項',
        'start_recruitment_at'           => '募集開始',
        'end_recruitment_at'             => '募集終了',
        'required_no_scr'                => '必要SCR数',
        'crc_name'                       => '担当CRC name',
        'crc_email'                      => '担当CRCmail address',
        'exam_schedule_items'            => '実施スケジュール',
        'exam_schedule_items_label'      => 'ラベル',
        'reward_items'                   => '負担軽減費/協力費',
        'facility_zip_code'              => '郵便番号',
        'facility_address'               => 'Street address1',
        'facility_address_sup'           => 'Street address2',
        'facility_address_notes'         => 'Remarks',
        'required_subject_gender'        => '治験者gender',
        'required_subject_gender_male'   => '男性',
        'required_subject_gender_female' => '女性',
        'required_subject_gender_any'    => 'どちらでも可能',
        'minimum_subject_age'            => '',
        'maximum_subject_age'            => ''
    ],
    'project'            => [
        'id'        => 'ID',
        'name'      => 'Disease name',
        'protocol'  => 'Protocol number',
        'category'  => 'カテゴリー',
        'status'    => 'Status',
        'drug_type' => '薬剤DB 種別',
        'drug'      => '薬剤DB ID'
    ],
    'pro'                => [
        'name'          => 'Organization name',
        'address'       => 'Street address1',
        'zip_code'      => '郵便番号',
        'address_sup'   => 'Street address2',
        'address_notes' => 'Remarks',
        'contact'       => 'contact information'
    ]
];
