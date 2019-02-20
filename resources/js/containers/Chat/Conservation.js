import React from 'react';
import styles from './style.scss';
import { connect } from 'react-redux';
import {bindActionCreators} from 'redux';

import {
    loadMessage,
    sendMessage,
}
from '../../actions/messageActions';

class Conservation extends React.Component{

    constructor(props){
        super(props);
        this.state = {
            messageText : ''
        }

       

            
    }


    handleChangeTextMessage(evt){
        this.setState({
            messageText: evt.target.value
        });
    }

    handlePressTextMessage(evt){
        
        if (evt.key === 'Enter') {
            if( evt.target.value == '' ){
                event.target.focus();
                return false;
            }else{
                this.props.sendMessage( this.props.user, this.props.contact, this.state.messageText )
            }

        }
    }

    render(){
        return(
            <div className={ styles.message_modal}  >
                <div className={styles.message_modal_heading}>
                    <div className={styles.message_modal_user_heading}>
                        <span>{this.props.contact.user_name}</span>
                    </div>
                </div>
                <div className={styles.message_modal_body}>

                </div>
                <div className={styles.message_modal_footer}>
                    <input className="form-control" name="message" id="" rows="2"
                        onChange={this.handleChangeTextMessage.bind(this)}
                        onKeyPress={this.handlePressTextMessage.bind(this) }
                        placeholder=":)"
                    />
                </div>
            </div>
        )
    }
}


const mapDispatchToProps = (dispatch) => {
    return bindActionCreators({
        loadMessage: loadMessage,
        sendMessage: sendMessage
    }, dispatch)
    
}

const mapStateToProps = (state) => {
    return {
        
    }
};


export default connect( mapStateToProps, mapDispatchToProps )(Conservation);


