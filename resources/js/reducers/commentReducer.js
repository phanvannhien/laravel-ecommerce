import React, { Component } from 'react';


import { GET_COMMENT, 
    SAVE_COMMENT, 
    UPDATE_COMMENT, 
    DELETE_COMMENT,
    REPLY_COMMENT
} from '../actions/actionTypes';

const initialState = {
    comments: [],
    last_page: 1
};

export default function commentReducer(
    state = initialState, action 
){
    switch (action.type){
        case GET_COMMENT:
    
            return {
                ...state, 
                comments : [...state.comments, ...action.payload.comments],
                last_page: action.payload.last_page
            };
        case SAVE_COMMENT:
            
        
            return {
                ...state,
                comments :  [...state.comments, action.payload.comment]
            }
            
        case REPLY_COMMENT:
            const replyItems = state.comments.map((item) => {
                if(item.id === action.payload.comment.id){
                    return { ...item, ...action.payload.comment }
                }
                return item
            });

            return {
                ...state,
                comments :  replyItems
            }
            
        case UPDATE_COMMENT:
        
            const updatedItems = state.comments.map((item) => {
                if(item.id === action.payload.comment.id){
                    return { ...item, ...action.payload.comment }
                }
                return item
            });

            return {
                ...state,
                comments :  updatedItems
            }
            
        case DELETE_COMMENT:
            if( action.payload.comment.parent_id === 0 ){
                return {
                    ...state,
                    comments :  state.comments.filter(item => item.id !== action.payload.comment.id ),
                }
            }else{


                const deletedItems = state.comments.map((item) => {
                    if(item.id === action.payload.comment.id){
                        return { ...item, ...action.payload.comment }
                    }
                    return item
                });

                return {
                    ...state,
                    comments :  deletedItems
                }
            }
            

        default:
            return state;
    }

 
}
