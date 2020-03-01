@extends('layouts.admin')

@section('content-header')
    <h1>Best path</h1>
@endsection

@section('content')
    <style>
        ul.ui-autocomplete {
            max-height: 300px;
            overflow: auto;
        }
    </style>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Find company</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                <input type="text" id="term" name="term" class="form-control" placeholder="Company name.."></input>
            </div>
        </div>
    </div>

    <div class="box box-primary" id="box-list">
        <div class="box-header with-border">
            <h3 class="box-title">Contacts</h3>
        </div>
        <div class="box-body" id="search_result"></div>
        <div class="overlay">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        var _token = '{{ csrf_token() }}';

        $(function() {
            $('#term').autocomplete({
                minLength: 2,
                source: function (request, response) {
                    var input_term = $('#term').val();
                    $.ajax({
                        method: "post",
                        url: '/best_path/company/search/',
                        async:false,
                        dataType: "json",
                        data: { 
                            term: input_term,
                            _token: _token
                        }
                    }).done(function( data ) {
                        response( data );
                    });
                },
                select: function( event, ui ) {
                    $('#ter').val(ui.item.label);

                    $.ajax({
                        method: "post",
                        url: '/best_path/contacts/search/',
                        async:false,
                        dataType: "json",
                        data: {
                            company_id: ui.item.id,
                            _token: _token
                        },
                        beforeSend: function( request ) {
                            $("#box-list .overlay").css('display', 'block');
                        }
                    }).done(function( data ) {
                        $("#search_result").html('');
                        $.each(data, function( index, value ) {
                            var item =  "<div class='col-md-3 col-sm-6 col-xs-12'>";
                            item +=  "<div class='callout callout-success'>";
                            item +=  "<h4>" + value.first_name + ", " + value.last_name + "</h4>";
                            item +=  "<p>" + value.company_name + "</p>";
                            item +=  "<p>" + value.position + "</p>";

                            item +=  "<button class='btn btn-primary' type='button' data-toggle='collapse' data-target='#collapseContact" + value.contact_id + "' aria-expanded='false' aria-controls='collapseContact" + value.contact_id + "'>";
                            item +=  "Users: " + value.users.length;
                            item +=  "</button>";
                            item +=  "</p>";
                            item +=  "<div class='collapse' id='collapseContact" + value.contact_id + "'>";
                            item +=  "<div class='card card-body'>";

                            $.each(value.users, function( index, value ) {
                                item +=  "<p>" + value.user_name + " (" + value.days + " days)</p>";
                            });

                            item +=  "</div>";
                            item +=  "</div>";

                            item +=  "</div>";
                            item +=  "</div>";

                            $("#search_result").append(item);
                        });

                        $("#box-list .overlay").css('display', 'none');
                    });
                }
            }).data("ui-autocomplete")._renderItem = function (ul, item) {
                return $("<li></li>")
                    .data("item.autocomplete", item)
                    .append("<a>" + item.label + "</a>")
                    .appendTo(ul);
            };
        });
    </script>
@endpush