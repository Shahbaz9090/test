
<?php
     echo $this->load->view('header');
	 echo $this->load->view('left_sidebar');
	 echo $this->load->view('breadcrumb');
	 $this->load->view($main_content);
	 echo $this->load->view('footer');

?>
