<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiCalculationRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "RecordFormat"=>"required",
            "Player"=>"required",
            "Listening"=>"required",
            "RoomID"=>"required",
            "RequestDate"=>"required",
            "Crane"=>"required|boolean",
            "CameraAmount"=>"required|integer|between:0,100",
            "PrompterAmount"=>"required|integer|between:0,100",
            "VideoWall"=>"required|integer|between:0,100",
            "CGAmount"=>"required|integer|between:0,100",
            "StudioMonitor"=>"required|integer|between:0,100",
            "WiredMicAmount"=>"required|integer|between:0,100",
            "WirelessMicAmount"=>"required|integer|between:0,100",
            "RadioPAmount"=>"required|integer|between:0,100",
            "RadioMicAmount"=>"required|integer|between:0,100",
            "SoundProc"=>"required|boolean",
            "PhoneHybrid"=>"required|boolean",
            "Skype"=>"required|boolean",
            "IngestStudio"=>"required|boolean",
            "IngestProd"=>"required|boolean",
            "IngestNews"=>"required|boolean",
            "IngestCinegy"=>"required|boolean",
            "MCR"=>"required|boolean",
            "StartDate"=>"required",
            "EndDate"=>"required",


        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ],400));
    }
}
