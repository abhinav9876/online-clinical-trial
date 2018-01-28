<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class DebugSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = App\Post::select('id')->get();
        foreach ($posts as $post) {
            factory(App\Subject::class, 20)->create([
                'post_id' => $post->id,
            ]);
        }
        $subjects = App\Subject::all();
        foreach ($subjects as $subject) {
            $project = $subject->post->project;
            $oscr = $subject->post->project->online_screener;

            $oscr_questions = App\OnlineScreenerQuestion::where('online_screener_id', $oscr->id)->get();
            foreach ($oscr_questions as $q) {
                switch ($q->answer_type) {
                    case config('enum.online_screening_answer_type.dropdown'):
                        factory(App\OnlineScreenerAnswer::class, 'dropdown')->create([
                            'subject_id' => $subject->application_id,
                            'online_screener_question_id' => $q->id,
                        ]);
                        break;
                    case config('enum.online_screening_answer_type.checkbox'):
                        factory(App\OnlineScreenerAnswer::class, 'checkbox')->create([
                            'subject_id' => $subject->application_id,
                            'online_screener_question_id' => $q->id,
                        ]);
                        break;
                    case config('enum.online_screening_answer_type.freetext'):
                        factory(App\OnlineScreenerAnswer::class, 'freetext')->create([
                            'subject_id' => $subject->application_id,
                            'online_screener_question_id' => $q->id,
                        ]);
                        break;
                  case config('enum.online_screening_answer_type.matrix'):
                      factory(App\OnlineScreenerAnswer::class, 'matrix')->create([
                          'subject_id' => $subject->application_id,
                          'online_screener_question_id' => $q->id,
                      ]);
                      break;
                    default:
                        break;
                }
            }
        }
    }
}
