import { 
    GET_COMMENT, 
    SAVE_COMMENT, 
    UPDATE_COMMENT, 
    DELETE_COMMENT,
    REPLY_COMMENT

} from './actionTypes';

export const getCommentList = ( product_id, page = 1 ) => {
    return dispatch => {
        return new Promise( (resolve, reject ) => {
            axios.get('/comments', {
                params: {
                    product_id: product_id,
                    page: page
                }
               
            })
            .then(({data}) => {
                dispatch({ 
                    type: GET_COMMENT,
                    payload: {
                        comments: data.data,
                        last_page: data.last_page
                    }
                });
            })
            .catch((error) => reject({message: error}));
        });
    }


}

export const saveComment = ( product_id, body, parent_id ) => {
    return dispatch => {
        return new Promise( (resolve, reject ) => {
            axios.post('/comments', {
                body: body,
                product_id: product_id,
                parent_id: parent_id
            })
            .then(({data}) => {
                dispatch({ 
                    type: SAVE_COMMENT,
                    payload: {
                        comment: data
                    }
                });
            })
            .catch((error) => reject({message: error}));
        });
    }
}

export const replyComment = ( product_id, body, parent_id ) => {
    return dispatch => {
        return new Promise( (resolve, reject ) => {
            axios.post('/comments', {
                body: body,
                product_id: product_id,
                parent_id: parent_id
            })
            .then(({data}) => {
                dispatch({ 
                    type: REPLY_COMMENT,
                    payload: {
                        comment: data
                    }
                });
            })
            .catch((error) => reject({message: error}));
        });
    }
}

export const updateComment = ( comment_id, body ) => {
    return dispatch => {
        return new Promise( (resolve, reject ) => {
            axios.put(`/comments/${comment_id}`,{
                body: body
            })
            .then(({data}) => {
                dispatch({ 
                    type: UPDATE_COMMENT,
                    payload: {
                        comment: data
                    }
                });
            })
            .catch((error) => reject({message: error}));

        });
    }
}


export const deleteComment = ( comment ) => {
    return dispatch => {
        return new Promise( (resolve, reject ) => {
            axios.delete(`/comments/${comment.id}`)
            .then(({data}) => {
                dispatch({ 
                    type: DELETE_COMMENT,
                    payload: {
                        comment: data
                    }
                });
            })
            .catch((error) => reject({message: error}));

        });
    }
}