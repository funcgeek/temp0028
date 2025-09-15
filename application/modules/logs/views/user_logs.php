<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo 'User Authentication Logs';//lang('login_logs'); ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix"> 
                        <button class="export" onclick="javascript:window.print();">Print</button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                
                                <th><?php echo 'User';//lang('name'); ?></th>
                                <th><?php echo lang('location'); ?></th>
                                <th><?php echo lang('email'); ?></th>
                                <th><?php echo lang('role'); ?></th>
                                <th><?php echo lang('ip_address'); ?></th>
                                <th><?php echo lang('description'); ?></th>
                                <th><?php echo lang('login_date_time'); ?></th>
								<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                    <th> <?php echo lang('options'); ?></th>
                                <?php } ?>                                                          
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($user_logs as $userlogs) { ?>
                            <tr class="">
                                <td> <?php echo $userlogs->name; ?></td>
                                <td> <?php echo $userlogs->location; ?></td>
                                <td class="center"><?php echo $userlogs->email; ?></td>
                                <td class="center"><?php echo $userlogs->role; ?></td>
                                <td class="center"><?php echo $userlogs->ip_address; ?></td>
                                <td class="center"><?php echo $userlogs->description; ?></td>
                                <td class="center"><?php echo $userlogs->date_time; ?></td>
                                <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                    <td>  
                                        <a class="btn btn-info btn-xs btn_width delete_button" href="logs/deleteUserLogs?id=<?php echo $userlogs->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"> <?php echo lang('delete'); ?></i></a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
<script src="common/js/codearistos.min.js"></script>
<script>
                                    $(document).ready(function () {
                                        var table = $('#editable-sample').DataTable({
                                            responsive: true,
                                            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                                                    "<'row'<'col-sm-12'tr>>" +
                                                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                                            buttons: [
                                                'copyHtml5',
                                                'excelHtml5',
                                                'csvHtml5',
                                                'pdfHtml5',
                                                {
                                                    extend: 'print',
                                                    exportOptions: {
                                                        columns: [1, 2, 3, 4],
                                                    }
                                                },
                                            ],
                                            aLengthMenu: [
                                                [10, 25, 50, 100, -1],
                                                [10, 25, 50, 100, "All"]
                                            ],
                                            iDisplayLength: -1,
                                            "order": [[3, "desc"]],
                                            "language": {
                                                "lengthMenu": "_MENU_",
                                                search: "_INPUT_",
                                                "url": "common/assets/DataTables/languages/<?php echo $this->language; ?>.json"
                                            },

                                        });

                                        table.buttons().container()
                                                .appendTo('.custom_buttons');
                                    });
</script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>