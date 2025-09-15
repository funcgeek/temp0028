<!--sidebar end-->
<!--main content start-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<section id="main-content"> 
    <section class="wrapper site-min-height">           
        <style>         
            .panel-heading{
                margin-bottom: 20px;
            }             
            .state-overview .value h1 {
                font-weight: bold;
                font-size: 18px;
                margin-top: 5px;
            }
            
            /* Enhanced Analytics Styles */
            .analytics-header {
                background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
                color: white;
                padding: 20px;
                border-radius: 10px;
                margin-bottom: 20px;
                text-align: center;
            }
            
            .filters-container {
                background: #f8f9fa;
                padding: 20px;
                border-radius: 10px;
                margin-bottom: 20px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                gap: 15px;
            }
            
            .filter-group {
                display: flex;
                align-items: center;
                gap: 10px;
            }
            
            .filter-group label {
                font-weight: 600;
                color: #495057;
            }
            
            .period-select, .export-btn {
                padding: 8px 15px;
                border: 2px solid #e9ecef;
                border-radius: 6px;
                font-size: 14px;
                transition: all 0.3s ease;
            }
            
            .period-select:focus {
                outline: none;
                border-color: #4facfe;
                box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
            }
            
            .export-btn {
                background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
                color: white;
                border: none;
                cursor: pointer;
                font-weight: 600;
                margin-left: 5px;
            }
            
            .export-btn.pdf {
                background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
            }
            
            .export-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            }
            
            .enhanced-stats-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 20px;
                margin-bottom: 30px;
            }
            
            .enhanced-stat-card {
                background: white;
                padding: 25px;
                border-radius: 15px;
                box-shadow: 0 8px 25px rgba(0,0,0,0.1);
                border-left: 5px solid;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }
            
            .enhanced-stat-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 15px 35px rgba(0,0,0,0.15);
            }
            
            .enhanced-stat-card.primary { border-color: #4facfe; }
            .enhanced-stat-card.success { border-color: #28a745; }
            .enhanced-stat-card.warning { border-color: #ffc107; }
            .enhanced-stat-card.danger { border-color: #dc3545; }
            .enhanced-stat-card.info { border-color: #17a2b8; }
            
            .stat-icon {
                position: absolute;
                top: 20px;
                right: 20px;
                font-size: 2.5em;
                opacity: 0.2;
            }
            
            .stat-value {
                font-size: 2.8em;
                font-weight: bold;
                margin-bottom: 10px;
                color: #2c3e50;
            }
            
            .stat-label {
                color: #6c757d;
                font-size: 1.1em;
                font-weight: 500;
            }
            
            .charts-container {
                display: grid;
                grid-template-columns: 2fr 1fr;
                gap: 30px;
                margin-bottom: 30px;
            }
            
            .chart-panel {
                background: white;
                padding: 25px;
                border-radius: 15px;
                box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            }
            
            .chart-title {
                font-size: 1.4em;
                font-weight: 600;
                margin-bottom: 20px;
                color: #2c3e50;
                border-bottom: 2px solid #e9ecef;
                padding-bottom: 10px;
            }
            
            .sales-table-container {
                background: white;
                border-radius: 15px;
                box-shadow: 0 8px 25px rgba(0,0,0,0.1);
                overflow: hidden;
                margin-top: 20px;
            }
            
            .table-header {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 20px 25px;
                font-size: 1.3em;
                font-weight: 600;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            
            .enhanced-table {
                width: 100%;
                border-collapse: collapse;
            }
            
            .enhanced-table th, .enhanced-table td {
                padding: 15px;
                text-align: left;
                border-bottom: 1px solid #e9ecef;
            }
            
            .enhanced-table th {
                background: #f8f9fa;
                font-weight: 600;
                color: #495057;
                position: sticky;
                top: 0;
            }
            
            .enhanced-table tr:hover {
                background: #f8f9fa;
                transform: scale(1.01);
                transition: all 0.2s ease;
            }
            
            .loading-spinner {
                text-align: center;
                padding: 50px;
                color: #6c757d;
            }
            
            .spinner {
                border: 4px solid #f3f3f3;
                border-top: 4px solid #4facfe;
                border-radius: 50%;
                width: 50px;
                height: 50px;
                animation: spin 1s linear infinite;
                margin: 0 auto 20px;
            }
            
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
            
            .currency {
                color: #28a745;
                font-weight: bold;
            }
            
            .badge {
                padding: 6px 12px;
                border-radius: 20px;
                font-size: 0.85em;
                font-weight: 600;
            }
            
            .badge.success { background: #d4edda; color: #155724; }
            .badge.warning { background: #fff3cd; color: #856404; }
            .badge.danger { background: #f8d7da; color: #721c24; }
            .badge.info { background: #d1ecf1; color: #0c5460; }
            
            @media (max-width: 768px) {
                .charts-container {
                    grid-template-columns: 1fr;
                }
                
                .filters-container {
                    flex-direction: column;
                    align-items: stretch;
                }
                
                .filter-group {
                    justify-content: space-between;
                }
                
                .enhanced-stats-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>

        <!--state overview start-->
        <div class="col-md-12">
            <!-- Enhanced Header -->
            <div class="analytics-header">
                <h1><i class="fa fa-line-chart"></i> Ispecs Frame Sales Analytics</h1>
                <p>Real-time insights and comprehensive analytics for Ispecs Appeal Jamaica</p>
            </div>

            <!-- Filters Section -->
            <div class="filters-container">
                <div class="filter-group">
                    <label for="periodSelect">Time Period:</label>
                    <select id="periodSelect" class="period-select">
                        <option value="24h">Last 24 Hours</option>
                        <option value="7d">Last 7 Days</option>
                        <option value="30d" selected>Last 30 Days</option>
                        <option value="3m">Last 3 Months</option>
                        <option value="6m">Last 6 Months</option>
                        <option value="1y">Last Year</option>
                    </select>
                </div>
                <div class="filter-group">
                    <button class="export-btn" onclick="exportToCSV()">
                        <i class="fa fa-download"></i> Export CSV
                    </button>
                    <button class="export-btn pdf" onclick="exportToPDF()">
                        <i class="fa fa-file-pdf-o"></i> Export PDF
                    </button>
                    <button class="export-btn" onclick="refreshData()" style="background: #6c757d;">
                        <i class="fa fa-refresh"></i> Refresh
                    </button>
                </div>
            </div>

            <!-- Enhanced Statistics Cards -->
            <div class="enhanced-stats-grid">
                <div class="enhanced-stat-card primary">
                    <div class="stat-icon"><i class="fa fa-dollar"></i></div>
                    <div class="stat-value" id="todaySales">$0.00</div>
                    <div class="stat-label">Today's Sales</div>
                </div>
                
                <div class="enhanced-stat-card success">
                    <div class="stat-icon"><i class="fa fa-shopping-cart"></i></div>
                    <div class="stat-value" id="totalOrders">0</div>
                    <div class="stat-label">Total Orders</div>
                </div>
                
                <div class="enhanced-stat-card info">
                    <div class="stat-icon"><i class="fa fa-eye"></i></div>
                    <div class="stat-value" id="totalFrames">0</div>
                    <div class="stat-label">Total Frames</div>
                </div>
                
                <div class="enhanced-stat-card warning">
                    <div class="stat-icon"><i class="fa fa-exclamation-triangle"></i></div>
                    <div class="stat-value" id="outOfStock">0</div>
                    <div class="stat-label">Out of Stock</div>
                </div>
                
                <div class="enhanced-stat-card danger">
                    <div class="stat-icon"><i class="fa fa-cubes"></i></div>
                    <div class="stat-value" id="totalQuantity">0</div>
                    <div class="stat-label">Total Quantity</div>
                </div>
            </div>

            <!-- Charts Section -->
            <!--<div class="charts-container">-->
            <!--    <div class="chart-panel">-->
            <!--        <div class="chart-title">Sales Trend Analysis</div>-->
            <!--        <canvas id="salesChart" height="300"></canvas>-->
            <!--    </div>-->
                
                <div class="chart-panel">
                    <div class="chart-title">Top Selling Frames</div>
                    <canvas id="topFramesChart" height="300"></canvas>
                </div>
            </div>

            <!-- Sales Table -->
            <div class="sales-table-container">
                <div class="table-header">
                    <span><i class="fa fa-table"></i> Recent Frame Sales</span>
                    <span id="recordCount">Loading...</span>
                </div>
                
                <div class="loading-spinner" id="tableLoading">
                    <div class="spinner"></div>
                    <p>Loading sales data...</p>
                </div>
                
                <table class="enhanced-table" id="salesTable" style="display: none;">
                    <thead>
                        <tr>
                            <th>Invoice #</th>
                            <th>Date</th>
                            <th>Patient</th>
                            <th>Frame</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody id="salesTableBody">
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</section>

<script>
// Analytics Dashboard JavaScript
class FrameAnalyticsDashboard {
    constructor() {
        this.apiUrl = 'https://secure-emr.ispecsappeal.net/NEWEMR/frames_sales_report.php';
        this.currentPeriod = '30d';
        this.salesChart = null;
        this.topFramesChart = null;
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.loadAllData();
    }

    setupEventListeners() {
        document.getElementById('periodSelect').addEventListener('change', (e) => {
            this.currentPeriod = e.target.value;
            this.loadAllData();
        });
    }

    async loadAllData() {
        try {
            await Promise.all([
                this.loadTodayStats(),
                this.loadFrameStats(),
                this.loadSalesChart(),
                this.loadTopFramesChart(),
                this.loadSalesTable()
            ]);
        } catch (error) {
            console.error('Error loading data:', error);
        }
    }

    async fetchData(action, params = {}) {
        const url = new URL(this.apiUrl, window.location.origin);
        url.searchParams.append('action', action);
        Object.keys(params).forEach(key => {
            url.searchParams.append(key, params[key]);
        });

        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return await response.json();
    }

    async loadTodayStats() {
        try {
            const data = await this.fetchData('today_sales');
            document.getElementById('todaySales').textContent = 
                '$' + (parseFloat(data.total_sales || 0)).toLocaleString('en-US', {minimumFractionDigits: 2});
            document.getElementById('totalOrders').textContent = data.total_orders || 0;
        } catch (error) {
            console.error('Error loading today stats:', error);
        }
    }

    async loadFrameStats() {
        try {
            const data = await this.fetchData('frame_stats');
            document.getElementById('totalFrames').textContent = data.total_frames || 0;
            document.getElementById('outOfStock').textContent = data.out_of_stock || 0;
            document.getElementById('totalQuantity').textContent = 
                parseInt(data.total_quantity || 0).toLocaleString();
        } catch (error) {
            console.error('Error loading frame stats:', error);
        }
    }

    async loadSalesChart() {
        try {
            const data = await this.fetchData('chart_data', { period: this.currentPeriod });
            this.renderSalesChart(data);
        } catch (error) {
            console.error('Error loading sales chart:', error);
        }
    }

    async loadTopFramesChart() {
        try {
            const data = await this.fetchData('top_frames', { 
                period: this.currentPeriod, 
                limit: 5 
            });
            this.renderTopFramesChart(data);
        } catch (error) {
            console.error('Error loading top frames chart:', error);
        }
    }

    async loadSalesTable() {
        try {
            document.getElementById('tableLoading').style.display = 'block';
            document.getElementById('salesTable').style.display = 'none';
            
            const data = await this.fetchData('sales_data', { period: this.currentPeriod });
            this.renderSalesTable(data);
            
            document.getElementById('recordCount').textContent = `${data.length} records`;
            document.getElementById('tableLoading').style.display = 'none';
            document.getElementById('salesTable').style.display = 'table';
        } catch (error) {
            console.error('Error loading sales table:', error);
            document.getElementById('tableLoading').innerHTML = 
                '<p style="color: #dc3545;">Error loading data. Please try again.</p>';
        }
    }

    renderSalesChart(data) {
        const ctx = document.getElementById('salesChart').getContext('2d');
        
        if (this.salesChart) {
            this.salesChart.destroy();
        }

        this.salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.map(item => item.period_label),
                datasets: [{
                    label: 'Sales ($)',
                    data: data.map(item => parseFloat(item.total_sales || 0)),
                    borderColor: '#4facfe',
                    backgroundColor: 'rgba(79, 172, 254, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Orders',
                    data: data.map(item => parseInt(item.total_orders || 0)),
                    borderColor: '#00f2fe',
                    backgroundColor: 'rgba(0, 242, 254, 0.1)',
                    tension: 0.4,
                    yAxisID: 'y1'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Sales Amount ($)'
                        }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Number of Orders'
                        },
                        grid: {
                            drawOnChartArea: false,
                        },
                    }
                }
            }
        });
    }

    renderTopFramesChart(data) {
        const ctx = document.getElementById('topFramesChart').getContext('2d');
        
        if (this.topFramesChart) {
            this.topFramesChart.destroy();
        }

        this.topFramesChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: data.map(item => item.name),
                datasets: [{
                    data: data.map(item => parseInt(item.total_sold)),
                    backgroundColor: [
                        '#4facfe',
                        '#00f2fe',
                        '#667eea',
                        '#764ba2',
                        '#f093fb'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }

    renderSalesTable(data) {
        const tbody = document.getElementById('salesTableBody');
        tbody.innerHTML = '';

        data.forEach(row => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td><strong>#${row.id}</strong></td>
                <td>${new Date(row.date * 1000).toLocaleDateString()}</td>
                <td>${row.patient_name || 'N/A'}</td>
                <td>${row.frame_name || 'N/A'}</td>
                <td><span class="badge info">${row.category || 'N/A'}</span></td>
                <td>${row.quantity || 0}</td>
                <td class="currency">$${parseFloat(row.gross_total || 0).toLocaleString('en-US', {minimumFractionDigits: 2})}</td>
                <td>${row.location || 'N/A'}</td>
            `;
            tbody.appendChild(tr);
        });
    }
}

// Export Functions
async function exportToCSV() {
    try {
        const period = document.getElementById('periodSelect').value;
        window.open(`https://secure-emr.ispecsappeal.net/NEWEMR/frames_sales_report.php?action=export_csv&period=${period}`, '_blank');
    } catch (error) {
        alert('Error exporting CSV: ' + error.message);
    }
}

async function exportToPDF() {
    try {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        
        // Add title
        doc.setFontSize(20);
        doc.text('Frame Sales Analytics Report', 20, 20);
        
        // Add date
        doc.setFontSize(12);
        doc.text(`Generated on: ${new Date().toLocaleDateString()}`, 20, 35);
        
        // Add stats
        const todaySales = document.getElementById('todaySales').textContent;
        const totalOrders = document.getElementById('totalOrders').textContent;
        const totalFrames = document.getElementById('totalFrames').textContent;
        
        doc.text(`Today's Sales: ${todaySales}`, 20, 55);
        doc.text(`Total Orders: ${totalOrders}`, 20, 70);
        doc.text(`Total Frames: ${totalFrames}`, 20, 85);
        
        // Save the PDF
        doc.save('frame-sales-report.pdf');
    } catch (error) {
        alert('Error generating PDF: ' + error.message);
    }
}

function refreshData() {
    if (window.dashboard) {
        window.dashboard.loadAllData();
    }
}

// Initialize Dashboard
document.addEventListener('DOMContentLoaded', function() {
    window.dashboard = new FrameAnalyticsDashboard();
});
</script>