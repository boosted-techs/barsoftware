<?php
include_once "views/headers/index.php";
include_once "views/headers/header.php";
?>
    <!-- Body: Body -->
    <div class="body d-flex py-3">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0">Invoices</h3>
                    </div>
                </div>
            </div> <!-- Row end  -->
            <div class="row g-3 mb-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Item</th>
                                    <Th></Th>
                                    <th>Customer Name</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>User</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($orders as $order) :
                                ?>
                                <tr class="<?=$order['status'] == 'rejected' ? 'alert alert-danger' : ($order['status'] == 'approved' ? 'alert alert-success' : 'alert alert-warning')?>">
                                    <td><a href="/orders/<?=$order['id']?>"><strong>#order-<?=$order['id']?></strong></a></td>
                                    <td>
                                        <a href="/orders/<?=$order['id']?>">
                                            <img src="/media/blank.jpg" class="avatar lg rounded me-2" alt="profile-image"><span>#<?=$order['id']?></span>
                                        </a>
                                    </td>
                                    <td><?=($order['order_type'] == "bar" ? "BAR Order" : "Accommodation")?></td>
                                    <td><?=$order['customer']?></td>
                                    <td>
                                        <?=number_format($order['amount'])?>/-
                                    </td>

                                    <td>
                                        <?php
                                        if ($order['status'] == 'pending'):
                                        ?>
                                            <span class="badge bg-warning">Pending</span>
                                            <?php
                                        elseif ($order['status'] == 'approved') :
                                            ?>
                                            <span class="badge bg-success">Completed</span>
                                            <?php
                                        else:
                                            ?>
                                            <span class="badge bg-danger">Rejected</span>
                                            <?php
                                        endif;
                                            ?>
                                    </td>
                                    <td><?=$order['created_at']?></td>
                                    <td><?=$order['user']?></td>
                                </tr>
                                    <?php
                                endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->
        </div>
    </div>

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


