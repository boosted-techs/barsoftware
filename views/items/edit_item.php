<?php
include_once "views/headers/index.php";
include_once "views/headers/header.php";
?>
<div class="body d-flex py-3">
    <div class="container-xxl">
        <form action="/items/edit" method="post">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0">Edit Item</h3>
                    </div>
                </div>
            </div> <!-- Row end  -->

            <div class="row g-3 mb-3">
                <?php
                if (isset($_SESSION['error_message'])):
                    ?>
                    <div class="col-12 alert alert-info"><?=$_SESSION['error_message']?></div>
                    <?php
                    unset($_SESSION['error_message']);
                endif;
                ?>
                <div class="col-xl-4 col-lg-4">
                    <div class="sticky-lg-top">
                        <div class="card mb-3">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                <h6 class="m-0 fw-bold">Pricing Info</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3 align-items-center">

                                    <div class="col-md-12">
                                        <label  class="form-label">Item Price</label>
                                        <input type="text" name="price" class="form-control" value="<?=$item[0]['price']?>">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                <h6 class="m-0 fw-bold">Inventory Info</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-12">
                                        <input type="radio" name="pr" value="1" checked> Unchanged
                                        <input type="radio" name="pr" value="2" > Correct
                                        <input type="radio" name="pr" value="3" > New stock
                                        <label  class="form-label">Total Stock Quantity</label>
                                        <input type="number" name="qty" value="<?=$item[0]['stock_level'] - $item[0]['qty_sold']?>" class="form-control">
                                    </div>
                                    <input type="hidden" value="<?=$item[0]['id']?>" name="item"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8">
                    <div class="card mb-3">
                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                            <h6 class="mb-0 fw-bold ">Basic information</h6>
                        </div>
                        <div class="card-body">

                                <div class="row g-3 align-items-center">
                                    <div class="col-md-12">
                                        <label  class="form-label">Name</label>
                                        <input type="text" name="name" value="<?=$item[0]['name']?>" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Product Description</label>
                                        <textarea class="form-control" name="description"><?=$item[0]['description']?></textarea>
                                        <button type="submit" class="mt-2 btn btn-primary form-control btn-set-task w-sm-100 py-2 px-5 text-uppercase">Save</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div><!-- Row end  -->
        </form>
    </div>
</div>

<?php
include_once "views/headers/footer.php";
?>
