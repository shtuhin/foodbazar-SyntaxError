<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $usersFile;

    public function __construct()
    {
        $this->usersFile = storage_path('csv/users.csv');
    }

    // Show the signup form
    public function showSignupForm()
    {
        return view('auth.signup');
    }

    public function handleSignup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
            'contact' => 'required|numeric|digits_between:10,15',
            'password' => 'required|confirmed|min:8',
        ]);

        $users = $this->readCSV($this->usersFile);

        foreach ($users as $user) {
            if ($user['email'] == $request->email) {
                return back()->withErrors(['email' => 'The email address is already registered.'])->withInput();
            }
        }

        $newUser = [
            'id' => $this->getNextId($users),
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'contact' => $request->contact,
            'password' => Hash::make($request->password), // Hash the password
        ];

        $users[] = $newUser;


        $this->writeCSV($this->usersFile, $users);


        return redirect()->route('login')->with('success', 'Account created successfully! Please log in.');
    }


    private function readCSV($filePath)
    {
        $data = [];
        if (file_exists($filePath)) {
            $file = fopen($filePath, 'r');
            $header = fgetcsv($file);
            while ($row = fgetcsv($file)) {
                if (count($header) == count($row)) {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($file);
        }
        return $data;
    }


    private function writeCSV($filePath, $data)
    {
        $file = fopen($filePath, 'w');

        fputcsv($file, array_keys($data[0]));

        foreach ($data as $row) {
            fputcsv($file, $row);
        }
        fclose($file);
    }


    private function getNextId($users)
    {
        if (empty($users)) {
            return 1; 
        }
        $lastUser = end($users);
        return $lastUser['id'] + 1; 
    }



    public function dashboard()
    {

        if (!session()->has('user')) {
            return redirect()->route('user.login')->with('error', 'Please login first.');
        }


        $user = session('user');

        return view('user.dashboard', compact('user'));
    }

    public function logout()
        {

            session()->forget('user');
            return redirect()->route('user.login')->with('success', 'Logged out successfully.');
        }
}
