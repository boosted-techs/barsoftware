<?php
include_once "views/headers/index.php";
include_once "views/headers/header.php";
?>
<div class="body d-flex py-lg-3 py-md-2">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h3 class="fw-bold mb-0">Customers Information</h3>
                    <div class="col-auto d-flex w-sm-100">
                        <button type="button" class="btn btn-primary btn-set-task w-sm-100" data-bs-toggle="modal" data-bs-target="#expadd"><i class="icofont-plus-circle me-2 fs-6"></i>Add Customers</button>
                    </div>
                </div>
            </div>
        </div> <!-- Row end  -->
        <div class="row clearfix g-3">
            <div class="col-sm-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Customers</th>
                                <th>Register  Date</th>
                                <th>Mail</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Total Order</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($customers as $item) :
                            ?>
                            <tr>
                                <td><strong>#CS-<?=$item['id']?></strong></td>
                                <td>
                                    <a href="/customers/<?=$item['id']?>/orders">
                                        <img class="avatar rounded" src="https://www.pixelwibes.com/template/ebazar/html/dist/assets/images/xs/avatar1.svg" alt="">
                                        <span class="fw-bold ms-1"><?=$item['name']?></span>
                                    </a>
                                </td>
                                <td>
                                    <?=$item['created_at']?>
                                </td>
                                <td><?=$item['email']?></td>
                                <td><?=$item['phone']?></td>
                                <td><?=$item['address']?></td>
                                <td>
                                    <?=$item['pending_orders'] + $item['approved_orders'] + $item['rejected_orders']?>
                                    <br/>
                                    <b class="text-success">Approved </b>: <?=$item['approved_orders']?>
                                    <br/>
                                    <b class="text-warning">Pending :</b> <?=$item['pending_orders']?>
                                    <br/>
                                    <b class="text-danger">Rejected</b> : <?=$item['rejected_orders']?>
                                </td>
                                <td>

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
