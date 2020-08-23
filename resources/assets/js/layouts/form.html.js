module.exports = `
<div class="modal" :class='openmodal'>
    <div class="modal-background"></div>
    <div class="modal-card">
        <div class="modal-card-head">
            <p class="modal-card-title">{{ title }}</p>
            <button class="delete" aria-label="close" @click='close'></button>
        </div>
        <form class="modal-card-body" @submit.prevent="save" @keydown="clearError($event.target.name)">
            <div class="field">
                <label class="label">Name</label>
                <div class="control">
                    <input class="input" name="name" :class="{'is-danger':errors.name}" type="text" placeholder="Name" required v-model="list.name">
                </div>
                <small v-if="errors.name" class="has-text-danger is-pulled-right">{{ errors.name[0] }}</small>
            </div>
            <div class="field">
                <label class="label">Phone</label>
                <div class="control">
                    <input class="input" name="phone" :class="{'is-danger':errors.phone}" type="tel" required pattern="\\d*" minlength=12 maxlength="12" placeholder="Phone" v-model="list.phone">
                </div>
                <small v-if="errors.phone" class="has-text-danger is-pulled-right">{{ errors.phone[0] }}</small>
            </div>
            <div class="field">
                <label class="label">Email</label>
                <div class="control">
                    <input class="input" name="email" :class="{'is-danger':errors.email}" type="email" placeholder="Email" required v-model="list.email">
                </div>
                <small v-if="errors.email" class="has-text-danger is-pulled-right">{{ errors.email[0] }}</small>
            </div>
            <div class="field">
                <label class="label">Description</label>
                <div class="control">
                    <textarea class="textarea" name="description" :class="{'is-danger':errors.description}" placeholder="Description" required v-model="list.description"></textarea>
                </div>
                <small v-if="errors.description" class="has-text-danger is-pulled-right">{{ errors.description[0] }}</small>
            </div>
            <div class="has-text-centered">
                <button class="button is-success">{{ button }}</button>
            </div>
        </form>
        <div class="modal-card-foot">
            <button class="button" @click="close">Cancel</button>
        </div>
    </div>
</div>
`;