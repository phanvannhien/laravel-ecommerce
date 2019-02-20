<template>
    <div>
        <div v-show="state === 'default'">
            <div class="media">
                <img class="mr-3 rounded-circle img-circle" width="50" src="" :src="comment.author.avatar">
                <div class="media-body">
                    <button v-if="editable && user.id === comment.author.id " @click="state = 'editing'" class="btn btn-sm float-right">Sửa</button>
                    <h5 class="mt-0">{{comment.author.user_name}} <small class="text-black-50">{{ comment.created_at}}</small></h5>
                    <p>{{comment.body}}</p>
                </div>
            </div>
        </div>

        <div v-show="state === 'editing'">
            <textarea v-model="data.body"
                      placeholder=""
                      class="form-control">
            </textarea>
            <div class="flex flex-col md:flex-row">
                <button class="btn btn-sm" @click="saveEdit">Lưu</button>
                <button class="btn btn-sm" @click="resetEdit">Bỏ qua</button>
                <button class="btn btn-sm" @click="deleteComment">Xoá</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            user: {
                required: true,
                type: Object,
            },
            comment: {
                required: true,
                type: Object,
            }
        },
        data: function() {
            return {
                state: 'default',
                data: {
                    body: this.comment.body,
                }
            }
        },
        computed: {
            editable() {
                return this.user.id === this.comment.author.id;
            },
        },
        methods: {
            resetEdit() {
                this.state = 'default';
                this.data.body = this.comment.body;
            },
            saveEdit() {
                this.state = 'default';
                this.$emit('comment-updated', {
                    'id': this.comment.id,
                    'body': this.data.body,
                });
            },
            deleteComment() {
                this.$emit('comment-deleted', {
                    'id': this.comment.id,
                });
            }
        }
    }
</script>