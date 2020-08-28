<?php
   
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
  
class ImportsController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExportView()
    {
       return view('welcome');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request) 
    {
        $users = new UsersImport;
        $users->delete();
        if ($request->hasFile('file')) {
            $path = $request->file('file')->getRealPath();
            $data = array_map("str_getcsv", file($path));
            $csv_data = array_slice($data, 0);

            //flag to skip the first header row;
            $flag = FALSE;
            foreach ($csv_data as &$row) {
                if(!$flag){ 
                    $flag = TRUE;
                    continue; 
                }
                If(!filter_var($row[1], FILTER_VALIDATE_EMAIL)){
                   $row[3] = "Fail";
                }else {
                    $row[3] = "Success";
                } 
            }

            //return $csv_data;
            // Covert back to csv 
            /*$output = fopen('processed_csv.csv', 'w');
            foreach ($csv_data as $row){
                fputcsv($output, $row);
            }
            fclose($output);
            */
        }
        

        //Excel::import(new UsersImport,'processed_csv.csv');
        return view('csv_results', compact('csv_data'));  
        //return back();
    }

    public function show_results(){
        return view('csv_results');
    }

    public function readCSV(Request $request){
        $file = $request->file('file');
        Excel::load($file, function($reader) {
        
            // ->all() is a wrapper for ->get() and will work the same
            $results = $reader->each(function($sheet) {

                // Loop through all rows
                $sheet->each(function($row) {
                    If(!filter_var($row[1], FILTER_VALIDATE_EMAIL)){
                        $row[3] = "Fail";
                    }else {
                        $row[3] = "Success";
                    }
                });
            
            });
        
        });
    }
}