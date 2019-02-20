<template>

	<div :class="[$style.message_box]">
		<div :class="[$style.message_box_head]">MyName</div>
		<div :class="[$style.message_box_body]">
			<ul>
				<li class="clearfix">
					<div class="message-data align-right">
						<span class="message-data-time">April 11</span> &nbsp; &nbsp;
						<span class="message-data-name current-user-name">My name</span> <i class="fa fa-circle me"></i>

					</div>
					<div class="message float-right my-message">
						Hello guys
					</div>
				</li>
				<li class="clearfix">
					<div class="message-data align-right">
						<span class="message-data-time">April 11</span> &nbsp; &nbsp;
						<span class="message-data-name current-user-name">My name</span> <i class="fa fa-circle me"></i>

					</div>
					<div class="message float-right my-message">
						How are you
					</div>
				</li>
			</ul>
		</div>
		<div :class="[$style.message_box_footer]">
			<input type="text" class="form_control" v-model="message" placeholder=":)">
			<button class="btn btn-sm btn-success">SEND</button>
		</div>
	</div>    
</template>

<script>
    export default {
        data(){
            return {
				
			}
        }
    }
</script>



<style lang="scss" scoped module>
    .message_box{

    }

</style>
