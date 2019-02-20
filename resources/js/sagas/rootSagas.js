import { fork, call } from 'redux-saga/effects';

import { watchGetComments } from './commentSagas';
// import { watchMessage } from './messageSagas';

export default function* rootSaga() {
    yield [
        fork(watchGetComments),
        // fork(watchMessage),
    ];
}