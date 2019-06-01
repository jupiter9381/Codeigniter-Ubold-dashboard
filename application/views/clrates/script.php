<script type="text/javascript">
	$(document).ready(function(e){
		var base_url = "<?= base_url();?>";

        var count = '<?= count($rates);?>';
        console.log(count);
        if(count == 500){
            $("#alert-modal").modal();
        }

        Ladda.bind( 'button[type=submit]', { timeout: 10000 } );
        
		$("#rates-table").footable({
            "pagingType": "bootstrap_extended"
        });

		$("#page-size").change(function(){
            $("#rates-table").data("page-size",$(this).val());
            $("#rates-table").trigger("footable_initialized");
        });
        $(".edit-btn").click(function(e){
            var rate_id = $(this).attr('rate-id');  
            $.ajax({
                url : base_url + 'clrate/getByRateId',
                type : 'post',
                dataType : 'json',
                data: {rate_id: rate_id},
                success: function(data){
                    $("#edit-modal input[name='id']").val(data['result'][0]['id']);
                    $("#edit-modal select[name='tariffname']").val(data['result'][0]['tariffname']);
                    $("#edit-modal select").select2();
                    $("#edit-modal input[name='prefix']").val(data['result'][0]['prefix']);
                    $("#edit-modal input[name='tariffdesc']").val(data['result'][0]['tariffdesc']);
                    $("#edit-modal input[name='date']").val(data['result'][0]['date']);
                    $("#edit-modal input[name='rate']").val(data['result'][0]['rate']);
                    $("#edit-modal input[name='rate_conn']").val(data['result'][0]['rate_conn']);
                    $("#edit-modal input[name='cost_margin']").val(data['result'][0]['cost_margin']);
                    $("#edit-modal input[name='cost_margin_conn']").val(data['result'][0]['cost_margin_conn']);
                    
                }
            });
        });
        $(".duplicate-btn").click(function(e){
        	var rate_id = $(this).attr('rate-id');   
            $.ajax({
                url : base_url + 'clrate/getByRateId',
                type : 'post',
                dataType : 'json',
                data: {rate_id: rate_id},
                success: function(data){
                    $("#duplicate-modal select[name='tariffname']").val(data['result'][0]['tariffname']);
                    $("#duplicate-modal select").select2();
                    $("#duplicate-modal input[name='prefix']").val(data['result'][0]['prefix']);
                    $("#duplicate-modal input[name='tariffdesc']").val(data['result'][0]['tariffdesc']);
                    $("#duplicate-modal input[name='date']").val(data['result'][0]['date']);
                    $("#duplicate-modal input[name='rate']").val(data['result'][0]['rate']);
                    $("#duplicate-modal input[name='rate_conn']").val(data['result'][0]['rate_conn']);
                    $("#duplicate-modal input[name='cost_margin']").val(data['result'][0]['cost_margin']);
                    $("#duplicate-modal input[name='cost_margin_conn']").val(data['result'][0]['cost_margin_conn']);
                    
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
                    url : base_url + 'clrate/delete',
                    type : 'post',
                    dataType : 'json',
                    data: {rate_id: $(this).val()},
                    success: function(data){
                        window.location.href = base_url + 'clrate';
                    }
                });
            });
        });

        $("select").select2();

        $("#duplicate-modal button[type='submit']").click(function(e){
            e.preventDefault();
            $.ajax({
                url : base_url + 'clrate/add',
                type : 'post',
                dataType : 'json',
                data: $("#duplicate-modal form").serialize(),
                success: function(data){
                    $("#duplicate-modal input").css('border-color', '#ced4da');
                    $("#duplicate-modal span.select2-selection").css('border-color', '#ced4da');
                    if(data.error == "exist_clrate"){
                        Ladda.stopAll();
                        $("#duplicate-modal span.select2-selection").css('border', '1px solid red');
                        $("#duplicate-modal input[name='prefix']").css('border-color', 'red');
                        $("#duplicate-modal input[name='date']").css('border-color', 'red');
                    } else {

                        window.location.href = base_url + 'clrate';
                    }
                }
            });
        });

        $("#add-modal button[type='submit']").click(function(e){
            e.preventDefault();
            $.ajax({
                url : base_url + 'clrate/add',
                type : 'post',
                dataType : 'json',
                data: $("#add-modal form").serialize(),
                success: function(data){
                    $("#add-modal input").css('border-color', '#ced4da');
                    $("#add-modal span.select2-selection").css('border-color', '#ced4da');
                    if(data.error == "exist_clrate"){
                        Ladda.stopAll();
                        $("#add-modal span.select2-selection").css('border', '1px solid red');
                        $("#add-modal input[name='prefix']").css('border-color', 'red');
                        $("#add-modal input[name='date']").css('border-color', 'red');
                    } else {
                        
                        window.location.href = base_url + 'clrate';
                    }
                }
            });
        });

        $("#edit-modal button[type='submit']").click(function(e){
            e.preventDefault();
            $.ajax({
                url : base_url + 'clrate/update',
                type : 'post',
                dataType : 'json',
                data: $("#edit-modal form").serialize(),
                success: function(data){
                    $("#edit-modal input").css('border-color', '#ced4da');
                    $("#edit-modal span.select2-selection").css('border-color', '#ced4da');
                    if(data.error == "exist_clrate"){
                        Ladda.stopAll();
                        $("#edit-modal span.select2-selection").css('border', '1px solid red');
                        $("#edit-modal input[name='prefix']").css('border-color', 'red');
                        $("#edit-modal input[name='date']").css('border-color', 'red');
                    } else {
                        
                        window.location.href = base_url + 'clrate';
                    }
                }
            });
        });

        $("#searchForm button[type='button']").click(function(e){
            e.preventDefault();
            var check = $("input[name='check_desc']:checked").val();
            var custom_desc = $("input[name='search_customtariffdesc']").val();
            if((check == 0) && (custom_desc == '')){
                Ladda.stopAll();
                $("input[name='search_customtariffdesc']").css('border', '1px solid red');
            } else {
                $("#searchForm").submit();
            }
        });
	})
</script>