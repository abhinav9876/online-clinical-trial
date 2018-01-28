<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavePost extends FormRequest
{
    public function authorize()
    {
        return true; // todo
    }

    public function rules()
    {
        return [
            'title'                  => 'required|max:255',
            'description'            => 'required|string',
            'facility_name'          => 'required|string|max:255',
            'facility_address_sup'   => 'required|string|max:255',
            'facility_zip_code'      => 'required|string|max:255',
            'facility_address'       => 'required|string|max:255',
            'facility_address_notes' => 'present|string|max:255',
            'required_no_scr'        => 'required|numeric|min:0|max:999',
            'start_recruitment_at'   => 'required|date_format:Y/m/d H:i|after_or_equal:2000-01-01',
            'end_recruitment_at'     => 'required|date_format:Y/m/d H:i|after_or_equal:start_recruitment_at',
            'crc_name'               => 'required|string|max:255',
            'crc_email'              => 'required|email',
            'selection_criteria'     => 'present|nullable',
            'exclusion_criteria'     => 'present|nullable',
            'participation_benefits' => 'present|nullable',
            'exam_day_notes'         => 'present|nullable',
            'exam_schedule_items'    => 'present|array',
            'reward_items'           => 'present|array'
        ];
    }

    public function response(array $errors)
    {
        return $this->redirector->to($this->getRedirectUrl())
            ->withErrors($errors, $this->errorBag)
            ->withInput();
    }
}
