<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    private $restaurantsFile;
    private $deliveryPersonnelFile;
    private $deliveryLogsFile;
    private $pendingRestaurantsFile;


    public function __construct()
    {
        $this->restaurantsFile = storage_path('csv/restaurants.csv');
        $this->deliveryPersonnelFile = storage_path('csv/delivery_personnel.csv');
        $this->deliveryLogsFile = storage_path('csv/delivery_logs.csv');
        $this->pendingRestaurantsFile = storage_path('csv/pending_restaurants.csv');
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }


    public function login(Request $request)
    {
 
        $adminEmail = 'syntaxerror@gmail.com';
        $adminPassword = 'admin123';

        if ($request->email === $adminEmail && $request->password === $adminPassword) {
            Session::put('admin', $adminEmail);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }


    public function dashboard()
    {
        if (Session::has('admin')) {
            return view('admin.dashboard');
        }
        return redirect()->route('admin.login');
    }


    public function restaurants()
    {
        $restaurants = $this->readCSV($this->restaurantsFile);
        return view('admin.restaurants', compact('restaurants'));
    }


public function addRestaurant(Request $request)
{

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'address' => 'required|string|max:255',
        'password' => 'required|string|min:8',  
    ]);


    $restaurants = $this->readCSV($this->restaurantsFile);

    $newId = 1;
    if (count($restaurants) > 0) {
        $ids = array_column($restaurants, 'id');
        $newId = max($ids) + 1;  
    }


    $data = [
        'id' => $newId,
        'name' => $request->name,
        'email' => $request->email,
        'address' => $request->address,
        'password' => $request->password, 
    ];

   
    $this->writeCSV($this->restaurantsFile, $data);

    return back()->with('success', 'Restaurant added successfully!');
}



    public function deleteRestaurant(Request $request)
    {
        $id = $request->input('id');
        $this->deleteRowFromCSV($this->restaurantsFile, $id);
        return back()->with('success', 'Restaurant deleted successfully!');
    }


    




    private function readCSV($filePath)
    {
        if (!file_exists($filePath)) {
            return []; // Return empty array if the file doesn't exist
        }

        $file = fopen($filePath, 'r');
        $data = [];


        $header = fgetcsv($file);


        if ($header === false) {
            fclose($file);
            return [];
        }


        while ($row = fgetcsv($file)) {

            if (count($header) === count($row)) {
                $rowData = array_combine($header, $row); 
                if ($rowData) { 
                    $data[] = $rowData;
                }
            } else {
               
            }
        }

        fclose($file);
        return $data; 
    }

 
    private function writeCSV($filePath, $data)
    {

        $fileExists = file_exists($filePath) && filesize($filePath) > 0;
    
        $file = fopen($filePath, 'a'); 
    
        if (!$fileExists) {
            fputcsv($file, array_keys($data));
        }
    
        fputcsv($file, $data); 
        fclose($file);
    }
    


    private function deleteRowFromCSV($filePath, $id)
    {
        $data = $this->readCSV($filePath);
        $filteredData = array_filter($data, fn($row) => $row['id'] != $id);

        $file = fopen($filePath, 'w');

        if (!empty($filteredData)) {
            fputcsv($file, array_keys(reset($filteredData))); 
            foreach ($filteredData as $row) {
                fputcsv($file, $row);
            }
        }

        fclose($file);
    }




    private function checkAdminSession()
    {
        if (!Session::has('admin')) {
            return redirect()->route('admin.login')->withErrors(['message' => 'You need to log in to access this page.']);
        }
    }
    public function deliveryPersonnel()
    {

        if (!Session::has('admin')) {
            return redirect()->route('admin.login')->withErrors(['message' => 'You need to log in to access this page.']);
        }

        $deliveryPersonnel = $this->readCSV($this->deliveryPersonnelFile);
        return view('admin.delivery-personnel', compact('deliveryPersonnel'));
    }

    public function addDeliveryPersonnel(Request $request)
    {

        if (!Session::has('admin')) {
            return redirect()->route('admin.login')->withErrors(['message' => 'You need to log in to access this page.']);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
        ]);

        $deliveryPersonnel = $this->readCSV($this->deliveryPersonnelFile);
        $newId = count($deliveryPersonnel) > 0 ? (int)max(array_column($deliveryPersonnel, 'id')) + 1 : 1;

        $data = [
            'id' => $newId,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        $this->writeCSV($this->deliveryPersonnelFile, $data);

        return back()->with('success', 'Delivery personnel added successfully!');
    }
    
    public function deleteDeliveryPersonnel(Request $request)
    {

        if (!Session::has('admin')) {
            return redirect()->route('admin.login')->withErrors(['message' => 'You need to log in to access this page.']);
        }

        $id = $request->input('id');
        $this->deleteRowFromCSV($this->deliveryPersonnelFile, $id);
        return back()->with('success', 'Delivery personnel deleted successfully!');
    }





    public function viewDeliveryLogs()
    {

        if (!Session::has('admin')) {
            return redirect()->route('admin.login')->withErrors(['message' => 'You need to log in to access this page.']);
        }


        $deliveryLogs = $this->readCSV($this->deliveryLogsFile);

        return view('admin.delivery_logs', compact('deliveryLogs'));
    }

    public function deliveryLogs()
{

    if (!Session::has('admin')) {
        return redirect()->route('admin.login')->withErrors(['message' => 'You need to log in to access this page.']);
    }


    $deliveryLogs = $this->readCSV($this->deliveryLogsFile);


    return view('admin.delivery_logs', compact('deliveryLogs'));
}
























public function pendingRestaurants()
{

    if (!Session::has('admin')) {
        return redirect()->route('admin.login')->withErrors(['message' => 'You need to log in to access this page.']);
    }


    $pendingRestaurants = $this->readCSV($this->pendingRestaurantsFile);


    return view('admin.pending_restaurants', compact('pendingRestaurants'));
}



public function approveRestaurant(Request $request)
{
    $restaurantId = $request->id;


    $pendingRestaurants = $this->readCSV($this->pendingRestaurantsFile);


    $restaurantToApprove = null;
    foreach ($pendingRestaurants as $index => $restaurant) {
        if ($restaurant['id'] == $restaurantId) {

            $restaurantToApprove = $restaurant;
            unset($pendingRestaurants[$index]);
            break;
        }
    }

    if ($restaurantToApprove) {

        $this->writeCSV($this->restaurantsFile, $restaurantToApprove);


        if (count($pendingRestaurants) > 0) {

            $this->overwriteCSV($this->pendingRestaurantsFile, array_values($pendingRestaurants));
        } else {
           
            $this->clearCSV($this->pendingRestaurantsFile);  
        }


        return back()->with('success', 'Restaurant approved successfully!');
    } else {
        
        return back()->withErrors('Restaurant not found in pending list.');
    }
}

private function clearCSV($filePath)
{

    $file = fopen($filePath, 'w');

    fputcsv($file, ['id', 'name', 'email', 'address', 'password']);
    fclose($file);
}

private function overwriteCSV($filePath, $data)
{

    $file = fopen($filePath, 'w');


    if (!empty($data)) {
        fputcsv($file, array_keys($data[0])); 
        foreach ($data as $row) {
            fputcsv($file, $row);
        }
    }

    fclose($file);
}





public function showPendingRestaurants()
{
    
    $filePath = storage_path('app/pending_restaurants.csv');


    $pendingRestaurants = $this->readCSV($filePath);


    return view('admin.pending_restaurants', compact('pendingRestaurants'));
}



private function appendToCSV($filePath, $row)
{
    $file = fopen($filePath, 'a');
    fputcsv($file, $row);
    fclose($file);
}

private function removeRowFromCSV($filePath, $id)
{
    $rows = $this->readCSV($filePath);
    $updatedRows = [];

    foreach ($rows as $row) {
        if (isset($row[0]) && $row[0] != $id) {
            $updatedRows[] = $row; 
        }
    }


    $file = fopen($filePath, 'w');
    foreach ($updatedRows as $updatedRow) {
        fputcsv($file, $updatedRow);
    }
    fclose($file);
}


















    public function showRegisterForm()
    {
        return view('register');
    }
    public function registerRestaurant(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
            'password' => 'required|min:6',
        ]);
    

        $pendingCsvFile = storage_path('csv/pending_restaurants.csv');
    

        $rows = [];
        if (file_exists($pendingCsvFile)) {
            $rows = array_map('str_getcsv', file($pendingCsvFile));
        }
    

        foreach ($rows as $row) {
            if (isset($row[2]) && $row[2] === $validated['email']) {
                return back()->withErrors(['email' => 'This email is already pending approval.']);
            }
        }
    

        $newId = count($rows) > 0 ? (int) $rows[count($rows) - 1][0] + 1 : 1;
    

        $newData = [
            $newId, 
            $validated['name'],
            $validated['email'],
            $validated['address'],
            bcrypt($validated['password'])
        ];
    

        $file = fopen($pendingCsvFile, 'a');
        fputcsv($file, $newData);
        fclose($file);
    

        return redirect()->route('home')->with('success', 'Registration submitted! Waiting for admin approval.');
    }
    
}