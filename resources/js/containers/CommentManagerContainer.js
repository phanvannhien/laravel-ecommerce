import React, { Component } from 'react'
import PropTypes from 'prop-types'
import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';


import CommentItem from '../components/comments/CommentItem';
import { getCommentList, saveComment } from '../actions/commentActions';

class CommentManagerContainer extends Component{

    constructor( props ){
        super(props);
 
        this.state = ({
            mode: 'default',
            body: '',
            page: 1,
        });
    }

    // functions
    startEditing(){
        this.setState({
            mode: 'editing',
            body: ''
        })
    }

    stopEditing() {
        this.setState({
            mode: 'default',
            body: ''
        })
    }

    handleChangeTextComment(event){
        this.setState({
            body: event.target.value
        })
    }

    getLoadMoreComment(){
        let pagemore = this.state.page + 1;
        this.setState({
            page: pagemore
        }, () => {
            this.props.getCommentList( this.props.product, this.state.page );
        });
        
    }

    LoadMore(){
        if( this.state.page < this.props.last_page )
            return (
                <div>
                    <a className="btn btn-info btn-block" onClick={ () => this.getLoadMoreComment() }>Xem thêm</a>
                </div>
            )
        return (null);
    }

    saveCommentItem( parent_id ){
        if( this.state.body.length <= 0 ){
            toastr.success('Nhập 1 ít bình luận đã nhé');
            return false;
        }
        this.props.saveComment( this.props.product, this.state.body , parent_id);
        toastr.success('Gửi bình luận thành công');
        this.stopEditing();
    }

    // cycle

    // shouldComponentUpdate(nextProps, nextState){
    //     console.log( nextProps );
    //     console.log( nextState);
    //     return true;
    // }


    componentDidMount(){
        this.props.getCommentList( this.props.product, 1 );
    }

    render(){

        return (
            <div className="max-w-3xl mx-auto">
                <div className="bg-white rounded shadow-sm p-3 mb-4">
                    <div className="mb-4">
                        <h2 className="text-black">Bình luận</h2>
                    </div>
                    {
                        (this.props.user)?
                        (
                            <textarea 
                                value={this.state.body}
                                name="comment_body"
                                placeholder="Viết bình luận"
                                className="bg-grey-lighter rounded leading-normal resize-none w-full py-2 px-3 form-control"
                                onChange={ this.handleChangeTextComment.bind(this) }
                                onFocus={ this.startEditing.bind(this) }>
                             </textarea>
                        ): (
                            <div className="alert alert-success">
                                <a href="#" data-toggle="modal" data-target="#modal-login">Đăng nhập</a> để bình luận.</div>
                        )
                    }
                    
                    {
                        (this.state.mode == 'editing')
                        ?
                            (
                                <div className="mt-3">
                                    <button className="btn btn-primary btn-sm rounded mr-1" 
                                        onClick={ () => this.saveCommentItem(0) }>Gửi</button>
                                    <button className="btn btn-warning btn-sm rounded ml-1" 
                                        onClick={ () => this.stopEditing() }>Bỏ qua</button>
                                </div>
                            )
                        : ('') }
                        
                
                </div>

                <div className="clearfix">
                    {
                        this.props.comments.map( (comment, index) => {
                            
                            return <CommentItem
                                key={index}
                                id={comment.id}
                                user={this.props.user}
                                comment={comment}
                            />
                        })
                    }
                </div>
                {this.LoadMore()}
            </div>
        )
    }
}   



function mapStateToProps(state){
    return {
        last_page: state.comments.last_page,
        comments: state.comments.comments
    };
}

function mapDispatchToProps(dispatch) {
    return bindActionCreators({
        getCommentList: getCommentList,
        saveComment: saveComment
    }, dispatch);
}

export default connect( mapStateToProps,mapDispatchToProps )(CommentManagerContainer);