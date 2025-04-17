<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobPosts extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'jobTitle' => 'required|string',
            'jobDescription' => 'required|string',
            'jobLocation' => 'required|string',
            'jobLevel' => 'required|string|in:Entry Level,Mid Level,Senior Level',
            'employeeStartTime' => 'required|date_format:H:i',
            'employeeEndTime' => 'required|date_format:H:i|after:employeeStartTime',
            'offeredSalary' => 'required|numeric',
            // 'qualification' => 'required|string',
            'experience' => 'required|string',
            'jobdeadline' => 'required|date|after:today',
            'jobType' => 'required|string|in:trainee,parttime,fulltime,user',
            'vacancynumber' => 'required|integer|min:1|max:500',
            'skills' => 'required|string',
            'jobBanner' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'jobCompanyId' => 'required|exists:job_companies,id',
            'croppedImageBase64' => 'nullable|string',
            'jobCategoryId' => 'required|exists:job_categories,id',
        ];
    }

    public function messages()
    {
        return [
            // Custom messages for each field
            'jobTitle.required' => 'The job title is required.',
            'jobTitle.string' => 'The job title must be a valid text.',


            'jobDescription.required' => 'The job description is required.',
            'jobDescription.string' => 'The job description must be a valid text.',

            'jobLocation.required' => 'The job location is required.',
            'jobLocation.string' => 'The job location must be a valid text.',


            'jobLevel.required' => 'The job level is required.',
            'jobLevel.string' => 'The job level must be a valid text.',
            'jobLevel.in' => 'The job level must be one of: Entry Level, Mid Level, Senior Level.',

            'employeeStartTime.required' => 'The employee start time is required.',
            'employeeStartTime.date_format' => 'The employee start time must be in the format HH:MM.',

            'employeeEndTime.required' => 'The employee end time is required.',
            'employeeEndTime.date_format' => 'The employee end time must be in the format HH:MM.',
            'employeeEndTime.after' => 'The employee end time must be after the start time.',

            'offeredSalary.required' => 'The offered salary is required.',
            'offeredSalary.numeric' => 'The offered salary must be a valid number.',

            'qualification.required' => 'The qualification is required.',
            'qualification.string' => 'The qualification must be a valid text.',

            'experience.required' => 'The experience is required.',
            'experience.string' => 'The experience must be a valid text.',


            'jobdeadline.required' => 'The job deadline is required.',
            'jobdeadline.date' => 'The job deadline must be a valid date.',
            'jobdeadline.after' => 'The job deadline must be a future date.',

            'jobType.required' => 'The job type is required.',
            'jobType.string' => 'The job type must be a valid text.',
            'jobType.in' => 'The job type must be one of: trainee, parttime, fulltime, user.',

            'vacancynumber.required' => 'The number of vacancies is required.',
            'vacancynumber.integer' => 'The number of vacancies must be a valid integer.',
            'vacancynumber.min' => 'The number of vacancies must be at least 1.',
            'vacancynumber.max' => 'The number of vacancies must not exceed 500.',

            'skills.required' => 'The skills field is required.',
            'skills.string' => 'The skills must be a valid text.',




            'jobBanner.required' => 'The job banner is required.',
            'jobBanner.image' => 'The job banner must be an image.',
            'jobBanner.mimes' => 'The job banner must be a file of type: jpeg, png, jpg, gif, svg.',
            'jobBanner.max' => 'The job banner must not exceed 5MB in size.',

            'jobCompanyId.required' => 'The job company is required.',
            'jobCompanyId.exists' => 'The selected job company is invalid.',

            'croppedImageBase64.string' => 'The cropped image must be a valid string.',

            'jobCategoryId.required' => 'The job category is required.',
            'jobCategoryId.exists' => 'The selected job category is invalid.',
        ];
    }
}
