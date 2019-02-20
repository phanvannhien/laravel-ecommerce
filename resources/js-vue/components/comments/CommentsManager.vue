<template>
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded shadow-sm p-3 mb-4">
            <div class="mb-4">
                <h2 class="text-black">Bình luận</h2>
            </div>
            <textarea v-model="data.body"
                      placeholder="Nhập vào bình luận"
                      class="bg-grey-lighter rounded leading-normal resize-none w-full py-2 px-3 form-control"
                      :class="[state === 'editing' ? 'h-24' : 'h-10']"
                      @focus="startEditing">
            </textarea>
            <div v-show="state === 'editing'" class="mt-3">
                <button class="btn btn-primary btn-sm rounded mr-1" @click="saveComment">Gửi</button>
                <button class="btn btn-warning btn-sm rounded ml-1" @click="stopEditing">Bỏ qua</button>
            </div>
        </div>

        <div v-show=" comments.length > 0" class="bg-white rounded shadow-sm p-3">
            <comment v-for="(comment, index) in comments"
                     :key="comment.id"
                     :user="user"
                     :comment="comment"
                     :class="[index === comments.length - 1 ? '' : 'mb-3']"
                     @comment-updated="updateComment($event)"
                     @comment-deleted="deleteComment($event)">
            </comment>
        </div>

    </div>
</template>

<script>
    import comment from './CommentItem'
    export default {
        components: {
            comment
        },
        props: {
            user: {
                required: true,
                type: Object,
            },
            product:{
                required: true,
                type: Number,
            }
        },
        data: function() {
            return {
                state: 'default',
                data: {
                    body: ''
                },
                comments: []
            }
        },
        created() {
            this.fetchComments();
        },
        methods: {
            startEditing() {
                this.state = 'editing';
            },
            stopEditing() {
                this.state = 'default';
                this.data.body = '';
            },
            fetchComments() {
                const t = this;
                axios.get('/comments',{
                        params: {
                            product_id: t.$props.product
                        }
                    })
                    .then(({data}) => {
                        t.comments = data;
                    })
            },
            updateComment($event) {
                const t = this;
                axios.put(`/comments/${$event.id}`, $event)
                    .then(({data}) => {
                        t.comments[t.commentIndex($event.id)].body = data.body;
                        toastr.success('Sửa thành công');
                    })
            },
            deleteComment($event) {
                const t = this;
                axios.delete(`/comments/${$event.id}`, $event)
                    .then(() => {
                        t.comments.splice(t.commentIndex($event.id), 1);
                        toastr.success('Xoá thành công');
                    })
            },
            saveComment() {
                const t = this;
                if( t.data.body.toString().length <= 0 ){
                    toastr.error('Vui lòng nhập nội dung bình luận');
                    return false;
                }

                axios.post('/comments', {
                        body: t.data.body.toString(),
                        product_id: t.$props.product
                    })
                    .then(({data}) => {
                        toastr.success('Gửi bình luận thành công');
                        t.comments.unshift(data);
                        t.stopEditing();
                    })
            },
            commentIndex(commentId) {
                return this.comments.findIndex((element) => {
                    return element.id === commentId;
                });
            }
        }
    }
</script>