<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class LikeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user() != null && $this->user()->email_verified_at != null || Gate::allows('is-manager');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'parking_id' => 'required|integer|exists:parkings,id',
            'user_id' => 'required|integer|exists:users,id'
        ];
    }
}
