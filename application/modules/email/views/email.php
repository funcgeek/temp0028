<section id="main-content">
    <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Sent Email Logs</h3>
        
        <div class="row mt">
            <div class="col-lg-12">
                <div class="content-panel">
                    <div class="panel-heading">
                        <h4><i class="fa fa-envelope-o"></i> Email Logs Management</h4>
                    </div>
                    
                    <div class="panel-body">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label>Search:</label>
                                <input type="text" id="searchInput" class="form-control" placeholder="Search emails...">
                            </div>
                            <div class="col-md-2">
                                <label>Show:</label>
                                <select id="limitSelect" class="form-control">
                                    <option value="10">10</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="500">500</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>&nbsp;</label><br>
                                <button id="exportBtn" class="btn btn-success">
                                    <i class="fa fa-download"></i> Export CSV
                                </button>
                            </div>
                            <div class="col-md-5">
                                <label>Total Records:</label>
                                <span id="totalRecords" class="badge badge-info">0</span>
                            </div>
                        </div>
                        
                        <div id="loading" style="display: none;" class="text-center">
                            <i class="fa fa-spinner fa-spin fa-2x"></i>
                            <p>Loading...</p>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-advance table-hover" id="emailTable">
                                <thead>
                                    <tr>
                                        <th data-column="id" class="sortable">ID <i class="fa fa-sort"></i></th>
                                        <th data-column="recipient_email" class="sortable">Recipient Email <i class="fa fa-sort"></i></th>
                                        <th data-column="recipient_name" class="sortable">Recipient Name <i class="fa fa-sort"></i></th>
                                        <th data-column="subject" class="sortable">Subject <i class="fa fa-sort"></i></th>
                                        <th data-column="message" class="sortable">Message <i class="fa fa-sort"></i></th>
                                        <th data-column="status" class="sortable">Status <i class="fa fa-sort"></i></th>
                                        <th data-column="sent_at" class="sortable">Sent At <i class="fa fa-sort"></i></th>
                                        <th data-column="sender_ID" class="sortable">Sender ID <i class="fa fa-sort"></i></th>
                                        <th data-column="attachments" class="sortable">Attachments <i class="fa fa-sort"></i></th>
                                        <th data-column="created_at" class="sortable">Created At <i class="fa fa-sort"></i></th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    </tbody>
                            </table>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6" id="pageInfo"></div>
                            <div class="col-md-6">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-end" id="pagination"></ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>

<style>
/* Your CSS remains the same */
.sortable { cursor: pointer; user-select: none; }
.sortable:hover { background-color: #f8f9fa; }
.sortable i { margin-left: 5px; }
.sort-asc i.fa-sort-up, .sort-desc i.fa-sort-down { color: #337ab7; }
.badge { display: inline-block; padding: .25em .4em; font-size: 75%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: .25rem; }
.badge-info { color: #fff; background-color: #17a2b8; }
.badge-success { color: #fff; background-color: #28a745; }
.badge-danger { color: #fff; background-color: #dc3545; }
.text-truncate { max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.mb-3 { margin-bottom: 1rem; }
.mt { margin-top: 20px; }
</style>

<script>
// ... (Your global variables and $(document).ready function remain the same)
let currentPage = 1, currentLimit = 10, currentSearch = '', currentSortColumn = 'created_at', currentSortOrder = 'DESC', debounceTimer;
$(document).ready(function() { /* Your event handlers are correct */ 
    loadData();
    $('#searchInput').on('input', function() { clearTimeout(debounceTimer); debounceTimer = setTimeout(() => { currentSearch = $(this).val(); currentPage = 1; loadData(); }, 300); });
    $('#limitSelect').on('change', function() { currentLimit = parseInt($(this).val()); currentPage = 1; loadData(); });
    $('#emailTable').on('click', '.sortable', function() { const column = $(this).data('column'); if (currentSortColumn === column) { currentSortOrder = currentSortOrder === 'ASC' ? 'DESC' : 'ASC'; } else { currentSortColumn = column; currentSortOrder = 'ASC'; } loadData(); });
    $('#exportBtn').on('click', function() { const exportUrl = `./db/get_email_logs.php?action=export&search=${encodeURIComponent(currentSearch)}&sort_column=${currentSortColumn}&sort_order=${currentSortOrder}`; window.location.href = exportUrl; });
});


function loadData() { /* This function is correct */ 
    $('#loading').show();
    updateSortIcons();
    $.ajax({
        url: './db/get_email_logs.php',
        method: 'GET',
        data: { action: 'fetch', search: currentSearch, limit: currentLimit, page: currentPage, sort_column: currentSortColumn, sort_order: currentSortOrder },
        dataType: 'json',
        success: function(response) {
            if (response.error) {
                alert('Error: ' + response.error);
                $('#tableBody').empty().append('<tr><td colspan="10" class="text-center">Error loading data.</td></tr>');
                return;
            }
            displayData(response.records);
            updatePagination(response.total_pages, response.current_page);
            updateRecordInfo(response.total_records, response.current_page);
            $('#totalRecords').text(response.total_records);
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            console.log('Response Text:', xhr.responseText);
            alert('An error occurred. Check the browser console (F12) for details.');
            $('#tableBody').empty().append('<tr><td colspan="10" class="text-center">An error occurred. Check console.</td></tr>');
        },
        complete: function() { $('#loading').hide(); }
    });
}

function displayData(records) {
    const tbody = $('#tableBody').empty();
    if (records.length === 0) {
        tbody.append('<tr><td colspan="10" class="text-center">No records found</td></tr>');
        return;
    }
    records.forEach(function(record) {
        const statusBadge = getStatusBadge(record.status);
        let truncatedMessage = (record.message || '').substring(0, 50) + (record.message && record.message.length > 50 ? '...' : '');
        if (truncatedMessage) {
            const tempDiv = document.createElement("div");
            tempDiv.innerHTML = truncatedMessage;
            truncatedMessage = tempDiv.textContent || tempDiv.innerText || "";
        }
        let attachmentCount = '<span class="badge">0</span>';
        try {
            if (record.attachments && record.attachments.trim() !== '' && record.attachments.trim() !== '[]') {
                const attachments = JSON.parse(record.attachments);
                attachmentCount = `<span class="badge badge-info">${attachments.length}</span>`;
            }
        } catch (e) {
            attachmentCount = '<span class="badge badge-danger">Invalid</span>';
        }
        
        // FIX #2: Change record.sender_id to record.sender_ID
        const row = `
            <tr>
                <td>${record.id}</td>
                <td>${record.recipient_email || ''}</td>
                <td>${record.recipient_name || ''}</td>
                <td class="text-truncate" title="${(record.subject || '').replace(/"/g, '&quot;')}">${record.subject || ''}</td>
                <td class="text-truncate" title="${(truncatedMessage || '').replace(/"/g, '&quot;')}">${truncatedMessage || ''}</td>
                <td>${statusBadge}</td>
                <td>${record.sent_at || ''}</td>
                <td>${record.sender_ID || ''}</td>
                <td>${attachmentCount}</td>
                <td>${record.created_at || ''}</td>
            </tr>
        `;
        tbody.append(row);
    });
}

function getStatusBadge(status) {
    status = status ? status.toLowerCase() : 'unknown';
    // SECONDARY FIX: Removed 'pending' case as it's not in your database ENUM
    switch(status) {
        case 'sent':
            return '<span class="badge badge-success">Sent</span>';
        case 'failed':
            return '<span class="badge badge-danger">Failed</span>';
        default:
            return '<span class="badge">' + (status.charAt(0).toUpperCase() + status.slice(1)) + '</span>';
    }
}

// ... (The rest of your JS functions: updatePagination, changePage, updateRecordInfo, updateSortIcons are correct)
function updatePagination(totalPages, currentPageNum) { const pagination = $('#pagination').empty(); if (totalPages <= 1) return; let prevDisabled = currentPageNum === 1 ? 'disabled' : ''; pagination.append(`<li class="page-item ${prevDisabled}"><a class="page-link" href="#" onclick="event.preventDefault(); changePage(${currentPageNum - 1})">&laquo;</a></li>`); let startPage = Math.max(1, currentPageNum - 2); let endPage = Math.min(totalPages, currentPageNum + 2); if (startPage > 1) { pagination.append('<li class="page-item"><a class="page-link" href="#" onclick="event.preventDefault(); changePage(1)">1</a></li>'); if (startPage > 2) { pagination.append('<li class="page-item disabled"><span class="page-link">...</span></li>'); } } for (let i = startPage; i <= endPage; i++) { let active = i === currentPageNum ? 'active' : ''; pagination.append(`<li class="page-item ${active}"><a class="page-link" href="#" onclick="event.preventDefault(); changePage(${i})">${i}</a></li>`); } if (endPage < totalPages) { if (endPage < totalPages - 1) { pagination.append('<li class="page-item disabled"><span class="page-link">...</span></li>'); } pagination.append(`<li class="page-item"><a class="page-link" href="#" onclick="event.preventDefault(); changePage(${totalPages})">${totalPages}</a></li>`); } let nextDisabled = currentPageNum === totalPages ? 'disabled' : ''; pagination.append(`<li class="page-item ${nextDisabled}"><a class="page-link" href="#" onclick="event.preventDefault(); changePage(${currentPageNum + 1})">&raquo;</a></li>`); }
function changePage(page) { let totalPages = Math.ceil(parseInt($('#totalRecords').text() || '0') / currentLimit); if (page < 1 || page > totalPages && totalPages > 0) return; currentPage = page; loadData(); }
function updateRecordInfo(totalRecords, currentPageNum) { if (totalRecords == 0) { $('#pageInfo').html('No entries found'); return; } let startRecord = (currentPageNum - 1) * currentLimit + 1; let endRecord = Math.min(currentPageNum * currentLimit, totalRecords); $('#pageInfo').html(`Showing ${startRecord} to ${endRecord} of ${totalRecords} entries`); }
function updateSortIcons() { $('.sortable i').removeClass('fa-sort-up fa-sort-down').addClass('fa-sort'); const currentHeader = $(`.sortable[data-column="${currentSortColumn}"]`); const icon = currentHeader.find('i'); icon.removeClass('fa-sort').addClass(currentSortOrder === 'ASC' ? 'fa-sort-up' : 'fa-sort-down'); }
</script>