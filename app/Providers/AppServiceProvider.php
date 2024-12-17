<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
 

     public function boot()
     {
         $csvFilePath = storage_path('csv/restaurants.csv');
     
         if (!file_exists($csvFilePath)) {
             // Ensure the directory exists
             if (!file_exists(dirname($csvFilePath))) {
                 mkdir(dirname($csvFilePath), 0777, true);
             }
     
             // Create the file and add headers
             $file = fopen($csvFilePath, 'w');
             fputcsv($file, ['id', 'name', 'email', 'address']); // Add headers
             fclose($file);
         }
     }
     
        
}


