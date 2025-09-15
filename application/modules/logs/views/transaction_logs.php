<style>
    /* Table Container */
    .adv-table {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

    /* Table Styling */
    #editable-sample {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
    }

    #editable-sample thead th {
        background-color: #3f51b5;
        color: #ffffff;
        padding: 12px 15px;
        text-align: left;
        border-bottom: 2px solid #e0e0e0;
        position: sticky;
        top: 0;
        z-index: 1;
    }

    #editable-sample tbody tr {
        transition: background-color 0.3s ease;
    }

    #editable-sample tbody tr:hover {
        background-color: #f5f5f5;
    }

    #editable-sample tbody td {
        padding: 12px 15px;
        border-bottom: 1px solid #e0e0e0;
        vertical-align: middle;
    }

    #editable-sample tbody tr:nth-child(even) {
        background-color: #fafafa;
    }

    /* Labels for Actions */
    .label {
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
    }

    .label-success {
        background-color: #4caf50;
        color: #fff;
    }

    .label-info {
        background-color: #2196f3;
        color: #fff;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        #editable-sample thead th,
        #editable-sample tbody td {
            padding: 8px 10px;
            font-size: 12px;
        }

        .adv-table {
            padding: 10px;
        }
    }

    /* Custom Buttons Container */
    .custom_buttons {
        margin-bottom: 15px;
    }

    .dt-buttons .btn {
        background-color: #3f51b5;
        color: #fff;
        border: none;
        padding: 6px 12px;
        border-radius: 5px;
        margin-right: 5px;
        transition: background-color 0.3s ease;
    }

    .dt-buttons .btn:hover {
        background-color: #303f9f;
    }
</style>

<section id="main-content">
    <section class="wrapper site-min-height">
        <section class="panel">
            <header class="panel-heading" style="background-color: #3f51b5; color: #fff; padding: 15px; border-radius: 10px 10px 0 0;">
                <?php echo lang('transaction_logs'); ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table">
                    <div class="custom_buttons"></div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('date-time'); ?></th>
                                <th><?php echo lang('invoice'); ?> <?php echo lang('id'); ?></th>
                                <th><?php echo lang('patient'); ?></th>
                                <th><?php echo lang('deposit_type'); ?></th>
                                <th><?php echo lang('amount'); ?></th>
                                <th><?php echo lang('user'); ?></th> <!-- Changed from 'created_by' to 'user' -->
                                <th>Action Taken</th> <!-- Moved to last -->
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </section>
    </section>
</section>
<!--footer start-->
<script src="common/js/codearistos.min.js"></script>

<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>

<script type="text/javascript">
$(document).ready(function () {
    "use strict";
    var table = $("#editable-sample").DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        searchable: true,
        ajax: {
            url: "logs/getTransaction",
            type: "POST",
        },
        scroller: {
            loadingIndicator: true,
        },
        dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            { extend: "copyHtml5", exportOptions: { columns: [0, 1, 2, 3, 4, 5] } },
            { extend: "excelHtml5", exportOptions: { columns: [0, 1, 2, 3, 4, 5] } },
            { extend: "csvHtml5", exportOptions: { columns: [0, 1, 2, 3, 4, 5] } },
            { extend: "pdfHtml5", exportOptions: { columns: [0, 1, 2, 3, 4, 5] } },
            { extend: "print", exportOptions: { columns: [0, 1, 2, 3, 4, 5] } },
        ],
        aLengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"],
        ],
        iDisplayLength: 100,
        order: [[0, "desc"]],
        language: {
            lengthMenu: "_MENU_",
            search: "_INPUT_",
            url: "common/assets/DataTables/languages/" + language + ".json",
        },
    });
    table.buttons().container().appendTo(".custom_buttons");
});
</script>