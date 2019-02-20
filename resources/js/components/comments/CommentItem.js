import React, { Component } from 'react';
import PropTypes from 'prop-types';

import { getCommentList, 
    saveComment,
    updateComment, 
    deleteComment,
    replyComment
} from '../../actions/commentActions';
import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';

class CommentItem extends Component{
    constructor(props){
        super(props);

        this.state = ({
            body: '',
            commentItems: this.setPropToState( this.props.comment )
        });

        console.log( this.state.commentItems );

    }


    setPropToState(comment){
        var arr = [];
        arr[comment.id] = {
            mode : 'default',
            reply: false
        };
        if( comment.children ){
            comment.children.map( (item, index) => {
                arr[item.id] = {
                    mode : 'default',
                    reply: false
                };
            });
        }
        return arr;
    }

    componentWillReceiveProps(nextProps){
       // console.log(nextProps);
        const arr = this.setPropToState( nextProps.comment );
        this.setState(prevState => ({
            commentItems:  arr
           
        }));

        console.log( this.state.commentItems );

        // if (typeof nextProps.showAdvanced === 'boolean') {
        //     this.setState({
        //         showAdvanced: nextProps.showAdvanced
        //     })
        // }
    }
 
    startEditCommentItem( comment ){
        this.setState({
            body: comment.body
        });
        this.setState(prevState => ({
            commentItems: {
                ...prevState.commentItems,
                [comment.id]: { mode: 'editing' }
            },
        }));
    }

    cancelEditCommentItem(comment){
        this.setState(prevState => ({
            commentItems: {
                ...prevState.commentItems,
                [comment.id]: { mode: 'default' }
            },
        }));
    }

    handleChangeTextComment(event){
        this.setState({
            body: event.target.value
        })
    }

    saveComment( parent_id ){
        this.setState({
            mode: 'default'
        });
        this.props.updateComment( id, this.state.body );
    }

    updateCommentItem( comment ){
        if( this.state.body.length <= 0 ){
            return toastr.warning('Nhập 1 ít gì đó đã nhé');
        }
        this.props.updateComment( comment.id, this.state.body );
        this.cancelEditCommentItem(comment);
        return toastr.subscribe('Sửa thành công');

    }

    deleteCommentItem(comment){
        this.props.deleteComment( comment );
        //this.cancelEditCommentItem( comment );
        toastr.success('Xoá thành công');
    }

    renderCommentItem( user, comment ) {
        
        return (
            <div id={comment.id} key={comment.id} className="media">
                <img className="mr-2 rounded-circle img-circle"
                    width="24"
                    src={ comment.author.avatar } />
                <div className="media-body">
                    {
                        ( user.id === comment.author.id && this.state.commentItems[comment.id].mode == 'default') 
                        ?
                            (
                            <button
                            onClick={ () => this.startEditCommentItem( comment ) } 
                            className="btn btn-sm float-right text-primary">Sửa</button>)
                        : null
                    }

                    <h5 className="mt-0">
                        { comment.author.user_name} <small className="text-black-50">{ comment.created_at }</small>
                    </h5>
                    
                    {
                        
                        
                            ( this.state.commentItems[comment.id].mode == 'default' )
                            ?
                                (<div>
                                    <div className="bg-light rounded p-2">{comment.body}</div>
                                    {
                                        (!_.isEmpty(user)) ? 
                                        <p className="mb-0">
                                            <a onClick={()=>{ 
                                                let id = ( comment.parent_id === 0 ) ? comment.id : comment.parent_id;
                                                this.setState(prevState => ({
                                                    commentItems: {
                                                        ...prevState.commentItems,
                                                        [id]: {
                                                            mode : 'default',
                                                            reply: true
                                                        }
                                                    },
                                                }));
                                        
                                            }} className="btn btn-sm text-primary">Trả lời</a>
                                        </p>
                                        : null
                                    } 
                                    
                
                                </div>)
                            :    
                            (
                                <div> 
                                    <textarea name="body"
                                        onChange={ this.handleChangeTextComment.bind(this) }
                                        placeholder=""
                                        defaultValue={comment.body}
                                        className="form-control mb-2 bg-light"></textarea>
                                    <div className="clearfix mb-3">
                                        <button className="btn btn-sm text-primary" onClick={ () => this.updateCommentItem(comment)}>Lưu</button>
                                        <button className="btn btn-sm text-primary"  onClick={ () => this.cancelEditCommentItem(comment) } >Bỏ qua</button>
                                        <button className="btn btn-sm text-primary " onClick={ () => this.deleteCommentItem(comment)}>Xoá</button>
                                    </div>
                                </div>
                            )   
                        
                    }

                    {
                        (comment.children)?
                            comment.children.map( sub => this.renderCommentItem(user, sub))
                        : null
                    
                    }
                </div>

            </div>

        )

    }

    renderReplyForm( user, comment ){
        return (
            <div className="media">
                <img className="mr-2 rounded-circle img-circle"
                    width="24"
                    src={ user.avatar } />
                <div className="media-body">
                    <textarea 
                        defaultValue=''
                        name="comment_body_reply"
                        placeholder="Trả lời bình luận"
                        rows="1"
                        className="bg-grey-lighter rounded leading-normal resize-none w-full py-2 px-3 form-control"
                        onChange={ this.handleChangeTextComment.bind(this) }
                        onFocus={ () => {} }>
                        </textarea>
                    <div className="mt-3">
                        <button className="btn btn-primary btn-sm rounded mr-1" 
                            onClick={ () => {
                                this.props.replyComment( comment.product_id, this.state.body, comment.id );
                                this.setState(prevState => ({
                                    commentItems: {
                                        ...prevState.commentItems,
                                        [comment.id]: {
                                            mode : 'default',
                                            reply: false
                                        }
                                    },
                                }));

                            }}>Gửi</button>
                        <button className="btn btn-warning btn-sm rounded ml-1" 
                            onClick={ () => {
                                this.setState(prevState => ({
                                    commentItems: {
                                        ...prevState.commentItems,
                                        [comment.id]: {
                                            mode : 'default',
                                            reply: false
                                        }
                                    },
                                }));
                        
                            }}>Bỏ qua</button>
                    </div>
                </div>   
            </div> 
        )
    }

    render(){
        const user = ( this.props.user ) ? JSON.parse(this.props.user) : {};
        return (
            <div className="bg-white rounded shadow-sm mb-2 p-3">
    
                { this.renderCommentItem( user, this.props.comment ) }
            
                { 
                    ( this.state.commentItems[ this.props.comment.id ].reply ) ?
                        (this.renderReplyForm( user,this.props.comment ))
                    : null
                }
            </div>
        )
    }

}



function mapDispatchToProps(dispatch) {
    return bindActionCreators({
        saveComment: saveComment,
        updateComment: updateComment,
        deleteComment: deleteComment,
        replyComment: replyComment
    }, dispatch);
}

export default connect( null, mapDispatchToProps )(CommentItem);