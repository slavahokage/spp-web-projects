<template>
    <div>
        <form v-on:submit.prevent  autocomplete="off">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" v-model="user.email" id="email" class="form-control" placeholder="user@example.com" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" v-model="user.password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-default" @click="loginUser">Sign in</button>
        </form>
    </div>
</template>

<script>
    import gql from 'graphql-tag';

    const userLoginMutation = gql`
  mutation($email: String!, $password: String!){
      userLogin(email: $email, password: $password) {
        id
        email
    }
  }
`;

    export default {
        name: "Login",
        data(){
            return {
                user : {
                    email : '',
                    password: '',
                },
            }
        },
        methods : {
            reset(){
                Object.assign(this.$data, this.$options.data.call(this));
            },

            loginUser(){
                this.$apollo.mutate({
                    mutation : userLoginMutation,
                    variables: {
                        email : this.user.email,
                        password : this.user.password
                    },
                    fetchPolicy : 'no-cache'
                })
                    .then(() => {
                        alert("Successfully login");
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