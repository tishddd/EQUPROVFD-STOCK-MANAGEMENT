<aside class="aside-menu bg-white border-left open d-flex flex-column">
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show p-3 active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead class="table-success">
                        <tr>
                            <th colspan="3">STOCK QTY / REGION (in office)</th>
                        </tr>
                        <tr class="table-secondary">
                            <th>Region</th>
                            <th>POS</th>
                            <th>Thermo Printer</th>
                        </tr>
                    </thead>
                    <tbody id="stock-table-body">
                        <!-- Data will be appended here -->
                    </tbody>
                    <tfoot class="table-warning">
                        <tr>
                            <td><strong>Total</strong></td>
                            <td><strong id="total-pos">0</strong></td>
                            <td><strong id="total-printer">0</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>



<div class="alerts mt-auto">
    <div class="alert alert-success alert-dismissible fade show mx-2" role="alert">
        <h5 class="alert-heading">Well done!</h5>
        <p>
            Stock is about to close
        </p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <!-- <div class="alert alert-warning alert-dismissible fade show mx-2" role="alert">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> -->
</div>
</aside>