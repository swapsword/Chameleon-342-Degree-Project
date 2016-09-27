$(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: true
    } );
    table.buttons().container()
        .insertBefore( '#example_filter' );
} );
