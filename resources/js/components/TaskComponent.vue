<template>
    <div class="container">
        <ul class="list-group">
            <li class="list-group-item" v-for="task in tasks.data" :key="task.id">
                <a href="#">{{ task.name }}</a>
            </li>
        </ul>
        <pagination :data="tasks" @pagination-change-page="getResults" class="mt-5"></pagination>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                tasks: {}
            }
        },
        created() {
            axios.get('http://127.0.0.1:8000/taskslist')
                .then(response => this.tasks = response.data)
                .catch(error => console.log(error));
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
		// Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                axios.get('http://127.0.0.1:8000/taskslist?page=' + page)
                    .then(response => {
                        this.tasks = response.data;
                    });
            }
        }
    }
</script>
