<!DOCTYPE html>
<html lang="en" <?php if ($this->db->get('settings')->row()->language == 'arabic') { ?> dir="rtl" <?php } ?>>
    <head>
        <base href="<?php echo base_url(); ?>">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Delroy Rowe">
        <meta name="keyword" content="ispecs, eyecare, eye Management">
        <link rel="shortcut icon" href="https://res.cloudinary.com/dabqwwyv2/image/upload/v1751836253/Isepcs/faviconV2_ewevrn.png">
        <title><?php /* echo $this->router->fetch_class(); */ ?> EMR | <?php echo $this->db->get('settings')->row()->system_vendor; ?> </title>
        <!-- Bootstrap core CSS -->
        <link href="common/css/bootstrap.min.css" rel="stylesheet">
        <link href="common/css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link href="common/assets/fontawesome5pro/css/all.min.css" rel="stylesheet" />
        <link href="common/assets/DataTables/datatables.min.css" rel="stylesheet" />
        <!-- <link href="common/assets/font-awesome/css/font-awesome.css" rel="stylesheet" /> -->
        <!-- Custom styles for this template -->
        <link href="common/css/style.css" rel="stylesheet">
		
		 <!-- Custom styles for the chat template -->
        <link href="common/css/chat_css.css" rel="stylesheet">
		 <!-- Custom styles for the chat template -->
		 
        <link href="common/css/style-responsive.css" rel="stylesheet" />
        <link rel="stylesheet" href="common/assets/bootstrap-datepicker/css/datepicker.css" />
        <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
        <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-datetimepicker/css/datetimepicker.css" />
        <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-timepicker/compiled/timepicker.css">
        <link rel="stylesheet" type="text/css" href="common/assets/jquery-multi-select/css/multi-select.css" />
        <link href="common/css/invoice-print.css" rel="stylesheet" media="print">
        <link href="common/assets/fullcalendar/fullcalendar.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="common/assets/select2/css/select2.min.css"/>
        <link rel="stylesheet" type="text/css" href="common/css/lightbox.css"/>
        <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-fileupload/bootstrap-fileupload.css" />
        <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
        <link rel="stylesheet" type="text/css" href="common/css/selectize.bootstrap3.min.css" /> 
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />

        <!-- Google Fonts -->

        <style>
            @import url('https://fonts.googleapis.com/css?family=Ubuntu&display=swap');
        </style>





        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->


        <?php if ($this->db->get('settings')->row()->language == 'arabic') { ?>
            <style>

                #main-content {
                    margin-right: 211px;
                    margin-left: 0px; 
                }

                body {
                    background: #f1f1f1;

                }

            </style>
            
<!-- CSS to align with Font Awesome icons -->
<style>
  /* Base styling for icon container */
  .i-specs-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 1em;
    text-align: center;
    font-style: normal;
    position: relative;
    vertical-align: -.125em; /* This matches Font Awesome's vertical alignment */
  }
  
  /* SVG styling to match Font Awesome */
  .i-specs-icon svg {
    height: 1em;
    width: 1em;
    display: inline-block;
    fill: currentColor;
  }
  
  /* Ensures consistent width with other Font Awesome icons */
  .i-specs-icon {
    width: 1.25em; /* Font Awesome's typical width */
    text-align: center;
  }
  
  /* If your sidebar has specific styling for icons, make sure to match it */
  .nav-link .i-specs-icon {
    margin-right: 0.5rem; /* Match the spacing of other Font Awesome icons */
    font-size: inherit; /* Inherit font size from parent */
  }
</style>

        <?php } ?>

    </head>

    <body>
        <section id="container" class="">
            <!--header start-->
            <header style="height: 40px;" class="header white-bg">
                <div class="sidebar-toggle-box">
                 <!--   <div data-original-title="Toggle Navigation" data-placement="right" class="fa fa-dedent fa-bars tooltips"></div> -->
                    <div data-original-title="Toggle Navigation" data-placement="right" class="fa fa-dedent fa-bars fa-angle-double-left tooltips"></div>
                </div>
                <!--logo start-->
                <?php
                $settings_title = $this->db->get('settings')->row()->title;
                $settings_title = explode(' ', $settings_title);
                ?>
                <a href="home" class="logo">
                    <strong>
                        <?php echo $settings_title[0]; ?>
                        <span>
                            <?php
                            if (!empty($settings_title[1])) {
                                echo $settings_title[1];
                            }
                            ?>
                        </span>
                    </strong>
                </a>
                <!--logo end-->
                <div class="nav notify-row" id="top_menu">
                    <!--  notification start -->
                    <ul class="nav top-menu">
                        <!-- Bed Notification start -->
                        <?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Nurse'))) { ?> 
                         <!--   <li class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="fa fa-procedures"></i>
                                    <span class="badge bg-success">  



                                        <?php /*
                                        $query = $this->db->get('bed')->result();
                                        $available_bed = 0;
                                        foreach ($query as $bed) {
                                            $last_a_time = explode('-', $bed->last_a_time);
                                            $last_d_time = explode('-', $bed->last_d_time);
                                            if (!empty($last_d_time[1])) {
                                                $last_d_h_am_pm = explode(' ', $last_d_time[1]);
                                                $last_d_h = explode(':', $last_d_h_am_pm[1]);
                                                if ($last_d_h_am_pm[2] == 'AM') {
                                                    $last_d_m = ($last_d_h[0] * 60 * 60) + ($last_d_h[1] * 60);
                                                } else {
                                                    $last_d_m = (12 * 60 * 60) + ($last_d_h[0] * 60 * 60) + ($last_d_h[1] * 60);
                                                }
                                                $last_d_time_s = strtotime($last_d_time[0]) + $last_d_m;
                                                if (time() > $last_d_time_s) {
                                                    $available_bed = $available_bed + 1;
                                                }
                                            } else {
                                                $available_bed = $available_bed + 1;
                                            }
                                        }
                                        echo $available_bed;
                                       */ ?>

                                    </span>
                                </a>
                                <ul class="dropdown-menu extended tasks-bar">
                                    <div class="notify-arrow notify-arrow-green"></div>
                                    <li>
                                        <p class="green">
                                            <?php
                                            if (!empty($query)) {
                                                echo $available_bed;
                                            } else {
                                                $available_bed = 0;
                                                echo $available_bed;
                                            }
                                            ?> 
                                            <?php
                                            if ($available_bed <= 1) {
                                                echo lang('bed_is_available');
                                            } else {
                                                echo lang('beds_are_available');
                                            }
                                            ?>
                                        </p>
                                    </li>
                                    <?php ?>
                                    <li class="external">
                                        <a href="bed/bedAllotment"><p class="green"><?php
                                                if ($available_bed > 0) {
                                                    echo lang('add_a_allotment');
                                                } else {
                                                    echo lang('no_bed_is_available_for_allotment');
                                                }
                                                ?></p></a>
                                    </li>
                                </ul>
                            </li> -->
                        <?php } ?>
                        <!-- Bed notification end -->
                        <!-- Payment notification start-->
                        <?php if ($this->ion_auth->in_group(array('admin', 'Doctor','Receptionist'))) { ?> 
                            <li id="header_inbox_bar" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i style="font-size:16px;" class="fa fa-money-check"></i>
                                    <span class="badge bg-important"> 
                                        <?php
                                        $query = $this->db->get('payment');
                                        $query = $query->result();
                                        foreach ($query as $payment) {
                                            $payment_date = date('y/m/d', $payment->date);
                                            if ($payment_date == date('y/m/d')) {
                                                $payment_number[] = '1';
                                            }
                                        }
                                        if (!empty($payment_number)) {
                                            echo $payment_number = array_sum($payment_number);
                                        } else {
                                            $payment_number = 0;
                                            echo $payment_number;
                                        }
                                        ?>        
                                    </span>
                                </a>
                                <ul class="dropdown-menu extended inbox">
                                    <div class="notify-arrow notify-arrow-red"></div>
                                    <li>
                                        <p class="red"> <?php
                                            echo $payment_number . ' ';
                                            if ($payment_number <= 1) {
                                                echo lang('payment_today');
                                            } else {
                                                echo lang('payments_today');
                                            }
                                            ?></p>
                                    </li>
                                    <li>
                                        <a href="finance/payment"><p class="green"> <?php echo lang('see_all_payments'); ?></p></a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>  
                        
                                     
              <!-- Notice notification start -->
<?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Receptionist'))) { ?> 
    <li id="header_notice_bar" class="dropdown">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <b style="font-size:19px; color:red;">Notices</b> <i style="font-size:16px;" class="fa fa-bell"></i> <!-- Using a bell icon for notices -->
            <span class="badge bg-important"> 
                <?php
                $query = $this->db->get('notice');
                $query = $query->result();
                $notice_number = []; // Initialize array to count notices
                foreach ($query as $notice) {
                    $notice_date = date('y/m/d', $notice->date); // Assuming 'date' is the timestamp column in notice table
                    if ($notice_date == date('y/m/d')) {
                        $notice_number[] = '1';
                    }
                }
                if (!empty($notice_number)) {
                    echo $notice_number = array_sum($notice_number);
                } else {
                    $notice_number = 0;
                    echo $notice_number;
                }
                ?>        
            </span>
        </a>
        <ul class="dropdown-menu extended inbox">
            <div class="notify-arrow notify-arrow-yellow"></div> <!-- Changed color to yellow for distinction -->
            <li>
                <p class="yellow"> <?php
                    echo $notice_number . ' ';
                    if ($notice_number <= 1) {
                        echo lang('notice_today'); // Define 'notice_today' in language file as "Notice Today"
                    } else {
                        echo lang('notices_today'); // Define 'notices_today' in language file as "Notices Today"
                    }
                    ?></p>
            </li>
            <li>
                <a href="notice"><p class="green"> <?php echo lang('see_all_notices'); ?></p></a> <!-- Assuming 'notice' is the controller route -->
            </li>
        </ul>
    </li>
<?php } ?>   
<!-- Notice notification end --> 
                        
						<!-- point of sale notification -->	
						
<!-- START OF POINT OF SALE HIDDEN -- >

						<?php if ($this->ion_auth->in_group(array('admin', 'Doctor','Receptionist'))) { ?> 
						
						<li id="header_inbox_bar" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <blink><font color="red">P.O.S</font></blink>
                                </a>
                                <ul class="dropdown-menu extended inbox">
                                    <div class="notify-arrow notify-arrow-red"></div>
									<li><a  href="finance/pharmacy/sellNow"><i class="fa fa-plus-circle"></i><?php echo 'Payment for Services'; ?></a></li>

                                </ul>
                        </li>
                        <?php } ?>
                        
 <!-- END OF POINT OF SALE HIDDEN -->                       
                        <!-- payment notification end -->  
                        <!-- patient notification start-->
                        <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Doctor', 'Nurse', 'Receptionist'))) { ?> 
                            <li id="header_notification_bar" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i style="font-size:16px;" class="fa fa-user"></i>
                                    <span class="badge bg-warning">   
                                        <?php
                                        $this->db->where('add_date', date('m/d/y'));
                                        $query = $this->db->get('patient');
                                        $query = $query->result();
                                        foreach ($query as $patient) {
                                            $patient_number[] = '1';
                                        }
                                        if (!empty($patient_number)) {
                                            echo $patient_number = array_sum($patient_number);
                                        } else {
                                            $patient_number = 0;
                                            echo $patient_number;
                                        }
                                        ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu extended notification">
                                    <div class="notify-arrow notify-arrow-yellow"></div>
                                    <li>
                                        <p class="yellow"><?php
                                            echo $patient_number . ' ';
                                            if ($patient_number <= 1) {
                                                echo lang('patient_registerred_today');
                                            } else {
                                                echo lang('patients_registerred_today');
                                            }
                                            ?> </p>
                                    </li>    
                                    <li>
                                        <a href="patient"><p class="green"><?php echo lang('see_all_patients'); ?></p></a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                        <!-- patient notification end -->  
                        <!-- donor notification start-->
                        <?php /* if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Nurse', 'Laboratorist', 'Patient'))) { ?> 
                            <li id="header_notification_bar" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="fa fa-user"></i>
                                    <span class="badge bg-success">       
                                        <?php
                                        $this->db->where('add_date', date('m/d/y'));
                                        $query = $this->db->get('donor');
                                        $query = $query->result();
                                        foreach ($query as $donor) {
                                            $donor_number[] = '1';
                                        }
                                        if (!empty($donor_number)) {
                                            echo $donor_number = array_sum($donor_number);
                                        } else {
                                            $donor_number = 0;
                                            echo $donor_number;
                                        }
                                        ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu extended notification">
                                    <div class="notify-arrow notify-arrow-yellow"></div>
                                    <li>
                                        <p class="green"><?php
                                            echo $donor_number . ' ';
                                            if ($donor_number <= 1) {
                                                echo lang('donor_registerred_today');
                                            } else {
                                                echo lang('donors_registerred_today');
                                            }
                                            ?> </p>
                                    </li>
                                    <li>
                                        <a href="donor"><p class="green"><?php echo lang('see_all_donors'); ?></p></a>
                                    </li>
                                </ul>
                            </li>
                        <?php } */?> 
                        <!-- donor notification end -->                         
						<!-- appointment notification start-->
                        <?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Receptionist', 'Laboratorist', 'Patient'))) { ?> 
                            <li id="header_notification_bar" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i style="font-size:16px;" class="fa fa-users"></i>
                                    <span class="badge bg-success">       
                                        <?php
                                        $this->db->where('add_date', date('m/d/y'));
                                        $query = $this->db->get('appointment');
                                        $query = $query->result();
                                        foreach ($query as $appointmented) {
                                            $appointmented_number[] = '1';
                                        }
                                        if (!empty($appointmented_number)) {
                                            echo $appointmented_number = array_sum($appointmented_number);
                                        } else {
                                            $appointmented_number = 0;
                                            echo $appointmented_number;
                                        }
                                        ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu extended notification">
                                    <div class="notify-arrow notify-arrow-yellow"></div>
                                    <li>
                                        <p class="green"><?php
                                            echo $appointmented_number . ' ';
                                            if ($appointmented_number <= 1) {
                                                echo 'Appointments for today';//lang('donor_registerred_today');
                                            } else {
                                                echo 'Appointments for today';//lang('donors_registerred_today');
                                            }
                                            ?> </p>
                                    </li>
                                    <li>
                                        <a href="appointment"><p class="green"><?php echo 'See All Appointments';//lang('see_all_donors'); ?></p></a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?> 
                        <!-- appointment notification end -->  
                        <!-- medicine notification start-->
                        <?php if ($this->ion_auth->in_group(array('admin', 'Pharmacist', 'Doctor','Receptionist','Nurse'))) { ?> 
                            <li id="header_notification_bar" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i style="font-size:16px;" class="fa fa-medkit"></i>
                                    <span class="badge bg-success">                          
                                        <?php
                                        $this->db->where('add_date', date('m/d/y'));
                                        $query = $this->db->get('medicine');
                                        $query = $query->result();
                                        foreach ($query as $medicine) {
                                            $medicine_number[] = '1';
                                        }
                                        if (!empty($medicine_number)) {
                                            echo $medicine_number = array_sum($medicine_number);
                                        } else {
                                            $medicine_number = 0;
                                            echo $medicine_number;
                                        }
                                        ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu extended notification">
                                    <div class="notify-arrow notify-arrow-yellow"></div>
                                    <li>
                                        <p class="yellow"><?php
                                            echo $medicine_number . ' ';
                                            if ($medicine_number <= 1) {
                                                echo lang('medicine_registerred_today');
                                            } else {
                                                echo lang('medicines_registered_today');
                                            }
                                            ?> </p>
                                    </li>
                                    <li>
                                        <a href="medicine"><p class="green"><?php echo lang('see_all_medicines'); ?></p></a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?> 
                        <!-- medicine notification end -->                         
					<!-- COUNTING LOW STOCK FROM TWO LOCATIONS -->
<!-- Glass Frame low stock — MONTEGO BAY -->
<?php if ($this->ion_auth->in_group(array('admin','Pharmacist','Doctor','Receptionist','Nurse'))) { ?> 
    <li class="dropdown" id="header_notification_bar_mobay">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <i style="font-size:16px;" class="fas fa-vial"></i>
            <span class="badge bg-success">
                <?php
                    $qt_mb = 2;

                    // Count low-stock frames in Montego Bay: treat NULL/'' as 0
                    $this->db->from('medicine');
                    $this->db->where('type', 'frames');
                    $this->db->where('location', 'Montego Bay');
                    $this->db->where("COALESCE(NULLIF(quantity,''), 0) <= {$qt_mb}", NULL, FALSE);
                    $medicine_number1 = (int) $this->db->count_all_results();
                    //echo $medicine_number1;

                    $this->db->reset_query();

                    // Total quantity in Montego Bay (sum, empty/NULL -> 0)
                    $this->db->select("IFNULL(SUM(COALESCE(NULLIF(quantity,''),0)),0) AS total_qty", FALSE);
                    $this->db->from('medicine');
                    $this->db->where('type', 'frames');
                    $this->db->where('location', 'Montego Bay');
                    $row_mb = $this->db->get()->row();
                    $total_mb = (int) ($row_mb->total_qty ?? 0);
                    echo $total_mb;
                    
                    $_mb_total_null = $total_mb;
                ?>
            </span>
        </a>
        <ul class="dropdown-menu extended notification">
            <div class="notify-arrow notify-arrow-yellow"></div>
            <li>
                <font color="red"><b>
                    <!--
                    <p class="yellow">
                        <?php
                            echo $medicine_number1 . ' ';
                            echo ($medicine_number1 <= 1) ? 'Mobay Frame Below 1 ' : 'Mobay Frames Below 2 ';
                        ?>
                    </p>
                    -->
                    <p class="blue">
                        (<?php echo "<font color='red'>{$_mb_total_null}</font>"; ?>) Total Frame Qty in Mobay Inventory
                    </p>
                </b></font>
            </li>
            <li>
                <a href="medicine"><p class="green"><?php echo lang('see_all_medicines'); ?></p></a>
            </li>
        </ul>
    </li>
<?php } ?> 

<!-- Glass Frame low stock — FALMOUTH -->
<?php if ($this->ion_auth->in_group(array('admin','Pharmacist','Doctor','Receptionist','Nurse'))) { ?> 
    <li class="dropdown" id="header_notification_bar_falmouth">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <i style="font-size:16px;" class="fas fa-vial"></i>
            <span class="badge bg-success">
                <?php
                    $qt_fm = 2;

                    // Count low-stock frames in Falmouth: treat NULL/'' as 0
                    $this->db->from('medicine');
                    $this->db->where('type', 'frames');
                    $this->db->where('location_2', 'Falmouth');
                    $this->db->where("COALESCE(NULLIF(quantity_2,''), 0) <= {$qt_fm}", NULL, FALSE);
                    $medicine_number2 = (int) $this->db->count_all_results();
                    //echo $medicine_number2;

                    $this->db->reset_query();

                    // Total quantity in Falmouth (sum, empty/NULL -> 0)
                    $this->db->select("IFNULL(SUM(COALESCE(NULLIF(quantity_2,''),0)),0) AS total_qty", FALSE);
                    $this->db->from('medicine');
                    $this->db->where('type', 'frames');
                    $this->db->where('location_2', 'Falmouth');
                    $row_fm = $this->db->get()->row();
                    $total_fm = (int) ($row_fm->total_qty ?? 0);
                    
                    echo $total_fm;
                ?>
            </span>
        </a>
        <ul class="dropdown-menu extended notification">
            <div class="notify-arrow notify-arrow-yellow"></div>
            <li>
                <font color="red"><b>
                    <!--
                    <p class="yellow">
                        <?php
                            echo $medicine_number2 . ' ';
                            echo ($medicine_number2 <= 1) ? 'Falmouth Frames Below 1 QTY ' : 'Falmouth Frames Below 2 QTY ';
                        ?>
                    </p>
                    -->
                    <p class="blue">
                        (<?php echo "<font color='red'>{$total_fm}</font>"; ?>) Total Frame Qty in Falmouth Inventory
                    </p>
                </b></font>
            </li>
            <li>
                <a href="medicine"><p class="green"><?php echo lang('see_all_medicines'); ?></p></a>
            </li>
        </ul>
    </li>
<?php } ?> 

					
					
                        <!-- Falmouth Glass Frame notification end -->  
                        <!-- report notification start-->
                        <?php if ($this->ion_auth->in_group(array('admin', 'Doctor'))) { ?> 
                            <li id="header_notification_bar" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i style="font-size:16px;" class="fa fa-notes-medical"></i>
                                    <span class="badge bg-success">                         
                                        <?php
                                        $this->db->where('add_date', date('m/d/y'));
                                        $query = $this->db->get('report');
                                        $query = $query->result();
                                        foreach ($query as $report) {
                                            $report_number[] = '1';
                                        }
                                        if (!empty($report_number)) {
                                            echo $report_number = array_sum($report_number);
                                        } else {
                                            $report_number = 0;
                                            echo $report_number;
                                        }
                                        ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu extended notification">
                                    <div class="notify-arrow notify-arrow-yellow"></div>
                                    <li>
                                        <p class="yellow"><?php
                                            echo $report_number . ' ';
                                            if ($report_number <= 1) {
                                                echo lang('report_added_today');
                                            } else {
                                                echo lang('reports_added_today');
                                            }
                                            ?> </p>
                                    </li>
                                    <li>
                                        <a href="report"><p class="green"><?php echo lang('see_all_reports'); ?></p></a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if ($this->ion_auth->in_group('Patient')) { ?> 
                            <li id="header_notification_bar" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i style="font-size:16px;" class="fa fa-notes-medical"></i>
                                    <span class="badge bg-success">                         
                                        <?php
                                        $query = $this->db->get('report');
                                        $query = $query->result();
                                        foreach ($query as $report) {
                                            if ($this->ion_auth->user()->row()->id == explode('*', $report->patient)[1]) {
                                                $report_number[] = '1';
                                            }
                                        }
                                        if (!empty($report_number)) {
                                            echo $report_number = array_sum($report_number);
                                        } else {
                                            $report_number = 0;
                                            echo $report_number;
                                        }
                                        ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu extended notification">
                                    <div class="notify-arrow notify-arrow-yellow"></div>
                                    <li>
                                        <p class="yellow"><?php
                                            echo $report_number . ' ';
                                            if ($report_number <= 1) {
                                                echo lang('report_is_available_for_you');
                                            } else {
                                                echo lang('reports_are_available_for_you');
                                            }
                                            ?> </p>
                                    </li>
                                    <li>
                                        <a href="report/myreports"><p class="green"><?php echo lang('see_your_reports'); ?></p></a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                        <!-- report notification end -->
                    </ul>
                </div>

                        <!-- chat notification start -->  
			 <div class="top-nav ">
                	<li id="header_notification_bar" class="dropdown">
                		<a href="chat">
          					<i style="font-size:16px;" class="far fa-comments"></i>
          					<span  class="badge badge-info">
          						<?php
        
        $user_id = $this->ion_auth->get_user_id();
                              
        $this->db->select('*');
		$this->db->from('chat');
		$this->db->where('receiver_id =', $user_id);
		$query = $this->db->get();
	//	echo @$this->db->count_all_results();//return $query->result();
		echo $query->num_rows();
                                 
                              //   echo $this->db->count_all('cart');       
                               ?>
          					</span>
          				</a>
        			</li>
        		</div> 						
                        <!-- chat notification end-->
                       
					   <!-- cart notification start-->

                <div class="top-nav ">
					<ul class="nav pull-right top-menu">
						<li id="header_notification_bar" class="dropdown">
						 <!--	<a href="finance/pharmacy/shoppingCartSingleView"> -->
							<a href="finance/pharmacy/shoppingCartView">
								<i style="font-size:16px;" class="fas fa-shopping-cart"></i>
									<span  class="badge bg-danger">
          						<?php
        
        $user_id = $this->ion_auth->get_user_id();
                              
        $this->db->select('*');
		$this->db->from('cart');
		$this->db->where('user_id =', $user_id);
		$query = $this->db->get();
	//	echo @$this->db->count_all_results();//return $query->result();
		echo $query->num_rows();
                                 
                              //   echo $this->db->count_all('cart');       
                               ?>
          					</span>
							</a>
						</li>
					</ul>				
				</div>
               
<!-- cart notification end-->

                <div class="top-nav ">

                    <ul class="nav pull-right top-menu">
                        <!-- user login dropdown start-->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <img alt="" src="https://res.cloudinary.com/dabqwwyv2/image/upload/v1751836253/Isepcs/faviconV2_ewevrn.png" width="21" height="23">
                                <span class="username">
								<?php echo lang('welcome'); ?>, 
								<?php echo $this->ion_auth->user()->row()->username; ?></span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu extended logout">
                                <div class="log-arrow-up"></div>
                                <?php if (!$this->ion_auth->in_group('admin')) { ?> 
                                    <li><a href=""><i class="fa fa-dashboard"></i> <?php echo lang('dashboard'); ?></a></li>
                                <?php } ?>
                                <li><a href="profile"><i class=" fa fa-suitcase"></i><?php echo lang('profile'); ?></a></li>
                                <?php if ($this->ion_auth->in_group('admin')) { ?> 
                                    <li><a href="settings"><i class="fa fa-cog"></i> <?php echo lang('settings'); ?></a></li>
                                <?php } ?>

                                <li><a><i class="fa fa-user"></i> <?php echo $this->ion_auth->get_users_groups()->row()->name ?></a></li>
                                <li><a href="auth/logout"><i class="fa fa-key"></i> <?php echo lang('log_out'); ?></a></li>
                            </ul>
                        </li>
                        <!-- user login dropdown end -->
                    </ul>
                    <?php
                    $message = $this->session->flashdata('feedback');
                    if (!empty($message)) {
                        ?>
                        <code class="flashmessage pull-right"> <?php echo $message; ?></code>
                    <?php } ?> 
                </div>
            </header>
            <!--header end-->
            <!--sidebar start-->

            <!--sidebar start-->
            <aside>
                <div id="sidebar"  class="nav-collapse">
                    <!-- sidebar menu start-->
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a href="home"> 
                                <i class="fa fa-home"></i>
                                <span><?php echo lang('dashboard'); ?></span>
                            </a>
                        </li>
					 <?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Nurse', 'Receptionist'))) { ?>		
 
 <!-- START OF POINT OF SALE HIDDEN -- >
 <li><a  href="finance/pharmacy/sellNow"><i class="fa fa-edit"></i><?php echo '<b>Point of Sale</b>'; ?> </a></li>
                       <!--     <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-money-check"></i>
                                    <span><font color="yellow"><?php echo 'Point of Sale';//lang('financial_activities'); ?></font></span>
                                </a>
                                <ul class="sub">
                                  <!--  <li><a  href="finance/addPaymentView"><i class="fa fa-plus-circle"></i><?php echo 'Services'; ?></a></li>--/>
                                    <li><a  href="finance/pharmacy/addPaymentView"><i class="fa fa-edit"></i><?php echo 'Frames'; ?> </a></li>


                                </ul>
                            </li>   
<!-- END OF POINT OF SALE HIDDEN -->
                          
						<!--	<li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-money-check"></i>
                                    <span><?php echo 'Sales & Services';//lang('financial_activities'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a  href="finance/payment"><i class="fa fa-money-check"></i> <?php echo 'All Payments';//lang('payments'); ?></a></li>
                                    <li><a  href="finance/addPaymentView"><i class="fa fa-plus-circle"></i><?php echo 'Collect Payment P.O.S'; //lang('add_payment'); ?></a></li>
                                    <li><a  href="finance/paymentCategory"><i class="fa fa-edit"></i><?php echo 'All Services Offered';//lang('payment_procedures'); ?></a></li>
                                    <li><a  href="finance/expense"><i class="fa fa-money-check"></i><?php echo lang('expense'); ?></a></li>
                                    <li><a  href="finance/addExpenseView"><i class="fa fa-plus-circle"></i><?php echo lang('add_expense'); ?></a></li>
                                    <li><a  href="finance/expenseCategory"><i class="fa fa-edit"></i><?php echo lang('expense_categories'); ?> </a></li>
							<?php if ($this->ion_auth->in_group(array('admin', 'Laboratorist', 'Doctor'))) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fas fa-file-medical-alt"></i>
                                    <span><?php echo lang('report'); ?></span>
                                </a>
                                <ul class="sub">
                                    <?php if ($this->ion_auth->in_group(array('admin', 'Doctor'))) { ?>
                                        <li><a  href="finance/financialReport"><i class="fa fa-book"></i><?php echo lang('financial_report'); ?></a></li>
                                        <li> <a href="finance/AllUserActivityReport">  <i class="fa fa-home"></i>   
										<span><?php echo 'User Activity'; ?></span> </a></li>
                                    <?php } ?>

                                    <?php if ($this->ion_auth->in_group(array('admin', 'Doctor'))) { ?>
                                        <li><a  href="finance/doctorsCommission"><i class="fa fa-edit"></i><?php echo lang('doctors_commission'); ?> </a></li>
                                        <li><a  href="finance/monthly"><i class="fa fa-chart-bar"></i> <?php echo lang('monthly_sales'); ?> </a></li>
                                        <li><a  href="finance/daily"><i class="fa fa-chart-bar"></i> <?php echo lang('daily_sales'); ?> </a></li>
                                        <li><a  href="finance/monthlyExpense"><i class="fa fa-chart-area"></i> <?php echo lang('monthly_expense'); ?> </a></li>
                                        <li><a  href="finance/dailyExpense"><i class="fa fa-chart-area"></i> <?php echo lang('daily_expense'); ?> </a></li>                              



                                    <?php } ?>

                                    <li><a  href="report/birth"><i class="fas fa-file-medical"></i><?php echo lang('birth_report'); ?></a></li>
                                    <li><a  href="report/operation"><i class="fa fa-wheelchair"></i><?php echo lang('operation_report'); ?></a></li>
                                    <li><a  href="report/expire"><i class="fas fa-file-medical"></i><?php echo lang('expire_report'); ?></a></li>

                                </ul>
                            </li>
                        <?php } ?>

                                </ul>
								
                            </li> 
							-->					
					 <?php } ?>
					 
                        <?php if ($this->ion_auth->in_group(array('admin', 'Receptionist','Doctor'))) { ?>


                            <li class="sub-menu">
							
						
							
							
							
                                <a href="javascript:;" >
                                    <i class="fas fa-glasses"></i>
                                    <span><?php echo 'Frames & Services';//lang('all_frames'); ?></span>
                                </a>
                                <ul class="sub">
								<?php if ($this->ion_auth->in_group(array('admin','Doctor'))) { ?>
                                        <li><a  href="finance/pharmacy/home"><i class="fa fa-home"></i> <?php echo lang('dashboard'); ?></a></li>
                                    <?php } ?>
								<li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa  fa-medkit"></i>
                                    <span><?php echo 'Inventory';//lang('medicine'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a  href="medicine"><i class="fa fa-medkit"></i><?php echo 'All Frames List'; ?></a></li>
                                    <!--<li><a  href="medicine/frameList"><i class="fa fa-medkit"></i><?php  echo 'Frames List'; ?></a></li>-->
                                    	<?php if ($this->ion_auth->in_group(array('admin','Doctor'))) { ?>
                                    <li><a  href="medicine/addServiceView"><i class="fa fa-medkit"></i><?php echo 'All Services List'; ?></a></li>
									 <li><a  href="medicine/medicineCategory"><i class="fa fa-edit"></i><?php echo 'Category List'; ?></a></li>
									 <?php } ?>
									  <?php if ($this->ion_auth->in_group(array('admin','Doctor'))) { ?> 
                                 <!--   <li><a  href="medicine/addMedicineView"><i class="fa fa-plus-circle"></i><?php echo 'Add Frames'; ?></a></li>
                                    <li><a  href="medicine/addServiceView"><i class="fa fa-plus-circle"></i><?php echo 'Add Services'; ?></a></li>-->
									<li><a  href="medicine/addCategoryView"><i class="fa fa-plus-circle"></i><?php echo 'Add Category'; ?></a></li>
                                    <li><a  href="medicine/medicineStockAlert"><i class="fa fa-plus-circle"></i><?php echo 'Qty. Adjustment'; ?></a></li>
									<li><a  href="medicine/addFrameTypeView"><i class="fa fa-plus-circle"></i><?php echo 'Frame Type Category'; ?></a></li>                   
									<li><a  href="medicine/addFrameTypeItemsView"><i class="fa fa-plus-circle"></i><?php echo 'Frame Category Items'; ?></a></li>
									  <?php } ?>
                                   
                                    
                                </ul>
                            </li>
							<li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-medkit"></i>
                                    <span><?php echo 'Frame History';//lang('medicine'); ?></span>
                                </a>
                                <ul class="sub">				
                                    <li><a  href="finance/pharmacy/payment"><i class="fa fa-money-check"></i> <?php echo 'Sale History'; ?></a></li>
 									<li><a  href="medicine/history"><i class="fa fa-money-check"></i> <?php echo 'Transfer History'; ?></a></li>
								</ul>
							</li>
 <!-- START OF FRAME SALE HIDDEN --
                                    <li><a  href="finance/pharmacy/addPaymentView"><i class="fa fa-plus-circle"></i><?php echo 'Frame P.O.S'; ?></a></li>
 <!-- END OF FRAME SALE HIDDEN -->                                   
                            <!--
                             <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-medkit"></i>
                                    <span><?php echo 'Frame Expensess';//lang('medicine'); ?></span>
                                </a>
                                <ul class="sub">       	
									<li><a  href="finance/pharmacy/expense"><i class="fa fa-money-check"></i><?php echo 'Frame Expensess'; ?></a></li>
                                    <li><a  href="finance/pharmacy/addExpenseView"><i class="fa fa-plus-circle"></i><?php echo lang('add_expense'); ?></a></li>
                                    <li><a  href="finance/pharmacy/expenseCategory"><i class="fa fa-edit"></i><?php echo lang('expense_categories'); ?> </a></li>
								</ul>
							</li>
							-->

                                    <?php if ($this->ion_auth->in_group(array('admin', 'Doctor'))) { ?>
                                        <li class="sub-menu">
                                            <a href="javascript:;" >
                                                <i class="fas fa-file-medical-alt"></i>
                                                <span><?php echo lang(''); ?> <?php echo 'Glass Frame Reports';//lang('report'); ?></span>
                                            </a>
                                            <ul class="sub">
                                                <li><a  href="finance/pharmacy/financialReport"><i class="fa fa-book"></i><?php echo lang('all_frames'); ?> <?php echo lang('report'); ?> </a></li>
                                                <li><a  href="finance/pharmacy/monthly"><i class="fa fa-chart-bar"></i> <?php echo lang('monthly_sales'); ?> </a></li>
                                                <li><a  href="finance/pharmacy/daily"><i class="fa fa-chart-bar"></i> <?php echo lang('daily_sales'); ?> </a></li>
                                                <li><a  href="finance/pharmacy/monthlyExpense"><i class="fa fa-chart-area"></i> <?php echo lang('monthly_expense'); ?> </a></li>
                                                <li><a  href="finance/pharmacy/dailyExpense"><i class="fa fa-chart-area"></i> <?php echo lang('daily_expense'); ?> </a></li>                              
                                            </ul>
                                        </li> 
                                    <?php } ?>



                                </ul>
                            </li> 
                        <?php } ?>					 

                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <!--<li>-->
                            <!--    <a href="department">-->
                            <!--        <i class="fa fa-sitemap"></i>-->
                            <!--        <span><?php echo lang('departments'); ?></span>-->
                            <!--    </a>-->
                            <!--</li>-->
                        <?php } ?>
                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-user-md"></i>
                                    <span><?php echo lang('doctor'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a href="doctor"><i class="fa fa-user"></i><?php echo lang('list_of_doctors'); ?></a></li>
                                    <li><a href="appointment/treatmentReport"><i class="fa fa-history"></i><?php echo lang('treatment_history'); ?></a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Nurse', 'Doctor', 'Laboratorist', 'Receptionist'))) { ?>

                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-users"></i> 
                                    <span><?php echo lang('patient'); ?></span>
                                </a>
                                <ul class="sub"> 
                                    <li><a href="patient"><i class="fa fa-user"></i><?php echo lang('patient_list'); ?></a></li>

                                     <?php if ($this->ion_auth->in_group(array('admin', 'Doctor'))) { ?>
                                    <li><a href="patient/patientReport"><i class="fa fa-user"></i>Patient Report</a></li>
                                      <?php } ?>

                                    <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Doctor', 'Receptionist'))) { ?>
                                        <li><a href="patient/patientPayments"><i class="fa fa-money-check"></i><?php echo lang('payments'); ?></a></li>
                                    <?php } ?>
                                    <?php if (!$this->ion_auth->in_group(array('Accountant', 'Receptionist'))) { ?>
                                        <!-- <li><a href="patient/caseList"><i class="fa fa-book"></i><?php echo lang('case'); ?> <?php echo lang('manager'); ?></a></li> -->
                                        <!--<li><a href="patient/documents"><i class="fa fa-file"></i><?php echo lang('documents'); ?></a></li>-->
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>


                        <?php if ($this->ion_auth->in_group(array('Nurse', 'Receptionist'))) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-clock"></i> 
                                    <span><?php echo lang('schedule'); ?></span>
                                </a>
                                <ul class="sub"> 
                                    <li><a href="schedule"><i class="fa fa-list-alt"></i><?php echo lang('all'); ?> <?php echo lang('schedule'); ?></a></li>
                                    <li><a href="schedule/allHolidays"><i class="fa fa-list-alt"></i><?php echo lang('holidays'); ?></a></li> 
                                </ul>
                            </li>
                        <?php } ?>

                        <?php
                        if ($this->ion_auth->in_group(array('admin','Doctor'))) {
                            ?>
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-clock"></i> 
                                    <span><?php echo lang('schedule'); ?></span>
                                </a>
                                <ul class="sub"> 
                                    <li><a href="schedule/index"><i class="fa fa-list-alt"></i><?php echo lang('all'); ?> <?php echo lang('schedule'); ?></a></li>
                                    <li><a href="schedule/holidays"><i class="fa fa-list-alt"></i><?php echo lang('holidays'); ?></a></li> 
                                 <li><a href="appointment/treatmentReport"><i class="fa fa-history"></i><?php echo lang('treatment_history'); ?></a></li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Nurse', 'Receptionist'))) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-calendar-check"></i> 
                                    <span><?php echo lang('appointment'); ?></span>
                                </a>
                                <ul class="sub"> 
                                    <li><a href="appointment"><i class="fa fa-list-alt"></i><?php echo lang('all'); ?></a></li>
                                    <li><a href="appointment?add=new"><i class="fa fa-plus-circle"></i><?php echo lang('add'); ?></a></li>
                                     <li><a href="appointment/website"><i class="fa fa-globe"></i>Website Bookings</a></li>
                                    <li><a href="appointment/todays"><i class="fa fa-list-alt"></i><?php echo lang('todays'); ?></a></li>
                                    <li><a href="appointment/upcoming"><i class="fa fa-list-alt"></i><?php echo lang('upcoming'); ?></a></li>
                                    <li><a href="appointment/calendar"><i class="fa fa-list-alt"></i><?php echo lang('calendar'); ?></a></li>
                                    <li><a href="appointment/request"><i class="fa fa-list-alt"></i><?php echo lang('request'); ?></a></li>
                                    <?php if ($this->ion_auth->in_group(array('admin', 'Doctor','Nurse'))) { ?>
                                        <!--<li><a href="meeting"><i class="fa fa-headphones"></i><?php echo lang('live'); ?> <?php echo lang('now'); ?></a></li>-->
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>


                        <?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Receptionist'))) { ?>
                           <!-- <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-headphones"></i> 
                                    <span><?php echo lang('live'); ?> <?php echo lang('meetings'); ?></span>
                                </a>
                                <ul class="sub"> 
                                    <?php if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                                        <li><a href="meeting/addNewView"><i class="fa fa-plus-circle"></i><?php echo lang('create'); ?> <?php echo lang('meeting'); ?></a></li>
                                    <?php } ?>
                                    <li><a href="meeting"><i class="fa fa-video"></i><?php echo lang('live'); ?> <?php echo lang('now'); ?></a></li>
                                    <li><a href="meeting/upcoming"><i class="fa fa-list-alt"></i><?php echo lang('upcoming'); ?> <?php echo lang('meetings'); ?></a></li>
                                    <li><a href="meeting/previous"><i class="fa fa-list-alt"></i><?php echo lang('previous'); ?> <?php echo lang('meetings'); ?></a></li>
									<li><a href="meeting"><i class="fa fa-headphones"></i><?php echo lang('join_live'); ?></a></li>
									<li><a href="meeting/settings"><i class="fa fa-headphones"></i><?php echo lang('zoom'); ?> <?php echo lang('settings'); ?></a></li>
								</ul>
                            </li>  -->
                        <?php } ?> 

                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-users"></i>
                                    <span><?php echo 'User Role Management';//lang('human_resources'); ?></span>
                                </a>
                                <ul class="sub">
                                    <!--<li><a href="nurse"><i class="fa fa-user"></i>Administrators</a></li>-->
                                    <!--<li><a href="nurse"><i class="fa fa-user"></i>Nurses</a></li>-->
                                    <li><a href="pharmacist"><i class="fa fa-user"></i>Supervisors</a></li>
                                    <!--<li><a href="laboratorist"><i class="fa fa-user"></i><?php echo lang('laboratorist'); ?></a></li>-->
                                    <li><a href="accountant"><i class="fa fa-user"></i><?php echo lang('accountant'); ?></a></li>
                                    <li><a href="receptionist"><i class="fa fa-user"></i><?php echo lang('receptionist'); ?></a></li>
                                </ul>
                            </li>


                        <?php } ?>

                        <?php if ($this->ion_auth->in_group('Receptionist','Nurse','Doctor')) { ?>
                            <li>
                                <a href="appointment/calendar" >
                                    <i class="fa fa-calendar"></i>
                                    <span> <?php echo lang('calendar'); ?> </span>
                                </a>
                            </li>
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-money-check"></i>
                                    <span><?php echo lang('financial_activities'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a  href="finance/payment"><i class="fa fa-money-check"></i> <?php echo lang('payments'); ?></a></li>
                                    <li><a  href="finance/addPaymentView"><i class="fa fa-plus-circle"></i><?php echo lang('add_payment'); ?></a></li>
                                </ul>
                            </li> 
                        <?php } ?>



                        <?php /*if ($this->ion_auth->in_group(array('admin', ''))) { ?>
                            <li>
                                <a href="prescription/all" >
                                    <i class="fas fa-prescription"></i>
                                    <span> <?php echo lang('refraction'); ?> </span>
                                </a>
                            </li>
                        <?php } */?>

                        <?php
                       /*  if ($this->ion_auth->in_group(array(''))) {
                            ?>
                            <li>
                                <a href="lab/lab1">
                                    <i class="fas fa-file-medical"></i>
                                    <span><?php echo lang('lab_reports'); ?></span>
                                </a>
                            </li>
                            <?php
                        }*/
                        ?>

                        <?php
                        if ($this->ion_auth->in_group(array('Admin', 'Doctor'))) {
                            ?>
                            <!--<li>
                                <a href="finance/UserActivityReport">
                                    <i class="fa fa-file-user"></i>
                                    <span><?php echo lang('user_activity_report'); ?></span>
                                </a>
                            </li>-->
                            <?php
                        }
                        ?>

                        <?php if ($this->ion_auth->in_group(array('Doctor','Receptionist'))) { ?>
                            <!--<li>-->
                            <!--    <a href="prescription">-->
                            <!--        <i class="fa fa-home"></i>-->
                            <!--        <span><?php echo lang('refraction'); ?></span>-->
                            <!--    </a>-->
                            <!--</li>-->
                        <?php } ?>



                        <?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Receptionist'))) { ?>
                            <!-- <li class="sub-menu"> -->
                                <li>
                                <a href="https://ispecsappeal.net/systems/inventory" target="_blank">
<i class="i-specs-icon">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="2em" height="2em">
      <!-- Modified viewBox to match Font Awesome's 512×512 standard -->
      <!-- Eyebrow shapes - repositioned to fit the viewBox -->
      <path d="M128 85 A70 35 0 0 0 198 85" stroke="#aeb2b7" stroke-width="18" fill="none" />
      <path d="M300 85 A70 35 0 0 0 370 85" stroke="#aeb2b7" stroke-width="18" fill="none" />
      
      <!-- Bridge of glasses -->
      <rect x="198" y="180" width="102" height="30" fill="#aeb2b7" />
      
      <!-- Left lens -->
      <circle cx="145" cy="195" r="70" stroke="#aeb2b7" stroke-width="18" fill="none" />
      <circle cx="145" cy="195" r="52" fill="#aeb2b7" fill-opacity="0.3" />
      <text x="145" y="210" font-family="Arial" font-size="55" text-anchor="middle" fill="#aeb2b7">L</text>
      
      <!-- Right lens -->
      <circle cx="355" cy="195" r="70" stroke="#aeb2b7" stroke-width="18" fill="none" />
      <circle cx="355" cy="195" r="52" fill="#aeb2b7" fill-opacity="0.3" />
      <text x="355" y="210" font-family="Arial" font-size="55" text-anchor="middle" fill="#aeb2b7">R</text>
    </svg>
  </i>
                                    <span>I-Specs Lab<?php //echo lang('labs'); ?></span>
                                </a>
                                <!--<ul class="sub">-->
                                    <!-- <li><a  href="lab/dashboard"><i class="fa fa-file-medical"></i><?php echo 'Dashboard';//lang('lab_reports'); ?></a></li> -->
                                    <!-- <li><a  href="lab/registration"><i class="fa fa-file-medical"></i><?php echo 'Registration';//lang('lab_reports'); ?></a></li> -->
                                    <!-- <li><a  href="lab/processing"><i class="fa fa-file-medical"></i><?php echo 'Processing';//lang('lab_reports'); ?></a></li>-->
                                <!--    <li><a  href="lab"><i class="fa fa-file-medical"></i><?php echo lang('lab_reports'); ?></a></li>-->
                                <!--    <li><a  href="lab/addLabView"><i class="fa fa-plus-circle"></i><?php echo lang('add_lab_report'); ?></a></li>-->
                                    <!-- <li><a href="https://ispecsappeal.net/systems/inventory" target="_blank"><i class="fa fa-plus-circle"></i><?php echo 'Inventory';//lang('add_lab_report'); ?></a></li> -->
                                    <!-- <li><a  href="lab/report"><i class="fa fa-plus-circle"></i><?php echo 'Reports';//lang('template'); ?></a></li> -->
                                <!--    <li><a  href="lab/template"><i class="fa fa-plus-circle"></i><?php echo lang('template'); ?></a></li>-->
                                <!--</ul>-->
                            </li>
                        <?php } ?>






                        <?php /* if ($this->ion_auth->in_group(array('admin', 'Laboratorist'))) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa  fa-hand-holding-water"></i>
                                    <span><?php echo 'POS';//lang('donor') ?></span>
                                </a>
                                <ul class="sub">
                                 <!--   <li><a  href="donor"><i class="fa fa-user"></i><?php echo lang('donor_list'); ?></a></li>
                                    <li><a  href="donor/addDonorView"><i class="fa fa-plus-circle"></i><?php echo lang('add_donor'); ?></a></li>
                                    <li><a  href="donor/bloodBank"><i class="fa fa-tint"></i><?php echo lang('blood_bank'); ?></a></li>-->
									
									<li><a href="pos/inventory/product"><i class="fas fa-procedures"></i>Product</a></li>
									<li><a href="pos/inventory/category"><i class="fa fa-plus-circle"></i>Category</a></li>
									<li><a href="pos/inventory/sales"><i class="fa fa-edit"></i>Sales Order</a></li>	
									<li><a href="pos/inventory/supplier"><i class="fa fa-edit"></i>Supplier</a></li>	
									
									<li><a href="pos/pos/teller"><i class="fas fa-bed"></i>Teller</a></li>
									<li><a href="pos/pos/reservation"><i class="fa fa-plus-circle"></i>Reservation</a></li>
									
									<li><a href="pos/report/sales"><i class="fa fa-plus-circle"></i>Sales</a></li>
									<li><a href="pos/report/reservation"><i class="fa fa-plus-circle"></i>Reservation</a></li>
									
                                </ul>
                            </li>
                        <?php } */ ?>
                        <?php /* if ($this->ion_auth->in_group(array('admin'))) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fas fa-procedures"></i>
                                    <span><?php echo lang('bed'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a  href="bed"><i class="fas fa-procedures"></i><?php echo lang('bed_list'); ?></a></li>
                                    <li><a  href="bed/addBedView"><i class="fa fa-plus-circle"></i><?php echo lang('add_bed'); ?></a></li>
                                    <li><a  href="bed/bedCategory"><i class="fa fa-edit"></i><?php echo lang('bed_category'); ?></a></li>
                                    <li><a  href="bed/bedAllotment"><i class="fas fa-bed"></i><?php echo lang('bed_allotments'); ?></a></li>
                                    <li><a  href="bed/addAllotmentView"><i class="fa fa-plus-circle"></i><?php echo lang('add_allotment'); ?></a></li>
                                </ul>
                            </li>
                        <?php } */ ?> 
						
						
						
                       


                        
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-comment-dots"></i>
                                    <span><?php echo lang('notice'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a  href="notice"><i class="fa fa-bells"></i><?php echo lang('notice'); ?></a></li>
								<?php if ($this->ion_auth->in_group(array('admin', 'Doctor'))) { ?>	
                                    <li><a  href="notice/addNewView"><i class="fa fa-list-alt"></i><?php echo lang('add_new'); ?></a></li>
								<?php } ?>	
                                </ul>
                            </li> 
                        <?php //if ($this->ion_auth->in_group('admin')) { ?>
                            <li>
                                <a href="chat">
                                    <i class="fa fa-comments"></i>
                                    <span><?php echo lang('chat'); ?></span>
                                </a>
                            </li>
                        <?php //} ?>							

                      
                      
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-sms"></i>
                                    <span><?php echo lang('email'); ?></span>
                                </a>
                              <ul class="sub">
                                        <li>
                                <a href="email/sendView" >
                                    <i class="fa fa-mail-bulk"></i>
                                    <span>Send Email</span>
                                </a>
                                </li> 
                                <!--<li><a  href="email/sendView"><i class="fa fa-location-arrow"></i><?php echo lang('new'); ?></a></li>-->
                              <li><a  href="#"><i class="fa fa-list-alt"></i><?php echo lang('sent'); ?></a></li>
          <!--<li><a  href="email/getView"><i class="fa fa-list-alt"></i><?php echo 'Inbox'; ?></a></li>-->
          <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                     <li><a  href="email/settings"><i class="fa fa-cogs"></i><?php echo lang('settings'); ?></a></li>
										<!--<li><a  href="email/autoEmailTemplate"><i class="fa fa-robot"></i><?php echo lang('autoemailtemplate'); ?></a></li>-->

								  <?php } ?>
                               </ul>
                            </li>
						

                        <?php if ($this->ion_auth->in_group(array('admin','Doctor','Receptionist'))) {  ?>
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-sms"></i>
                                    <span><?php echo lang('sms'); ?></span>
                                </a>
                                <ul class="sub">
                                    <!--<li><a  href="sms/autoSMSTemplate"><i class="fa fa-robot"></i><?php echo lang('autosmstemplate'); ?></a></li>-->
                                    <li><a  href="sms/newSms"><i class="fa fa-location-arrow"></i><?php echo lang('write_message'); ?></a></li>
                                    <!--<li><a  href="sms/sent"><i class="fa fa-list-alt"></i><?php echo lang('sent_messages'); ?></a></li>-->
                                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                        <li><a  href="sms"><i class="fa fa-cogs"></i><?php echo lang('sms_settings'); ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li> 
                        <?php  } ?>                        
						<?php if ($this->ion_auth->in_group(array('admin','Doctor','Accountant','Receptionist'))) {  ?>
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-sms"></i>
                                    <span><?php echo lang('analytics'); ?> & Reports </span> 
                                </a>
                                <ul class="sub">
                                    <li><a  href="analytics/frameSale"><i class="fa fa-robot"></i><?php echo lang('analytics_frame'); ?></a></li>
                                    <li><a  href="analytics/serviceSale"><i class="fa fa-location-arrow"></i><?php echo lang('analytics_service'); ?></a></li>
                                    <!--<li><a  href="analytics/userActivity"><i class="fa fa-list-alt"></i><?php echo lang('analytics_user'); ?></a></li>-->
									
								<li>
									<li class="sub-menu">
									<a href="javascript:;" >
                                    <i class="fa fa-list-alt"></i>
                                    <span>Payment Activities</span>
									</a>
                                <ul class="sub">
                                    <li><a  href="analytics/paymentActivity"><i class="fa fa-list-alt"></i><?php echo lang('analytics_payment_activity'); ?></a></li>
                                    <li><a  href="analytics/paymentBalance"><i class="fa fa-list-alt"></i>Outstanding.</a></li>
                                    <!--<li><a  href="analytics/surplusBalance"><i class="fa fa-list-alt"></i>Surplus Balance.</a></li>-->
                                </ul>
								</li>	
								</li>
									
																	
									
									<li><a  href="analytics/dailySale"><i class="fa fa-robot"></i><?php echo lang('analytics_daily_sales'); ?></a></li>
									<li><a  href="analytics/weeklySales"><i class="fa fa-robot"></i><?php echo lang('analytics_weekly_sales'); ?></a></li>
									<li><a  href="finance/pharmacy/monthly?year=2025"><i class="fa fa-robot"></i><?php echo lang('analytics_monthly_sales'); ?></a></li>
                                    <!--<li><a  href="analytics/bestWorst"><i class="fa fa-location-arrow"></i><?php echo lang('analytics_best_worst'); ?></a></li>-->
         <!--                           <li><a  href="analytics/dailyPatient"><i class="fa fa-list-alt"></i><?php echo lang('analytics_daily_patient'); ?></a></li>-->
									<!--<li><a  href="analytics/weeklyPatient"><i class="fa fa-list-alt"></i><?php echo lang('analytics_weekly_patient'); ?></a></li>-->
									<!--<li><a  href="analytics/monthlyPatient"><i class="fa fa-list-alt"></i><?php echo lang('analytics_monthly_patient'); ?></a></li>-->
									<!--<li><a  href="analytics/dailyDoctor"><i class="fa fa-list-alt"></i><?php echo lang('analytics_daily_doctor'); ?></a></li>-->
									<!--<li><a  href="analytics/weeklyDoctor"><i class="fa fa-list-alt"></i><?php echo lang('analytics_weekly_doctor'); ?></a></li>-->
									<!--<li><a  href="analytics/monthlyDoctor"><i class="fa fa-list-alt"></i><?php echo lang('analytics_monthly_doctor'); ?></a></li>-->
                                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                        <!-- <li><a  href="analytics"><i class="fa fa-cogs"></i><?php echo lang('analytics_settings'); ?></a></li> -->
                                    <?php } ?>
                                </ul>
                            </li> 
                        <?php  } ?>
                        <?php if ($this->ion_auth->in_group(array('admin'))) {  ?>

                            <li class="sub-menu">
                                <!--<a href="javascript:;" >-->
                                <!--    <i class="fas fa-globe"></i>-->
                                <!--    <span><?php echo lang('website'); ?></span>-->
                                <!--</a>-->
                                <ul class="sub">
                                    <li><a href="frontend" target="_blank" ><i class="fa fa-globe"></i><?php echo lang('visit_site'); ?></a></li>
                                    <li><a href="frontend/settings"><i class="fa fa-cog"></i><?php echo lang('website_settings'); ?></a></li>
                                    <li><a href="slide"><i class="fa fa-wrench"></i><?php echo lang('slides'); ?></a></li>
                                    <li><a href="service"><i class="fab fa-servicestack"></i><?php echo lang('services'); ?></a></li>
                                    <li><a href="featured"><i class="fa fa-address-card"></i><?php echo lang('featured_doctors'); ?></a></li>
                                </ul>
                            </li>

                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-cogs"></i>
                                    <span><?php echo lang('settings'); ?></span>
                                </a>
                                <ul class="sub"> 
                                    <li><a href="settings"><i class="fa fa-cog"></i><?php echo lang('system_settings'); ?></a></li>

                                    <li><a href="pgateway"><i class="fa fa-credit-card"></i><?php echo lang('payment_gateway'); ?></a></li>
                                    <li><a href="settings/language"><i class="fa fa-language"></i><?php echo lang('language'); ?></a></li>
                                    <li><a href="settings/notes"><i class="fa fa-language"></i><?php echo 'Progress Notes';//lang('language'); ?></a></li>
									<?php $login_user = $this->ion_auth->user()->row()->username; ?>
                                        <li><a href="../import2/index.php?user=<?=$login_user; ?>"><i class="fa fa-arrow-right"></i><?php echo lang('bulk'); ?> <?php echo lang('import'); ?></a></li>
                                    <li><a href="settings/backups"><i class="fa fa-database"></i><?php echo lang('backup_database'); ?></a></li>
                                </ul>
                            </li>
							 <li class="sub-menu">
                                    <a href="javascript:;" >
                                        <i class="fa fa-history"></i>
                                        <span><?php echo lang('logs'); ?></span>
                                    </a>
                                    <ul class="sub">
									<li><a href="logs/getUserLogs"><i class="fa fa-history"></i><?php echo 'User';//lang('user'); ?> <?php echo lang('login_logs'); ?></a></li>
									<li><a href="logs/getFrameLogs"><i class="fa fa-history"></i><?php echo 'Frame Inventory Logs'; ?></a></li>
                                     <li><a href="logs/transactionLogs"><i class="fa fa-history"></i> <?php echo lang('transaction_logs'); ?></a></li>
                                     <!--<li>                            
										<li class="sub-menu">
											<a href="javascript:;" >
												<i class="fa fa-address-card"></i><?php echo 'Patient Data Logs';//lang('settings'); ?></a>
													<ul class="sub"> 
														<li><a href=""><i class="fa fa-history"></i><?php echo 'Reason for Visit';//lang('system_settings'); ?></a></li>
														<li><a href=""><i class="fa fa-history"></i><?php echo 'Daily Patients';//lang('payment_gateway'); ?></a></li>
														<li><a href=""><i class="fa fa-history"></i><?php echo ''; ?></a></li>
														<li><a href=""><i class="fa fa-history"></i><?php echo '';//lang('language'); ?></a></li>
														<li><a href=""><i class="fa fa-history"></i><?php echo '';//lang('bulk'); ?></a></li>
														<li><a href=""><i class="fa fa-history"></i><?php echo ''; ?></a></li>
													</ul>
										</li>
								  </li>-->
                                    </ul>
                                </li> 
                        <?php } ?>
                        <?php if ($this->ion_auth->in_group('Receptionist','Accountant')) { ?>

                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-money-bill-alt"></i>
                                    <span><?php echo lang('payments'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li>
                                        <a href="finance/payment" >
                                            <i class="fa fa-money-check"></i>
                                            <span> <?php echo lang('payments'); ?> </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="finance/finance/pharmacy/sellNow" >
                                            <i class="fa fa-plus-circle"></i>
                                            <span> <?php echo lang('add_payment'); ?> </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="finance/paymentCategory" >
                                            <i class="fa fa-edit"></i>
                                            <span> <?php echo lang('payment_procedures'); ?> </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="finance/expense" >
                                    <i class="fa fa-money-check"></i>
                                    <span> <?php echo lang('expense'); ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="finance/addExpenseView" >
                                    <i class="fa fa-plus-circle"></i>
                                    <span> <?php echo lang('add_expense'); ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="finance/expenseCategory" >
                                    <i class="fa fa-edit"></i>
                                    <span> <?php echo lang('expense_categories'); ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="finance/doctorsCommission" >
                                    <i class="fa fa-edit"></i>
                                    <span> <?php echo lang('doctors_commission'); ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="finance/financialReport" >
                                    <i class="fa fa-book"></i>
                                    <span> <?php echo lang('financial_report'); ?> </span>
                                </a>
                            </li>
                        <?php } ?>

                    <!--    <?php if ($this->ion_auth->in_group('Doctor','Pharmacist')) { ?>
                            <li>
                                <a href="medicine" >
                                    <i class="fa fa-medkit"></i>
                                    <span> <?php echo lang('medicine_list'); ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="medicine/addMedicineView" >
                                    <i class="fa fa-plus-circle"></i>
                                    <span> <?php echo lang('add_medicine'); ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="medicine/medicineCategory" >
                                    <i class="fa fa-medkit"></i>
                                    <span> <?php echo lang('medicine_category'); ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="medicine/addCategoryView" >
                                    <i class="fa fa-plus-circle"></i>
                                    <span> <?php echo lang('add_medicine_category'); ?> </span>
                                </a>
                            </li>
                        <?php } ?> -->
                     
                        <?php /* if ($this->ion_auth->in_group('Patient')) { ?>

                            <li>
                                <a href="lab/myLab" >
                                    <i class="fa fa-file-medical-alt"></i>
                                    <span> <?php echo lang('diagnosis'); ?> <?php echo lang('reports'); ?> </span>
                                </a>
                            </li>

                            <li>
                                <a href="patient/calendar" >
                                    <i class="fa fa-calendar"></i>
                                    <span> <?php echo lang('appointment'); ?> <?php echo lang('calendar'); ?> </span>
                                </a>
                            </li>

                            <li>
                                <a href="patient/myCaseList" >
                                    <i class="fa fa-file-medical"></i>
                                    <span>  <?php echo lang('cases'); ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="patient/myPrescription" >
                                    <i class="fa fa-medkit"></i>
                                    <span> <?php echo lang('refraction'); ?>  </span>
                                </a>
                            </li>

                            <li>
                                <a href="patient/myDocuments" >
                                    <i class="fa fa-file-upload"></i>
                                    <span> <?php echo lang('documents'); ?> </span>
                                </a>
                            </li>

                            <li>
                                <a href="patient/myPaymentHistory" >
                                    <i class="fa fa-money-bill-alt"></i>
                                    <span> <?php echo lang('payment'); ?> </span>      
                                </a>
                            </li>

                            <li>
                                <a href="report/myreports" >
                                    <i class="fa fa-file-medical-alt"></i>
                                    <span> <?php echo lang('other'); ?> <?php echo lang('reports'); ?> </span>
                                </a>
                            </li>

                        <?php } */ ?>

                     

  <!-- 
                        <?php if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-mail-bulk"></i>
                                    <span><?php echo lang('email'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a  href="email/sendView"><i class="fa fa-location-arrow"></i><?php echo lang('new'); ?></a></li>
                                </ul>
                            </li> 
                        <?php } ?> 



                     <li>
                            <a href="profile" >
                                <i class="fa fa-user"></i>
                                <span> <?php echo lang('profile'); ?> </span>
                            </a>
                        </li>

                        multi level menu start-->

                        <!--multi level menu end-->

                    </ul>
                    <!-- sidebar menu end-->
                </div>
            </aside>
            <!--sidebar end-->




