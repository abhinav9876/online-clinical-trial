<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OnlineScreener extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
    public function questions()
    {
        return $this->hasMany('App\OnlineScreenerQuestion');
    }

    public function is_equal(Request $request)
    {
        $new_oscr = $request->oscr_panel;
        $old_oscr = $this->questions;
        if (count($new_oscr) != $old_oscr->count()) return false;

        foreach ($new_oscr as $id => $no) {
            if ($no['question'] != $old_oscr[$id]->text) return false;
            if ($no['answer_type'] != $old_oscr[$id]->answer_type) return false;
            switch ($no['answer_type']) {
                case config('enum.online_screening_answer_type.dropdown'):
                    $nd = collect($no['dropdown_item']);
                    $od = collect(json_decode($old_oscr[$id]->dropdown_values));
                    if ($nd->diff($od)->count() != 0 || $od->diff($nd)->count() != 0) return false;

                    $nd = collect($no['ng_item']);
                    $od = collect(json_decode($old_oscr[$id]->ng_values));
                    if ($nd->diff($od)->count() != 0 || $od->diff($nd)->count() != 0) return false;

                    break;
                case config('enum.online_screening_answer_type.checkbox'):
                    $nc = collect($no['checkbox_item']);
                    $oc = collect(json_decode($old_oscr[$id]->checkbox_values));
                    if ($nc->diff($oc)->count() != 0 || $oc->diff($nc)->count() != 0) return false;

                    $nc = collect($no['ng_item']);
                    $oc = collect(json_decode($old_oscr[$id]->ng_values));
                    if ($nc->diff($oc)->count() != 0 || $oc->diff($nc)->count() != 0) return false;

                    break;
                case config('enum.online_screening_answer_type.freetext'):
                    break;
                case config('enum.online_screening_answer_type.matrix'):
                    $nc = collect($no['matrix_item']);
                    $oc = collect(json_decode($old_oscr[$id]->matrix_question_values));
                    if ($nc->diff($oc)->count() != 0 || $oc->diff($nc)->count() != 0) return false;

                    $nc = collect($no['ng_item']);
                    $oc = collect(json_decode($old_oscr[$id]->ng_values));
                    if ($nc->diff($oc)->count() != 0 || $oc->diff($nc)->count() != 0) return false;

                    break;

                default:
                    break;
            }
        }
        return true;
    }

    public function destroy_questions()
    {
        if ($this->questions->count() == 0) return;
        OnlineScreenerQuestion::destroy($this->questions->pluck('id')->all());
    }

    public function create_questions(Request $request)
    {
        if ($request->oscr_panel) {
            foreach ($request->oscr_panel as $o) {
                $oscr_question = new OnlineScreenerQuestion;
                $oscr_question->online_screener_id = $this->id;
                $oscr_question->text = $o['question'];
                $oscr_question->answer_type = $o['answer_type'];
                if ($o['answer_type'] == config('enum.online_screening_answer_type.dropdown')) {
                    $oscr_question->dropdown_values = json_encode($o['dropdown_item']);
                    $oscr_question->ng_values = json_encode(array_values(array_filter($o['ng_item'])));
                } else if ($o['answer_type'] == config('enum.online_screening_answer_type.checkbox')) {
                    $oscr_question->checkbox_values = json_encode($o['checkbox_item']);
                    $oscr_question->ng_values = json_encode(array_values(array_filter($o['ng_item'])));
                } else if ($o['answer_type'] == config('enum.online_screening_answer_type.matrix')) {
                    echo json_encode($o['matrix_item']);
                    $oscr_question->matrix_question_values = json_encode($o['matrix_item']);
                    $oscr_question->ng_values = json_encode(array_values(array_filter($o['ng_item'])));
                }
                $oscr_question->save();
            }
        }
    }
}
