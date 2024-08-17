<?php

namespace App\Http\Requests;

use App\Models\Table;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

class ReserveTableRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:2|max:255',
            'phone' => 'required|min:2|max:255',
            'table_id' => 'required|exists:tables,id',
            'from_time' => 'required|date_format:Y-m-d H:i:s',
            'to_time' => 'required|date_format:Y-m-d H:i:s|after:from_time',
            'guests' => 'integer|gt:0'
        ];
    }

    public function after(){ 
        
        $table = Table::findOrFail($this->table_id);

        $isReserved = $table->reservations()->isReserved($this->from_time,$this->to_time)->exists();

        return [
            function (Validator $validator) use($table,$isReserved) {
                if ($table->capacity < (int) $this->guests) {
                    $validator->errors()->add(
                        'guests',
                        'This Table Does Not Have Enough Capacity'
                    );
                }            
                if($isReserved){
                    $validator->errors()->add(
                        'table_id', 
                        'This Table is Already Reserved'
                    );
                }
            }
        ];  
    }
}
