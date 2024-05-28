
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
