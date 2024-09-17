<div class="card captable-overview-table-card">
    <div class="card-body overview-card-body">
        <div class="table-responsive">
            <table class="captable-overview-table">
                <thead>
                <tr>
                    <th class="description-header">Type of Shares</th>
                    <th class="description-header">Number of Shares</th>
                    <th class="description-header">Ownership</th>
                    <th class="description-header">Amount Raised</th>
                </tr>
                </thead>
                <tbody id="overview-table-body">
                <!-- Main row start -->
                <tr>
                    <td class="description-data">Ordinary</td>
                    <td class="description-data">60,870</td>
                    <td class="description-data">60.87%</td>
                    <td class="description-data">$100,000.00</td>
                </tr>
                <tr>
                    <td class="description-data">Preference</td>
                    <td class="description-data">60,870</td>
                    <td class="description-data">60.87%</td>
                    <td class="description-data">$100,000.00</td>
                </tr>
                <tr>
                    <td class="description-data">ESOP</td>
                    <td class="description-data">60,870</td>
                    <td class="description-data">60.87%</td>
                    <td class="description-data">$100,000.00</td>
                </tr>
                <tr id="convertible">
                    <td class="description-data">Convertible</td>
                    <td class="description-data">60,870</td>
                    <td class="description-data">60.87%</td>
                    <td class="description-data">$100,000.00</td>
                </tr>
                <tr>
                    <td class="description-data">Total</td>
                    <td class="description-data">60,870</td>
                    <td class="description-data">60.87%</td>
                    <td class="description-data">$100,000.00</td>
                </tr>
                <!-- Main row end -->
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('overviewTableJs')
    <script>
        function showTableData(data_rows) {
            var table_row = '';
            var total_shares = 0;
            var total_ownership = 0.00;
            var total_amount = 0.00;

            for (let value of data_rows) {
                total_shares = total_shares + parseInt(value.shares)
                total_ownership = total_ownership + parseFloat(value.value)
                total_amount = total_amount + parseFloat(value.total_amount)
                table_row += `<tr id="${value.name[0].toLowerCase() + value.name.slice(1)}">
                                <td class="description-data">${value.name}</td>
                                <td class="description-data">${value.shares}</td>
                                <td class="description-data">${value.value}%</td>
                                <td class="description-data">$${value.total_amount}</td>
                            </tr>`;
            }
            table_row += `<tr id="total">
                                <td class="description-data">Total</td>
                                <td class="description-data">${total_shares}</td>
                                <td class="description-data">${total_ownership}%</td>
                                <td class="description-data">$${total_amount}</td>
                            </tr>`;


            $('#overview-table-body').empty().append(table_row);
        }
    </script>
@endpush
