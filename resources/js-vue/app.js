
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
require('slick-carousel');
require('magnific-popup');
require('icheck');
require('select2');

require('bootstrap-slider');

//===== Editor
//require('froala-editor');
// const Quill = require('quill');

const toastr = require('toastr');
const WOW = require('wowjs');

window.wow = new WOW.WOW({
    live: false
});
window.toastr = toastr;

window.Vue = require('vue')
Vue.component('comments-manager', require('./components/comments/CommentsManager.vue'));


new Vue({
    el: '#app',
})



// import BootstrapVue from 'bootstrap-vue'
//
//
// import Axios from 'axios'
// import router from './router'
//
// Vue.prototype.$http = Axios;
// const token = localStorage.getItem('token')
//
// if (token) {
//   Vue.prototype.$http.defaults.headers.common['Authorization'] = 'Bearer '+token
// }
//
// import 'bootstrap/dist/css/bootstrap.css'
// import 'bootstrap-vue/dist/bootstrap-vue.css'
//
// import store from './store.js'
//
// Vue.use(BootstrapVue);
//
// Vue.config.productionTip = false
//
// const app = new Vue({
//     router,
//     store,
//     //el: '#app'
// }).$mount('#app');





//require('../assets/vendor/MediaManager/js/manager')

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */


// const files = require.context('./', true, /\.vue$/i)

// files.keys().map(key => {
//     return Vue.component(_.last(key.split('/')).split('.')[0], files(key))
// })

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */



$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


jQuery(document).ready(function(){
    window.wow.init();

    $('#slider-price').slider({});
    $("#slider-price").on("slide", function(slideEvt) {
        var arrNum = slideEvt.value;

        $("#slider-price-text").text( arrNum[0].toString().replace(/\D/g, "")
            .replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ' - ' +  arrNum[1].toString().replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ".") );
    });

    $('.menu-tab').click(function(){
        $('.menu-hide').toggleClass('show');
        $('.menu-tab').toggleClass('active');
    });
    $('a').click(function(){
        $('.menu-hide').removeClass('show');
        $('.menu-tab').removeClass('active');
    });

    $(window).scroll(function() {
        if ($(this).scrollTop() > 0) {
            $('header').addClass("sticky");
        }else{
            $('header').removeClass("sticky");
        }
    });

    $('.scroll-to').on('click', function(e){
        e.preventDefault();
        var target = jQuery(this).attr('href');

        jQuery('html, body').animate({
            scrollTop: jQuery(target).offset().top - 84
        }, 500);
    });

    // $('.editor').froalaEditor({
    //     theme: 'gray',
    //     language: 'vi',
    //     height: 200
    // })

    // var quill = new Quill('.editor-container', {
    //     modules: {
    //         toolbar: [
    //             [{ header: [1, 2, false] }],
    //             ['bold', 'italic', 'underline'],
    //             ['image', 'code-block']
    //         ]
    //     },
    //     placeholder: 'Compose an epic...',
    //     theme: 'snow'  // or 'bubble'
    // });

    $('input[name="price"]').keyup(function (event) {
        // skip for arrow keys
        if (event.which >= 37 && event.which <= 40) return;
        // format number
        $(this).val(function (index, value) {
            return value
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        });
    });



    $('.video-popup').magnificPopup({
        type:'iframe',
        zoom: {
            enabled: true, // By default it's false, so don't forget to enable it
            duration: 300, // duration of the effect, in milliseconds
            easing: 'ease-in-out', // CSS transition easing function
            opener: function(openerElement) {
                return openerElement.is('a') ? openerElement : openerElement.find('a');
            }
        }
    });

    //
    // $('.select2').select2({
    //     width: '100%'
    // });
    $('#sl-real-cats').select2({
        width: '100%'
    });



    //Initialize Select2 Elements
    $('#sl-cities').select2({
        placeholder: "Tất cả Thành phố",
        width: '100%'
    });
    $('#sl-district').select2({
        placeholder: "Tất cả Quận/ Huyện",
        width: '100%'
    });
    $('#sl-ward').select2({
        placeholder: "Tất cả Phường/ Xã",
        width: '100%'
    });

    $('#sl-cities').on('select2:select', function (e) {
        var data = e.params.data;
        console.log(data);
        $('#sl-district').select2({
            ajax: {
                url: ajax.district,
                dataType: 'json',
                method: 'get',
                data:{
                    id: data.id
                },
                processResults: function (data) {
                    console.log(data);
                    return {
                        results: data
                    };
                }
            }
        }).val('').trigger('change');
    });

    $('#sl-district').on('select2:select', function (e) {
        var data = e.params.data;
        $('#sl-ward').select2({
            ajax: {
                url: ajax.ward,
                dataType: 'json',
                method: 'get',
                data:{
                    id: data.id
                },
                processResults: function (data) {
                    // Tranforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data
                    };
                }
            // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
            }
        }).val('').trigger('change');
    });


    $('#btn-save-post').on('click', function (e) {
        e.preventDefault();
        var form = $(this).closest('form');
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data:  $(form).serializeArray(),
            beforeSend: function(){
                $('body').addClass('loading');
            },
            success: function (res) {
                $('body').removeClass('loading');
                if( !res.success ){
                    $(form).find('#alert').html('').addClass('alert alert-danger');
                    for( var err in res.err ){
                        $(form).find('#alert').append(  res.err[err]+'<br/>' );
                    }

                }else{

                }

            },
            error: function (  ) {
                $('body').removeClass('loading');
            }
        })


    });

    $('#btn-login').on( 'click', function(e){
        e.preventDefault();
        var form = $('#frm-login');
        var url = form.attr('action');
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: {
                phone: $(form).find('input[name=phone]').val(),
                password: $(form).find('input[name=password]').val(),
            },
            beforeSend: function () {

            },
            success: function ( response ) {
                if( response.auth ){
                    window.location.reload();
                }
            },
            error: function(  jqXHR,  textStatus,  errorThrown){
                var alert = $(form).find('#alert');
                $(alert).html('').addClass('alert alert-danger');
                if( jqXHR.responseJSON.errors ){

                    for (var k in jqXHR.responseJSON.errors){
                        alert.append( k+': '+jqXHR.responseJSON.errors[k]+'<br/>' );
                    }
                }
            }
        });

    });

    $('#btn-register').on( 'click', function(e){
        e.preventDefault();
        var form = $('#frm-register');
        var url = form.attr('action');
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: form.serializeArray(),
            beforeSend: function () {

            },
            success: function ( response ) {
                console.log(response);
                if( response.success ){
                    window.location.reload();
                }
            },
            error: function(  jqXHR,  textStatus,  errorThrown){

                var msg = '';
                var alert = $(form).find('#alert');
                $(alert).addClass('alert alert-danger');
                $(alert).html('');
                if( jqXHR.responseJSON.errors ){

                    for (var k in jqXHR.responseJSON.errors){
                        alert.append( jqXHR.responseJSON.errors[k]+'<br/>' );
                    }

                }
            }
        });

    });


    $('.req-add-friend').on('click', function (e) {
        e.preventDefault();

    });


    $('.save-to-favorite').on( 'click', function(e){
        e.preventDefault();
        var pid = $(this).attr('data-id');
        var that = this;
        $.ajax({
            url: ajax.add_favorite,
            type: 'post',
            dataType: 'json',
            data: {
                id: pid
            },
            beforeSend: function () {

            },
            success: function ( response ) {
                if( response.success ){
                    if( response.type == 'add' ){
                        $(that).find('i').attr('class','fas fa-heart');
                    }
                    if( response.type == 'remove' ){
                        $(that).find('i').attr('class','far fa-heart');
                    }

                    toastr.success('Thành công');
                }
            },
            error: function(  jqXHR,  textStatus,  errorThrown){
                toastr.error( 'Có lỗi xảy ra, không thể thực thi' )
            }
        });

    });


    $('.req-add-friend').on( 'click', function(e){
        e.preventDefault();
        var pid = $(this).attr('data-contact');
        var that = this;
        $.ajax({
            url: ajax.add_friend,
            type: 'post',
            dataType: 'json',
            data: {
                id: pid
            },
            beforeSend: function () {
                $('body').addClass('loading');
            },
            success: function ( response ) {
                $('body').removeClass('loading');
                if( response.success ){
                    $(that).removeClass('req-add-friend').text(response.msg);
                    toastr.success(response.msg);
                }
            },
            error: function(  jqXHR,  textStatus,  errorThrown){
                $('body').removeClass('loading');
                toastr.error( 'Có lỗi xảy ra, không thể thực thi' )
            }
        });

    });


    $('#pop-user').on('click', function(e){
        e.preventDefault();
        $('#user-slide-menu').attr('class','animated slideInRight').show();
        $('#app').addClass('overlay');
    })



});

