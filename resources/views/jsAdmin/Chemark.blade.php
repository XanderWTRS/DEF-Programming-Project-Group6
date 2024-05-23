<script>
    function addStatusIcons() {
    const rows = document.querySelectorAll('tbody tr');
    rows.forEach(row => {
        const statusCell = row.querySelector('td:nth-child(2)');
        const statusIcon = statusCell.querySelector('.status-icon');
        const statusText = statusCell.textContent.trim();

        if (statusText === 'Beschikbaar') {
            statusIcon.innerHTML = '<img src="/ASSETS/Icons/Check_Mark.svg" alt="Available">';
        } else if (statusText === 'Niet Beschikbaar') {
            statusIcon.innerHTML = '<img src="/ASSETS/Icons/Cross_Mark.svg" alt="Not Available">';
        }else {
            statusIcon.innerHTML = '<img src="../../../ASSETS/Icons/kapotIcon.svg" alt="Unknown">';
        }
    });
}

addStatusIcons();
</script>