
<style lang="scss" scoped module>
    @import '~bootstrap/scss/bootstrap';
	.header{
		background: #7474BF;  /* fallback for old browsers */
		background: -webkit-linear-gradient(to left, #348AC7, #7474BF);  /* Chrome 10-25, Safari 5.1-6 */
		background: linear-gradient(to left, #348AC7, #7474BF); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

		border-bottom: 1px solid darken( $green, 3% );
        padding: 0.3rem 0;
        
        .logo{
            color: #FFF;
            font-size: 2rem;
            line-height: 1;
            font-weight: 600;
        }

        .user_nav{
            float: right;
            ul{
                margin: 0;
                padding: 0;
                list-style: none;
                li{
                    float: left;
                    a{

                    }
                }
            }
        }

		@include media-breakpoint-down(lg){
		}

		@include media-breakpoint-down(md){
		}

		@include media-breakpoint-down(sm){
		}
	}

</style>
<template>
    <header :class="[$style.header]">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <div :class="[$style.logo]">RL</div>
                </div>
                <div class="col-md-9">
                    <div :class="[$style.user_nav]">
                        <ul>
                            <li v-if="!isLoggedIn">
                                <span class="login" v-b-modal="'login-modal'">Đăng nhập</span>
                            </li>
                            <li v-if="user">
                                <router-link :to="{ name: 'user_profile'}">
                                    <img :src="user.avatar" width="30" class="img-thumbnail rounded-circle"/>
                                    Hồ sơ
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>
<script>
import { EventBus } from '../../event-bus.js'

export default {
        
    computed: {
        isLoggedIn: function(){ return this.$store.getters.isLoggedIn},
        user: function(){ return this.$store.getters.getUser },

    },
    methods:{
       logout: function () {
            this.$store.dispatch('logout')
                .then(() => {
                    this.$router.push('/login')
                })
         }
    }
}
</script>
