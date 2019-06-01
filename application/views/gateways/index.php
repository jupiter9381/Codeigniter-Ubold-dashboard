<div class="container-fluid">
	<!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Gateways</li>
                    </ol>
                </div>
                <h4 class="page-title">Gateways</h4>
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
    		<div class="card-box">
    			<div class="col-12 text-sm-center form-inline mb-3">
    				<div class="form-group mr-2">
    					<?php if($user->gateway_status[1] == '1'){?>
                        <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#add-modal"><i class="mdi mdi-plus-circle mr-2" ></i> Add New Row</button>
                        <?php }?>
                    </div>
                    <div class="form-group">
                        <input id="search-field" type="text" placeholder="Search" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group" style="position: absolute; right: 0;">
	                	<label class="form-inline mb-3 mt-3 mr-2">
	                        Show
	                        <select id="page-size" class="form-control form-control-sm ml-1 mr-1">
	                            <option value="5">5</option>
	                            <option value="5">10</option>
	                            <option value="20" selected>20</option>
	                            <option value="50">50</option>
	                        </select>
	                        entries
	                    </label>
	                </div>
    			</div>
    			
    			
    			<table id="gateways-table" class="table table-bordered table-striped table-hover table-responsive" data-filter="#search-field" data-page-size="20" data-paging="true" data-paging-container="#page-size" style="width: 100%;">
    				<thead>
	                   	<tr>
	                        <?php if($user->gateway_status[3] == '1'){?>
	                   			<th></th>
	                   		<?php }?>
	                        <th>Name</th>
	                        <th>Tariff</th>
	                        <th>Group Name</th>
	                        <th>Account State</th>
	                        <th>Calls Limit</th>
	                        <th>Cps Limit</th>
	                        <th>Active</th>
	                        <th>Type</th>
	                        <th>IP</th>
	                        <th>Strip</th>
	                        <th>Prefix</th>
	                        <th>Attrs</th>
	                        <th style="min-width: 105px;"></th>
	                    </tr>
                   	</thead>
                   	<tbody>
                   		<?php foreach ($gateways as $value) { ?>
	                   		<tr>
	                   			<?php if($user->gateway_status[3] == '1'){?>
	                            <td>
	                            	<div class="checkbox checkbox-primary" style="line-height: 0px;">
                                        <input id="checkbox<?= $value->gw_id;?>" type="checkbox" class="del-check" value=<?= $value->gw_name;?>>
                                        <label for="checkbox<?= $value->gw_id;?>">
                                        </label>
                                    </div>
	                            </td>
	                            <?php }?>
	                            <td><?= $value->gw_name;?></td>
	                            <td><?= $value->tariff_name;?></td>
	                            <td><?= $value->destgroupname;?></td>
	                            <td><?= $value->account_state;?></td>
	                            <td><?= $value->calls_limit;?></td>
	                            <td><?= $value->cps_limit;?></td>
	                            <td>
	                            	<?php if($value->active == "1"){?>
	                            		<span class="badge label-table badge-success">Active</span>
	                            	<?php } else {?>
	                            		<span class="badge label-table badge-secondary">Disabled</span>
	                            	<?php }?>	                            	
	                            </td>
	                            <td><?= $value->type;?></td>
	                            <td><?= $value->address;?></td>
	                            <td><?= $value->strip;?></td>
	                            <td><?= $value->pri_prefix;?></td>
	                            <td><?= $value->attrs;?></td>
	                            <td style="">
	                            	<?php if($user->gateway_status[2] == '1'){?>
	                            	<button type="button" class="btn btn-blue waves-effect waves-light edit-btn mr-1 btn-xs" gateway-name="<?= $value->gw_name;?>" data-toggle="modal" data-target="#edit-modal"><i class="mdi mdi-settings"></i></button>
	                            	<?php }?>
	                            	<?php if($user->gateway_status[4] == '1'){?>
	                            	<button type="button" class="btn btn-success waves-effect waves-light duplicate-btn btn-xs" gateway-name="<?= $value->gw_name;?>" data-toggle="modal" data-target="#duplicate-modal"><i class="mdi mdi-content-copy"></i></button>
	                            	<?php }?>
	                            </td>
	                        </tr>
                    	<?php }?>
                   	</tbody>
                   	<tfoot>
                        <tr class="active">
                        	<?php if($user->gateway_status[3] == '1'){?>
                        	<td colspan="2" style="border-right: none;">
                        		<button class="btn btn-danger" data-toggle="modal" data-target="#delete-modal" disabled=""><i class="mdi mdi-close-circle mr-1"></i>Delete</button>
                        	</td>
                        	<?php }?>
                            <td colspan="15" style="border-left: none;">
                                <div class="text-right">
                                    <ul class="pagination pagination-split justify-content-end footable-pagination m-t-10"></ul>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
               </table>
    		</div>
    	</div>
    </div>
    <!-- end page title --> 
</div>
<div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; top: 8%;">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	        <div class="modal-header">
	            <h4 class="modal-title">Add Gateway</h4>
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        </div>
	        <form method="post" action="<?= base_url();?>gateway/add">
	              <div class="modal-body p-4">
	                  <div class="row">
	                      <div class="col-md-6">
	                          <div class="form-group">
	                              <label for="field-1" class="control-label">Gateway Name</label>
	                              <input type="text" class="form-control" placeholder="Title" name="gw_name" minlength="2" required>
	                          </div>
	                      </div>
	                      <div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-1" class="control-label">Dest Group Name</label>
	                              	<select class="form-control" name="destgroupname">
	                              		<option value="none">None</option>
	                              		<?php foreach($destgroupnames as $value){?>
	                              			<option><?= $value->name;?></option>
	                              		<?php }?>
	                              	</select>
	                          </div>
	                      	</div>
	                      
	                  </div>
	                  	<div class="row">
	                      	<div class="col-md-6 tariff_pl" >
		                        <div class="form-group">
	                              	<label for="field-1" class="control-label">Tariff Name</label>
	                              	<select class="form-control" name="tariff_name">
	                              		<?php foreach($tariff_pl_names as $value){?>
	                              			<option><?= $value->tariffname;?></option>
	                              		<?php }?>
	                              	</select>
		                        </div>
	                      	</div>
	                      	<div class="col-md-6 tariff" style="display: none;">
		                        <div class="form-group">
	                              	<label for="field-1" class="control-label">Tariff Name</label>
	                              	<select class="form-control" name="tariff_name" disabled="true">
	                              		<?php foreach($tariff_names as $value){?>
	                              			<option><?= $value->tariffname;?></option>
	                              		<?php }?>
	                              	</select>
		                        </div>
	                      	</div>
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Calls Limit</label>
	                              	<input class="strip" data-toggle="touchspin" type="text" value="300" name="calls_limit" maxlength="6">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">CPS Limit</label>
	                              	<input class="strip" data-toggle="touchspin" type="text" value="30" name="cps_limit" maxlength="6">
	                          	</div>
	                      	</div>
	                  	</div>
	                 	<div class="row">
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Account State</label>
	                              	<input class="account_state form-control" type="text" value="0" name="account_state" maxlength="6" readonly="">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-6 mt-3">
	                      		<div class="row form-group">
	                      			<div class="col-md-4">
	                      				<button class="btn btn-primary btn-block" data-toggle="collapse" data-target="#collapsePayment" aria-expanded="false" aria-controls="collapseExample" type="button"><i class="mdi mdi-plus-circle" ></i> Add</button>
	                      			</div>
	                      			<div class="col-md-8">
	                      				<div class="collapse" id="collapsePayment">
	                      					<div class="row form-group">
	                      						<div class="col-md-6"><input type="text" class="form-control payment_amount" data-toggle="input-mask" data-mask-format="099999.09" placeholder=""></div>
	                      						<div class="col-md-6"><button class="btn btn-primary add_payment_btn" type="button">Ok</button></div>
	                      					</div>
			                            </div>
	                      			</div>
	                      		</div>
	                      	</div>
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label" style="display: block;">Active</label>
	                              	<input type="checkbox" checked data-plugin="switchery" data-color="#ff5d48" name="active" class="js-switch form-control" />
	                          	</div>
	                      	</div>
	                 	</div>
	                 	<div class="row">
	                 		<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Type</label>
	                              	<select class="form-control" name="type">
	                              		<option>0</option>
	                              		<option>1</option>
	                              	</select>
	                          	</div>
	                      	</div>
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Strip</label>
	                              	<input class="strip" data-toggle="touchspin" type="text" value="0" name="strip" maxlength="6">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Ip Address</label>
	                              	<input type="text" class="form-control" name="ip_address" data-toggle="input-mask" data-mask-format="099.099.099.099" placeholder="xxx.xxx.xxx.xxx" required>
	                          	</div>
	                      	</div>
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Pri Prefix</label>
	                              	<input type="text" class="form-control" name="pri_prefix" >
	                          	</div>
	                      	</div>
	                 	</div>
	                 	<div class="row">
	                 		<div class="col-md-3">
	                 			<div class="form-group">
	                              	<label for="field-4" class="control-label">Attrs</label>
	                              	<input type="text" class="form-control" name="attrs" >
	                          	</div>
	                 		</div>
	                 		<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Probe Mode</label>
	                              	<input class="strip" data-toggle="touchspin" type="text" value="0" name="probe_mode" maxlength="6">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">State</label>
	                              	<select class="form-control" name="state">
	                              		<option>0</option>
	                              	</select>
	                          	</div>
	                      	</div>
	                      	<div class="col-md-3">
	                 			<div class="form-group">
	                              	<label for="field-4" class="control-label">Socket</label>
	                              	<input type="text" class="form-control" name="socket" >
	                          	</div>
	                 		</div>
	                 	</div>
	                 	<div class="row">
	                 		<div class="col-md-6">
	                 			<div class="form-group">
	                              	<label for="field-4" class="control-label">Description</label>
	                              	<input type="text" class="form-control" name="description" >
	                          	</div>
	                 		</div>
	                 	</div>
	              </div>
	              <div class="modal-footer">
	                  <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
	                  <button type="submit" class="btn btn-info waves-effect waves-light">Save changes</button>
	              </div>
	        </form>
	          
	    </div>
	</div>
</div>

<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; top: 8%;">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	        <div class="modal-header">
	            <h4 class="modal-title">Edit Gateway</h4>
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        </div>
	        <form method="post" action="<?= base_url();?>gateway/update">
	        	<input type="hidden" name="gw_id" value="">
	            <div class="modal-body p-4">
	                <div class="row">
	                      <div class="col-md-6">
	                          <div class="form-group">
	                              <label for="field-1" class="control-label">Gateway Name</label>
	                              <input type="text" class="form-control" placeholder="Title" name="gw_name">
	                          </div>
	                      </div>
	                      <div class="col-md-6">
	                          <div class="form-group">
	                              	<label for="field-1" class="control-label">Dest Group Name</label>
	                              	<select class="form-control" name="destgroupname">
	                              		<option value="none">None</option>
	                              		<?php foreach($destgroupnames as $value){?>
	                              			<option><?= $value->name;?></option>
	                              		<?php }?>
	                              	</select>
	                          </div>
	                      </div>
	                  	</div>
	                  	<div class="row">
	                      <div class="col-md-6 tariff_pl" >
		                        <div class="form-group">
	                              	<label for="field-1" class="control-label">Tariff Name</label>
	                              	<select class="form-control" name="tariff_name">
	                              		<?php foreach($tariff_pl_names as $value){?>
	                              			<option><?= $value->tariffname;?></option>
	                              		<?php }?>
	                              	</select>
		                        </div>
	                      	</div>
	                      	<div class="col-md-6 tariff" style="display: none;">
		                        <div class="form-group">
	                              	<label for="field-1" class="control-label">Tariff Name</label>
	                              	<select class="form-control" name="tariff_name" disabled="true">
	                              		<?php foreach($tariff_names as $value){?>
	                              			<option><?= $value->tariffname;?></option>
	                              		<?php }?>
	                              	</select>
		                        </div>
	                      	</div>
	                      <div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Calls Limit</label>
	                              	<input class="strip" data-toggle="touchspin" type="text" value="300" name="calls_limit" maxlength="6">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">CPS Limit</label>
	                              	<input class="strip" data-toggle="touchspin" type="text" value="30" name="cps_limit" maxlength="6">
	                          	</div>
	                      	</div>
	                  	</div>
	                 	<div class="row">
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Account State</label>
	                              	<input class="account_state form-control" type="text" value="0" name="account_state" maxlength="6" readonly="">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-6 mt-3">
	                      		<div class="row form-group">
	                      			<div class="col-md-4">
	                      				<button class="btn btn-primary btn-block" data-toggle="collapse" data-target="#collapseEditPayment" aria-expanded="false" aria-controls="collapseExample" type="button"><i class="mdi mdi-plus-circle" ></i> Add</button>
	                      			</div>
	                      			<div class="col-md-8">
	                      				<div class="collapse" id="collapseEditPayment">
	                      					<div class="row form-group">
	                      						<div class="col-md-6"><input type="text" class="form-control edit_payment_amount" data-toggle="input-mask" data-mask-format="099999.09" placeholder=""></div>
	                      						<div class="col-md-6"><button class="btn btn-primary edit_payment_btn" type="button">Ok</button></div>
	                      					</div>
			                            </div>
	                      			</div>
	                      		</div>
	                      	</div>
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label" style="display: block;">Active</label>
	                              	<input type="checkbox" checked data-plugin="switchery" data-color="#ff5d48" name="active" class="js-switch-edit form-control" />
	                          	</div>
	                      	</div>
	                 	</div>
	                 	<div class="row">
	                 		<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Type</label>
	                              	<select class="form-control" name="type">
	                              		<option>0</option>
	                              		<option>1</option>
	                              	</select>
	                          	</div>
	                      	</div>
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Strip</label>
	                              	<input class="strip" data-toggle="touchspin" type="text" value="0" name="strip" maxlength="6">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Ip Address</label>
	                              	<input type="text" class="form-control" name="ip_address" data-toggle="input-mask" data-mask-format="099.099.099.099" placeholder="xxx.xxx.xxx.xxx" required>
	                          	</div>
	                      	</div>
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Pri Prefix</label>
	                              	<input type="text" class="form-control" name="pri_prefix" >
	                          	</div>
	                      	</div>
	                 	</div>
	                 	<div class="row">
	                 		<div class="col-md-3">
	                 			<div class="form-group">
	                              	<label for="field-4" class="control-label">Attrs</label>
	                              	<input type="text" class="form-control" name="attrs" >
	                          	</div>
	                 		</div>
	                 		<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Probe Mode</label>
	                              	<input class="strip" data-toggle="touchspin" type="text" value="0" name="probe_mode" maxlength="6">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">State</label>
	                              	<select class="form-control" name="state">
	                              		<option>0</option>
	                              	</select>
	                          	</div>
	                      	</div>
	                      	<div class="col-md-3">
	                 			<div class="form-group">
	                              	<label for="field-4" class="control-label">Socket</label>
	                              	<input type="text" class="form-control" name="socket" >
	                          	</div>
	                 		</div>
	                 	</div>
	                 	<div class="row">
	                 		<div class="col-md-6">
	                 			<div class="form-group">
	                              	<label for="field-4" class="control-label">Description</label>
	                              	<input type="text" class="form-control" name="description" >
	                          	</div>
	                 		</div>
	                 	</div>
	              </div>
	              <div class="modal-footer">
	                  <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
	                  <button type="submit" class="btn btn-info waves-effect waves-light">Save changes</button>
	              </div>
	          </form>
	          
	      </div>
	</div>
</div>

<div id="delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-sm">
	    <div class="modal-content">
	        <div class="modal-header">
	            <h4 class="modal-title">Delete Gateway</h4>
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        </div>
            <div class="modal-body p-4">
            	<h4>Are you sure to delete Gateways?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info waves-effect waves-light delete_btn">Submit</button>
            </div>
	      </div>
	</div>
</div>

<div id="duplicate-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; top: 8%;">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	        <div class="modal-header">
	            <h4 class="modal-title">Duplicate Gateway</h4>
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        </div>
	        <form method="post" action="<?= base_url();?>gateway/add">
	            <div class="modal-body p-4">
	                <div class="row">
	                      <div class="col-md-6">
	                          <div class="form-group">
	                              <label for="field-1" class="control-label">Gateway Name</label>
	                              <input type="text" class="form-control" placeholder="Title" name="gw_name">
	                          </div>
	                      </div>
	                      <div class="col-md-6">
	                          <div class="form-group">
	                              	<label for="field-1" class="control-label">Dest Group Name</label>
	                              	<select class="form-control" name="destgroupname">
	                              		<option value="none">None</option>
	                              		<?php foreach($destgroupnames as $value){?>
	                              			<option><?= $value->name;?></option>
	                              		<?php }?>
	                              	</select>
	                          </div>
	                      </div>
	                  </div>
	                  <div class="row">
	                      <div class="col-md-6 tariff_pl" >
		                        <div class="form-group">
	                              	<label for="field-1" class="control-label">Tariff Name</label>
	                              	<select class="form-control" name="tariff_name">
	                              		<?php foreach($tariff_pl_names as $value){?>
	                              			<option><?= $value->tariffname;?></option>
	                              		<?php }?>
	                              	</select>
		                        </div>
	                      	</div>
	                      	<div class="col-md-6 tariff" style="display: none;">
		                        <div class="form-group">
	                              	<label for="field-1" class="control-label">Tariff Name</label>
	                              	<select class="form-control" name="tariff_name" disabled="true">
	                              		<?php foreach($tariff_names as $value){?>
	                              			<option><?= $value->tariffname;?></option>
	                              		<?php }?>
	                              	</select>
		                        </div>
	                      	</div>
	                      <div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Calls Limit</label>
	                              	<input class="strip" data-toggle="touchspin" type="text" value="300" name="calls_limit" maxlength="6">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">CPS Limit</label>
	                              	<input class="strip" data-toggle="touchspin" type="text" value="30" name="cps_limit" maxlength="6">
	                          	</div>
	                      	</div>
	                  	</div>
	                 	<div class="row">
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Account State</label>
	                              	<input class="account_state form-control" type="text" value="0" name="account_state" maxlength="6" readonly="">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-6 mt-3">
	                      		<div class="row form-group">
	                      			<div class="col-md-4">
	                      				<button class="btn btn-primary btn-block" data-toggle="collapse" data-target="#collapseDuplicatePayment" aria-expanded="false" aria-controls="collapseExample" type="button"><i class="mdi mdi-plus-circle" ></i> Add</button>
	                      			</div>
	                      			<div class="col-md-8">
	                      				<div class="collapse" id="collapseDuplicatePayment">
	                      					<div class="row form-group">
	                      						<div class="col-md-6"><input type="text" class="form-control duplicate_payment_amount" data-toggle="input-mask" data-mask-format="099999.09" placeholder=""></div>
	                      						<div class="col-md-6"><button class="btn btn-primary duplicate_payment_btn" type="button">Ok</button></div>
	                      					</div>
			                            </div>
	                      			</div>
	                      		</div>
	                      	</div>
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label" style="display: block;">Active</label>
	                              	<input type="checkbox" checked data-plugin="switchery" data-color="#ff5d48" name="active" class="js-switch-duplicate form-control" />
	                          	</div>
	                      	</div>
	                 	</div>
	                 	<div class="row">
	                 		<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Type</label>
	                              	<select class="form-control" name="type">
	                              		<option>0</option>
	                              		<option>1</option>
	                              	</select>
	                          	</div>
	                      	</div>
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Strip</label>
	                              	<input class="strip" data-toggle="touchspin" type="text" value="0" name="strip" maxlength="6">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Ip Address</label>
	                              	<input type="text" class="form-control" name="ip_address" data-toggle="input-mask" data-mask-format="099.099.099.099" placeholder="xxx.xxx.xxx.xxx" required>
	                          	</div>
	                      	</div>
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Pri Prefix</label>
	                              	<input type="text" class="form-control" name="pri_prefix" >
	                          	</div>
	                      	</div>
	                 	</div>
	                 	<div class="row">
	                 		<div class="col-md-3">
	                 			<div class="form-group">
	                              	<label for="field-4" class="control-label">Attrs</label>
	                              	<input type="text" class="form-control" name="attrs" >
	                          	</div>
	                 		</div>
	                 		<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Probe Mode</label>
	                              	<input class="strip" data-toggle="touchspin" type="text" value="0" name="probe_mode" maxlength="6">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">State</label>
	                              	<select class="form-control" name="state">
	                              		<option>0</option>
	                              	</select>
	                          	</div>
	                      	</div>
	                      	<div class="col-md-3">
	                 			<div class="form-group">
	                              	<label for="field-4" class="control-label">Socket</label>
	                              	<input type="text" class="form-control" name="socket" >
	                          	</div>
	                 		</div>
	                 	</div>
	                 	<div class="row">
	                 		<div class="col-md-6">
	                 			<div class="form-group">
	                              	<label for="field-4" class="control-label">Description</label>
	                              	<input type="text" class="form-control" name="description" >
	                          	</div>
	                 		</div>
	                 	</div>
	              </div>
	              <div class="modal-footer">
	                  <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
	                  <button type="submit" class="btn btn-info waves-effect waves-light">Save changes</button>
	              </div>
	          </form>
	          
	      </div>
	</div>
</div>
