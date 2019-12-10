
<nav id="mainnav-container">
                <div id="mainnav">
                    <div id="mainnav-menu-wrap">
                        <div class="nano">
                            <div class="nano-content">
                                <ul id="mainnav-menu" class="list-group">
						            <li class="list-header">Main MENU</li>
						            <?php if ( array_key_exists('costing', $accessmenu)) { ?>
						            <li>
						                <a href="javascript:void(0)" onclick="App.loadTab('costing')">
						                    <i class="psi-bar-chart"></i>
						                    <span class="menu-title">Costing</span>
						                </a>
						            </li>
						            <?php }?>
						            
						            <?php if ( array_key_exists('model', $accessmenu)) { ?>
						            <li>
						                <a href="javascript:void(0)" onclick="App.loadTab('model')">
						                    <i class="psi-split-vertical-2"></i>
						                    <span class="menu-title">Model</span>
						                </a>
						            </li>
						            <?php }?>
						            
						            
						            
						            <li class="list-divider"></li>
						            <li class="list-header">Master</li>
						            
						            <?php if ( array_key_exists('defaultmaterial', $accessmenu)) { ?>
						            <li>
						                <a href="javascript:void(0)" onclick="App.loadTab('costing_default_material')">
						                    <i class="psi-file-html"></i>
						                    <span class="menu-title">Default Material</span>
						                </a>
						            </li>
						            <?php }?>
						            <?php if ( array_key_exists('directlabour', $accessmenu)) { ?>
						            <li>
						                <a href="javascript:void(0)" onclick="App.loadTab('directlabour')">
						                    <i class="psi-receipt-4"></i>
						                    <span class="menu-title">Direct Labour</span>
						                </a>
						            </li>
						            <?php }?>
						            
						            <?php if ( array_key_exists('rates', $accessmenu)) { ?>
						            <li>
						                <a href="javascript:void(0)" onclick="App.loadTab('rate')">
						                    <i class="psi-receipt-4"></i>
						                    <span class="menu-title">Rate</span>
						                </a>
						            </li>
						            <li>
						                <a href="javascript:void(0)" onclick="App.loadTab('rates')">
						                    <i class="psi-receipt-4"></i>
						                    <span class="menu-title">Daily Rates</span>
						                </a>
						            </li>
						            <?php }?>
						            
						            <?php if ( array_key_exists('user', $accessmenu)) { ?>
						            	<li class="list-divider"></li>
						            	<li class="list-header">CONFIGURATION</li>
							            <li>
							                <a href="javascript:void(0)" onclick="App.loadTab('user')">
							                    <i class="psi-receipt-4"></i>
							                    <span class="menu-title">User</span>
							                </a>
							            </li>
						            <?php }?>
						            
						        </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>