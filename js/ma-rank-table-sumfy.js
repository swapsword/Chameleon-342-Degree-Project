$(document).ready(function() {
    $('#example4').dataTable( {
        columns: [
            //data is undefined when there is no "Name" for row in tabledata file
            { data: undefined },
            // render.number parameters are ( thousands, decimal, precision, prefix, suffix )
            { data: undefined, render: $.fn.dataTable.render.number( ',', '.', 0, '$' )  },
            { data: undefined, render: $.fn.dataTable.render.number( ',', '.', 1, '', '%' )  },
            { data: undefined }
        ],
        "bServerSide": true,
        "sAjaxSource": "includes/ma-rank-tabledata-sumfy.php"
    } );
} );
