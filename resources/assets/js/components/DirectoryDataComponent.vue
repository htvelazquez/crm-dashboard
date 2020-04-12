<template>
    <div>
        <div v-if="!loadingFilters" class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">
                  <i class="fa fa-filter"></i> Filtros de búsqueda
              </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body form-horizontal">
                <div class="form-group col-md-3">
                    <label for="title" class="col-md-4 control-label" style="text-align: left;">Titulo</label>
                    <div class="col-md-12">
                        <input v-model="filters.title" class="form-control" type="text" name="title" />
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="labels" class="col-md-4 control-label" style="text-align: left;">Etiquetas</label>
                    <div class="col-md-12">
                        <multiselect-labels
                            v-model="filters.tags"
                            :options="allTags"
                            :hideSelected="true"
                            :placeholder="''"
                            :max="2"
                            :selectLabel="'Enter para seleccionar'"
                            :taggable="true"
                            :multiple="true"></multiselect-labels>
                    </div>
                </div>
                <!--div class="form-group col-md-3">
                    <label for="date_start" class="col-md-4 control-label" style="text-align: left;">Fecha Inicio</label>
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
                </div-->
                <div class="form-group col-md-3">
                    <label for="languages" class="col-md-4 control-label" style="text-align: left;">Idioma</label>
                    <div class="col-md-12">
                        <select id="language" name="language" v-model="filters.language" class="form-control select2">
                            <option value="" selected></option>
                            <option value="de">Alemán</option>
                            <option value="zh">Chino</option>
                            <option value="es">Español</option>
                            <option value="fr">Francés</option>
                            <option value="en">Inglés</option>
                            <option value="it">Italiano</option>
                            <option value="ja">Japonés</option>
                            <option value="pt">Portugués</option>
                            <optgroup>
                                <option value="ab">Abjasia</option>
                                <option value="aa">Afar</option>
                                <option value="af">Africaans</option>
                                <option value="ay">Aimara</option>
                                <option value="ak">Akan</option>
                                <option value="sq">Albanés</option>
                                <option value="de">Alemán</option>
                                <option value="am">Amárico</option>
                                <option value="ar">Arábica</option>
                                <option value="an">Aragonés</option>
                                <option value="hy">Armenio</option>
                                <option value="as">Assamese</option>
                                <option value="av">Avaric</option>
                                <option value="ae">Avestan</option>
                                <option value="az">Azerbaiyán</option>
                                <option value="bm">Bambara</option>
                                <option value="ba">Bashkir</option>
                                <option value="bn">Bengalí</option>
                                <option value="be">Bielorruso</option>
                                <option value="my">Birmano</option>
                                <option value="bi">Bislama</option>
                                <option value="bs">Bosnio</option>
                                <option value="br">Bretón</option>
                                <option value="bg">Búlgaro</option>
                                <option value="ks">Cachemira</option>
                                <option value="ca">Catalán, Valenciano</option>
                                <option value="ch">Chamorro</option>
                                <option value="ce">Chechen</option>
                                <option value="cs">Checo</option>
                                <option value="ny">Chichewa, Chewa, Nyanja</option>
                                <option value="zh">Chino</option>
                                <option value="cv">Chuvashia</option>
                                <option value="si">Cingaleses, Cingaleses</option>
                                <option value="ko">Coreano</option>
                                <option value="co">Corso</option>
                                <option value="cr">Cree</option>
                                <option value="hr">Croata</option>
                                <option value="da">Danés</option>
                                <option value="kw">De Cornualles</option>
                                <option value="dv">Divehi, Dhivehi, Maldivas</option>
                                <option value="dz">Dzongkha</option>
                                <option value="cu">Eslavo, Antiguo Eslavo, Búlgaro Antiguo</option>
                                <option value="sk">Eslovaco</option>
                                <option value="sl">Esloveno</option>
                                <option value="es">Español, Castellano</option>
                                <option value="eo">Esperanto</option>
                                <option value="et">Estonia</option>
                                <option value="fo">Faroese</option>
                                <option value="fi">Finlandés</option>
                                <option value="fj">Fiyiano</option>
                                <option value="fr">Francés</option>
                                <option value="fy">Frisón</option>
                                <option value="ff">Fulah</option>
                                <option value="gd">Gaélico, Gaélico Escocés</option>
                                <option value="cy">Galés</option>
                                <option value="gl">Gallego</option>
                                <option value="lg">Ganda</option>
                                <option value="ka">Georgiano</option>
                                <option value="el">Griego Moderno (Desde El 1453)</option>
                                <option value="kl">Groenlandés, Groenlandia</option>
                                <option value="gn">Guaraní</option>
                                <option value="gu">Gujarati</option>
                                <option value="io">Hago</option>
                                <option value="ht">Haití, Criollo Haitiano</option>
                                <option value="ha">Hausa</option>
                                <option value="he">Hebreo</option>
                                <option value="hz">Herero</option>
                                <option value="hi">Hindi</option>
                                <option value="ho">Hiri Motu</option>
                                <option value="nl">Holandés, Flamenco</option>
                                <option value="hu">Húngaro</option>
                                <option value="ig">Igbo</option>
                                <option value="id">Indonesio</option>
                                <option value="en">Inglés</option>
                                <option value="ia">Interlingua</option>
                                <option value="iu">Inuktitut</option>
                                <option value="ik">Inupiak</option>
                                <option value="ga">Irlandesa</option>
                                <option value="is">Islandés</option>
                                <option value="it">Italiano</option>
                                <option value="ja">Japonés</option>
                                <option value="jv">Javanés</option>
                                <option value="kn">Kannada</option>
                                <option value="kr">Kanuri</option>
                                <option value="kk">Kazaja</option>
                                <option value="km">Khmer Central</option>
                                <option value="ki">Kikuyu, Gikuyu</option>
                                <option value="rw">Kinyarwanda</option>
                                <option value="ky">Kirguises, Kirguís</option>
                                <option value="rn">Kiroundi</option>
                                <option value="kv">Komi</option>
                                <option value="kg">Kongo</option>
                                <option value="kj">Kuanyama, Kwanyama</option>
                                <option value="ku">Kurdo</option>
                                <option value="lo">Lao</option>
                                <option value="la">Latín</option>
                                <option value="gv">Lengua De La Isla De Man</option>
                                <option value="bh">Lenguas De Bihari</option>
                                <option value="lv">Letón</option>
                                <option value="li">Limburgan, Limburger, Limburgués</option>
                                <option value="ln">Lingala</option>
                                <option value="lt">Lituano</option>
                                <option value="lu">Luba-Katanga</option>
                                <option value="lb">Luxemburgués, El Luxemburgués</option>
                                <option value="mk">Macedónio</option>
                                <option value="mg">Madagascarí</option>
                                <option value="ml">Malayalam</option>
                                <option value="ms">Malayo</option>
                                <option value="mt">Maltés</option>
                                <option value="mi">Maorí</option>
                                <option value="mr">Marathi</option>
                                <option value="mh">Marshallese</option>
                                <option value="mn">Mongol</option>
                                <option value="na">Nauru</option>
                                <option value="nv">Navajo, Navajo</option>
                                <option value="nd">Ndebele Del Norte</option>
                                <option value="nr">Ndebele Del Sur</option>
                                <option value="ng">Ndonga</option>
                                <option value="ne">Nepalí</option>
                                <option value="nb">Noruego</option>
                                <option value="no">Noruego</option>
                                <option value="nn">Nynorsk</option>
                                <option value="ie">Occidental, Occidental</option>
                                <option value="oc">Occitano</option>
                                <option value="oj">Ojibwa</option>
                                <option value="or">Oriya</option>
                                <option value="om">Oromo</option>
                                <option value="os">Osetia, Ossetic</option>
                                <option value="ee">Oveja</option>
                                <option value="pi">Pali</option>
                                <option value="ps">Pashto, Pushto</option>
                                <option value="fa">Persa</option>
                                <option value="pl">Polaco</option>
                                <option value="pt">Portugués</option>
                                <option value="pa">Punjabi, De Panjabi</option>
                                <option value="qu">Quechua</option>
                                <option value="rm">Romansh</option>
                                <option value="ro">Rumano, Moldavo, Moldovan</option>
                                <option value="ru">Ruso</option>
                                <option value="se">Sami Septentrional</option>
                                <option value="sm">Samoano</option>
                                <option value="sg">Sango</option>
                                <option value="sa">Sánscrito</option>
                                <option value="sc">Sardo</option>
                                <option value="sr">Serbio</option>
                                <option value="st">Sesotho Meridional</option>
                                <option value="sn">Shona</option>
                                <option value="ii">Sichuan Yi, Nuosu</option>
                                <option value="sd">Sindhi</option>
                                <option value="so">Somalí</option>
                                <option value="sv">Sueco</option>
                                <option value="su">Sundanese</option>
                                <option value="sw">Swahili</option>
                                <option value="ss">Swati</option>
                                <option value="tl">Tagalo</option>
                                <option value="ty">Tahití</option>
                                <option value="th">Tailandés</option>
                                <option value="ta">Tamil</option>
                                <option value="tt">Tártaro</option>
                                <option value="tg">Tayiko</option>
                                <option value="te">Telugu</option>
                                <option value="bo">Tibetano</option>
                                <option value="ti">Tigriño</option>
                                <option value="to">Tonga (Islas Tonga)</option>
                                <option value="ts">Tsonga</option>
                                <option value="tn">Tsuana</option>
                                <option value="tr">Turco</option>
                                <option value="tk">Turkmen</option>
                                <option value="tw">Twi</option>
                                <option value="uk">Ucranio</option>
                                <option value="ug">Uigur, Uigur</option>
                                <option value="ur">Urdu</option>
                                <option value="uz">Uzbeko</option>
                                <option value="wa">Valonia</option>
                                <option value="eu">Vasco</option>
                                <option value="ve">Venda</option>
                                <option value="vi">Vietnamita</option>
                                <option value="vo">Volapük</option>
                                <option value="wo">Wolof</option>
                                <option value="xh">Xhosa</option>
                                <option value="yi">Yídish</option>
                                <option value="yo">Yoruba</option>
                                <option value="za">Zhuang, Chuang</option>
                                <option value="zu">Zulú</option>
                            </optgroup>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="location" class="col-md-4 control-label" style="text-align: left;">Ubicación</label>
                    <div class="col-md-12">
                        <input v-model="filters.location" class="form-control" type="text" name="location" />
                    </div>
                </div>
            </div>
            <div class="box-footer clearfix">
                <button v-on:click="getContacts(1)" class="btn btn-primary">Filtrar</button>

                <button v-on:click="exportContacts()" class="btn btn-warning pull-right">
                    <span class="glyphicon glyphicon-download"></span>
                    Exportar
                </button>
            </div>
            <!--div class="overlay" v-if="loadingFilters">
                <overlay></overlay>
            </div-->
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
                                <th>Nombre</th>
                                <th>Titulo</th>
                                <th width="82px">Desde</th>
                                <th>Compañía</th>
                                <th>Ubicación</th>
                                <th>Idiomas</th>
                                <th>Etiquetas</th>
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
                                <td v-if="contact.languages">
                                    <span v-for="language in contact.languages" style="margin-right:4px;">
                                        <img v-if="language.icon" v-bind:src="language.icon" v-bind:title="language.label" v-bind:alt="language.iso2code" width="20px" />
                                        <span class="label label-default" v-else style="cursor:default;padding:.1em .6em .2em" v-bind:title="language.label">{{ language.iso2code }}</span>
                                    </span>
                                </td><td v-else></td>
                                <td v-if="contact.labels">
                                    <span style="margin-right:4px;" v-for="label in contact.labels" class="label label-primary"  >{{ label.name }}</span> <!-- v-bind:style="'color:#FFFFFF;background-color:#'+label.color" -->
                                </td><td v-else></td>
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
            <div class="overlay" v-if="loading" style="min-height: 600px;">
                <overlay></overlay>
            </div>
        </div>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';

    export default {
        data : function () {
            return {
                contacts: [],
                total: 0,
                limit: 20,
                currPage: 0,
                firstPage: 0,
                lastPage: 0,
                allTags: [],
                pages: [],
                filters: {
                    title: '',
                    tags: '',
                    language: '',
                    location: '',
                    //relevance: ''
                },
                loading: true,
                loadingFilters: true
            }
        },
        components: { Multiselect },
        methods: {
            getContacts (page) {
                var app = this;
                app.loading = true;
                app.loadingFilters = true;
                app.contacts = [];

                axios.post('/directory/contacts', {
                    page: page,
                    limit: app.limit,
                    title: app.filters.title,
                    tags: app.filters.tags,
                    language: app.filters.language,
                    location: app.filters.location,
                })
                .then(function (resp) {
                    app.contacts = resp.data.data.contacts;

                    app.total = resp.data.data.total;
                    app.limit = resp.data.data.limit;
                    app.currPage = resp.data.data.page;
                    app.pages = [];
                    var lastPage = Math.ceil(app.total / app.limit);

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
                    title: app.filters.title,
                    tags: app.filters.tags,
                    language: app.filters.language,
                    location: app.filters.location
                })
                .then(function (resp) {
                    console.log(resp.data.data);

                    var d = new Date();
                    var a = document.createElement('a');
                    const url = window.URL.createObjectURL(new Blob([resp.data.data]));
                    a.href = url;
                    a.setAttribute('download', 'cirenio_export-' + d.getFullYear() + '-' + d.getMonth() + '-' + d.getDate() + '_' + d.getTime() + '.csv');
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
            getLabels(){
                var app = this;

                axios.get('/directory/labels')
                    .then(function (resp) {
                        console.log(resp);
                        if (resp.status == 200){
                            app.allTags = resp.data;
                        }
                    }).catch(function (resp) {
                        alert('Falla al intentar cargar las etiquetas');
                        console.log(resp);
                });
            },
            // customFormatter(date) {
            //     return moment(date).format('YYYY-MM-DD');
            // }
        },
        mounted() {
            var app = this;
            //app.filters.start = new Date;
            this.getLabels(1);
            this.getContacts(1);
        }
    }

    // $(document).ready(function() {
    //     $('select#language').select2();
    // });
</script>

<style>
    .currentPage { background-color: #bfbfbf !important; }
</style>
