import { 
    GET_CONTACT,
    GET_CONTACT_SUCCESS,
    GET_CONTACT_FAIL,
    GET_MESSAGES,
    SEND_MESSAGE,
    START_CHAT
    
} from '../actions/actionTypes';

const initialState = {
    loading: false,
    contacts: [],
    messagesBox: [] // msgbox { user: {}, active: false }
};


export default function messageReducer(
    state = initialState, action 
){
    //console.log(action);
    switch (action.type){
        case GET_CONTACT:
   
            return {
                ...state, 
                loading : true

            };
            
        case GET_CONTACT_SUCCESS:
            return {
                ...state, 
                loading : false,
                contacts: [...state.contacts, ...action.payload ]

            };

        case SEND_MESSAGE:
            return {
                ...state, 
                messagesBox: [ ...state.messagesBox, action.payload ]
            };

        case START_CHAT:

            const existBox = _.findIndex( state.messagesBox, (box) => box.contact.id == action.payload.id );
           

            if( existBox < 0){
                let box = { 
                    contact: action.payload,
                    active: true
                };
                return {
                    ...state, 
                    messagesBox: [ ...state.messagesBox, box ]
                };
            }



        default:
            return state;
    }

}

