<template>
    <div class="box box-primary">
        <div class="box-header">
            <h3>Leadgen jobs</h3>
        </div>
        <div class="box-body">        
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th style="width: 5%">Cap</th>
                        <th style="width: 10%">Current</th>
                        <th style="width: 15%">Progress</th>
                        <th style="width: 6%"> </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(client) in clients" v-bind:key="client.id">
                        <td>{{ client.id }}</td>
                        <td>
                            <span v-bind:title="client.email">{{ client.name }} </span>
                        </td>
                        <td>{{ client.cap }}</td>
                        <td>{{ client.current }}</td>
                        <td>
                            <div class="progress progress-xs">
                                <div v-bind:class="['progress-bar', client.progressBarClass]" v-bind:style="{width: client.percent + '%' }"></div>
                            </div>
                        </td>
                        <td>
                            <span v-bind:class="['badge', client.badgeClass]">{{ client.percent }}%</span>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>{{ totals.cap }}</td>
                        <td>{{ totals.current }}</td>
                        <td>
                            <div class="progress progress-xs">
                                <div v-bind:class="['progress-bar', totals.progressBarClass]" v-bind:style="{width: totals.percent + '%' }"></div>
                            </div>
                        </td>
                        <td>
                            <span v-bind:class="['badge', totals.badgeClass]">{{ totals.percent }}%</span>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="overlay" v-if="loading">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
    </div>
</template>

<script>
    export default {
        data : function () {
            return {
                loading: true,
                clients: null,
                totals: {
                    cap: 0,
                    current: 0,
                    percent: 0,
                    progressBarClass: '',
                    badgeClass: ''
                }
            }
        },
        methods: {
            getStatus (app) {
                var clients = [];
                
                axios.get('/leadgen/status')
                .then(function (resp) {
                    var TotalCap = 0;
                    var TotalCurrent = 0;
                    var TotalPercent = 0;

                    for (var i = 0; i < resp.data.data.data.profilesToday.length; i++) {
                        var cap = resp.data.data.data.profilesToday[i].cap;
                        var current = resp.data.data.data.profilesToday[i].current;
                        var percent = 0;
                        percent = app.getPercent(current, cap);

                        clients.push({
                            id: resp.data.data.data.profilesToday[i].id,
                            active: resp.data.data.data.profilesToday[i].active,
                            name: resp.data.data.data.profilesToday[i].name,
                            email: resp.data.data.data.profilesToday[i].email,
                            cap: cap,
                            current: current,
                            percent: percent,
                            progressBarClass: app.getProgressBarClass(percent),
                            badgeClass: app.getBadgeClass(percent)
                        });

                        TotalCap += cap;
                        TotalCurrent += current;
                    }

                    TotalPercent = app.getPercent(TotalCurrent, TotalCap);

                    app.clients = clients;
                    app.totals = {
                        cap: TotalCap,
                        current: TotalCurrent,
                        percent: TotalPercent,
                        progressBarClass: app.getProgressBarClass(TotalPercent),
                        badgeClass: app.getBadgeClass(TotalPercent)
                    };

                    app.loading = false
                })
                .catch(function (resp) {
                    console.log(resp);
                });
            }, 
            getPercent (current, cap) {
                return (cap > 0) ? parseInt((100 * current)/cap) : 0
            },
            getProgressBarClass (percent) {
                if (percent < 30) {
                    return 'progress-bar-red';
                } else if (percent < 70) {
                    return 'progress-bar-yellow';
                } else {
                    return 'progress-bar-green';
                }
            },
            getBadgeClass (percent) {
                if (percent < 30) {
                    return 'bg-red';
                } else if (percent < 70) {
                    return 'bg-yellow';
                } else {
                    return 'bg-green';
                }
            },
        },
        mounted() {
            var app = this;
            app.loading = true;
            setInterval(function () {
                app.getStatus(app);
            }, 30000);
            app.getStatus(app);
        }
    }
</script>