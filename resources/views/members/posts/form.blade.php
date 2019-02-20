@extends('layouts.app')
@section('main')
    @include('members.partials.top')
    <div id="user-page-container">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-stretch">
                @include('members.partials.sidebar')
                <div id="primary" class="col-md-9">
                    <div id="primary-inner" class="py-4">
                        @include('partials.messages')
                        @include('members.partials.toolbars')

                        @if( $mode )
                            @include('members.posts.create')
                        @else
                            @include('members.posts.edit')
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{ url('libs/summernote/summernote-bs4.js') }}"></script>
    <link rel="stylesheet" href="{{ url('libs/summernote/summernote-bs4.css') }}">
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('app.maps_api_key') }}"></script>
    <script>
        // Define function to open filemanager window
        var lfm = function(options, cb) {
            var route_prefix = (options && options.prefix) ? options.prefix : '/file-manager';
            window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
            window.SetUrl = cb;
        };
        // Define LFM summernote button
        var LFMButton = function(context) {
            var ui = $.summernote.ui;
            var button = ui.button({
                contents: '<i class="note-icon-picture"></i> ',
                tooltip: 'Insert image with filemanager',
                click: function() {

                    lfm({type: 'image', prefix: '/laravel-filemanager'}, function(lfmItems, path) {
                        lfmItems.forEach(function (lfmItem) {
                            context.invoke('insertImage', lfmItem.url);
                        });
                    });

                }
            });
            return button.render();
        };


        $(function(){
            $('#lfm').filemanager('image');
            $('.editor').summernote({
                toolbar: [

                    ['popovers', ['lfm']],
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['misc',['fullscreen','undo','redo','codeview']]
                ],
                buttons: {
                    lfm: LFMButton
                }
            });

            $('.check-box').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });

            var map, marker;
            @if( $mode )
                var center = { lat: 10.776577, lng: 106.70085 };
            @else
                var center = { lat: <?php echo $post->lat ?>, lng: <?php echo $post->lng ?> };
            @endif
            function initMap() {
                mapcenter = new google.maps.LatLng(center);
                updateLatLongFields(center.lat, center.lng);
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 15,
                    center: mapcenter,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });

                marker = new google.maps.Marker({
                    position: mapcenter,
                    map: map,
                    title: '',
                    draggable: true
                });

                var geocoder = new google.maps.Geocoder();
                document.getElementById('get-marker').addEventListener('click', function() {
                    if( $('#address').val() == '' ){
                        toastr.warning('Vui lòng nhập địa chỉ cụ thể');
                        return false;
                    }
                    geocodeAddress(geocoder, map);
                });

                google.maps.event.addListener(marker, 'dragend', function (event) {
                    document.getElementById("map-lat").value = this.getPosition().lat();
                    document.getElementById("map-lng").value = this.getPosition().lng();
                });
            }

            function geocodeAddress(geocoder, resultsMap) {
                var address = $('#address').val() +', '+ $('#sl-ward').find('option:selected').text() +', '+ $('#sl-district').find('option:selected').text()+', '+ $('#sl-cities').find('option:selected').text() ;
                console.log(address);
                geocoder.geocode({'address': address}, function(results, status) {
                    if (status === 'OK') {
                        resultsMap.setCenter( results[0].geometry.location );
                        marker.setPosition( results[0].geometry.location );
                        updateLatLongFields(results[0].geometry.location.lat(), results[0].geometry.location.lng());
                    } else {
                        alert('Geocode was not successful for the following reason: ' + status);
                    }
                });
            }
            initMap();

            function updateLatLongFields(lat, lng){
                document.getElementById("map-lat").value = lat;
                document.getElementById("map-lng").value = lng;
            }

        });

    </script>
    <script>
        (function( $ ){

            $.fn.filemanager = function(type, options) {
                type = type || 'file';

                this.on('click', function(e) {
                    var route_prefix = (options && options.prefix) ? options.prefix : '/file-manager';
                    var target_input = $('#' + $(this).data('input'));
                    var target_preview = $('#' + $(this).data('preview'));
                    window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
                    window.SetUrl = function (items) {

                        if( items.length > 6 ){
                            toastr.warning('Bạn được dùng tối đa 5 ảnh cho 1 tin');
                            return false;
                        }
//                        var file_path = items.map(function (item) {
//                            console.log(item);
//                            return item.url;
//                        }).join(',');
//
//                        // set the value of the desired input to image url
//                        target_input.val('').val(file_path).trigger('change');

                        // clear previous preview
                        target_preview.html('');

                        // set or change the preview image src
                        items.forEach(function (item) {
                            console.log(item);
                            var image = '<div class="text-center col-2 w-20 g-item"><div class="">' +
                                '<img src="'+item.thumb_url+'" />' +
                                '<input type="hidden" name="galleries[]" value="'+ item.thumb_url+'">' +
                                '<a onclick="$(this).closest(\'div.g-item\').remove() "><i class="far fa-trash-alt"></i></a>' +
                                '</div></div>';

                            target_preview.append(image);

//                            target_preview.append(
//                                $('<img>').css('height', '5rem').attr('src', item.thumb_url)
//                            );
                        });

                        // trigger change event
                        target_preview.trigger('change');
                    };
                    return false;
                });
            }

        })(jQuery);
    </script>
@endsection