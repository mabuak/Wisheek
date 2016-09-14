<?php 

namespace App\Http\Requests;
 
use Response;
use Illuminate\Foundation\Http\FormRequest;
 
class ResetRequest extends FormRequest {
 
    public function rules()
    {
        return [
            'token' => 'required',
          	'password"   => "required|min:6|confirmed'
        ];
    }
 
    public function authorize()
    {
        return true;
    }
 
}