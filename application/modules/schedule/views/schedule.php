<section id="main-content">
    <section class="wrapper site-min-height">
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('time_schedule'); ?> 
                <div class="col-md-4 clearfix pull-right">
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i>  <?php echo lang('add_new'); ?> 
                            </button>
                        </div>
                    </a> 
                </div>
            </header>

            <div class="panel-body">
                <div class="adv-table editable-table">
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> <?php echo lang('doctor'); ?></th>
                                <th> <?php echo lang('weekday'); ?></th>
                                <th> <?php echo lang('start_time'); ?></th>
                                <th> <?php echo lang('end_time'); ?></th>
                                <th> <?php echo lang('duration'); ?></th>
                                <?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Receptionist'))) { ?>
                                    <th> <?php echo lang('options'); ?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php
                            $i = 0;
                            foreach ($schedules as $schedule) {
                                $i = $i + 1;
                                ?>
                                <tr class="" data-row-id="<?php echo $schedule->id; ?>">
                                    <td class="count"> <?php echo $i; ?></td> 
                                    <td class="doctor_name"> <?php echo $this->doctor_model->getDoctorById($schedule->doctor)->name; ?></td>
                                    <td class="weekday"> <?php echo $schedule->weekday; ?></td> 
                                    <td class="s_time"><?php echo $schedule->s_time; ?></td>
                                    <td class="e_time"><?php echo $schedule->e_time; ?></td>
                                    <td class="duration"><?php echo $schedule->duration * 5 . ' ' . lang('minitues'); ?></td>
                                    <?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Receptionist'))) { ?>
                                        <td>
                                            <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $schedule->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>   
                                            <a class="btn btn-info btn-xs btn_width delete_button" href="schedule/deleteSchedule?id=<?php echo $schedule->id; ?>&doctor=<?php echo $schedule->doctor; ?>&weekday=<?php echo $schedule->weekday; ?>&all=all" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"> </i> <?php echo lang('delete'); ?></a>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div> 
            </div> 
        </section>
        </section>
</section>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('add'); ?> <?php echo lang('schedule'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" action="schedule/addSchedule" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1">  <?php echo lang('doctor'); ?></label>
                        <select class="form-control m-bot15 js-example-basic-single" name="doctor" value=''> 
                            <option value="">Select .....</option>
                            <?php foreach ($doctors as $doctor) { ?>
                                <option value="<?php echo $doctor->id; ?>"><?php echo $doctor->name; ?> </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('weekday'); ?></label>
                        <select class="form-control m-bot15" id="weekday" name="weekday" value=''> 
                            <option value="Friday"><?php echo lang('friday') ?></option>
                            <option value="Saturday"><?php echo lang('saturday') ?></option>
                            <option value="Sunday"><?php echo lang('sunday') ?></option>
                            <option value="Monday"><?php echo lang('monday') ?></option>
                            <option value="Tuesday"><?php echo lang('tuesday') ?></option>
                            <option value="Wednesday"><?php echo lang('wednesday') ?></option>
                            <option value="Thursday"><?php echo lang('thursday') ?></option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('start_time'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <input type="text" class="form-control timepicker-default" name="s_time" id="exampleInputEmail1" value=''>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group bootstrap-timepicker col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('end_time'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <input type="text" class="form-control timepicker-default" name="e_time" id="exampleInputEmail1" value=''>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                            </span>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('appointment') ?> <?php echo lang('duration') ?> </label>
                        <select class="form-control m-bot15" name="duration" value=''>
                            <option value="3" > 15 Minitues </option>
                            <option value="4" > 20 Minitues </option>
                            <option value="6" > 30 Minitues </option>
                            <option value="9" > 45 Minitues </option>
                            <option value="12" > 60 Minitues </option>
                        </select>
                    </div>

                    <input type="hidden" name="redirect" value='schedule'>
                    <input type="hidden" name="id" value=''>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>
            </div>
        </div></div></div>
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> <?php echo lang('edit'); ?> <?php echo lang('schedule'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="editScheduleForm" class="clearfix" action="go/addSchedule" method="post" enctype="multipart/form-data">
                    <div class="col-md-6 panel">
                        <label for="doctor_edit"> <?php echo lang('doctor'); ?></label>
                        <select class="form-control m-bot15 js-example-basic-single" id="doctor_edit" name="doctor" value=''>
                            </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="weekday_edit"> <?php echo lang('weekday'); ?></label>
                        <select class="form-control m-bot15" id="weekday_edit" name="weekday" value=''>
                            <option value="Friday"><?php echo lang('friday') ?></option>
                            <option value="Saturday"><?php echo lang('saturday') ?></option>
                            <option value="Sunday"><?php echo lang('sunday') ?></option>
                            <option value="Monday"><?php echo lang('monday') ?></option>
                            <option value="Tuesday"><?php echo lang('tuesday') ?></option>
                            <option value="Wednesday"><?php echo lang('wednesday') ?></option>
                            <option value="Thursday"><?php echo lang('thursday') ?></option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="s_time_edit"> <?php echo lang('start_time'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <input type="text" class="form-control timepicker-default" name="s_time" id="s_time_edit" value=''>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group bootstrap-timepicker col-md-6">
                        <label for="e_time_edit"> <?php echo lang('end_time'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <input type="text" class="form-control timepicker-default" name="e_time" id="e_time_edit" value=''>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                            </span>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="duration_edit"><?php echo lang('appointment') ?> <?php echo lang('duration') ?> </label>
                        <select class="form-control m-bot15" id="duration_edit" name="duration" value=''>
                            <option value="3">15 Minitues</option>
                            <option value="4">20 Minitues</option>
                            <option value="6">30 Minitues</option>
                            <option value="9">45 Minitues</option>
                            <option value="12">60 Minitues</option>
                        </select>
                    </div>
                    
                    <input type="hidden" name="id" value=''>
                    
                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>
            </div>
        </div></div></div>
<script src="common/js/codearistos.min.js"></script>

<script type="text/javascript">
$(document).ready(function () {
    // Listener for when the EDIT button is clicked
    $(".editbutton").click(function (e) {
        e.preventDefault(e);
        var iid = $(this).data('id'); // Get the schedule ID from the button

        $('#editScheduleForm').trigger("reset"); // Reset the form
        $('#myModal2').modal('show'); // Show the modal

        // AJAX request to fetch the schedule data
        $.ajax({
            url: './db/edit_schedule.php?fetch_id=' + iid,
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                if(response.status === 'success') {
                    var schedule = response.schedule;
                    var doctors = response.doctors;
                    var form = $('#editScheduleForm');
                    
                    // Populate the form fields
                    form.find('[name="id"]').val(schedule.id).end();
                    form.find('[name="s_time"]').val(schedule.s_time).end();
                    form.find('[name="e_time"]').val(schedule.e_time).end();
                    form.find('[name="weekday"]').val(schedule.weekday).end();
                    form.find('[name="duration"]').val(schedule.duration).end();

                    // Populate the doctors dropdown
                    var doctorSelect = form.find('[name="doctor"]');
                    doctorSelect.empty(); // Clear existing options
                    doctors.forEach(function(doctor) {
                        var isSelected = (doctor.id == schedule.doctor) ? 'selected' : '';
                        doctorSelect.append('<option value="' + doctor.id + '" ' + isSelected + '>' + doctor.name + '</option>');
                    });
                    // Re-initialize select2 if you are using it
                    if (doctorSelect.data('select2')) {
                        doctorSelect.select2('destroy').select2();
                    }
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function() {
                alert('An error occurred while fetching schedule data.');
            }
        });
    });

});
</script>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
    $(document).ready(function() {
    // Initialize Bootstrap timepicker
    $('.timepicker-default').timepicker({
        defaultTime: false,
        showMeridian: true, // Use AM/PM format; set to false for 24-hour format if needed
        minuteStep: 5
    });

    // Initialize Select2 for doctor dropdown
    $('#doctor_edit').select2({
        placeholder: "Select a doctor",
        allowClear: true
    });

    // Log form values when modal is shown (if applicable)
    $('#myModal2').on('show.bs.modal', function() {
        console.log('Form Values on Modal Show:');
        console.log('Doctor:', $('#doctor_edit').val());
        console.log('Weekday:', $('#weekday_edit').val());
        console.log('Start Time:', $('#s_time_edit').val());
        console.log('End Time:', $('#e_time_edit').val());
        console.log('Duration:', $('#duration_edit').val());
        console.log('ID:', $('input[name="id"]').val());
    });

    // Handle form submission
    $("#editScheduleForm").on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission
        e.stopPropagation(); // Stop event bubbling to avoid conflicts

        var formData = $(this).serialize(); // Serialize form data
        console.log('Serialized Form Data:', formData);
        console.log('Submitting AJAX request to: ./db/update_schedule.php');
        console.log('Request Method: POST');

        $.ajax({
            url: './db/update_schedule.php',
            type: 'POST', // Explicitly set type to POST
            data: formData,
            dataType: 'json',
            cache: false, // Prevent caching issues
            beforeSend: function(xhr) {
                console.log('AJAX Request Headers:', xhr.getAllResponseHeaders());
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); // Identify AJAX request
            },
            success: function(response) {
                console.log('Server Response:', response);
                if (response.status === 'success') {
                    var updatedRowData = response.updated_row;
                    // Find the table row with the matching data-row-id
                    var row = $('#editable-sample').find('tr[data-row-id="' + updatedRowData.id + '"]');
                    
                    // Update the cells in that specific row
                    row.find('.doctor_name').text(updatedRowData.doctor_name);
                    row.find('.weekday').text(updatedRowData.weekday);
                    row.find('.s_time').text(updatedRowData.s_time);
                    row.find('.e_time').text(updatedRowData.e_time);
                    row.find('.duration').text(updatedRowData.duration * 5 + ' Minutes');
                    
                    $('#myModal2').modal('hide'); // Hide the modal on success
                    alert('Schedule updated successfully!');
                } else {
                    alert('Update failed: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error Details:', {
                    status: status,
                    error: error,
                    responseText: xhr.responseText,
                    statusCode: xhr.status
                });
                alert('A server error occurred: ' + xhr.responseText);
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
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5], // Adjusted to not print the options column
                    }
                },
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: -1,
            "order": [[0, "desc"]],
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