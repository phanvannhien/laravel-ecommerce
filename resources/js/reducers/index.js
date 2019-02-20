import { combineReducers } from 'redux';
import commentReducer from './commentReducer';
import messageReducer from './messageReducer';

const allReducers = combineReducers({
    comments: commentReducer,
    message: messageReducer
});

export default allReducers;