<?php
include_once ('layouts/header.php');
include_once ('layouts/sidebar.php');
require 'layouts/includes/config.php';
?>

<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
    <div class="content">
        <?php include_once ('layouts/topbar.php'); ?>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Services</h4>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Phone Number</th>
                                        <th>Service Type</th>
                                        <th>Address</th>
                                        <th>Service Date</th>
                                        <th>Next Service Date</th>
                                        <th>Service Cost</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT id, customer_name, phone_number, service_type, address, service_date, next_service_date, service_cost FROM customers ORDER BY service_date DESC";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                <td>{$row['customer_name']}</td>
                                                <td>{$row['phone_number']}</td>
                                                <td>{$row['service_type']}</td>
                                                <td>{$row['address']}</td>
                                                <td>{$row['service_date']}</td>
                                                <td>{$row['next_service_date']}</td>
                                                <td>₹{$row['service_cost']}</td>
                                                <td>
                                                    <button class='btn btn-sm btn-warning' data-bs-toggle='modal' data-bs-target='#editCustomerModal' onclick='loadCustomerData({$row['id']})'><i class='mdi mdi-lead-pencil'></i></button>
                                                    <button class='btn btn-sm btn-danger' onclick='deleteCustomer({$row['id']})'><i class='mdi mdi-delete'></<Delete</button>
                                                </td>
                                            </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='8' class='text-center'>No records found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div> <!-- end preview-->
                    </div> <!-- end preview code-->
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div> <!-- end row-->
</div> <!-- end container -->
</div> <!-- end content -->

<?php include_once ('layouts/footer.php'); ?>

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
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" required>
                    </div>
                    <div class="mb-3">
                        <label for="serviceType" class="form-label">Service Type</label>
                        <select class="form-control" id="serviceType" name="serviceType" required
                            onchange="toggleOtherServiceField()">
                            <option value="AC Service">AC Service</option>
                            <option value="Washing Machine Service">Washing Machine Service</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="mb-3" id="otherServiceTypeField" style="display: none;">
                        <label for="otherServiceType" class="form-label">Other Service Type</label>
                        <input type="text" class="form-control" id="otherServiceType" name="otherServiceType">
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
                        <label for="editPhoneNumber" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="editPhoneNumber" name="phoneNumber" required>
                    </div>
                    <div class="mb-3">
                        <label for="editServiceType" class="form-label">Service Type</label>
                        <select class="form-control" id="editServiceType" name="serviceType" required
                            onchange="toggleEditOtherServiceField()">
                            <option value="AC Service">AC Service</option>
                            <option value="Washing Machine Service">Washing Machine Service</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="mb-3" id="editOtherServiceTypeField" style="display: none;">
                        <label for="editOtherServiceType" class="form-label">Other Service Type</label>
                        <input type="text" class="form-control" id="editOtherServiceType" name="otherServiceType">
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
function toggleOtherServiceField() {
    var serviceType = document.getElementById('serviceType').value;
    var otherServiceTypeField = document.getElementById('otherServiceTypeField');
    if (serviceType === 'Others') {
        otherServiceTypeField.style.display = 'block';
    } else {
        otherServiceTypeField.style.display = 'none';
    }
}

function toggleEditOtherServiceField() {
    var serviceType = document.getElementById('editServiceType').value;
    var otherServiceTypeField = document.getElementById('editOtherServiceTypeField');
    if (serviceType === 'Others') {
        otherServiceTypeField.style.display = 'block';
    } else {
        otherServiceTypeField.style.display = 'none';
    }
}

function loadCustomerData(id) {
    // Fetch customer data using AJAX
    fetch(`./get_customer.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('editCustomerId').value = data.id;
            document.getElementById('editCustomerName').value = data.customer_name;
            document.getElementById('editPhoneNumber').value = data.phone_number;
            document.getElementById('editServiceType').value = data.service_type;
            if (data.service_type === 'Others') {
                document.getElementById('editOtherServiceTypeField').style.display = 'block';
                document.getElementById('editOtherServiceType').value = data.other_service_type;
            } else {
                document.getElementById('editOtherServiceTypeField').style.display = 'none';
            }
            document.getElementById('editAddress').value = data.address;
            document.getElementById('editServiceDate').value = data.service_date;
            document.getElementById('editServiceCost').value = data.service_cost;
        })
        .catch(error => console.error('Error fetching customer data:', error));
}

function deleteCustomer(id) {
    if (confirm('Are you sure you want to delete this customer?')) {
        window.location.href = `./delete_customer.php?id=${id}`;
    }
}
</script>

<?php
// Handle adding new customer
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['customerName'])) {
    $customerName = $_POST['customerName'];
    $phoneNumber = $_POST['phoneNumber'];
    $serviceType = $_POST['serviceType'];
    $otherServiceType = $_POST['otherServiceType'] ?? '';
    $address = $_POST['address'];
    $serviceDate = $_POST['serviceDate'];
    $serviceCost = $_POST['serviceCost'];

    if ($serviceType === 'Others') {
        $serviceType = $otherServiceType;
    }

    $sql = "INSERT INTO customers (customer_name, phone_number, service_type, address, service_date, service_cost) VALUES ('$customerName', '$phoneNumber', '$serviceType', '$address', '$serviceDate', '$serviceCost')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Customer added successfully!'); window.location.href = './customers.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>