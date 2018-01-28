<?php

use App\Post;
use App\SMOUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DebugPostSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('en_US');

        for ($i = 0; $i < 100; $i++) {
            $user_id = DB::table('users')->where('type', config('enum.user_type.smo'))->inRandomOrder()->first()->id;

            $smo = SMOUser::get($user_id)->attribute;
            $smo_id = $smo->smo_id;
            $project = DB::table('smo_projects')
                ->join('projects', 'smo_projects.project_id', '=', 'projects.id')
                ->select('projects.id', 'projects.name', 'projects.protocol', 'projects.category')
                ->where('smo_projects.smo_id', $smo_id)
                ->inRandomOrder()
                ->first();
            if (!$project) continue; // smo has no assigned projects

            $post = Post::firstOrNew([
                'smo_id'     => $smo_id,
                'project_id' => $project->id
            ]);


            $post['user_id'] = $user_id;
            $post['title'] = join(' ', $faker->words(rand(1, 4)));
            $post['description'] = $faker->sentence();
            $post['facility_name'] = $faker->company;
            $post['start_recruitment_at'] = $faker->dateTimeBetween('-2 weeks', 'now');
            $post['end_recruitment_at'] = $faker->dateTimeBetween('now', '+2 weeks');
            $post['required_no_scr'] = rand(0, 40);
            $post['crc_name'] = $faker->name;
            $post['crc_email'] = $faker->email;
            $post['selection_criteria'] = $faker->text();
            $post['exclusion_criteria'] = $faker->text();
            $post['exam_day_notes'] = $faker->text();
            $post['participation_benefits'] = $faker->text();
            $post['exam_schedule_items'] = self::rand_exam_schedule_items($faker);
            $post['reward_items'] = self::rand_reward_items($faker);
            $post['facility_zip_code'] = $faker->postcode;
            $post['facility_address'] = $faker->address;
            $post['facility_address_sup'] = '2-chome';
            $post['facility_address_notes'] = $faker->sentence();
            $post['required_subject_gender'] = rand(0, 2);
            $post['minimum_subject_age'] = rand(0, 40);
            $post['maximum_subject_age'] = rand($post['minimum_subject_age'], $post['minimum_subject_age'] + 40);

            $post->save();
        }
    }

    private function rand_exam_schedule_items(\Faker\Generator $faker)
    {
        $items = [];
        for ($i = 0; $i < rand(1, 5); $i++) {
            array_push($items, [
                'label'      => join(' ', $faker->words(rand(1, 3))),
                'conduct_at' => $faker->dateTimeBetween('-1 week', '+1 week')->format('Y/m/d H:i')
            ]);
        }
        return json_encode($items);
    }

    private function rand_reward_items(\Faker\Generator $faker)
    {
        $items = [];
        for ($i = 0; $i < rand(1, 5); $i++) {
            array_push($items, [
                'label'  => join(' ', $faker->words(rand(1, 3))),
                'reward' => '¥' . rand(300, 10000)
            ]);
        }
        return json_encode($items);
    }
}
