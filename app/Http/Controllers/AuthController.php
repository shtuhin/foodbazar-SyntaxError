<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    private $restaurantsFile;

    public function __construct()
    {

        $this->restaurantsFile = storage_path('csv/restaurants.csv'); 
    }


    public function showRestaurantLoginForm()
    {
        return view('auth.restaurant-login'); 
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }
    
    // Handle restaurant login
    public function login(Request $request)
    {
 
        $request->validate([
            'email' => 'required|email',  
            'password' => 'required|string|min:8', 
        ]);


        $restaurants = $this->readCSV($this->restaurantsFile);


        $restaurant = null;
        foreach ($restaurants as $row) {
            if ($row['email'] == $request->email) {
                $restaurant = $row;
                break;
            }
        }

        if ($restaurant && Hash::check($request->password, $restaurant['password'])) {

            Session::put('restaurant', $restaurant); 
            

            return redirect()->route('restaurant.dashboard');
        }


        return back()->withErrors(['email' => 'Invalid credentials.']);
    }


    private function readCSV($filePath)
    {
        $data = [];
        if (file_exists($filePath)) {
            $file = fopen($filePath, 'r');
            $header = fgetcsv($file); 


            while ($row = fgetcsv($file)) {
                $data[] = array_combine($header, $row); 
            }
            fclose($file); 
        }
        return $data; 
    }



public function showUserRegistrationForm()
{
    return view('auth.user-register');
}


public function registerUser(Request $request)
{

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
    ]);


    $hashedPassword = Hash::make($request->password);


    $userData = [
        'id' => time(), 
        'name' => $request->name,
        'email' => $request->email,
        'password' => $hashedPassword,
    ];


    $users = $this->readCSV(storage_path('csv/users.csv'));

    $users[] = $userData;

    $this->writeCSV(storage_path('csv/users.csv'), $users);


    return redirect()->route('user.login')->with('success', 'Registration successful! Please log in.');
}



public function showUserLoginForm()
{
    return view('auth.user-login');
}


public function loginUser(Request $request)
{
    
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:8',
    ]);

    
    $users = $this->readCSV(storage_path('csv/users.csv'));

    
    $user = null;
    foreach ($users as $row) {
        if ($row['email'] == $request->email) {
            $user = $row;
            break;
        }
    }

    if ($user && Hash::check($request->password, $user['password'])) {
        
        Session::put('user', $user); 
        
        
        return redirect()->route('user.dashboard');
    }


    return back()->withErrors(['email' => 'Invalid credentials.']);
}


public function showSignupForm()
{
    return view('signup');
}


public function handleSignup(Request $request)
{

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

 
    $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password')),
    ]);


    auth()->login($user);


    return redirect()->route('home')->with('success', 'Account created successfully!');
}



    private $usersFile = 'storage/csv/users.csv';

    public function showUserLogin()
    {
        return view('auth.user-login');
    }

    public function handleUserLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        $email = $request->input('email');
        $password = $request->input('password');

        $filePath = base_path($this->usersFile);
        if (!file_exists($filePath)) {
            return back()->with('error', 'User file not found.');
        }

        $users = array_map('str_getcsv', file($filePath));
        $headers = array_shift($users); 

        foreach ($users as $user) {
            $userAssoc = array_combine($headers, $user);
            if ($userAssoc['email'] === $email) {
                // Verify password
                if (Hash::check($password, $userAssoc['password'])) {
                    session(['user' => $userAssoc]);
                    return redirect()->route('user.dashboard')->with('success', 'Login successful');
                } else {
                    return back()->with('error', 'Invalid credentials.');
                }
            }
        }

        return back()->with('error', 'No user found with this email.');
    }
}




