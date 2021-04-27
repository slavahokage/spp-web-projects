<template>
    <div>
        <form v-on:submit.prevent  autocomplete="off">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" v-model="user.name" class="form-control" required >
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" v-model="user.email" class="form-control" placeholder="user@example.com" required >
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" v-model="user.password" class="form-control" required >
            </div>
            <button type="submit" class="btn btn-default" @click="registerUser">Submit</button>
        </form>
    </div>
</template>

<script>

  import gql from 'graphql-tag';

  const userRegisterMutation = gql`
  mutation users($name : String!, $email : String!, $password : String!) {
      userRegister(name: $name, email: $email, password: $password) {
        id
        email
    }
  }
`;

    export default {
        name: "Register",
        data(){
            return {
                user : {
                    name : '',
                    email : '',
                    password: '',
                },
            }
        },
        methods : {
            reset(){
                Object.assign(this.$data, this.$options.data.call(this));
            },

            registerUser(){
                this.$apollo.mutate({
                    mutation : userRegisterMutation,
                    variables: {
                        name : this.user.name,
                        email : this.user.email,
                        password : this.user.password
                    },
                    fetchPolicy : 'no-cache'
                })
                    .then(() => {
                        alert("Successfully register");
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