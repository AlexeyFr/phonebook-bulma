<script>
    export default {

        template: require('../layouts/form.html'),

        props:['openmodal'],

        data(){

            return{
                title: 'Add New Entry',
                button: 'Save',
                list:{
                    name:'',
                    phone:'',
                    email:'',
                    description:''
                },
                errors:{},
            }

        },

        methods:{

            close(){
                this.$emit('closeModal');
                this.errors = {};
                Object.assign(this.$data.list, this.$options.data().list);
            },

            clearError(field){
                if (field) {
                    delete this.errors[field];
                }
            },

            save(){
                if (!Object.keys(this.errors).length) {
                    axios.post('/phonebook',this.$data.list)
                        .then((response)=> {
                            this.$parent.listData.push(response.data)
                            this.$emit('sort')
                            this.close()
                        })
                        .catch((error) => {
                            if (error.response.status == 404 || error.response.status == 500) {
                                alert(`Status: ${error.response.status}. Error: ${error.response.statusText}`);
                            }
                            else {
                                this.errors = error.response.data;
                            }
                        })
                }
            }

        }

    }
</script>