<?php

/**
 * Ldap.php Controller Doc Comment
 * PHP Version PHP 7.1.8-1ubuntu1
 *
 * @category Model
 * @package  None
 * @author   Display Name <dannymexen@gmail.com>
 * @license  https://choosealicense.com/licenses/mit/; MIT
 * @link     https://github.com/DannyMexen/CodeIgniter_LDAP
 */

/**
 * Ldap.php Controller Doc Comment
 * PHP Version PHP 7.1.8-1ubuntu1
 *
 * @category Model
 * @package  None
 * @author   Display Name <dannymexen@gmail.com>
 * @license  https://choosealicense.com/licenses/mit/; MIT
 * @link     https://github.com/DannyMexen/CodeIgniter_LDAP
 */
class Login extends CI_Controller
{

    /**
     * This is the constructor.
     *
     * @return null
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('login_model', 'login');
    }
    
    /**
     * This is the index function, called automatically.
     *
     * It validates input and displays an appropriate message
     *
     * @return null
     */
    public function index()
    {
        $error['error_message'] = '';
        
        $success = '';

        $this->load->view('header');



        // Form validation rules
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        if ($this->form_validation->run() == true) {
            // Get the user values
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->login->login($username, $password);

            if (isset($user['error'])) {
                $error['error_message'] = $user['error']['message'];
            } else {
                $this->load->library('session');

                $this->session->set_userdata($user);

                $success = "Login was successful!";
            }
        }


        $data['messages'] = array($error['error_message'], $success);
        $this->load->view('login', $data);
        $this->load->view('footer');
    }
}
