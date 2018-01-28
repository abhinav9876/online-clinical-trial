<?php

use App\SMOProject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DebugSMOProjectSeeder extends Seeder
{
    public function run()
    {
        $smos = DB::table('smos')->select('id')->get()->toArray();
        $projects = DB::table('projects')->select('id')->get()->toArray();

        foreach ($smos as $smo) {
            foreach ($projects as $project) {
                if (rand(0, 1)) {
                    $smo_project = new SMOProject(['smo_id' => $smo->id, 'project_id' => $project->id]);
                    $smo_project->save();
                }
            }
        }
    }
}
