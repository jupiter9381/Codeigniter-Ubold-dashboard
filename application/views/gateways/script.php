
<!-- Init js -->
<script>
    $(document).ready(function(e){
    	var base_url = '<?= base_url();?>';
    	$(".strip").TouchSpin({
            min: 0,
            max: 999999,
            step: 1,
            boostat: 5,
            maxboostedstep: 10,
        });

    	$("#gateways-table").footable({
            // 
        });

        Ladda.bind( 'button[type=submit]', { timeout: 10000 } );
        
        var elem = document.querySelector('.js-switch');
        var init = new Switchery(elem, {color: '#ff5d48'});

        var elem_edit = document.querySelector('.js-switch-edit');
        var init_edit = new Switchery(elem_edit, {color: '#ff5d48'});

        var elem_duplicate = document.querySelector('.js-switch-duplicate');
        var init_duplicate = new Switchery(elem_duplicate, {color: '#ff5d48'});

        $(".add_payment_btn").click(function(){
            var payment = $(".payment_amount").val();
            var origin = $("#add-modal input[name='account_state']").val();
            $("#add-modal input[name='account_state']").val(Number(payment) + Number(origin));
            $(".payment_amount").val(0);
            $("#collapsePayment").collapse("hide");
        });

        $(".edit_payment_btn").click(function(){
            var payment = $(".edit_payment_amount").val();
            var origin = $("#edit-modal input[name='account_state']").val();
            $("#edit-modal input[name='account_state']").val(Number(payment) + Number(origin));
            $(".edit_payment_amount").val(0);
            $("#collapseEditPayment").collapse("hide");
        });

        $(".duplicate_payment_btn").click(function(){
            var payment = $(".duplicate_payment_amount").val();
            var origin = $("#duplicate-modal input[name='account_state']").val();
            $("#duplicate-modal input[name='account_state']").val(Number(payment) + Number(origin));
            $(".duplicate_payment_amount").val(0);
            $("#collapseDuplicatePayment").collapse("hide");
        });
        
        $("#add-modal button[type='submit']").click(function(e){
            e.preventDefault();
            $.ajax({
                url : base_url + 'gateway/add',
                type : 'post',
                dataType : 'json',
                data: $("#add-modal form").serialize(),
                success: function(data){
                    $("#add-modal input").css('border-color', '#ced4da');
                    if(data.error == "gateway_length"){
                        Ladda.stopAll();
                        $("#add-modal input[name='gw_name']").css('border-color', 'red');
                    } else if(data.error == "exist_gateway"){
                        Ladda.stopAll();
                        $("#add-modal input[name='gw_name']").css('border-color', 'red');
                    } else if(data.error == "gateway_ip"){
                        Ladda.stopAll();
                        $("#add-modal input[name='ip_address']").css('border-color', 'red');
                    } else if(data.error == "success"){
                        window.location.href = base_url + 'gateway';
                    }
                }
            });
        });

        $(".edit-btn").click(function(e){
            var gateway_name = $(this).attr('gateway-name');  
            $.ajax({
                url : base_url + 'gateway/getByName',
                type : 'post',
                dataType : 'json',
                data: {gateway_name: gateway_name},
                success: function(data){
                	console.log(data);
                    $("#edit-modal input[name='gw_id']").val(data['gateway'][0]['gw_id']);
                    $("#edit-modal input[name='gw_name']").val(data['gateway'][0]['gw_name']);
                    
                    $("#edit-modal select[name='destgroupname']").val(data['gateway'][0]['destgroupname']);
                    if(data['gateway'][0]['destgroupname'] == "none"){
                        $("#edit-modal .tariff_pl").css('display', 'block');
                        $("#edit-modal .tariff").css('display', 'none');
                        $("#edit-modal .tariff_pl select[name='tariff_name']").attr('disabled', false);
                        $("#edit-modal .tariff select[name='tariff_name']").attr('disabled', true);
                        $("#edit-modal .tariff_pl select[name='tariff_name']").val(data['gateway'][0]['tariff_name']);
                    } else {
                        $("#edit-modal .tariff_pl").css('display', 'none');
                        $("#edit-modal .tariff").css('display', 'block');
                        $("#edit-modal .tariff_pl select[name='tariff_name']").attr('disabled', true);
                        $("#edit-modal .tariff select[name='tariff_name']").attr('disabled', false);

                        $("#edit-modal .tariff select[name='tariff_name']").val(data['gateway'][0]['tariff_name']);
                    }
                    $("#edit-modal input[name='account_state']").val(data['gateway'][0]['account_state']);
                    $("#edit-modal input[name='calls_limit']").val(data['gateway'][0]['calls_limit']);
                    $("#edit-modal input[name='cps_limit']").val(data['gateway'][0]['cps_limit']);
                    if(data['gateway'][0]['active'] == 1){
                        init_edit.element.checked = true;
                        init_edit.setPosition();
                    } else {
                        init_edit.element.checked = false;
                        init_edit.setPosition();
                    }

                    $("#edit-modal select[name='type']").val(data['gateway1'][0]['type']);
                    $("#edit-modal input[name='strip']").val(data['gateway1'][0]['strip']);
                    $("#edit-modal input[name='ip_address']").val(data['gateway1'][0]['address']);
                    $("#edit-modal input[name='pri_prefix']").val(data['gateway1'][0]['pri_prefix']);
                    $("#edit-modal input[name='attrs']").val(data['gateway1'][0]['attrs']);
                    $("#edit-modal input[name='probe_mode']").val(data['gateway1'][0]['probe_mode']);
                    $("#edit-modal select[name='state']").val(data['gateway1'][0]['state']);
                    $("#edit-modal input[name='socket']").val(data['gateway1'][0]['socket']);
                    $("#edit-modal input[name='description']").val(data['gateway1'][0]['description']);
                }
            });
        });

         $(".delete_btn").click(function(e){
            $.each($("input.del-check:checked"), function(){ 
                $.ajax({
                    url : base_url + 'gateway/delete',
                    type : 'post',
                    dataType : 'json',
                    data: {gateway_name: $(this).val()},
                    success: function(data){
                        window.location.href = base_url + 'gateway';
                    }
                });
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

        $(".duplicate-btn").click(function(e){
            var gateway_name = $(this).attr('gateway-name');
            $.ajax({
                url : base_url + 'gateway/getByName',
                type : 'post',
                dataType : 'json',
                data: {gateway_name: gateway_name},
                success: function(data){
                    $("#duplicate-modal input[name='gw_name']").val(data['gateway'][0]['gw_name']);
                    $("#duplicate-modal select[name='destgroupname']").val(data['gateway'][0]['destgroupname']);

                    if(data['gateway'][0]['destgroupname'] == "none"){
                        $("#duplicate-modal .tariff_pl").css('display', 'block');
                        $("#duplicate-modal .tariff").css('display', 'none');
                        $("#duplicate-modal .tariff_pl select[name='tariff_name']").attr('disabled', false);
                        $("#duplicate-modal .tariff select[name='tariff_name']").attr('disabled', true);
                        $("#duplicate-modal .tariff_pl select[name='tariff_name']").val(data['gateway'][0]['tariff_name']);
                    } else {
                        $("#duplicate-modal .tariff_pl").css('display', 'none');
                        $("#duplicate-modal .tariff").css('display', 'block');
                        $("#duplicate-modal .tariff_pl select[name='tariff_name']").attr('disabled', true);
                        $("#duplicate-modal .tariff select[name='tariff_name']").attr('disabled', false);

                        $("#duplicate-modal .tariff select[name='tariff_name']").val(data['gateway'][0]['tariff_name']);
                    }


                    $("#duplicate-modal input[name='account_state']").val(data['gateway'][0]['account_state']);
                    $("#duplicate-modal input[name='calls_limit']").val(data['gateway'][0]['calls_limit']);
                    $("#duplicate-modal input[name='cps_limit']").val(data['gateway'][0]['cps_limit']);
                    if(data['gateway'][0]['active'] == 1){
                        init_edit.element.checked = true;
                        init_edit.setPosition();
                    } else {
                        init_edit.element.checked = false;
                        init_edit.setPosition();
                    }

                    $("#duplicate-modal select[name='type']").val(data['gateway1'][0]['type']);
                    $("#duplicate-modal input[name='strip']").val(data['gateway1'][0]['strip']);
                    $("#duplicate-modal input[name='ip_address']").val(data['gateway1'][0]['address']);
                    $("#duplicate-modal input[name='pri_prefix']").val(data['gateway1'][0]['pri_prefix']);
                    $("#duplicate-modal input[name='attrs']").val(data['gateway1'][0]['attrs']);
                    $("#duplicate-modal input[name='probe_mode']").val(data['gateway1'][0]['probe_mode']);
                    $("#duplicate-modal select[name='state']").val(data['gateway1'][0]['state']);
                    $("#duplicate-modal input[name='socket']").val(data['gateway1'][0]['socket']);
                    $("#duplicate-modal input[name='description']").val(data['gateway1'][0]['description']);
                }
            });
            $(".duplicate_gateway").val(gateway_name);
        });

        $("#duplicate-modal button[type='submit']").click(function(e){
            e.preventDefault();
            $.ajax({
                url : base_url + 'gateway/add',
                type : 'post',
                dataType : 'json',
                data: $("#duplicate-modal form").serialize(),
                success: function(data){
                    $("#duplicate-modal input").css('border-color', '#ced4da');
                    if(data.error == "exist_gateway"){
                        Ladda.stopAll();
                        $("#duplicate-modal input[name='gw_name']").css('border-color', 'red');
                    } else if(data.error == "gateway_id"){
                        Ladda.stopAll();
                        $("#duplicate-modal input[name='ip_address']").css('border-color', 'red');
                    } else if(data.error = "success"){
                        window.location.href = base_url + 'gateway';
                    }
                }
            });
        });
        $("#page-size").change(function(){
            $("#gateways-table").data("page-size",$(this).val());
            $("#gateways-table").trigger("footable_initialized");
        });

        $("#edit-modal select[name='destgroupname']").change(function(e){
            if($(this).val() == "none"){
                $("#edit-modal .tariff_pl").css('display', 'block');
                $("#edit-modal .tariff").css('display', 'none');
                $("#edit-modal .tariff_pl select[name='tariff_name']").attr('disabled', false);
                $("#edit-modal .tariff select[name='tariff_name']").attr('disabled', true);
            } else {
                $("#edit-modal .tariff_pl").css('display', 'none');
                $("#edit-modal .tariff").css('display', 'block');
                $("#edit-modal .tariff_pl select[name='tariff_name']").attr('disabled', true);
                $("#edit-modal .tariff select[name='tariff_name']").attr('disabled', false);
            }
        });

        $("#add-modal select[name='destgroupname']").change(function(e){
            if($(this).val() == "none"){
                $("#add-modal .tariff_pl").css('display', 'block');
                $("#add-modal .tariff").css('display', 'none');
                $("#add-modal .tariff_pl select[name='tariff_name']").attr('disabled', false);
                $("#add-modal .tariff select[name='tariff_name']").attr('disabled', true);
            } else {
                $("#add-modal .tariff_pl").css('display', 'none');
                $("#add-modal .tariff").css('display', 'block');
                $("#add-modal .tariff_pl select[name='tariff_name']").attr('disabled', true);
                $("#add-modal .tariff select[name='tariff_name']").attr('disabled', false);
            }
            console.log($(this).val());
        });
        $("#duplicate-modal select[name='destgroupname']").change(function(e){
            if($(this).val() == "none"){
                $("#duplicate-modal .tariff_pl").css('display', 'block');
                $("#duplicate-modal .tariff").css('display', 'none');
                $("#duplicate-modal .tariff_pl select[name='tariff_name']").attr('disabled', false);
                $("#duplicate-modal .tariff select[name='tariff_name']").attr('disabled', true);
            } else {
                $("#duplicate-modal .tariff_pl").css('display', 'none');
                $("#duplicate-modal .tariff").css('display', 'block');
                $("#duplicate-modal .tariff_pl select[name='tariff_name']").attr('disabled', true);
                $("#duplicate-modal .tariff select[name='tariff_name']").attr('disabled', false);
            }
            console.log($(this).val());
        });
    });
</script>