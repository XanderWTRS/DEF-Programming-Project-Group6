<script>
    
const availabilitySort = document.querySelector('#availability-sort');


availabilitySort.addEventListener('change', () => {
    const selectedValue = availabilitySort.value;
    if (selectedValue) {

        sortTable(1, selectedValue);
    } else {

        resetTable();
    }
});

function sortTable(columnIndex, selectedValue) {
    const table = document.querySelector('table');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));

    const sortedRows = rows.sort((a, b) => {
        const aColumnText = a.querySelector(`td:nth-child(${columnIndex + 1})`).textContent;
        const bColumnText = b.querySelector(`td:nth-child(${columnIndex + 1})`).textContent;

        if (aColumnText === selectedValue) {
            return -1;
        } else if (bColumnText === selectedValue) {
            return 1;
        } else {
            return 0;
        }
    });

    while (tbody.firstChild) {
        tbody.firstChild.remove();
    }


    sortedRows.forEach(row => {
        tbody.appendChild(row);
    });
}


const originalRows = Array.from(document.querySelector('tbody').querySelectorAll('tr'));

function resetTable() {
    const tbody = document.querySelector('tbody');

    while (tbody.firstChild) {
        tbody.firstChild.remove();
    }
    originalRows.forEach(row => {
        tbody.appendChild(row.cloneNode(true));
    });
}
</script>