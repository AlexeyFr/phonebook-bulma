<template>
    <div class="modal" :class='openmodal'>
        <div class="modal-background"></div>
        <div class="modal-card">
            <div class="modal-card-head">
                <p class="modal-card-title">{{ list.name }}'s details</p>
                <button class="delete" aria-label="close" @click='close'></button>
            </div>
            <ul class="modal-card-body">
                <li class="panel-block">
                    <p class="column is-3"><b>Name</b></p>
                    <p class="column is-9">{{ list.name }}</p>
                </li>
                <li class="panel-block">
                    <p class="column is-3"><b>Phone</b></p>
                    <p class="column is-9">{{ list.phone }}</p>
                </li>
                <li class="panel-block">
                    <p class="column is-3"><b>Email</b></p>
                    <p class="column is-9">{{ list.email }}</p>
                </li>
                <li class="panel-block">
                    <p class="column is-3"><b>Description</b></p>
                    <p class="column is-9">{{ list.description }}</p>
                </li>
            </ul>
            <div class="modal-card-foot">
                <button class="button" @click='close'>Close</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        props: ['openmodal'],

        data() {
            return {
                list: {}
            }
        },

        methods: {
            close() {
                this.$emit('closeModal')
            },
        }

    }
</script>