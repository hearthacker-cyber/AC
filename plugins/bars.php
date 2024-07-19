<div class="row">
    <div class="col-xl-6 col-lg-12 order-lg-2 order-xl-1">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="header-title">Top Selling Products</h4>
                    <a href="javascript:void(0);" class="btn btn-sm btn-link">Export <i
                            class="mdi mdi-download ms-1"></i></a>
                </div>


                <?php
                require 'layouts/includes/config.php';

                // Fetch service data from the database and categorize them
                $sql = "SELECT service_type, COUNT(*) as total_services, SUM(service_cost) as total_amount
        FROM customers
        GROUP BY service_type";
                $result = $conn->query($sql);

                // Initialize arrays to store categorized data
                $serviceSummary = [
                    'AC Service' => ['total_services' => 0, 'total_amount' => 0],
                    'Washing Machine Service' => ['total_services' => 0, 'total_amount' => 0],
                    'Others' => ['total_services' => 0, 'total_amount' => 0]
                ];

                // Categorize the data
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        switch ($row["service_type"]) {
                            case 'AC Service':
                                $serviceSummary['AC Service']['total_services'] = $row['total_services'];
                                $serviceSummary['AC Service']['total_amount'] = $row['total_amount'];
                                break;
                            case 'Washing Machine Service':
                                $serviceSummary['Washing Machine Service']['total_services'] = $row['total_services'];
                                $serviceSummary['Washing Machine Service']['total_amount'] = $row['total_amount'];
                                break;
                            default:
                                $serviceSummary['Others']['total_services'] += $row['total_services'];
                                $serviceSummary['Others']['total_amount'] += $row['total_amount'];
                                break;
                        }
                    }
                }
                ?>

                <div class="table-responsive">
                    <table class="table table-centered table-nowrap table-hover mb-0">
                        <tbody>
                            <!-- AC Service -->
                            <tr>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">AC Service</h5>
                                </td>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">
                                        <?= $serviceSummary['AC Service']['total_services'] ?>
                                    </h5>
                                    <span class="text-muted font-13">Total Services</span>
                                </td>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">
                                        $<?= number_format($serviceSummary['AC Service']['total_amount'], 2) ?></h5>
                                    <span class="text-muted font-13">Total Amount</span>
                                </td>
                            </tr>

                            <!-- Washing Machine Service -->
                            <tr>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">Washing Machine Service</h5>
                                </td>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">
                                        <?= $serviceSummary['Washing Machine Service']['total_services'] ?>
                                    </h5>
                                    <span class="text-muted font-13">Total Services</span>
                                </td>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">
                                        $<?= number_format($serviceSummary['Washing Machine Service']['total_amount'], 2) ?>
                                    </h5>
                                    <span class="text-muted font-13">Total Amount</span>
                                </td>
                            </tr>

                            <!-- Other Services -->
                            <tr>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">Other Services</h5>
                                </td>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">
                                        <?= $serviceSummary['Others']['total_services'] ?>
                                    </h5>
                                    <span class="text-muted font-13">Total Services</span>
                                </td>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">
                                        $<?= number_format($serviceSummary['Others']['total_amount'], 2) ?></h5>
                                    <span class="text-muted font-13">Total Amount</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->

                <?php
                $conn->close();
                ?>







            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->





    <div class="col-xl-3 col-lg-6 order-lg-1">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="header-title">Total Sales</h4>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div>
                </div>

                <div id="average-sales" class="apex-charts mb-4 mt-3" data-colors="#727cf5,#0acf97,#fa5c7c,#ffbc00">
                </div>


                <div class="chart-widget-list">
                    <p>
                        <i class="mdi mdi-square text-primary"></i> Direct
                        <span class="float-end">$300.56</span>
                    </p>
                    <p>
                        <i class="mdi mdi-square text-danger"></i> Affilliate
                        <span class="float-end">$135.18</span>
                    </p>
                    <p>
                        <i class="mdi mdi-square text-success"></i> Sponsored
                        <span class="float-end">$48.96</span>
                    </p>
                    <p class="mb-0">
                        <i class="mdi mdi-square text-warning"></i> E-mail
                        <span class="float-end">$154.02</span>
                    </p>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->











    <div class="col-xl-3 col-lg-6 order-lg-1">
        <div class="card">
            <div class="card-body pb-0">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="header-title">Recent Activity</h4>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body py-0" data-simplebar style="max-height: 405px;">
                <div class="timeline-alt py-0">
                    <div class="timeline-item">
                        <i class="mdi mdi-upload bg-info-lighten text-info timeline-icon"></i>
                        <div class="timeline-item-info">
                            <a href="javascript:void(0);" class="text-info fw-bold mb-1 d-block">You sold an item</a>
                            <small>Paul Burgess just purchased “Hyper - Admin Dashboard”!</small>
                            <p class="mb-0 pb-2">
                                <small class="text-muted">5 minutes ago</small>
                            </p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <i class="mdi mdi-airplane bg-primary-lighten text-primary timeline-icon"></i>
                        <div class="timeline-item-info">
                            <a href="javascript:void(0);" class="text-primary fw-bold mb-1 d-block">Product on the
                                Bootstrap Market</a>
                            <small>Dave Gamache added
                                <span class="fw-bold">Admin Dashboard</span>
                            </small>
                            <p class="mb-0 pb-2">
                                <small class="text-muted">30 minutes ago</small>
                            </p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <i class="mdi mdi-microphone bg-info-lighten text-info timeline-icon"></i>
                        <div class="timeline-item-info">
                            <a href="javascript:void(0);" class="text-info fw-bold mb-1 d-block">Robert Delaney</a>
                            <small>Send you message
                                <span class="fw-bold">"Are you there?"</span>
                            </small>
                            <p class="mb-0 pb-2">
                                <small class="text-muted">2 hours ago</small>
                            </p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <i class="mdi mdi-upload bg-primary-lighten text-primary timeline-icon"></i>
                        <div class="timeline-item-info">
                            <a href="javascript:void(0);" class="text-primary fw-bold mb-1 d-block">Audrey Tobey</a>
                            <small>Uploaded a photo
                                <span class="fw-bold">"Error.jpg"</span>
                            </small>
                            <p class="mb-0 pb-2">
                                <small class="text-muted">14 hours ago</small>
                            </p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <i class="mdi mdi-upload bg-info-lighten text-info timeline-icon"></i>
                        <div class="timeline-item-info">
                            <a href="javascript:void(0);" class="text-info fw-bold mb-1 d-block">You sold an item</a>
                            <small>Paul Burgess just purchased “Hyper - Admin Dashboard”!</small>
                            <p class="mb-0 pb-2">
                                <small class="text-muted">16 hours ago</small>
                            </p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <i class="mdi mdi-airplane bg-primary-lighten text-primary timeline-icon"></i>
                        <div class="timeline-item-info">
                            <a href="javascript:void(0);" class="text-primary fw-bold mb-1 d-block">Product on the
                                Bootstrap Market</a>
                            <small>Dave Gamache added
                                <span class="fw-bold">Admin Dashboard</span>
                            </small>
                            <p class="mb-0 pb-2">
                                <small class="text-muted">22 hours ago</small>
                            </p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <i class="mdi mdi-microphone bg-info-lighten text-info timeline-icon"></i>
                        <div class="timeline-item-info">
                            <a href="javascript:void(0);" class="text-info fw-bold mb-1 d-block">Robert Delaney</a>
                            <small>Send you message
                                <span class="fw-bold">"Are you there?"</span>
                            </small>
                            <p class="mb-0 pb-2">
                                <small class="text-muted">2 days ago</small>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- end timeline -->
            </div> <!-- end slimscroll -->
        </div>
        <!-- end card-->
    </div>
    <!-- end col -->

</div>
<!-- end row -->