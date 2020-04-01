<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    public function getEmployeesImageAttribute()
    {
        
        $imageExist  =  \Storage::disk('public')->exists('employee/'.$this->employee_image);
        
        if($imageExist && $this->employee_image != NULL && $this->employee_image != "" ) {
            return asset('storage/employee/'.$this->employee_image )  ;
        }

        return asset('storage/default/picture.png');

    }

    public function getEmpImageAttribute()
    {
        
        $imageExist  =  \Storage::disk('public')->exists('employee/'.$this->id.'/'.$this->employee_image);
        
        if($imageExist && $this->employee_image != NULL && $this->employee_image != "" ) {
            return asset('storage/employee/'.$this->id.'/'.$this->employee_image )  ;
        }

        return asset('storage/default/picture.png');

    }
}
