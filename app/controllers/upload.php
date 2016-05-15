<!--Elimarie Morales Santiago-->
<!--Advanced Server-Side Languages - Online-->
<!--Professor Orcun Tagtekin-->

<?php

class Upload extends CI_Controller {

    function index()
    {
        if (isset($_POST['submit']))
        {
            $this->load->library('upload');
            //$this->uploadfile($_FILES['userfile']);
            $files = $_FILES;
            $cpt = count($_FILES['userfile']['name']);
            for($i=0; $i<$cpt; $i++)
            {

                $_FILES['userfile']['name']= $files['userfile']['name'][$i];
                $_FILES['userfile']['type']= $files['userfile']['type'][$i];
                $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
                $_FILES['userfile']['error']= $files['userfile']['error'][$i];
                $_FILES['userfile']['size']= $files['userfile']['size'][$i];


                $this->upload->initialize($this->set_upload_options());
                $this->upload->do_upload();
                $this->upload->data();
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $img_ext_chk = array('jpg','png','gif','jpeg','JPG','PNG', 'GIF', 'JPEG');
                if (in_array($ext,$img_ext_chk))
                {
                    $this->asset->add_image($filename);
                }
                else
                {
                    $this->asset->add_document($filename);
                }
            }
        }
    }
}
$this->load->view("upload");

?>