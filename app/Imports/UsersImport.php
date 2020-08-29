<?php
   
namespace App\Imports;
   
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
    
class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'mobile' => $row['mobile'],
            'firstname' => $row['firstname'],
            'lastname' => $row['lastname'],
            'state' => $row['state'],
            'address' => $row['address'],
            'email'    => $row['email'],
            'deposit' => $row['deposit'],
            'status' => $row['status'],
        ]);
    }

    public function delete(){
        User::truncate();
    }
}

