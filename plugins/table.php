<?php
// Include the config file to connect to the database
require_once 'layouts/includes/config.php';
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="header-title">Latest Services</h4>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#addCustomerModal" class="btn btn-light"><i class="mdi mdi-account-plus"></i> Add New Service </button>

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
                                <!-- <th>Actions</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch customer data from the database
                            $sql = "SELECT id, customer_name, service_type, address, service_date, next_service_date, service_cost FROM customers ORDER BY id DESC LIMIT 5";
                            if ($result = $conn->query($sql)) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr data-next-service-date='{$row['next_service_date']}' data-customer-name='{$row['customer_name']}' data-address='{$row['address']}' data-service-type='{$row['service_type']}'>
                                            <td>{$row['customer_name']}</td>
                                            <td>{$row['service_type']}</td>
                                            <td>{$row['address']}</td>
                                            <td>{$row['service_date']}</td>
                                            <td>{$row['next_service_date']}</td>
                                            <td>₹{$row['service_cost']}</td>
                                        </tr>";
                                }
                                $result->free();
                            } else {
                                echo "<tr><td colspan='7'>No records found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div> <!-- end card-body-->
            <a href="view_customers.php" class="btn btn-primary">
                <i class="mdi mdi-account-multiple"></i> <b>View All</b>
            </a>
        </div> <!-- end card-->
    </div> <!-- end col-->
</div> <!-- end row-->
<!-- Bootstrap Toast -->
<!-- Bootstrap Toast -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="nextServiceToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
        <div class="toast-header">
            <strong class="me-auto">Service Reminder</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <!-- Toast content will be injected by JavaScript -->
        </div>
    </div>
</div>

<script>
// JavaScript to check for upcoming services within 48 hours and show a toast message
document.addEventListener("DOMContentLoaded", function () {
    var rows = document.querySelectorAll('tr[data-next-service-date]');
    var now = new Date();
    var toastElement = document.getElementById('nextServiceToast');
    var toast = new bootstrap.Toast(toastElement, { autohide: false });

    rows.forEach(function (row) {
        var nextServiceDate = new Date(row.getAttribute('data-next-service-date'));
        var customerName = row.getAttribute('data-customer-name');
        var address = row.getAttribute('data-address');
        var serviceType = row.getAttribute('data-service-type');

        var timeDiff = nextServiceDate - now;
        var hoursDiff = timeDiff / (1000 * 60 * 60);

        if (hoursDiff > 0 && hoursDiff <= 48) {
            var toastBody = toastElement.querySelector('.toast-body');
            toastBody.innerHTML = 'Reminder: <br><b>Customer:</b> ' + customerName + '<br><b>Address:</b> ' + address + '<br><b>Service Type:</b> ' + serviceType + '<br><b>Next Service Date:</b> ' + nextServiceDate.toLocaleString();
            toast.show();
        }
    });
});
</script>


<!-- Edit Customer Modal -->
<div class="modal fade" id="editCustomerModal" tabindex="-1" role="dialog" aria-labelledby="editCustomerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editCustomerForm" method="post" action="update_customer.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCustomerModalLabel">Edit Customer</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editCustomerId" name="id">
                    <div class="form-group">
                        <label for="editCustomerName">Customer Name</label>
                        <input type="text" class="form-control" id="editCustomerName" name="customer_name" required>
                    </div>
                    <div class="form-group">
                        <label for="editServiceType">Service Type</label>
                        <input type="text" class="form-control" id="editServiceType" name="service_type" required>
                    </div>
                    <div class="form-group">
                        <label for="editAddress">Address</label>
                        <textarea class="form-control" id="editAddress" name="address" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editServiceDate">Service Date</label>
                        <input type="date" class="form-control" id="editServiceDate" name="service_date" required>
                    </div>
                    <div class="form-group">
                        <label for="editNextServiceDate">Next Service Date</label>
                        <input type="date" class="form-control" id="editNextServiceDate" name="next_service_date"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="editServiceCost">Service Cost</label>
                        <input type="number" step="0.01" class="form-control" id="editServiceCost" name="service_cost"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
// Include the config file to connect to the database
require_once 'layouts/includes/config.php';

// Function to get upcoming services within the next 72 hours
function getUpcomingServices($conn) {
    $current_date = new DateTime();
    $end_date = new DateTime();
    $end_date->add(new DateInterval('PT72H')); // Add 72 hours to the current date

    $sql = "SELECT id, customer_name, service_type, address, service_date, next_service_date, service_cost FROM customers 
            WHERE next_service_date BETWEEN ? AND ? 
            ORDER BY next_service_date ASC";
    $stmt = $conn->prepare($sql);
    $start_date_str = $current_date->format('Y-m-d H:i:s');
    $end_date_str = $end_date->format('Y-m-d H:i:s');
    $stmt->bind_param('ss', $start_date_str, $end_date_str);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
}

// Fetch upcoming services
$upcoming_services = getUpcomingServices($conn);
?>

<!-- Upcoming Services Table -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="header-title">Upcoming Services (Within 72 Hours)</h4>
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
                                <!-- <th>Actions</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Display upcoming services
                            if ($upcoming_services->num_rows > 0) {
                                while ($row = $upcoming_services->fetch_assoc()) {
                                    echo "<tr>
                                            <td>{$row['customer_name']}</td>
                                            <td>{$row['service_type']}</td>
                                            <td>{$row['address']}</td>
                                            <td>{$row['service_date']}</td>
                                            <td>{$row['next_service_date']}</td>
                                            <td>₹{$row['service_cost']}</td>
                                        </tr>";
                                }
                                $upcoming_services->free();
                            } else {
                                echo "<tr><td colspan='7'>No upcoming services within the next 72 hours.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div> <!-- end row-->

<script>
// JavaScript to populate the edit modal with customer data
var editCustomerModal = document.getElementById('editCustomerModal');
editCustomerModal.addEventListener('show.bs.modal', function(event) {
    var button = event.relatedTarget;
    var customerId = button.getAttribute('data-id');

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_customer.php?id=' + customerId, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var customer = JSON.parse(xhr.responseText);
            document.getElementById('editCustomerId').value = customer.id;
            document.getElementById('editCustomerName').value = customer.customer_name;
            document.getElementById('editServiceType').value = customer.service_type;
            document.getElementById('editAddress').value = customer.address;
            document.getElementById('editServiceDate').value = customer.service_date;
            document.getElementById('editNextServiceDate').value = customer.next_service_date;
            document.getElementById('editServiceCost').value = customer.service_cost;
        }
    }
    xhr.send();
});

// JavaScript to handle customer deletion
function deleteCustomer(id) {
    if (confirm("Are you sure you want to delete this customer?")) {
        window.location.href = 'delete_customer.php?id=' + id;
    }
}
</script>
<?php

include_once ('add_customer_model.php');
?>


<!-- Edit Customer Modal -->
<div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="editCustomerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="./edit_customer.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCustomerModalLabel">Edit Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editCustomerId" name="customerId">
                    <div class="mb-3">
                        <label for="editCustomerName" class="form-label">Customer Name</label>
                        <input type="text" class="form-control" id="editCustomerName" name="customerName" required>
                    </div>
                    <div class="mb-3">
                        <label for="editServiceType" class="form-label">Service Type</label>
                        <input type="text" class="form-control" id="editServiceType" name="serviceType" required>
                    </div>
                    <div class="mb-3">
                        <label for="editAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="editAddress" name="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="editServiceDate" class="form-label">Service Date</label>
                        <input type="date" class="form-control" id="editServiceDate" name="serviceDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="editNextServiceDate" class="form-label">Next Service Date</label>
                        <input type="date" class="form-control" id="editNextServiceDate" name="nextServiceDate"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="editServiceCost" class="form-label">Service Cost</label>
                        <input type="number" class="form-control" id="editServiceCost" name="serviceCost" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function deleteCustomer(customerName) {
    if (confirm('Are you sure you want to delete ' + customerName + '?')) {
        // Logic to delete the customer
        // Typically involves an AJAX call or a form submission
        // to a server-side script that deletes the customer from the database
    }
}

// Populate the edit customer modal with customer details
function populateEditCustomerModal(customerId, customerName, serviceType, address, serviceDate, nextServiceDate,
    serviceCost) {
    document.getElementById('editCustomerId').value = customerId;
    document.getElementById('editCustomerName').value = customerName;
    document.getElementById('editServiceType').value = serviceType;
    document.getElementById('editAddress').value = address;
    document.getElementById('editServiceDate').value = serviceDate;
    document.getElementById('editNextServiceDate').value = nextServiceDate;
    document.getElementById('editServiceCost').value = serviceCost;
}
</script>