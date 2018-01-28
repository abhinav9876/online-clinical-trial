<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer status
 * @property string name
 */
class Project extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'projects';

    // Table relationships
    public function maker()
    {
        return $this->hasOne('App\CRO', 'id', 'maker_id');
    }
    public function owner()
    {
        return $this->hasOne('App\CROUser', 'id', 'owner_id');
    }
    public function online_screener()
    {
        return $this->hasOne('App\OnlineScreener', 'project_id', 'id');
    }
    public function smos()
    {
        return $this->hasMany('App\SMOProject');
    }

    public function pros()
    {
        return $this->hasMany('App\PROProject');
    }

    public function is_project_cro($id)
    {
      return $this['cro_id'] == $id;
    }

    public function cro()
    {
        return $this->belongsTo('App\CRO');
    }
    public function posts()
    {
        return $this->hasMany('App\Post', 'project_id', 'id');
    }

    public function openPostsCount()
    {
        $now = date('Y-m-d H:i:s');
        return Post::where('start_recruitment_at', '<=', $now)
            ->where('end_recruitment_at', '>=', $now)
            ->where('project_id', $this->id)
            ->count();
    }
    public function closedPostsCount()
    {
        return Post::where(function($query) {
                $now = date('Y-m-d H:i:s');
                $query->where('start_recruitment_at', '>', $now)
                    ->orWhere('end_recruitment_at', '<', $now);
            })->where('project_id', $this->id)
            ->count();
    }

    public function category_display() {
        $displays = Project::category_displays();
        $key = array_search($this->category, config('enum.project_category'));
        return $displays[$key];
    }

    public function status_display() {
        $displays = Project::status_displays();
        $key = array_search($this->status, config('enum.project_status'));
        return $displays[$key];
    }

    public function drug_type_display() {
        $displays = Project::drug_type_displays();
        $key = array_search($this->drug_type, config('enum.drug_type'));
        return $displays[$key];
    }

    public function drug_info() {
        switch ($this->drug_type) {
            case config('enum.drug_type.umin'):
                $umin = Umin::where('umin_id', $this->drug)->first();
                if ($umin) {
                    return [
                        'title' => $umin->title,
                        'description' => $umin->data->narrative,
                        'inclusion' => $umin->data->key_inclusion,
                        'exclusion' => $umin->data->key_exclusion,
                    ];
                }
                break;
            case config('enum.drug_type.japic'):
                $japic = Japic::where('japic_id', $this->drug)->first();
                if ($japic) {
                    return [
                        'title' => $japic->title,
                        'description' => $japic->data->test_outline,
                        'inclusion' => $japic->data->eligibility,
                        'exclusion' => $japic->data->exclusion,
                    ];
                }
                break;
            case config('enum.drug_type.jmacct'):
                $jmacct = JMACCT::where('jmacct_id', $this->drug)->first();
                if ($jmacct) {
                    return [
                        'title' => $jmacct->title,
                        'description' => $jmacct->objprime,
                        'inclusion' => $jmacct->data->incl,
                        'exclusion' => $jmacct->data->excl,
                    ];
                }
                break;
        }
        return [
            'title' => '',
            'description' => '',
            'inclusion' => '',
            'exclusion' => '',
        ];
    }

    public function form_update(Request $request, CROUser $owner)
    {
        Project::debug_request($request);
        if ($request->action == config('enum.form_action.save')) {
            \DB::transaction(function() use ($request) {
                $this->name = $request->name;
                $this->protocol = $request->protocol;
                $this->drug = $request->drug;
                $this->drug_type = $request->drug_type;
                if ($request->notification_enabled == config('enum.form_checkbox_on')) {
                    $this->notification_enabled = config('enum.project_notification.enabled');
                } else {
                    $this->notification_enabled = config('enum.project_notification.disabled');
                }
                $emails = collect($request->notification_email)->unique();
                $this->notification_email = json_encode($emails);
                if ($request->maker == config('enum.form_select_unselected')) {
                    $this->maker_id = null;
                } else {
                    $this->maker_id = $request->maker;
                }
                $this->category = $request->category;
                $this->status = $request->status;
                $this->save();

                // todo: validation
                $before_smos = $this->smos->pluck('smo_id')->unique();
                $after_smos = collect($request->smo)->unique();
                foreach ($before_smos as $smo_id) {
                    if (!$after_smos->contains($smo_id)) {
                        SMOProject::destroy($this->smos->where('smo_id', $smo_id)->pluck('id')->all());
                    }
                }
                foreach ($after_smos as $smo_id) {
                    if (!$before_smos->contains($smo_id)) {
                        $deleted = SMOProject::withTrashed()->where(['smo_id' => intval($smo_id), 'project_id' => $this->id])->first();
                        if ($deleted) {
                            $deleted->restore();
                        } else {
                            $smo_project = new SMOProject;
                            $smo_project->smo_id = intval($smo_id);
                            $smo_project->project_id = $this->id;
                            $smo_project->save();
                        }
                    }
                }

                if ($this->posts->count() == 0) {
                    if ($request->oscr_panel) {
                        if (!$this->online_screener->is_equal($request)) {
                            $this->online_screener->destroy_questions();
                            $oscr = $this->online_screener;
                            $oscr->create_questions($request);
                        }
                    } else {
                        $this->online_screener->destroy_questions();
                    }
                }
            });
        } else if ($request->action == config('enum.form_action.delete')) {
            \DB::transaction(function() use ($request) {
                $this->delete();
            });
        } else {
            // todo: handle error
        }
    }

    static public function status_displays() {
        $keys = [
            'pending' => '保留中',
            'opening' => '公開中',
            'closed' => '終了',
        ];
        return $keys;
    }

    static public function drug_type_displays() {
        $keys = [
            'japic' => '薬剤コード',
            'umin' => 'UminID',
            'jmacct' => 'JMACCTID',
        ];
        return $keys;
    }

    static public function category_displays() {
        // todo: use resource file
        $keys = [
            'phase_1' => '治験フェーズ1',
            'phase_2' => '治験フェーズ2',
            'phase_3' => '治験フェーズ3',
            'phase_4' => '治験フェーズ4',
            'health_foods' => '健康食品試験',
            'cosmetics' => '化粧品関連試験',
            'clinical_study' => '臨床研究',
            'medical_investigator' => '医師主導型治験',
            'otherwise' => 'その他',
        ];
        return $keys;
    }
    static public function form_create(Request $request, CROUser $owner)
    {
        Project::debug_request($request);
        \DB::transaction(function() use ($request, $owner) {
            $project = new Project;
            $project->owner_id = $owner->id;
            $project->cro_id = $owner->attribute->cro->id;
            $project->name = $request->name;
            $project->protocol = $request->protocol;
            $project->drug = $request->drug;
            $project->drug_type = $request->drug_type;
            if ($request->notification_enabled == config('enum.form_checkbox_on')) {
                $project->notification_enabled = config('enum.project_notification.enabled');
            } else {
                $project->notification_enabled = config('enum.project_notification.disabled');
            }
            // todo: create email table?
            $emails = collect($request->notification_email)->unique();
            $project->notification_email = json_encode($emails);
            if ($request->maker == config('enum.form_select_unselected')) {
                $project->maker_id = null;
            } else {
                $project->maker_id = $request->maker;
            }
            $project->category = $request->category;
            $project->status = config('enum.project_status.pending');
            $project->save();

            // todo: validation
            $smos = collect($request->smo)->unique();
            foreach ($smos as $smo_id) {
                $smo_project = new SMOProject;
                $smo_project->smo_id = intval($smo_id);
                $smo_project->project_id = $project->id;
                $smo_project->save();
            };

            $oscr = new OnlineScreener;
            $oscr->project_id = $project->id;
            $oscr->save();
            $oscr->create_questions($request);
        });
    }
    static public function debug_request(Request $request)
    {
        Log::info('[Request debug start]');
        Log::info('request: '.$request);
        Log::info('action: '.$request->action);
        Log::info('name: '.$request->name);
        Log::info('protocol: '.$request->protocol);
        Log::info('drug: '.$request->drug);
        Log::info('drug_type: '.$request->drug_type);
        Log::info('notification_enabled: '.$request->notification_enabled);
        Log::info('notification_email: '.print_r($request->notification_email, true));
        Log::info('maker: '.$request->maker);
        Log::info('category: '.$request->category);
        Log::info('smo: '.print_r($request->smo, true));
        Log::info('oscr_panel: '.print_r($request->oscr_panel, true));
    }
}
