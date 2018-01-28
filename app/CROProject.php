<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CROProject extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'cro_projects';

    public function cro()
    {
        return $this->belongsTo('App\CRO');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public static function getAllForCROUser($id)
    {
        $cro_id = CROUser::get($id)->attribute->cro_id;
        $cro_projects = CROProject::has('project')->where('cro_id', $cro_id)->get();
        $category_labels = Project::category_displays();

        foreach ($cro_projects as $cro_project) {
            $category_label_key = array_search($cro_project->project->category, config('enum.project_category'));
            $cro_project->project->category = $category_labels[$category_label_key];
        }

        return $cro_projects;
    }
}
