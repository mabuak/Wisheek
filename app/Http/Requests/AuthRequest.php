<?php 

namespace App\Http\Requests;
 
use Response;
use Illuminate\Foundation\Http\FormRequest;
 
class AuthRequest extends FormRequest {
 
    public function rules()
    {
        return [
          	"email"   => "required|email|exists:users",
        	"password"  => "required|min:6"
        ];
    }
 
    public function authorize()
    {
        return true;
    }
 
}