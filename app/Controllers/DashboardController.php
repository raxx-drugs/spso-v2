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

    public function page_equipment()
    {
        session()->set([
            'title' => "Equipments",
            'current_page' => 'employee-portal',
        ]);
        return view('pages/portal/it_equipment');
    }

        public function page_office_supply()
    {
        session()->set([
            'title' => "Office Supply",
            'current_page' => 'employee-portal',
        ]);
        return view('pages/portal/office_supply');
    }

    /***********************************************************************************************
     * Request Pages
     ***********************************************************************************************/
    public function page_make_request()
    {
        session()->set([
            'title' => "Request",
            'current_page' => 'request',
        ]);
        return view('pages/request/request');
    }

    public function page_list_request()
    {
        session()->set([
            'title' => "List of Request",
            'current_page' => 'request',
        ]);
        return view('pages/request/list_request');
    }
    /***********************************************************************************************
     * Installer Pages
     ***********************************************************************************************/
    public function page_accomplishment()
    {
        session()->set([
            'title' => "Accomplishment",
            'current_page' => 'accomplishment',
        ]);
        return view('pages/accomplishment');
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
        return view('pages/installer');
    }

}
