<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    /**
     * Show the login page.
     */
    public function index()
    {
        return view('pages/login');
    }

    /**
     * Handle login logic and session setup.
     */
    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Fetch user data by email
        $userData = $this->userModelObj->where('user_email', $email)->first();

        if ($userData) {

            //if ($userData['user_password'] === $password) {
            // Secure password verification
            if (password_verify($password, $userData['user_password'])) {

                // Log login activity
                $logId = $this->logLogin(
                    $userData['user_fname'],
                    $userData['user_role'],
                    $userData['user_email'],
                    $userData['user_id']
                );

                // Set session data
                session()->set([
                    'user' => $userData['user_fname'],
                    'role' => $userData['user_role'],
                    'email' => $userData['user_email'],
                    'login_log_id' => $logId,
                ]);

                return redirect()->to('/dashboard');
            } else {
                // Incorrect password
                return redirect()->back()->with('error', 'Incorrect password');
            }
        } else {
            // User not found
            return redirect()->back()->with('error', 'User not found');
        }
    }


    /**
     * Log the login activity into the login_logs table.
     * 
     * @param string $fname
     * @param string $role
     * @param string $email
     * @param int    $fk   Foreign key to users table
     * @return int   Inserted log ID
     */
    private function logLogin($fname, $role, $email, $fk)
    {
        $dataToLog = [
            'login_email'   => $email,
            'login_role'    => $role,
            'login_name'    => $fname,
            'user_id_fk'    => $fk,
        ];

        $this->authObj->insert($dataToLog);
        return $this->authObj->getInsertID();
    }

    /**
     * Handle logout, update logout time in log, and destroy session.
     */
    public function logout()
    {
        // Update logout timestamp for the login session
        $loginLogId = session()->get('login_email');
        if ($loginLogId) {
            $this->authObj->update($loginLogId, [
                'login_email' => $loginLogId, // Ensure this field exists in the log table
            ]);
        }

        // Destroy the session
        session()->destroy();
        return redirect()->to('/');
    }
}
