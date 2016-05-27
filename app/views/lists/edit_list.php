<!--Elimarie Morales Santiago-->
<!--Advanced Server-Side Languages - Online-->
<!--Professor Orcun Tagtekin-->

<h1>Edit List</h1>

<?php echo validation_errors('<p class="text-error">'); ?>
 <?php echo form_open('lists/edit/'.$this_list->id.''); ?>

<p>
<?php echo form_label('List Name:'); ?>
<?php
$data = array(
              'name'        => 'list_name',
              'value'       => $this_list->list_name
            );
?>
<?php echo form_input($data); ?>
</p>

<p>
<?php echo form_label('List Body:'); ?>
<?php
$data = array(
              'name'        => 'list_body',
              'value'       => $this_list->list_body
            );
?>
<?php echo form_textarea($data); ?>
</p>


<?php $data = array("value" => "Update List",
                    "name" => "submit",
                    "class" => "btn btn-success"); ?>
<p>
    <?php echo form_submit($data); ?>
</p>
<?php echo form_close(); ?>
<a href="<?php
echo base_url();
?>lists"><- Go Back to Lists</a>
