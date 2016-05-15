<!--Elimarie Morales Santiago-->
<!--Advanced Server-Side Languages - Online-->
<!--Professor Orcun Tagtekin-->

<?php
/**
 * Created by PhpStorm.
 * User: iglitzi
 * Date: 5/10/16
 * Time: 11:01 PM
 */

class Home extends CI_Controller {
    public function index(){
        if($this->session->userdata('logged_in')){
            //Get the logged in users id
            $user_id = $this->session->userdata('user_id');
            //Get all lists from the model
            $data['lists'] = $this->List_model->get_all_lists($user_id);
            $data['tasks'] = $this->Task_model->get_users_tasks($user_id);
        }

        $data['main_content'] = 'home';
        $this->load->view('layouts/main',$data);
    }

}