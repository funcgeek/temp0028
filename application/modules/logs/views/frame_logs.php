<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo 'Frame Inventory Logs';//lang('login_logs'); ?>
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
                                <th><?php echo 'Model#';//lang('name'); ?></th>
                                <th><?php echo 'Brand'; ?></th>
                                <th><?php echo 'Size'; ?></th>
                                <th><?php echo 'Montego'; ?></th>
                                <th><?php echo 'MB QTY.'; ?></th>
                                <th><?php echo 'Falmouth'; ?></th>
                                <th><?php echo 'FAL QTY.'; ?></th>
                                <th><?php echo 'Price'; ?></th>
                                <th><?php echo 'Color'; ?></th>
                                <th><?php echo 'Description'; ?></th>
                                <th><?php echo 'User'; ?></th>
                                <th><?php echo lang('login_date_time'); ?></th>
								<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                    <th> <?php echo lang('options'); ?></th>
                                <?php } ?>                                                          
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($frame_logs as $framelogs) { ?>
                            <tr class="">
                                <td class="center"> <?php echo $framelogs->model; ?></td>
                                <td class="center"> <?php echo $framelogs->brand; ?></td>
                                <td class="center"><?php echo $framelogs->size; ?></td>
                                <td class="center"><?php echo $framelogs->location_mobay; ?></td>
                                <td class="center"><?php echo $framelogs->quantity_mobay; ?></td>
                                <td class="center"><?php echo $framelogs->location_falmouth; ?></td>
                                <td class="center"><?php echo $framelogs->quantity_falmouth; ?></td>
                                <td class="center"><?php echo $framelogs->price; ?></td>
                                <td class="center"><?php echo $framelogs->color; ?></td>
                                <td class="center"><?php echo $framelogs->description; ?></td>
                                <td class="center"><?php echo $framelogs->user; ?></td>
                                <td class="center"><?php echo $framelogs->date_time; ?></td>
                                <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                    <td>  
                                        <a class="btn btn-info btn-xs btn_width delete_button" href="logs/deleteFrameLogs?id=<?php echo $framelogs->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"> <?php echo lang('delete'); ?></i></a>
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
                                                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                                                    }
                                                },
                                            ],
                                            aLengthMenu: [
                                                [10, 25, 50, 100, -1],
                                                [10, 25, 50, 100, "All"]
                                            ],
                                            iDisplayLength: -1,
                                            "order": [[11, "desc"]],
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