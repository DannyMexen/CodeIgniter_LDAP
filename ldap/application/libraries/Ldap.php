<?php
/**
 * Ldap.php Library Doc Comment
 * PHP Version PHP 7.1.8-1ubuntu1
 *
 * @category Library
 * @package  None
 * @author   Display Name <dannymexen@gmail.com>
 * @license  https://choosealicense.com/licenses/mit/; MIT
 * @link     https://github.com/DannyMexen/CodeIgniter_LDAP
 */
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Ldap.php Library Doc Comment
 * PHP Version PHP 7.1.8-1ubuntu1
 *
 * @category Library
 * @package  None
 * @author   Display Name <dannymexen@gmail.com>
 * @license  https://choosealicense.com/licenses/mit/; MIT
 * @link     https://github.com/DannyMexen/CodeIgniter_LDAP
 */
class Ldap
{

    private $_connection;
    private $_bind;
    private $_host = "LDAP://...";
    private $_username = "...";
    private $_password = "...";
    private $_dn = "dc=...,dc=...,dc=...";
    private $_attributes = array("SAMAccountName",
        "...",
        "...",
        "...",
        // ...
    );
    
    /**
     * This is the constructor.
     *
     * It establishes an LDAP connection
     *
     * @return null
     */
    public function __construct()
    {
        $this->connection = ldap_connect($this->host);

        if (!$this->connection) {
            show_error("Sorry, Could not connect to Active Directory {$this->host}");
        }

        ldap_set_option($this->connection, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($this->connection, LDAP_OPT_REFERRALS, 0);
    }

    /**
     * This is the authetication function.
     *
     * It authenticates user input against LDAP credentials
     *
     * @param string $username Input from user
     * @param string $password Input from user
     *
     * @return array $response A user's profile
     */
    public function authenticate($username, $password)
    {
        $this->bind = @ldap_bind($this->connection, "...\\{$username}", $password);
        $response = array();

        if (!$this->bind) {
            $response['error'] = array("code" => ldap_errno($this->connection), "message" => ldap_error($this->connection));
            return $response;
        }

        
        $filter = "(&(objectClass=user)(objectCategory=person)
		(SAMAccountName={$username}))";

        $result = ldap_search(
            $this->connection, $this->dn, $filter, $this->attributes
        );

        $entry = ldap_first_entry($this->connection, $result);
        
        $attrs = ldap_get_attributes($this->connection, $entry);

        $user = array();

        for ($i = 0; $i < $attrs["count"]; $i++) {
            $values = ldap_get_values($this->connection, $entry, $attrs[$i]);
            $user[$attrs[$i]] = ($values['count'] == 1) ? $values[0] : $values;
        }

        $response = $user;
        $response['memberOf'] = is_array($response['memberOf']) ? $response['memberOf'] : array($response['memberOf']);
        $response['memberOf'] = array_values($response['memberOf']);
           
        return $response;
    }

    /**
     * This is the authetication function.
     *
     * It authenticates user input against LDAP credentials
     *
     * @param string $username Input from user
     *
     * @return array $response A user's profile
     */
    public function search_by_username($username)
    {
        $username = str_replace("@domain.example.com", "", $username);
        $this->bind = @ldap_bind($this->connection, "...\\" . $this->username, $this->password);
        $response = array();

        if (!$this->bind) {
            $response['success'] = false;
            $response['error'] = array("code" => ldap_errno($this->connection), "message" => ldap_error($this->connection));
            return $response;
        }


        $filter = "(&(objectClass=user)(objectCategory=person)(SAMAccountName={$username}))";

        $result = ldap_search($this->connection, $this->dn, $filter, $this->attributes);
      

        $entry = ldap_first_entry($this->connection, $result);
        $attrs = ldap_get_attributes($this->connection, $entry);

        $user = array();

        for ($i = 0; $i < $attrs["count"]; $i++) {
            $values = ldap_get_values($this->connection, $entry, $attrs[$i]);
            $user[$attrs[$i]] = ($values['count'] == 1) ? $values[0] : $values;
        }

        $response['success'] = true;
        $response = $user;
        return $response;
    }
}
