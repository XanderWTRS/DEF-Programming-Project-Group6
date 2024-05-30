<script>
document.addEventListener('DOMContentLoaded', () => {
    let searchInput = document.getElementById('search');

    function updateSearchFunctionality() {
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
    }
    updateSearchFunctionality();

    document.getElementById('filter-button').addEventListener('click', function() {
    const weekInput = document.getElementById('week-select').value;
    if (!weekInput) {
        alert('Selecteer een week.');
        return;
    }
    
    const [year, week] = weekInput.split('-W');
    const startDate = new Date(year, 0, (1 + (week - 1) * 7));
    const endDate = new Date(startDate);
    endDate.setDate(startDate.getDate() + 6);
    
    fetch(`/filter-reservations?start=${startDate.toISOString().split('T')[0]}&end=${endDate.toISOString().split('T')[0]}`)
        .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('reservation-table-body');
                tableBody.innerHTML = '';
                data.forEach(reservation => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${reservation.name}</td>
                        <td>${reservation.product ? reservation.product.title : 'Product niet gevonden'}</td>
                        <td>${reservation.id}</td>
                        <td><input type="checkbox"></td>
                    `;
                    tableBody.appendChild(row);
                });

                updateSearchFunctionality();
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

});




</script>
