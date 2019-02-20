<form action="{{ route('user.post.update', $post->slug ) }}" method="post">
    @csrf
    <div id="alert"></div>
    <div class="form-group">
        <label for="sl-real-cats">Chuyên mục</label>
        <select id="sl-real-cats" name="real_cat[]" multiple class="form-control select2 select-multiple">
            {!! App\Utils\Category::renderSelectMultiple( App\Category::get(), $post->categories()->pluck('categories.id')->toArray() ) !!}
        </select>
    </div>


    <div class="form-group">
        <input type="text" name="title" placeholder="Tiêu đề" class="form-control" value="{{ old('title',$post->title) }}">
    </div>
    <div class="form-group">
        <textarea name="description" id="" cols="30" rows="10" class="editor">{!! old('description', $post->description) !!}</textarea>
    </div>
    <div class="form-group">
        <input type="text" name="price" placeholder="Giá tiền VND" class="form-control price" value="{{ number_format( $post->price ) }}">
    </div>
    <div class="form-group">
        <a id="lfm" data-input="thumbnail" data-preview="galleries" class="btn btn-primary">
            <i class="far fa-images"></i> Chọn hình
        </a>

    </div>
    <div class="form-group">
        <div id="galleries" class="row no-gutters">
            @foreach( $post->galleries as $img )
                <div class="text-center col-2 w-20 g-item">
                    <div class="">
                        <img src="{{ $img->image_url }}" />
                        <input type="hidden" name="galleries[]" value="{{ $img->image_url }}">
                        <a onclick="$(this).closest(\'div.g-item\').remove()"><i class="far fa-trash-alt"></i></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <hr>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-4">
                <select id="sl-cities" name="matp" class="form-control select2">
                    @foreach( \App\Models\Cities::select('matp','name')->orderBy('name')->get() as $tp )
                        <option {{ $post->matp == $tp->matp ? 'selected' : '' }} value="{{ $tp->matp }}">{{ $tp->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4">
                <select id="sl-district" name="maqh" class="form-control select2">
                    @foreach( \App\Models\District::where('matp', $user->matp )->orderBy('name')->select('maqh','name')->get() as $qh )
                        <option {{ $post->maqh == $qh->maqh ? 'selected' : '' }} value="{{ $qh->maqh }}">{{ $qh->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4">

                <select id="sl-ward" name="xaid" class="form-control select2">
                    @foreach( \App\Models\Wards::where('maqh', $user->maqh )->orderBy('name')->select('xaid','name')->get() as $xa )
                        <option {{ $post->xaid == $xa->xaid ? 'selected' : '' }} value="{{ $xa->xaid }}">{{ $xa->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="input-group">
            <input type="text" id="address" name="address" placeholder="Số nhà, tên đường" class="form-control" value="{{ old('address', $post->address) }}">
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
                <input id="map-lat" readonly type="text" class="form-control" name="lat" value="{{ old('lat', $post->lat) }}"/>
            </div>
            <div class="col-md-6">
                <label for="">@lang('product.lng')</label>
                <input id="map-lng" readonly type="text" class="form-control" name="lng" value="{{ old('lng', $post->lng) }}"/>
            </div>
        </div>
    </div>

    <hr>
    <div class="form-group">
        <label for="area">Diện tích (m2)</label>
        <input type="text" id="area" name="area" placeholder="200" class="form-control" value="{{ old('area', $post->area) }}">
    </div>

    <div class="form-group">
        <label for="legal">Giấy tờ pháp lý</label>
        <textarea class="form-control" name="legal" id="legal" cols="30" rows="3" placeholder="Có sổ đỏ">{{ old('legal', $post->legal) }}</textarea>

    </div>

    <div class="form-group">
        <label for="vr">VR link</label>
        <input type="text" name="vr" placeholder="VR link" class="form-control" value="{{ old('vr', $post->vr )}}">
    </div>
    <button type="submit" class="btn btn-primary">Lưu</button>
</form>


