<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index()
    {
        session()->set([
            'title' => "Dashboard",
        ]);
        return view("pages/dashboard");
    }

    /***********************************************************************************************
     * Employee Portal Pages
     ***********************************************************************************************/
    public function page_employee_portal()
    {
        session()->set([
            'title' => "Employee Portal",
            'current_page' => 'employee-portal',
            'sub_page' => 'information',
        ]);
        return view('pages/portal/employee_portal');
    }

    public function page_announcement()
    {
        session()->set([
            'title' => "Announcement",
            'current_page' => 'employee-portal',
        ]);
        return view('pages/portal/announcement');
    }

    public function page_information()
    {
        session()->set([
            'title' => "Information",
            'current_page' => 'employee-portal',
            'sub_page' => 'information',
        ]);
        return view('pages/portal/information');
    }

    public function page_download()
    {
        session()->set([
            'title' => "Download",
            'current_page' => 'employee-portal',
        ]);
        return view('pages/portal/download');
    }
    public function page_inventory()
    {
        session()->set([
            'title' => "Inventory",
            'current_page' => 'employee-portal',
        ]);
        return view('pages/portal/inventory');
    }


    /***********************************************************************************************
     * Request Pages
     ***********************************************************************************************/
    public function page_req_it_equipment()
    {
        session()->set([
            'title' => "Request IT Equipment",
            'current_page' => 'request',
        ]);
        return view('pages/request/req_it_equipment');
    }

    public function page_req_it_office_supply()
    {
        session()->set([
            'title' => "Request Office Supply",
            'current_page' => 'request',
        ]);
        return view('pages/request/req_office_supply');
    }
        public function page_req_leave()
    {
        session()->set([
            'title' => "Request Leave",
            'current_page' => 'request',
        ]);
        return view('pages/request/req_leave');
    }
        public function page_req_it_support()
    {
        session()->set([
            'title' => "Request It Support",
            'current_page' => 'request',
        ]);
        return view('pages/request/req_it_support');
    }
        /***********************************************************************************************
     * Attendance Pages
     ***********************************************************************************************/
    public function page_attendance()
    {
        session()->set([
            'title' => "Attendance",
            'current_page' => 'attendance',
        ]);
        return view('pages/attendance/attendance');
    }
    public function page_attendance_logs()
    {
        session()->set([
            'title' => "Attendance Logs",
            'current_page' => 'attendance',
        ]);
        return view('pages/attendance/attendance_log');
    }
    /***********************************************************************************************
     * Accomplishment Pages
     ***********************************************************************************************/
    public function page_accomplishment()
    {
        session()->set([
            'title' => "Accomplishment",
            'current_page' => 'accomplishment',
        ]);
        return view('pages/accomplishment/accomplishment');
    }

    /***********************************************************************************************
     * Inventory Pages
     ***********************************************************************************************/
    public function page_it_equipment()
    {
        session()->set([
            'title' => "Equipments",
            'current_page' => 'inventory',
        ]);
        return view('pages/inventory/it_equipment');
    }

    public function page_office_supply()
    {
        session()->set([
            'title' => "Office Supply",
            'current_page' => 'inventory',
        ]);
        return view('pages/inventory/office_supply');
    }

    /***********************************************************************************************
     * Installer Pages
     ***********************************************************************************************/
    public function page_installer()
    {
        session()->set([
            'title' => "Installer",
            'current_page' => 'installer',
        ]);
        return view('pages/installer/installer');
    }

}
