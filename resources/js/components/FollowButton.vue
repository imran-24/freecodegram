<template>
    <div>
        <button @click="followUser" v-text="buttonText"
            class="bg-sky-500 rounded-md font-semibold text-white hover:bg-sky-600 transition px-2 py-[2px] text-sm text-center"></button>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: ['userId', 'follows'],
    computed: {
        buttonText() {
            return this.status ? 'Unfollow' : 'Follow';
        }
    },
    data(){
        return {
            status: this.follows
        }
    },
    methods: {
        followUser() {
            axios.post('/follow/' + this.userId)
                .then(response => {
                    // Toggle follows state
                    this.status = !this.status;
                })
                .catch(error => {
                    console.error('Error following user:', error);
                    if(error.response.status == 401){
                        window.location = '/login';
                    }
                });
        }
    }
}
</script>
