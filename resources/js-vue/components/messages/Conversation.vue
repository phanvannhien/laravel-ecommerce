<template>
    <div>
        <div :class="[$style.contact_box]">
            <ul v-for="room in chatrooms">
                <li @click="{{ startChat() }}">
                    {{ chatroom.name }}
                </li>
            </ul>
        </div>    
    </div>   
</template>

<script>
    export default {
        data(){
            return {
				chatrooms: [
					{
						id: 1,
						name: 'Chatroom 1',
						description: 'Join me and have fun'
					},
					{
						id: 2,
						name: 'Chatroom 2',
						description: 'Join me and have fun'
					}
				]
			}
        }
    }
</script>



<style lang="scss" scoped module>
    .contact_box{
        width: 320px;
        right: 0;
        bottom: 0;
        position: fixed;
        z-index: 999;
    }

</style>
