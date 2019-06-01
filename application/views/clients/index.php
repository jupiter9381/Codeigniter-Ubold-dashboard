<div class="container-fluid">
	<!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Clients</li>
                    </ol>
                </div>
                <h4 class="page-title">Clients</h4>
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
    		<div class="card-box">
    			<div class="col-12 text-sm-center form-inline mb-3">
    				<div class="form-group mr-2">
    					<?php if($user->client_status[1] == '1'){?>
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
    			
    			
    			<table id="clients-table" class="table table-bordered table-striped table-hover table-responsive" data-filter="#search-field" data-page-size="20" data-paging="true" data-paging-container="#page-size">
    				<thead>
	                   	<tr>
	                   		<?php if($user->client_status[3] == '1'){?>
	                   			<th></th>
	                   		<?php }?>
	                        
	                        <th>Name</th>
	                        <th>Tariff</th>
	                        <th>Group Name</th>
	                        <th>GroupId PL</th>
	                        <th>Tariff AZ</th>
	                        <th>GroupId AZ</th>
	                        <th>Strip</th>
	                        <th>Strip Prefix</th>
	                        <th>Account State</th>
	                        <th>Calls Limit</th>
	                        <th>Cps Limit</th>
	                        <th>Zip Code</th>
	                        <th>Active</th>
	                        <td></td>
	                    </tr>
                   	</thead>
                   	<tbody>
                   		<?php foreach ($clients as $value) { ?>
	                   		<tr>
	                            <?php if($user->client_status[3] == '1'){?>
	                            <td>
	                            	<div class="checkbox checkbox-primary" style="line-height: 0px;">
                                        <input id="checkbox<?= $value->client_id;?>" type="checkbox" class="del-check" value=<?= $value->client_name;?>>
                                        <label for="checkbox<?= $value->client_id;?>">
                                        </label>
                                    </div>
	                            </td>
	                            <?php }?>
	                            <td><?= $value->client_name;?></td>
	                            <td><?= $value->tariff_name;?></td>
	                            <td><?= $value->destgroupname;?></td>
	                            <td><?= $value->dr_groupid_PL;?></td>
	                            <td><?= $value->tariff_name_AZ;?></td>
	                            <td><?= $value->dr_groupid_AZ;?></td>
	                            <td><?= $value->strip;?></td>
	                            <td><?= $value->strip_prefix;?></td>
	                            <td><?= $value->account_state;?></td>
	                            <td><?= $value->calls_limit;?></td>
	                            <td><?= $value->cps_limit;?></td>
	                            <td><?= $value->zip_code;?></td>
	                            <td>
	                            	<?php if($value->active == "1"){?>
	                            		<span class="badge label-table badge-success">Active</span>
	                            	<?php } else {?>
	                            		<span class="badge label-table badge-secondary">Disabled</span>
	                            	<?php }?>	                            	
	                            </td>
	                            <td style="display: inline-flex;">
	                            	<?php if($user->client_status[2] == '1'){?>
	                            	<button type="button" class="btn btn-blue waves-effect waves-light edit-btn mr-1 btn-xs" client-name="<?= $value->client_name;?>" data-toggle="modal" data-target="#edit-modal"><i class="mdi mdi-settings"></i></button>
	                            	<?php }?>
	                            	<?php if($user->client_status[4] == '1'){?>
	                            	<button type="button" class="btn btn-success waves-effect waves-light duplicate-btn btn-xs" client-name="<?= $value->client_name;?>" data-toggle="modal" data-target="#duplicate-modal"><i class="mdi mdi-content-copy"></i></button>
	                            	<?php }?>
	                            </td>
	                        </tr>
                    	<?php }?>
                   	</tbody>
                   	<tfoot>
                        <tr class="active">
                        	<?php if($user->client_status[3] == '1'){?>
                        	<td colspan="3" style="border-right: none;">
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
<div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; top: 6%;">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	        <div class="modal-header">
	            <h4 class="modal-title">Add Client</h4>
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        </div>
	        <form method="post" action="<?= base_url();?>client/add">
	              <div class="modal-body p-4">
	                  <div class="row">
	                      <div class="col-md-6">
	                          <div class="form-group">
	                              <label for="field-1" class="control-label">Client Name</label>
	                              <input type="text" class="form-control" placeholder="Title" name="client_name" minlength="2" required>
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
	                      <div class="col-md-6">
	                          <div class="form-group">
	                              	<label for="field-1" class="control-label">Tariff Name AZ</label>
	                              	<select class="form-control" name="tariff_name_AZ">
	                              		<?php foreach($tariff_name_az as $value){?>
	                              			<option><?= $value->name;?></option>
	                              		<?php }?>
	                              	</select>
	                          </div>
	                      </div>
	                  </div>
	                  <div class="row">
	                      <div class="col-md-6">
	                          <div class="form-group">
	                              	<label for="field-4" class="control-label">Group ID PL</label>
	                              	<select class="form-control" name="dr_groupid_PL">
	                              		<?php foreach($groupid_pl as $value){?>
	                              			<option><?= $value->groupid;?></option>
	                              		<?php }?>
	                              	</select>
	                          </div>
	                      </div>
	                      <div class="col-md-6">
	                          <div class="form-group">
	                              	<label for="field-4" class="control-label">Group ID AZ</label>
	                              	<select class="form-control" name="dr_groupid_AZ">
	                              		<?php foreach($groupid_pl as $value){?>
	                              			<option><?= $value->groupid;?></option>
	                              		<?php }?>
	                              	</select>
	                          </div>
	                      </div>
	                  	</div>
	                  	<div class="row">
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Strip</label>
	                              	<input class="strip" data-toggle="touchspin" type="text" value="0" name="strip" maxlength="6">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Strip Prefix</label>
	                              	<input class="strip" data-toggle="touchspin" type="text" value="0" name="strip_prefix" maxlength="6">
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
	                      	<div class="col-md-6" style="margin-top: 30px;">
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
	                              	<label for="field-4" class="control-label">Zip Code</label>
	                              	<input class="form-control" type="text" name="zip_code" data-toggle="input-mask" data-mask-format="00-000" placeholder="xx-xxx">
	                          	</div>
	                      	</div>
	                 	</div>
	                 	<div class="row">
	                 		<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label" style="display: block;">Active</label>
	                              	<input type="checkbox" checked data-plugin="switchery" data-color="#ff5d48" name="active" class="js-switch form-control" />
	                          	</div>
	                      	</div>
	                 	</div>
	                 	<label for="field-4" class="control-label mb-2">IP Address</label><i class="mdi mdi-plus-circle add_ip" style="font-size: 20px; margin-left: 10px; color: rebeccapurple; cursor: pointer; display: inline-block;"></i>
	                 	<div class="row ip-section">
	                 		<div class="col-md-4 ip_item_0">
	                          	<div class="row form-group">
	                          		<div class="col-md-10">
	                          			<input type="text" name="ip_address[]" class="form-control" data-toggle="input-mask" data-mask-format="099.099.099.099" placeholder="xxx.xxx.xxx.xxx"/>
	                          		</div>
	                              	<div class="col-md-1" style="padding-left: 0px;">
	                              		<i class="mdi mdi-minus-circle del_ip" item-index="0" style="font-size: 20px; margin-left: 10px; color: rebeccapurple; cursor: pointer; display: inline-block;"></i>
	                              	</div>
	                              	
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

<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; top: 6%;">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	        <div class="modal-header">
	            <h4 class="modal-title">Edit Client</h4>
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        </div>
	        <form method="post" action="<?= base_url();?>client/update">
	        	<input type="hidden" name="client_id" value="">
	            <div class="modal-body p-4">
	                <div class="row">
	                      <div class="col-md-6">
	                          <div class="form-group">
	                              <label for="field-1" class="control-label">Client Name</label>
	                              <input type="text" class="form-control" placeholder="Title" name="client_name" readonly>
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
	                      <div class="col-md-6">
	                          <div class="form-group">
	                              	<label for="field-1" class="control-label">Tariff Name AZ</label>
	                              	<select class="form-control" name="tariff_name_AZ">
	                              		<?php foreach($tariff_name_az as $value){?>
	                              			<option><?= $value->name;?></option>
	                              		<?php }?>
	                              	</select>
	                          </div>
	                      </div>
	                  </div>
	                  <div class="row">
	                      <div class="col-md-6">
	                          <div class="form-group">
	                              	<label for="field-4" class="control-label">Group ID PL</label>
	                              	<select class="form-control" name="dr_groupid_PL">
	                              		<?php foreach($groupid_pl as $value){?>
	                              			<option><?= $value->groupid;?></option>
	                              		<?php }?>
	                              	</select>
	                          </div>
	                      </div>
	                      <div class="col-md-6">
	                          <div class="form-group">
	                              	<label for="field-4" class="control-label">Group ID AZ</label>
	                              	<select class="form-control" name="dr_groupid_AZ">
	                              		<?php foreach($groupid_pl as $value){?>
	                              			<option><?= $value->groupid;?></option>
	                              		<?php }?>
	                              	</select>
	                          </div>
	                      </div>
	                  </div>
	                  	<div class="row">
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Strip</label>
	                              	<input class="strip" data-toggle="touchspin" type="text" value="0" name="strip" maxlength="6">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Strip Prefix</label>
	                              	<input class="strip" data-toggle="touchspin" type="text" value="0" name="strip_prefix" maxlength="6">
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
	                      	<div class="col-md-6 " style="margin-top: 30px;">
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
	                              	<label for="field-4" class="control-label">Zip Code</label>
	                              	<input class="form-control" type="text" name="zip_code" data-toggle="input-mask" data-mask-format="00-000" placeholder="xx-xxx">
	                          	</div>
	                      	</div>
	                 	</div>
	                 	<div class="row">
	                 		<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label" style="display: block;">Active</label>
	                              	<input type="checkbox" checked data-plugin="switchery" data-color="#ff5d48" name="active" class="js-switch-edit form-control" />
	                          	</div>
	                      	</div>
	                 	</div>
	                 	<label for="field-4" class="control-label mb-2">IP Address</label><i class="mdi mdi-plus-circle add_ip_edit" style="font-size: 20px; margin-left: 10px; color: rebeccapurple; cursor: pointer; display: inline-block;"></i>
	                 	<div class="row ip-section_edit">
	                 		<div class="row form-group">
                          		<div class="col-md-10">
                          			<input type="text" name="ip_address[]" class="form-control" data-toggle="input-mask" data-mask-format="099.099.099.099" placeholder="xxx.xxx.xxx.xxx"/>
                          		</div>
                              	<div class="col-md-1" style="padding-left: 0px;">
                              		<i class="mdi mdi-minus-circle del_ip_item" item-index="0" style="font-size: 20px; margin-left: 10px; color: rebeccapurple; cursor: pointer; display: inline-block;"></i>
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

<div id="delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; top: 30%;">
	<div class="modal-dialog modal-sm">
	    <div class="modal-content">
	        <div class="modal-header">
	            <h4 class="modal-title">Delete Client</h4>
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        </div>
            <div class="modal-body p-4">
            	<h4>Are you sure to delete clients?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info waves-effect waves-light delete_btn">Submit</button>
            </div>
	      </div>
	</div>
</div>

<div id="duplicate-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; top: 6%;">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	        <div class="modal-header">
	            <h4 class="modal-title">Duplicate Client</h4>
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        </div>
	        <form method="post" action="<?= base_url();?>client/add">
	            <div class="modal-body p-4">
	                <div class="row">
	                      <div class="col-md-6">
	                          <div class="form-group">
	                              <label for="field-1" class="control-label">Client Name</label>
	                              <input type="text" class="form-control" placeholder="Title" name="client_name">
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
	                      <div class="col-md-6">
	                          <div class="form-group">
	                              	<label for="field-1" class="control-label">Tariff Name AZ</label>
	                              	<select class="form-control" name="tariff_name_AZ">
	                              		<?php foreach($tariff_name_az as $value){?>
	                              			<option><?= $value->name;?></option>
	                              		<?php }?>
	                              	</select>
	                          </div>
	                      </div>
	                  </div>
	                  <div class="row">
	                      <div class="col-md-6">
	                          <div class="form-group">
	                              	<label for="field-4" class="control-label">Group ID PL</label>
	                              	<select class="form-control" name="dr_groupid_PL">
	                              		<?php foreach($groupid_pl as $value){?>
	                              			<option><?= $value->groupid;?></option>
	                              		<?php }?>
	                              	</select>
	                          </div>
	                      </div>
	                      <div class="col-md-6">
	                          <div class="form-group">
	                              	<label for="field-4" class="control-label">Group ID AZ</label>
	                              	<select class="form-control" name="dr_groupid_AZ">
	                              		<?php foreach($groupid_pl as $value){?>
	                              			<option><?= $value->groupid;?></option>
	                              		<?php }?>
	                              	</select>
	                          </div>
	                      </div>
	                  </div>
	                  	<div class="row">
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Strip</label>
	                              	<input class="strip" data-toggle="touchspin" type="text" value="0" name="strip" maxlength="6">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Strip Prefix</label>
	                              	<input class="strip" data-toggle="touchspin" type="text" value="0" name="strip_prefix" maxlength="6">
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
	                      	<div class="col-md-6" style="margin-top: 30px;">
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
	                              	<label for="field-4" class="control-label">Zip Code</label>
	                              	<input class="form-control" type="text" name="zip_code" data-toggle="input-mask" data-mask-format="00-000" placeholder="xx-xxx">
	                          	</div>
	                      	</div>
	                 	</div>
	                 	<div class="row">
	                 		<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label" style="display: block;">Active</label>
	                              	<input type="checkbox" checked data-plugin="switchery" data-color="#ff5d48" name="active" class="js-switch-duplicate form-control" />
	                          	</div>
	                      	</div>
	                 	</div>
	                 	<label for="field-4" class="control-label mb-2">IP Address</label><i class="mdi mdi-plus-circle add_ip_duplicate" style="font-size: 20px; margin-left: 10px; color: rebeccapurple; cursor: pointer; display: inline-block;"></i>
	                 	<div class="row ip-section_duplicate">
	                 		<div class="col-md-4">
	                          	<div class="form-group">
	                              	<input type="text" name="ip_address[]" class="form-control" />
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
