<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Game extends MX_Controller {
    public function __construct() {
        $this->load->model('usermodel');
        $this->load->model('gamemodel');
    }

    public function gameIndex() {
        $header['title'] = "Create Match";
        $header['logged_in'] = false;
        if($this->usermodel->checkLogin() == true) {
            $header['username'] = $this->session->userdata('username');
            $header['access'] = $this->session->userdata('access');
            $header['user_id'] = $this->session->userdata('user_id');
            $header['logged_in'] = true;
            $header['available'] = false;
            if($this->gamemodel->checkIfAvailable($header['user_id']) == true) {
                $header['available'] = true;
            }
        }
        $this->load->helper('url');
        $this->load->view('header',$header);
        $this->load->view('creategame');
        $this->load->view('footer');
    }

    public function showActiveGames() {
        $data['activegames'] = $this->gamemodel->getAllActive();
        return $this->load->view('showactivematches', $data);
    }

    public function showGame($match_id) {
        $header['title'] = "Show Match ". $match_id;
        $header['logged_in'] = false;
        if($this->usermodel->checkLogin() == true) {
            $header['username'] = $this->session->userdata('username');
            $header['access'] = $this->session->userdata('access');
            $header['user_id'] = $this->session->userdata('user_id');
            $header['logged_in'] = true;
            $header['participating'] = false;
            if($this->gamemodel->checkIfParticipating($this->session->userdata('user_id'),$match_id) == true){
                $header['participating'] = true;
            }
        }
        $this->load->helper('url');
        $data['activematch'] = false;
        if($this->gamemodel->checkIfActive($match_id) == true) {
            $data['activematch'] = true;
        }
        $this->load->view('header',$header);
        $this->load->view('showgame', $data);
        $this->load->view('footer');
    }

    public function createGame($side) {
        if($side == 'human' || $side == 'alien'){
            if($user_id = $this->session->userdata('user_id')) {
                if($this->gamemodel->createGame($user_id, $side) == true) {
                    header("Location: /");
                } else {
                    return "Something went wrong!";
                }
            }
        }
    }

}
