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
    title="Đăng ký"
    hide-footer
    id="register-modal">
      <b-form>
         <b-form-group id=""
            label="Số điện thoại"
            label-for="input-register-phone">
          <b-form-input 
              id="input-register-phone"
              type="tel"
              v-model="phone"
              required
              placeholder="0902181852">
          </b-form-input>
        </b-form-group>

        <b-form-group id=""
            label="Mật khẩu"
            label-for="input-register-password">
          <b-form-input 
              id="input-register-password"
              type="password"
              v-model="password"
              required
              placeholder="******">
          </b-form-input>
        </b-form-group>

        <b-form-group id=""
            label="Nhắc lại mật khẩu"
            label-for="iinput-register-password-confirm">
          <b-form-input id="input-register-password-confirm"
              type="password"
              v-model="password_confirmation"
              required
              placeholder="******">
          </b-form-input>
        </b-form-group>

        <b-button type="submit" variant="primary">Đăng nhập</b-button>
      </b-form>

      <p class="text-center">Đã có tài khoản? <a href="#" v-b-modal="'login-modal'">Đăng nhập</a> </p>

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
        phone: null,
        password: null,
        password_confirmation: null,
      }
    },

    /*
      Sets up the component on the mounted lifecycle hook.
    */
    mounted(){
 
    }
  }
</script>
