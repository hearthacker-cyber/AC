<?php
include_once ('layouts/header.php');

include_once ('layouts/sidebar.php');
?>

<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
    <div class="content">
        <?php
        include_once ('layouts/topbar.php');
        ?>


        <?php
        require 'layouts/includes/config.php';

        // Get the invoice ID from the query string
        $invoiceId = $_GET['id'] ?? null;

        if ($invoiceId) {
            // Fetch the invoice data from the database
            $sql = "SELECT * FROM customers WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $invoiceId);
            $stmt->execute();
            $result = $stmt->get_result();
            $invoice = $result->fetch_assoc();
            $stmt->close();
        } else {
            die("Invoice ID is missing.");
        }

        $conn->close();
        ?>


        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                <li class="breadcrumb-item active">Invoice</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Invoice</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <!-- Invoice Logo-->
                            <div class="clearfix">
                                <div class="float-start mb-3">
                                    <img src="assets/images/logo-light.png" alt="" height="18">
                                </div>
                                <div class="float-end">
                                    <h4 class="m-0 d-print-none">Invoice</h4>
                                </div>
                            </div>

                            <!-- Invoice Detail-->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="float-end mt-3">
                                        <p><b>Hello, <?php echo htmlspecialchars($invoice['customer_name']); ?></b></p>
                                        <p class="text-muted font-13">Please find below a cost-breakdown for the recent
                                            work completed. Please make payment at your earliest convenience, and do not
                                            hesitate to contact me with any questions.</p>
                                    </div>
                                </div><!-- end col -->
                                <div class="col-sm-4 offset-sm-2">
                                    <div class="mt-3 float-sm-end">
                                        <p class="font-13"><strong>Order Date: </strong> &nbsp;&nbsp;&nbsp;
                                            <?php echo htmlspecialchars($invoice['service_date']); ?>
                                        </p>
                                        <p class="font-13"><strong>Order Status: </strong> <span
                                                class="badge bg-success float-end">Paid</span></p>
                                        <p class="font-13"><strong>Order ID: </strong> <span
                                                class="float-end"><?php echo htmlspecialchars($invoice['payment_id']); ?></span>
                                        </p>
                                    </div>
                                </div><!-- end col -->
                            </div>
                            <!-- end row -->

                            <div class="row mt-4">
                                <div class="col-sm-4">
                                    <h6>Billing Address</h6>
                                    <address>
                                        <?php echo "The Service Company"; ?><br>
                                        <?php echo "Kochin Kerala"; ?><br>
                                        <abbr title="Phone">P:</abbr>
                                        <?php echo "+91 94930303020" ?>
                                    </address>
                                </div> <!-- end col-->

                                <div class="col-sm-4">
                                    <h6>Shipping Address</h6>
                                    <address>
                                        <?php echo htmlspecialchars($invoice['customer_name']); ?><br>
                                        <?php echo htmlspecialchars($invoice['address']); ?><br>
                                        <abbr title="Phone">P:</abbr>
                                        <?php echo htmlspecialchars($invoice['phone_number']); ?>
                                    </address>
                                </div> <!-- end col-->

                                <div class="col-sm-4">
                                    <div class="text-sm-end">
                                        <img src="assets/images/barcode.png" alt="barcode-image"
                                            class="img-fluid me-2" />
                                    </div>
                                </div> <!-- end col-->
                            </div>
                            <!-- end row -->

                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table mt-4">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Item</th>
                                                    <th>Quantity</th>
                                                    <th>Unit Cost</th>
                                                    <th class="text-end">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td><b><?php echo htmlspecialchars($invoice['service_type']); ?></b>
                                                    </td>
                                                    <td>1</td>
                                                    <td><?php echo htmlspecialchars($invoice['service_cost']); ?></td>
                                                    <td class="text-end">
                                                        <?php echo htmlspecialchars($invoice['service_cost']); ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> <!-- end table-responsive-->
                                </div> <!-- end col -->
                            </div>
                            <!-- end row -->

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="clearfix pt-3">
                                        <h6 class="text-muted">Notes:</h6>
                                        <small>
                                            All accounts are to be paid within 7 days from receipt of
                                            invoice. To be paid by cheque or credit card or direct payment
                                            online. If account is not paid within 7 days the credits details
                                            supplied as confirmation of work undertaken will be charged the
                                            agreed quoted fee noted above.
                                        </small>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-sm-6">
                                    <div class="float-end mt-3 mt-sm-0">
                                        <p><b>Sub-total:</b> <span
                                                class="float-end"><?php echo htmlspecialchars($invoice['service_cost']); ?></span>
                                        </p>
                                        <p><b>VAT (12.5%):</b> <span
                                                class="float-end"><?php echo htmlspecialchars($invoice['service_cost'] * 0.125); ?></span>
                                        </p>
                                        <h3><?php echo htmlspecialchars($invoice['service_cost'] * 1.125); ?> INR</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div> <!-- end col -->
                            </div>
                            <!-- end row-->

                            <div class="d-print-none mt-4">
                                <div class="text-end">
                                    <a href="javascript:window.print()" class="btn btn-primary"><i
                                            class="mdi mdi-printer"></i> Print</a>
                                    <a href="javascript: void(0);" class="btn btn-info">Submit</a>
                                </div>
                            </div>
                            <!-- end buttons -->

                        </div> <!-- end card-body-->
                    </div> <!-- end card -->
                </div> <!-- end col-->
            </div>
            <!-- end row -->

        </div>


    </div>
    <!-- container -->

</div>
<!-- content -->

<?php
include_once ('layouts/footer.php')
    ?>