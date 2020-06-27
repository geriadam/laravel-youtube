<template>
    <div>
        <div class="media mt-3" v-for="reply in replies.data">
            <a class="mr-3" href="#">
                <avatar :username="reply.user.name" :size="30" class="mr-3"></avatar>
            </a>
            <div class="media-body">
                <h6 class="mt-0">{{ reply.user.name }}</h6>
                <small >{{ reply.body }}</small>
            </div>
            <votes :default_votes="reply.votes" :entity_id="reply.id" :entity_owner="reply.user.id"></votes>
        </div>
        <div v-if="comment.repliesCount > 0 && replies.next_page_url" class="text-right">
            <button @click="fetchReplies" class="btn btn-info btn-xs">
                Load More
            </button>
        </div>
    </div>
</template>

<script>
    import Avatar from 'vue-avatar'
    export default {
        props: ['comment'],
        components: {
            Avatar
        },
        data() {
            return {
                replies: {
                    data: [],
                    next_page_url: `/comments/${this.comment.id}/replies`
                }
            }
        },
        methods: {
            fetchReplies(){
                axios.get(this.replies.next_page_url).then(({data}) => {
                    this.replies = {
                        ...data,
                        data: [
                            ...this.replies.data,
                            ...data.data
                        ]
                    };
                })
            }
        }
    }
</script>
