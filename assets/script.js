let j = jQuery.noConflict()

let authors = new Vue({
    el: '#authors-list',
    data: {
        list: {}
    },
    created: function(){
        j.ajax({
            type:"POST",
            url: we_ajax_vars.url,
            data: {
                action:'we_authors',
                nonce: we_ajax_vars.wenonce
            },
            dataType: 'json',
            success:function(response){
                authors.list = response
            }
        });

    }
})
