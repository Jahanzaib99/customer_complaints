@extends('layouts.app')

@section('content')
    <div class="content">
        <h2 class="mb-4">Complaints</h2>
        <div class="btn-group">
            <button type="button" class="btn btn-success">Update status</button>
            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a class="update-status">RESOLVED</a></li>
                <li><a class="update-status">ACTIVE</a></li>
                <li><a class="update-status">UNASSIGNED</a></li>
            </ul>
        </div>
        <table class="table table-bordered " id="yajra-datatable">
            <thead>
                <tr>
                    <th>
                        <input type="checkbox" name="checkbox" id="MyTableCheckAllButton">
                    </th>
                    <th>No</th>
                    <th>Email</th>
                    <th>Description</th>
                    <th>Phone</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@stop
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
        integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            let myTable = $('#yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('complaints.index') }}",
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                }],
                columns: [{
                        data: 'select_complaints',
                        name: 'select_complaints',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                ],
                select: {
                    style: 'os', // 'single', 'multi', 'os', 'multi+shift'
                    selector: 'td:first-child',
                },
                order: [
                    [1, 'asc'],
                ],
            });

            $('#MyTableCheckAllButton').click(function(event) {
                // event.preventDefault();
                if ($(this).is(":checked")) {
                    $('.select-checkbox').prop('checked', true);
                } else {
                    $('.select-checkbox').prop('checked', false);
                }
            });

            $('.update-status').click(function(event) {
                event.preventDefault();
                var SlectedList = new Array();
                $('input[name="registrations"]:checked').each(function() {
                    // if($(this).is(':checked'))
                    SlectedList.push($(this).val());
                });
                console.log(SlectedList);
                $.ajax({
                    type: "POST",
                    url: "{{ route('complaints.update') }}",
                    data: {
                        id: SlectedList,
                        status: $(this).text(),
                        _token: "{{ csrf_token() }}"
                    },

                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
        });
    </script>
@stop
