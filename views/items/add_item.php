<?php
include_once "views/headers/index.php";
include_once "views/headers/header.php";
?>
<div class="body d-flex py-3">
    <div class="container-xxl">
        <form action="/items/save" method="post">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0">Items Add</h3>
                    </div>
                </div>
            </div> <!-- Row end  -->

            <div class="row g-3 mb-3">
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
                                        <input type="text" name="price" class="form-control">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                <h6 class="m-0 fw-bold">Categories</h6>
                            </div>
                            <div class="card-body">
                                <label  class="form-label">Categories Select</label>
                                <select class="form-select" size="3" name="category" aria-label="size 3 select example">
                                    <option value="1">Bar</option>
                                    <option value="2">Room</option>

                                </select>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                <h6 class="m-0 fw-bold">Inventory Info</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-12">
                                        <label  class="form-label">Total Stock Quantity</label>
                                        <input type="text" name="qty" class="form-control">
                                    </div>
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
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Item Description</label>
                                        <textarea class="form-control" name="description"></textarea>
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
