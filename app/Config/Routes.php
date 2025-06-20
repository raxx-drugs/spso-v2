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
$routes->get('notifications/fetchAll', 'NotificationController::fetchAll');

// employee-portal pages

$routes->group('portal', function ($routes) {
    $routes->get('employee-portal', 'DashboardController::page_employee_portal');  // Display the page
    $routes->get('announcement', 'DashboardController::page_announcement');  // Display the announcement page
    $routes->get('information', 'DashboardController::page_information');  // Display the information page
    $routes->get('download', 'DashboardController::page_download');  // Display the download page
    $routes->get('inventory', 'DashboardController::page_inventory');  // Display the download page

});

// attendance pages
$routes->group('attendance', function ($routes) {
    $routes->get('manage-attendance', 'DashboardController::page_attendance');  // Display the page
    $routes->get('attendance-logs', 'DashboardController::page_attendance_logs');  // Display the page
});


// request pages
$routes->group('request', function ($routes) {
    $routes->get('it-equipment', 'DashboardController::page_req_it_equipment');  // Display the page
    $routes->get('office-supply', 'DashboardController::page_req_it_office_supply');  // Display the announcement page
    $routes->get('leave', 'DashboardController::page_req_leave');  // Display the page
    $routes->get('it-support', 'DashboardController::page_req_it_support');  // Display the announcement page

});

//inventory pages
$routes->group('inventory', function ($routes) {
    $routes->get('it-equipment', 'DashboardController::page_it_equipment');  // Display the download page
    $routes->get('office-supply', 'DashboardController::page_office_supply');  // Display the office supply page
});
// installer pages
$routes->get('installer', 'DashboardController::page_installer');  // Display the page

// accomplishment page
$routes->get('accomplishment', 'DashboardController::page_accomplishment');  // Display the page


$routes->group('api', function ($routes) {
    //Users routes
    //$routes->group('user', ['filter' => 'role'], function ($routes) { //original route group with filter (change later)
    $routes->group('user', ['namespace' => 'App\Controllers\Portal'], function ($routes) {
        $routes->post('add', 'UserController::add');                // Handle Insert
        $routes->get('list', 'UserController::fetchAll');          // Fetch all users
        $routes->get('(:num)', 'UserController::fetch/$1');             // Fetch user by ID
        $routes->put('update/(:num)', 'UserController::update/$1'); // Update user by ID
        $routes->delete('delete/(:num)', 'UserController::delete/$1');   // Delete user by ID
        $routes->get('archive/(:num)', 'UserController::archive/$1');        // Archive user by ID
        $routes->get('stats', 'UserController::getStats');
    });

    $routes->group('inventory', ['namespace' => 'App\Controllers\Inventory'], function ($routes) {
        $routes->group('it-equipment', function ($routes) {
            $routes->post('add', 'ItEquipmentController::add');                         // Insert
            $routes->get('list', 'ItEquipmentController::fetchAll');                    // Fetch all
            $routes->get('(:num)', 'ItEquipmentController::fetch/$1');                  // Fetch by ID
            $routes->put('update/(:num)', 'ItEquipmentController::update/$1');          // Update
            $routes->delete('archive/(:num)', 'ItEquipmentController::archive/$1');     // Archive
            $routes->delete('delete/(:num)', 'ItEquipmentController::delete/$1');       // Delete
            $routes->get('stats', 'ItEquipmentController::getStats');                   // Stats
        });

        $routes->group('office-supply', function ($routes) {
            $routes->post('add', 'OfficeSupplyController::add');                         // Insert
            $routes->get('list', 'OfficeSupplyController::fetchAll');                    // Fetch all
            $routes->get('(:num)', 'OfficeSupplyController::fetch/$1');                  // Fetch by ID
            $routes->put('update/(:num)', 'OfficeSupplyController::update/$1');          // Update
            $routes->delete('archive/(:num)', 'OfficeSupplyController::archive/$1');     // Archive
            $routes->delete('delete/(:num)', 'OfficeSupplyController::delete/$1');       // Delete
            $routes->get('stats', 'OfficeSupplyController::getStats');                   // Stats
        });
    });

    $routes->group('request', ['namespace' => 'App\Controllers\Request'], function ($routes) {
        $routes->group('it-equipment', function ($routes) {
            $routes->post('add', 'ReqItEquipmentController::add');                         // Insert
            $routes->get('list', 'ReqItEquipmentController::fetchAll');                    // Fetch all
            $routes->get('(:num)', 'ReqItEquipmentController::fetch/$1');                  // Fetch by ID
            $routes->put('update/(:num)', 'ReqItEquipmentController::update/$1');          // Update
            $routes->delete('archive/(:num)', 'ReqItEquipmentController::archive/$1');     // Archive
            $routes->delete('delete/(:num)', 'ReqItEquipmentController::delete/$1');       // Delete
            $routes->get('stats', 'ReqItEquipmentController::getStats');                   // Stats
        });

        $routes->group('office-supply', function ($routes) {
            $routes->post('add', 'ReqOfficeSupplyController::add');                         // Insert
            $routes->get('list', 'ReqOfficeSupplyController::fetchAll');                    // Fetch all
            $routes->get('(:num)', 'ReqOfficeSupplyController::fetch/$1');                  // Fetch by ID
            $routes->put('update/(:num)', 'ReqOfficeSupplyController::update/$1');          // Update
            $routes->delete('archive/(:num)', 'ReqOfficeSupplyController::archive/$1');     // Archive
            $routes->delete('delete/(:num)', 'ReqOfficeSupplyController::delete/$1');       // Delete
            $routes->get('stats', 'ReqOfficeSupplyController::getStats');                   // Stats
        });
            $routes->group('leave', function ($routes) {
            $routes->post('add', 'ReqLeaveController::add');                         // Insert
            $routes->get('list', 'ReqLeaveController::fetchAll');                    // Fetch all
            $routes->get('(:num)', 'ReqLeaveController::fetch/$1');                  // Fetch by ID
            $routes->put('update/(:num)', 'ReqLeaveController::update/$1');          // Update
            $routes->delete('archive/(:num)', 'ReqLeaveController::archive/$1');     // Archive
            $routes->delete('delete/(:num)', 'ReqLeaveController::delete/$1');       // Delete
            $routes->get('stats', 'ReqLeaveController::getStats');                   // Stats
        });
            $routes->group('it-support', function ($routes) {
            $routes->post('add', 'ReqItSupportController::add');                         // Insert
            $routes->get('list', 'ReqItSupportController::fetchAll');                    // Fetch all
            $routes->get('(:num)', 'ReqItSupportController::fetch/$1');                  // Fetch by ID
            $routes->put('update/(:num)', 'ReqItSupportController::update/$1');          // Update
            $routes->delete('archive/(:num)', 'ReqItSupportController::archive/$1');     // Archive
            $routes->delete('delete/(:num)', 'ReqItSupportController::delete/$1');       // Delete
            $routes->get('stats', 'ReqItSupportController::getStats');                   // Stats
        });
    });

    $routes->group('attendance', ['namespace' => 'App\Controllers\Attendance'], function ($routes) {
      
            $routes->post('add', 'AttendanceController::add');                         // Insert
            $routes->get('list', 'AttendanceController::fetchAll');                    // Fetch all
            $routes->get('(:num)', 'AttendanceController::fetch/$1');                  // Fetch by ID
            $routes->put('update/(:num)', 'AttendanceController::update/$1');          // Update
            $routes->delete('archive/(:num)', 'AttendanceController::archive/$1');     // Archive
            $routes->delete('delete/(:num)', 'AttendanceController::delete/$1');       // Delete
            $routes->get('stats', 'AttendanceController::getStats');                   // Stats
    });
    $routes->group('announcement', ['namespace' => 'App\Controllers\Portal'], function ($routes) {
        $routes->post('add', 'AnnouncementController::add');                // Handle insert
        $routes->get('list', 'AnnouncementController::fetchAll');          // Fetch all users
        $routes->get('(:num)', 'AnnouncementController::fetch/$1');             // Fetch user by ID
        $routes->put('update/(:num)', 'AnnouncementController::update/$1'); // Update user by ID
        $routes->delete('delete/(:num)', 'AnnouncementController::delete/$1');   // Delete user by ID
        $routes->delete('archive/(:num)', 'AnnouncementController::archive/$1');        // Archive user by ID
        $routes->get('stats', 'AnnouncementController::getStats');
        $routes->get('viewFile/(:num)', 'AnnouncementController::viewFile/$1');
        $routes->get('originalFile/(:num)', 'AnnouncementController::downloadOriginal/$1');
    });

    $routes->group('download', ['namespace' => 'App\Controllers\Portal'], function ($routes) {
        $routes->post('add', 'DownloadController::add');
        $routes->get('list', 'DownloadController::fetchAll');
        $routes->get('(:num)', 'DownloadController::fetch/$1');
        $routes->put('update/(:num)', 'DownloadController::update/$1');
        $routes->delete('archive/(:num)', 'DownloadController::archive/$1');
        $routes->delete('delete/(:num)', 'DownloadController::delete/$1');
        $routes->get('stats', 'DownloadController::getStats');
        $routes->get('viewFile/(:num)', 'DownloadController::viewFile/$1');
        $routes->get('originalFile/(:num)', 'DownloadController::downloadOriginal/$1');
    });

    $routes->group('installer', ['namespace' => 'App\Controllers\Installer'], function ($routes) {
        $routes->post('add', 'InstallerController::add');
        $routes->get('list', 'InstallerController::fetchAll');
        $routes->get('(:num)', 'InstallerController::fetch/$1');
        $routes->put('update/(:num)', 'InstallerController::update/$1');
        $routes->delete('archive/(:num)', 'InstallerController::archive/$1');
        $routes->delete('delete/(:num)', 'InstallerController::delete/$1');
        $routes->get('stats', 'InstallerController::getStats');
        $routes->get('viewFile/(:num)', 'InstallerController::viewFile/$1');
        $routes->get('originalFile/(:num)', 'InstallerController::downloadOriginal/$1');
    });



});