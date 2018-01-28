<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SMOProject extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'smo_projects';

    public function smo()
    {
        return $this->belongsTo('App\SMO');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public static function getAllForSMOUser($id)
    {
        $smo_id = SMOUser::get($id)->attribute->smo_id;
        $smo_projects = SMOProject::has('project')->where('smo_id', $smo_id)->get();
        $category_labels = Project::category_displays();

        foreach ($smo_projects as $smo_project) {
            $category_label_key = array_search($smo_project->project->category, config('enum.project_category'));
            $smo_project->project->category = $category_labels[$category_label_key];
        }

        return $smo_projects;
    }
}
