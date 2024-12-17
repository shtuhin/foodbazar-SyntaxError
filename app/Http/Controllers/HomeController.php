<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class HomeController extends Controller
{

public function index()
{
    $csvFile = storage_path('csv/foods.csv'); 
    $foods = [];

    if (File::exists($csvFile)) {
        $data = array_map('str_getcsv', file($csvFile));
        $header = array_shift($data); 



        foreach ($data as $row) {
            $foods[] = array_combine($header, $row); 
        }
    } else {

        dd('CSV file does not exist');
    }

    return view('index', compact('foods'));
}





    private function getFoodsFromCSV()
    {
        $foods = [];
        

        $csvFile = storage_path('csv/foods.csv');
        
        if (file_exists($csvFile) && is_readable($csvFile)) {
            if (($handle = fopen($csvFile, 'r')) !== FALSE) {
                $header = fgetcsv($handle); 
                
                while (($data = fgetcsv($handle)) !== FALSE) {

                    $foods[] = $data;
                }
                fclose($handle);
            }
        }

        return $foods;
    }
}

