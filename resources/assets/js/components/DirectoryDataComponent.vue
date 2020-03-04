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
                </div>
                <div class="form-group col-md-6">
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
            </div>
            <div class="box-footer clearfix">
                <button v-on:click="getContacts(1)" class="btn btn-primary">Filter</button>

                <button v-on:click="exportContacts()" class="btn btn-warning pull-right">
                    <span class="glyphicon glyphicon-download"></span>
                    .csv
                </button>
            </div>
            <div class="overlay" v-if="loadingFilters">
                <overlay></overlay>
            </div>
        </div>


        <div class="box box-primary" style="min-height: 400px;">
            <div class="box-header with-border">
              <h3 class="box-title">Total: {{ total }}</h3>
            </div>

            <div class="box-body">
                <div class="col-md-12 col-sm-12 col-xs-12 table-responsive no-padding">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Titulo</th>
                                <th>Desde</th>
                                <th>Compañía</th>
                                <th>Ubicación</th>
                                <th>Idiomas</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="detection-row"
                                v-for="(contact, index) in contacts"
                                v-bind:key="index"
                            >
                                <td>
                                    <a v-if="contact.publicURL" v-bind:href="'https://www.linkedin.com/in/' + contact.publicURL" target="_blank" >{{ contact.firstName }} {{ contact.lastName }}</a>
                                    <span v-else>{{ contact.firstName }} {{ contact.lastName }}</span>
                                </td>
                                <td>{{ contact.jobTitle }}</td>
                                <td>{{ contact.from }}</td>
                                <td>
                                    <a v-if="contact.companyLId" v-bind:href="'https://www.linkedin.com/company/' + contact.companyLId" target="_blank" >{{ contact.company }}</a>
                                    <span v-else>{{ contact.company }}</span>
                                </td>
                                <td>{{ contact.location }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <li
                        v-show="(firstPage != 0)"
                        v-on:click="getContacts(firstPage)"
                    >
                        <a href="#">«</a>
                    </li>

                    <li
                        v-for="page in pages"
                        v-bind:key="page"
                        v-on:click="getContacts(page)"
                    >
                        <a href="#"
                            v-bind:class="{ currentPage: currPage == page }"
                        >{{ page }}</a>
                    </li>

                    <li
                        v-show="(lastPage != 0)"
                        v-on:click="getContacts(lastPage)"
                    >
                        <a href="#">»</a>
                    </li>
                </ul>
            </div>
            <div class="overlay" v-if="loading">
                <overlay></overlay>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data : function () {
            return {
                contacts: [],
                total: 0,
                limit: 20,
                currPage: 0,
                firstPage: 0,
                lastPage: 0,
                pages: [],
                filters: {
                    start: '',
                    end: '',
                    //company: '',
                    //relevance: ''
                },
                loading: true,
                loadingFilters: true
            }
        },
        methods: {
            getContacts (page) {
                var app = this;
                app.loading = true;
                app.loadingFilters = true;
                app.contacts = [];

                axios.post('/directory/contacts', {
                    page: page,
                    limit: app.limit,
                    //company: app.filters.company,
                    //relevance: app.filters.relevance,
                    start: app.filters.start,
                    end: app.filters.end,
                })
                .then(function (resp) {
                    app.contacts = resp.data.data.contacts;

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

                    app.loading = false;
                    app.loadingFilters = false;
                })
                .catch(function (resp) {
                    console.log(resp);
                    app.loading = false;
                    app.loadingFilters = false;
                });
            },
            exportContacts() {
                var app = this;
                app.loading = true;
                app.loadingFilters = true;

                axios.post('/directory/export_contacts', {
                    //company: app.filters.company,
                    //relevance: app.filters.relevance,
                    start: app.filters.start,
                    end: app.filters.end,
                })
                .then(function (resp) {
                    console.log(resp.data.data);

                    var d = new Date();
                    var a = document.createElement('a');
                    const url = window.URL.createObjectURL(new Blob([resp.data.data]));
                    a.href = url;
                    a.setAttribute('download', 'directory-' + d.getFullYear() + '-' + d.getMonth() + '-' + d.getDate() + '_' + d.getTime() + '.csv');
                    a.click();
                    app.loading = false;
                    app.loadingFilters = false;
                })
                .catch(function (resp) {
                    console.log(resp);
                    app.loading = false;
                    app.loadingFilters = false;
                });
            },
            customFormatter(date) {
                return moment(date).format('YYYY-MM-DD');
            }
        },
        mounted() {
            var app = this;
            //app.filters.start = new Date;
            this.getContacts(1);
        }
    }
</script>

<style>
.currentPage {
    background-color: #bfbfbf !important;
}
</style>
