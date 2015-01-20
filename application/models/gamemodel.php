<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gamemodel extends CI_Model {

    public function createGame($user_id, $side){
        if($this->checkIfAvailable($user_id) == true) {
            if(!$side == 'human' || !$side == 'alien'){
                //Something fucked up happened and something else got sent in the function
                return false;
            }
            //Creategame code
            if($create = $this->db->query("INSERT INTO matches ({$side}, active, creator) VALUES ('{$user_id}', '1', '{$user_id}')")) {
                if($this->db->affected_rows() == 0){
                    #Some kind of error with db
                    return false;
                }
                $stmt = $this->db->query("SELECT id FROM matches WHERE alien = '{$user_id}' OR human = '{$user_id}' AND active= 1");
                if($stmt->num_rows() == 1) {
                    //User in a match now
                    return true;
                } else {
                    //User not in a match?? wtf???
                    return false;
                }
            } else {
                //Already in a game
                return false;
            }
        }
    }

    public function getAllActive() {
        $stmt = $this->db->query("SELECT id FROM matches WHERE active=1");
        if($stmt->num_rows == 1){
                return $stmt->result_array();
            } else {
                return false;
            }
    }

    public function checkIfActive($match_id) {
        $stmt = $this->db->query("SELECT active FROM matches WHERE id = '{$match_id}' AND active = 1");
        if($stmt->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function checkIfParticipating($user_id, $match_id) {
        $stmt = $this->db->query("SELECT active, human, alien FROM matches WHERE id = '{$match_id}'");
        if($stmt->num_rows() == 1) {
            $check = $stmt->result_array();
            if($check[0]['human'] == $user_id || $check[0]['alien'] == $user_id) {
                return true;
            }
        } else {
            return false;
        }
    }

    public function checkIfAvailable($user_id) {
        $stmt = $this->db->query("SELECT id FROM matches WHERE alien = '{$user_id}' OR human = '{$user_id}' AND active= 1");
        if($stmt->num_rows() == 0) {
            //User not in a match
            return true;
        } else {
            //User in a match! Can't join another
            return false;
        }
    }

}
