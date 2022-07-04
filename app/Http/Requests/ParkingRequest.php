<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class ParkingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('is-manager');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'description' => 'required',
            'idsurfs' => ['required', Rule::unique('parkings')->ignore($this->parking)],
            'id_city' => 'required|integer|exists:cities,id',
            'street' => 'required|max:255',
            'lat' => 'required|max:255',
            'long' => 'required|max:255',
            'id_owner' => 'required|integer|exists:owerns,id',
            'max_height' => 'required|max:5',
            'wheelchair_access' => 'required|boolean',
            'electric_car' => 'required|boolean',
            'full_time' => 'required|boolean',
            'schedules',
            'prices',
            'slug' => 'required|max:255'
        ];
    }
}
