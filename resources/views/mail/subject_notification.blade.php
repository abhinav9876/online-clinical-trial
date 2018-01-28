{{ $smt_application->application_name }}Mr.<br>
<br>
お世話になります。<br>
<br>
この度、{{ $post->title }}の事前検診に予約を頂いて有難う御座います。<br>
Examination dateは{{ $smt_application->application_exam_date }}になります。<br>
<br>
下記の注意事項をconfirmationの上、ご参加下さい。<br>
<br>
【注意事項】<br>
・時間厳守でお願いします。日程 Changeが必要な場合はなるべく早く治験コーディネータさんにご連絡ください。<br>
・治験コーディネータさんから連絡があった場合は必ず折返しをToようにして下さい。<br>
・治験の参加はあくまでもボランティアでの参加です。医療発展の為にご協力下さい。<br>
{{ $post->exam_day_notes }}<br>
<br>
【実施施設】<br>
{{ $post->facility_name }}<br>
〒：{{ $post->facility_zip_code }}<br>
{{ $post->facility_address }} {{ $post->facility_address_sup }}<br>
{{ $post->facility_address_notes }}<br>
<br>
治験コーディネータさんと連絡をとりたい場合は下記のcontact informationにお問い合わせ下さい。<br>
治験コーディネータ：{{ $post->crc_name }}<br>
Mail: {{ $post->crc_email }}<br>
<br>
今回ご Application頂いた試験情報をconfirmationTo場合は下記のリンクよりアクセスして下さい。<br>
URL: {{ $examDetailsUrl }}<br>
<br>
<br>
何卒宜しくお願い致します。<br>
<br>
SearchMytrialスタッフ<br>
________________________________________<br>
SearchMytrial<br>
info@searchmytrial.com<br>
https://www.searchmytrial.com
