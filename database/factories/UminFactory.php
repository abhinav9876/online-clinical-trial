<?php

$factory->define(App\Umin::class, function (Faker\Generator $faker) {
    return [
        'umin_id' => $faker->swiftBicNumber, // "C000000001"
        'title' => $faker->text($maxNbChars = 50), // "Japanese Osteoporosis Intervention Trial (JOINT) -02"
        'type' => $faker->text($maxNbChars = 10), // "骨粗鬆症"
        'owner' => $faker->text($maxNbChars = 50), // "日本骨粗鬆症学会/A-TOP研究会"
        'status' => $faker->text($maxNbChars = 50), // "参加者募集終了‐試験継続中"
        'url' => $faker->name, // "R000000002"
    ];
});

$factory->define(App\UminData::class, function (Faker\Generator $faker) {
    return [
        'umin_id' => 0,
        'randomization' => $faker->text($maxNbChars = 10), // "個別"
        'region' => $faker->text($maxNbChars = 10), // "日本"
        'condition' => $faker->text($maxNbChars = 10), // "骨粗鬆症"
        'classification_specialty' => $faker->text($maxNbChars = 10), // "整形外科学"
        'classification_malignancy' => $faker->text($maxNbChars = 10), // "悪性腫瘍以外"
        'genomic' => $faker->text($maxNbChars = 10), // "いいえ"
        'narrative' => $faker->text($maxNbChars = 10),//"アレンドロネートに対して活性型ビタミンD3製剤を併用To際の臨床的有意性を、椎体骨折発生頻度を指標としてconfirmationToことを目的とTo。"
        'basic' => $faker->text($maxNbChars = 10),
        'others' => $faker->text($maxNbChars = 10),
        'trial_one' => $faker->text($maxNbChars = 10), //"検証的"
        'trial_two' => $faker->text($maxNbChars = 10), //"実務的"
        'phase' => $faker->text($maxNbChars = 10), //"該当せず"
        'primary' => $faker->text($maxNbChars = 10), //"椎体の新規骨折の発生頻度"
        'secondary' => $faker->text($maxNbChars = 10), //"新規骨折の発現時期、非椎体骨折発生頻度、骨量、QOL、血中ビタミンD濃度、安全性",
        'studytype' => $faker->text($maxNbChars = 10), //"介入"
        'basic_design' => $faker->text($maxNbChars = 10), //"並行群間比較"
        'randomization_unit' => $faker->text($maxNbChars = 10), //"個別"
        'blinding' => $faker->text($maxNbChars = 10), //"オープン"
        'control' => $faker->text($maxNbChars = 10), //"実薬・標準治療対照"
        'stratification' => $faker->text($maxNbChars = 10), //"はい"
        'dynamic' => $faker->text($maxNbChars = 10), //"動的割付けの際に施設を調整因子としている"
        'consideration' => $faker->text($maxNbChars = 10), //"動的割付けの際に施設を調整因子としている"
        'blocking' => $faker->text($maxNbChars = 10),
        'concealment' => $faker->text($maxNbChars = 10),
        'arms' => $faker->text($maxNbChars = 10), //"2"
        'intervention' => $faker->text($maxNbChars = 10), //"治療・ケア"
        'type_intervention' => $faker->text($maxNbChars = 10), //"医薬品"
        'control_one' => $faker->text($maxNbChars = 10),
        'age_lower' => $faker->text($maxNbChars = 10), //"70 歳"
        'age_upper' => $faker->text($maxNbChars = 10), //"適用なし"
        'gender' => $faker->text($maxNbChars = 10), //"女"
        'key_inclusion' => $faker->text($maxNbChars = 10), //"日本骨代謝学会原発性骨粗鬆症診断基準（2000年度改訂版）合致の骨粗鬆症、既存骨折として椎体骨折4個以下、年齢70歳以上、自立歩行が可能、新規骨折のリスクファクターを1つ以上保持、QOLアンケートにReply可能",
        'key_exclusion' => $faker->text($maxNbChars = 10), //"続発性骨粗鬆症および他の低骨量を呈To疾患を有To患者、使用薬剤に関To禁忌対象の患者、問診によるデータの信頼性に問題がある患者、第4胸椎-第4腰椎に高度な変形がみられる患者、甲状腺機能低下症,副甲状腺機能亢進症の患者、心疾患、肝疾患、腎障害など重篤な合併症を有To患者、6ヶ月以内にビスフォスフォネート系の薬剤が使用された患者",
        'target_size' => $faker->text($maxNbChars = 10), //"2140"
        'research_contact_name' => $faker->text($maxNbChars = 10), //"折茂　肇"
        'research_organisation' => $faker->text($maxNbChars = 10), //"健康科学大学"
        'research_division_name' => $faker->text($maxNbChars = 10), //"学長"
        'research_address' => $faker->text($maxNbChars = 10), //"山梨県南都留郡富士河口湖町小立7187"
        'research_tel' => $faker->text($maxNbChars = 10),
        'research_email' => $faker->text($maxNbChars = 10),
        'public_contact_name' => $faker->text($maxNbChars = 10),
        'public_organisation' => $faker->text($maxNbChars = 10), //"（財）パブリックヘルスリサーチセンター"
        'public_division' => $faker->text($maxNbChars = 10), //"CSP-A-TOP事務局"
        'public_address' => $faker->text($maxNbChars = 10), //"東京都新宿区西早稲田1丁目1番7号"
        'public_tel' => $faker->text($maxNbChars = 10), //"03-5287-2633"
        'public_url' => $faker->text($maxNbChars = 10), //"http://www.a-top.jp"
        'public_email' => $faker->text($maxNbChars = 10), //"a-top@csp.or.jp"
        'institute_name' => $faker->text($maxNbChars = 10), //"日本骨粗鬆症学会/A-TOP研究会"
        'institute_secondery' => $faker->text($maxNbChars = 10), //"財団法人パブリックヘルスリサーチセンター"
        'name_of_secondary_founder' => $faker->text($maxNbChars = 10),
        'institutions' => $faker->text($maxNbChars = 10),
    ];
});
