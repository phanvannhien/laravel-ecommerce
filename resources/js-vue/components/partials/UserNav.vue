<template>
    <div :class="[$style.sidebar]" class="col-md-3">
        <div :class="[$style.user_sidebar]">
            <ul>
                <li>
                    <router-link :to="{ name: 'user_posts' }">
                        <i class="fas fa-user-friends"></i> Bài Đăng
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'user_friends' }"><i class="fas fa-user-friends"></i> Bạn bè</router-link>
                </li>

            </ul>
        </div>
    </div>
</template>

<style lang="scss" scoped module>

.sidebar{
    border-right: 1px solid #d1d1d1;
    background: #f2f6f7;
    &:before{
        content: "";
        position: absolute;
        background-color: #f2f6f7;
        width: 100%;
        height: 100%;
        left: -100%;
    }

    .user_sidebar{
        height: 100%;
        position: relative;
        padding: 1rem;
        padding-left: 0;

        ul{
            list-style: none;
            margin: 0;
            padding: 0;
                li{
                    margin-bottom: 10px;
                a{
                    color: #666;
                    display: block;
                    padding: 5px 12px;
                    border: 1px solid transparent;
                    &:hover{
                        background: #f9f9f9;
                        border: 1px solid #ddd;
                        border-radius: 3px;
                    }
                    i{
                        margin-right:10px;
                    }
                }
            }
        }
    }
}
</style>

<script>
   
    export default {
        name: 'UserNav',
       
    }
</script>