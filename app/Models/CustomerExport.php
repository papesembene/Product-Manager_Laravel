<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
class CustomerExport implements FromCollection,WithHeadings

{
    use HasFactory;

    public function collection()
    {
        // TODO: Implement collection() method.

       return $customers = Customer::all();
       /* return [
            'id'=>$customers->id,
            'firstname'=>$customers->firstname,
            'lastname'=>$customers->lastname,
            'adress'=>$customers->adress,
            'number'=>$customers->number,
        ];*/
    }

    public function headings(): array
    {
        // TODO: Implement headings() method.
        return [
            'Id',
            'Firstname',
            'Lastname',
            'Number of Call',
            'Adress',

        ];
    }
}
