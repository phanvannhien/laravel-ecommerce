<style lang="scss">
  @import '~bootstrap/scss/bootstrap';

  a.social-link{
    display: block;
    margin: auto;
    width: 230px;
    margin-top: 10px;
    margin-bottom: 10px;
  }

</style>

<template>
  <b-modal 
    title="Đăng nhập"
    hide-footer
    id="login-modal">
      <b-form @submit="onSubmit">
         <b-form-group id=""
            label="Số điện thoại"
            label-for="input-phone">
          <b-form-input 
              id="input-phone"
              type="tel"
              v-model="phone"
              required
              placeholder="Số điện thoại">
          </b-form-input>
        </b-form-group>

        <b-form-group id=""
            label="Mật khẩu"
            label-for="input-password">
          <b-form-input 
              id="input-password"
              type="password"
              v-model="password"
              required
              placeholder="Mật khẩu">
          </b-form-input>
        </b-form-group>
        <b-button type="submit" variant="primary">Đăng nhập</b-button>
      </b-form>

      <p class="text-center">Bạn chưa có tài khoản? <a href="#" v-b-modal="'register-modal'">Đăng ký</a> </p>

      <p class="text-center"> Hoặc đăng nhập với </p>
			<a href="#" class="social-link">
				<img src="/assets/img/google-login.svg"/>
			</a>

			<a href="#" class="social-link">
				<img src="/assets/img/facebook-login.svg"/>
			</a>
  </b-modal>
</template>

<script>
  /*
    Imports the event bus.
  */
  import { EventBus } from '../../event-bus.js';

  export default {
    /*
      Defines the data used by the component.
    */
    data(){
      return {
        show: false,
        phone: null,
        password: null,
      }
    },

    /*
      Sets up the component on the mounted lifecycle hook.
    */
    mounted(){

    },

    methods: {

      onSubmit( evt ){
        evt.preventDefault();
        this.$store.dispatch('login', { phone: this.phone, password: this.password })
          .then(() => this.$router.push('/'))
          .catch(err => console.log(err))
        
      },


    }
  }
</script>
