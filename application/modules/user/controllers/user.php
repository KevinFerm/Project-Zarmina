<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MX_Controller {

    public function __construct() {
        $this->load->model('usermodel');
    }
    /**
     * [loginForm description]
     * @return [type] [description]
     */
    public function loginForm() {
        $header['title'] = "Login";
        $header['logged_in'] = false;
        if($this->usermodel->checkLogin() == true) {
            $header['username'] = $this->session->userdata('username');
            $header['access'] = $this->session->userdata('access');
            $header['user_id'] = $this->session->userdata('user_id');
            $header['logged_in'] = true;
        }
        $this->load->view('header',$header);
        if($this->usermodel->checkLogin() == false) {
            $this->load->view('loginform');
        } else {
            header("Location: /");
        }

        $this->load->view('footer');
    }

    public function registerForm() {
        $header['title'] = "Register";
        $header['logged_in'] = false;
        if($this->usermodel->checkLogin() == true) {
            $header['username'] = $this->session->userdata('username');
            $header['access'] = $this->session->userdata('access');
            $header['user_id'] = $this->session->userdata('user_id');
            $header['logged_in'] = true;
        }
        $this->load->view('header',$header);
        if($this->usermodel->checkLogin() == false) {
            $this->load->view('registerform');
        } else {
            header("Location: /");
        }
        $this->load->view('footer');
    }
    /**
     * [login Login, uses table users and logs the user in]
     * @param  [str] $username [username]
     * @param  [str] $password [password]
     * @return [boolean] logged in [true/false]
     */
    function login($username, $password) {
        if($this->usermodel->login($username, $password) == true){
            return true;
        } elseif($this->usermodel->login($username, $password) == "falsepw") {
            return "lol";
        }
    }

    /**
     * [processLogin logs the user in]
     * @return [boolean] [true or redirect]
     */
    public function processLogin() {
        if($_POST['username'] && $_POST['pass']) {
            if($this->login($_POST['username'], $_POST['pass']) == true) {
                //Login success
                //Not sure what to do with this
                echo "success!";
            } else {
                //Login failed
                //Should redirect
                echo($this->login($username, $password));
            }
        } else {
            echo 'Invalid request';
        }
    }

    /**
     * [logout Destroys session]
     */
    public function logout() {
        $this->session->sess_destroy();
            header("Location: /");

    }



    /**
     * [register registers a user and does not log them in as of yet]
     * @param  [str] $username [description]
     * @param  [str] $password [description]
     * @param  [str] $email    [description]
     * @return redirect
     */
    function processRegister() {
        $error = "";
        if($_POST['username'] && $_POST['email'] && $_POST['pass']){
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
            if($this->usermodel->register($username, $password, $email) == true){
                #Register success!!
                echo "success!";
            } else {
                echo $this->usermodel->register($username, $password, $email);
            }
        } else {
            echo "noob";
        }
    }
}
