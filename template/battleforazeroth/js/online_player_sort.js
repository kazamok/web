document.addEventListener('DOMContentLoaded', function() {
    const tbody = document.getElementById('online-players-tbody');
    if (!tbody) return;

    let rows = Array.from(tbody.querySelectorAll('tr'));
    let currentSortColumn = null;
    let currentSortOrder = 'asc'; // 'asc' or 'desc'

    const sortableHeaders = {
        'name': document.getElementById('sort-name'),
        'level': document.getElementById('sort-level'),
        'zone': document.getElementById('sort-zone')
    };

    function getCellValue(row, key) {
        // Assuming the order of cells is: name, race, class, level, guild, zone
        // This needs to be robust. Better to use data attributes on cells if possible,
        // but for now, relying on column index.
        let cellIndex;
        switch (key) {
            case 'name':
                cellIndex = 0;
                break;
            case 'level':
                cellIndex = 3; // 0:name, 1:race_img, 2:class_img, 3:level
                break;
            case 'zone':
                cellIndex = 5; // 0:name, 1:race_img, 2:class_img, 3:level, 4:guild, 5:zone
                break;
            default:
                return '';
        }
        return row.children[cellIndex].textContent.trim();
    }

    function sortTable(columnKey) {
        if (currentSortColumn === columnKey) {
            currentSortOrder = (currentSortOrder === 'asc') ? 'desc' : 'asc';
        } else {
            currentSortColumn = columnKey;
            currentSortOrder = 'asc';
        }

        rows.sort((a, b) => {
            let valA = getCellValue(a, columnKey);
            let valB = getCellValue(b, columnKey);

            // Handle numeric sorting for level
            if (columnKey === 'level') {
                valA = parseInt(valA, 10);
                valB = parseInt(valB, 10);
            }

            if (valA < valB) {
                return currentSortOrder === 'asc' ? -1 : 1;
            }
            if (valA > valB) {
                return currentSortOrder === 'asc' ? 1 : -1;
            }
            return 0;
        });

        // Clear existing rows
        while (tbody.firstChild) {
            tbody.removeChild(tbody.firstChild);
        }

        // Append sorted rows
        rows.forEach(row => tbody.appendChild(row));
    }

    // Attach event listeners
    for (const key in sortableHeaders) {
        if (sortableHeaders[key]) {
            sortableHeaders[key].style.cursor = 'pointer'; // Indicate clickable
            sortableHeaders[key].addEventListener('click', () => sortTable(key));
        }
    }
});