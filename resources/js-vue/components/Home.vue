
<template>
	<div class="">
		<Header></Header>
		<Footer></Footer>
		<Login></Login>
		<Register></Register>
	</div>
</template>

<script>
	import Header from './partials/Header'
	import Footer from './partials/Footer'
	import Login from './partials/Login'
	import Register from './partials/Register'
	export default {
		created(){
		    if( this.$store.getters.isLoggedIn ){
                this.$store.dispatch( 'getUser' );
			}

		},
		/*
		Register the components with the layout.
		*/
		components: {
			Header,
			Footer,
			Login,
			Register
		}
		
	}
</script>