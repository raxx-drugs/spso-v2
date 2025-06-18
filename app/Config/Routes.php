<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Home page
$routes->get('/', 'AuthController::index'); // Display the login form
//Auth Routes
$routes->group('auth', function ($routes) {
    $routes->post('login', 'AuthController::login');// Handle login authorization
    $routes->get('logout', 'AuthController::logout');// Handle logout
    $routes->post('forgot-password', 'AuthController::forgotPassword');// Handle forgot password
});

//pages routes
$routes->get('dashboard', 'DashboardController::index');  // Display the form
$routes->get('getPageTitle', 'DashboardController::getPageTitle');

// employee-portal pages
$routes->get('employee-portal', 'DashboardController::page_employee_portal');  // Display the page
$routes->get('announcement', 'DashboardController::page_announcement');  // Display the announcement page
$routes->get('information', 'DashboardController::page_information');  // Display the information page
$routes->get('download', 'DashboardController::page_download');  // Display the download page
$routes->get('equipment', 'DashboardController::page_equipment');  // Display the download page
$routes->get('office-supply', 'DashboardController::page_office_supply');  // Display the office supply page

// request pages
$routes->get('request', 'DashboardController::page_make_request');  // Display the page
$routes->get('list-request', 'DashboardController::page_list_request');  // Display the announcement page

// installer pages
$routes->get('installer', 'DashboardController::page_installer');  // Display the page

// accomplishment page
$routes->get('accomplishment', 'DashboardController::page_accomplishment');  // Display the page


$routes->group('api', function ($routes) {
    //Users routes
    //$routes->group('user', ['filter' => 'role'], function ($routes) { //original route group with filter (change later)
    $routes->group('user', function ($routes) {
        $routes->post('add', 'Portal\UserController::addUser');                // Handle Insert
        $routes->get('list', 'Portal\UserController::fetchAllUser');          // Fetch all users
        $routes->get('(:num)', 'Portal\UserController::fetchUser/$1');             // Fetch user by ID
        $routes->put('update/(:num)', 'Portal\UserController::updateUser/$1'); // Update user by ID
        $routes->delete('delete/(:num)', 'Portal\UserController::deleteUser/$1');   // Delete user by ID
        $routes->get('archive/(:num)', 'Portal\UserController::archive/$1');        // Archive user by ID
        $routes->get('stats', 'Portal\UserController::getStats');
    });

    $routes->group('inventory', function ($routes) {
        $routes->group('it-equipment', function ($routes) {
            $routes->post('add', 'Inventory\ItEquipmentController::add');                // Handle insert
            $routes->get('list', 'Inventory\ItEquipmentController::fetchAll');          // Fetch all users
            $routes->get('(:num)', 'Inventory\ItEquipmentController::fetch/$1');             // Fetch user by ID
            $routes->put('update/(:num)', 'Inventory\ItEquipmentController::update/$1'); // Update user by ID
            $routes->delete('delete/(:num)', 'Inventory\ItEquipmentController::delete/$1');   // Delete user by ID
            $routes->delete('archive/(:num)', 'Inventory\ItEquipmentController::archive/$1');        // Archive user by ID
            $routes->get('stats', 'Inventory\ItEquipmentController::getStats');
        });
        $routes->group('office-supply', function ($routes) {
            $routes->post('add', 'Inventory\OfficeSupplyController::add');                // Handle insert
            $routes->get('list', 'Inventory\OfficeSupplyController::fetchAll');          // Fetch all users
            $routes->get('(:num)', 'Inventory\OfficeSupplyController::fetch/$1');             // Fetch user by ID
            $routes->put('update/(:num)', 'Inventory\OfficeSupplyController::update/$1'); // Update user by ID
            $routes->delete('delete/(:num)', 'Inventory\OfficeSupplyController::delete/$1');   // Delete user by ID
            $routes->delete('archive/(:num)', 'Inventory\OfficeSupplyController::archive/$1');        // Archive user by ID
            $routes->get('stats', 'Inventory\OfficeSupplyController::getStats');
        });
    });

    $routes->group('announcement', function ($routes) {
        $routes->post('add', 'Portal\AnnouncementController::add');                // Handle insert
        $routes->get('list', 'Portal\AnnouncementController::fetchAll');          // Fetch all users
        $routes->get('(:num)', 'Portal\AnnouncementController::fetch/$1');             // Fetch user by ID
        $routes->put('update/(:num)', 'Portal\AnnouncementController::update/$1'); // Update user by ID
        $routes->delete('delete/(:num)', 'Portal\AnnouncementController::delete/$1');   // Delete user by ID
        $routes->delete('archive/(:num)', 'Portal\AnnouncementController::archive/$1');        // Archive user by ID
        $routes->get('stats', 'Portal\AnnouncementController::getStats');

    });

    $routes->group('download', ['namespace' => 'App\Controllers\Portal'], function ($routes) {
        $routes->post('add', 'DownloadController::add');                // Handle insert
        $routes->get('list', 'DownloadController::fetchAll');          // Fetch all users
        $routes->get('(:num)', 'DownloadController::fetch/$1');             // Fetch user by ID
        $routes->put('update/(:num)', 'DownloadController::update/$1'); // Update user by ID
        $routes->delete('archive/(:num)', 'DownloadController::archive/$1');        // Archive user by ID
        $routes->delete('delete/(:num)', 'DownloadController::delete/$1');   // Delete user by ID
        $routes->get('stats', 'DownloadController::getStats');
        $routes->get('viewFile/(:num)', 'DownloadController::viewFile/$1');
        $routes->get('originalFile/(:num)', 'DownloadController::downloadOriginal/$1');



    });

    $routes->group('installer', function ($routes) {
        $routes->post('add', 'InstallerController::add');                // Handle insert
        $routes->get('list', 'InstallerController::fetchAll');          // Fetch all users
        $routes->get('(:num)', 'InstallerController::fetch/$1');             // Fetch user by ID
        $routes->put('update/(:num)', 'InstallerController::update/$1'); // Update user by ID
        $routes->delete('delete/(:num)', 'InstallerController::delete/$1');   // Delete user by ID
        $routes->delete('archive/(:num)', 'InstallerController::archive/$1');        // Archive user by ID
        $routes->get('stats', 'InstallerController::getStats');

    });


});
