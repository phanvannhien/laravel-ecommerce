<template>
	<div class="">
		<Header></Header>
        <div :class="[$style.top_user]">
            <div class="container">
                <div :class="[$style.user_wall_avatar]">
                    <img class="rounded-circle img-thumbnail mx-auto d-block" :src="'/assets/img/no-image.png'" alt="">
                    <a class=""><i class="fas fa-camera"></i></a>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center align-items-stretch">
                <UserNav></UserNav>
                <div id="primary" class="col-md-9">
                    <div class="p-4">
                        
                        <p class="clearfix">

                           <b-btn v-b-modal.modal-post class="btn btn-success"><i class="far fa-edit"></i> Đăng bài</b-btn>

                        </p>
                    </div>
                </div>

            </div>
        </div>

		<Footer></Footer>
        <CreatePost></CreatePost>
	</div>
</template>

<style lang="scss" scoped module>
    .top_user{
        background-image: url('../../assets/img/bg.jpg');
        background-size:cover;
        background-position: top center;
        background-repeat: no-repeat;
        padding: 20px 0;
        position: relative;

        &:before{
            content: "";
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: -1px;
            /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#999999+0,383838+100&0+0,1+100 */
            background: -moz-linear-gradient(top, rgba(153,153,153,0) 0%, rgba(56,56,56,1) 100%); /* FF3.6-15 */
            background: -webkit-linear-gradient(top, rgba(153,153,153,0) 0%,rgba(56,56,56,1) 100%); /* Chrome10-25,Safari5.1-6 */
            background: linear-gradient(to bottom, rgba(153,153,153,0) 0%,rgba(56,56,56,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00999999', endColorstr='#383838',GradientType=0 ); /* IE6-9 */

        }

        

        .user_wall_avatar{
            position: relative;
            img{
                max-width: 100px;
            }
            a{
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                text-align: center;
                font-size: 2rem;
                opacity: 0.3;
            }
        }

    }

    
</style>

<script>
	import Header from './partials/Header'
    import Footer from './partials/Footer'
    import UserNav from './partials/UserNav'
    import CreatePost from './posts/CreatePost'
    
	export default {
		/*
		Register the components with the layout.
		*/
		components: {
			Header,
            Footer,
            UserNav,
            CreatePost
		},
	}
</script>