			<!-- #section:basics/sidebar -->
			<div id="sidebar" class="sidebar                  responsive">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

			<!--	<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						 #section:basics/sidebar.layout.shortcuts 
						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>

						<!-- /section:basics/sidebar.layout.shortcuts -->
				<!--	</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div>--><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="<?php  _isModuleActive('dashboard');  ?>">
						<a data-url="page/index" href="<?php echo SITE_PATH  ?>dashboard">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>
                    <?php 
                         $userInfo = currentuserinfo();
                         $groupData = _getGroupData($userInfo->group_id);
                         $accessibleModules = $groupData->accessible_modules;
                         $accessibleModulesArray = explode('_', $accessibleModules);
                    ?>
                    <?php if(_isSuperAdmin()){  ?>
                    <li class="<?php  _isModuleActive('masters');  ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text">  Masters    </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php  _isSubMenuActive(array('referral'))  ?>">
								<a data-url="page/tables" href="<?php echo SITE_PATH?>masters/referral">
									<i class="menu-icon fa fa-caret-right"></i>
									Referral Source 
								</a>
								<a data-url="page/tables" href="<?php echo SITE_PATH?>masters/industry">
									<i class="menu-icon fa fa-caret-right"></i>
									Industry
								</a>

								<b class="arrow"></b>
							</li>

							
						</ul>
					</li>
                    <?php }  ?>
                    <?php  if(in_array(1,$accessibleModulesArray)){ ?>
					<li class="<?php  _isModuleActive('user');  ?>">
						<a href="#" class="dropdown-toggle ">
							<i class="menu-icon fa fa-user"></i>
							<span class="menu-text">
								User 
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							

    						<li class="<?php  _isSubMenuActive(array('user/group/list_items','user/group/add','user/group/edit','user/group/view'));  ?>">
    								<a data-url="page/typography" href="<?php echo SITE_PATH  ?>user/group/list_items">
    									<i class="menu-icon fa fa-caret-right"></i>
    									Groups
    								</a>
    
    								<b class="arrow"></b>
    						</li>
                            <li class="<?php  _isSubMenuActive(array('user/list_items','user/add','user/edit','user/view'));  ?>">
    							<a data-url="page/typography" href="<?php echo SITE_PATH  ?>user/list_items">
    								<i class="menu-icon fa fa-caret-right"></i>
    								Users
    							</a>
    
    							<b class="arrow"></b>
    						</li>
                               
						</ul>
					</li>
                    <?php  } ?>
                    <?php  if(in_array(2,$accessibleModulesArray)){ ?>
					<li class="<?php  _isModuleActive('form');  ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text">  Form    </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php  _isSubMenuActive(array('form'))  ?>">
								<a data-url="page/tables" href="<?php echo SITE_PATH?>form">
									<i class="menu-icon fa fa-caret-right"></i>
									Manage Forms
								</a>

								<b class="arrow"></b>
							</li>

							
						</ul>
					</li>
                    <?php  } ?>
                    
                    <?php  if(in_array(3,$accessibleModulesArray)){ ?>
                    <li class="<?php  _isModuleActive('permission');  ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-desktop"></i>
							<span class="menu-text">  Role &amp; Permission</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php  _isSubMenuActive(array('permission'))  ?>">
								<a data-url="page/tables" href="<?php echo SITE_PATH?>permission">
									<i class="menu-icon fa fa-caret-right"></i>
									Manage Permission
								</a>

								<b class="arrow"></b>
							</li>

							
						</ul>
					</li>
                    <?php }  ?>
                    <!--<li class="<?php  _isModuleActive('company');  ?>">
						<a href="#" class="dropdown-toggle ">
							<i class="menu-icon fa fa-user"></i>
							<span class="menu-text">
								Company 
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
    						<li class="<?php  _isSubMenuActive(array('user/group/list_items','user/group/add','user/group/edit','user/group/view'));  ?>">
    								<a data-url="page/typography" href="<?php echo SITE_PATH  ?>company/">
    									<i class="menu-icon fa fa-caret-right"></i>
    									Manage Company
    								</a>
    
    								<b class="arrow"></b>
    						</li> 
						</ul>
					</li>-->
                    <?php  if(in_array(4,$accessibleModulesArray)){ ?>
                    <li class="<?php  _isModuleActive('lead');  ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list-alt"></i>
							<span class="menu-text">  Lead  </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php  _isSubMenuActive(array('lead/list_items','lead/add','lead/edit','lead/view'))  ?>">
								<a data-url="page/tables" href="<?php echo SITE_PATH?>lead">
									<i class="menu-icon fa fa-caret-right"></i>
									Manage Leads
								</a>

								<b class="arrow"></b>
							</li>
                            
                            <li class="<?php  _isSubMenuActive(array('lead/list_items/archieved'))  ?>">
								<a data-url="page/tables" href="<?php echo SITE_PATH?>lead/list_items/archieved">
									<i class="menu-icon fa fa-caret-right"></i>
									Archived
								</a>

								<b class="arrow"></b>
							</li>

							
						</ul>
					</li>
                    <?php } ?>
                    <?php  $userInfo = currentuserinfo();  ?>
                    <?php  if(in_array(5,$accessibleModulesArray)){ ?>
                    <li class="<?php  _isModuleActive('opportunity');  ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa  fa-briefcase"></i>
							<span class="menu-text">  Opportunity </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
                            <?php  if(!_isSalesPerson()):  ?>
							<li class="<?php  _isSubMenuActive(array('opportunity/list_items/unassigned'))  ?>">
								<a data-url="page/tables" href="<?php echo SITE_PATH?>opportunity/list_items/unassigned">
									<i class="menu-icon fa fa-caret-right"></i>
									Unassigned
								</a>

								<b class="arrow"></b>
							</li>
                            <?php  endif; ?>
                            <li class="<?php  _isSubMenuActive(array('opportunity/list_items/working'))  ?>">
								<a data-url="page/tables" href="<?php echo SITE_PATH?>opportunity/list_items/working">
									<i class="menu-icon fa fa-caret-right"></i>
									Working
								</a>

								<b class="arrow"></b>
							</li>
                            <li class="<?php  _isSubMenuActive(array('user/list_items'))  ?>">
								<a data-url="page/tables" href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Closed Won
								</a>

								<b class="arrow fa fa-angle-down"></b>
                                
                                <!----------------------------->
                                <ul class="submenu nav-show" style="display: block;">
									<li class="">
										<a href="<?php echo SITE_PATH?>opportunity/list_items/won">
											<i class="menu-icon fa fa-caret-right"></i>
											Unbilled
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="<?php echo SITE_PATH?>opportunity/list_items/billed">
											<i class="menu-icon fa fa-caret-right"></i>
											Billed
										</a>

										<b class="arrow"></b>
									</li>
                                    	<li class="">
										<a href="<?php echo SITE_PATH?>opportunity/list_items/compelete">
											<i class="menu-icon fa fa-caret-right"></i>
											Compelete
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
                                <!----------------------------->
							</li>
                            <li class="<?php  _isSubMenuActive(array('opportunity/list_items/lost'));  ?>">
								<a data-url="page/tables" href="<?php echo SITE_PATH?>opportunity/list_items/lost">
									<i class="menu-icon fa fa-caret-right"></i>
									Closed Lost
								</a>

								<b class="arrow"></b>
							</li>
                            <li class="<?php  _isSubMenuActive(array('opportunity/list_items/disqualified'));  ?>">
								<a data-url="page/tables" href="<?php echo SITE_PATH?>opportunity/list_items/disqualified">
									<i class="menu-icon fa fa-caret-right"></i>
									Disqualified
								</a>

								<b class="arrow"></b>
							</li>

							
						</ul>
					</li>
                    <?php  } ?>
                    <?php  if(in_array(6,$accessibleModulesArray)){ ?>
                     <li class="<?php  _isModuleActive('task');  ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-calendar"></i>
							<span class="menu-text">  Task  </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php  _isSubMenuActive(array('task/list_items','task/add','task/edit','task/view'));  ?>">
								<a data-url="page/tables" href="<?php echo SITE_PATH?>task">
									<i class="menu-icon fa fa-caret-right"></i>
									Manage Tasks
								</a>

								<b class="arrow"></b>
							</li>
                            
                            <li class="<?php  _isSubMenuActive(array('task/mycalendar'))  ?>">
								<a data-url="page/tables" href="<?php echo SITE_PATH?>task/mycalendar">
									<i class="menu-icon fa fa-caret-right"></i>
									My Calendar
								</a>

								<b class="arrow"></b>
							</li>
                            
                          <!--  <li class="">
								<a data-url="page/tables" href="<?php echo SITE_PATH?>task/addTask">
									<i class="menu-icon fa fa-caret-right"></i>
									Manage Tasks
								</a>

								<b class="arrow"></b>
							</li>-->

							
						</ul>
					</li>
                   <?php } ?> 
                   
                    <?php  if(in_array(7,$accessibleModulesArray)){ ?>
                    <li class="<?php  _isModuleActive('product');  ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-barcode"></i>
							<span class="menu-text">  Product & Services  </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php  _isSubMenuActive(array('product/list_items','product/add','product/view','product/edit'))  ?>">
								<a data-url="page/tables" href="<?php echo SITE_PATH?>product">
									<i class="menu-icon fa fa-caret-right"></i>
									Product/Service
								</a>
								<b class="arrow"></b>
							</li>
                            <li class="<?php  _isSubMenuActive(array('product/list_items/subproduct','product/add/subproduct'))  ?>">
								<a data-url="page/tables" href="<?php echo SITE_PATH?>product/list_items/subproduct">
									<i class="menu-icon fa fa-caret-right"></i>
									Sub- Product/Service
								</a>
								<b class="arrow"></b>
							</li>

						</ul>
					</li>
                    <?php } ?>
                    <?php  if(in_array(8,$accessibleModulesArray)){ ?>
                    <li class="<?php  _isModuleActive('invoice');  ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-file-o"></i>
							<span class="menu-text">  Invoice  </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php  _isSubMenuActive(array('invoice','invoice/add','invoice/view','invoice/edit'));  ?>">
								<a data-url="page/tables" href="<?php echo SITE_PATH?>invoice">
									<i class="menu-icon fa fa-caret-right"></i>
									Manage Invoice
								</a>
								<b class="arrow"></b>
							</li>
                           
						</ul>
					</li>
                    <?php } ?>

				</ul><!-- /.nav-list -->

				<!-- #section:basics/sidebar.layout.minimize -->
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<!-- /section:basics/sidebar.layout.minimize -->
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>