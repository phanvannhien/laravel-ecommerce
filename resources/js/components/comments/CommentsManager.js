import React, { Component } from 'react';

import CommentItem from './CommentItem';


class CommentManager extends Component{
    constructor( props ){
        super(props);
 
        this.state = ({
            comments: [],
            mode: 'default',
            body: ''
        });

        this.startEditing = this.startEditing.bind(this);
        this.handleChangeTextComment = this.handleChangeTextComment.bind(this);
        this.stopEditing = this.stopEditing.bind(this);
        this.saveComment = this.saveComment.bind(this);
        this.updateComment = this.updateComment.bind(this);
        this.deleteComment = this.deleteComment.bind(this);
        
    }

    
    // functions
    startEditing(){
        this.setState({
            mode: 'editing',
            body: ''
        })
    }

    handleChangeTextComment(event){
        this.setState({
            body: event.target.value
        })
    }

    stopEditing() {
        this.setState({
            mode: 'default',
            body: ''
        })
    }

    updateComment( id, body ) {

        console.log(id);
        axios.put(`/comments/${id}`,{
            body: body
        })
            .then(({data}) => {
                var n = this.state.comments;
                n[this.commentIndex(id)].body = data.body;
                this.setState({
                    comments: n
                })
                toastr.success('Sửa thành công');
            })
    }
    deleteComment( id ) {
      
        axios.delete(`/comments/${id}`)
            .then(() => {
                var n = this.state.comments;
                n.splice(this.commentIndex(id), 1);
                this.setState({
                    comments: n
                })

                toastr.success('Xoá thành công');
            })
    }
    saveComment() {
    
        if( this.state.body.length <= 0 ){
            toastr.error('Vui lòng nhập nội dung bình luận');
            return false;
        }else{
            axios.post('/comments', {
                body: this.state.body,
                product_id: this.props.product
            })
            .then(({data}) => {
                
                var n = this.state.comments;
                n.unshift(data);
                this.setState({
                    comments: n
                });
                toastr.success('Gửi bình luận thành công');
                this.stopEditing();
            })
        }

        
    }
    commentIndex(commentId) {
        return this.state.comments.findIndex((element) => {
            return element.id === commentId;
        });
    }

    // react components lycircle

    componentDidMount(){
        axios.get('/comments',{
            params: {
                product_id: this.props.product
            }
        })
        .then(({data}) => {
            
            this.setState({
                comments: data
            });
            //console.log(this.state.comments);
        })
    }

    render(){
        return(
            <div className="max-w-3xl mx-auto">
                <div className="bg-white rounded shadow-sm p-3 mb-4">
                    <div className="mb-4">
                        <h2 className="text-black">Bình luận</h2>
                    </div>
                    <textarea 
                            value={this.state.body}
                            name="comment_body"
                            placeholder="Nhập vào bình luận"
                            className="bg-grey-lighter rounded leading-normal resize-none w-full py-2 px-3 form-control"
                            onChange={this.handleChangeTextComment}
                            onFocus={ this.startEditing }>
                            
                    </textarea>
                    {
                        (this.state.mode == 'editing')
                        ?
                            (
                                <div className="mt-3">
                                    <button className="btn btn-primary btn-sm rounded mr-1" onClick={ this.saveComment }>Gửi</button>
                                    <button className="btn btn-warning btn-sm rounded ml-1" onClick={ this.stopEditing }>Bỏ qua</button>
                                </div>
                            )
                        : ''
                    }
                </div>

                <div className="clearfix">
                    {
                        this.state.comments.map( (comment, index) => {
                            return <CommentItem
                                key={comment.id}
                                user={this.props.user}
                                comment={comment}
                                updateComment={this.updateComment}
                                deleteComment={this.deleteComment}
                            />
                        })
                    }
                </div>

            </div>

        )
    }

}

export default CommentManager;