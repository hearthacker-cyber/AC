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
                        <select class="form-control" id="serviceType" name="serviceType" required onchange="toggleOtherServiceField()">
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
                    <div class="mb-3">
                        <label for="paymentMode" class="form-label">Payment Mode</label>
                        <select class="form-control" id="paymentMode" name="paymentMode" required>
                            <option value="Cash">Cash</option>
                            <option value="Online Payment">Online Payment</option>
                        </select>
                    </div>
                    <div class="mb-3" id="paymentIdField" style="display: none;">
                        <label for="paymentId" class="form-label">Payment ID</label>
                        <input type="text" class="form-control" id="paymentId" name="paymentId">
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

document.addEventListener('DOMContentLoaded', function () {
    var paymentIdField = document.getElementById('paymentIdField');
    paymentIdField.style.display = 'none';
});
</script>
