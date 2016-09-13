<?php 

namespace App\Http\Requests;
 
use Response;
use Illuminate\Foundation\Http\FormRequest;
 
class PinRequest extends FormRequest {
 
    public function rules()
    {
        return [
          	"price"  => "required",
            "image"  => "required",
            "want_price"  => "required",
            "title"  => "required"
        ];
    }
 
    public function authorize()
    {
        return true;
    }
 
}