<script>
    $(document).ready(function(e){
    	var base_url = "<?= base_url();?>";
        var count = '<?= count($rules);?>';
        if(count == 500){
            $("#alert-modal").modal();
        }

        $("select").select2();

        Ladda.bind( 'button[type=submit]', { timeout: 10000 } );
        
        $(".strip").TouchSpin({
            min: 0,
            max: 20,
            step: 1,
            boostat: 5,
            maxboostedstep: 10,
        });

    	$("#rules-table").footable({
            // 
        });
        $("#page-size").change(function(){
            $("#rules-table").data("page-size",$(this).val());
            $("#rules-table").trigger("footable_initialized");
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
                    url : base_url + 'rule/delete',
                    type : 'post',
                    dataType : 'json',
                    data: {rule_id: $(this).val()},
                    success: function(data){
                        window.location.href = base_url + 'rule';
                    }
                });
            });
        });

        $(".edit-btn").click(function(e){
            var rule_id = $(this).attr('rule-id');  
            $.ajax({
                url : base_url + 'rule/getByRuleId',
                type : 'post',
                dataType : 'json',
                data: {rule_id: rule_id},
                success: function(data){
                    
                    $("#edit-modal input[name='ruleid']").val(data['rule'][0]['ruleid']);
                    $("#edit-modal select[name='groupid']").val(data['rule'][0]['groupid']);
                    $("#edit-modal input[name='prefix']").val(data['rule'][0]['prefix']);
                    $("#edit-modal input[name='timerec']").val(data['rule'][0]['timerec']);
                    $("#edit-modal input[name='priority']").val(data['rule'][0]['priority']);
                    $("#edit-modal input[name='routeid']").val(data['rule'][0]['routeid']);
                    $("#edit-modal select[name='gwlist']").val(data['rule'][0]['gwlist']);
                    $("#edit-modal input[name='attrs']").val(data['rule'][0]['attrs']);
                    $("#edit-modal input[name='description']").val(data['rule'][0]['description']);
                    
                    $("#edit-modal select").select2();
                }
            });
        });

        $(".duplicate-btn").click(function(e){
        	var rule_id = $(this).attr('rule-id');  
            $.ajax({
                url : base_url + 'rule/getByRuleId',
                type : 'post',
                dataType : 'json',
                data: {rule_id: rule_id},
                success: function(data){
                    
                    $("#duplicate-modal select[name='groupid']").val(data['rule'][0]['groupid']);
                    $("#duplicate-modal input[name='prefix']").val(data['rule'][0]['prefix']);
                    $("#duplicate-modal input[name='timerec']").val(data['rule'][0]['timerec']);
                    $("#duplicate-modal input[name='priority']").val(data['rule'][0]['priority']);
                    $("#duplicate-modal input[name='routeid']").val(data['rule'][0]['routeid']);
                    $("#duplicate-modal select[name='gwlist']").val(data['rule'][0]['gwlist']);
                    $("#duplicate-modal input[name='attrs']").val(data['rule'][0]['attrs']);
                    $("#duplicate-modal input[name='description']").val(data['rule'][0]['description']);
                    
                    $("#duplicate-modal select").select2();
                }
            });
        });
    });
</script>