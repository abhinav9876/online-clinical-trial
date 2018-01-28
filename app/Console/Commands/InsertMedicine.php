<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App;
use App\Japic;
use App\JapicData;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;
use Illuminate\Support\Facades\Log;

class InsertMedicine extends Command
{
    protected $csv_filename_sample;
    protected $csv_filename_sample_data;

    protected $sample_class;
    protected $sample_data_class;
    protected $sample_id_key;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    private $sample_count = 0;
    private $sample_data_count = 0;
    
    protected $sample_columns;
    protected $sample_skip_columns;
    protected $sample_data_columns;
    protected $sample_data_skip_columns;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->import_sample();
        $this->import_sample_data();
    }
    public function import_sample() {
        $this->info('[Start] import '.$this->sample_class);
        $config = new LexerConfig();
        $config->setDelimiter(",");
        $lexer = new Lexer($config);
        $interpreter = new Interpreter();
        $this->sample_count = 0;
        $interpreter->addObserver(function(array $row) {
            // Skip header
            if ($this->sample_count == 0) {
                $this->sample_count++;
                return;
            }

            //$this->info($this->sample_class.' ID: ' . $row[0]);
            $sample = new $this->sample_class();
            for ($i = 0; $i < count($this->sample_columns); $i++) {
                $key = $this->sample_columns[$i];
                if (!in_array($key, $this->sample_skip_columns)) {
                    $sample->$key = $row[$i];
                }
            }
            $sample->save();
            
            if ($this->sample_count % 100 == 0) {
                $this->info('Data count: ' . $this->sample_count);
            }
            $this->sample_count++;
        });
        $lexer->parse(app_path() . $this->csv_filename_sample, $interpreter);
        $this->info($this->sample_class.' count: ' . $this->sample_count);
        $this->info('[End] import '.$this->sample_class);
    }
    public function import_sample_data() {
        $this->info('[Start] import '.$this->sample_data_class);
        $config = new LexerConfig();
        $config->setDelimiter(",");
        $lexer = new Lexer($config);
        $interpreter = new Interpreter();
        $this->sample_data_count = 0;
        $interpreter->addObserver(function(array $row) {
            // Skip header
            if ($this->sample_data_count == 0) {
                $this->sample_data_count++;
                return;
            }

            $sample_id_index = array_search($this->sample_id_key, $this->sample_data_columns);
            if (!$sample_id_index) {
                $this->info('Not found '.$this->sample_id_key.' key');
                return;
            }
            $sample_id = $row[$sample_id_index];
            $sample = $this->sample_class::where($this->sample_id_key, $sample_id)->first();
            if (!$sample) {
                $this->info('Not found '.$this->sample_id_key.': ' . $sample_id . ' Not found');
                return;
            }

            //$this->info($this->sample_id_key.': ' . $sample_id . ', '.$this->sample_class.' record id: ' . $sample->id);
            $sampled = new $this->sample_data_class();
            $sampled->{$this->sample_id_key} = $sample->id;
            for ($i = 0; $i < count($this->sample_data_columns); $i++) {
                $key = $this->sample_data_columns[$i];
                if (!in_array($key, $this->sample_data_skip_columns)) {
                    $sampled->$key = $row[$i];
                }
            }
            $sampled->save();
            
            if ($this->sample_data_count % 100 == 0) {
                $this->info('Data count: ' . $this->sample_data_count);
            }
            $this->sample_data_count++;
        });
        $lexer->parse(app_path() . $this->csv_filename_sample_data, $interpreter);
        $this->info($this->sample_data_class.' count: ' . $this->sample_data_count);
        $this->info('[End] import '.$this->sample_data_class);
    }
}
