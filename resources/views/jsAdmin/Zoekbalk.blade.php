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