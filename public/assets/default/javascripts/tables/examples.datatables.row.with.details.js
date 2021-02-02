/*
Name: 			Tables / Advanced - Examples
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version: 	1.4.1
*/
/*
(function( $ ) {

	var datatableInit = function() {
		var $table = $('#datatable-details');

		// initialize
		var datatable = $table.dataTable({
            language: {
                search: "_INPUT_",
                searchPlaceholder: "جستجو..."
            }
		});

	};

	$(function() {
		datatableInit();
	});

}).apply( this, [ jQuery ]);
	*/


$('#datatable-details').dataTable( {
    "bLengthChange": false,
    "ordering": false,
    language: {
        searchPlaceholder: "جستجو...",
        "info":           "نمایش _START_ تا _END_ از _TOTAL_ آیتم",
        "infoFiltered":   "(نتیجه از _MAX_ آیتم)",
        "infoEmpty":      "",
        "zeroRecords":    "هیچ اطلاعاتی یافت نشد",
    }
} );

$('#datatable-basic').dataTable( {
    "bLengthChange": false,
    "ordering": false,
    "searching": false,
    "bPaginate": false,
    language: {
        searchPlaceholder: "جستجو...",
        "info":           "نمایش _START_ تا _END_ از _TOTAL_ آیتم",
        "infoFiltered":   "(نتیجه از _MAX_ آیتم)",
        "infoEmpty":      "",
        "zeroRecords":    "هیچ اطلاعاتی یافت نشد",
    }
} );
