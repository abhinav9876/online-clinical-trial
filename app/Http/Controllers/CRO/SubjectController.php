<?php

namespace App\Http\Controllers\CRO;

use Illuminate\Http\Request;
use App\Mail\SubjectNotification;
use App\Http\Controllers\Controller;

use App;

use App\{
    MailUser, Subject, Post
};

use Illuminate\{
    Pagination\LengthAwarePaginator, Pagination\Paginator, Support\Facades\Auth, Support\Facades\Mail
};

class SubjectController extends Controller
{
    // Debug method
    public function create($post_id, Request $request)
    {
        $this->authorize('create', Subject::class);

        factory(App\Subject::class)->create([
            'post_id' => $post_id,
        ]);
        return redirect($request->redirect);
    }

    public function posts_open()
    {
        $posts = App\Post::openForSMOUser(Auth::id())->get();
        $post_subject_status_map = self::subject_status_map_for_posts($posts);

        $current_page = LengthAwarePaginator::resolveCurrentPage();
        $per_page = intval(env('LIST_ITEMS_PER_PAGE'));
        $current_page_subjects = $posts->slice(($current_page - 1) * $per_page, $per_page)->all();
        $paginated_posts = new LengthAwarePaginator($current_page_subjects, count($posts), $per_page, $current_page, [
            'path' => Paginator::resolveCurrentPath()
        ]);

        return view('smo/subject/posts_open', [
            'activeMenuType' => config('menu.smo.posts_open'),
            'posts'          => $paginated_posts,
            'status_map'     => $post_subject_status_map
        ]);
    }

    public function posts_closed()
    {
        $posts = App\Post::closedForSMOUser(Auth::id())->get();
        $post_subject_status_map = self::subject_status_map_for_posts($posts);

        $current_page = LengthAwarePaginator::resolveCurrentPage();
        $per_page = intval(env('LIST_ITEMS_PER_PAGE'));
        $current_page_subjects = $posts->slice(($current_page - 1) * $per_page, $per_page)->all();
        $paginated_posts = new LengthAwarePaginator($current_page_subjects, count($posts), $per_page, $current_page, [
            'path' => Paginator::resolveCurrentPath()
        ]);

        return view('smo/subject/posts_closed', [
            'activeMenuType' => config('menu.smo.posts_closed'),
            'posts'          => $paginated_posts,
            'status_map'     => $post_subject_status_map
        ]);
    }

    public function post_subjects($id)
    {
        $post = Post::find($id);
        $this->authorize('subject_index', $post);

        $subjects = Subject::where('post_id', $id)
            ->orderBy('application_date', 'desc')
            ->get();

        $post_subject_status_map = collect(config('enum.subject_status'))->mapWithKeys(function ($status) use ($subjects) {
            return [$status => collect($subjects)->where('status', $status)->count()];
        });

        $current_page = LengthAwarePaginator::resolveCurrentPage();
        $per_page = intval(env('LIST_ITEMS_PER_PAGE'));
        $current_page_subjects = $subjects->slice(($current_page - 1) * $per_page, $per_page)->all();
        $paginated_subjects = new LengthAwarePaginator($current_page_subjects, count($subjects), $per_page, $current_page, [
            'path' => Paginator::resolveCurrentPath()
        ]);

        return view('smo/subject/post_subjects', [
            'activeMenuType'  => config('menu.smo.subject'),
            'post'            => $post,
            'subjects'        => $paginated_subjects,
            'status_map'      => $post_subject_status_map,
            'total_subjects'  => count($subjects)
        ]);
    }

    public function show($id)
    {
        $this->authorize('update', Subject::find($id));

        $subject = App\Subject::find($id);
        return view('smo/subject/show', [
            'activeMenuType' => config('menu.smo.posts_open'),
            'subject' => $subject,
            'answers_table' => $subject->answers_table(),
        ]);
    }

    public function notify($id, Request $request)
    {
        $this->authorize('update', Subject::find($id));

        $message = 'The appointment is finishedの Noticeメール送信に失敗しました。';
        $status = 400;

        $subject = Subject::find($id);
        if ($subject) {
            $recipient = new MailUser($subject->application_name, $subject->application_email);
            Mail::to($recipient)->send(new SubjectNotification($subject));
            $message = 'The appointment is finishedの Noticeメールを送信しました。';
            $status = 200;
        }

        return \response()->json(['message' => $message], $status);
    }

    /* Todo: Move messages to i18n file */
    /* Todo: Model validations */
    public function updateExamDate($id, Request $request) {
        $subject = Subject::find($id);

        $this->authorize('update', $subject);

        $message = 'Examination dateを入力してください。';
        $status = 400;

        if (isset($request->application_exam_date) && strlen($request->application_exam_date) != 0) {
            $examDate = $request->application_exam_date;

            if ($subject->update(['application_exam_date' => $examDate])) {
                $message = 'Examination dateが「' . $examDate . '」に更新されました。';
                $status = 200;
            } else {
                $message = 'Examination dateが更新できませんでした。';
                $status = 400;
            }
        }

        return \response()->json(['message' => $message], $status);
    }

    public function update_status($id, Request $request)
    {
        $this->authorize('update', Subject::find($id));

        $subject = App\Subject::find($id);
        $subject->status = $request->status;
        $subject->save();
        return [
            'subject_status' => $subject->status,
            'subject_status_label' => $subject->status_display(),
        ];
    }

    public static function subject_status_map_for_posts($items)
    {
        $post_subject_status_map = [];

        if (collect($items)->isEmpty()) {
            return $post_subject_status_map;
        }

        $post_idx = collect($items)->pluck('id');
        $non_ng_subjects = collect(
            Subject::whereIn('post_id', $post_idx)
                ->where('status', '!=', config('enum.subject_status.ng'))
                ->select(['post_id', 'status'])
                ->get()
        );

        foreach ($post_idx as $id) {
            $post_subjects = $non_ng_subjects->filter(function ($value) use ($id) {
                return $value['post_id'] == $id;
            });
            $post_subject_status_map[$id] = collect(config('enum.subject_status'))->mapWithKeys(function ($status) use ($post_subjects) {
                return [$status => $post_subjects->where('status', $status)->count()];
            });
        }

        return $post_subject_status_map;
    }
}
