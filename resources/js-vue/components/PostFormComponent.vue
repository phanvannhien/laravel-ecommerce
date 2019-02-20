<form action="" method="post">

    <div class="form-group">
        <input type="text" name="title" placeholder="Tiêu đề" class="form-control">
    </div>
    <div class="form-group">
        <div class="editor-container"></div>
    </div>
    <div class="form-group">
        <input type="text" name="price" placeholder="Giá tiền VND" class="form-control price">
    </div>
    <div class="form-group">
        <label for="">Hình ảnh <a href="#" class="select-gallery-file btn btn-sm btn-success">
                <i class="far fa-image"></i> Chọn ảnh</a></label>
        <div id="galleries" class="row ">
        </div>
    </div>
    <hr>
    <div class="form-group">
        <div class="form-group">
            <input type="text" name="address" placeholder="Địa chỉ" class="form-control">
        </div>
        <div class="row">
            <div class="col-sm-4">

                <select id="sl-cities" name="matp" class="form-control select2">
                    @foreach( \App\Models\Cities::select('matp','name')->get() as $tp )
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
    <hr>
    <div class="form-group">
        @foreach( App\Models\Type::select('id','type_name','type_slug')->get() as $type  )
        <label for="{{ $type->type_slug }}">
            <input id="{{ $type->type_slug }}" class="check-box" type="checkbox" name="real_type[]" value="{{ $type->id }}"> {{ $type->type_name }}
        </label>
        @endforeach
    </div>
    <hr>
    <div class="form-group">
        <select id="sl-real-cats" name="real_cat" multiple class="form-control select2 select-multiple">
            {!! App\Utils\Category::renderSelect( App\Category::get() ) !!}
        </select>
    </div>

</form>