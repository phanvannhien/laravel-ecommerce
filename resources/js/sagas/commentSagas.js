// actions

import { 
    GET_COMMENT, 
    SAVE_COMMENT, 
    UPDATE_COMMENT, 
    DELETE_COMMENT,
    REPLY_COMMENT,
    GET_COMMENT_SUCCESS,
    GET_COMMENT_FAIL
}
from '../actions/actionTypes';

//Saga effects
import { put, takeLatest, call } from 'redux-saga/effects';
import { commentApi } from './commentApi';

function* fetchComments( vars ) {
    
    try {
        const getCommentData = yield commentApi.getComment(vars);
        yield put({ type: GET_COMMENT_SUCCESS, payload: { 
            comments: getCommentData.data.data, 
            last_page: getCommentData.data.last_page } 
        }); // from action.payload 

    } catch (error) {        
        yield put({ type: GET_COMMENT_FAIL, error });
    }


}
export function* watchGetComments() { 
    yield take(GET_COMMENT, fetchComments);
}