<template>
    <div>
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">
                  <i class="fa fa-filter"></i> Filters
              </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body form-horizontal">
                <div class="form-group col-md-6">
                    <label for="inputKeywords" class="col-md-2 control-label">Keywords</label>
                    <div class="col-md-12">
                        <input 
                            type="text" 
                            class="form-control" 
                            id="inputKeywords" 
                            placeholder="Keywords"
                            v-model="filters.keywords"
                        >
                    </div>
                    
                    <label for="inputDomain" class="col-md-2 control-label">Domain</label>
                    <div class="col-md-12">
                        <input 
                            type="text" 
                            class="form-control" 
                            id="inputDomain" 
                            placeholder="Domain"
                            v-model="filters.domain"
                        >
                    </div>

                    <label for="date_start" class="col-md-4 control-label" style="text-align: left;">Start date</label>
                    <div class="col-md-12">
                        <datepicker 
                            v-model="filters.start" 
                            :format="customFormatter" 
                            :typeable="true" 
                            id="date_start" 
                            name="date_start" 
                            input-class="form-control">
                        </datepicker>
                    </div>
                    
                    <label for="date_end" class="col-md-4 control-label" style="text-align: left;">End date</label>
                    <div class="col-md-12">
                        <datepicker 
                            v-model="filters.end" 
                            :format="customFormatter" 
                            :typeable="true" 
                            id="date_end" 
                            name="date_end" 
                            input-class="form-control">
                        </datepicker>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label for="inputService" class="col-md-4 control-label" style="text-align: left;">Service tag</label>
                    <div class="col-md-12">
                        <select 
                            name="inputService" 
                            id="inputService" 
                            v-model="filters.serviceTag"
                            class="form-control"
                        >
                            <option :value="null">All</option>
                            <option v-for="serviceTag in filters.serviceTags" 
                                v-bind:key="serviceTag.Id"
                                :value="serviceTag.Id"
                            >
                                {{ serviceTag.Name }}
                            </option>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label class="typo__label">Services</label>
                        <multiselect 
                            v-model="filters.service" 
                            :options="servicesByTag" 
                            :multiple="true" 
                            :close-on-select="true" 
                            :clear-on-select="false" 
                            :preserve-search="true" 
                            placeholder="Filter by service" 
                            label="ServiceName" 
                            track-by="ServiceId" 
                            :preselect-first="true"
                        >
                            <template slot="selection" slot-scope="{ values, search, isOpen }">
                                <span 
                                    class="multiselect__single" 
                                    v-if="values.length &amp;&amp; !isOpen"
                                >
                                    {{ values.length }} services selected
                                </span>
                            </template>
                        </multiselect>
                        <div class="control-label">
                            <span
                                v-for="service in filters.service" 
                                v-bind:key="service.serviceId"
                                v-bind:class="{ 
                                    label: true, 
                                    'label-primary': true, 
                                }"
                                style="margin-right: 3px"
                            >
                                {{ service.ServiceName }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer clearfix">
                <button v-on:click="getRequests(1)" class="btn btn-primary">Filter</button>

                <button v-on:click="exportRequests()" class="btn btn-warning pull-right">
                    <span class="glyphicon glyphicon-download"></span>
                    .csv
                </button>
            </div>
            <div class="overlay" v-if="loadingFilters">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Total: {{ total }}</h3>
            </div>

            <div class="box-body">
                <div class="col-md-12 col-sm-12 col-xs-12 table-responsive no-padding">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Keywords</th>
                                <th>Domain</th>
                                <th style="width: 40%">Vanity Url</th>
                                <th>Service</th>
                                <th>Date</th>
                            </tr>
                            <tr 
                                class="detection-row" 
                                v-for="(request, index) in requests" 
                                v-bind:key="request.request_id"
                            >
                                <td>{{ request.request_id }}</td>
                                <td>{{ request.keyword }}</td>
                                <td>{{ request.domain }}</td>
                                <td class="word-wrap">{{ request.vanity_url }}</td>
                                <td>
                                    <span 
                                        v-on:click="showRedirects(index)"
                                        style="cursor:pointer;"
                                    >R:</span> {{ request.service_redirect }}
                                    <br>
                                    <span 
                                        v-on:click="showScripts(index)"
                                        style="cursor:pointer;"
                                    >S:</span> {{ request.service_script }}
                                </td>
                                <td>{{ request.updated_at }}</td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <li
                        v-show="(firstPage != 0)"
                        v-on:click="getRequests(firstPage)"
                    >
                        <a href="#">«</a>
                    </li>

                    <li
                        v-for="page in pages" 
                        v-bind:key="page" 
                        v-on:click="getRequests(page)"
                    >
                        <a href="#"
                            v-bind:class="{ currentPage: currPage == page }"
                        >{{ page }}</a>
                    </li>

                    <li
                        v-show="(lastPage != 0)"
                        v-on:click="getRequests(lastPage)"
                    >
                        <a href="#">»</a>
                    </li>
                </ul>
            </div>
            <div class="overlay" v-if="loading">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data : function () {
            return {
                requests: [],
                total: 0,
                limit: 0,
                currPage: 0,
                firstPage: 0,
                lastPage: 0,
                pages: [],
                filters: {
                    services: [],
                    serviceTags: [],
                    service: [],
                    serviceTag: null,
                    domain: '',
                    keywords: '',
                    start: '',
                    end: '',
                },
                loading: true,
                loadingFilters: true
            }
        },
        computed: {
            servicesByTag:  function () {
                var filteredServices = [];
                var app = this;
                
                for (var i = 0; i < app.filters.services.length; i++) {
                    if (app.filters.serviceTag == null || app.filters.services[i].TagId == app.filters.serviceTag) {
                        filteredServices.push(app.filters.services[i]);
                    }
                }

                return filteredServices;
            }
        },
        methods: {
            getRequests (page) {
                var app = this;
                app.loading = true;
                app.loadingFilters = true;
                app.requests = [];

                axios.post('/tech-stack-analyzer/requests', {
                    page: page,
                    limit: app.limit,
                    service: app.servicesAsParam(),
                    domain: app.filters.domain,
                    keywords: app.filters.keywords,
                    start: app.filters.start,
                    end: app.filters.end,
                })
                .then(function (resp) {
                    if (resp.data.data.requests !== undefined) {
                        for (var i = 0; i < resp.data.data.requests.length; i++) { 
                            app.requests.push({
                                'domain': resp.data.data.requests[i].domain,
                                'keyword': resp.data.data.requests[i].keyword,
                                'request_id': resp.data.data.requests[i].request_id,
                                'service_redirect': resp.data.data.requests[i].service_redirect,
                                'service_script': resp.data.data.requests[i].service_script,
                                'updated_at': resp.data.data.requests[i].updated_at,
                                'vanity_url': resp.data.data.requests[i].vanity_url,
                                'redirects': [],
                                'scripts': [],
                            });
                        }

                        app.total = resp.data.data.total;
                        app.limit = resp.data.data.limit;
                        app.currPage = resp.data.data.page;
                        app.pages = [];
                        var lastPage = Math.round(app.total / app.limit);

                        var start = ((app.currPage - 10) > 0) ? (app.currPage - 10) : 1;
                        var end = ((app.currPage + 10) <= lastPage) ? (app.currPage + 10) : lastPage;

                        app.firstPage = (app.total > 0) ? 1 : 0,
                        app.lastPage = (app.total > 0) ? lastPage : 0;

                        for (var j = start; j <= end; j++) {
                            app.pages.push(j);
                        }

                        app.filters.services = resp.data.data.services;
                        app.filters.serviceTags = resp.data.data.tags;
                    }
                    
                    app.loadingFilters = false;
                    app.loading = false;
                })
                .catch(function (resp) {
                    app.loadingFilters = false;
                    console.log(resp);
                });
            },
            exportRequests() {
                var app = this;
                app.loading = true;
                
                axios.post('/tech-stack-analyzer/export_requests', {
                    service: app.servicesAsParam(),
                    domain: app.filters.domain,
                    keywords: app.filters.keywords,
                    start: app.filters.start,
                    end: app.filters.end,
                })
                .then(function (resp) {
                    console.log(resp.data.data);

                    var d = new Date();
                    var a = document.createElement('a');
                    const url = window.URL.createObjectURL(new Blob([resp.data.data]));
                    a.href = url;
                    a.setAttribute('download', 'tech-stack-analyzer-' + d.getFullYear() + '-' + d.getMonth() + '-' + d.getDate() + '_' + d.getTime() + '.csv');
                    a.click();
                    app.loading = false;
                })
                .catch(function (resp) {
                    console.log(resp);
                });
            },
            showRedirects (index) {
                var app = this;
                app.loading = true;

                if (!(app.requests[index].redirects.length > 0)) {
                    axios.get('/tech-stack-analyzer/redirects/' + app.requests[index].request_id)
                    .then(function (resp) {
                        app.requests[index].redirects = resp.data.data.redirects;
                        formatRedirects();
                    })
                    .catch(function (resp) {
                        console.log(resp);
                    });
                } else {
                    formatRedirects();
                }

                function formatRedirects() {
                    var text = '<div style="text-align:left;">';
                    text += "<ul style='word-wrap:break-word;'>";
                    for (var j = 0; j < app.requests[index].redirects.length; j++) {
                        text += '<li class="bg-info">' + app.requests[index].redirects[j] + '</li>';
                    }
                    text += '</ul>';
                    text += '</div>';

                    var title = app.requests[index].domain;

                    if (app.requests[index].service !== null) {
                        title += ' (' + app.requests[index].service_redirect + ')';
                    }

                    app.$swal({
                        width: 900,
                        title: title,
                        html: text
                    })
                }

                app.loading = false;
            },
            showScripts (index) {
                var app = this;
                app.loading = true;

                if (!(app.requests[index].scripts.length > 0)) {
                    axios.get('/tech-stack-analyzer/scripts/' + app.requests[index].request_id)
                    .then(function (resp) {
                        app.requests[index].scripts = resp.data.data.scripts;
                        formatScripts();
                    })
                    .catch(function (resp) {
                        console.log(resp);
                    });
                } else {
                    formatScripts();
                }

                function formatScripts() {
                    var text = '<div style="text-align:left;">';
                    text += "<ul style='word-wrap:break-word;'>";
                    for (var j = 0; j < app.requests[index].scripts.length; j++) {
                        text += '<li class="bg-info">' + app.requests[index].scripts[j] + '</li>';
                    }
                    text += '</ul>';
                    text += '</div>';

                    var title = app.requests[index].domain;

                    if (app.requests[index].service !== null) {
                        title += ' (' + app.requests[index].service_script + ')';
                    }

                    app.$swal({
                        width: 900,
                        title: title,
                        html: text
                    })
                }

                app.loading = false;
            },
            customFormatter(date) {
                return moment(date).format('YYYY-MM-DD');
            },
            servicesAsParam () {
                var app = this;
                var services = '';

                if (app.filters.service !== null) {
                    for (var s = 0; s < app.filters.service.length; s++) {
                        services += app.filters.service[s].ServiceId + ','
                    }

                    services = services.slice(0, -1);
                }

                return services;
            }
        },
        mounted() {
            var app = this;
            //app.filters.start = moment(new Date).format('DD-MM-YYYY');
            app.filters.start = new Date;
            this.getRequests(1);
        }
    }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style>
.word-wrap {
    word-break: break-all;
}

.swal2-popup .swal2-content {
    font-size: 1.4em;
}

.bg-info {
    margin-bottom: 10px;
}

.currentPage {
    background-color: #bfbfbf !important;
}
</style>
