require('./bootstrap');

window.Vue = require('vue');

require('./plugins/sweet-alert-plugin');

// Vue.component('inalerts-list', require('./components/InAlertsTableComponent.vue'));
// Vue.component('inalerts-solve', require('./components/InAlertsSolveComponent.vue'));
// Vue.component('inalerts-experiences', require('./components/InAlertsExperiencesComponent.vue'));
// Vue.component('jobs-manager-dashboard', require('./components/JobsManagerDashboardTableComponent.vue'));
// Vue.component('jobs-manager-new-job', require('./components/JobsManagerNewJobFormComponent.vue'));
// Vue.component('jobs-manager-table', require('./components/JobsManagerTableComponent.vue'));
Vue.component('datepicker', require('../../../node_modules/vuejs-datepicker/dist/vuejs-datepicker.js'));
// Vue.component('closing-rate-upload', require('./components/ClosingRateUpload.vue'));
// Vue.component('closing-rate-pipe-dashboard', require('./components/ClosingRatePipeDashboard.vue'));
// Vue.component('UtilToolsDashboard', require('./components/UtilToolsDashboardComponent.vue'));
// Vue.component('tech-stack-analyzer-dashboard', require('./components/TechStackAnalyzerDashboardComponent.vue'));
//
// Vue.component('leadgen-jobs-summary', require('./components/LeadgenJobsSummaryComponent.vue'));
Vue.component('leadgen-data', require('./components/LeadgenDataComponent.vue'));

import VueFusionCharts from 'vue-fusioncharts';
import FusionCharts from 'fusioncharts';
import Charts from 'fusioncharts/fusioncharts.powercharts';
import Charts1 from 'fusioncharts/fusioncharts.charts';

import FusionTheme from 'fusioncharts/themes/fusioncharts.theme.fusion';
Vue.use(VueFusionCharts, FusionCharts, Charts, Charts1, FusionTheme);

import Multiselect from 'vue-multiselect';
Vue.component('multiselect', Multiselect);

// Resolves charts dependancy
Charts(FusionCharts);

const app = new Vue({
    el: '#v-app'
});
