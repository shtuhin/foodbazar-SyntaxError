<?php


use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FoodController;



//root
Route::get('/', [HomeController::class, 'index'])->name('home');






// Show the login form
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');


// Show the restaurant login form
Route::get('restaurant-login', [AuthController::class, 'showRestaurantLoginForm'])->name('auth.login');

// Show the user login form
// Route::get('user-login', [AuthController::class, 'showUserLoginForm'])->name('user.login');

// Show the registration form
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');

// Handle restaurant login
Route::post('restaurant-login', [AuthController::class, 'restaurantLogin'])->name('restaurant.login');

// Handle user login
// Route::post('user-login', [AuthController::class, 'userLogin'])->name('user.login');

// Handle the registration form
Route::post('register', [AuthController::class, 'register'])->name('register.submit');



// Show the restaurant login form
Route::get('restaurant-login', [AuthController::class, 'showRestaurantLoginForm'])->name('auth.login');

// Handle the restaurant login form submission
Route::post('restaurant-login', [AuthController::class, 'login'])->name('auth.login.submit');



// Show the login form for restaurants
Route::get('restaurant-login', [AuthController::class, 'showRestaurantLoginForm'])->name('auth.login');

// Handle the restaurant login form submission
Route::post('restaurant-login', [AuthController::class, 'login'])->name('auth.login.submit');

// Define route for restaurant dashboard (for testing purposes)
Route::get('restaurant-dashboard', function() {
    return 'Restaurant Dashboard';  // This will be replaced by your actual dashboard route.
})->name('restaurant.dashboard');






// Admin routes
Route::get('admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'login']);

// Admin dashboard
Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/restaurants', [AdminController::class, 'restaurants'])->name('admin.restaurants');
Route::get('/admin/delivery_personnel', [AdminController::class, 'deliveryPersonnel'])->name('admin.delivery_personnel');
Route::get('/admin/delivery_logs', [AdminController::class, 'deliveryLogs'])->name('admin.delivery_logs');
Route::get('/admin/pending_restaurants', [AdminController::class, 'pendingRestaurants'])->name('admin.pending_restaurants');

// Actions
Route::post('/admin/add-restaurant', [AdminController::class, 'addRestaurant'])->name('admin.addRestaurant');
Route::post('/admin/delete-restaurant', [AdminController::class, 'deleteRestaurant'])->name('admin.deleteRestaurant');
Route::post('/admin/approve-restaurant', [AdminController::class, 'approveRestaurant'])->name('admin.approveRestaurant');
Route::post('/admin/add-delivery-personnel', [AdminController::class, 'addDeliveryPersonnel'])->name('admin.addDeliveryPersonnel');
Route::post('/admin/delete-delivery-personnel', [AdminController::class, 'deleteDeliveryPersonnel'])->name('admin.deleteDeliveryPersonnel');


Route::get('/admin/delivery-personnel', [AdminController::class, 'deliveryPersonnel'])->name('admin.deliveryPersonnel');
Route::post('/admin/delivery-personnel/add', [AdminController::class, 'addDeliveryPersonnel'])->name('admin.addDeliveryPersonnel');
Route::post('/admin/delivery-personnel/delete', [AdminController::class, 'deleteDeliveryPersonnel'])->name('admin.deleteDeliveryPersonnel');




Route::get('/admin/delivery-logs', [AdminController::class, 'deliveryLogs'])->name('admin.delivery.logs');



Route::get('/admin/pending-restaurants', [AdminController::class, 'pendingRestaurants'])->name('admin.pending.restaurants');
Route::post('/admin/approve-restaurant', [AdminController::class, 'approveRestaurant'])->name('admin.approve.restaurant');

// Signup route
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');

// Handle signup form submission
Route::post('/signup', [AuthController::class, 'handleSignup'])->name('handle.signup');



// Show the restaurant registration form
Route::get('/register', [AdminController::class, 'showRegisterForm'])->name('register');

// Handle the form submission
Route::post('/register', [AdminController::class, 'registerRestaurant'])->name('register.post');









Route::get('restaurant-dashboard', [RestaurantController::class, 'dashboard'])->name('restaurant.dashboard');

// Route for updating order status (if needed)
Route::get('restaurant/update-order-status/{id}', [RestaurantController::class, 'updateOrderStatus'])->name('restaurant.updateOrderStatus');




// Show user registration form
Route::get('user-register', [AuthController::class, 'showUserRegistrationForm'])->name('user.register');

// Handle user registration form submission
Route::post('user-register', [AuthController::class, 'registerUser'])->name('user.register.submit');

// User dashboard route
Route::get('user-dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');





// Show the signup form
Route::get('/signup', [UserController::class, 'showSignupForm'])->name('signup');

// Handle the signup form submission
Route::post('/signup', [UserController::class, 'handleSignup'])->name('handle.signup');

// Show the login form (route assumed)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');


// User Login Route
Route::get('/user/login', [AuthController::class, 'showUserLogin'])->name('user.login');
Route::post('/user/login', [AuthController::class, 'handleUserLogin'])->name('user.login.submit');



Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

Route::get('/user/logout', [UserController::class, 'logout'])->name('user.logout');



Route::get('/restaurant/manage-orders', [RestaurantController::class, 'manageOrders'])->name('restaurant.manageOrders');
Route::get('/restaurant/view-reports', [RestaurantController::class, 'viewReports'])->name('restaurant.viewReports');



Route::get('/restaurant/add-food-item', [RestaurantController::class, 'addFoodItem'])->name('restaurant.addFoodItem');
Route::post('/restaurant/add-food-item', [RestaurantController::class, 'storeFoodItem'])->name('restaurant.storeFoodItem');

Route::get('/restaurant/food-items', [RestaurantController::class, 'viewFoodItems'])->name('restaurant.viewFoodItems');


Route::get('/food/{id}', [RestaurantController::class, 'productPage'])->name('food.product');
Route::post('/food/placeOrder', [RestaurantController::class, 'placeOrder'])->name('food.placeOrder');


