<div class="card captable-overview-card col-12 col-md-12 col-lg-12">
    <div class="card-body overview-card-body">
        <div class="overview-card-header">
            <h6 class="header-text">Cap Table Overview</h6>
        </div>
        <div class="date-div">
            <label for="asOnDate">As On:</label>
            <input type="date" id="asOnDate" name="asOnDate" value="{{ date('Y-m-d') }}">
        </div>
        <div class="col-12 col-md-12 col-lg-12">
            <div class="pie-chart-container">
                <div id="overviewPieChart" class="overview-pie-chart"></div>

            </div>
        </div>
        <div class="overview-card-footer">
            <div class="">
                <input type="checkbox" class="urgent-checkbox mt-2 me-1" name="" id="convertibleSelect" checked>
                <span class="mt-0">Include Convertible Note</span>
            </div>
        </div>
    </div>
</div>

@push('overviewPieChartJs')
    <script>
        var overview_share_types = [];
        var chart = echarts.init(document.getElementById('overviewPieChart'));
        document.addEventListener("DOMContentLoaded", function () {
            // var initialData = [
            //     {value: 60.87, name: "Ordinary", shares: 60870},
            //     {value: 14.10, name: "Preference", shares: 14100},
            //     {value: 13.16, name: "ESOP", shares: 13160},
            //     {value: 11.87, name: "Convertible Note", shares: 11870}
            // ];
            //
            // var colors = ["#56BB6C", "#4D7CFE", "#FBDE70", "#777777"];
            //
            // var chartOptions = {
            //     grid: {
            //         left: '10%',  // Adjust the left margin
            //         right: '50%', // Adjust the right margin
            //     },
            //     series: [{
            //         type: 'pie',
            //         radius: '70%',
            //         center: ['35%', '40%'], // Adjust the center of the pie chart
            //         data: initialData,
            //         label: {
            //             show: true,
            //             position: 'outside',
            //             formatter: function (params) {
            //                 var dataIndex = params.dataIndex;
            //                 var percentage = ((initialData[dataIndex].value / initialData.reduce((a, b) => a + b.value, 0)) * 100).toFixed(2);
            //                 return '{b|' + params.name + '}\n{d|' + percentage + '%}\n{c|' + initialData[dataIndex].shares + ' shares}';
            //             },
            //             rich: {
            //                 b: {
            //                     fontWeight: 'bold',
            //                     lineHeight: 18,
            //                 },
            //                 d: {
            //                     lineHeight: 18,
            //                 },
            //                 c: {
            //                     lineHeight: 18,
            //                 }
            //             }
            //         }
            //     }],
            //     color: colors,
            //     tooltip: {
            //         show: false
            //     },
            //     legend: {
            //         orient: 'vertical',
            //         right: '2%', // Adjust the right position
            //         top: '15%',
            //         textStyle: {
            //             fontSize: 14
            //         },
            //         formatter: function (name) {
            //             var dataIndex = 0;
            //             for (var i = 0; i < initialData.length; i++) {
            //                 if (initialData[i].name === name) {
            //                     dataIndex = i;
            //                     break;
            //                 }
            //             }
            //             var percentage = ((initialData[dataIndex].value / initialData.reduce((a, b) => a + b.value, 0)) * 100).toFixed(2);
            //             return name + " Share ";
            //         }
            //     },
            //     labelLine: {
            //         show: false
            //     }
            // };
            //
            // var chart = echarts.init(document.getElementById('overviewPieChart'));
            // chart.setOption(chartOptions);

            // Get the table row
            var convertibleRow = document.getElementById('convertible');

            // Toggle visibility on checkbox click
            var checkbox = document.getElementById('convertibleSelect');
            checkbox.addEventListener('change', function () {
                if (checkbox.checked) {
                    // Show the table row
                    convertibleRow.style.display = 'table-row';
                    // Add "Convertible Note" back to the data array
                    // initialData.push({value: 11.87, name: "Convertible Note", shares: 11870});
                    // Update the chart with the new data
                    // chart.setOption({
                    //     series: [{
                    //         data: initialData
                    //     }]
                    // });
                } else {
                    // Hide the "Convertible Note" from the data array
                    filterData = initialData.filter(item => item.name !== 'Convertible');
                    initialData = [];
                    initialData = calculateData($filterData)
                    // Update the chart with the new data
                    // chart.setOption({
                    //     series: [{
                    //         data: initialData
                    //     }]
                    // });

                    // Hide the table row
                    convertibleRow.style.display = 'none';
                }
                showGraphOverview(initialData)
                showTableData(initialData)
            });
        });

        $(window).resize(function () {
            var initialData = overview_share_types
                // [
                //     {value: 60.87, name: "Ordinary", shares: 60870},
                //     {value: 14.10, name: "Preference", shares: 14100},
                //     {value: 13.16, name: "ESOP", shares: 13160},
                //     {value: 11.87, name: "Convertible Note", shares: 11870}
                // ];

            var colors = ["#56BB6C", "#4D7CFE", "#FBDE70", "#777777"];

            var chartOptions = {
                grid: {
                    left: '10%',  // Adjust the left margin
                    right: '50%', // Adjust the right margin
                },
                series: [{
                    type: 'pie',
                    radius: '70%',
                    center: ['35%', '40%'], // Adjust the center of the pie chart
                    data: initialData,
                    label: {
                        show: true,
                        position: 'outside',
                        formatter: function (params) {
                            var dataIndex = params.dataIndex;
                            var percentage = ((initialData[dataIndex].value / initialData.reduce((a, b) => a + b.value, 0)) * 100).toFixed(2);
                            return '{b|' + params.name + '}\n{d|' + percentage + '%}\n{c|' + initialData[dataIndex].shares + ' shares}';
                        },
                        rich: {
                            b: {
                                fontWeight: 'bold',
                                lineHeight: 18,
                            },
                            d: {
                                lineHeight: 18,
                            },
                            c: {
                                lineHeight: 18,
                            }
                        }
                    }
                }],
                color: colors,
                tooltip: {
                    show: false
                },
                legend: {
                    orient: 'vertical',
                    right: '2%', // Adjust the right position
                    top: '15%',
                    textStyle: {
                        fontSize: 14
                    },
                    formatter: function (name) {
                        var dataIndex = 0;
                        for (var i = 0; i < initialData.length; i++) {
                            if (initialData[i].name === name) {
                                dataIndex = i;
                                break;
                            }
                        }
                        var percentage = ((initialData[dataIndex].value / initialData.reduce((a, b) => a + b.value, 0)) * 100).toFixed(2);
                        return name + " Share ";
                    }
                },
                labelLine: {
                    show: false
                }
            };

            var chart = echarts.init(document.getElementById('overviewPieChart'));
            chart.setOption(chartOptions);

            // Get the table row
            var convertibleRow = document.getElementById('convertible');

            // Toggle visibility on checkbox click
            var checkbox = document.getElementById('convertibleSelect');
            checkbox.addEventListener('change', function () {
                var initialData = overview_share_types;
                if (checkbox.checked) {
                    // Show the table row
                    convertibleRow.style.display = 'table-row';
                    // Add "Convertible Note" back to the data array
                    // initialData.push({value: 11.87, name: "Convertible Note", shares: 11870});
                    // Update the chart with the new data
                    // chart.setOption({
                    //     series: [{
                    //         data: initialData
                    //     }]
                    // });
                } else {
                    // Hide the "Convertible Note" from the data array
                    filterData = initialData.filter(item => item.name !== 'Convertible');
                    initialData = calculateData(filterData)
                    // Update the chart with the new data
                    // chart.setOption({
                    //     series: [{
                    //         data: initialData
                    //     }]
                    // });

                    // Hide the table row
                    convertibleRow.style.display = 'none';
                }
                // Update the chart & table with the new data
                showGraphOverview(initialData);
                showTableData(initialData);
            });
        });

        function showGraphOverview(overview_share_types) {
            var initialData = overview_share_types;
            var colors = ["#56BB6C", "#4D7CFE", "#FBDE70", "#777777"];
            var chartOptions = {
                grid: {
                    left: '10%',  // Adjust the left margin
                    right: '50%', // Adjust the right margin
                },
                series: [{
                    type: 'pie',
                    radius: '70%',
                    center: ['35%', '40%'], // Adjust the center of the pie chart
                    data: initialData,
                    label: {
                        show: true,
                        position: 'outside',
                        formatter: function (params) {
                            var dataIndex = params.dataIndex;
                            console.log("initialData : ",initialData)
                            var percentage = ((initialData[dataIndex].value / initialData.reduce((a, b) => a + b.value, 0)) * 100).toFixed(2);
                            return '{b|' + params.name + '}\n{d|' + percentage + '%}\n{c|' + initialData[dataIndex].shares + ' shares}';
                        },
                        rich: {
                            b: {
                                fontWeight: 'bold',
                                lineHeight: 18,
                            },
                            d: {
                                lineHeight: 18,
                            },
                            c: {
                                lineHeight: 18,
                            }
                        }
                    }
                }],
                color: colors,
                tooltip: {
                    show: false
                },
                legend: {
                    orient: 'vertical',
                    right: '2%', // Adjust the right position
                    top: '15%',
                    textStyle: {
                        fontSize: 14
                    },
                    formatter: function (name) {
                        var dataIndex = 0;
                        for (var i = 0; i < initialData.length; i++) {
                            if (initialData[i].name === name) {
                                dataIndex = i;
                                break;
                            }
                        }
                        var percentage = ((initialData[dataIndex].value / initialData.reduce((a, b) => a + b.value, 0)) * 100).toFixed(2);
                        return name + " Share ";
                    }
                },
                labelLine: {
                    show: false
                }
            };
            chart.setOption(chartOptions);
        }
    </script>
@endpush
