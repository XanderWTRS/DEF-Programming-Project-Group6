<script>
    
let searchInput = document.getElementById('search');
let tableRows = document.querySelectorAll('table tbody tr');

searchInput.addEventListener('input', function() {
    let searchValue = searchInput.value.toLowerCase();

    for (let row of tableRows) {
        let studentName = row.cells[0].textContent.toLowerCase();

        if (studentName.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    }
});
</script>