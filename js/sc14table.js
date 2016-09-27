$(document).ready(function() {
    $('#example').dataTable( {
        columns: [
            //data is undefined when there is no "Name" for row in tabledata file
            { data: undefined },
            { data: undefined },
            // render.number parameters are ( thousands, decimal, precision, prefix, suffix )
            { data: undefined, render: $.fn.dataTable.render.number( ',', '.', 1, '', '%' )  },
            { data: undefined, render: $.fn.dataTable.render.number( ',', '.', 1, '', '%' )  },
            { data: undefined, render: $.fn.dataTable.render.number( ',', '.', 1, '', '%' )  }
        ],
        //condition for changing the cell color according to cell content
        "createdRow": function ( row, data, index ) {
            if ( data[2] < 10 ) {
                $('td', row).eq(2).addClass('red');
            }else if( data[2] >= 10 && data[2] <= 25){
                $('td', row).eq(2).addClass('amber');
            }else if( data[2] > 25){
                $('td', row).eq(2).addClass('green');
            }
            if ( data[3] < 10 ) {
                $('td', row).eq(3).addClass('red');
            }else if( data[3] >= 10 && data[3] <= 25){
                $('td', row).eq(3).addClass('amber');
            }else if( data[3] > 25){
                $('td', row).eq(3).addClass('green');
            }
            if ( data[4] < 10 ) {
                $('td', row).eq(4).addClass('red');
            }else if( data[4] >= 10 && data[4] <= 25){
                $('td', row).eq(4).addClass('amber');
            }else if( data[4] > 25){
                $('td', row).eq(4).addClass('green');
            }
        },
        "bServerSide": true,
        "sAjaxSource": "includes/sc14tabledata.php"
    } );
} );
