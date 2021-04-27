<template>
    <div>
        <form v-on:submit.prevent  autocomplete="off">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" v-model="post.title" id="title" class="form-control" required >
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" v-model="post.description"  id="description" class="form-control" required >
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <input type="text" v-model="post.body" id="body" class="form-control" required >
            </div>

            <div class="form-group">
                <label for="body">Category</label>
                <input type="text" v-model="post.category" id="category" class="form-control" required >
            </div>
            <button type="submit" class="btn btn-default" @click="editPost">Edit post</button>
        </form>
    </div>
</template>

<script>
    import gql from 'graphql-tag';

    const editPostMutation = gql`
  mutation($id: Int!, $title: String!, $body: String!, $description: String!, $category: String!){
      editPost(id: $id, title: $title, body: $body,  description: $description, category: $category) {
        id

    }
  }
`;

    export default {
        name: "EditPost",
        data(){
            return {
                post : {
                    title : '',
                    description : '',
                    body: '',
                    category: ''
                },
            }
        },
        methods : {
            reset(){
                Object.assign(this.$data, this.$options.data.call(this));
            },

            editPost(){
                this.$apollo.mutate({
                    mutation : editPostMutation,
                    variables: {
                        id: this.$route.query.id,
                        title : this.post.title,
                        description : this.post.description,
                        body : this.post.body,
                        category : 'Features'
                    },
                    fetchPolicy : 'no-cache'
                })
                    .then(() => {
                        alert("Successfully edit");
                    })
                    .catch(() => {
                        alert("Something goes wrong");
                    });
            }
        }
    }
</script>

<style scoped>

</style>