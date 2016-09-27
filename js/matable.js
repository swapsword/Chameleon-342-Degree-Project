$(document).ready(function() {
    $('#example').dataTable( {
        columns: [
            //data is undefined when there is no "Name" for row in tabledata file
            { data: undefined },
            { data: undefined },
            { data: undefined },
            { data: undefined },
            { data: undefined },
            { data: undefined },
            { data: undefined },
            { data: undefined },
            { data: undefined },
            // render.number parameters are ( thousands, decimal, precision, prefix, suffix )
            { data: undefined, render: $.fn.dataTable.render.number( ',', '.', 0, '$' )  },
            { data: undefined, render: $.fn.dataTable.render.number( ',', '.', 0, '$' )  }
        ],
        "scrollX": true,
        "bServerSide": true,
        "sAjaxSource": "includes/matabledata.php"
    } );
} );
