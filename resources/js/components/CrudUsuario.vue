<template>
    <div>
    <b-navbar toggleable="lg" type="dark" variant="primary">
        <b-navbar-brand href="#">Usuários</b-navbar-brand>
    </b-navbar>
        <b-form @submit.prevent="submitForm">
            <b-form-input
                id="input-2"
                v-model="form.name"
                type= "text"
                required
                placeholder="Nome"
            ></b-form-input>

            <b-form-input
                id="input-2"
                v-model="form.email"
                 type= "email"
                required
                placeholder="Nome"
            ></b-form-input>

             <b-form-input
                id="input-2"
                v-model="form.password"
                 type= "password"
                required
                placeholder="Nome"
            ></b-form-input>
             <b-button type="submit" variant="primary">Submit</b-button>
        </b-form>

        <table class="table table-bordered">
            <tr>
                <th>id</th>
                <th>nome</th>
                <th>email</th>
                <th>data</th>
            </tr>
            <tr v-for="u in users" :key="u.id">
                <td>{{ u.id }}</td>
                <td>{{ u.name }}</td>
                <td>{{ u.email }}</td>
                <td>{{ u.created_at }}</td>
            </tr>
        </table>
    
</div>
</template>

<script>
export default {
    data() {
        return {
            users: [],
            form: {
                name: '',
                email: '',
                password: '',
            }
        }
    },
    methods: {
        buscarUsuarios() {
            axios.get('/user')
            .then((res) => {
                this.users = res.data
            })
            .catch((err) => {
                console.log(res.data)
            })
        },
        submitForm () {
           axios.post('/user', this.form)
           .then((res) => {
               
           })
           .catch((err) => {
               console.log(err.data);
           })
        }
    },
    mounted() {
        this.buscarUsuarios()
    }
}
</script>