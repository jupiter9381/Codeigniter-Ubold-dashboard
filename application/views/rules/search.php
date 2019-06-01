<div class="container-fluid">
	<!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Rules</li>
                    </ol>
                </div>
                <h4 class="page-title">Rules</h4>
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
    		<form method="post" action="<?= base_url();?>rule/search">
    			<div class="row">
    				<div class="col-sm-3 ">
	    				<div class="form-group">
	    					<label for="field-1" class="control-label">Group ID</label>
	    					<select class="form-control" name="search_groupid" required>
	    						<option></option>
	    						<?php foreach($groupids as $value){?>
	    							<option <?php if($value->groupid == $search['groupid']) echo 'selected';?>><?= $value->groupid;?></option>
	    						<?php }?>
	    					</select>
	    				</div>
	    			</div>
	    			<div class="col-sm-3">
	    				<div class="form-group">
	    					<label for="field-1" class="control-label">Prefix</label>
		                	<input type="text" class="form-control" placeholder="Prefix" name="search_prefix" value="<?= $search['prefix'];?>" required>
	    				</div>
	    			</div>
	    			<div class="col-sm-3">
	    				<div class="form-group">
	    					<label for="field-1" class="control-label">GW List</label>
		                	<select class="form-control" name="search_gwlist">
		                		<option></option>
	    						<?php foreach($gwlists as $value){?>
	    							<option <?php if($value->gwlist == $search['gwlist']) echo 'selected';?>><?= $value->gwlist;?></option>
	    						<?php }?>
	    					</select>
	    				</div>
	    			</div>
	    			<div class="col-sm-3">
	    				<button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
	    			</div>
    			</div>
    			
    		</form>
    	</div>
    	<div class="col-sm-12">
    		<div class="card-box">
    			<div class="col-12 text-sm-center form-inline mb-3">
    				<div class="form-group mr-2">
    					<?php if($user->rule_status[1] == '1'){?>
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
    			
    			
    			<table id="rules-table" class="table table-bordered table-striped table-hover" data-filter="#search-field" data-page-size="20" data-paging="true" data-paging-container="#page-size">
    				<thead>
	                   	<tr>
	                        <?php if($user->rule_status[3] == '1'){?>
	                   			<th></th>
	                   		<?php }?>
	                        <th>Group ID</th>
	                        <th>Prefix</th>
	                        <th>Timerec</th>
	                        <th>Priority</th>
	                        <th>Route</th>
	                        <th>GW List</th>
	                        <th>Attrs</th>
	                        <th>Description</th>
	                        <td></td>
	                    </tr>
                   	</thead>
                   	<tbody>
                   		<?php if(count($rules) > 0){
                   			foreach($rules as $value){?>
                   				<tr>
                   					<?php if($user->rule_status[3] == '1'){?>
                   					<td>
		                            	<div class="checkbox checkbox-primary" style="line-height: 0px;">
	                                        <input id="checkbox<?= $value->ruleid;?>" type="checkbox" class="del-check" value=<?= $value->ruleid;?>>
	                                        <label for="checkbox<?= $value->ruleid;?>">
	                                        </label>
	                                    </div>
		                            </td>
		                            <?php }?>
                   					<td><?= $value->groupid;?></td>
                   					<td><?= $value->prefix;?></td>
                   					<td><?= $value->timerec;?></td>
                   					<td><?= $value->priority;?></td>
                   					<td><?= $value->routeid;?></td>
                   					<td><?= $value->gwlist;?></td>
                   					<td><?= $value->attrs;?></td>
                   					<td><?= $value->description;?></td>
                   					<td style="">
                   						<?php if($user->rule_status[2] == '1'){?>
		                            	<button type="button" class="btn btn-blue waves-effect waves-light edit-btn mr-1 mb-1 btn-xs" rule-id="<?= $value->ruleid;?>" data-toggle="modal" data-target="#edit-modal"><i class="mdi mdi-settings"></i></button>
		                            	<?php }?>
	                            		<?php if($user->rule_status[4] == '1'){?>
		                            	<button type="button" class="btn btn-success waves-effect waves-light duplicate-btn btn-xs mb-1" rule-id="<?= $value->ruleid;?>" data-toggle="modal" data-target="#duplicate-modal"><i class="mdi mdi-content-copy"></i></button>
		                            	<?php }?>
		                            </td>
                   				</tr>
                   		<?php }
                   		}?>
                   	</tbody>
                   	<tfoot>
                        <tr class="active">
                        	<?php if($user->rule_status[3] == '1'){?>
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
<div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; top: 18%;">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	        <div class="modal-header">
	            <h4 class="modal-title">Add Rule</h4>
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        </div>
	        <form method="post" action="<?= base_url();?>rule/add">
	        	<input type="hidden" name="search_groupid" value="<?= $search['groupid'];?>">
	        	<input type="hidden" name="search_prefix" value="<?= $search['prefix'];?>">
	        	<input type="hidden" name="search_gwlist" value="<?= $search['gwlist'];?>">
	              <div class="modal-body p-4">
	                  <div class="row">
	                      	<div class="col-md-6">
	                      		<label for="field-1" class="control-label">Group ID</label>
	                          	<select class="form-control" name="groupid">
		    						<?php foreach($groupids as $value){?>
		    							<option><?= $value->groupid;?></option>
		    						<?php }?>
		    					</select>
	                      	</div>
	                      	<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-1" class="control-label">Prefix</label>
	                              	<input type="text" name="prefix" class="form-control" required>
	                          	</div>
	                      	</div>
	                  	</div>
	                  	<div class="row">
	                      	<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-1" class="control-label">Timerec</label>
	                              	<input type="text" name="timerec" class="form-control">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Priority</label>
	                              	<input class="strip" data-toggle="touchspin" type="text" value="0" name="priority" maxlength="2" required>
	                          	</div>
	                      	</div>
	                  	</div>
	                 	<div class="row">
	                      	<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-1" class="control-label">Route </label>
	                              	<input class="form-control" type="text" name="routeid">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">GW List</label>
	                              	<select class="form-control" name="gwlist">
			    						<?php foreach($gwlists as $value){?>
			    							<option><?= $value->gwlist;?></option>
			    						<?php }?>
			    					</select>
	                          	</div>
	                      	</div>
	                  	</div>
	                  	<div class="row">
	                      	<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-1" class="control-label">Attrs </label>
	                              	<input class="form-control" type="text" name="attrs">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Description</label>
	                              	<input class="form-control" type="text" name="description">
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
	            <h4 class="modal-title">Delete Rule</h4>
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        </div>
            <div class="modal-body p-4">
            	<h4>Are you sure to delete rule?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info waves-effect waves-light delete_btn">Submit</button>
            </div>
	      </div>
	</div>
</div>
<div id="alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; top: 30%;">
	<div class="modal-dialog">
	    <div class="modal-content">
	        <div class="modal-header">
	            <h4 class="modal-title">Alert</h4>
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        </div>
            <div class="modal-body p-4">
            	<h4>There are over 500 results</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
            </div>
	      </div>
	</div>
</div>
<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; top: 18%;">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	        <div class="modal-header">
	            <h4 class="modal-title">Edit Rule</h4>
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        </div>
	        <form method="post" action="<?= base_url();?>rule/update">
	        		<input type="hidden" name="ruleid" value="">
	              <div class="modal-body p-4">
	                  <div class="row">
	                      	<div class="col-md-6">
	                      		<label for="field-1" class="control-label">Group ID</label>
	                          	<select class="form-control" name="groupid">
		    						<?php foreach($groupids as $value){?>
		    							<option><?= $value->groupid;?></option>
		    						<?php }?>
		    					</select>
	                      	</div>
	                      	<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-1" class="control-label">Prefix</label>
	                              	<input type="text" name="prefix" class="form-control" required>
	                          	</div>
	                      	</div>
	                  	</div>
	                  	<div class="row">
	                      	<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-1" class="control-label">Timerec</label>
	                              	<input type="text" name="timerec" class="form-control">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Priority</label>
	                              	<input class="strip" data-toggle="touchspin" type="text" value="0" name="priority" maxlength="2" required>
	                          	</div>
	                      	</div>
	                  	</div>
	                 	<div class="row">
	                      	<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-1" class="control-label">Route </label>
	                              	<input class="form-control" type="text" name="routeid">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">GW List</label>
	                              	<select class="form-control" name="gwlist">
			    						<?php foreach($gwlists as $value){?>
			    							<option><?= $value->gwlist;?></option>
			    						<?php }?>
			    					</select>
	                          	</div>
	                      	</div>
	                  	</div>
	                  	<div class="row">
	                      	<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-1" class="control-label">Attrs </label>
	                              	<input class="form-control" type="text" name="attrs">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Description</label>
	                              	<input class="form-control" type="text" name="description">
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

<div id="duplicate-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; top: 18%;">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	        <div class="modal-header">
	            <h4 class="modal-title">Add Rule</h4>
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        </div>
	        <form method="post" action="<?= base_url();?>rule/add">
	              <div class="modal-body p-4">
	                  <div class="row">
	                      	<div class="col-md-6">
	                      		<label for="field-1" class="control-label">Group ID</label>
	                          	<select class="form-control" name="groupid">
		    						<?php foreach($groupids as $value){?>
		    							<option><?= $value->groupid;?></option>
		    						<?php }?>
		    					</select>
	                      	</div>
	                      	<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-1" class="control-label">Prefix</label>
	                              	<input type="text" name="prefix" class="form-control" required>
	                          	</div>
	                      	</div>
	                  	</div>
	                  	<div class="row">
	                      	<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-1" class="control-label">Timerec</label>
	                              	<input type="text" name="timerec" class="form-control">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Priority</label>
	                              	<input class="strip" data-toggle="touchspin" type="text" value="0" name="priority" maxlength="2" required>
	                          	</div>
	                      	</div>
	                  	</div>
	                 	<div class="row">
	                      	<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-1" class="control-label">Route </label>
	                              	<input class="form-control" type="text" name="routeid">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">GW List</label>
	                              	<select class="form-control" name="gwlist">
			    						<?php foreach($gwlists as $value){?>
			    							<option><?= $value->gwlist;?></option>
			    						<?php }?>
			    					</select>
	                          	</div>
	                      	</div>
	                  	</div>
	                  	<div class="row">
	                      	<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-1" class="control-label">Attrs </label>
	                              	<input class="form-control" type="text" name="attrs">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Description</label>
	                              	<input class="form-control" type="text" name="description">
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


