<template>
    <div>
        <div :class="[$style.contact_box]">


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

    }

</style>
