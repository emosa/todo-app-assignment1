<!DOCTYPE html><head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
<a href="index.php"><title>To-Do's Always Remember</title></a>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/logo-nav.css" rel="stylesheet">

    <script type="text/javascript" src="js/jquery-1.12.2.min.js"></script>
</head>
<body>
<div class="navbar navbar-light" style="background-color: rgba(240, 233, 183, 0.8);">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo base_url(); ?>">
					<img class="logo" src="<?php echo base_url(); ?>assets/img/logo.png" alt="logo" width=""/>
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <p class="navbar-text pull-right">
                    <!--RIGHT TOP CONTENT-->
                    <?php if($this->session->userdata('logged_in')) : ?>
                        Welcome,  <?php echo $this->session->userdata('username'); ?>
                    <?php else : ?>
                        <a href="<?php echo base_url(); ?>users/register" style="color:#fff;">Register</a>
                    <?php endif; ?>
              </p>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="<?php echo base_url(); ?>">Home</a>
                    </li>
                     <?php if($this->session->userdata('logged_in')) : ?>
                        <li><a href="<?php echo base_url(); ?>lists">My Lists</a></li>
                    <?php endif; ?>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </div>
<div class="container-fluid" id="content1">
    <div class="row-fluid">
        <div class="span3">
            <div class="well sidebar-nav">
                <div style="margin:0 0 10px 10px;">
                    <!--SIDEBAR CONTENT-->
                    <?php $this->load->view('users/login'); ?>
                </div>
            </div><!--/.well -->
        </div><!--/span-->

        <div class="span9">
            <!--MAIN CONTENT-->
            <?php $this->load->view($main_content); ?>
        </div><!--/span-->
  </div><!--/row-->
    <hr>

    <div class="footer">
    <footer class="push">
        <p>&copy; 2016 Elimarie Morales Santiago ASL</p>
    </footer>
    </div>
</div><!--/.fluid-container-->
</body>
</html>