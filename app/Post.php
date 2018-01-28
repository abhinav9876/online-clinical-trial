<?php

namespace App;

use Illuminate\{
    Database\Eloquent\Model,
    Database\Eloquent\SoftDeletes
};

/**
 * @property string $crc_name
 * @property string $crc_email
 * @property string $title
 */
class Post extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $connection = 'pgsql';

    protected $table    = 'posts';
    protected $fillable = [
        'user_id',
        'smo_id',
        'project_id',
        'title',
        'description',
        'facility_name',
        'facility_zip_code',
        'facility_address',
        'facility_address_sup',
        'facility_address_notes',
        'required_no_scr',
        'crc_name',
        'crc_email',
        'selection_criteria',
        'exclusion_criteria',
        'participation_benefits',
        'exam_day_notes',
        'exam_schedule_items',
        'reward_items',
        'required_subject_gender',
        'minimum_subject_age',
        'maximum_subject_age',
        'prefers_hidden_facility_name'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function smo()
    {
        return $this->belongsTo('App\SMO');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function subjects()
    {
        return $this->hasMany('App\Subject');
    }

    public function alertSubjects($thresholdDays = 2)
    {
        $now = new \DateTime();
        $thresholdDays = max(0, floor($thresholdDays));
        $interval = new \DateInterval('P' . $thresholdDays . 'D');
        $threshold = $now->sub($interval)->format('Y-m-d h:i:s');

        $statusArr = [
            config('enum.subject_status.phone_1'),
            config('enum.subject_status.phone_2'),
            config('enum.subject_status.phone_3')
        ];

        return $this->subjects()
            ->where('updated_at', '<', $threshold)
            ->whereIn('status', $statusArr)
            ->orderBy('application_id')
            ->get();
    }

    public function alertTargetEmails()
    {
        $list = [];
        $list[] = new MailUser($this->crc_name, $this->crc_email);
        $project = Post::first()->project;

        if ($project->notification_enabled) {
            $owner = $project->owner;
            $list[] = new MailUser($owner->name, $owner->email);
        }

        $project_admin_emails = json_decode($project->notification_email);
        foreach ($project_admin_emails as $e) {
            $list[] = new MailUser('project担当者', $e);
        }

        return collect($list);
    }

    public static function scopeOpenForSMOUser($query, $id)
    {
        $smo_id = SMOUser::get($id)->attribute->smo_id;
        $now = date('Y-m-d H:i:s');
        return $query
            ->where('start_recruitment_at', '<=', $now)
            ->where('end_recruitment_at', '>=', $now)
            ->where('smo_id', $smo_id)
            ->join('projects', 'posts.project_id', '=', 'projects.id')
            ->select(['posts.id', 'title', 'description', 'crc_name', 'start_recruitment_at', 'end_recruitment_at', 'smo_id', 'projects.name as project_name'])
            ->orderBy('id');
    }

    public static function scopeClosedForSMOUser($query, $id)
    {
        $smo_id = SMOUser::get($id)->attribute->smo_id;
        return $query
            ->where(function($query) {
                $now = date('Y-m-d H:i:s');
                $query->where('start_recruitment_at', '>', $now)
                    ->orWhere('end_recruitment_at', '<', $now);
            })->where('smo_id', $smo_id)
            ->join('projects', 'posts.project_id', '=', 'projects.id')
            ->select(['posts.id', 'title', 'description', 'crc_name', 'start_recruitment_at', 'end_recruitment_at', 'smo_id', 'projects.name as project_name'])
            ->orderBy('id');
    }

    public static function getAllInProjectsForSMOUser($project_id, $user_id)
    {
        $smo_id = SMOUser::get($user_id)->attribute->smo_id;
        return Post::where('smo_id', $smo_id)
            ->where('project_id', $project_id)
            ->orderBy('id')
            ->paginate(env('LIST_ITEMS_PER_PAGE'));
    }

    //CRO user
    public static function scopeOpenForCROUser($query, $id)
    {
        $cro_id = CROUser::get($id)->attribute->cro_id;
        $now = date('Y-m-d H:i:s');
        return $query
            ->where('start_recruitment_at', '<=', $now)
            ->where('end_recruitment_at', '>=', $now)
            ->where('cro_id', $cro_id)
            ->join('projects', 'posts.project_id', '=', 'projects.id')
            ->select(['posts.id', 'title', 'description', 'crc_name', 'start_recruitment_at', 'end_recruitment_at', 'smo_id', 'projects.name as project_name'])
            ->orderBy('id');
    }

    public static function getAllInProjectsForCROUser($project_id, $user_id)
    {
        $cro_id = CROUser::get($user_id)->attribute->cro_id;
        return Post::where('project_id', $project_id)
            ->orderBy('id')
            ->paginate(env('LIST_ITEMS_PER_PAGE'));
    }
    
    public static function getProjectsForCROUser($user_id)
    {
        $cro_id = CROUser::get($user_id)->attribute->cro_id;
        return Post::where('cro_id', $cro_id)
            ->orderBy('id')
            ->paginate(env('LIST_ITEMS_PER_PAGE'));
    }
    //end

}
