$(function() {
    $('.js-basic-example').DataTable();

    $('.js-basic-example-category').DataTable({
        order: [
            [3, 'asc']
        ],
    });

    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});