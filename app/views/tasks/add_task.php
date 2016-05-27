<h1>Add a Task</h1>
<p>List:<strong> <?php
        echo $list_name;
        ?></strong></p>


<?php echo $error;?> 
<?php

echo validation_errors('<p class="text-error">');
?>
    <?php //echo form_open_multipart('upload/do_upload');?>
<?php

echo form_open_multipart('tasks/add/' . $this->uri->segment(3) . '');
?>


<p>
    <?php
    echo form_label('Task Name:');
    ?>
    <?php
    $data = array(
        'name' => 'task_name',
        'value' => set_value('task_name')
    );
    ?>
    <?php
    echo form_input($data);
    ?>
</p>


<p>
    <?php
    echo form_label('Task Body:');
    ?>
    <?php
    $data = array(
        'name' => 'task_body',
        'value' => set_value('task_body')
    );
    ?>
    <?php
    echo form_input($data);
    ?>
</p>


<p>
    <?php
    echo form_label('Date:');
    ?>
    <input type="date" name="due_date" />
</p>
<h4>Upload File</h4>
    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="" />

    <label for="userfile">File</label>
    <input type="file" name="file" id="userfile" size="20" />


<?php
$data = array(
    "value" => "Add Task",
    "name"  => "submit",
    "class" => "btn btn-success"
);
?>
<p>
    <?php
    echo form_submit($data);
    ?>
     <button type="button" class="btn btn-warning">
    <a href="<?php echo base_url(); ?>" style="color: #fff">Cancel</a>
    </button>
</p>
<?php
echo form_close();
?>
