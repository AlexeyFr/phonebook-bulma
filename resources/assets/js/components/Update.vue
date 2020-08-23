<script>
    export default {

        template: require('../layouts/form.html'),

        props:['openmodal'],

        data(){

            return{
                button: 'Update',
                list:{
                    name:'',
                    phone:'',
                    email:'',
                    description:''
                },
                errors:{},
            }

        },

        computed: {

            title(){
                return "Update " + this.list.name + "'s details";
            }

        },

        methods:{

            close(){
                this.$emit('closeModal');
                this.errors = {};
            },

            clearError(field){
                if (field) {
                    delete this.errors[field]
                }
            },

            save(){
                if (!Object.keys(this.errors).length) {
                    axios.patch(`/phonebook/${this.list.id}`,this.$data.list)
                        .then((response)=> {
                            let parentListTemp = this.$parent.listTemp;
                            let parentListData = this.$parent.listData;
                            const keyTemp = parentListTemp.findIndex(item => item.id === this.list.id)
                            const keyData = parentListData.findIndex(item => item.id === this.list.id)
                            parentListTemp[keyTemp] = parentListData[keyData] = this.$data.list;
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