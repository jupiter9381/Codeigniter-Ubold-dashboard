<div class="container-fluid">
	<!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">GW Rates</li>
                    </ol>
                </div>
                <h4 class="page-title">GW Rates</h4>
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
    		<form method="post" action="<?= base_url();?>gwrate/search" id="searchForm">
    			<div class="row">
    				<div class="col-sm-3 ">
	    				<div class="form-group">
	    					<label for="field-1" class="control-label">Tariff Name</label>
	    					<select class="form-control" name="search_tariffname">
	    						<?php foreach($tariffnames as $value){?>
	    							<option <?php if($tariffname == $value->tariffname) echo "selected";?>><?= $value->tariffname;?></option>
	    						<?php }?>
	    					</select>
	    				</div>
	    			</div>
	    			<div class="col-sm-2">
	    				<div class="form-group">
	    					<label for="field-1" class="control-label">Prefix</label>
	    					<input type="text" name="search_prefix" class="form-control" value="<?= $prefix;?>">
	    				</div>
	    			</div>
	    			<div class="col-sm-3">
	    				<div class="form-group">
	    					<label for="field-1" class="control-label">
	    						<div class="radio radio-primary ">
                                    <input type="radio" name="check_desc" id="radio3" value="1" <?php if($check_desc == "1") echo "checked";?>>
                                    <label for="radio3">
                                        Tariff Desc
                                    </label>
                                </div>
	    					</label>
	    					<select class="form-control" name="search_tariffdesc">
	    						<?php foreach($tariffdescs as $value){?>
	    							<option <?php if($desc == $value->tariffdesc) echo "selected";?>><?= $value->tariffdesc;?></option>
	    						<?php }?>
	    					</select>
	    				</div>
	    			</div>
	    			<div class="col-sm-2">
	    				<div class="form-group">
	    					<label for="field-1" class="control-label">
	    						<div class="radio radio-primary ">
                                    <input type="radio" name="check_desc" id="radio4" value="0" <?php if($check_desc == "0") echo "checked";?>>
                                    <label for="radio4">
                                        Custom Tariff Desc
                                    </label>
                                </div>
	    					</label>
	    					<input type="text" name="search_customtariffdesc" class="form-control" value="<?= $custom_desc;?>">
	    				</div>
	    			</div>
	    			<div class="col-sm-2">
	    				<button class="btn btn-primary" type="button" style="margin-top: 30px;">Search</button>
	    			</div>
    			</div>
    			
    		</form>
    	</div>
    	<div class="col-sm-12">
    		<div class="card-box">
    			<div class="col-12 text-sm-center form-inline mb-3">
    				<div class="form-group mr-2">
    					<?php if($user->gw_status[1] == '1'){?>
                        <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#add-modal"><i class="mdi mdi-plus-circle mr-2" ></i> Add New GW Rate</button>
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
    			
    			<table id="rates-table" class="table table-bordered table-striped table-hover" data-filter="#search-field" data-page-size="20" data-paging="true" data-paging-container="#page-size">
    				<thead>
	                   	<tr>
	                        <?php if($user->gw_status[3] == '1'){?>
	                   			<th></th>
	                   		<?php }?>
	                        <th>Tariff Name</th>
	                        <th>Prefix</th>
	                        <th>Tariff Desc</th>
	                        <th>Rate</th>
	                        <th>Rate Conn</th>
	                        <th>Date</th>
	                        <td></td>
	                    </tr>
                   	</thead>
                   	<tbody>
                   		<?php if(count($rates) > 0){
                   			foreach($rates as $value){?>
                   				<tr>
                   					<?php if($user->gw_status[3] == '1'){?>
                   					<td>
		                            	<div class="checkbox checkbox-primary" style="line-height: 0px;">
	                                        <input id="checkbox<?= $value->id;?>" type="checkbox" class="del-check" value=<?= $value->id;?>>
	                                        <label for="checkbox<?= $value->id;?>">
	                                        </label>
	                                    </div>
		                            </td>
		                            <?php }?>
                   					<td><?= $value->tariffname;?></td>
                   					<td><?= $value->prefix;?></td>
                   					<td><?= $value->tariffdesc;?></td>
                   					<td><?= $value->rate;?></td>
                   					<td><?= $value->rate_conn;?></td>
                   					<td><?= $value->date;?></td>
                   					<td style="">
                   						<?php if($user->gw_status[2] == '1'){?>
		                            	<button type="button" class="btn btn-blue waves-effect waves-light edit-btn mr-1 mb-1 btn-xs" rate-id="<?= $value->id;?>" data-toggle="modal" data-target="#edit-modal"><i class="mdi mdi-settings"></i></button>
		                            	<?php }?>
	                            		<?php if($user->gw_status[4] == '1'){?>
		                            	<button type="button" class="btn btn-success waves-effect waves-light duplicate-btn btn-xs mb-1" rate-id="<?= $value->id;?>" data-toggle="modal" data-target="#duplicate-modal"><i class="mdi mdi-content-copy"></i></button>
		                            	<?php }?>
		                            </td>
                   				</tr>
                   		<?php }
                   		}?>
                   	</tbody>
                   	<tfoot>
                        <tr class="active">
                        	<?php if($user->gw_status[3] == '1'){?>
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
<div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; top: 22%;">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	        <div class="modal-header">
	            <h4 class="modal-title">Add GW Rate</h4>
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        </div>
	        <form method="post" action="<?= base_url();?>gwrate/add">
	              <div class="modal-body p-4">
	                  <div class="row">
	                      	<div class="col-md-6">
	                      		<label for="field-1" class="control-label">Tariff Name</label>
	                          	<select class="form-control" name="tariffname">
		    						<?php foreach($tariffnames as $value){?>
		    							<option><?= $value->tariffname;?></option>
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
	                              	<label for="field-1" class="control-label">Tariff Desc</label>
	                              	<input type="text" name="tariffdesc" class="form-control">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-1" class="control-label">Date </label>
	                              	<input class="form-control" type="date" name="date">
	                          	</div>
	                      	</div>
	                  	</div>
	                  	<div class="row">
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-1" class="control-label">Rate </label>
	                              	<input class="form-control" type="text" name="rate" data-toggle="input-mask" data-mask-format="09.9999" placeholder="xx.xxxx" value="0.0000">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Rate Conn</label>
	                              	<input class="form-control" type="text" name="rate_conn" data-toggle="input-mask" data-mask-format="09.9999" placeholder="xx.xxxx" value="0.0000">
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

<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; top: 22%;">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	        <div class="modal-header">
	            <h4 class="modal-title">Edit GW Rate</h4>
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        </div>
	        <form method="post" action="<?= base_url();?>gwrate/update">
	        		<input type="hidden" name="id" value="">
	              <div class="modal-body p-4">
	                  <div class="row">
	                      	<div class="col-md-6">
	                      		<label for="field-1" class="control-label">Tariff Name</label>
	                          	<select class="form-control" name="tariffname">
		    						<?php foreach($tariffnames as $value){?>
		    							<option><?= $value->tariffname;?></option>
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
	                              	<label for="field-1" class="control-label">Tariff Desc</label>
	                              	<input type="text" name="tariffdesc" class="form-control">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-1" class="control-label">Date </label>
	                              	<input class="form-control" type="date" name="date">
	                          	</div>
	                      	</div>
	                  	</div>
	                  	<div class="row">
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-1" class="control-label">Rate </label>
	                              	<input class="form-control" type="text" name="rate" data-toggle="input-mask" data-mask-format="09.9999" placeholder="xx.xxxx" value="0.0000">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Rate Conn</label>
	                              	<input class="form-control" type="text" name="rate_conn" data-toggle="input-mask" data-mask-format="09.9999" placeholder="xx.xxxx" value="0.0000">
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
	            <h4 class="modal-title">Delete GW Rate</h4>
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        </div>
            <div class="modal-body p-4">
            	<h4>Are you sure to delete GW Rate?</h4>
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

<div id="duplicate-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; top: 22%;">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	        <div class="modal-header">
	            <h4 class="modal-title">Duplicate Cl Rate</h4>
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        </div>
	        <form method="post" action="<?= base_url();?>gwrate/add">
	              <div class="modal-body p-4">
	                  <div class="row">
	                      	<div class="col-md-6">
	                      		<label for="field-1" class="control-label">Tariff Name</label>
	                          	<select class="form-control" name="tariffname" required>
		    						<?php foreach($tariffnames as $value){?>
		    							<option><?= $value->tariffname;?></option>
		    						<?php }?>
		    					</select>
	                      	</div>
	                      	<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-1" class="control-label" required>Prefix</label>
	                              	<input type="text" name="prefix" class="form-control" required>
	                          	</div>
	                      	</div>
	                  	</div>
	                  	<div class="row">
	                      	<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-1" class="control-label">Tariff Desc</label>
	                              	<input type="text" name="tariffdesc" class="form-control">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-6">
	                          	<div class="form-group">
	                              	<label for="field-1" class="control-label">Date </label>
	                              	<input class="form-control" type="date" name="date">
	                          	</div>
	                      	</div>
	                  	</div>
	                  	<div class="row">
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-1" class="control-label">Rate </label>
	                              	<input class="form-control" type="text" name="rate" data-toggle="input-mask" data-mask-format="09.9999" placeholder="xx.xxxx" value="0.0000">
	                          	</div>
	                      	</div>
	                      	<div class="col-md-3">
	                          	<div class="form-group">
	                              	<label for="field-4" class="control-label">Rate Conn</label>
	                              	<input class="form-control" type="text" name="rate_conn" data-toggle="input-mask" data-mask-format="09.9999" placeholder="xx.xxxx" value="0.0000">
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
