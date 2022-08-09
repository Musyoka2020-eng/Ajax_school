<x-admin-layout>
    <!-- Add user modal -->
    <div class="modal fade" id="add_user">
        <div class="modal-dialog">
            <!-- form start -->
            <form>
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="card-body">
                            <div class="form-group">
                                <label for="Name">Full Name</label>
                                <input type="text" class="form-control name" id="name" placeholder="Enter fullname">
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control email" id="email" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="reg_no">Registration Number</label>
                                <input type="text" class="form-control reg_no" id="reg_no" placeholder="Enter registration number">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control password" id="password" placeholder="Password">
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-outline-light add_users">Save</button>
                    </div>

                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- End Add User modal -->

    <!-- Edit User modal -->
    <div class="modal fade" id="edit_users">
        <div class="modal-dialog">
            <!-- form start -->
            <form>
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="card-body">
                            <input type="hidden" id="user_edit_id">
                            <div class="form-group">
                                <label for="Name">Full Name</label>
                                <input type="text" class="form-control name" id="edit_name" placeholder="Enter fullname">
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control email" id="edit_email" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="reg_no">Registration Number</label>
                                <input type="text" class="form-control reg_no" id="edit_reg_no" placeholder="Enter registration number">
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-outline-light update_user">Update</button>
                    </div>

                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- End Edit User modal -->

    <!-- Delete User modal -->
    <div class="modal fade" id="delete_users">
        <div class="modal-dialog">
            <!-- form start -->
            <form>
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="card-body">
                            <input type="hidden" id="user_delete_id">
                            <h4>Are you sure? you want to delete this user?</h4>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-outline-light delete_user_now">Yes Delete</button>
                    </div>

                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- End Delete User modal -->

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users List') }}
            <a class="btn btn-primary btn-sm float-right" href="#" data-toggle="modal" data-target="#add_user">Add
                User</a>
        </h2>
    </x-slot>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Bordered Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role Id</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div>
    @section('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //view User Ajax
            showuser();

            function showuser() {

                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.users.create') }}",
                    dataType: "json",
                    success: function(response) {
                        // console.log(response.users);
                        $('tbody').html("");
                        $.each(response.users, function(key, user) {
                            $('tbody').append(
                                '<tr>\
                                <td>' +
                                user.id +
                                '</td>\
                                <td>' +
                                user.name +
                                '</td>\
                                <td>' +
                                user.email +
                                '</td>\
                                <td id="role">' +
                                user.role_id +
                                '</td>\
                                <td style="width: 200px;">\
                               <button type="button" value="' + user.id + '" class="edit_user btn btn-success btn-sm">Edit</button>\
                                <button type="button" value="' + user.id + '" class="delete_user btn btn-danger btn-sm">Delete</button>\
                               </td>\
                                 </tr>'
                            );
                        });
                    }
                });
            }
            //Edit user Ajax
            $(document).on('click', '.edit_user', function(e) {
                e.preventDefault();
                var user_id = $(this).val();
                // console.log(user_id);
                $("#edit_users").modal("show");

                $.ajax({
                    type: "GET",
                    url: "edit_user/" + user_id,
                    success: function(response) {
                        // console.log(response);
                        if (response.status == 404) {
                            toastr.error(response.message);
                        } else {
                            $('#edit_name').val(response.user.name);
                            $('#edit_email').val(response.user.email);
                            $('#edit_reg_no').val(response.user.student_reg);
                            $('#user_edit_id').val(user_id);
                        }
                    }
                });
            });
            //update User Ajax
            $(document).on('click', '.update_user', function(e) {
                e.preventDefault();
                $(this).text("Updating");
                var user_id = $('#user_edit_id').val();
                var data = {
                    'name': $('#edit_name').val(),
                    'email': $('#edit_email').val(),
                    'student_reg': $('#edit_reg_no').val(),
                }
                $.ajax({
                    type: "PUT",
                    url: "update_user/" + user_id,
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 400) {
                            $.each(response.errors, function(key, err_values) {
                                toastr.error(err_values);
                            });
                            $('.update_user').text("Update");

                        } else if (response.status == 404) {

                            toastr.error(response.message);
                            $('.update_user').text("Update");


                        } else {
                            toastr.success(response.message);
                            $('#edit_users').modal('hide');
                            $('.update_user').text("Update");
                            showuser();
                        }

                    }
                });
            });
            //Add user Ajax
            $(".add_users").click(function(e) {
                e.preventDefault();
                var data = {
                    'name': $('.name').val(),
                    'email': $('.email').val(),
                    'student_reg': $('.reg_no').val(),
                    'password': $('.password').val(),
                }

                toastr.options = {
                    "closeButton": true,
                    "newestOnTop": true,
                    "positionClass": "toast-top-right"
                };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.users.store') }}",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 400) {

                            $.each(response.errors, function(key, err_values) {
                                toastr.error(err_values);
                            });

                        } else {

                            toastr.success(response.message);
                            $('.close').click();
                            $('#add_user').find('input').val("");
                            showuser();
                        }
                    }
                });
            });
            //delete user Ajax
            $(document).on('click', '.delete_user', function(e) {
                e.preventDefault();
                var user_id = $(this).val();
                $("#user_delete_id").val(user_id);
                $("#delete_users").modal("show");
                $(".delete_user_now").click(function(e) {
                    e.preventDefault();
                    $(this).text("Deleting..");
                    var user_id = $("#user_delete_id").val();
                    $.ajax({
                        type: "DELETE",
                        url: "delete_user/" + user_id,
                        success: function(response) {

                            toastr.success(response.message);
                            $(".delete_user_now").text("Yes Delete");
                            $("#delete_users").modal("hide");
                            showuser();

                        }
                    });
                });

            });
        });
    </script>
    @endsection
</x-admin-layout>