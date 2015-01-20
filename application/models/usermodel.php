<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usermodel extends CI_Model {
    /**
     *Checks if logged in
     *Compares sessions etc.
     */
    function checkLogin() {
        if($this->session->userdata('user_id')) {
        $user_id = $this->session->userdata('user_id');
        $username = $this->session->userdata('username');
        $loginstring = $this->session->userdata('loginstring');
        $browser = $_SERVER['HTTP_USER_AGENT'];
        #SORRY QUERY SHOULDNT BE HERE :(
        if($stmt = $this->db->query("SELECT password FROM users WHERE id = '{$user_id}'")) {
            if($stmt->num_rows() == 1) {
                $pw = $stmt->result_array();
                $login_check = hash('sha512', $pw[0]['password'] . $browser);
                if($login_check == $loginstring) {
                    #YOU ARE LOGGED IN!!
                    return true;
                } else {
                    #not logged in
                    return $login_check;
                }
            } else {
                #not loggged in
                return $login_check;
            }
        } else {
            #not logged in
            return $login_check;
        }
        } else {
            #not logged in
            return false;
        }
    }

    /**
     * [login checks if user and pw match, then logs a user in]
     * @param  [str] $username
     * @param  [str] $password
     * @return [boolean] [True or False]
     */
    function login($username, $password) {
        $dbs = $this->db->query("SELECT id, username, password, salt, access FROM users WHERE username = '{$username}'");
        $login = $dbs->result_array();
        $pass = hash('sha512', $password . $login[0]['salt']);
        if($dbs->num_rows() == 1) {
            if($login[0]['password'] == $pass) {
                $browser = $_SERVER['HTTP_USER_AGENT'];
                $user_id = preg_replace("/[^0-9]+/", "", $login[0]['id']);
                $user = preg_replace("/[^0-9]+/", "", $login[0]['username']);
                $this->session->set_userdata(array(
                            'user_id'       => $user_id,
                            'username'      => $username,
                            'access'        => $login[0]['access'],
                            'loginstring'   => hash('sha512', $pass . $browser),
                            'status'        => TRUE
                            ));
                return true;
            } else {
                #Wrong pw at this point
                return "falsepw";
            }
        } else {
            #no user by that name
            return "falsename";
        }
        }

    /**
     * [register]
     * @param  [str] $username
     * @param  [str] $password
     * @param  [str] $email
     * @return boolean
     */
    function register($username, $password, $email) {
        $error = "";
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = '<p class="error">Not a valid email</p>';
        }

        $stmt = $this->db->query("SELECT id from users WHERE email = '{$email}'");
        if($stmt->num_rows() == 1){
            $error .= '<p class="error">A user with this email address already exists.</p>';
        }

        if(empty($error)){
            $salt = $this->generate_random_string(16);
            $hashpw = hash('sha512', $password . $salt);

            if($reg = $this->db->query("INSERT INTO users (username, password, salt, email) VALUES ('{$username}', '{$hashpw}', '{$salt}', '{$email}')")){
                if($this->db->affected_rows() == 0){
                    #Some kind of error with db
                    return false;
                }
                $stmts = $this->db->query("SELECT username FROM users WHERE username = '{$username}'");
                if($stmts->num_rows() == 1){
                    return true;
                }
            }
        } else {
            return $error;
        }
    }

    public function generate_random_string($nbletters){
            $randString="";
            $charUniverse="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-=";
            for($i=0; $i<$nbletters; $i++){
                    $randInt=rand(0,(strlen($charUniverse)-1));
                    $randChar=$charUniverse[$randInt];
                    $randString=$randString.$randChar;
            }
            return $randString;
    }

}
