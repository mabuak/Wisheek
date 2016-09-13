<?php 

namespace App\Http\Requests;
 
use Response;
use Illuminate\Foundation\Http\FormRequest;
 
class ReminderRequest extends FormRequest {
 
    public function rules()
    {
        return [
          	"email"   => "required|email|exists:users"
        ];
    }
 
    public function authorize()
    {
        return true;
    }
 
}