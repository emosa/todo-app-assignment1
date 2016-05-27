<!--Elimarie Morales Santiago-->
<!--Advanced Server-Side Languages - Online-->
<!--Professor Orcun Tagtekin-->
<?php
class Lists extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')){

            $this->session->set_flashdata('need_login', 'Sorry, you need to be logged in to view that area');
            redirect('home/index');
        }
    }

    public function index(){

        $user_id = $this->session->userdata('user_id');

        $data['lists'] = $this->List_model->get_all_lists($user_id);


        $data['main_content'] = 'lists/index';
        $this->load->view('layouts/main',$data);
    }

    public function show($id){

        $data['list'] = $this->List_model->get_list($id);

        $data['completed_tasks'] = $this->List_model->get_list_tasks($id,true);

        $data['uncompleted_tasks'] = $this->List_model->get_list_tasks($id,false);


        $data['main_content'] = 'lists/show';
        $this->load->view('layouts/main',$data);
    }


    public function add(){
        $this->form_validation->set_rules('list_name','List Name','trim|required');
        $this->form_validation->set_rules('list_body','List Body','trim');

        if($this->form_validation->run() == FALSE){

            $data['main_content'] = 'lists/add_list';
            $this->load->view('layouts/main',$data);
        } else {

            $data = array(
                'list_name'    => $this->input->post('list_name'),
                'list_body'    => $this->input->post('list_body'),
                'list_user_id' => $this->session->userdata('user_id')
            );
            if($this->List_model->create_list($data)){
                $this->session->set_flashdata('list_created', 'Your task list has been created');
                //Redirect to index page with error above
                redirect('lists/index');
            }
        }
    }


    public function quickadd(){
        $this->form_validation->set_rules('list_name','List Name','trim|required');
        if($this->form_validation->run() == FALSE){

            $data['main_content'] = 'home';
            $this->load->view('layouts/main',$data);
        } else {
            $data['list_name'] = $this->input->post('list_name');

            $data['main_content'] = 'lists/add_list';
            $this->load->view('layouts/main',$data);
        }
    }


    public function edit($list_id){
        $this->form_validation->set_rules('list_name','List Name','trim|required');
        $this->form_validation->set_rules('list_body','List Body','trim');

        if($this->form_validation->run() == FALSE){

            $data['this_list'] = $this->List_model->get_list_data($list_id);

            $data['main_content'] = 'lists/edit_list';
            $this->load->view('layouts/main',$data);
        } else {

            $data = array(
                'list_name'    => $this->input->post('list_name'),
                'list_body'    => $this->input->post('list_body'),
                'list_user_id' => $this->session->userdata('user_id')
            );
            if($this->List_model->edit_list($list_id,$data)){
                $this->session->set_flashdata('list_updated', 'Your task list has been updated');

                redirect('lists/index');
            }
        }
    }


    public function delete($list_id){

        $this->List_model->delete_list($list_id);

        $this->session->set_flashdata('list_deleted', 'Your list has been deleted');

        redirect('lists/index');
    }
}


?>


