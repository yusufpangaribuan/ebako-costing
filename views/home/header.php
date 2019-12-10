<!--NAVBAR-->
        <!--===================================================-->
        <header id="navbar">
            <div id="navbar-container" class="boxed">
                <div class="navbar-header">
                    <a href="<?php echo base_url() ?>" class="navbar-brand">
                        <img src="<?php echo base_url() ?>assets/vendors/nifty/img/logo.png" class="brand-icon">
                        <div class="brand-title">
                            <span class="brand-text">Ebako Costing</span>
                        </div>
                    </a>
                </div>
                
                <div class="navbar-content clearfix">
                    <ul class="nav navbar-top-links pull-left">
                        <li class="tgl-menu-btn">
                            <a class="mainnav-toggle slide" href="#">
                                <i class="pli-view-list"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav navbar-top-links pull-right">
                        <li id="dropdown-user" class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                                <span class="pull-right">
                                    <img class="img-circle img-user media-object" src="<?php echo base_url() ?>assets/vendors/nifty/img/av1.png" alt="Profile Picture">
                                </span>
                                <div class="username hidden-xs"><?php echo $this->session->userdata('id') . "/" . @$this->model_employee->getNameById($this->session->userdata('id')) ?></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right panel-default">
                                <div class="pad-all text-right">
                                    <a href="home/logout" class="btn btn-primary">
                                        <i class="pli-unlock"></i> Logout
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </header>