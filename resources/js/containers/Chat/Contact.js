import React from 'react';

import styles from './style.scss';
import { connect } from 'react-redux';
import {bindActionCreators} from 'redux';
import {
    getContact,
    loadMessage,
    startChat,
}
from '../../actions/messageActions';

//Components

import Conservation from './Conservation';


class Contact extends React.Component{

    constructor(props){
        super(props);
        console.log('Props of Contact');
        console.log(props);

        console.log('Chatted');
       


    }

    componentDidMount(){
        this.props.onGetContact();
        window.Echo.private('chatroom.1')
        .listen('MessagePosted', (e) => {
            console.log('MessagePosted');
            console.log(e);
            // let message = e.message
            // message.user = e.user
            // this.list_messages.push(message)
        });
    }

   

    render(){
        return(
            <div>
                <div className={styles.contact_lst}>
                    <div className={styles.contact_lst_body}>
                        <ul>
                        {
                            this.props.contacts.map( contact =>{
                                return (
                                    <li key={contact.id} className="clearfix">
                                        <a onClick={ () => { this.props.onStartChat(contact) } }>
                                            <span className={styles.user_avatar}>
                                                {(contact.avatar)
                                                ? (<img width="32" src={contact.avatar} className="img-thumbnail rounded-circle" alt="" />)
                                                :  contact.user_name.substring(0,1)
                                                }
                                            </span>
                                            <span>{contact.user_name}</span>
                                        </a>
                                    </li>
                                )
                            })
                        }
                        </ul>
                    </div>
                </div>
                <div className={styles.message_lst}>
                    {
                        this.props.messagesBox.map( (item, i) => {
                            if( item.active )
                                return <Conservation key={i} 
                                    user={ JSON.parse(this.props.user) } 
                                    contact={item.contact} show="true" />
                        })
                    }
                </div>
                
            </div>
            
        )
    }

}


const mapDispatchToProps = (dispatch) => {
    return bindActionCreators({
        onGetContact: getContact,
        loadMessage: loadMessage,
        onStartChat: startChat
    }, dispatch)
    
}

const mapStateToProps = (state) => {
    return {
        contacts: !state.message.contacts ? [] : state.message.contacts,
        messagesBox: state.message.messagesBox,
    }
};


export default connect( mapStateToProps, mapDispatchToProps )(Contact);