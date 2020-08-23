<template>
    <div>
        <div v-if="loading" class="modal is-active">
            <div class="modal-background"></div>
            <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
        </div>
        <section class="panel column is-offset-2 is-8">
            <div class="panel-heading has-text-centered">
                <h1 class="title ">Vuejs Phonebook</h1>
                <button class="button is-primary is-outlined" @click="openAdd">Add New</button>
            </div>
            <div class="panel-block">
                <p class="control has-icons-left">
                    <input class="input" type="text" placeholder="search by name" v-model="searchQuery">
                    <span class="icon is-small is-left icon-search">
                        <i class="fa fa-search"></i>
                    </span>
                </p>
            </div>
            <div class="panel-block">
                <span class="column is-6">Name</span>
                <span class="column is-3 has-text-centered">Phone</span>
                <span class="column is-1 has-text-centered">Show</span>
                <span class="column is-1 has-text-centered">Edit</span>
                <span class="column is-1 has-text-centered">Remove</span>
            </div>
            <div class="panel-block" v-for="item, key in listTemp">
                <span class="column is-6">{{ item.name }}</span>
                <span class="column is-3 has-text-centered">{{ item.phone }}</span>
                <span class="column icon is-medium is-1 has-text-centered">
                    <i class="fas fa-lg has-text-primary fa fa-eye" aria-hidden="true" @click="openShow(key)"></i>
                </span>
                <span class="column icon is-medium is-1 has-text-centered">
                    <i class="fas fa-lg has-text-info fa fa-edit" aria-hidden="true" @click="openUpdate(key)"></i>
                </span>
                <span class="column icon is-medium is-1 has-text-centered">
                    <i class="fas fa-lg has-text-danger fa fa-trash" aria-hidden="true" @click="del(key,item.id)"></i>
                </span>
            </div>
        </section>

        <add-component :openmodal='addActive' @closeModal='close' @sort='sort'></add-component>
        <show-component ref="ShowComponent" :openmodal='showActive' @closeModal='close'></show-component>
        <update-component ref="UpdateComponent" :openmodal='updateActive' @closeModal='close' @sort='sort'></update-component>

    </div>
</template>

<script>

    // let AddComponent = require('./Add.vue');
    import AddComponent from './Add';
    import ShowComponent from './Show';
    import UpdateComponent from './Update';

    export default {

        components: {
            AddComponent,
            ShowComponent,
            UpdateComponent
        },

        data() {

            return {
                addActive: '',
                showActive: '',
                updateActive: '',
                listData: {},
                listTemp: {},
                errors: {},
                loading: false,
                searchQuery: ''
            }

        },

        watch: {

            searchQuery() {
                if (this.searchQuery.length > 0) {
                    this.listTemp = this.listData.filter((item) => {
                        return item.name.toLowerCase().indexOf(this.searchQuery.toLowerCase()) > -1
                        // return Object.keys(item).some((key) => {
                        //     if (key == 'name' || key == 'phone') {
                        //         let string = String(item[key])
                        //         return string.toLowerCase().indexOf(this.searchQuery.toLowerCase()) > -1
                        //     }
                        // })
                    });
                }
                else {
                    this.listTemp = this.listData
                }
            }

        },

        mounted() {

            this.getData();

        },

        methods: {

            getData() {
                axios.post('/getData')
                    .then((response) => this.listData = this.listTemp =response.data)
                    .catch((error) => alert(`Status: ${error.response.status}. Error: ${error.response.statusText}`))
            },

            openAdd() {
                this.addActive = 'is-active';
            },

            openShow(key) {
                // this.$children[1].list = this.listTemp[key]
                this.$refs.ShowComponent.list = this.listTemp[key];
                this.showActive = 'is-active';
            },

            openUpdate(key) {
                let list = this.listTemp[key];
                let childListt = this.$refs.UpdateComponent.list
                childListt.name = list.name
                childListt.phone = list.phone
                childListt.email = list.email
                childListt.description = list.description
                childListt.id = list.id
                this.updateActive = 'is-active';
            },

            close() {
                this.addActive = this.showActive = this.updateActive = ''
            },

            sort() {
                this.listData.sort(function(a,b){
                    if (a.name.toLowerCase() > b.name.toLowerCase()) {
                        return 1;
                    }
                    else if(a.name.toLowerCase() < b.name.toLowerCase()){
                        return -1;
                    }
                })
            },

            del(key, id) {
                if (confirm("Are you sure ?")) {
                    this.loading = !this.loading;
                    axios.delete(`/phonebook/${id}`)
                        .then((response) => {
                            this.listData.splice(key, 1);
                            this.errors={}
                            setTimeout(() => {this.loading = !this.loading}, 500)
                        })
                        .catch((error) => {
                            setTimeout(() => {
                                alert(`Status: ${error.response.status}. Error: ${error.response.statusText}`);
                                this.loading = !this.loading
                            }, 250)
                        })
                }
            }

        }

    }
</script>

<style lang=stylus>

    $bg_color = #fafafa
    $blue = #0000ff
    $white = #fff

    body
    #app
    .navbar
        background $bg_color

    .container
        max-width 80%
        margin 0 auto

    .navbar-brand
        margin 0 10%
        .navbar-menu
            .router-link-exact-active
                color $blue

    .control
        .icon.icon-search
            top 50%
            transform translateY(-50%)

    .fas
        cursor pointer

    .modal-card-body
        margin-bottom 0

    .field
        position relative
        .has-text-danger
            position absolute
            right 0
            top 100%

    .textarea
        resize none
        margin-bottom 1.25rem

    .modal-card-body
        padding 20px 20px 0 20px
        button
            margin-bottom 20px

    .modal-card-foot
        justify-content center

    .panel-block
        justify-content space-between
        align-items center

    .fa-spin
        color $white

    @media (max-width 1024px)

        body,
        .button,
        .input,
        .textarea,
        .select select,
        .file-cta,
        .file-name,
        .pagination-previous,
        .pagination-next,
        .pagination-link,
        .pagination-ellipsis,
        .panel,
        .label
            font-size 0.8rem

        .navbar-menu
            background $bg_color
            box-shadow none

            .navbar-item
                display inline-flex

        .title
            font-size 1.5rem
            margin-bottom 1rem

        .subtitle
            font-size 1rem
            margin-top -0.25rem

        .modal-card-title
            font-size 1.2rem

    @media (max-width 768px)
        .navbar,
        .navbar-brand
            min-height 2rem

        .navbar-menu
            margin 0 auto
            padding 0.2rem 0

            .navbar-item
                padding 0.2rem 0.5rem

        .panel-block
            padding 0.2em 0.1em

        .column
            padding 0.4rem

        .panel:not(:last-child)
            margin-bottom 1rem

        .modal-card
            max-width 90%

        .modal-card-head,
        .modal-card-foot
            padding 10px

        .modal-card-body
            padding 5px 10px 0 10px
            button
                margin-bottom 5px
        .input
            height 2em

        .label:not(:last-child)
            margin-bottom 0.2em

        .field:not(:last-child)
            margin-bottom 0.4rem

        .textarea
            margin-bottom 0.4rem
            padding-top calc(0.5em - 1px)
            padding-bottom calc(0.5em - 1px)
            &:not([rows])
                min-height 5.5em

        .footer
            padding 1rem 0rem

</style>