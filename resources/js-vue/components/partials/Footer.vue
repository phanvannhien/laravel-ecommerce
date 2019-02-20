<template>
    <footer :class="[$style.footer]">
        <div></div>
        <div :class="[$style.footer_main]">
            <div class="container">

            </div>
        </div>
        <div>
            <div class="container">
            </div>
        </div>
        <div :class="[$style.footer_copy]">
            <div class="container">
                <p>Real Linkking là sân chơi kết nối giữa các SALE bất động sản và khách hàng. Đăng tin thoải mái tự do bung lụa</p>
                <p class="text-center">
                    Copyright &copy; 2018 by landlinking.com,
                    <router-link :to="{name: 'about'}">Về chúng tôi</router-link>
                    <router-link :to="{name: 'terms'}">Điều khoản</router-link>
                </p>
                <p>Website đang trong giai đoạn thử nghiệm</p>
            </div>
        </div>
    </footer>
</template>
<style lang="scss" scoped module>
    .footer{
        background: #eaeaea;

        .footer_copy{
            text-align: center;
            background: darken( #eaeaea, 5% );
            padding: 1rem 0;
            p{
                margin-bottom: 0;
                font-size: 0.8rem;
                color: #737373;
            }
            ul{
                list-style: none;
                margin: 0;
                padding: 0;
                li{
                    float: left;
                    margin-right: 1rem;
                    &:last-child{
                    margin-right: 0;
                    }
                }
            }
        }
    }
</style>
