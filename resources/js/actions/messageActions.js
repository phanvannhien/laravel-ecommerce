import { 
    GET_CONTACT,
    GET_CONTACT_SUCCESS,
    GET_CONTACT_FAIL,
    GET_MESSAGES,
    SEND_MESSAGE,
    START_CHAT

} from '../actions/actionTypes';


export const getContact = () => {
    return dispatch => {
        return new Promise((resolve, reject) => {
            axios.get('/contact')
            .then(({data}) => {
                dispatch({ 
                    type: GET_CONTACT_SUCCESS,
                    payload: data
                });
            })
            .catch((error) => reject({message: error}));
        })
    };
}

export const loadMessage = ( user_id, page ) => {
    return dispatch => {
        return new Promise((resolve, reject) => {
            axios.get('/messages',{
                params: {
                    user_id: user_id,
                    page: page || 1
                }
            })
            .then(({data}) => {
                dispatch({ 
                    type: GET_MESSAGES,
                    payload: data
                });
            })
            .catch((error) => reject({message: error}));
        })
    };
}

export const sendMessage = ( user, contact, message ) => {


    return dispatch => {
        return new Promise((resolve, reject) => {
            axios.post('/messages',{
                contact_id: contact.id,
                message: message
            })
            .then(({data}) => {
                

                dispatch({ 
                    type: SEND_MESSAGE,
                    payload: data
                });
            })
            .catch((error) => reject({message: error}));
        })
    };
}

export const startChat = ( contact ) => {
    return dispatch => { 
        return dispatch({ 
            type: START_CHAT,
            payload: contact
        })
    };
}