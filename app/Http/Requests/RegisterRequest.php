<?php 

namespace App\Http\Requests;
 
use Response;
use Illuminate\Foundation\Http\FormRequest;
 
class RegisterRequest extends FormRequest {
 
    public function rules()
    {
        return [
         "email"   => "required|email|unique:users,email",
         "password"  => "required|min:6",
         "username"  => "required|min:3|unique:users,username",
         "first_name"  => "required",
         "last_name"  => "required"
        ];
    }
 
    public function authorize()
    {
        return true;
    }
 
}