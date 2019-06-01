<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Navigation</li>

                <?php if($user->client_status[0] == '1'){?>
                <li>
                    <a href="<?= base_url();?>client">
                        <i class="fe-airplay"></i>
                        <span> Clients </span>
                    </a>
                </li>
                <?php }?>
                <?php if($user->gateway_status[0] == '1'){?>
                <li>
                    <a href="<?= base_url();?>gateway">
                        <i class="fe-airplay"></i>
                        <span> Gateways </span>
                    </a>
                </li>
                <?php }?>
                <?php if($user->rule_status[0] == '1'){?>
                <li>
                    <a href="<?= base_url();?>rule">
                        <i class="fe-airplay"></i>
                        <span> Rules </span>
                    </a>
                </li>
                <?php }?>
                <?php if($user->cl_status[0] == '1'){?>
                <li>
                    <a href="<?= base_url();?>clrate">
                        <i class="fe-airplay"></i>
                        <span> Cl Rates </span>
                    </a>
                </li>
                <?php }?>
                <?php if($user->gw_status[0] == '1'){?>
                <li>
                    <a href="<?= base_url();?>gwrate">
                        <i class="fe-airplay"></i>
                        <span> GW Rates </span>
                    </a>
                </li>
                <?php }?>
                <?php if( $user->type == 0){?>
                <li>
                    <a href="<?= base_url();?>user">
                        <i class="fe-airplay"></i>
                        <span> Users </span>
                    </a>
                </li>
                <?php }?>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>

<div class="content-page">
    <div class="content">