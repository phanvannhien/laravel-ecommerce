
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');
require('./page');

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


import React, { Component } from 'react'
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';

import allReducers from './reducers';
import { createStore, applyMiddleware } from 'redux';
import thunk from 'redux-thunk';

//Redux saga
// import createSagaMiddleware from 'redux-saga';
// import rootSaga from './sagas/rootSagas'; 
// const sagaMiddleware = createSagaMiddleware();

const store = createStore(
    allReducers, 
    applyMiddleware(thunk) 
);


// Components
import CommentManagerContainer from './containers/CommentManagerContainer';
import Contact from './containers/Chat/Contact';

// comments
if (document.getElementById('comment-area')) {
    const component = document.getElementById('comment-area');
    const props = Object.assign({}, component.dataset);
    ReactDOM.render( 
        <Provider store={store}>
            <CommentManagerContainer {...props} />
        </Provider>, component);
}

// messages
if (document.getElementById('chat-room')) {
    const chat = document.getElementById('chat-room');
    const props = Object.assign({}, chat.dataset);
    ReactDOM.render( 
        <Provider store={store}>
            <Contact {...props} />
        </Provider>, chat);
}

