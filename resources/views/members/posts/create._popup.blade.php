<div id="modal-post" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('user.post.save') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Đăng bài</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="alert"></div>
                    @csrf
                    <div class="form-group">
                        @foreach( App\Models\Type::select('id','type_name','type_slug')->get() as $type  )
                            <label for="{{ $type->type_slug }}">
                                <input id="{{ $type->type_slug }}" class="check-box" type="checkbox" name="real_type[]" value="{{ $type->id }}"> {{ $type->type_name }}
                            </label>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <input type="text" name="title" placeholder="Tiêu đề" class="form-control">
                    </div>
                    <div class="form-group">
                        <textarea name="description" id="" cols="30" rows="10" class="editor"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" name="price" placeholder="Giá tiền VND" class="form-control price">
                    </div>
                    <div class="form-group">
                        <label for="">Hình ảnh <a href="#" class="select-gallery-file btn btn-sm btn-success">
                                <i class="far fa-image"></i> Chọn ảnh</a></label>
                        <div id="galleries" class="row "></div>
                    </div>
                    <hr>

                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <select id="sl-cities" name="matp" class="form-control select2">
                                    @foreach( \App\Models\Cities::select('matp','name')->orderBy('name')->get() as $tp )
                                        <option value="{{ $tp->matp }}">{{ $tp->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <select id="sl-district" name="maqh" class="form-control select2">
                                </select>
                            </div>
                            <div class="col-sm-4">

                                <select id="sl-ward" name="xaid" class="form-control select2">
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" id="address" name="address" placeholder="Số nhà, tên đường" class="form-control">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" 
                                    id="get-marker">Lấy địa chỉ trên bản đồ</button>
                            </div>
                        </div>
                    
                    </div>

                    <div class="form-group">
                        <label for="">Kéo thả đúng vị trí trên bản đồ</label>
                        <div id="map" style="width: 100%;height: 350px"></div>
                    </div>
                    <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">@lang('product.lat')</label>
                                    <input id="map-lat" readonly type="text" class="form-control" name="lat" value=""/>
                                </div>
                                <div class="col-md-6">
                                    <label for="">@lang('product.lng')</label>
                                    <input id="map-lng" readonly type="text" class="form-control" name="lng" value=""/>
                                </div>
                            </div>
                        </div>
        
                    <hr>
                    <div class="form-group">
                        <label for="sl-real-cats">Chuyên mục</label>
                        <select id="sl-real-cats" name="real_cat[]" multiple class="form-control select2 select-multiple">
                            {!! App\Utils\Category::renderSelect( App\Category::get() ) !!}
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="vr">VR link</label>
                        <input type="text" name="vr" placeholder="VR link" class="form-control">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button id="btn-save-post" type="button" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ config('app.maps_api_key') }}">
</script>
<script>
    $(function(){

        $('.select-gallery-file').on('click', function(){
            CKFinder.popup( {
                chooseFiles: true,
                width: 800,
                height: 600,
                onInit: function( finder ) {
                    finder.on( 'files:choose', function( evt ) {
                        var file = evt.data.files;

                        evt.data.files.forEach( function( file ) {
                            var item = '<div class="text-center col w-20 g-item"><div class="">' +
                                '<img src="'+file.getUrl()+'" />' +
                                '<input type="hidden" name="galleries[]" value="'+ file.getUrl()+'">' +
                                '<a onclick="$(this).closest(\'div.g-item\').remove() "><i class="far fa-trash-alt"></i></a>' +
                                '</div></div>';

                            $('#galleries').append(item);

                        } );


                    } );

                }
            } );
        });


        $('.check-box').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });


        var map, marker;
        function initMap(  ) {
            mapcenter = new google.maps.LatLng(10.776577, 106.70085);
            updateLatLongFields(10.776577, 106.70085);
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