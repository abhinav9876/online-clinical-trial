{{ $post->crc_name }}Mr.

お世話になります。

この度、SMTをご使用頂いて有難う御座います。
{{ $post->title }}に予約の完了していない Applicationがありますので下記URLよりログインをし、ApplicantのStatus Changeを行って下さい。
{{ $alertSubjects->count() }}件の ApplicationのStatusが2日以上 Changeされていません。

URL: https://puzz.searchmytrial.com/login

---
@foreach ($alertSubjects as $subject)
    ### Applicant name: {{ $subject->name }}
    Applicantmail address: {{ $subject->email }}
    ApplicantStatus: {{ $subject->status_display() }}
    Applicant最終更新日: {{ $subject->updated_at }}

@endforeach
---

何卒宜しくお願い致します。

SearchMytrialスタッフ
________________________________________
SearchMytrial
info@searchmytrial.com
https://www.searchmytrial.com
