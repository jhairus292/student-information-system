// Ask for confirmation before deleting a record
document.querySelectorAll('form[data-confirm]').forEach(function (form) {
  form.addEventListener('submit', function (event) {
    if (!confirm(form.dataset.confirm)) event.preventDefault();
  });
});
