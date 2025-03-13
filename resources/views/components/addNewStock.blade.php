<div class="container mb-4">
    <h2 class="mb-4">Add New Stock</h2>
    <form action="" method="POST">
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Batch ID (Auto-Generated)</label>
                <input type="text" class="form-control" name="batch_id" id="batch_id" disabled>
            </div>
            <div class="col-md-3">
                <label class="form-label">Item Name</label>
                <select class="form-control" name="status">
                    <option value="in_office">POS</option>
                    <option value="sold">Printer</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Model Number</label>
                <input type="text" class="form-control" name="model_number" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Serial Number</label>
                <input type="text" class="form-control" name="serial_number" required>
            </div>

        </div>

        <div class="row g-3 mt-2">
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-success w-100">Initiate Stock</button>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button class="btn btn-info w-100">Import Excel</button>

            </div>
        </div>

    </form>
</div>

<script>
    // Generate Batch ID based on the current date
    document.addEventListener("DOMContentLoaded", function() {
        let today = new Date();
        let year = today.getFullYear();
        let month = String(today.getMonth() + 1).padStart(2, '0'); // Ensure two-digit month
        let day = String(today.getDate()).padStart(2, '0'); // Ensure two-digit day
        let batchId = `BAT-${year}-${month}-${day}`;

        // Set the generated Batch ID in the input field
        document.getElementById("batch_id").value = batchId;
    });
</script>