

function* getComment(params){
    const response =  yield axios.get('/comments',{
        params: {
            product_id: params.product_id,
            page: params.page
        }
    });

    return (response.status == 200 ) ? response.data : []
}

export const commentApi = {
    getComment
};


