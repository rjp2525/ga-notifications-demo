<?php

namespace App\Http\Requests;

use App\Models\Announcement;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class CreateAnnouncementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('create', Announcement::class);
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|unique:announcements,title',
            'body' => 'required|string|max:2000',
        ];
    }
}
