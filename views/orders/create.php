<?php
include_once "views/headers/index.php";
include_once "views/headers/header.php";
?>
    <div class="body d-flex py-3">
        <?php
        if (isset($_SESSION['error_message'])):
        ?>
            <div class="alert alert-info"><?=$_SESSION['error_message']?></div>
        <?php
        unset($_SESSION['error_message']);
        endif;
         ?>
        <form action="/orders/save" method="post">
            <div class="container-xxl">
                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class="fw-bold mb-0">Create Invoice</h3>
                        </div>
                    </div>
                </div> <!-- Row end  -->
                <div class="row g-3 mb-3">
                    <div class="col-lg-12 col-xl-7">
                        <div class="card  mb-3">
                            <div class="card-body">
                                <div class="checkout-sidebar">
                                    <div class="checkout-sidebar-price-table mt-30">
                                        <h5 class="title fw-bold">ITEMS</h5>
                                        <label for="select-field">Select Field:</label>
                                        <input type="text" class="form-control" onkeydown="if (event.key === 'Enter') { event.preventDefault();" id="select-field" placeholder="Search item" list="options" onchange="updateDom(this.value)">
                                        <datalist id="options" style="width:400px">
                                            <?php
                                            foreach($items as $item) :
                                                ?>
                                                <option value="<?=$item['id']?>"><?=$item['name']?> @<?=$item['price']?>/-</option>
                                                <?php
                                            endforeach;
                                                ?>
                                        </datalist>
                                            <div class="table-responsive">
                                                <table class="table w-100">
                                                    <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Item</th>
                                                        <th>Price</th>
                                                        <th>Qty</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="invoiceContent">

                                                    </tbody>
                                                </table>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-xl-5">
                        <div class="card  mb-3">
                            <div class="card-body">
                                <div class="checkout-sidebar">
                                    <div class="checkout-sidebar-price-table mt-30">
                                        <h5 class="title fw-bold">Accomodation</h5>
                                        <label for="select-field">Select Field:</label>
                                        <input type="text" class="form-control" onkeydown="if (event.key === 'Enter') { event.preventDefault();" id="select-field2" placeholder="Search room" list="options2" onchange="updateRoom(this.value)">
                                        <datalist id="options2" style="width:400px">
                                            <?php
                                            foreach($rooms as $room) :
                                                ?>
                                                <option <?=$room['status'] != 'free' ? 'disabled': ''?>value="<?=$room['id']?>"><?=$room['room_number']?> @<?=$room['price']?>/-</option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </datalist>
                                        <div class="table-responsive">
                                            <table class="table w-100">
                                                <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Room Number</th>
                                                    <th>Price</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody id="RoomInvoiceContent">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="checkout-steps">
                                    <ul id="accordionExample">
                                        <li>
                                            <section>
                                                <h6 class="title collapsed fw-bold" id="headingOne" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Customer Details </h6>
                                                <div class="checkout-steps-form-content collapse show" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#accordionExample" >
                                                        <div class="row g-3 align-items-center">
                                                            <div class="col-md-12">
                                                                <label for="firstname1" class="form-label">Name</label>
                                                                <input type="text" name="names" class="form-control" id="firstname1" value="Internal sale">
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="phonenumber1" class="form-label">Phone Number</label>
                                                                <input type="text" name="phone" class="form-control" id="phonenumber1" value="0700000000">
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="emailaddress1" class="form-label">Email Address</label>
                                                                <input type="email" name="email" class="form-control" id="emailaddress1" value="ashiraff@tumusii.me">
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="form-label">Address</label>
                                                                <input type="text" name="address" class="form-control">
                                                            </div>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary mt-4 px-5 text-uppercase form-control">Save</button>
                                                </div>
                                            </section>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
<script>
    document.getElementById("select-field2").addEventListener("keydown", function(event) {
        if (event.keyCode === 13) { // 13 is the Enter key code
            event.preventDefault();
        }
    });

    document.getElementById("select-field").addEventListener("keydown", function(event) {
        if (event.keyCode === 13) { // 13 is the Enter key code
            event.preventDefault();
        }
    });

    let itemList = <?=json_encode($items)?>;
    let roomList = <?=json_encode($rooms)?>;
</script>
<?php
include_once "views/headers/footer.php";
?>

