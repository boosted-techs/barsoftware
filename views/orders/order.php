<?php
include_once "views/headers/index.php";
include_once "views/headers/header.php";
?>
    <!-- Body: Body -->
    <div class="body d-flex py-3">
        <div class="container-xxl">

            <div class="row align-items-center">
                <div class="col-12 border-0 mb-4">
                    <div class="card-header no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0 py-3 pb-2">#0<?=$order[0]['id']?></h3>
                        <div class="col-auto py-2 w-sm-100">
                            <ul class="nav nav-tabs tab-body-header rounded invoice-set" role="tablist">
                                <?php
                                if ($order[0]['status'] == 'pending') :
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="/orders/<?=$order[0]['id']?>/complete">
                                            Complete
                                        </a>
                                    </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/orders/<?=$order[0]['id']?>/reject">
                                        Reject
                                    </a>
                                </li>
                                <?php
                                elseif ($order[0]['status'] == 'approved') :
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#" onclick="printDivD()">
                                            Print
                                        </a>
                                    </li>
                                <?php
                                endif;
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <p>Trx TYPE: <?=$order[0]['order_type'] == 'bar' ? 1 : 2?> : status : <b><?=$order[0]['status']?></b></p>
                </div>
            </div> <!-- Row end  -->
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="d-flex justify-content-center">
                        <table class="card p-5" id="toBePrinted">
                            <tr>
                                <td></td>
                                <td class="text-center">
                                    <table>
                                        <tr>
                                            <td class="text-center">
                                                <h2>#0<?=$order[0]['id']?></h2>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pt-2 pb-4">
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <strong>Boosted</strong> Technologies<br>
                                                            Email: ashan@boostedtechs.com<br>
                                                            Phone: +256 740 600984<br>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pt-2">
                                                            <table class="table table-bordered">
                                                                <tr>
                                                                    <th>SNO</th>
                                                                    <th>ITEM</th>
                                                                    <th>QTY</th>
                                                                    <th>RATE</th>
                                                                    <th>AMOUNT</th>
                                                                </tr>
                                                                <?php
                                                                $i = 1;
                                                                foreach($items as $item) :
                                                                ?>
                                                                <tr>
                                                                    <td><?=$i++?></td>
                                                                    <td class="text-start"><?=$item['item_name']?></td>
                                                                    <td class="text-end"><?=$item['quantity']?></td>
                                                                    <td class="text-end"><?=number_format($item['price'])?>/-</td>
                                                                    <td class="text-end"><?=(number_format($item['price'] * $item['quantity']))?>/-</td>
                                                                </tr>
                                                                <?php
                                                                endforeach;
                                                                ?>
                                                                <tr>
                                                                    <td class="text-start" colspan="4"><b>TOTALS</b></td>
                                                                    <td class="text-end"><b><?=number_format($order[0]['amount'])?>/-</b></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="mt-3 text-center w-100">
                                        <tr>
                                            <td class="aligncenter content-block">Thank you for choosing us</td>
                                        </tr>
                                    </table>
                                </td>
                                <td></td>
                            </tr>
                        </table>


                    </div>
                </div>
            </div> <!-- Row end  -->
        </div>
    </div>

<?php
include_once "views/headers/footer.php";
?>
<script>

    // Get the div element with the id "print"

    function printDivD() {
        const printDiv = document.getElementById("toBePrinted");

        // Create a new window for printing
        const printWindow = window.open('', '_blank', 'height=500,width=500');
        const printContents = printDiv.innerHTML;
        //const printWindow = window.open('', '_blank', 'height=500,width=500');
        if (printWindow) {
            // Copy the contents of the print div into the new window
            //const printContents = printDiv.innerHTML;
            printWindow.document.write('<html><head><title>Print</title>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(printContents);
            printWindow.document.write('</body></html>');

            // Print the new window
            printWindow.document.close();
            printWindow.focus();
            printWindow.print();

            // Redirect back to "/orders" on print completion
            printWindow.onafterprint = function() {
                window.location.href = "/orders";
            };
        } else {
            // Handle the case where the window failed to open (e.g., show an error message)
        }

    }
</script>


