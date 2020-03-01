<template>
    <div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2">
                        <div id="chart-container2">
                            <fusioncharts
                                :type="chartTotalAlerts.type"
                                :width="chartTotalAlerts.width"
                                :height="chartTotalAlerts.height"
                                :data-format="chartTotalAlerts.dataFormat"
                                :data-source="chartTotalAlerts.dataSource"
                                >
                            </fusioncharts>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div id="chart-container1">
                            <fusioncharts
                                :type="chart.type"
                                :width="chart.width"
                                :height="chart.height"
                                :data-format="chart.dataFormat"
                                :data-source="chart.dataSource"
                                >
                            </fusioncharts>
                        </div>
                    </div>
                </div>
            </div>
            <div class="overlay" v-if="loading">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>

        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div id="chart-container1">
                            <fusioncharts
                                :type="chartInwCrawlsLast30Days.type"
                                :width="chartInwCrawlsLast30Days.width"
                                :height="chartInwCrawlsLast30Days.height"
                                :data-format="chartInwCrawlsLast30Days.dataFormat"
                                :data-source="chartInwCrawlsLast30Days.dataSource"
                                >
                            </fusioncharts>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="chart-container2">
                            <fusioncharts
                                :type="chartInwCrawlsByMonth.type"
                                :width="chartInwCrawlsByMonth.width"
                                :height="chartInwCrawlsByMonth.height"
                                :data-format="chartInwCrawlsByMonth.dataFormat"
                                :data-source="chartInwCrawlsByMonth.dataSource"
                                >
                            </fusioncharts>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div id="chart-container1">
                            <fusioncharts
                                :type="chartInwUpdatesLast30Days.type"
                                :width="chartInwUpdatesLast30Days.width"
                                :height="chartInwUpdatesLast30Days.height"
                                :data-format="chartInwUpdatesLast30Days.dataFormat"
                                :data-source="chartInwUpdatesLast30Days.dataSource"
                                >
                            </fusioncharts>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="chart-container2">
                            <fusioncharts
                                :type="chartInwUpdatesByMonth.type"
                                :width="chartInwUpdatesByMonth.width"
                                :height="chartInwUpdatesByMonth.height"
                                :data-format="chartInwUpdatesByMonth.dataFormat"
                                :data-source="chartInwUpdatesByMonth.dataSource"
                                >
                            </fusioncharts>
                        </div>
                    </div>
                </div>

            </div>
            <div class="overlay" v-if="loading">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3>Tech stack analyzer</h3>
                    </div>
                    <div class="box-body">
                        <div id="container2">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 98px;">Name</th>
                                        <th style="width: 112px;">IP</th>
                                        <th>Quantity</th>
                                        <th>
                                            Date
                                            <div style="float: right;">
                                                <input type="checkbox" id="checkbox" v-model="TechStackAnalyzer.showAll" style="cursor: pointer;">
                                                <label for="checkbox" style="cursor: pointer; margin-bottom: 0;">
                                                    Whole week
                                                </label>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="detection-row"
                                        v-for="(item, index) in TechStackAnalyzer.data"
                                        v-bind:key="index"
                                        v-show="(TechStackAnalyzer.showAll || item.assigned_at_formated == TechStackAnalyzer.currentDate)"
                                    >
                                        <td><strong>{{ showName(item.ip) }}</strong></td>
                                        <td>{{ item.ip }}</td>
                                        <td>{{ item.quantity }}</td>
                                        <td>{{ item.assigned_at_formated }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="overlay" v-if="loading1">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <leadgen-jobs-summary></leadgen-jobs-summary>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data : function () {
            return {
                "profilesLast7Days": '',
                "profilesLast24H": '',
                "profilesToday": '',
                "alertsLast7DaysAuto": '',
                "alertsLast24HAuto": '',
                "alertsTodayAuto": '',
                "alertsLast7DaysManual": '',
                "alertsLast24HManual": '',
                "alertsTodayManual": '',
                "snapshotsLast7Days": '',
                "snapshotsLast24H": '',
                "snapshotsToday": '',
                "alertsUnsolved": '',
                "loading": true,
                "loading1": true,
                "chart": {
                    "type":"mscolumn2d",
                    "renderAt":"chart-container1",
                    "width":"100%",
                    "height":"400",
                    "dataFormat":"json",
                    "dataSource":{
                        "chart": {
                            "caption": "InAware Jobs vs InAlerts",
                            "formatnumberscale": "1",
                            "plottooltext": "<b>$dataValue</b> <b>$seriesName</b> $label",
                            "drawcrossline": "1",
                            "showValues": "1",
                            "theme": "fusion"
                        },
                        "categories": [{
                            "category": [
                                {
                                "label": "Today"
                                },
                                {
                                "label": "Last 24hs"
                                },
                                {
                                "label": "Last 7 days"
                                }
                            ]
                        }],
                        "dataset": []
                    }
                },
                "chartTotalAlerts": {
                    "type": "stackedcolumn2d",
                    "renderAt":"chart-container2",
                    "width":"100%",
                    "height":"400",
                    "dataFormat":"json",
                    "dataSource":{
                        "chart": {
                            "caption": "",
                            "formatnumberscale": "1",
                            "showValues": "1",
                            "theme": "fusion",
                            "plottooltext": "<b>$seriesName</b>: <b>$dataValue</b>",
                            "showLegend": "0",
                            "showSum": "1"
                        },
                        "categories": [{
                            "category": [{
                                "label": "Unsolved"
                            }]
                        }],
                        "dataset": [{
                            "seriesname": "",
                            "data": []
                        }]
                    }
                },

                "chartInwCrawlsLast30Days": {
                    "type": "stackedcolumn2d",
                    "width": '100%',
                    "height": '400',
                    "dataFormat":"json",
                    "dataSource":{
                        "chart": {
                            "plottooltext": "<b>$dataValue</b> contacts [priority $seriesName]",
                            "caption": "Inaware crawls last 30 days",
                            "xAxisName": "Last InAware crawl",
                            "yAxisName": "Record Count",
                            "theme": "fusion"
                        },
                        "categories": [
                            {
                                "category": []
                            }
                        ],
                        "data": []
                    }
                },

                "chartInwCrawlsByMonth": {
                    "type": "stackedbar2d",
                    "width": '100%',
                    "height": '400',
                    "dataFormat":"json",
                    "dataSource":{
                        "chart": {
                            "caption": "% contacts crawl InAware",
                            "plottooltext": "<b>$dataValue</b> contacts [$seriesName]",
                            "xAxisName": "InAware Priority",
                            "yAxisName": "Record Count (%)",
                            "showLegend": "0",
                            "stack100Percent": "1",
                            "showYAxisValues": "0",
                            "theme": "fusion"
                        },
                        "categories": [
                            {
                              "category": []
                            }
                        ],
                        "data": []
                    }
                },

                "chartInwUpdatesLast30Days": {
                    "type": "stackedcolumn2d",
                    "width": '100%',
                    "height": '400',
                    "dataFormat":"json",
                    "dataSource":{
                        "chart": {
                            "plottooltext": "<b>$dataValue</b> contacts [$seriesName]",
                            "caption": "Inaware updates last 30 days",
                            "xAxisName": "Last InAware update",
                            "yAxisName": "Record Count",
                            "theme": "fusion"
                        },
                        "categories": [
                            {
                              "category": []
                            }
                        ],
                        "data": []
                    }
                },

                "chartInwUpdatesByMonth": {
                    "type": "stackedbar2d",
                    "width": '100%',
                    "height": '400',
                    "dataFormat":"json",
                    "dataSource":{
                        "chart": {
                            "plottooltext": "<b>$dataValue</b> contacts [$seriesName]",
                            "caption": "% contacts updates InAware",
                            "formatnumberscale": "1",
                            "showLegend": "0",
                            "xAxisName": "InAware Priority",
                            "yAxisName": "Record Count (%)",
                            "showYAxisValues": "0",
                            "showPercentValues": "0",
                            "placevaluesinside": "0",
                            "stack100Percent": "1",
                            "theme": "fusion"
                        },
                        "categories": [
                            {
                              "category": []
                            }
                        ],
                        "data": []
                    }
                },
                "TechStackAnalyzer": {
                    "data": [],
                    "currentDate": '',
                    "showAll": false
                }
            }
        },
        methods: {
            showName(ip) {
                switch (ip) {
                    case '68.183.28.15':
                        return 'New York';
                    break;
                    case '162.243.128.175':
                        return 'San Francisco';
                    break;
                    default:
                        return 'Unknown';
                }
            }
        },
        mounted() {
            var app = this;
            apiGet(app);

            setInterval(function () {
                getTechStackAnalyzer(app);
            }, 30000);
            getTechStackAnalyzer(app);

            function getTechStackAnalyzer(app) {
                var currDate = new Date();

                var fYear = currDate.getFullYear();

                var month = currDate.getMonth() + 1;
                var fMonth = (month < 10) ? '0' + month : month;

                var date = currDate.getDate();
                var fDate = (date < 10) ? '0' + date : date;

                var currFormatedDate = fYear + '-' + fMonth + '-' + fDate;
                app.TechStackAnalyzer.currentDate = currFormatedDate;

                axios.get('/tech-stack-analyzer/status')
                .then(function (resp) {
                    app.TechStackAnalyzer.data = resp.data.data.status;
                    app.loading1 = false;
                })
                .catch(function (resp) {
                    app.loading1 = false;
                    console.log(resp);
                })
            }

            function apiGet(app) {
                var inawareStats = new Promise(function(resolve, reject){
                    axios.get('/inaware/stats')
                        .then(function (resp) {
                            app.updatesByMonth = resp.data.data.updates_by_month;
                            app.updatesLast30Days = resp.data.data.updates_30_days;
                            app.crawlsByMonth = resp.data.data.crawls_by_month;
                            app.crawlsLast30Days = resp.data.data.crawls_30_days;
                            resolve();
                        })
                        .catch(function (resp) {
                            reject(resp);
                        })
                })

                var inawareJobs = new Promise(function(resolve, reject){
                    axios.get('/jobs-manager/ping')
                        .then(function (resp) {
                            app.profilesLast7Days = resp.data.data.data.profilesLast7Days;
                            app.profilesLast24H = resp.data.data.data.profilesLast24H;
                            app.profilesToday = resp.data.data.data.profilesToday;
                            resolve();
                        })
                        .catch(function (resp) {
                            reject(resp);
                        })
                })

                var inalerts = new Promise(function(resolve, reject){
                    axios.get('/inalerts/ping')
                        .then(function (resp) {
                            app.alertsLast7DaysAuto = resp.data.data.data.alertsLast7DaysAuto;
                            app.alertsLast24HAuto = resp.data.data.data.alertsLast24HAuto;
                            app.alertsTodayAuto = resp.data.data.data.alertsTodayAuto;
                            app.alertsLast7DaysManual = resp.data.data.data.alertsLast7DaysManual;
                            app.alertsLast24HManual = resp.data.data.data.alertsLast24HManual;
                            app.alertsTodayManual = resp.data.data.data.alertsTodayManual;
                            app.snapshotsLast7Days = resp.data.data.data.snapshotsLast7Days;
                            app.snapshotsLast24H = resp.data.data.data.snapshotsLast24H;
                            app.snapshotsToday = resp.data.data.data.snapshotsToday;
                            app.alertsUnsolved = resp.data.data.data.alertsUnsolved;
                            resolve();
                        })
                        .catch(function (resp) {
                            reject(resp);
                        })
                })

                Promise.all([inawareStats, inawareJobs, inalerts]).then(function() {

                    var dataset = [
                            {
                                "seriesname": "InAware Jobs",
                                "data": [
                                    {
                                    "value": app.profilesToday
                                    },
                                    {
                                    "value": app.profilesLast24H
                                    },
                                    {
                                    "value": app.profilesLast7Days
                                    }
                                ]
                            },
                            {
                                "seriesname": "Snapshots",
                                "data": [
                                    {
                                    "value": app.snapshotsToday
                                    },
                                    {
                                    "value": app.snapshotsLast24H
                                    },
                                    {
                                    "value": app.snapshotsLast7Days
                                    }
                                ]
                            },
                            {
                                "seriesname": "Auto InAlerts",
                                "data": [
                                    {
                                    "value": app.alertsTodayAuto
                                    },
                                    {
                                    "value": app.alertsLast24HAuto
                                    },
                                    {
                                    "value": app.alertsLast7DaysAuto
                                    }
                                ]
                            },
                            {
                                "seriesname": "Manual InAlerts",
                                "data": [
                                    {
                                    "value": app.alertsTodayManual
                                    },
                                    {
                                    "value": app.alertsLast24HManual
                                    },
                                    {
                                    "value": app.alertsLast7DaysManual
                                    }
                                ]
                            }
                        ]

                    app.chart.dataSource.dataset = dataset

                    app.chartInwUpdatesByMonth.dataSource.categories[0].category = app.updatesByMonth.category
                    app.chartInwUpdatesByMonth.dataSource.dataset = app.updatesByMonth.dataset

                    app.chartInwUpdatesLast30Days.dataSource.categories[0].category = app.updatesLast30Days.category
                    app.chartInwUpdatesLast30Days.dataSource.dataset = app.updatesLast30Days.dataset

                    app.chartInwCrawlsByMonth.dataSource.categories[0].category = app.crawlsByMonth.category
                    app.chartInwCrawlsByMonth.dataSource.dataset = app.crawlsByMonth.dataset

                    app.chartInwCrawlsLast30Days.dataSource.categories[0].category = app.crawlsLast30Days.category
                    app.chartInwCrawlsLast30Days.dataSource.dataset = app.crawlsLast30Days.dataset

                    app.alertsUnsolved.forEach(function(item) {
                        var data = [{
                                    "value": String(item.count)
                            }];

                        app.chartTotalAlerts.dataSource.dataset.push({
                            "seriesname": "Priority " + String(item.priority),
                            "data": data
                        });
                    });

                    app.loading = false
                }).catch(function(err){
                    app.loading = false
                    console.log('There is an error', err);
                })
            }
        }
    }
</script>
