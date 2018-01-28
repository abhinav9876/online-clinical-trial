<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Japic;
use App\JapicData;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;
use Illuminate\Support\Facades\Log;

class InsertJapic extends InsertMedicine
{
    protected $csv_filename_sample = '/../database/master_data/sample_japic.csv';
    protected $csv_filename_sample_data = '/../database/master_data/sample_japic_data.csv';
    
    protected $sample_class = 'App\Japic';
    protected $sample_data_class = 'App\JapicData';
    protected $sample_id_key = 'japic_id';
    
    protected $signature = 'insert-japic:run';
    protected $description = 'Insert Japic data';

    protected $sample_columns = [
        'date', // skip
        'japic_id', // naming warning
        'owner',
        'title',
        'update_date', // skip
        'url',
    ];
    protected $sample_skip_columns = [
        'date',
        'update_date',
    ];
    protected $sample_data_columns = [
        'areas',
        'co_developer',
        'company',
        'company_sec',
        'contact',
        'contact_sec',
        'date', // skip
        'department',
        'department_sec',
        'design',
        'disease',
        'eligibility',
        'evaluation',
        'exam_status',
        'examiner',
        'exclusion',
        'facility',
        'medic',
        'period',
        'phase',
        'status',
        'target',
        'test_outline',
        'test_purpose',
        'test_type',
        'title',
        'title_short',
        'japic_id', // skip, naming warning
    ];
    protected $sample_data_skip_columns = [
        'date',
        'japic_id',
    ];

    public function __construct()
    {
        parent::__construct();
    }
}
