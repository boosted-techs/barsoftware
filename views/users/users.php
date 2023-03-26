<?php
include_once "views/headers/index.php";
include_once "views/headers/header.php";
?>
<div class="body d-flex py-lg-3 py-md-2">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h3 class="fw-bold mb-0">Users</h3>
                    <div class="col-auto d-flex w-sm-100">
                        <button type="button" class="btn btn-primary btn-set-task w-sm-100" data-bs-toggle="modal" data-bs-target="#expadd"><i class="icofont-plus-circle me-2 fs-6"></i>Add User</button>
                    </div>
                </div>
            </div>
        </div> <!-- Row end  -->
        <div class="row clearfix g-3">
            <?php
            if (isset($_SESSION['error_message'])):
                ?>
                <div class="col-12 alert alert-info"><?=$_SESSION['error_message']?></div>
                <?php
                unset($_SESSION['error_message']);
            endif;
            ?>
            <div class="col-sm-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>User</th>

                                <th>Mail</th>

                                <th>Total Orders</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($users as $item) :
                            ?>
                            <tr <?=$item['access'] == 2 ? "class='alert alert-danger'" : ''?>>
                                <td><strong>#U-<?=$item['id']?></strong></td>
                                <td>
                                    <a href="/users/<?=$item['id']?>/orders">
                                        <img class="avatar rounded" src="https://www.pixelwibes.com/template/ebazar/html/dist/assets/images/xs/avatar1.svg" alt="">
                                        <span class="fw-bold ms-1"><?=$item['name']?></span>

                                        ::<small class="text-muted"><?=$item['role']?></small>
                                    </a>
                                </td>
                                <td><?=$item['email']?></td>

                                <td>
                                    <?=$item['orders'] ?>
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                        <button type="button" class="btn btn-outline-secondary" onclick='editUser(<?= json_encode($item) ?>)'><i class="icofont-edit text-success"></i></button>
                                        <button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            endforeach;
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- Row End -->
    </div>
</div>
<form action="/users/create" method="post">
<div class="modal fade" id="expadd" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  fw-bold" id="expaddLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="deadline-form">

                        <div class="row g-3 mb-3">
                            <div class="col-sm-12">
                                <label for="item" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="item" required>
                            </div>

                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-sm-6">
                                <label for="abc11" class="form-label">Mail</label>
                                <input type="text" name="email" class="form-control" id="abc11" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="abc111" class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" id="abc111" required>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-sm-12">
                                <label class="form-label">Password</label>
                                <input type="text"  name="password" class="form-control">
                            </div>
                        </div>
                    <div class="row g-3 mb-3">
                        <div class="col-sm-12">
                            <label class="form-label">Role</label>
                            <select class="form-control" name="role">
                                <option value="receptionist" selected>Receptionist</option>
                                <option value="cashier" >Cashier</option>
                                <option value="admin" >Administrator</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>

        </div>
    </div>
</div>
</form>
<form action="/users/edit" method="post">
    <div class="modal fade" id="expedit" tabindex="-1"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="expeditLabel"> Edit Customers</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="deadline-form">
                        <form>
                            <div class="row g-3 mb-3">
                                <div class="col-sm-12">
                                    <label for="item1" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="names" name="name" value="Cloth">
                                </div>

                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-sm-6">
                                    <label for="mailid" class="form-label">Mail</label>
                                    <input type="text" class="form-control" id="mailid" name="email" value="PhilGlover@gmail.com">
                                </div>
                                <div class="col-sm-6">
                                    <label for="phoneid" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="phoneid" name="phone" value="843-555-0175">
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-sm-12">
                                    <label class="form-label">Role</label>
                                    <select class="form-control" name="role" id="role">
                                        <option value="receptionist" selected>Receptionist</option>
                                        <option value="cashier" >Cashier</option>
                                        <option value="admin" >Administrator</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-sm-12">
                                    <label class="form-label">Access</label>
                                    <select class="form-control" name="access" id="access">
                                        <option value="1" selected>Access</option>
                                        <option value="2">Banned</option>

                                    </select>
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-sm-12">
                                    <label class="form-label">Update Password</label>
                                    <input type="checkbox" name="checkbox">
                                    <input type="text" class="form-control" name="password">
                                </div>
                            </div>
                            <input type="hidden" name="user" id="userid">
                        </form>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>


<?php
include_once "views/headers/footer.php";
?>
<script>
    $('#myProjectTable')
        .addClass('nowrap')
        .dataTable({
            responsive: true,
            columnDefs: [
                { targets: [-1, -3], className: 'dt-body-right' }
            ],
            ordering: false // add this line to disable sorting
        });
</script>


<?php
include_once "views/headers/footer.php";
?>
<script>
    $('#myDataTable')
        .addClass('nowrap')
        .dataTable({
            responsive: true,
            columnDefs: [
                { targets: [-1, -3], className: 'dt-body-right' }
            ],
            ordering: false // add this line to disable sorting
        });
</script>

<script>

    function editUser(user) {
        $('#expedit').modal('toggle');

        // Get references to the input fields
        const nameInput = document.querySelector('#names');
        const emailInput = document.querySelector('#mailid');
        const phoneInput = document.querySelector('#phoneid');
        const roleSelect = document.querySelector('#role');
        const accessSelect = document.querySelector('#access');
        const userId = document.querySelector("#userid")

        // Set the values of the input fields based on the user object
        nameInput.value = user.name;
        emailInput.value = user.email;
        phoneInput.value = user.phone;
        roleSelect.value = user.role;
        accessSelect.value = user.access;
        userId.value = user.id
    }

</script>
