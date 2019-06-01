<script type="text/javascript">
	var base_url = '<?= base_url();?>';
    $(".edit-btn").click(function(e){
		$("#edit-modal input[name='user_id']").val($(this).attr('user-id'));

        Ladda.bind( 'button[type=submit]', { timeout: 10000 } );
        
		$.ajax({
            url : base_url + 'user/getById',
            type : 'post',
            dataType : 'json',
            data: {id: $(this).attr('user-id')},
            success: function(data){
                if(data['client_status'].charAt(0) == '1'){
                	$("#edit-modal #edit_client_view").attr('checked', true);
                } else {
                	$("#edit-modal #edit_client_view").attr('checked', false);
                }

                if(data['client_status'].charAt(1) == '1'){
                	$("#edit-modal #edit_client_add").attr('checked', true);
                } else {
                	$("#edit-modal #edit_client_add").attr('checked', false);
                }

                if(data['client_status'].charAt(2) == '1'){
                	$("#edit-modal #edit_client_edit").attr('checked', true);
                } else {
                	$("#edit-modal #edit_client_edit").attr('checked', false);
                }

                if(data['client_status'].charAt(3) == '1'){
                	$("#edit-modal #edit_client_delete").attr('checked', true);
                } else {
                	$("#edit-modal #edit_client_delete").attr('checked', false);
                }

                if(data['client_status'].charAt(4) == '1'){
                	$("#edit-modal #edit_client_duplicate").attr('checked', true);
                } else {
                	$("#edit-modal #edit_client_duplicate").attr('checked', false);
                }

                if(data['gateway_status'].charAt(0) == '1'){
                	$("#edit-modal #edit_gateway_view").attr('checked', true);
                } else {
                	$("#edit-modal #edit_gateway_view").attr('checked', false);
                }

                if(data['gateway_status'].charAt(1) == '1'){
                	$("#edit-modal #edit_gateway_add").attr('checked', true);
                } else {
                	$("#edit-modal #edit_gateway_add").attr('checked', false);
                }

                if(data['gateway_status'].charAt(2) == '1'){
                	$("#edit-modal #edit_gateway_edit").attr('checked', true);
                } else {
                	$("#edit-modal #edit_gateway_edit").attr('checked', false);
                }

                if(data['gateway_status'].charAt(3) == '1'){
                	$("#edit-modal #edit_gateway_delete").attr('checked', true);
                } else {
                	$("#edit-modal #edit_gateway_delete").attr('checked', false);
                }

                if(data['gateway_status'].charAt(4) == '1'){
                	$("#edit-modal #edit_gateway_duplicate").attr('checked', true);
                } else {
                	$("#edit-modal #edit_gateway_duplicate").attr('checked', false);
                }

                if(data['rule_status'].charAt(0) == '1'){
                	$("#edit-modal #edit_rule_view").attr('checked', true);
                } else {
                	$("#edit-modal #edit_rule_view").attr('checked', false);
                }

                if(data['rule_status'].charAt(1) == '1'){
                	$("#edit-modal #edit_rule_add").attr('checked', true);
                } else {
                	$("#edit-modal #edit_rule_add").attr('checked', false);
                }

                if(data['rule_status'].charAt(2) == '1'){
                	$("#edit-modal #edit_rule_edit").attr('checked', true);
                } else {
                	$("#edit-modal #edit_rule_edit").attr('checked', false);
                }

                if(data['rule_status'].charAt(3) == '1'){
                	$("#edit-modal #edit_rule_delete").attr('checked', true);
                } else {
                	$("#edit-modal #edit_rule_delete").attr('checked', false);
                }

                if(data['rule_status'].charAt(4) == '1'){
                	$("#edit-modal #edit_rule_duplicate").attr('checked', true);
                } else {
                	$("#edit-modal #edit_rule_duplicate").attr('checked', false);
                }

                if(data['cl_status'].charAt(0) == '1'){
                	$("#edit-modal #edit_cl_view").attr('checked', true);
                } else {
                	$("#edit-modal #edit_cl_view").attr('checked', false);
                }

                if(data['cl_status'].charAt(1) == '1'){
                	$("#edit-modal #edit_cl_add").attr('checked', true);
                } else {
                	$("#edit-modal #edit_cl_add").attr('checked', false);
                }

                if(data['cl_status'].charAt(2) == '1'){
                	$("#edit-modal #edit_cl_edit").attr('checked', true);
                } else {
                	$("#edit-modal #edit_cl_edit").attr('checked', false);
                }

                if(data['cl_status'].charAt(3) == '1'){
                	$("#edit-modal #edit_cl_delete").attr('checked', true);
                } else {
                	$("#edit-modal #edit_cl_delete").attr('checked', false);
                }

                if(data['cl_status'].charAt(4) == '1'){
                	$("#edit-modal #edit_cl_duplicate").attr('checked', true);
                } else {
                	$("#edit-modal #edit_cl_duplicate").attr('checked', false);
                }

                if(data['gw_status'].charAt(0) == '1'){
                	$("#edit-modal #edit_gw_view").attr('checked', true);
                } else {
                	$("#edit-modal #edit_gw_view").attr('checked', false);
                }

                if(data['gw_status'].charAt(1) == '1'){
                	$("#edit-modal #edit_gw_add").attr('checked', true);
                } else {
                	$("#edit-modal #edit_gw_add").attr('checked', false);
                }

                if(data['gw_status'].charAt(2) == '1'){
                	$("#edit-modal #edit_gw_edit").attr('checked', true);
                } else {
                	$("#edit-modal #edit_gw_edit").attr('checked', false);
                }

                if(data['gw_status'].charAt(3) == '1'){
                	$("#edit-modal #edit_gw_delete").attr('checked', true);
                } else {
                	$("#edit-modal #edit_gw_delete").attr('checked', false);
                }

                if(data['gw_status'].charAt(4) == '1'){
                	$("#edit-modal #edit_gw_duplicate").attr('checked', true);
                } else {
                	$("#edit-modal #edit_gw_duplicate").attr('checked', false);
                }

                if(data['allowed'] == '1'){
                	$("#edit-modal #edit_permission").attr('checked', true);
                } else {
                	$("#edit-modal #edit_permission").attr('checked', false);
                }
                
            }
        });
	});
    $("input.del-check").click(function(e){
        var selected = 0;
        $.each($("input.del-check:checked"), function(){ 
            selected++;
        });
        if(selected > 0) {
            $("button[data-target='#delete-modal']").attr("disabled", false);
        } else {
            $("button[data-target='#delete-modal']").attr("disabled", true);
        }
    });

    $(".delete_btn").click(function(e){
        $.each($("input.del-check:checked"), function(){ 
            $.ajax({
                url : base_url + 'user/delete',
                type : 'post',
                dataType : 'json',
                data: {user_id: $(this).val()},
                success: function(data){
                    window.location.href = base_url + 'user';
                }
            });
        });
    });
</script>