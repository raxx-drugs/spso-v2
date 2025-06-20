
<!-- DataTables + Bootstrap 5 + Extensions CSS Bundle -->
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/moment-2.29.4/jszip-3.10.1/dt-2.3.1/b-3.2.3/b-html5-3.2.3/cc-1.0.0/date-1.5.5/fh-4.0.2/r-3.0.4/sl-3.0.1/datatables.min.css"
      rel="stylesheet"
      integrity="sha384-HyfD4HlD5WY6RPOkcYJVrCz2VAQL95xeYnlaysFbK6Z83ap2rpPiqPRXSXLFHTVk"
      crossorigin="anonymous">
<!-- Custom DataTables Styling (Optional Overrides) -->
<link href="<?= base_url('assets/css/partials/datatable.css') ?>?v=1" rel="stylesheet" />

      
<!-- HTML Table Structure -->
<table id="<?= esc($tableId ?? 'defaultTable') ?>" class="display table dataTable">
    <thead>
        <tr>
            <?php foreach ($columns as $col): ?>
                <th><?= esc($col) ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
</table>

<!-- DataTables Required JS Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js" integrity="sha384-VFQrHzqBh5qiJIU0uGU5CIW3+OWpdGGJM9LBnGbuIH2mkICcFZ7lPd/AAtI7SNf7" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js" integrity="sha384-/RlQG9uf0M2vcTw3CX7fbqgbj/h8wKxw7C3zu9/GxcBPRKOEcESxaxufwRXqzq6n" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/moment-2.29.4/jszip-3.10.1/dt-2.3.1/b-3.2.3/b-html5-3.2.3/cc-1.0.0/date-1.5.5/fh-4.0.2/r-3.0.4/sl-3.0.1/datatables.min.js"
        integrity="sha384-ptJlRFVx1sv9UYAFfzrlQiDMNeid9cal/WEhP94cAodep5FrOZMiK9gQJ8p0jcX4"
        crossorigin="anonymous"></script>

<!-- DataTable Initialization Script -->
<script>
    $(document).ready(function () {
        const tableSelector = '#<?= esc($tableId ?? 'defaultTable') ?>';
        const dataUrl = '<?= esc($dataUrl) ?>';

        // Automatically disable ordering and searching for columns labeled "Actions"
        const columnDefs = [];
        $(`${tableSelector} thead th`).each(function (index) {
            const col = $(this).text().trim().toLowerCase();
            columnDefs.push(col === 'actions' || col === 'action' ? {
                targets: index,
                orderable: false,
                searchable: false,
                className: 'text-center'
            } : {});
        });



        // Initialize DataTable
        $(tableSelector).DataTable({
            renderer: 'bootstrap',
            // Load data from server-side endpoint
            ajax: {
                url: dataUrl,
                type: "GET"
            },

            // UI and functionality settings
            responsive: true,              // Make table responsive on all devices
            processing: true,              // Show loading indicator
            // serverSide: true,              // Enable server-side processing
            paging: true,                  // Enable pagination
            pageLength: 8,                // Default rows per page
            searching: true,               // Enable search bar

            // Scroll settings for better UX on long lists
            
            scrollCollapse: true,         // Collapse height if fewer rows
            scroller: true,               // Optimize rendering for large data

            // Column-specific behavior (like disabling actions from sort/search)
            columnDefs: columnDefs,

            // Custom message when no data is available
            language: {
                pageLength: {
                    _: "Showing %d rows per page",
                    '-1': "Show all rows"
                },
                search: "", // Removes the "Search:" label
                emptyTable: "No data available"
            },

            // Keep header/footer fixed during vertical scroll
            fixedHeader: {
                header: true,
                footer: true
            },

            // Layout positions using DataTables v2 modular API
            layout: {
                topStart: {
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'] // Export buttons
                },
                topEnd: {
                    search:true, // Search box aligned right
                },       // Search box aligned right
                mid: 'table',           // Table content in the middle
                bottomStart: 'info', // Page size selector
                bottomEnd: 'paging'     // Pagination aligned right
            },

            // Called every time DataTable redraws (e.g., after sort or search)
            drawCallback: function (settings) {
                padEmptyRows();
            }
        });
        // Set custom placeholder after rendering
        setTimeout(() => {
            const $searchInput = $('.dt-search input[type="search"]');
            $searchInput.attr('placeholder', '🔍 Search...');
        }, 200); // Wait for the input to appear
    });

function padEmptyRows() {
    const table = document.querySelector('#<?= esc($tableId ?? 'defaultTable') ?>');
    const tbody = table.querySelector('tbody');

    // Remove any previously added padding rows
    tbody.querySelectorAll('tr.empty-row').forEach(row => row.remove());

    // Count real (non-padding) rows
    const realRows = Array.from(tbody.querySelectorAll('tr'))
        .filter(row => !row.classList.contains('empty-row')).length;

    const rowsNeeded = 8 - realRows;
    if (rowsNeeded <= 0) return;

    // Calculate the target height for each row (at least 40px)
    const totalHeight = tbody.offsetHeight;
    let calculatedHeight = totalHeight / 8;
    calculatedHeight = Math.max(40, calculatedHeight); // Ensure minimum of 40px

    const colCount = table.querySelectorAll('thead th').length;

    for (let i = 0; i < rowsNeeded; i++) {
        const tr = document.createElement('tr');
        tr.classList.add('empty-row');
        tr.style.height = `${calculatedHeight}px`;

        for (let j = 0; j < colCount; j++) {
            const td = document.createElement('td');
            td.innerHTML = '&nbsp;';
            tr.appendChild(td);
        }

        tbody.appendChild(tr);
    }
}


</script>
