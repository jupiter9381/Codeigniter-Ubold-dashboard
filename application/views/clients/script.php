
<!-- Init js -->
<script>
    $(document).ready(function(e){
        $("#clients-table").footable({
            // 
        });

        $(".strip").TouchSpin({
            min: 0,
            max: 999999,
            step: 1,
            boostat: 5,
            maxboostedstep: 10,
        });
        
        Ladda.bind( 'button[type=submit]', { timeout: 10000 } );

        var elem = document.querySelector('.js-switch');
        var init = new Switchery(elem, {color: '#ff5d48'});

        var elem_edit = document.querySelector('.js-switch-edit');
        var init_edit = new Switchery(elem_edit, {color: '#ff5d48'});

        var elem_duplicate = document.querySelector('.js-switch-duplicate');
        var init_duplicate = new Switchery(elem_duplicate, {color: '#ff5d48'});

        var ip_item_index = 1;
        $(".add_ip").click(function(e){
            var content = "<div class='col-md-4 ip_item_"+ip_item_index+"'>";
            content += "<div class='row form-group'>";
            content += "<div class='col-md-10'>";
            content += "<input type='text' name='ip_address[]' class='form-control add_ip_input' data-toggle='input-mask' data-mask-format='099.099.099.099' placeholder='xxx.xxx.xxx.xxx'/>";
            content += "</div>";
            content += "<div class='col-md-1' style='paddint-left:0px;'>";
            content += "<i class='mdi mdi-minus-circle del_ip' item-index='"+ip_item_index+"' style='font-size: 20px; margin-left: 10px; color: rebeccapurple; cursor: pointer; display: inline-block;'></i>";
            content += "</div>";
            content += "</div>";
            $(".ip-section").append($(content));
            $(".add_ip_input").mask('099.099.099.099');
            $(".del_ip").click(function(e){
                var index = $(this).attr('item-index');
                $(".ip_item_"+index).remove();
            });
            ip_item_index++;
        });

        $(".del_ip").click(function(e){
            var index = $(this).attr('item-index');
            $(".ip_item_"+index).remove();
        });

        var base_url = '<?= base_url();?>';
        $(".delete_btn").click(function(e){
            $.each($("input.del-check:checked"), function(){ 
                $.ajax({
                    url : base_url + 'client/delete',
                    type : 'post',
                    dataType : 'json',
                    data: {client_name: $(this).val()},
                    success: function(data){
                        window.location.href = base_url + 'client';
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

        $(".edit-btn").click(function(e){
            var client_name = $(this).attr('client-name');  
            $.ajax({
                url : base_url + 'client/getByName',
                type : 'post',
                dataType : 'json',
                data: {client_name: client_name},
                success: function(data){
                    console.log(data['client'][0]['tariff_name_AZ']);
                    $("#edit-modal input[name='client_id']").val(data['client'][0]['client_id']);
                    $("#edit-modal input[name='client_name']").val(data['client'][0]['client_name']);
                    $("#edit-modal select[name='destgroupname']").val(data['client'][0]['destgroupname']);

                    if(data['client'][0]['destgroupname'] == "none"){
                        $("#edit-modal .tariff_pl").css('display', 'block');
                        $("#edit-modal .tariff").css('display', 'none');
                        $("#edit-modal .tariff_pl select[name='tariff_name']").attr('disabled', false);
                        $("#edit-modal .tariff select[name='tariff_name']").attr('disabled', true);
                        $("#edit-modal .tariff_pl select[name='tariff_name']").val(data['client'][0]['tariff_name']);
                    } else {
                        $("#edit-modal .tariff_pl").css('display', 'none');
                        $("#edit-modal .tariff").css('display', 'block');
                        $("#edit-modal .tariff_pl select[name='tariff_name']").attr('disabled', true);
                        $("#edit-modal .tariff select[name='tariff_name']").attr('disabled', false);

                        $("#edit-modal .tariff select[name='tariff_name']").val(data['client'][0]['tariff_name']);
                    }

                    $("#edit-modal select[name='tariff_name_AZ']").val(data['client'][0]['tariff_name_AZ']);
                    $("#edit-modal select[name='dr_groupid_PL']").val(data['client'][0]['dr_groupid_PL']);
                    $("#edit-modal select[name='dr_groupid_AZ']").val(data['client'][0]['dr_groupid_AZ']);
                    $("#edit-modal input[name='strip']").val(data['client'][0]['strip']);
                    $("#edit-modal input[name='strip_prefix']").val(data['client'][0]['strip_prefix']);
                    $("#edit-modal input[name='account_state']").val(data['client'][0]['account_state']);
                    $("#edit-modal input[name='calls_limit']").val(data['client'][0]['calls_limit']);
                    $("#edit-modal input[name='cps_limit']").val(data['client'][0]['cps_limit']);
                    $("#edit-modal input[name='zip_code']").val(data['client'][0]['zip_code']);
                    if(data['client'][0]['active'] == 1){
                        init_edit.element.checked = true;
                        init_edit.setPosition();
                    } else {
                        init_edit.element.checked = false;
                        init_edit.setPosition();
                    }

                    var content = "";
                    for(var i = 0; i < data['ip'].length; i++){
                        content += "<div class='col-md-4 ip_item_edit_"+(i+1)+"'>";
                        content += "<div class='row form-group'>";
                        content += "<div class='col-md-10'>";
                        content += "<input type='text' name='ip_address[]' class='form-control edit_ip_edit' value='"+data['ip'][i]['ip']+"' data-toggle='input-mask' data-mask-format='099.099.099.099' placeholder='xxx.xxx.xxx.xxx'/>";
                        content += "</div>";
                        content += "<div class='col-md-1' style='paddint-left:0px;'>";
                        content += "<i class='mdi mdi-minus-circle del_ip_edit' item-index='"+(i+1)+"' style='font-size: 20px; margin-left: 10px; color: rebeccapurple; cursor: pointer; display: inline-block;'></i>";
                        content += "</div>";
                        content += "</div>";
                        content += "</div>";
                    }
                    $(".ip-section_edit").html(content);
                    $(".del_ip_edit").click(function(e){
                        var index = $(this).attr('item-index');
                        $(".ip_item_edit_"+index).remove();
                    });
                    ip_item_index_edit = i + 1;
                }
            });
        });

        var ip_item_index_edit = 1;
        $(".add_ip_edit").click(function(e){
            var content = "<div class='col-md-4 ip_item_edit_"+ip_item_index_edit+"'>";
            content += "<div class='row form-group'>";
            content += "<div class='col-md-10'>";
            content += "<input type='text' name='ip_address[]' class='form-control edit_ip_edit' data-toggle='input-mask' data-mask-format='099.099.099.099' placeholder='xxx.xxx.xxx.xxx'/>";
            content += "</div>";
            content += "<div class='col-md-1' style='paddint-left:0px;'>";
            content += "<i class='mdi mdi-minus-circle del_ip_edit' item-index='"+ip_item_index_edit+"' style='font-size: 20px; margin-left: 10px; color: rebeccapurple; cursor: pointer; display: inline-block;'></i>";
            content += "</div>";
            content += "</div>";

            $(".ip-section_edit").append($(content));
            $(".edit_ip_edit").mask('099.099.099.099');

            $(".del_ip_edit").click(function(e){
                var index = $(this).attr('item-index');
                $(".ip_item_edit_"+index).remove();
            });

            ip_item_index_edit++;
        });

        var ip_item_index_duplicate = 1;

        $(".add_ip_duplicate").click(function(e){
            var content = "<div class='col-md-4 ip_item_duplicate_"+ip_item_index_duplicate+"'>";
            content += "<div class='row form-group'>";
            content += "<div class='col-md-10'>";
            content += "<input type='text' name='ip_address[]' class='form-control edit_ip_edit' data-toggle='input-mask' data-mask-format='099.099.099.099' placeholder='xxx.xxx.xxx.xxx'/>";
            content += "</div>";
            content += "<div class='col-md-1' style='paddint-left:0px;'>";
            content += "<i class='mdi mdi-minus-circle del_ip_duplicate' item-index='"+ip_item_index_duplicate+"' style='font-size: 20px; margin-left: 10px; color: rebeccapurple; cursor: pointer; display: inline-block;'></i>";
            content += "</div>";
            content += "</div>";

            $(".ip-section_duplicate").append($(content));
            $(".edit_ip_duplicate").mask('099.099.099.099');

            $(".del_ip_duplicate").click(function(e){
                var index = $(this).attr('item-index');
                $(".ip_item_duplicate_"+index).remove();
            });

            ip_item_index_duplicate++;
        });
        
        $(".duplicate-btn").click(function(e){
            var client_name = $(this).attr('client-name');
            $.ajax({
                url : base_url + 'client/getByName',
                type : 'post',
                dataType : 'json',
                data: {client_name: client_name},
                success: function(data){
                    $("#duplicate-modal input[name='client_name']").val(data['client'][0]['client_name']);
                    $("#duplicate-modal select[name='destgroupname']").val(data['client'][0]['destgroupname']);


                    if(data['client'][0]['destgroupname'] == "none"){
                        $("#edit-modal .tariff_pl").css('display', 'block');
                        $("#edit-modal .tariff").css('display', 'none');
                        $("#edit-modal .tariff_pl select[name='tariff_name']").attr('disabled', false);
                        $("#edit-modal .tariff select[name='tariff_name']").attr('disabled', true);
                        $("#edit-modal .tariff_pl select[name='tariff_name']").val(data['client'][0]['tariff_name']);
                    } else {
                        $("#edit-modal .tariff_pl").css('display', 'none');
                        $("#edit-modal .tariff").css('display', 'block');
                        $("#edit-modal .tariff_pl select[name='tariff_name']").attr('disabled', true);
                        $("#edit-modal .tariff select[name='tariff_name']").attr('disabled', false);

                        $("#edit-modal .tariff select[name='tariff_name']").val(data['client'][0]['tariff_name']);
                    }


                    $("#duplicate-modal select[name='tariff_name_AZ']").val(data['client'][0]['tariff_name_AZ']);
                    $("#duplicate-modal select[name='dr_groupid_PL']").val(data['client'][0]['dr_groupid_PL']);
                    $("#duplicate-modal select[name='dr_groupid_AZ']").val(data['client'][0]['dr_groupid_AZ']);
                    $("#duplicate-modal input[name='strip']").val(data['client'][0]['strip']);
                    $("#duplicate-modal input[name='strip_prefix']").val(data['client'][0]['strip_prefix']);
                    $("#duplicate-modal input[name='account_state']").val(data['client'][0]['account_state']);
                    $("#duplicate-modal input[name='calls_limit']").val(data['client'][0]['calls_limit']);
                    $("#duplicate-modal input[name='cps_limit']").val(data['client'][0]['cps_limit']);
                    $("#duplicate-modal input[name='zip_code']").val(data['client'][0]['zip_code']);
                    if(data['client'][0]['active'] == 1){
                        init_edit.element.checked = true;
                        init_edit.setPosition();
                    } else {
                        init_edit.element.checked = false;
                        init_edit.setPosition();
                    }

                    var content = "";
                    ip_item_index_duplicate = data['ip'].length + 1;;
                    for(var i = 0; i < data['ip'].length; i++){
                        content += "<div class='col-md-4 ip_item_duplicate_"+i+"' >";
                        content += "<div class='row form-group'>";
                        content += "<div class='col-md-10'>";
                        content += "<input type='text' name='ip_address[]' class='form-control edit_ip_duplicate' value='"+data['ip'][i]['ip']+"' data-toggle='input-mask' data-mask-format='099.099.099.099' placeholder='xxx.xxx.xxx.xxx'/>";
                        content += "</div>";
                        content += "<div class='col-md-1' style='paddint-left:0px;'>";
                        content += "<i class='mdi mdi-minus-circle del_ip_duplicate' item-index='"+i+"' style='font-size: 20px; margin-left: 10px; color: rebeccapurple; cursor: pointer; display: inline-block;'></i>";
                        content += "</div>";
                        content += "</div>";
                        content += "</div>";
                    }
                    $(".ip-section_duplicate").html(content);

                    $(".del_ip_duplicate").click(function(e){
                        var index = $(this).attr('item-index');
                        $(".ip_item_duplicate_"+index).remove();
                    });
                }
            });
            $(".duplicate_client").val(client_name);
        });

        $("#page-size").change(function(){
            $("#clients-table").data("page-size",$(this).val());
            $("#clients-table").trigger("footable_initialized");
        });

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

        $("#duplicate-modal button[type='submit']").click(function(e){
            e.preventDefault();
            $.ajax({
                url : base_url + 'client/add',
                type : 'post',
                dataType : 'json',
                data: $("#duplicate-modal form").serialize(),
                success: function(data){
                    $("#duplicate-modal input").css('border-color', '#ced4da');
                    if(data.error == "exist_client"){
                        Ladda.stopAll();
                        $("#duplicate-modal input[name='client_name']").css('border-color', 'red');
                    } else if(data.error == "ip_address"){
                        Ladda.stopAll();
                        var ips = data.ip_address;
                        for(var i = 0; i < ips.length; i++){
                            $.each($("#duplicate-modal .ip-section_duplicate input"), function(){ 
                                if(ips[i]['ip'] == $(this).val()){
                                    $(this).css('border-color', 'red');
                                }
                            });
                        }
                    } else if(data.error = "success"){
                        window.location.href = base_url + 'client';
                    }
                }
            });
        });

        $("#add-modal button[type='submit']").click(function(e){
            e.preventDefault();
            $.ajax({
                url : base_url + 'client/add',
                type : 'post',
                dataType : 'json',
                data: $("#add-modal form").serialize(),
                success: function(data){
                    $("#add-modal input").css('border-color', '#ced4da');
                    if(data.error == "client_length"){
                        Ladda.stopAll();
                        $("#add-modal input[name='client_name']").css('border-color', 'red');
                    } else if(data.error == "exist_client"){
                        Ladda.stopAll();
                        $("#add-modal input[name='client_name']").css('border-color', 'red');
                    } else if(data.error == "ip_address"){
                        var ips = data.ip_address;
                        for(var i = 0; i < ips.length; i++){
                            $.each($("#add-modal .ip-section input"), function(){ 
                                if(ips[i]['ip'] == $(this).val()){
                                    $(this).css('border-color', 'red');
                                }
                            });
                        }
                    } else if(data.error == "success"){
                        window.location.href = base_url + 'client';
                    }
                }
            });
        });

        $("#edit-modal button[type='submit']").click(function(e){
            e.preventDefault();
            $.ajax({
                url : base_url + 'client/update',
                type : 'post',
                dataType : 'json',
                data: $("#edit-modal form").serialize(),
                success: function(data){
                    $("#edit-modal input").css('border-color', '#ced4da');
                    if(data.error == "exist_client"){
                        Ladda.stopAll();
                        $("#edit-modal input[name='client_name']").css('border-color', 'red');
                    } else if(data.error == "ip_address"){
                        Ladda.stopAll();
                        var ips = data.ip_address;
                        for(var i = 0; i < ips.length; i++){
                            $.each($("#edit-modal .ip-section_edit input"), function(){ 
                                if(ips[i]['ip'] == $(this).val()){
                                    $(this).css('border-color', 'red');
                                    console.log($(this).val());
                                }
                            });
                        }
                    } else if(data.error = "success"){
                        window.location.href = base_url + 'client';
                    }
                }
            });
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
            
        });
    });
</script>