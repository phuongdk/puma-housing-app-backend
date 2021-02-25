feather.replace();
$(document).ready(function () {
  $('#example').DataTable();

  $('#buttonMenu').on('click', function () {
    $('#sidebar-wrapper, #content-wrapper').toggleClass('show-menu');
  });
});

function createTable(element) {
  $(element).DataTable({
    aLengthMenu: [
      [5, 10, 25, 50, 100, -1],
      [5, 10, 25, 50, 100, 'All'],
    ],
    iDisplayLength: 5,
    order: [],
    dom:
      "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
      "<'row'<'col-sm-12 table-responsive'tr>>" +
      "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
  });
}
