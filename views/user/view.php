<script src="<?php echo base_url() ?>js/user.js"></script>

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">User</h3>
    </div>

    <div class="panel-body" id="menu_content_rate">
        <div class="pad-btm form-inline">
            <div class="row">
                <div class="col-sm-12 table-toolbar-left">
                    <div id="rate_search_form" onsubmit="return ;">
			            <span class="labelelement">ID :</span><input type="text" id="id_s" name="id_s" autocomplete="off" size="9" onkeypress="if(event.keyCode==13){user_search(0)}"/>
				        <span class="labelelement">Name :</span><input type="text" id="name_s" name="name_s" autocomplete="off"  size="9" onkeypress="if(event.keyCode==13){user_search(0)}"/>
				        <button onclick="user_search(0)">Search</button>
			           
			           <?php if ($this->session->userdata('id') == 'admin') { ?>
				            <button onclick="user_add()">Add</button>
				       <?php } ?>
				       
			        </div>
	            </div>
	        </div>
        	<div id="userdata" class="row">
				<?php $this->load->view('user/search') ?>
	    </div>
    </div>
</div>
