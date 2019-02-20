<template>
    <b-modal size="lg" id="modal-post" title="Đăng bài">
        <b-form>

            <div class="form-group">
                <b-form-input id=""
                    type="text"
                    name="title"
                    required
                    placeholder="Tiêu đề">
                </b-form-input>
            </div>
            <div class="form-group">
                <div class="editor-container"></div>
            </div>
            <div class="form-group">
                <b-form-input id=""
                    type="text"
                    name="price"
                    required
                    placeholder="Giá tiền VND">
                </b-form-input>
            </div>

            <div class="form-group">
                <label for="">Hình ảnh</label>
                <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" @vdropzone-complete="afterComplete"></vue-dropzone>
            </div>

            <div class="form-group">
                <b-form-input id=""
                    type="text"
                    name="address"
                    required
                    placeholder="Địa chỉ">
                </b-form-input>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-sm-4">
                        <Select2 v-model="city_id" 
                            :options="cities" 
                            :settings="{ width: '100%' }" 
                            @select="changeCity($event)" />
                    
                    </div>
                    <div class="col-sm-4">
                        <Select2 v-model="district_id" 
                            :options="districts" 
                            :settings="{ width: '100%' }" 
                            @select="changeDistrict($event)" />
                    </div>
                    <div class="col-sm-4">
                        <Select2 v-model="ward_id" 
                            :options="wards" 
                            :settings="{ width: '100%' }" />
                       
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="">
                    <input id="" class="check-box" type="checkbox" name="real_type[]" value=""> dsa
                </label>
            </div>
            <div class="form-group">
                <select id="sl-real-cats" name="real_cat" multiple class="form-control select2 select-multiple">
                </select>
            </div>

        </b-form>
    </b-modal>
</template>

<script>
    import Select2 from 'v-select2-component'
    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'
    import { APP_CONFIG } from '../../config.js';

	export default {
        data () {
            return {
                city_id: null,
                district_id: null,
                ward_id: null,
                selected: null,
                dropzoneOptions: {
                    url: APP_CONFIG.API_URL + '/uploads',
                    thumbnailWidth: 120,
                    maxFilesize: 0.5,
                    //headers: { "My-Awesome-Header": "header value" }
                }
            }
        },
        methods: {
            changeDistrict({id, text}){

                this.$store.dispatch('getWards', { district_id: id });
            },
            changeCity({id, text}){
                this.$store.dispatch('getDistricts', { city_id: id });
            },

            afterComplete( file ){
                console.log(file);
            }
        },
        components:{
            Select2: Select2,
            vueDropzone: vue2Dropzone
        },
        created(){
            this.$store.dispatch('getCities');
        },
        computed: {
            cities(){
                return this.$store.getters.getCities;
            },
            districts(){
                return this.$store.getters.getDistricts;
            },
            wards(){
                return this.$store.getters.getWards;
            },
        }
	}
</script>