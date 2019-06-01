<div class="container-fluid">
	<!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
                <h4 class="page-title">Users</h4>
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
    		<div class="card-box">
    			<div class="col-12 text-sm-center form-inline mb-3">
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
    			
    			
    			<table id="users-table" class="table table-bordered table-striped table-hover " data-filter="#search-field" data-page-size="10" data-paging="true" data-paging-container="#page-size">
    				<thead>
	                   	<tr>
	                        <th></th>
	                        <th>Name</th>
	                        <th>Client</th>
	                        <th>Gateways</th>
	                        <th>Rules</th>
	                        <th>Cl Rates</th>
	                        <th>Gw Rates</th>
	                        <th>Allowed</th>
	                        <td></td>
	                    </tr>
                   	</thead>
                   	<tbody>
                   		<?php foreach ($users as $value) { ?>
	                   		<tr>
	                            <td>
	                            	<div class="checkbox checkbox-primary" style="line-height: 0px;">
                                        <input id="checkbox<?= $value->id;?>" type="checkbox" class="del-check" value=<?= $value->id;?>>
                                        <label for="checkbox<?= $value->id;?>">
                                        </label>
                                    </div>
	                            </td>
	                            <td><?= $value->name;?></td>
	                            <td>
	                            	<div class="checkbox checkbox-primary d-inline mr-2" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="View">
                                        <?php if($value->client_status[0] == '1'){ ?>
                                            <i class="fa fa-check"></i>
                                        <?php } else {?>
                                            <i class="fa fa-ban"></i>
                                        <?php }?>
                                    </div>
	                            	<div class="checkbox checkbox-primary d-inline mr-2" style="line-height: 0px; color: green;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add">
                                        <?php if($value->client_status[1] == '1'){ ?>
                                            <i class="fa fa-check"></i>
                                        <?php } else {?>
                                            <i class="fa fa-ban"></i>
                                        <?php }?>
                                    </div>
                                    <div class="checkbox checkbox-primary d-inline mr-2" style="line-height: 0px; color: orange;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                        <?php if($value->client_status[2] == '1'){ ?>
                                            <i class="fa fa-check"></i>
                                        <?php } else {?>
                                            <i class="fa fa-ban"></i>
                                        <?php }?>
                                    </div>
                                    <div class="checkbox checkbox-primary d-inline mr-2" style="line-height: 0px; color: red;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                        <?php if($value->client_status[3] == '1'){ ?>
                                            <i class="fa fa-check"></i>
                                        <?php } else {?>
                                            <i class="fa fa-ban"></i>
                                        <?php }?>
                                    </div>
                                    <div class="checkbox checkbox-primary d-inline" style="line-height: 0px; color: green;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Duplicate">
                                        <?php if($value->client_status[4] == '1'){ ?>
                                            <i class="fa fa-check"></i>
                                        <?php } else {?>
                                            <i class="fa fa-ban"></i>
                                        <?php }?>
                                    </div>
	                            </td>
	                            <td>
	                            	<div class="checkbox checkbox-primary d-inline mr-2" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="View">
                                        <?php if($value->gateway_status[0] == '1'){ ?>
                                            <i class="fa fa-check"></i>
                                        <?php } else {?>
                                            <i class="fa fa-ban"></i>
                                        <?php }?>
                                    </div>
                                    <div class="checkbox checkbox-primary d-inline mr-2" style="line-height: 0px; color: green;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add">
                                        <?php if($value->gateway_status[1] == '1'){ ?>
                                            <i class="fa fa-check"></i>
                                        <?php } else {?>
                                            <i class="fa fa-ban"></i>
                                        <?php }?>
                                    </div>
                                    <div class="checkbox checkbox-primary d-inline mr-2" style="line-height: 0px; color: orange;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                        <?php if($value->gateway_status[2] == '1'){ ?>
                                            <i class="fa fa-check"></i>
                                        <?php } else {?>
                                            <i class="fa fa-ban"></i>
                                        <?php }?>
                                    </div>
                                    <div class="checkbox checkbox-primary d-inline mr-2" style="line-height: 0px; color: red;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                        <?php if($value->gateway_status[3] == '1'){ ?>
                                            <i class="fa fa-check"></i>
                                        <?php } else {?>
                                            <i class="fa fa-ban"></i>
                                        <?php }?>
                                    </div>
                                    <div class="checkbox checkbox-primary d-inline" style="line-height: 0px; color: green;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Duplicate">
                                        <?php if($value->gateway_status[4] == '1'){ ?>
                                            <i class="fa fa-check"></i>
                                        <?php } else {?>
                                            <i class="fa fa-ban"></i>
                                        <?php }?>
                                    </div>
	                            </td>
	                            <td>
	                            	<div class="checkbox checkbox-primary d-inline mr-2" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="View">
                                        <?php if($value->rule_status[0] == '1'){ ?>
                                            <i class="fa fa-check"></i>
                                        <?php } else {?>
                                            <i class="fa fa-ban"></i>
                                        <?php }?>
                                    </div>
                                    <div class="checkbox checkbox-primary d-inline mr-2" style="line-height: 0px; color: green;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add">
                                        <?php if($value->rule_status[1] == '1'){ ?>
                                            <i class="fa fa-check"></i>
                                        <?php } else {?>
                                            <i class="fa fa-ban"></i>
                                        <?php }?>
                                    </div>
                                    <div class="checkbox checkbox-primary d-inline mr-2" style="line-height: 0px; color: orange;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                        <?php if($value->rule_status[2] == '1'){ ?>
                                            <i class="fa fa-check"></i>
                                        <?php } else {?>
                                            <i class="fa fa-ban"></i>
                                        <?php }?>
                                    </div>
                                    <div class="checkbox checkbox-primary d-inline mr-2" style="line-height: 0px; color: red;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                        <?php if($value->rule_status[3] == '1'){ ?>
                                            <i class="fa fa-check"></i>
                                        <?php } else {?>
                                            <i class="fa fa-ban"></i>
                                        <?php }?>
                                    </div>
                                    <div class="checkbox checkbox-primary d-inline" style="line-height: 0px; color: green;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Duplicate">
                                        <?php if($value->rule_status[4] == '1'){ ?>
                                            <i class="fa fa-check"></i>
                                        <?php } else {?>
                                            <i class="fa fa-ban"></i>
                                        <?php }?>
                                    </div>

	                            </td>
	                            <td>
	                            	<div class="checkbox checkbox-primary d-inline mr-2" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="View">
                                        <?php if($value->cl_status[0] == '1'){ ?>
                                            <i class="fa fa-check"></i>
                                        <?php } else {?>
                                            <i class="fa fa-ban"></i>
                                        <?php }?>
                                    </div>
                                    <div class="checkbox checkbox-primary d-inline mr-2" style="line-height: 0px; color: green;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add">
                                        <?php if($value->cl_status[1] == '1'){ ?>
                                            <i class="fa fa-check"></i>
                                        <?php } else {?>
                                            <i class="fa fa-ban"></i>
                                        <?php }?>
                                    </div>
                                    <div class="checkbox checkbox-primary d-inline mr-2" style="line-height: 0px; color: orange;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                        <?php if($value->cl_status[2] == '1'){ ?>
                                            <i class="fa fa-check"></i>
                                        <?php } else {?>
                                            <i class="fa fa-ban"></i>
                                        <?php }?>
                                    </div>
                                    <div class="checkbox checkbox-primary d-inline mr-2" style="line-height: 0px; color: red;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                        <?php if($value->cl_status[3] == '1'){ ?>
                                            <i class="fa fa-check"></i>
                                        <?php } else {?>
                                            <i class="fa fa-ban"></i>
                                        <?php }?>
                                    </div>
                                    <div class="checkbox checkbox-primary d-inline" style="line-height: 0px; color: green;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Duplicate">
                                        <?php if($value->cl_status[4] == '1'){ ?>
                                            <i class="fa fa-check"></i>
                                        <?php } else {?>
                                            <i class="fa fa-ban"></i>
                                        <?php }?>
                                    </div>
	                            </td>
	                            <td>
	                            	<div class="checkbox checkbox-primary d-inline mr-2" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="View">
                                        <?php if($value->gw_status[0] == '1'){ ?>
                                            <i class="fa fa-check"></i>
                                        <?php } else {?>
                                            <i class="fa fa-ban"></i>
                                        <?php }?>
                                    </div>
                                    <div class="checkbox checkbox-primary d-inline mr-2" style="line-height: 0px; color: green;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add">
                                        <?php if($value->gw_status[1] == '1'){ ?>
                                            <i class="fa fa-check"></i>
                                        <?php } else {?>
                                            <i class="fa fa-ban"></i>
                                        <?php }?>
                                    </div>
                                    <div class="checkbox checkbox-primary d-inline mr-2" style="line-height: 0px; color: orange;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                        <?php if($value->gw_status[2] == '1'){ ?>
                                            <i class="fa fa-check"></i>
                                        <?php } else {?>
                                            <i class="fa fa-ban"></i>
                                        <?php }?>
                                    </div>
                                    <div class="checkbox checkbox-primary d-inline mr-2" style="line-height: 0px; color: red;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                        <?php if($value->gw_status[3] == '1'){ ?>
                                            <i class="fa fa-check"></i>
                                        <?php } else {?>
                                            <i class="fa fa-ban"></i>
                                        <?php }?>
                                    </div>
                                    <div class="checkbox checkbox-primary d-inline" style="line-height: 0px; color: green;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Duplicate">
                                        <?php if($value->gw_status[4] == '1'){ ?>
                                            <i class="fa fa-check"></i>
                                        <?php } else {?>
                                            <i class="fa fa-ban"></i>
                                        <?php }?>
                                    </div>
	                            </td>
	                            <td>
	                            	<?php if($value->allowed == '1'){?>
	                            		<span class="badge badge-pill badge-success">Allowed</span>
	                            	<?php } else {?>
	                            		<span class="badge badge-pill badge-danger">Not Allowed</span>
	                            	<?php }?>
	                            </td>
	                            <td style="display: inherit;display: inline-flex;">
	                            	<button type="button" class="btn btn-blue waves-effect waves-light edit-btn mr-1 btn-xs" user-id="<?= $value->id;?>" data-toggle="modal" data-target="#edit-modal"><i class="mdi mdi-settings"></i></button>
	                            </td>
	                        </tr>
                    	<?php }?>
                   	</tbody>
                   	<tfoot>
                        <tr class="active">
                        	<?php if($user->client_status[2] == '1'){?>
                        	<td colspan="3" style="border-right: none;">
                        		<button class="btn btn-danger" data-toggle="modal" data-target="#delete-modal" disabled=""><i class="mdi mdi-close-circle mr-1"></i>Delete</button>
                        	</td>
                        	<?php }?>
                            <td colspan="6" style="border-left: none;">
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

<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; top: 2%;">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	        <div class="modal-header">
	            <h4 class="modal-title">Edit User</h4>
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        </div>
	        <form method="post" action="<?= base_url();?>user/status_update">
	        	<input type="hidden" name="user_id" value="">
	            <div class="modal-body p-4">
	            	<label class="display-">Client Table</label class="display-">
	            	<hr>
	                <div class="row">
	                      <div class="col-md-2">
	                          <div class="form-group">
	                          		<label for="field-1" class="control-label">View</label>
	                              	<div class="checkbox checkbox-primary d-inline" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="View">
                                        <input id="edit_client_view" type="checkbox" class="del-check" value='' name='client_view' >
                                        <label for="edit_client_view" > 
                                        </label>
                                    </div>
	                          </div>
	                      </div>
	                      <div class="col-md-2">
	                          <div class="form-group">
	                          		<label for="field-1" class="control-label">Add</label>
                                    <div class="checkbox checkbox-primary d-inline" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add">
                                        <input id="edit_client_add" type="checkbox" class="del-check" value=''  name='client_add'>
                                        <label for="edit_client_add" > 
                                        </label>
                                    </div>
	                          </div>
	                      </div>
	                      <div class="col-md-2">
	                          <div class="form-group">
	                          		<label for="field-1" class="control-label">Edit</label>
                                    <div class="checkbox checkbox-primary d-inline" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                        <input id="edit_client_edit" type="checkbox" class="del-check" value=''  name='client_edit'>
                                        <label for="edit_client_edit" > 
                                        </label>
                                    </div>
	                          </div>
	                      </div>
	                      <div class="col-md-2">
	                          <div class="form-group">
	                          		<label for="field-1" class="control-label">Delete</label>
                                    <div class="checkbox checkbox-primary d-inline" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                        <input id="edit_client_delete" type="checkbox" class="del-check" value='' name='client_delete' >
                                        <label for="edit_client_delete" > 
                                        </label>
                                    </div>
	                          </div>
	                      </div>
	                      <div class="col-md-2">
	                          <div class="form-group">
	                          		<label for="field-1" class="control-label">Duplicate</label>
                                    <div class="checkbox checkbox-primary d-inline" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Duplicate">
                                        <input id="edit_client_duplicate" type="checkbox" class="del-check" value='' name='client_duplicate' >
                                        <label for="edit_client_duplicate" > 
                                        </label>
                                    </div>
	                          </div>
	                      </div>
	                </div>
	                <label class="display-">Gateway Table</label class="display-">
	            	<hr>
	                <div class="row">
	                      <div class="col-md-2">
	                          <div class="form-group">
	                          		<label for="field-1" class="control-label">View</label>
	                              	<div class="checkbox checkbox-primary d-inline" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="View">
                                        <input id="edit_gateway_view" type="checkbox" class="del-check" value='' name='gateway_view' >
                                        <label for="edit_gateway_view" > 
                                        </label>
                                    </div>
	                          </div>
	                      </div>
	                      <div class="col-md-2">
	                          <div class="form-group">
	                          		<label for="field-1" class="control-label">Add</label>
                                    <div class="checkbox checkbox-primary d-inline" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add">
                                        <input id="edit_gateway_add" type="checkbox" class="del-check" value=''  name='gateway_add'>
                                        <label for="edit_gateway_add" > 
                                        </label>
                                    </div>
	                          </div>
	                      </div>
	                      <div class="col-md-2">
	                          <div class="form-group">
	                          		<label for="field-1" class="control-label">Edit</label>
                                    <div class="checkbox checkbox-primary d-inline" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                        <input id="edit_gateway_edit" type="checkbox" class="del-check" value='' name='gateway_edit' >
                                        <label for="edit_gateway_edit" > 
                                        </label>
                                    </div>
	                          </div>
	                      </div>
	                      <div class="col-md-2">
	                          <div class="form-group">
	                          		<label for="field-1" class="control-label">Delete</label>
                                    <div class="checkbox checkbox-primary d-inline" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                        <input id="edit_gateway_delete" type="checkbox" class="del-check" value='' name='gateway_delete' >
                                        <label for="edit_gateway_delete" > 
                                        </label>
                                    </div>
	                          </div>
	                      </div>
	                      <div class="col-md-2">
	                          <div class="form-group">
	                          		<label for="field-1" class="control-label">Duplicate</label>
                                    <div class="checkbox checkbox-primary d-inline" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Duplicate">
                                        <input id="edit_gateway_duplicate" type="checkbox" class="del-check" value='' name='gateway_duplicate' >
                                        <label for="edit_gateway_duplicate" > 
                                        </label>
                                    </div>
	                          </div>
	                      </div>
	                </div>
	                <label class="display-">Rule Table</label class="display-">
	            	<hr>
	                <div class="row">
	                      <div class="col-md-2">
	                          <div class="form-group">
	                          		<label for="field-1" class="control-label">View</label>
	                              	<div class="checkbox checkbox-primary d-inline" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="View">
                                        <input id="edit_rule_view" type="checkbox" class="del-check" value='' name='rule_view' >
                                        <label for="edit_rule_view" > 
                                        </label>
                                    </div>
	                          </div>
	                      </div>
	                      <div class="col-md-2">
	                          <div class="form-group">
	                          		<label for="field-1" class="control-label">Add</label>
                                    <div class="checkbox checkbox-primary d-inline" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add">
                                        <input id="edit_rule_add" type="checkbox" class="del-check" value='' name='rule_add' >
                                        <label for="edit_rule_add" > 
                                        </label>
                                    </div>
	                          </div>
	                      </div>
	                      <div class="col-md-2">
	                          <div class="form-group">
	                          		<label for="field-1" class="control-label">Edit</label>
                                    <div class="checkbox checkbox-primary d-inline" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                        <input id="edit_rule_edit" type="checkbox" class="del-check" value='' name='rule_edit'  >
                                        <label for="edit_rule_edit" > 
                                        </label>
                                    </div>
	                          </div>
	                      </div>
	                      <div class="col-md-2">
	                          <div class="form-group">
	                          		<label for="field-1" class="control-label">Delete</label>
                                    <div class="checkbox checkbox-primary d-inline" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                        <input id="edit_rule_delete" type="checkbox" class="del-check" value='' name='rule_delete'>
                                        <label for="edit_rule_delete" > 
                                        </label>
                                    </div>
	                          </div>
	                      </div>
	                      <div class="col-md-2">
	                          <div class="form-group">
	                          		<label for="field-1" class="control-label">Duplicate</label>
                                    <div class="checkbox checkbox-primary d-inline" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Duplicate">
                                        <input id="edit_rule_duplicate" type="checkbox" class="del-check" value='' name='rule_duplicate' >
                                        <label for="edit_rule_duplicate" > 
                                        </label>
                                    </div>
	                          </div>
	                      </div>
	                </div>
	                <label class="display-">Cl Rate Table</label class="display-">
	            	<hr>
	                <div class="row">
	                      <div class="col-md-2">
	                          <div class="form-group">
	                          		<label for="field-1" class="control-label">View</label>
	                              	<div class="checkbox checkbox-primary d-inline" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="View">
                                        <input id="edit_cl_view" type="checkbox" class="del-check" value='' name="cl_view" >
                                        <label for="edit_cl_view" > 
                                        </label>
                                    </div>
	                          </div>
	                      </div>
	                      <div class="col-md-2">
	                          <div class="form-group">
	                          		<label for="field-1" class="control-label">Add</label>
                                    <div class="checkbox checkbox-primary d-inline" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add">
                                        <input id="edit_cl_add" type="checkbox" class="del-check" value='' name="cl_add" >
                                        <label for="edit_cl_add" > 
                                        </label>
                                    </div>
	                          </div>
	                      </div>
	                      <div class="col-md-2">
	                          <div class="form-group">
	                          		<label for="field-1" class="control-label">Edit</label>
                                    <div class="checkbox checkbox-primary d-inline" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                        <input id="edit_cl_edit" type="checkbox" class="del-check" value='' name="cl_edit" >
                                        <label for="edit_cl_edit" > 
                                        </label>
                                    </div>
	                          </div>
	                      </div>
	                      <div class="col-md-2">
	                          <div class="form-group">
	                          		<label for="field-1" class="control-label">Delete</label>
                                    <div class="checkbox checkbox-primary d-inline" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                        <input id="edit_cl_delete" type="checkbox" class="del-check" value='' name="cl_delete" >
                                        <label for="edit_cl_delete" > 
                                        </label>
                                    </div>
	                          </div>
	                      </div>
	                      <div class="col-md-2">
	                          <div class="form-group">
	                          		<label for="field-1" class="control-label">Duplicate</label>
                                    <div class="checkbox checkbox-primary d-inline" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Duplicate">
                                        <input id="edit_cl_duplicate" type="checkbox" class="del-check" value='' name="cl_duplicate" >
                                        <label for="edit_cl_duplicate" > 
                                        </label>
                                    </div>
	                          </div>
	                      </div>
	                </div>
	                <label class="display-">GW Rate Table</label class="display-">
	            	<hr>
	                <div class="row">
	                      <div class="col-md-2">
	                          <div class="form-group">
	                          		<label for="field-1" class="control-label">View</label>
	                              	<div class="checkbox checkbox-primary d-inline" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="View">
                                        <input id="edit_gw_view" type="checkbox" class="del-check" value='' name="gw_view" >
                                        <label for="edit_gw_view" > 
                                        </label>
                                    </div>
	                          </div>
	                      </div>
	                      <div class="col-md-2">
	                          <div class="form-group">
	                          		<label for="field-1" class="control-label">Add</label>
                                    <div class="checkbox checkbox-primary d-inline" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add">
                                        <input id="edit_gw_add" type="checkbox" class="del-check" value='' name="gw_add" >
                                        <label for="edit_gw_add" > 
                                        </label>
                                    </div>
	                          </div>
	                      </div>
	                      <div class="col-md-2">
	                          <div class="form-group">
	                          		<label for="field-1" class="control-label">Edit</label>
                                    <div class="checkbox checkbox-primary d-inline" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                        <input id="edit_gw_edit" type="checkbox" class="del-check" value='' name="gw_edit" >
                                        <label for="edit_gw_edit" > 
                                        </label>
                                    </div>
	                          </div>
	                      </div>
	                      <div class="col-md-2">
	                          <div class="form-group">
	                          		<label for="field-1" class="control-label">Delete</label>
                                    <div class="checkbox checkbox-primary d-inline" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                        <input id="edit_gw_delete" type="checkbox" class="del-check" value='' name="gw_delete" >
                                        <label for="edit_gw_delete" > 
                                        </label>
                                    </div>
	                          </div>
	                      </div>
	                      <div class="col-md-2">
	                          <div class="form-group">
	                          		<label for="field-1" class="control-label">Duplicate</label>
                                    <div class="checkbox checkbox-primary d-inline" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Duplicate">
                                        <input id="edit_gw_duplicate" type="checkbox" class="del-check" value='' name="gw_duplicate" >
                                        <label for="edit_gw_duplicate" > 
                                        </label>
                                    </div>
	                          </div>
	                      </div>
	                </div>
                    <label class="display-">Login Permission</label class="display-">
                    <hr>
                    <div class="row">
                        <div class="col-md-2">
                              <div class="form-group">
                                    <label for="field-1" class="control-label">Permission</label>
                                    <div class="checkbox checkbox-primary d-inline" style="line-height: 0px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Permission">
                                        <input id="edit_permission" type="checkbox" class="del-check" value='' name="permission" >
                                        <label for="edit_permission" > 
                                        </label>
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

<div id="delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; top: 30%;">
	<div class="modal-dialog modal-sm">
	    <div class="modal-content">
	        <div class="modal-header">
	            <h4 class="modal-title">Delete Users</h4>
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        </div>
            <div class="modal-body p-4">
            	<h4>Are you sure to delete users?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info waves-effect waves-light delete_btn">Submit</button>
            </div>
	      </div>
	</div>
</div>