<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RestaurantController extends Controller
{

    private $ordersFile;
    private $usersFile;
    private $foodFile;

    public function __construct()
    {
        $this->ordersFile = storage_path('csv/orders.csv');
        $this->usersFile = storage_path('csv/users.csv');
        $this->foodFile = storage_path('csv/foods.csv');
    }
    


    public function dashboard()
    {
        $orders = $this->fetchOrdersWithCustomerNames(); 
        $totalSales = $this->calculateTotalSales($orders);
        $totalProfits = $this->calculateProfits($totalSales);
    
        $deliveryPersonnel = $this->readCSV(storage_path('csv/delivery_personnel.csv'));
    
        return view('restaurant.dashboard', [
            'orders' => $orders,
            'totalSales' => $totalSales,
            'totalProfits' => $totalProfits,
            'deliveryPersonnel' => $deliveryPersonnel, 
        ]);
    }
    

    public function manageOrders()
    {
        $orders = $this->fetchOrdersWithCustomerNames(); 
        return view('restaurant.manage-orders', ['orders' => $orders]);
    }

    public function viewReports()
    {
        $orders = $this->fetchOrdersWithCustomerNames(); 
        $totalSales = $this->calculateTotalSales($orders);
        $totalProfits = $this->calculateProfits($totalSales);

        return view('restaurant.view-reports', [
            'totalSales' => $totalSales,
            'totalProfits' => $totalProfits,
            'orders' => $orders,
        ]);
    }

    public function updateOrderStatus($orderId)
    {
        $orders = $this->readCSV($this->ordersFile);

        foreach ($orders as $key => $order) {
            if ($order['id'] == $orderId) {
                $orders[$key]['status'] = 'Delivered';
                $this->writeCSV($this->ordersFile, $orders);
                return back()->with('success', 'Order status updated to Delivered.');
            }
        }

        return back()->withErrors('Order not found.');
    }


    private function fetchOrdersWithCustomerNames()
    {
        $orders = $this->readCSV($this->ordersFile);
        $users = $this->readCSV($this->usersFile);


        $usersMap = [];
        foreach ($users as $user) {
            $usersMap[$user['id']] = $user['name'];
        }

  
        foreach ($orders as &$order) {
            $order['customer_name'] = $usersMap[$order['user_id']] ?? 'Unknown';
        }

        return $orders;
    }


    protected function readCSV($filePath)
    {
        $data = [];
        if (($handle = fopen($filePath, 'r')) !== false) {
            $header = fgetcsv($handle);
            while (($row = fgetcsv($handle)) !== false) {
                $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }



    

    protected function writeCSV($filePath, $data)
    {
        if (($handle = fopen($filePath, 'w')) !== false) {
            fputcsv($handle, array_keys($data[0])); // Write header
            foreach ($data as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        }
    }


    protected function calculateTotalSales($orders)
    {
        return array_sum(array_column($orders, 'total_price'));
    }

    protected function calculateProfits($totalSales)
    {
        return $totalSales * 0.80;
    }




    public function addFoodItem()
{

    return view('restaurant.add-food-item');
}



    public function storeFoodItem(Request $request)
{

    $restaurantId = $request->input('restaurant_id');

    $request->validate([
        'restaurant_id' => 'required|string',
        'name' => 'required|string',
        'category' => 'required|string',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image validation
    ]);

    $imageName = null;
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('images'), $imageName);
    }

   
    $newFood = [
        'id' => time(), 
        'restaurant_id' => $restaurantId, 
        'name' => $request->input('name'),
        'category' => $request->input('category'),
        'price' => $request->input('price'),
        'image' => $imageName ?? '', 
    ];


    $foodItems = $this->readCSV($this->foodFile);
    $foodItems[] = $newFood; 


    $this->writeCSV($this->foodFile, $foodItems);

    return redirect()->route('restaurant.viewFoodItems')->with('success', 'Food item added successfully!');
}


public function viewFoodItems()
{
    $restaurantId = session('restaurant_id'); 
    $foodItems = $this->readCSV($this->foodFile);


    $foodItems = array_filter($foodItems, function ($row) use ($foodItems) {
        return count($row) == count($foodItems[0]);
    });


    $restaurantFoodItems = array_filter($foodItems, function ($food) use ($restaurantId) {
        return $food['restaurant_id'] == $restaurantId;
    });

    return view('restaurant.add-food-item', ['foodItems' => $restaurantFoodItems]);
}


public function showFoods(Request $request) {
    $foods = $this->readFoodsCsv();


    if ($request->has('category') && $request->category != '') {
        $category = $request->category;
        $foods = array_filter($foods, function($food) use ($category) {
            return $food['category'] == $category;
        });
    }

    return view('index', compact('foods'));
}

public function showProduct($id)
{

    $foods = $this->readCSV($this->foodFile);
    $food = collect($foods)->firstWhere('id', $id);

    if (!$food) {
        return redirect()->back()->withErrors(['message' => 'Food item not found.']);
    }

    return view('food.product', compact('food'));
}

public function placeOrder(Request $request)
{
    
    $request->validate([
        'user_id' => 'required',
        'food_id' => 'required',
        'restaurant_id' => 'required',
        'address' => 'required',
    ]);


    $orderID = uniqid('order_');


    $foods = $this->readCSV($this->foodFile);  
    $food = collect($foods)->firstWhere('id', $request->food_id);

    if (!$food) {
        return redirect()->back()->withErrors(['message' => 'Food item not found.']);
    }


    $orderData = [
        'id' => $orderID,
        'user_id' => $request->user_id,
        'food_id' => $request->food_id,
        'status' => 'Pending',  
        'address' => $request->address,
        'total_price' => $food['price'],  
    ];


    $this->appendToCSV($this->ordersFile, $orderData);

    return redirect()->route('home')->with('success', 'Order placed successfully!');
}



public function productPage($id)
{
    $foods = $this->readCSV($this->foodFile);
    $food = collect($foods)->firstWhere('id', $id);

    if (!$food) {
        return redirect()->back()->withErrors(['error' => 'Food item not found.']);
    }

    return view('food.product', ['food' => $food]);
}

private function appendToCSV($filePath, $data)
{
    $file = fopen($filePath, 'a');

    if ($file) {
        fputcsv($file, $data);
        fclose($file);
    }
}


}
