<?php
/**
 * Ldap_model.php Model Doc Comment
 * PHP Version PHP 7.1.8-1ubuntu1
 *
 * @category Model
 * @package  None
 * @author   Display Name <dannymexen@gmail.com>
 * @license  https://choosealicense.com/licenses/mit/; MIT
 * @link     https://github.com/DannyMexen/CodeIgniter_LDAP
 */

/**
 * Ldap_model.php Model Doc Comment
 * PHP Version PHP 7.1.8-1ubuntu1
 *
 * @category Model
 * @package  None
 * @author   Display Name <dannymexen@gmail.com>
 * @license  https://choosealicense.com/licenses/mit/; MIT
 * @link     https://github.com/DannyMexen/CodeIgniter_LDAP
 */
class Login_model extends CI_Model
{
    /**
     * This is the constructor.
     *
     * @return null
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * This is the login function.
     *
     * It passes user input for authentication
     *
     * @param string $username Input from user
     * @param string $password Input from user
     *
     * @return array $response User profile
     */
    public function login($username, $password)
    {
        $this->load->library('ldap');

        return $this->ldap->authenticate($username, $password);
    }
}
