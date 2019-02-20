import { APP_CONFIG } from '../config.js';

export const util = {
    state: {
        cities: [],
        districts: [],
        wards: [],
    },
    actions: {
        getCities( { commit } ){
            
            axios.get(APP_CONFIG.API_URL + '/cities')
                    .then( function( response ){
                        commit( 'setCities', response.data );
                        commit( 'setDistricts', [] );
                        commit( 'setWards', [] );
                    })
                    .catch( function(){
                        commit( 'setCities', [] );
                    });
        },

        getDistricts( { commit }, data ){
            
            axios.get(APP_CONFIG.API_URL + '/city/'+data.city_id+'/districts')
                    .then( function( response ){
                        commit( 'setDistricts', response.data );
                        commit( 'setWards', [] );
                    })
                    .catch( function(){
                        commit( 'setDistricts', [] );
                    });
        },

        getWards( { commit }, data ){
            
            axios.get( APP_CONFIG.API_URL + '/district/'+data.district_id+'/wards' )
                .then( function( response ){
                    commit( 'setWards', response.data );
                })
                .catch( function(){
                    commit( 'setWards', [] );
                });
        },
       
    },
    mutations: {
        setCities( state, cities ){
            state.cities = cities;
        },
        setDistricts( state, districts ){
            state.districts = districts;
        },
        setWards( state, wards ){
            state.wards = wards;
        },
        
    },
    getters: {
        getCities( state ){
            return state.cities;
        },
        getDistricts( state ){
            return state.districts;
        },
        getWards( state ){
            return state.wards;
        },
    }
}