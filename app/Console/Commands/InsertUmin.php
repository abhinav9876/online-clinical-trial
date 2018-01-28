<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Umin;
use App\UminData;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;
use Illuminate\Support\Facades\Log;

class InsertUmin extends InsertMedicine
{
    protected $csv_filename_sample = '/../database/master_data/sample_umin.csv';
    protected $csv_filename_sample_data = '/../database/master_data/sample_umin_data.csv';
    
    protected $sample_class = 'App\Umin';
    protected $sample_data_class = 'App\UminData';
    protected $sample_id_key = 'umin_id';
    
    protected $signature = 'insert-umin:run';
    protected $description = 'Insert Umin data';

    protected $sample_columns = [
        'date', // skip
        'umin_id', // name warning
        'owner',
        'status',
        'title',
        'type',
        'update_date', // skip
        'url',
    ];
    protected $sample_skip_columns = [
        'date',
        'update_date',
    ];
    protected $sample_data_columns = [
        'age_lower',
        'age_upper',
        'arms',
        'basic',
        'basic_design',
        'blinding',
        'blocking',
        'classification_malignancy',
        'classification_specialty',
        'concealment',
        'condition',
        'consideration',
        'control',
        'control_one',
        'date', // skip
        'dynamic',
        'gender',
        'genomic',
        'institute_name',
        'institute_secondery',
        'institutions',
        'intervention',
        'key_exclusion',
        'key_inclusion',
        'name_of_secondary_founder',
        'narrative',
        'others',
        'phase',
        'primary',
        'public_address',
        'public_contact_name',
        'public_division',
        'public_email',
        'public_organisation',
        'public_tel',
        'public_url',
        'randomization',
        'randomization_unit',
        'region',
        'research_address',
        'research_contact_name',
        'research_division_name',
        'research_email',
        'research_organisation',
        'research_tel',
        'secondary',
        'stratification',
        'studytype',
        'target_size',
        'trial_one',
        'trial_two',
        'type_intervention',
        'umin_id', // skip, name warning
    ];
    protected $sample_data_skip_columns = [
        'date',
        'umin_id',
    ];

    public function __construct()
    {
        parent::__construct();
    }
}
