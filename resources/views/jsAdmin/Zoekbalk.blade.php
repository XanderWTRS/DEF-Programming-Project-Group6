<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchBar = document.getElementById('search-bar');
        const rows = document.querySelectorAll('tbody tr');

        function filterItems() {
            const searchText = searchBar.value.toLowerCase();
            rows.forEach(row => {
                const title = row.querySelector('td:first-child').textContent.toLowerCase();
                if (title.includes(searchText)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        searchBar.addEventListener('input', filterItems);

        function resetSearch() {
            searchBar.value = '';
            rows.forEach(row => {
                row.style.display = '';
            });
        }
        document.getElementById('reset-search-btn').addEventListener('click', resetSearch);
    });
</script>



<!--const searchBar = document.querySelector('#search-bar');

searchBar.addEventListener('keyup', () => {
    const searchText = searchBar.value;
    if (searchText) {
        searchTable(searchText);
    } else {
        resetTable();
    }
});

function searchTable(searchText) {
    const table = document.querySelector('table');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));


    while (tbody.firstChild) {
        tbody.firstChild.remove();
    }

    const matchingRows = rows.filter(row => {
        const productCellText = row.querySelector('td:nth-child(1)').textContent;
        const studentCellText = row.querySelector('td:nth-child(3)').textContent;
        return productCellText.includes(searchText) || studentCellText.includes(searchText);
    });

    matchingRows.forEach(row => {
        tbody.appendChild(row);
    });
} -->