@extends('master')

@section('content')
    <h2>쪽지 보내기</h2>
    <hr>
    @include('partial.flash.flash')

    @include('partial.forms.memo')


@stop

@section('js')
    <style>
        #project-label {
            display: block;
            font-weight: bold;
            margin-bottom: 1em;
        }
        #project-icon {
            float: left;
            height: 32px;
            width: 32px;
        }
        #project-description {
            margin: 0;
            padding: 0;
        }

        .ui-autocomplete {
            max-height: 100px;
            overflow-y: auto;
            /* prevent horizontal scrollbar */
            overflow-x: hidden;
            background: #60ecff;
        }
        /* IE 6 doesn't support max-height
         * we use height instead, but this forces the menu to always be this tall
         */
        * html .ui-autocomplete {
            height: 100px;
        }
    </style>

    <script>
        $(function() {
            var projects = [
                {
                    value: "jquery",
                    label: "jQuery",
                    desc: "the write less, do more, JavaScript library",
                    icon: "jquery_32x32.png"
                },
                {
                    value: "jquery-ui",
                    label: "jQuery UI",
                    desc: "the official user interface library for jQuery",
                    icon: "jqueryui_32x32.png"
                },
                {
                    value: "sizzlejs",
                    label: "Sizzle JS",
                    desc: "a pure-JavaScript CSS selector engine",
                    icon: "sizzlejs_32x32.png"
                }
            ];

            var users_tmp = [
                {
                    name: "Elissa Fadel",
                    email: "Johnnie.Senger@gmail.com"
                },
                {
                    name: "fade",
                    email: "fade@gmail.com"
                }
            ];

            console.log('users_tmp: '+typeof(users_tmp));
// {"id":1,"name":"Elissa Fadel","username":"","email":"Johnnie.Senger@gmail.com","avatar":"","provider":"","provider_id":"","active":0,"created_at":"2015-09-09 12:48:35","updated_at":"2015-09-09 12:48:35"}
            var users = [];
            $.ajax({
                type: "GET",
                url: "/userlist",
                dataType: "json",
                success: function (data) {

                    users = data;
                    console.log('아작스 실행');
                    console.log(data);
                    console.log('users type: '+typeof(users));


                }
            });





            $( "#me_recv_mb_id" ).autocomplete({
                minLength: 0,
                source: "/userlist"
                ,
                focus: function( event, ui ) {

                    console.log('포커스');
                    $( "#me_recv_mb_id" ).val( ui.item.name );
                    return false;
                },
                select: function( event, ui ) {
                    $( "#me_recv_mb_id" ).val( ui.item.email );
                    $( "#me_recv_mb_id" ).attr('value', ui.item.id );
                    console.log('선택');
//                    $( "#project-id" ).val( ui.item.value );
//                    $( "#project-description" ).html( ui.item.desc );
//                    $( "#project-icon" ).attr( "src", "images/" + ui.item.icon );


                    return false;
                }
            }).autocomplete( "instance" )._renderItem = function( ul, item ) {
                return $( "<li>" )
                        .append( "<img src='#'>"+"<a>" + item.name + "<br>" + item.email + "</a>" )
                        .appendTo( ul );
            };
        });
    </script>
@stop