<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PROProject extends Model
{
    protected $table = 'pro_projects';

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public static function getAllForPROUser($id)
    {
        $pro_id = PROUser::fetch($id)->attribute->pro_id;
        $pro_projects = self::has('project')->where('pro_id', $pro_id)->get();
        $category_labels = Project::category_displays();

        foreach ($pro_projects as $pro_project) {
            $category_label_key = array_search($pro_project->project->category, config('enum.project_category'));
            $pro_project->project->category = $category_labels[$category_label_key];
        }

        return $pro_projects;
    }
}
