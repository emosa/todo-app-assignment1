<!--Elimarie Morales Santiago-->
<!--Advanced Server-Side Languages - Online-->
<!--Professor Orcun Tagtekin-->
<?php
class Tasks extends CI_Controller

{
    public

    function show($id)
    {
			$this->load->model('Files_Model');
        // Get single task info

        $data['task'] = $this->Task_model->get_task($id);
		//print_r($data['task']->file_id);exit;
        $data['file'] = $this->Files_Model->get_files($data['task']->file_id);

        // Check if marked complete

        $data['is_complete'] = $this->Task_model->check_if_complete($id);

        // Load view and layout

        $data['main_content'] = 'tasks/show';
        $this->load->view('layouts/main', $data);
    }

    public

    function add($list_id = null)
    {
        $this->form_validation->set_rules('task_name', 'Task Name', 'trim|required');
        $this->form_validation->set_rules('task_body', 'Task Body', 'trim');


		 $config['upload_path']   = './uploads/'; 
         $config['allowed_types'] = 'gif|jpg|png|jpeg|zip|rar|xlsx|xls|pdf|csv|txt|doc|docx|ppt'; 
         $config['max_size']      = 2048; 
         $this->load->library('upload', $config);

            $data['error'] =''; 
		if ($this->form_validation->run() == FALSE)
        {
            // Get list name for view

            $data['list_name'] = $this->Task_model->get_list_name($list_id);

            // Load view and layout

            $data['main_content'] = 'tasks/add_task';
            $this->load->view('layouts/main', $data);
        }
		else  if ( ! $this->upload->do_upload('file')) {
            $data['error'] = $this->upload->display_errors(); 
			

            $data['list_name'] = $this->Task_model->get_list_name($list_id);

            // Load view and layout

            $data['main_content'] = 'tasks/add_task';
            $this->load->view('layouts/main', $data);

            //$this->load->view('upload_form', $error); 
         }
        else
        {

			$this->load->model('Files_Model');
			$filename = ($this->upload->data('file_name'));
            $data = array(
                'filename' => $filename ,
                'title' => $this->input->post('title')
            );
			$this->Files_Model->insert_file($filename,$this->input->post('title'));
			$file_id = $this->db->insert_id();
            // Post values to array

            //$data = array('upload_data' => $this->upload->data()); 



            $data = array(
                'task_name' => $this->input->post('task_name') ,
                'task_body' => $this->input->post('task_body') ,
                'due_date' => $this->input->post('due_date') ,
                'list_id' => $list_id ,
                'file_id' => $file_id
            );
            if ($this->Task_model->create_task($data))
            {
                $this->session->set_flashdata('task_created', 'Your task has been created');

                // Redirect to index page with error above

                redirect('lists/show/' . $list_id . '');
            }
        }
    }

    public

    function edit($task_id)
    {
        $this->form_validation->set_rules('task_name', 'Task Name', 'trim');
        $this->form_validation->set_rules('task_body', 'Task Body', 'trim');
		
		 $config['upload_path']   = './uploads/'; 
         $config['allowed_types'] = 'gif|jpg|png|jpeg|zip|rar|xlsx|xls|pdf|csv|txt|doc|docx|ppt'; 
         $config['max_size']      = 2048; 
         $this->load->library('upload', $config);

            $data['error'] =''; 



        if ($this->form_validation->run() == FALSE)
        {

            // Get list id

            $data['list_id'] = $this->Task_model->get_task_list_id($task_id);

            // Get list name for view

            $data['list_name'] = $this->Task_model->get_list_name($data['list_id']);

            // Get the current task info

            $data['this_task'] = $this->Task_model->get_task_data($task_id);

            // Load view and layout

			$this->load->model('Files_Model');

			//print_r($data['task']->file_id);exit;
			$data['file'] = $this->Files_Model->get_files($data['this_task']->file_id);




            $data['main_content'] = 'tasks/edit_task';
            $this->load->view('layouts/main', $data);
        }
        else
        {

            // Get list id
			//$this->upload->do_upload('file');
			//$this->upload->data('file_name');exit;

 			$this->input->post('alreadyuploadedfile');
			if($this->upload->do_upload('file'))
			{
			
				$this->load->model('Files_Model');
				$filename = ($this->upload->data('file_name'));
				$data = array(
					'filename' => $filename ,
					'title' => $this->input->post('title')
				);
				$this->Files_Model->insert_file($filename,$this->input->post('title'));
				$file_id = $this->db->insert_id();
	
			
				$list_id = $this->Task_model->get_task_list_id($task_id);
	
				// Post values to array
	
				$data = array(
					'task_name' => $this->input->post('task_name') ,
					'task_body' => $this->input->post('task_body') ,
					'due_date' => $this->input->post('due_date') ,
					'list_id' => $list_id ,
					'file_id' => $file_id
				);

			}
			else
			{
				
						
				$list_id = $this->Task_model->get_task_list_id($task_id);
	
				// Post values to array
	
				$data = array(
					'task_name' => $this->input->post('task_name') ,
					'task_body' => $this->input->post('task_body') ,
					'due_date' => $this->input->post('due_date') ,
					'list_id' => $list_id 
					);

	
			}
            if ($this->Task_model->edit_task($task_id, $data))
            {
                $this->session->set_flashdata('task_updated', 'Your task has been updated');

                // Redirect to index page with error aboves

                redirect('lists/show/' . $list_id . '');
            }
        }
    }

    public

    function mark_complete($task_id)
    {
        if ($this->Task_model->mark_complete($task_id))
        {
            $list_id = $this->Task_model->get_task_list_id($task_id);

            // Create Message

            $this->session->set_flashdata('marked_complete', 'Task has been marked complete');
            redirect('/lists/show/' . $list_id . '');
        }
    }

    public

    function mark_new($task_id)
    {
        if ($this->Task_model->mark_new($task_id))
        {
            $list_id = $this->Task_model->get_task_list_id($task_id);

            // Create Message

            $this->session->set_flashdata('marked_new', 'Task has been marked new');
            redirect('/lists/show/' . $list_id . '');
        }
    }

    public

    function delete($list_id, $task_id)
    {

        // Delete list

        $this->Task_model->delete_task($task_id);

        // Create Message

        $this->session->set_flashdata('task_deleted', 'Your task has been deleted');

        // Redirect to list index

        redirect('lists/show/' . $list_id . '');
    }
}

