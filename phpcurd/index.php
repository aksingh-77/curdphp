<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

	<!-- CDN for jquery -->
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


    

	<!-- CDN for Bootstrap -->
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

	<!-- CDN for datatable -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>


	<!-- CDN for Datepicker -->
	
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


    <!-- CDN FOR JQURY ROEREORDERING -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.1.0/js/dataTables.dateTime.min.js"></script>


    <!-- Css required for ROWReording -->
    <link href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
    <link href="css/editor.dataTable.css">
    <link href="css/editor.dataTable.min.css">

    
    


	<title>Employee List</title>
</head>
<body>
    <div class="container">
    	<p></p><br/>
    	<div class="card">
		    <h5 class="card-header">Employees List</h5>
		    <div class="card-body">


		    	<!-- Container to Add employes button -->
				<div class="container">
				    <div class="row justify-content-start">
				    	<!-- Add Employees Button -->
				        <div class="col card-title">
				            <a href='add_emp.php' class='btn btn-primary'>Add Employee</a>
				        </div>
                        <div class="col">
                            <button id='addrow' class='btn btn-primary' type='submit'>Add Row</button>
                        </div>
                        <div class="col">
                            <button id='clear' class='btn btn-primary' type='submit'>Clear</button>
                        </div>
                        <div class="col">
                            <button id='addrows' class='btn btn-primary' type='submit'>Add Rows</button>
                        </div>
                        <div class="col">
                            <button id='flatten' class='btn btn-primary' type='submit'>Flatten</button>
                        </div>
				    </div>


			    


			    <!-- Container to Date Picker -->
			    <div class="container">
					<div class="row justify-content-start">
					    <div class="col-4">
					      	<input type="text" name="daterange" class="form-control" placeholder="Date Range" />
					    </div>
					    <div class="col-4">
					      	<button id='reload' class='btn btn-primary' type='submit'>Reload</button>
					    </div>
					</div>
				</div>

				<br/>
				<!-- Container to datatable -->
				<div class="container">
					<table class="table table-bordered table-hover" id="datatablesSimple">
						    <thead>
							    <tr>                               
                                    <th>ID</th>
                                    <th>Order</th>
								    <th>Firstname</th>
								    <th>Lastname</th>
								    <th>Email ID</th>
								    <th>Phone</th>
								    <th>Department</th>
								    <th>Added Date</th>
								    <th>Action</th>
							    </tr>
						    </thead>
							<tfoot>
							  	<tr>
                                    <th>ID</th>
                                    <th>Order</th>
							      	<th>Firstname</th>
								    <th>Lastname</th>
								    <th>Email ID</th>
								    <th>Phone</th>
								    <th>Department</th>
								    <th>Added Date</th>
								    <th>Action</th>
							    </tr>
							</tfoot>
							
						</table>
					</div>
				</div>
		    </div>
		</div>
    </div>
    <br><br>

</body>
</html>



<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>



<script src="js/dataTables.editor.js"></script>
<script src="js/dataTables.editor.min.js"></script>





<script>
$(document).ready(function(){

    //var editor = new $.fn.dataTable.Editor( {} );

    var fromDate = "";
    var toDate = "";
    var table = $('datatablesSimple').DataTable();

    editor = new $.fn.dataTable.Editor( {
        ajax:  'json.php',
        table: '#datatablesSimple',
        fields: [ {
                label: 'Order:',
                name: 'readingOrder',
                fieldInfo: 'This field can only be edited via click and drag row reordering.'
            }, {
                label: 'Firstname:',
                name:  'firstname'
            }, {
                label: 'Lastname:',
                name:  'lastname'
            }, {
                label: 'Email ID:',
                name:  'email id'
            },
            {
                label: 'Phone :',
                name:  'phone'
            },
            {
                label: 'Department:',
                name:  'department'
            },
            {
                label: 'Added date:',
                name:  'added date'
            },
            {
                label: 'Action :',
                name:  'action'
            }
        ]
    });

    getDataTable(fromDate, toDate);


    



        editor
        .on( 'postCreate postRemove', function () {
            // After create or edit, a number of other rows might have been effected -
            // so we need to reload the table, keeping the paging in the current position
            table.ajax.reload( null, false );
        } )
        .on( 'initCreate', function () {
            // Enable order for create
            editor.field( 'readingOrder' ).enable();
        } )
        .on( 'initEdit', function () {
            // Disable for edit (re-ordering is performed by click and drag)
            editor.field( 'readingOrder' ).disable();
        } );



        



    /////////////////////----------------------ACTION BUTTON EVENTS----------------------------------//////////////////////////
    $('#datatablesSimple tbody').on( 'click', '#view_emp', function () {
            var data = table.row( $(this).parents('tr') ).data();
            var id = data.ID;
            window.location.href = "view_emp.php?id="+id;
        });


        $('#datatablesSimple tbody').on( 'click', '#edit_emp', function () {
            var data = table.row( $(this).parents('tr') ).data();
            var id = data.ID;
            window.location.href = "edit_emp.php?id="+id;
        });

        $('#datatablesSimple tbody').on( 'click', '#delete_emp', function () {
            if(confirm('R u sure')){
                var data = table.row( $(this).parents('tr') ).data();
                var id = data.ID;
                window.location.href = "controller.php?id="+id;
            }
        });


    // 

    function getDataTable(fromDate, toDate){
        var table = $('#datatablesSimple').DataTable({
            destroy : true,
            paging: true,
            // scrollX: "100%",
            "processing": true,
            "serverSide": false,
            "ajax":{
                "type" : "POST",
                "url" : "json.php",
                "dataSrc" :"" ,
                "data": {
                    "fromDate": fromDate,
                    "toDate" : toDate
                },
            },
            rowReorder: {
                dataSrc: 'readingOrder',
                editor:  editor
            },
            select: true,
            "columns": [
                { "data": "ID"},
                { data: 'readingOrder', className: 'reorder' },
                { "data": "Firstname" },
                { "data": "Lastname" },
                { "data": "Email ID" },
                { "data": "Phone" },
                { "data": "Department" },
                { "data": "Added Date" },
                { "data":null,  
                defaultContent: "<button class='btn btn-secondary btn-sm' id='view_emp'>View</button>&nbsp;<button class='btn btn-primary btn-sm' id='edit_emp'>Edit</button>&nbsp;<button class='btn btn-danger btn-sm' id='delete_emp'>Delete</button>" }

            ],
            "columnDefs": [ 
                {
                    "targets": [ 0 ],
                    "visible": false,
                    "searchable": false
                }
            ]
        });
    }

    // $( table.table().container() ).addClass( 'selectable' );
    // $( table.table().body() ).addClass( 'highlight' );

    

    
    
    
    ////////////////////--------------------showing datepicker bootstrap----------------------------////////////////////////////
    $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' to ' + picker.endDate.format('YYYY-MM-DD'));
    });


    $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });


    $('input[name="daterange"]').daterangepicker({
        opens: 'center',
        autoUpdateInput: false,
        },
        function(start, end) {
            var fromDate = start.format('YYYY-MM-DD');
            var toDate = end.format('YYYY-MM-DD');
            if(fromDate !== "" && toDate !== "") {
                getDateRangeRecord(fromDate,toDate);
            }
        }
    )




    ////////////////////---------------------ajax function call to filter on daterange-----------------------//////////////////////////////

    function getDateRangeRecord(fromDate, toDate){
        getDataTable(fromDate, toDate);    
    }
   


    //////////////--------------------ajax function to be called on reload button clicked-------------------////////////////
    $('#reload').on('click',function(){
        fromDate = "";
        toDate = "";
        getDataTable(fromDate, toDate);
    });
   


    // $('#datatablesSimple tbody').on( 'click', 'td', function () {
    //     alert( table.cell( this ).cache( 'order' ) );
    // });


    // $('#datatablesSimple tbody').on( 'click', 'td', function () {
    //     alert( table.cell( this ).data() );
    // } );


    // $('#datatablesSimple tbody').on( 'click', 'td', function () {
    //     var cell = table.cell( this );
    //     cell.data( '45654654' ).draw();
    //     // note - call draw() to update the table's draw state with the new data
    // });


    // $('#datatablesSimple tbody').on( 'click', 'td', function () {
    //     alert( 'Clicked on cell in visible column: '+table.cell( this ).index().row );
    // });

    // $('#datatablesSimple tbody').on( 'click', 'td', function () {
    //     var rowIdx = table.cell( this ).index().row;
    //     table.rows( rowIdx ).nodes().to$().addClass( 'clicked' );
    // });

    // $('#datatablesSimple tbody').on( 'click', 'td', function () {
    //     this.innerHTML = parseInt( this.innerHTML ) + 1;
    //     table.cell( this ).invalidate().draw();
    // });


    // $('#datatablesSimple').on( 'click', 'tbody td', function () {
    //     var data = table.cell( this ).render( 'type' );
    //     console.log( data );
    // });


    // $('#datatablesSimple').on( 'click', 'tbody td', function () {
    //     var idx = table.cell(this).index().column;
    //     alert( 'Data source: '+table.column( idx ).dataSrc() );
    // });
});
///////////////////////////--------------------------END OF DOCUMENT LOAD PART--------------------------------//////////////////////




///////////////////////////////-----------------------ADD rows section-------------////////////////////////////////////////
$('#addrows').on('click',function(){
    var table = $('#datatablesSimple').DataTable();
    table.rows.add( [{
        "ID" : "343434",
        "Firstname":       "Tiger",
        "Lastname":   "Nixon",
        "Email ID":     "row.add@table.com",
        "Phone": "9876543210",
        "Department":     "Admin",
        "Added Date":       "2021-06-05",
        "Action" : "Edit"
    },
    {
        "ID" : "9999",
        "Firstname":       "Naaya wala",
        "Lastname":   "jfhgfdjgh",
        "Email ID":     "rohhhw.add@table.com",
        "Phone": "98765898210",
        "Department":     "Admin",
        "Added Date":       "2021-06-05",
        "Action" : "Edit"
    }] ).draw();
})
////////////////////////////////----------------------------------------------------------------/////////////////////////////////////////







/////////////////////---------------Part od code for row.add() functionality----------------////////////
$('#addrow').on('click',function(){
    var table = $('#datatablesSimple').DataTable();
    table.row.add( {
        "ID" : "343434",
        "Firstname":       "Tiger",
        "Lastname":   "Nixon",
        "Email ID":     "row.add@table.com",
        "Phone": "9876543210",
        "Department":     "Admin",
        "Added Date":       "2021-06-05",
        "Action" : "Edit"
    } ).draw();
});
///////////////////////////-----------------------------------------------------------///////////////////////








///////////////////----------------------------------To clear table record---------------------------------///////////////////////
$('#clear').on('click',function(){
    //alert(HEllo);
    var table = $('#datatablesSimple').DataTable({
        destroy : true
    });
    table.clear().draw();

});

</script>
