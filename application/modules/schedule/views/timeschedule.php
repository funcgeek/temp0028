<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('time_schedule'); ?> (<?php echo $this->db->get_where('doctor', array('id' => $doctorr))->row()->name; ?>)
                <div class="col-md-4 clearfix pull-right">
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                            </button>
                        </div>
                    </a>
                </div>
            </header>

            <div class="panel-body">
                <div class="adv-table editable-table">
                    <?php if ($this->session->flashdata('feedback')): ?>
                        <div class="alert alert-success flashmessage">
                            <?php echo $this->session->flashdata('feedback'); ?>
                        </div>
                    <?php endif; ?>

                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo lang('weekday'); ?></th>
                                <th><?php echo lang('start_time'); ?></th>
                                <th><?php echo lang('end_time'); ?></th>
                                <th><?php echo lang('duration'); ?></th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            foreach ($schedules as $schedule): $i++; ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $schedule->weekday; ?></td>
                                    <td><?php echo $schedule->s_time; ?></td>
                                    <td><?php echo $schedule->e_time; ?></td>
                                    <td><?php echo $schedule->duration * 5 . ' ' . lang('minitues'); ?></td>
                                    <td>
                                        <!-- <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $schedule->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button> -->
                                        <a class="btn btn-info btn-xs btn_width delete_button" href="schedule/deleteSchedule?id=<?php echo $schedule->id; ?>&doctor=<?php echo $doctorr; ?>&weekday=<?php echo $schedule->weekday; ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                            <i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->

<!-- Add Time Slot Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="schedule/addSchedule" class="clearfix" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"><?php echo lang('add') . ' ' . lang('time_slots'); ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label><?php echo lang('weekday'); ?></label>
                        <select class="form-control m-bot15" name="weekday">
                            <option value="Friday"><?php echo lang('friday'); ?></option>
                            <option value="Saturday"><?php echo lang('saturday'); ?></option>
                            <option value="Sunday"><?php echo lang('sunday'); ?></option>
                            <option value="Monday"><?php echo lang('monday'); ?></option>
                            <option value="Tuesday"><?php echo lang('tuesday'); ?></option>
                            <option value="Wednesday"><?php echo lang('wednesday'); ?></option>
                            <option value="Thursday"><?php echo lang('thursday'); ?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><?php echo lang('start_time'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <input type="text" class="form-control timepicker-default" name="s_time" value="">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><?php echo lang('end_time'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <input type="text" class="form-control timepicker-default" name="e_time" value="">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><?php echo lang('appointment') . ' ' . lang('duration'); ?></label>
                        <select class="form-control m-bot15" name="duration">
                            <option value="3">15 Minutes</option>
                            <option value="4">20 Minutes</option>
                            <option value="6">30 Minutes</option>
                            <option value="9">45 Minutes</option>
                            <option value="12">60 Minutes</option>
                        </select>
                    </div>

                    <input type="hidden" name="doctor" value="<?php echo isset($doctorr) ? $doctorr : ''; ?>">
                    <input type="hidden" name="redirect" value="schedule/timeSchedule?doctor=<?php echo isset($doctorr) ? $doctorr : ''; ?>">
                    <input type="hidden" name="id" value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Add Time Slot Modal -->

<!-- Edit Time Slot Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" id="editTimeSlotForm" action="schedule/addSchedule" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"><i class="fa fa-edit"></i> <?php echo lang('edit') . ' ' . lang('time_slot'); ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label><?php echo lang('start_time'); ?></label>
                        <input type="text" class="form-control timepicker-default" name="s_time" value="">
                    </div>

                    <div class="form-group">
                        <label><?php echo lang('end_time'); ?></label>
                        <input type="text" class="form-control timepicker-default" name="e_time" value="">
                    </div>

                    <div class="form-group">
                        <label><?php echo lang('weekday'); ?></label>
                        <select class="form-control m-bot15" name="weekday">
                            <option value="Friday"><?php echo lang('friday'); ?></option>
                            <option value="Saturday"><?php echo lang('saturday'); ?></option>
                            <option value="Sunday"><?php echo lang('sunday'); ?></option>
                            <option value="Monday"><?php echo lang('monday'); ?></option>
                            <option value="Tuesday"><?php echo lang('tuesday'); ?></option>
                            <option value="Wednesday"><?php echo lang('wednesday'); ?></option>
                            <option value="Thursday"><?php echo lang('thursday'); ?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><?php echo lang('appointment') . ' ' . lang('duration'); ?></label>
                        <select class="form-control m-bot15" name="duration">
                            <option value="3">15 Minutes</option>
                            <option value="4">20 Minutes</option>
                            <option value="6">30 Minutes</option>
                            <option value="9">45 Minutes</option>
                            <option value="12">60 Minutes</option>
                        </select>
                    </div>

                    <input type="hidden" name="doctor" value="<?php echo isset($doctorr) ? $doctorr : ''; ?>">
                    <input type="hidden" name="redirect" value="schedule/timeSchedule?doctor=<?php echo isset($doctorr) ? $doctorr : ''; ?>">
                    <input type="hidden" name="id" value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Edit Time Slot Modal -->

<!-- JavaScript Section -->
<script src="common/js/codearistos.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $(".editbutton").click(function (e) {
            e.preventDefault();
            var iid = $(this).attr('data-id');
            $('#editTimeSlotForm').trigger("reset");
            $('#myModal2').modal('show');
            $.ajax({
                url: 'schedule/editScheduleByJason?id=' + iid,
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    $('#editTimeSlotForm').find('[name="id"]').val(response.schedule.id).end()
                        .find('[name="s_time"]').val(response.schedule.s_time).end()
                        .find('[name="e_time"]').val(response.schedule.e_time).end()
                        .find('[name="weekday"]').val(response.schedule.weekday).end()
                        .find('[name="duration"]').val(response.schedule.duration);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        var table = $('#editable-sample').DataTable({
            responsive: true,
            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                 "<'row'<'col-sm-12'tr>>" +
                 "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5',
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                }
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: -1,
            order: [[0, "desc"]],
            language: {
                lengthMenu: "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
        });

        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

</script>
