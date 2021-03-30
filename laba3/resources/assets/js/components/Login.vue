<template>
    <div>
        <form autocomplete="off" @submit.prevent="login">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="user.email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" v-model="user.password" required>
            </div>
            <button type="submit" class="btn btn-default">Sign in</button>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user: {
                    password: '',
                    email: ''
                },
                token: ''
            };
        },

        methods: {
            login() {

                fetch('/api/login', {
                    method: 'post',
                    body: JSON.stringify(this.user),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                    .then(res => res.json())
                    .then(data => {

                        alert(data.status);
                    })
                    .catch(err => console.log(err));

            }
        }

    };
</script>
