<script>
let searchInput = document.getElementById('search');
let tableRows = document.querySelectorAll('table tbody tr');

searchInput.addEventListener('input', function() {
    let searchValue = searchInput.value.toLowerCase();

    for (let row of tableRows) {
        let productName = row.cells[1].textContent.toLowerCase();

        if (productName.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    }
});

document.addEventListener('DOMContentLoaded', function () {
      $('#editModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget);
          var id = button.data('id');
          var title = button.data('title');
          var beschrijving = button.data('beschrijving');
          var category = button.data('category');
          var merk = button.data('merk');

          
          var modal = $(this);
          modal.find('#itemId').val(id);
          modal.find('#itemTitle').val(title);
          modal.find('#itemBeschrijving').val(beschrijving);
          modal.find('#itemCategory').val(category);
          modal.find('#itemMerk').val(merk);
      });

      $('#saveChanges').on('click', function () {
          $('#editForm').submit();
      });
});

document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(event) {
        const confirmDelete = confirm('Weet je zeker dat je dit product wilt verwijderen?');
        if (!confirmDelete) {
            event.preventDefault();
        }
    });
});
</script>
