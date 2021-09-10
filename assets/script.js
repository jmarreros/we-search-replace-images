let j = jQuery.noConflict()

// Select author
Vue.component('select-author',{
    template:`<div class="loading" v-if="isLoading">Cargando...</div>
              <div v-else class="author-filter">
                <select id="authors">
                    <option :value="id" v-for="(author, id) in authors" :key="id">
                        {{ author }}
                    </option>
                </select>
                <button class="button" v-on:click="sendIdAuthor" >Filtrar</button>
              </div>`,
    data () {
        return {
            isLoading: true,
            authors: {}
        };
    },
    created: function(){
        let that = this

        j.ajax({
            type:"Post",
            url: we_ajax_vars.url,
            dataType: 'json',
            data: {
                action:'we_authors',
                nonce: we_ajax_vars.wenonce
            },
            success:function(response){
                that.isLoading = false
                that.authors = response
            }
        })
    },
    methods: {
        sendIdAuthor(){
            const idAuthor = j('#authors').val()
            const nameAuthor = j('#authors option:selected').text()

            this.$root.$emit('select-author-id', idAuthor, nameAuthor)
        }
    }
})

// Show content entries
Vue.component('entries-author',{
    template:`<div class="loading" v-if="!isLoaded">{{textLoading}}</div>
              <div v-else class="entries">
                <div class="entry" v-for="entry in entries">
                    <div class="title">{{ entry.title }}</div>
                    <div class="options">
                        <button class="button">Ver</button>
                    </div>
                </div>
              </div>`,
    data(){
        return {
            textLoading :'',
            isLoaded: null,
            entries: []
        }
    },
    mounted(){
        this.$root.$on('select-author-id', (id, name) => {
            let that = this
            let $button = j('.author-filter button')
            let $totalEntries = j('header .col2')
            this.isLoaded = false,
            this.textLoading = 'Cargando...'

            j.ajax({
                type:"Post",
                url: we_ajax_vars.url,
                dataType: 'json',
                data: {
                    action:'we_entries',
                    nonce: we_ajax_vars.wenonce,
                    id
                },
                beforeSend: function(){
                    $button.prop('disabled', true)
                    $totalEntries.text('')
                },
                success:function(response){
                    $button.prop('disabled', false)
                    that.isLoaded = true
                    that.entries = response
                    $totalEntries.text(`Total entradas de ${name}: ${response.length}`)
                }
            })
        })
    }
})


// Main
new Vue({
    el:'#we-app',
});

