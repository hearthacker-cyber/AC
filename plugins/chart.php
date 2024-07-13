<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="header-title">Customers</h4>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addCustomerModal">Add New Customer</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Export Data</a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-centered table-striped table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Customer Name</th>
                                <th>Service Type</th>
                                <th>Address</th>
                                <th>Service Date</th>
                                <th>Next Service Date</th>
                                <th>Service Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John Doe</td>
                                <td>Plumbing</td>
                                <td>123 Main St, Springfield</td>
                                <td>2024-07-01</td>
                                <td>2024-08-01</td>
                                <td>$150</td>
                            </tr>
                            <tr>
                                <td>Jane Smith</td>
                                <td>Electrical</td>
                                <td>456 Elm St, Springfield</td>
                                <td>2024-07-05</td>
                                <td>2024-09-05</td>
                                <td>$200</td>
                            </tr>
                            <tr>
                                <td>Michael Johnson</td>
                                <td>Landscaping</td>
                                <td>789 Oak St, Springfield</td>
                                <td>2024-07-10</td>
                                <td>2024-07-24</td>
                                <td>$100</td>
                            </tr>
                            <!-- Add more customer rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div> <!-- end row-->

<!-- Add Customer Modal -->
<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="./customers.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCustomerModalLabel">Add New Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="customerName" class="form-label">Customer Name</label>
                        <input type="text" class="form-control" id="customerName" name="customerName" required>
                    </div>
                    <div class="mb-3">
                        <label for="serviceType" class="form-label">Service Type</label>
                        <input type="text" class="form-control" id="serviceType" name="serviceType" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="serviceDate" class="form-label">Service Date</label>
                        <input type="date" class="form-control" id="serviceDate" name="serviceDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="nextServiceDate" class="form-label">Next Service Date</label>
                        <input type="date" class="form-control" id="nextServiceDate" name="nextServiceDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="serviceCost" class="form-label">Service Cost</label>
                        <input type="number" class="form-control" id="serviceCost" name="serviceCost" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Customer</button>
                </div>
            </form>
        </div>
    </div>
</div>
