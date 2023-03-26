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
                        <h3 class="fw-bold mb-0">Rooms</h3>
                        <div class="btn-group group-link btn-set-task w-sm-100">
                            <a href="/items/add" class="btn d-inline-flex align-items-center" aria-current="page"><i class="icofont-wall px-2 fs-5"></i>Add room</a>
                            <a href="#" class="btn active d-inline-flex align-items-center"><i class="icofont-listing-box px-2 fs-5"></i> List View</a>
                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->
            <div class="row g-3 mb-3">

                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                        <table class="table table-striped" id="myDataTable">
                            <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Item</th>
                                <th>Price</th>

                                <th>User</th>
                                <th>Description</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            foreach ($items as $item):
                                $item['qty_sold'] = $item['qty_sold'] ?? 0;
                                ?>
                                <tr>
                                    <td><?=$i++?></td>
                                    <td><img class="w120 rounded img-fluid" src="/media/<?=$item['image']?>" alt=""></td>
                                    <td>
                                        <a href="#"><h6 class="mb-3 fw-bold"><?=$item['room_number']?> <span class="text-muted small fw-light d-block">#<?=$item['id']?></span></h6></a>
                                    </td>
                                    <td>
                                        <?=number_format($item['price'])?>/-
                                    </td>

                                    <td>
                                        <?=$item['user']?>
                                    </td>
                                    <td>
                                        <?=$item['description']?>
                                    </td>
                                    <td>
                                        <form action="/items/<?=$item['id']?>/mark-booked" method="get">
                                            <select class="form-control border border-danger" name="status">
                                                <option value="free">Make free</option>
                                                <option value="booked">Mark Booked</option>
                                                <option value="closed">Mark closed</option>
                                            </select>
                                            <button class="btn btn-secondary" type="submit">Update</button>
                                        </form>
                                    </td>
                                </tr>


                            <?php
                            endforeach;
                            ?>
                            </tbody>
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
