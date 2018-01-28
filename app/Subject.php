<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public    $timestamps = false;
    protected $connection = 'smt_mysql';
    protected $table      = 'smt_application_db';
    protected $primaryKey = 'application_id';
    protected $fillable   = ['application_exam_date'];
    
    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function online_screener_answers()
    {
        return $this->hasMany('App\OnlineScreenerAnswer', 'application_id', 'application_id');
    }

    public function status_display() {
        $displays = Subject::status_displays();
        $key = array_search($this->status, config('enum.subject_status'));
        return $displays[$key];
    }

    public function sex_display() {
        $displays = Subject::sex_displays();
        return $displays[$this->application_sex];
    }

    public function answers_table()
    {
        $oscr = $this->post->project->online_screener;
        $oscr_questions = OnlineScreenerQuestion::where('online_screener_id', $oscr->id)->get();
        $oscr_answers = $this->online_screener_answers;

        $ret = collect([]);

        foreach ($oscr_answers as $answer) {
            $question_key = $ret->search(function ($ret_pair) use ($answer) {
                return $ret_pair['screener_id'] == $answer['screener_id'];
            });

            if ($question_key) {
                $concat_answer = $ret[$question_key]['answer'] . ', ' . $answer['screener_answers'];

                $concat_transform = function ($item, $key) use ($question_key, $concat_answer) {
                    if ($key == $question_key) {
                        $item['answer'] = $concat_answer;
                    }
                    return $item;
                };

                $ret->transform($concat_transform);
            } else {
                $question_key = $oscr_questions->search(function($question) use ($answer) {
                    return $question['id'] == $answer['screener_id'];
                });

                if ($question_key === false) {
                    continue;
                }

                $ret->push([
                        'screener_id' => $answer['screener_id'],
                        'question'    => $oscr_questions[$question_key]['text'],
                        'answer'      => $answer['screener_answers']
                    ]
                );
            }
        }

        return $ret->toArray();
    }

    static public function status_displays()
    {
        return [
            'default'                   => 'Not compatible',
            'phone_1'                   => '1 Phone call',
            'phone_2'                   => '2 Phone call',
            'phone_3'                   => '3 Phone call',
            'booked'                    => 'The appointment is finished',
            'visited'                   => 'First visit',
            'informed_consent_obtained' => 'Consent Acquired',
            'incorporated'              => 'Incorporated',
            'disqualified'              => 'Disqualification',
            'ng'                        => 'NG',
        ];
    }

    static public function sex_displays() {
        $keys = [
            'male'  => '男',
            'female'  => '女',
        ];
        return $keys;
    }
}
